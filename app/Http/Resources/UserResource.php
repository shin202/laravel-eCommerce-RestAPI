<?php

namespace App\Http\Resources;

use App\Enums\AccountStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
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

        return [
            'id' => $this->when(Auth::user()->isAdministrator(), $this->id),
            'username' => $this->username,
            'email' => $this->email,
            'is_verified' => $this->when(Auth::user()->isAdministrator(), $this->is_verified),
            'email_verified_at' => $this->when(Auth::user()->isAdministrator(), $this->email_verified_at->format('d.m.Y')),
            'status' => AccountStatusEnum::coerce($this->status)->key,
            'created_at' => $this->when(Auth::user()->isAdministrator(), $this->created_at->format('d.m.Y')),
            'updated_at' => $this->when(Auth::user()->isAdministrator(), $this->updated_at->format('d.m.Y')),
            'roles' => RoleResource::collection($roles),
        ];
    }
}
