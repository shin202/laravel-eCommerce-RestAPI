<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Manufacture\ManufactureResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $categories = $this->whenLoaded('categories');
        $colors = $this->whenLoaded('colors');
        $images = $this->whenLoaded('images');
        $manufacture = $this->whenLoaded('manufacture');
        $types = $this->whenLoaded('types');
        $sizes = $this->whenLoaded('sizes');
        $reviews = $this->whenLoaded('reviews');
        $total_review = $reviews->count();
        $rating = $total_review > 0 ? round(($reviews->sum('star') / $reviews->count()), 2) : 0;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'manufacture' => new ManufactureResource($manufacture),
            'categories' => CategoryResource::collection($categories),
            'types' => TypeResource::collection($types), 
            'sizes' => SizeResource::collection($sizes),
            'description' => $this->description,
            'total_review' => $total_review,
            'rating' => $reviews->count() > 0 ? $rating : 'Không có đánh giá nào.',
            'images' => ImageResource::collection($images),
            'stock' => $this->stock == 0 ? 'Hết hàng' : $this->stock,
            'price' => $this->price,
            'slug' => $this->slug,
            'created_at' => $this->created_at->format('d.m.Y'),
            'updated_at' => $this->updated_at->format('d.m.Y'),
        ];
    }
}
