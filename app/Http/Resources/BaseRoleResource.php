<?php

namespace App\Http\Resources;

use App\Enums\UserRoleEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseRoleResource extends JsonResource
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
            'role' => $role->value,
            'name' => $role->key,
        ];
    }
}
