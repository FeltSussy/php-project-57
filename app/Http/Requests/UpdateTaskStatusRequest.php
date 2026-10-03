<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskStatusRequest extends FormRequest
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
        $taskStatus = $this->route('task_status');

        return [
            'name' => [
                'required',
                Rule::unique('task_statuses', 'name')->ignore($taskStatus),
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => __('task_statuses.validation.name_unique'),
        ];
    }
}
