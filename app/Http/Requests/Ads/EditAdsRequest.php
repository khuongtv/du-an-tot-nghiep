<?php

namespace App\Http\Requests\Ads;

use Illuminate\Foundation\Http\FormRequest;

class EditAdsRequest extends FormRequest
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
            'image' => 'mimes:jpg,jpeg,png,gif',
            'price' => 'required|numeric',
            'from_time' => 'required',
            'to_time' => 'required',
            'link' => 'required',
            'alt' => 'required|max:100',
        ];
    }
    public function messages()
    {
        return [
            'image.mimes' => 'Định dạng ảnh không hợp lệ!',
            'price.required' => 'Không được để trống trường này!',
            'price.numeric' => 'Trường này phải là số!',
            'from_time.required' => 'Không được để trống trường này!',
            'to_time.required' => 'Không được để trống trường này!',
            'link.required' => 'Không được để trống trường này!',
            'alt.required' => 'Không được để trống trường này!',
            'alt.max' => 'Trường này không được quá 100 kí tự!',
        ];
    }
}
