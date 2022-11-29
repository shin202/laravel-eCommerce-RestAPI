<?php

namespace App\Http\Requests\Product;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DeleteProductImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdministrator();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'images' => [
                'bail',
                'required',
                'array',
            ],
            'images.*' => [
                'bail',
                'required',
                Rule::exists(Image::class, 'id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'images.required' => 'Vui lòng chọn ảnh sản phẩm.',
            'images.array' => 'Ảnh sản phẩm không hợp lệ (phải bao gồm một danh sách ảnh).',
            'images.*.required' => 'Vui lòng chọn ảnh sản phẩm.',
            'images.*.exists' => 'Ảnh đã chọn không hợp lệ, không tồn tại hoặc đã bị xóa.',
        ];
    }
}
