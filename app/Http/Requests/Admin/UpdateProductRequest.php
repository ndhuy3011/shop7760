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
    public function messages()
    {
        return [
            'manhacungcap.required' => 'Mã nhà cung cấp bạn không được để trống',
            'tensanpham.required' => 'Tên sản phẩm bạn không được để trống',
            'tensanpham.required' => 'Tên sản phẩm bạn không được để trống',
            'danhmuc.required' => 'Danh mục sản phẩm bạn không được để trống',
            'giatien.required' => 'Giá tiền của bạn không được để trống',
            'giatien.numeric' => 'Giá tiền của bạn phải là số',
            'giatien.min' => 'Giá tiền phải trên 0 đồng',
            'giagiam.min' => 'Bạn phải nhập giảm giá trên 0 đồng',
            'giagiam.numeric' => 'Bạn nhấp số vào giảm giá',
            'motangan.max' => 'Bạn không được nhập mo tả ngắn quá già',
            'motangan.required' => 'Bạn không được để trống mo tả ngắn',
        ];
    }
}
