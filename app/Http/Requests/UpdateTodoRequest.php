<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'priority' => 'integer|between:1,5',
            'title' => 'max:255',
            'description' => 'max:400',
            'parent_todo_id' => 'integer|nullable',
            'done' => 'boolean'
        ];
    }
}
