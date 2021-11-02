<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingRequest extends FormRequest
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
            'user_id' => 'required|numeric',
            'latitude' => 'sometimes|nullable',
            'longitude' => 'sometimes|nullable',
            'logo' => 'image|mimes:'.img_types(),
        ];
    }
}
