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
}
