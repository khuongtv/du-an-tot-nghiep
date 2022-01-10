<?php

namespace App\Http\Requests\Keyword;

use Illuminate\Foundation\Http\FormRequest;

class AddKeywordRequest extends FormRequest
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
            'keyword' => 'required|max:50|unique:keywords',
        ];
    }
    public function messages()
    {
        return [
            'keyword.required' => 'Không được để trống trường này!',
            'keyword.max' => 'Trường này không được quá 50 kí tự!',
            'keyword.unique' => 'Từ khóa đã tồn tại!',
        ];
    }
}
