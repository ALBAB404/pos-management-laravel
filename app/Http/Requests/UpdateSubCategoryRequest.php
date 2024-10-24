<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|min:3|max:50|string',
            'category_id' => 'required|numeric',
            'slug'        => 'required|min:3|max:50|string|unique:sub_categories,slug,'.$this->id,
            'description' => 'max:250|string',
            'serial'      => 'required|numeric',
            'status'      => 'required|numeric',
        ];
    }
}
