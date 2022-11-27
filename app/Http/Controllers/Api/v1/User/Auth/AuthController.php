<?php

namespace App\Http\Controllers\Api\v1\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Services\ImageService;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponser;

    protected $user;
    protected $role;
    protected $imageService;

    public function __construct(User $user, Role $role, ImageService $imageService)
    {
        $this->user = $user->with(['roles']);
        $this->role = $role;
        $this->imageService = $imageService;
    }

    /**
     * Register a new account.
     * 
     * @param \App\Http\Requests\Auth\AuthRegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(AuthRegisterRequest $request) {
        $validated = $request->validated();
        $credentials = $request->safe()->except('avatar');
        $credentials['password'] = Hash::make($credentials['password']);

        $role = $this->role->baseUser();
        $user = $this->user->create($credentials);
        $user->roles()->attach($role->id);
        
        if ($request->has('avatar')) {
            $avatar = $this->imageService->handleUploadedImage($validated['avatar'], 'user', $user->username);
            $user->avatar()->create($avatar);
        } else {
            $anonymousAvatar = [
                'url' => env('ANONYMOUS_AVATAR'),
                'expires_at' => null,
            ];
            $user->avatar()->create($anonymousAvatar);
        }

        $accessToken = $user->createToken('accessToken')->plainTextToken;

        $message = 'Đăng ký thành công.';

        return $this->responseWithAccessToken(new UserResource($user), $accessToken, $message, 201);
    }

    public function login(AuthLoginRequest $request) {
        $credentials = $request->validated();
        
        if (!Auth::attempt($credentials)) {
            $message = 'Tài khoản hoặc mật khẩu không chính xác.';
            return $this->userWrongCredentialsResponse($message);
        }

        $user = Auth::user()->load(['roles']);
        $accessToken = $user->createToken('accessToken')->plainTextToken;

        $message = 'Đăng nhập thành công.';

        return $this->responseWithAccessToken(new UserResource($user), $accessToken, $message);
    }

    public function logout() {
        Auth::user()->tokens()->delete();

        return $this->successReponse(null, 'Bạn đã đăng xuất.');
    }
}
