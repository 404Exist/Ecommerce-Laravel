<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'logo' => 'image|mimes:'.img_types(),
            'icon' => 'image|mimes:'.img_types(),
        ];
    }
}
