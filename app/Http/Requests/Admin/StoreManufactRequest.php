<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreManufactRequest extends FormRequest
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
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'facebook' => 'sometimes|nullable|url',
            'twitter' => 'sometimes|nullable|url',
            'website' => 'sometimes|nullable|url',
            'contact_name' => 'sometimes|nullable|string',
            'latitude' => 'sometimes|nullable',
            'longitude' => 'sometimes|nullable',
            'logo' => 'required|image|mimes:'.img_types(),
        ];
    }
}
