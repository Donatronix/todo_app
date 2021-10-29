<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        if ($this->getMethod() == 'POST') {
            return [
                'title' => ['required', 'string', 'unique:projects,title'],
                'description' => ['required', 'string'],
            ];
        }
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function validated(): array
    {
        return array_merge(parent::validated(), [
            'user_id' => $this->user()->id,
        ]);
    }
}
