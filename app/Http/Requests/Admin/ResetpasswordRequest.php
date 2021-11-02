<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ResetpasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required|min:8|confirmed',
        'password_confirmation' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'Password',
            'password_confirmation' => 'Confirmation Password',
        ];
    }
}
