<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class AddBlogRequest extends FormRequest
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
            'title' => 'required|max:100',
            'user_recruitment_id' => 'required|integer',
            'deadline' => 'required',
            'detail' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'slug ' => 'required|max:100',
            'salary_max' => 'required|max:9|integer',
            'salary_min' => 'required|max:9|integer|lte:salary_max',
            'working_time' => 'required',
            'quantity' => 'required|integer',
            'position' => 'required|integer',
            'exp' => 'required',
            'gender' => 'required',
            'cate_id ' => 'required',
            'location_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Không được để trống trường này!',
            'user_recruitment_id.required' => 'Không được để trống trường này!',
            'deadline.required' => 'Không được để trống trường này!',
            'detail.required' => 'Không được để trống trường này!',
            'slug.required' => 'Không được để trống trường này!',
            'salary_max.required' => 'Không được để trống trường này!',
            'salary_min.required' => 'Không được để trống trường này!',
            'working_time.required' => 'Không được để trống trường này!',
            'quantity.required' => 'Không được để trống trường này!',
            'position.required' => 'Không được để trống trường này!',
            'gender.required' => 'Không được để trống trường này!',
            'cate_id.required' => 'Không được để trống trường này!',
            'location_id.required' => 'Không được để trống trường này!',
            'exp.required' => 'Không được để trống trường này!',
            'image.required' => 'Không được để trống trường này!',
            'title.max' => 'Tiêu đề không được quá 100 kí tự!',
            'slug.max' => 'Đường dẫn không được quá 100 kí tự!',
            'salary_max.max' => 'Trường này không được quá 9 kí tự!',
            'salary_min.max' => 'Trường này không được quá 9 kí tự!',
            'salary_mmin.lte' => 'Trường này phải nhỏ hơn mức lương lớn nhất!',
            'integer' => ':attributes Trường này phải là số dương!',
        ];
    }
}
