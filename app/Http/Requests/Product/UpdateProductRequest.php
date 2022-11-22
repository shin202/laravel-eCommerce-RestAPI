<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\Enums\ProductRatingEnum;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Manufacture;
use App\Models\Product;
use App\Models\Size;
use App\Models\Type;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'manufacture_id' => [
                'bail',
                'required',
                Rule::exists(Manufacture::class),
            ],
            'name' => [
                'bail',
                'required',
                'string'
            ],
            'description' => [
                'bail',
                'nullable',
                'string',
            ],
            'rating' => [
                'bail',
                'nullable',
                Rule::in(ProductRatingEnum::asArray()),
                'numeric',
            ],
            'oldImages' => [
                'bail',
                'nullable',
                'array',
            ],
            'oldImages.*' => [
                'bail',
                'required',
                Rule::exists(Image::class),
            ],
            'newImages' => [
                'bail',
                'nullable',
                'array',
            ],
            'newImages.*' => [
                'bail',
                'required',
                'file',
                'image',
            ],
            'quantity' => [
                'bail',
                'nullable',
                'numeric',
                'regex:/\d+/',
            ],
            'price' => [
                'bail',
                'required',
                'numeric',
                'regex:/\d+/',
            ],
            'slug' => [
                'bail',
                'nullable',
                'string',
                Rule::unique(Product::class)->ignore($this->product),
            ],
            'types' => [
                'required',
                'array',
            ],
            'types.*' => [
                'required',
                Rule::exists(Type::class),
            ],
            'sizes' => [
                'required',
                'array',
            ],
            'sizes.*' => [
                'required',
                Rule::exists(Size::class),
            ],
            'categories' => [
                'required',
                'array',
            ],
            'categories.*' => [
                'required',
                Rule::exists(Category::class),
            ],
            'colors' => [
                'bail',
                'required',
                'array',
            ],
            'colors.*' => [
                'bail',
                'required',
                Rule::exists(Color::class),
            ],
        ];
    }
}
