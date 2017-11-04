<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'short_name' => 'max:5',
            'slug' => 'max:30',
            'meta_title' => 'max:60',
            'meta_description' => 'max:60',
            'image' => 'image',
            'description' => '',
            'popular' => 'boolean',
            'company' => 'required|exists:companies,id',
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
            'short_name',
            'slug',
            'meta_title',
            'meta_description',
            'image',
            'description',
            'popular',
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
