<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
        $task = $this->route('task');

        return [
            'name' => [
                'required',
                Rule::unique('tasks', 'name')->ignore($task),
                'max:255',
            ],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'description' => ['nullable', 'max:1000'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],

            'labels' => ['nullable', 'array'],
            'labels.*' => ['required', 'exists:labels,id'],
        ];
    }
}
