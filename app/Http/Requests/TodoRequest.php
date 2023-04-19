<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'description' => 'nullable',
            'due_date' => 'required|date|after:yesterday',
            'priority' => 'required|in:high,medium,low',
            'user_ids' => 'required|exists:users,id',
        ];
    }
}
