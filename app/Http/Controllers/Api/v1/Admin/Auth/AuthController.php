<?php

namespace App\Http\Controllers\Api\v1\Admin\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthAdminRegisterRequest;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Resources\AuthUserResource;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use App\Services\ImageService;
use App\Traits\ApiResponser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponser;

    protected $user;
    protected $role;
    protected $admin;
    protected $imageService;
    
    public function __construct(User $user, Role $role, Admin $admin, ImageService $imageService)
    {
        $this->user = $user->with(['roles']);
        $this->role = $role;
        $this->admin = $admin;
        $this->imageService = $imageService;
    }

    public function login(AuthLoginRequest $request) {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            $message = 'Tài khoản hoặc mật khẩu không chính xác.';
            return $this->userWrongCredentialsResponse($message);
        }

        $user = Auth::user()->load(['roles', 'admin']);
        $administratorRole = $user->hasRole(UserRoleEnum::Administrator) || $user->hasRole(UserRoleEnum::SuperAdministrator);

        if (!$administratorRole) {
            return $this->accessDeniedResponse('Quyền truy cập bị từ chối. Bạn không phải là admin.');
        }

        $accessToken = $user->createToken('accessToken')->plainTextToken;
        
        $message = 'Đăng nhập thành công với tư cách quản trị viên.';

        return $this->responseWithAccessToken(new AuthUserResource($user), $accessToken, $message);
    }

    public function register(AuthAdminRegisterRequest $request) {
        if (!Gate::allows('admin-register')) {
            return $this->accessDeniedResponse('Quyền truy cập bị từ chối.');
        }

        $validated = $request->validated();
        $credentials = $request->safe()->except(['avatar', 'name', 'phone_number']);
        $credentials['password'] = Hash::make($credentials['password']);

        $role = $this->role->administrator();
        $user = $this->user->create($credentials);
        $user->roles()->attach($role->id);
        $user->admin()->create([
            'name' => $validated['name'],
            'phone_number' => $validated['phone_number'],
        ]);

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

        $userData = $user->load(['roles', 'admin']);
        $accessToken = $user->createToken('accessToken')->plainTextToken;
        $message = 'Đăng ký thành công.';

        return $this->responseWithAccessToken(new AuthUserResource($userData), $accessToken, $message);
    }
}
