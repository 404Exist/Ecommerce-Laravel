<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTrademarkRequest extends FormRequest
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
            'logo' => 'required|image|mimes:'.img_types(),
        ];
    }
}
