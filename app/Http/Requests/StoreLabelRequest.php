<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreLabelRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:labels', 'max:255'],
            'description' => ['nullable', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => __('labels.validation.unique'),
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('labels.attributes.name'),
        ];
    }
}
