<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionnaireRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'description' => 'required|string',
            'question_titles' => 'required|array|min:1',
            'question_titles.*' => 'required|string', 
            'types' => 'required|array|min:1', 
            'types.*' => 'required|string', 
            'options' => 'array',
            'options.*' => 'string|nullable|required_if:types.*,dropdown', 
        ];
    }
}
