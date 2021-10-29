<?php

namespace App\Http\Requests\ToDo;

use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class ToDoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    #[ArrayShape(['title' => "string[]", 'project' => "string[]", 'priority' => "string[]", 'dueDate' => "string[]", 'assign' => "string[]", 'description' => "string[]"])] public function rules(): array
    {
        if ($this->getMethod() == 'POST') {
            return [
                'title' => ['required', 'string', 'unique:to_dos,title'],
                'project' => ['required', 'numeric', 'exists:projects,id'],
                'priority' => ['required'],
                'dueDate' => ['required', 'date', 'after:today'],
                'assign' => ['required', 'exists:users,id'],
                'description' => ['required', 'string'],
            ];
        }

        return [
            'title' => ['required', 'string'],
            'project' => ['required', 'numeric', 'exists:projects,id'],
            'priority' => ['required'],
            'dueDate' => ['required', 'date', 'after:today'],
            'assign' => ['required', 'exists:users,id'],
            'description' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function validated(): array
    {
        return array_merge(parent::validated(), [
            'assigned_by_id' => $this->user()->id,
            'assigned_to_id' => $this->assign,
            'project_id' => $this->project,
        ]);
    }
}
