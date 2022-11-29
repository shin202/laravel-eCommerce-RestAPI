<?php

namespace App\Http\Requests\Auth;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthAdminRegisterRequest extends FormRequest
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
            'username' => [
                'bail',
                'required',
                'string',
                'min:6',
                'max:20',
                Rule::unique(User::class),
            ],
            'email' => [
                'bail',
                'required',
                'email',
                'regex:/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
                Rule::unique(User::class),
            ],
            'password' => [
                'bail',
                'required',
                'string',
                'min:6',
                'max:10',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*.,])[A-Za-z0-9!@#$%^&*.,]{6,10}$/',
                'confirmed'
            ],
            'name' => [
                'bail',
                'required',
                'string',
            ],
            'phone_number' => [
                'bail',
                'required',
                Rule::unique(Admin::class),
            ],
            'avatar' => [
                'bail',
                'nullable',
                'file',
                'image',
            ]
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Vui lòng điền tên người dùng.',
            'username.string' => 'Tên người dùng không hợp lệ.',
            'username.min' => 'Tên người dùng tối thiểu :min ký tự.',
            'username.max' => 'Tên người dùng tối đa :max ký tự.',
            'username.unique' => 'Tên người dùng này đã tồn tại. Vui lòng chọn một tên khác.',
            'email.required' => 'Vui lòng điền email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'email.regex' => 'Địa chỉ email không hợp lệ.',
            'email.unique' => 'Đại chỉ email này đã tồn tại.',
            'password.required' => 'Vui lòng điền mật khẩu.',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự.',
            'password.max' => 'Mật khẩu tối đa :max ký tự.',
            'password.regex' => 'Mật khẩu phải chứa từ :min - :max ký tự bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.', 
            'password.confirmed' => 'Vui lòng xác nhận mật khẩu.',
            'name.required' => 'Vui lòng điền tên.',
            'name.string' => 'Tên không hợp lệ.',
            'phone_number.required' => 'Vui lòng điền số điện thoại.',
            'phone_number.unique' => 'Số điện thoại này đã tồn tại.',
            'avatar.file' => 'Avatar phải là file.',
            'avatar.image' => 'Avatar phải là ảnh.',
        ];
    }
}
