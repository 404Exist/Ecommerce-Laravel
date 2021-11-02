<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'level' => 'required|in:user,company,vendor',
            'email' => 'required|unique:users,email',
            'password' => 'min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute field is required',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
}
