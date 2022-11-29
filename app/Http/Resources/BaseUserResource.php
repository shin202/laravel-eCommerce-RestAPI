<?php

namespace App\Http\Resources;

use App\Enums\AccountStatusEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $is_verified = $this->is_verified ?? 'Not Verified';
        $status = $this->status ?? 0;
        $roles = $this->whenLoaded('roles');

        return [
            'username' => $this->username,
            'email' => $this->email,
            'is_verified' => $is_verified,
            'status' => AccountStatusEnum::coerce($status)->key,
            'roles' => BaseRoleResource::collection($roles),
        ];
    }
}
