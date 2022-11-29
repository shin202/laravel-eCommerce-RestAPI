<?php

namespace App\Http\Requests\Image;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreImageRequest extends FormRequest
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
            'image' => [
                'bail',
                'required',
                'file',
                'image',
            ],
            'imageable_type' => [
                'bail',
                'required',
                Rule::in(['product', 'manufacture', 'user']),
            ],
            'imageable_id' => [
                'bail',
                'required',
                'poly_exists:imageable_type',
            ]
        ];
    }
    
    public function messages()
    {
        return [
            'image.required' => 'Vui lòng chọn ảnh cần tải lên.',
            'image.file' => 'Ảnh phải là file.',
            'image.image' => 'File được chọn không hợp lệ.',
            'imageable_type.required' => 'Vui lòng chọn loại ảnh cần tải lên.',
            'imageable_type.in' => 'Loại ảnh phải thuộc một trong các loại sau :values',
            'imageable_id.required' => 'Vui lòng chọn sản phẩm (nhà sản xuất, hoặc người dùng) cần thêm ảnh.',
            'imageable_id.poly_exists' => 'Sản phẩm, nhà sản xuất hoặc người dùng này không tồn tại.',
        ];
    }
}
