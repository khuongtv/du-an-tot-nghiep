<?php

namespace App\Http\Requests\Review;

use Illuminate\Foundation\Http\FormRequest;

class EditReviewRequest extends FormRequest
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
            'avatar' => 'mimes:jpg,jpeg,png,gif',
            'name' => 'required|max:50',
            'work' => 'required|max:50',
            'content' => 'required|max:500',
        ];
    }
    public function messages()
    {
        return [
            'avatar.mimes' => 'Định dạng ảnh không hợp lệ!',
            'name.required' => 'Không được để trống trường này!',
            'name.max' => 'Trường này không được quá 50 kí tự!',
            'work.max' => 'Trường này không được quá 50 kí tự!',
            'work.required' => 'Không được để trống trường này!',
            'content.max' => 'Trường này không được quá 50 kí tự!',
            'content.required' => 'Không được để trống trường này!',
        ];
    }
}
