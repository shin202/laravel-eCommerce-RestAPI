<?php

namespace App\Http\Requests\Product;

use App\Models\Color;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreColorRequest extends FormRequest
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
            'color' => [
                'bail',
                'required',
                'regex:/^#([\w\d]{6})$/',
                Rule::unique(Color::class),
            ],
        ];
    }

    public function messages()
    {
        return [
            'color.required' => 'Vui lòng chọn màu sản phẩm.',
            'color.regex' => 'Màu được chọn không hợp lệ.',
            'color.unique' => 'Màu này đã tồn tại. Vui lòng chọn một màu khác.',
        ];
    }
}
