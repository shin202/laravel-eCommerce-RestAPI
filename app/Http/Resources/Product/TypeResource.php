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
        $sizes = $this->whenLoaded('sizes');

        return [
            'id' => $this->id,
            'type' => ProductTypeEnum::coerce($this->type)->key,
            'slug' => $this->slug,
            'sizes' => SizeResource::collection($sizes),
            'created_at' => $this->created_at->format('d.m.Y'),
            'updated_at' => $this->updated_at->format('d.m.Y'),
        ];
    }
}
