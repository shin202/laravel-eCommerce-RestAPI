<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->when(Auth::user()->isAdministrator(), $this->id),
            'name' => $this->when(Auth::user()->isAdministrator(), $this->name),
            'phone_number' => $this->when(Auth::user()->isAdministrator(), $this->phone_number),
            'description' => $this->when(Auth::user()->isAdministrator(), $this->description),
            'created_at' => $this->when(Auth::user()->isAdministrator(), $this->created_at->format('d.m.Y')),
            'updated_at' => $this->when(Auth::user()->isAdministrator(), $this->updated_at->format('d.m.Y')),
        ];
    }
}
