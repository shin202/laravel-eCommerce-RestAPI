<?php

namespace App\Http\Resources;

use App\Enums\AccountStatusEnum;
use App\Models\Admin;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AuthUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $roles = $this->whenLoaded('roles');
        $admin = $this->whenLoaded('admin');
        $is_verified = $this->is_verified;
        $email_verified_at = $is_verified ? $this->email_verified_at->format('d.m.Y') : $this->email_verified_at;
        $status = $this->status ?? 0;

        return [
            'id' => $this->when(Auth::user()->isAdministrator(), $this->id),
            'username' => $this->username,
            'email' => $this->email,
            'is_verified' => $is_verified ?? 'Not Verified',
            'email_verified_at' => $this->when(Auth::user()->isAdministrator(), $email_verified_at),
            'status' => AccountStatusEnum::coerce($status)->key,
            'created_at' => $this->when(Auth::user()->isAdministrator(), $this->created_at->format('d.m.Y')),
            'updated_at' => $this->when(Auth::user()->isAdministrator(), $this->updated_at->format('d.m.Y')),
            'roles' => RoleResource::collection($roles),
            'admin' => $this->when(Auth::user()->isAdministrator(), new AdminResource($admin)),
        ];
    }
}
