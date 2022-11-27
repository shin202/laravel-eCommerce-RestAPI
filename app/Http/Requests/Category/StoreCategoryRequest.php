<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends FormRequest
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
            'name' => [
                'bail',
                'required',
                'string'
            ],
            'slug' => [
                'bail',
                'required',
                'string',
                'regex:/^[\w\d]+(?:-[\w\d]+)*$/',
                Rule::unique(Category::class),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Vui lòng điền tên danh mục sản phẩm.',
                'string' => 'Tên danh mục không hợp lệ.',
            ],
            'slug' => [
                'required' => 'Vui lòng điền đường dẫn sản phẩm.',
                'string' => 'Đường dẫn không hợp lệ.',
                'regex' => 'Đường dẫn không hợp lệ. Ex: Đường dẫn hợp lệ: test-slug',
                'unique' => 'Tên đường dẫn này đã tồn tại. Vui lòng chọn tên khác.',
            ]
        ];
    }
}
