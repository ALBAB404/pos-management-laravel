<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
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
            'slug'        => 'required|min:3|max:50|string|unique:Categories,slug,'.$this->id,
            'description' => 'max:250|string',
            'serial'      => 'required|numeric',
            'status'      => 'required|numeric',
        ];
    }
}