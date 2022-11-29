<?php

namespace App\Http\Requests\Product;

use App\Models\Category;
use App\Models\Color;
use App\Models\Manufacture;
use App\Models\Product;
use App\Models\Size;
use App\Models\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
                Rule::exists(Manufacture::class, 'id'),
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
            'images' => [
                'bail',
                'required',
                'array',
            ],
            'images.*' => [
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
                'required',
                'string',
                'regex:/^[\w\d]+(?:-[\w\d]+)*$/',
                Rule::unique(Product::class),
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
        ];
    }

    public function messages()
    {
        return [
            'manufacture_id.required' => 'Vui lòng chọn nhà sản xuất.',
            'manufacture_id.exists' => 'Nhà sản xuất này không tồn tại.',
            'name.required' => 'Vui lòng điền tên sản phẩm.',
            'name.string' => 'Tên sản phẩm không hợp lệ.',
            'description.string' => 'Mô tả sản phẩm không hợp lệ.',
            'images.required' => 'Vui lòng chọn ảnh sản phẩm.',
            'images.array' => 'Ảnh sản phẩm không hợp lệ (phải bao gồm một danh sách ảnh).',
            'images.*.required' => 'Vui lòng chọn ảnh sản phẩm.',
            'images.*.file' => 'Ảnh sản phẩm phải là file.',
            'images.*.image' => 'File đã chọn không hợp lệ.',
            'stock.numeric' => 'Số lượng sản phẩm phải là số.',
            'stock.regex' => 'Số lượng sản phẩm không hợp lệ.',
            'price.required' => 'Vui lòng điền giá của sản phẩm.',
            'price.numeric' => 'Giá sản phẩm phải là số.',
            'price.regex' => 'Giá sản phẩm không hợp lệ.',
            'slug.required' => 'Vui lòng điền đường dẫn của sản phẩm.',
            'slug.string' => 'Đường dẫn sản phẩm không hợp lệ.',
            'slug.regex' => 'Đường dẫn sản phẩm không hợp lệ. Ex: Đường dẫn hợp lệ: test-slug',
            'slug.unique' => 'Đường dẫn này đã tồn tại.',
            'types.required' => 'Vui lòng chọn loại sản phẩm.',
            'types.array' => 'Loại sản phẩm không hợp lệ (phải bao gồm một danh sách loại).',
            'types.*.required' => 'Vui lòng chọn loại sản phẩm.',
            'types.*.exists' => 'Loại sản phẩm này không tồn tại.',
            'sizes.required' => 'Vui lòng chọn size sản phẩm.',
            'sizes.array' => 'Size sản phẩm không hợp lệ (phải bao gồm một danh sách size).',
            'sizes.*.required' => 'Vui lòng chọn size sản phẩm.',
            'sizes.*.exists' => 'Size sản phẩm này không tồn tại.',
            'categories.required' => 'Vui lòng chọn danh mục sản phẩm.',
            'categories.array' => 'Danh mục sản phẩm không hợp lệ (phải bao gồm một danh sách các danh mục).',
            'categories.*.required' => 'Vui lòng chọn danh mục sản phẩm.',
            'categories.*.exists' => 'Danh mục sản phẩm này không tồn tại.',
            'colors.required' => 'Vui lòng chọn màu của sản phẩm.',
            'colors.array' => 'Màu sản phẩm không hợp lệ (phải bao gồm một danh sách các màu).',
            'colors.*.required' => 'Vui lòng chọn màu của sản phẩm.',
            'colors.*.exists' => 'Màu sản phẩm này không tồn tại.',
        ];
    }
}
