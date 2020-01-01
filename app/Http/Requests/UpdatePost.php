<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePost extends FormRequest
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
            'parent_id' => 'nullable|integer|exists:posts,id',
            'title' => 'required|string|max:75',
            'summary' => 'required|string',
            'published' => 'required|boolean',
            'content' => 'required|string',
        ];
    }
}
