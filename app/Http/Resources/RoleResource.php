<?php

namespace App\Http\Resources;

use App\Enums\UserRoleEnum;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $role = UserRoleEnum::coerce($this->role);

        return [
            'id' => $this->when(Auth::user()->isAdministrator(), $this->id),
            'role' => $role->value,
            'name' => $role->key,
            'created_at' => $this->when(Auth::user()->isAdministrator(), $this->created_at->format('d.m.Y')),
            'updated_at' => $this->when(Auth::user()->isAdministrator(), $this->updated_at->format('d.m.Y')),
        ];
    }
}
