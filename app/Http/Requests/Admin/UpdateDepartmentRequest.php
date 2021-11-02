<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
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
            'parent_id' => 'sometimes|nullable|numeric',
            'icon' => 'sometimes|nullable|image|mimes:'.img_types(),
            'description' => 'sometimes|nullable',
            'keyword' => 'sometimes|nullable',
        ];
    }
}
