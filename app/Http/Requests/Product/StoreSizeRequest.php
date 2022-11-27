<?php

namespace App\Http\Requests\Product;

use App\Models\Size;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
                'string',
                Rule::unique(Size::class),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Vui lòng điền size sản phẩm.',
                'string' => 'Size sản phẩm không hợp lệ.',
                'unique' => 'Size sản phẩm này đã tồn tại.',
            ]
        ];
    }
}
