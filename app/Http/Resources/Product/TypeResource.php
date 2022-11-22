<?php

namespace App\Http\Resources\Product;

use App\Enums\ProductTypeEnum;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeResource extends JsonResource
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
            'id' => $this->id,
            'type' => ProductTypeEnum::coerce($this->type)->key,
            'slug' => $this->slug,
            'sizes' => SizeTypeResource::collection($this->sizes),
        ];
    }
}
