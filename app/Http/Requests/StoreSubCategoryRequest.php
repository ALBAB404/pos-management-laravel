<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'        => 'required|min:3|max:50|string',
            'category_id' => 'required|numeric',
            'slug'        => 'required|min:3|max:50|string|unique:sub_categories',
            'description' => 'max:250|string',
            'serial'      => 'required|numeric',
            'status'      => 'required|numeric',
        ];
    }
}
