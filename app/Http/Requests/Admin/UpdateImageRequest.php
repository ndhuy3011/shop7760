<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            if (Auth::user()->authorities == 1) {
                return true;
            } else {
                if (Auth::user()->authorities == 1) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'hinh' => 'required',
            'hinh.*' => 'image|mimes:jpeg,jpg,png,gif,webp',
        ];
    }
    public function messages()
    {
        return [
            'hinh.required' => 'Bạn không được để trống hình',
            'hinh.*.image' => 'Gửi file hình ảnh không hợp lệ',
        ];
    }
}
