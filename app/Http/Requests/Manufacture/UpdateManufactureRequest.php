<?php

namespace App\Http\Requests\Manufacture;

use App\Models\Manufacture;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateManufactureRequest extends FormRequest
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
            ],
            'newLogo' => [
                'bail',
                'nullable',
                'file',
                'image',
            ],
            'address' => [
                'bail',
                'nullable',
                'string'
            ],
            'phone_number' => [
                'bail',
                'required',
                'string',
                'regex:/^0([1-9]{9})$/',
                Rule::unique(Manufacture::class)->ignore($this->manufacture),
            ],
            'email' => [
                'bail',
                'required',
                Rule::unique(Manufacture::class)->ignore($this->manufacture),
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
                'regex:/^[\w\d]+(?:-[\w\d]+)*$/',
                Rule::unique(Manufacture::class)->ignore($this->manufacture),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'Vui lòng điền tên nhà sản xuất.',
                'string' => 'Tên nhà sản xuất không hợp lệ.',
            ],
            'newLogo' => [
                'image' => 'File được chọn không hợp lệ.',
                'file' => 'Ảnh logo phải là file.',
            ],
            'address' => [
                'string' => 'Địa chỉ nhà sản xuất không hợp lệ.',
            ],
            'phone_number' => [
                'required' => 'Vui lòng nhập số điện thoại nhà sản xuất.',
                'regex' => 'Số điện thoại đã nhập không hợp lệ.',
                'unique' => 'Số điện thoại này đã tồn tại.',
                'string' => 'Số điện thoại không hợp lệ.',
            ],
            'email' => [
                'required' => 'Vui lòng điền email nhà sản xuất.',
                'email' => 'Địa chỉ email không hợp lệ.',
                'regex' => 'Địa chỉ email không hợp lệ.',
                'unique' => 'Địa chỉ email này đã tồn tại.',
            ],
            'information' => [
                'string' => 'Thông tin nhà sản xuất không hợp lệ.',
            ],
            'slug' => [
                'required' => 'Vui lòng nhập đường dẫn nhà sản xuất.',
                'string' => 'Đường dẫn không hợp lệ.',
                'regex' => 'Đường dẫn không hợp lệ. Ex: Đường dẫn hợp lệ: test-slug',
                'unique' => 'Đường dẫn này đã tồn tại.',
            ],
        ];
    }
}
