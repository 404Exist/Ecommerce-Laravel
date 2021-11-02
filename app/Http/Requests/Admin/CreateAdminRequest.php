<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:admins,email',
            'password' => 'min:6',
            'roles_name' => 'required',
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
