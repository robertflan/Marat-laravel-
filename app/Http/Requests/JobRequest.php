<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'slug' => 'max:30',
            'meta_title' => 'max:60',
            'meta_description' => 'max:60',
            'image' => 'image',
            'description' => '',
            'active' => 'boolean',
            'company' => 'required|exists:companies,id',
            'manager' => 'required|exists:users,id',
            'categories' => 'required|array|exists:categories,id',
            'questionnaires' => 'array',
            'location' => 'required|exists:locations,id',
            //'locations' => 'required|array|exists:locations,id',
            'tags' => 'array',
            'type' => [
                'required',
                Rule::in(config('enums.jobtypes')),
            ],
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name',
            'slug',
            'active',
            'meta_title',
            'meta_description',
            'image',
            'description',
            'company',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
