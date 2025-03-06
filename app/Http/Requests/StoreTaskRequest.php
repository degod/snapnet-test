<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
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
        $statusOptions = array_map(fn($status) => str_replace('_', '-', $status), array_keys(task_statuses()));

        return [
            'title' => 'required|string|max:255|unique:tasks,title',
            'description' => 'required|string|max:255',
            'status' => ['required', Rule::in($statusOptions)],
            'project_id' => 'required|exists:projects,id',
            'due_date' => 'required|date|after_or_equal:today',
        ];
    }

    /**
     * Get the custom messages for validation errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The task title is required.',
            'title.unique' => 'This task title already exists. Please choose another one.',
            'description.required' => 'The task description is required.',
            'status.required' => 'The task status is required.',
            'status.in' => 'Invalid status provided. Allowed statuses: ' . implode(', ', array_keys(task_statuses())),
            'project_id.required' => 'The project ID is required.',
            'project_id.exists' => 'The selected project ID does not exist.',
            'due_date.required' => 'The due date is required.',
            'due_date.date' => 'The due date must be a valid date.',
            'due_date.before_or_equal' => 'The due date cannot be later than today.',
        ];
    }
}
