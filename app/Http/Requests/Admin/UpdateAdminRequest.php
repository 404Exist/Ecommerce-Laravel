<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$this->id,
            'password' => 'sometimes|nullable|min:6',
            'roles_name' => 'required'
        ];
    }
}
