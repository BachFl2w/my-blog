<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePost extends FormRequest
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
            'category_id' => 'nullable|exists:categories,id',
            'tag_id' => 'nullable|exists:tags,id',
            'category_id' => 'nullable|exists:categories,id',
            'parent_id' => 'nullable|integer|exists:posts,id',
            'title' => 'required|string|max:75',
            'summary' => 'required|string',
            'published' => 'required|boolean',
            'content' => 'required|string',
            'tag.*.id' => 'required|exists:tags',
            'category.*id' => 'required|exists:categories',
        ];
    }
}
