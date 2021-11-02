<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name_en' => 'required',
            'name_ar' => 'required',
            'country_id' => 'required|numeric',
            'city_id' => 'required|numeric',
        ];
    }
}
