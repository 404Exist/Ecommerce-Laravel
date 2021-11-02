<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountryRequest extends FormRequest
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
            'mob_code' => 'required',
            'abbreviation' => 'required',
            'currency_en' => 'required',
            'currency_ar' => 'required',
            'flag' => 'image|mimes:'.img_types(),
        ];
    }
}
