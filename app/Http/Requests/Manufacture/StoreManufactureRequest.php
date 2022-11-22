<?php

namespace App\Http\Requests\Manufacture;

use App\Models\Manufacture;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreManufactureRequest extends FormRequest
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
                'string',
                'max:191',
            ],
            'logo' => [
                'bail',
                'required',
                'image',
                'file',
            ],
            'address' => [
                'bail',
                'nullable',
                'string'
            ],
            'phone_number' => [
                'bail',
                'required',
                Rule::unique(Manufacture::class),
                'string',
            ],
            'email' => [
                'bail',
                'required',
                Rule::unique(Manufacture::class),
                'string',
            ],
            'information' => [
                'bail',
                'nullable',
                'string'
            ],
            'slug' => [
                'bail',
                'required',
                'string',
                Rule::unique(Manufacture::class),
            ],
        ];
    }
}
