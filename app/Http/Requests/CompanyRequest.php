<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CompanyRequest extends FormRequest
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
            "name" => [
                "required",
                // Rule::unique('user_recruitment')->ignore($this->id)
            ],
            "avatar" => [
                "mimes:jpg,png,jepg"
            ],
            "image" => [
                "mimes:jpg,png,jepg"
            ],
            "banner" => [
                "mimes:jpg,png,jepg"
            ],
            "company_size" => [
                "required"
            ],
            "phone" => [
                "required",
                "max:12"
            ],
            "tax_code" => [
                "required",
                "integer"
            ],
            "intro" => [
                "required",
            ],
            "detail" => [
                "required"
            ],
            "address" => [
                "required"
            ],
            "map" => [
                "required"
            ],
            "slug" => [
                "required",
                "max:100",
                Rule::unique('user_recruitment')->ignore($this->id)
            ],
            "link_website" => [
                "required",
                "max:100"
            ],
            "date_start" => [
                "required"
            ],
            "cate_id" => [
                "required",
            ],
            "location_id" => [
                "required",
            ],
            "file" => [
                "mimes:jpg,png,jepg,pdf,docx,zip"
            ]
        ];


        return $formRules;
    }
    public function messages()
    {
        return [
            "name.required" => "Bạn hãy nhập tên công ty",
            'name.unique' => "Tên này đã tồn tại.Xin mời nhập tên khác",
            "location_id.required" => "Bạn hãy chọn địa điểm",
            "cate_id.required" => "Bạn hãy chọn danh mục",
            "avatar.mimes" => "Bạn hãy chọn avatar đúng định dạng",
            "image.mimes" => "Bạn hãy chọn ảnh đúng định dạng",
            "banner.mimes" => "Bạn hãy nhập banner đúng định dạng",
            "file.mimes" => "Bạn hãy nhập file đúng định dạng",
            "company_size.required" => "Bạn hãy chọn quy mô công ty",
            "phone.required" => "Bạn hãy nhập số điện thoại",
            "phone.max" => "Bạn hãy nhập số điện thoại không quá 12 số",
            "tax_code.required" => "Bạn hãy nhập mã số thuế",
            "date_start.required" => "Bạn hãy chọn ngày thành lập công ty",
            "intro.required" => "Bạn hãy nhập mô tả ngắn",
            "detail.required" => "Bạn hãy nhập giới thiệu về công ty",
            "address.required" => "Bạn hãy nhập Địa chỉ",
            "map.required" => "Bạn hãy nhập map",
            "slug.required" => "Bạn hãy nhập đường dẫn",
            "slug.max" => "Bạn hãy nhập đường dẫn không quá 100 kí tự",
            "slug.unique" => "Đường đã tồn tại vui lòng nhập lại",
            "link_website.required" => "Bạn hãy thêm link Website",
            "link_website.max" => "Bạn hãy nhập Link website không quá 100 kí tự",
            "integer" => ":attributes Bạn phải nhập số!"
        ];
    }
}
