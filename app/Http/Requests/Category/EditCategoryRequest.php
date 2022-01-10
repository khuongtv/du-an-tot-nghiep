<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
            'name' => 'required|max:50|unique:categories',
            'slug' => 'required|max:50|unique:categories',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Trường này không được để trống!',
            'name.max' => 'Trường này không được quá 50 kí tự!',
            'name.unique' => 'Trường này vẫn chưa được thay đổi!',
            'slug.required' => 'Trường này không được để trống!',
            'slug.max' => 'Trường này không được quá 50 kí tự!',
            'slug.unique' => 'Trường này vẫn chưa được thay đổi!',
        ];
    }
}
