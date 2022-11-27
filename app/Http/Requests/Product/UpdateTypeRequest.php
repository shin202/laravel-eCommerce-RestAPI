<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\ProductTypeEnum;
use App\Models\Type;

class UpdateTypeRequest extends FormRequest
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
            'type' => [
                'bail',
                'required',
                Rule::in(ProductTypeEnum::asArray()),
                'numeric'
            ],
            'slug' => [
                'bail',
                'required',
                'string',
                Rule::unique(Type::class)->ignore($this->type),
            ],
            'sizes' => [
                'bail',
                'nullable',
                'array',
            ],
            'sizes.*' => [
                'bail',
                'required',
                Rule::exists(Size::class, 'id'),
            ]
        ];
    }

    public function messages()
    {
        return [
            'type' => [
                'required' => 'Vui lòng chọn loại sản phẩm.',
                'in' => 'Loại sản phẩm phải nằm trong danh sách (Nam, Nữ, Trẻ em).',
            ],
            'slug' => [
                'required' => 'Vui lòng điền đường dẫn của loại sản phẩm.',
                'string' => 'Đường dẫn không hợp lệ.',
                'regex' => 'Đường dẫn không hợp lệ. Ex: Đường dẫn hợp lệ: test-slug',
                'unique' => 'Đường dẫn này đã tồn tại.',
            ],
            'sizes' => [
                'array' => 'Size của loại sản phẩm không hợp lệ (phải bao gồm một danh sách các size).',
            ],
            'sizes.*' => [
                'required' => 'Vui lòng chọn size của loại sản phẩm.',
                'exists' => 'Size này không tồn tại.',
            ]
        ];
    }
}
