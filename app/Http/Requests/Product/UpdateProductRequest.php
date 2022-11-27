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
            'stock' => [
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
                Rule::exists(Type::class, 'id'),
            ],
            'sizes' => [
                'required',
                'array',
            ],
            'sizes.*' => [
                'required',
                Rule::exists(Size::class, 'id'),
            ],
            'categories' => [
                'required',
                'array',
            ],
            'categories.*' => [
                'required',
                Rule::exists(Category::class, 'id'),
            ],
            'colors' => [
                'bail',
                'required',
                'array',
            ],
            'colors.*' => [
                'bail',
                'required',
                Rule::exists(Color::class, 'id'),
            ],
            'newImages' => [
                'array' => 'Ảnh sản phẩm không hợp lệ (phải bao gồm một danh sách các ảnh).',
            ],
            'newImages.*' => [
                'required' => 'Vui lòng chọn ảnh sản phẩm cần tải lên.',
                'file' => 'Ảnh của sản phẩm phải là file.',
                'image' => 'File đã chọn không hợp lệ.',
            ],
            'oldImages' => [
                'array' => 'Ảnh sản phẩm cần xóa không hợp lệ (phải bao gồm một danh sách các ảnh).',
            ],
            'oldImages.*' => [
                'required' => 'Vui lòng chọn ảnh sản phẩm cần xóa.',
                'exists' => 'Ảnh đã chọn không tồn tại hoặc đã bị xóa.',
            ]
        ];
    }
}
