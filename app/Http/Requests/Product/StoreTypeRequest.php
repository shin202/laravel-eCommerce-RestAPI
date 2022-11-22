<?php

namespace App\Http\Requests\Product;

use App\Enums\ProductTypeEnum;
use App\Models\Size;
use App\Models\Type;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTypeRequest extends FormRequest
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
                Rule::unique(Type::class),
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
}
