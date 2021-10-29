<?php

namespace App\Http\Requests\ToDo;

use Illuminate\Foundation\Http\FormRequest;

class ToDoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'unique:to_dos,title'],
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
