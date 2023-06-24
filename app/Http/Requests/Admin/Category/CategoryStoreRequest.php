<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'slug' => ['required'],
            'cat_type' => ['required'],
            'parent_id' => ['required'],
            'url' => ['required'],
            'meta_title' => 'required',
            'meta_description' => 'nullable|max:155',
            'is_active' => 'required'
        ];
    }
}
