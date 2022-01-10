<?php

namespace App\Http\Requests\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'logo' => 'mimes:jpg,jpeg,png,gif',
            'name' => 'required',
            'address' => 'required',
            'copy_right' => 'required',
            'intro' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'logo.mimes' => 'Định dạng ảnh không hợp lệ!',
            'name.required' => 'Không được để trống trường này!',
            'address.required' => 'Không được để trống trường này!',
            'copy_right.required' => 'Không được để trống trường này!',
            'intro.required' => 'Không được để trống trường này!',
        ];
    }
}
