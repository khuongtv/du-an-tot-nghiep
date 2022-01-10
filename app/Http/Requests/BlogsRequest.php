<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogsRequest extends FormRequest
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
        $formRules = [
            "title" => [
                "required",
                "max:100",
            ],
            "file_upload" => [
                "mimes:jpg,png,jepg"
            ],
            "deadline" => [
                "required",
            ],
            "detail" => [
                "required",
            ],
            "slug" => [
                "required",
                "max:100",
                Rule::unique('blogs')->ignore($this->id)
            ],
            "salary_min" => [
                "required",
                "integer",
                "min:0",
                "lte:salary_max"
            ],
            "salary_max" => [
                "required",
                "integer",
                "min:0"
            ],
            "working_time" => [
                "required"
            ],
            "quantity" => [
                "required",
                "integer",
                "min:0"
            ],
            "position" => [
                "required",
            ],
            "exp" => [
                "required",
            ],
            "gender" => [
                "required",
            ],
            "cate_id" => [
                "required",
            ],
            "location_id" => [
                "required",
            ]
        ];
        if ($this->id == null) {
            $formRules['file_upload'][] = "required";
        }
        return $formRules;
    }
    public function messages()
    {
        return [
            "title.required" => "Bạn hãy nhập tiêu đề",
            "title.max" => "Tiêu đề không được quá 100 kí tự!",
            "file_upload.required" => "Bạn hãy nhập image",
            "file_upload.mimes" => "Ảnh không đúng định dạng",
            "detail.required" => "Bạn hãy nhập detail",
            "slug.required" => "Bạn hãy nhập slug",
            "slug.max" => "slug không được quá 100 kí tự!",
            "slug.unique" => "đường dẫn này bị trùng lặp",
            "salary_max.required" => "Bạn hãy nhập lương ",
            "salary_max.min" => "Bạn hãy nhập mức lương lớn hơn",
            "salary_min.required" => "Bạn hãy nhập lương ",
            'salary_min.lte' => 'Trường này phải nhỏ hơn mức lương lớn nhất!',
            "working_time.required" => "Bạn hãy chọn hình thức làm việc",
            "quantity.required" => "Bạn hãy nhập số lượng cần tuyển",
            "salary_min.min" => "Bạn hãy nhập mức lương lớn hơn",
            "position.required" => "Bạn hãy nhập chức vụ",
            "exp.required" => "Bạn hãy nhập kinh nghiệm",
            "gender.required" => "Bạn hãy chọn giới tính",
            "cate_id.required" => "Bạn hãy chọn Danh mục",
            "location_id.required" => "Bạn hãy chọn Địa điểm",
            "deadline.required" => "Bạn hãy nhập deadline",
            'integer' => ':attributes Trường này phải là số dương!',
        ];
    }
}
