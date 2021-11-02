<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class UpdateProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_en' => 'required',
            'title_ar' => 'required',
            'content_en' => 'required',
            'content_ar' => 'required',
            'photo' => 'sometimes|required',
            'department_id' => 'required|numeric',
            'trademark_id' => 'required|numeric',
            'manufacturer_id' => 'required|numeric',
            'color_id' => 'sometimes|nullable|numeric',
            'size' => 'sometimes|nullable',
            'size_id' => 'sometimes|nullable|numeric',
            'currency_id' => 'sometimes|nullable|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'start_offer_at' => 'sometimes|nullable|date',
            'end_offer_at' => 'sometimes|nullable|date',
            'offer_price' => 'sometimes|nullable|numeric',
            'weight' => 'sometimes|nullable',
            'weight_id' => 'sometimes|nullable|numeric',
            'status' => 'sometimes|nullable|in:pending,rejected,active',
            'reason' => 'sometimes|nullable',
            'mall_id.*' => 'sometimes|required',
            'input_key.*' => 'sometimes|required',
            'input_value.*' => 'sometimes|required',
        ];
    }
    public function response(array $errors)
    {
        return new JsonResponse($errors, 422);
    }
}
