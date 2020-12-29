<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSizeRequest extends FormRequest
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
            'kichthuoc'=>'required|min:0|numeric'
        ];
    }
    public function messages()
    {
        return [
            'kichthuoc.required' => 'Bạn nhập Số lượng',
            'kichthuoc.min' => 'Bạn nhập Số lượng lớn hơn 0',
            'kichthuoc.numeric' => 'Bạn nhập Số lượng bàng số ',
        ];
    }
}
