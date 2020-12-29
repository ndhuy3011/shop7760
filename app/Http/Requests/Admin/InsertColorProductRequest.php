<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InsertColorProductRequest extends FormRequest
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
            //
            'color' => 'required',
            'kichthuoc.*'=>'required|min:0|numeric'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'color.required' => 'Bạn phải nhập màu',
            'kichthuoc.*.required'=>'Bạn nhập Số lượng',
            'kichthuoc.*.min'=>'Bạn nhập Số lượng lớn hơn 0',
            'kichthuoc.*.numeric'=>'Bạn nhập Số lượng bàng số',
        ];
    }
}
