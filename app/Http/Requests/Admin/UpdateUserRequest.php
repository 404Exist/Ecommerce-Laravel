<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'required|unique:users,email,'.$this->id,
            'password' => 'sometimes|nullable|min:6',
        ];
    }
}
