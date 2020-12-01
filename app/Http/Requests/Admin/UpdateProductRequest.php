<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
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
            'manhacungcap' => 'required',
            'tensanpham' => 'required',
            'danhmuc' => 'required',
            'giatien' => 'required|numeric|min:0',
            'giagiam' => 'min:0|numeric',
            'trangthai' => 'required',
            'motangan' => 'max:255|string|required',
            'mota' => 'required|string',
        ];
    }
}
