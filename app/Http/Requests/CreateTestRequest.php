<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTestRequest extends FormRequest
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
            'participant_id' => 'uuid|required',
            'question1' => 'integer|required',
            'question2' => 'integer|required',
            'question3' => 'integer|required',
            'question4' => 'integer|required',
            'question5' => 'integer|required',
            'question6' => 'integer|required',
            'question7' => 'integer|required',
            'question8' => 'integer|required',
            'question9' => 'integer|required',
            'time_since_start' => 'integer|required',
        ];
    }
}
