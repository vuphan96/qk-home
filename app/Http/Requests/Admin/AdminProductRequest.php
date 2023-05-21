<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Admin\AdminProduct;
use Symfony\Component\HttpFoundation\Request;


class AdminProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {

        if($request->id){
            $id = $request->id;
            return [
                "product_name" => 'required|unique:"' . AdminProduct::class . '",name',
                "product_code" => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"' . AdminProduct::class . '",code,' . $id . ',id',
                "price_in"     => 'required|numeric',
                "price_out"    => 'required|numeric',
                "product_image" => 'nullable|mimes:jpeg,jpg,png,gif',
                "cat_id"        => 'required',
                "product_unit"  => 'required',
                "status"        => "nullable"
            ];
        }else{
            return [
                "product_name" => 'required|unique:"' . AdminProduct::class . '",name',
                "product_code" => 'required|regex:/(^([0-9A-Za-z\-_]+)$)/|unique:"' . AdminProduct::class . '",code',
                "price_in"     => 'required|numeric',
                "price_out"    => 'required|numeric',
                "product_image" => 'nullable|mimes:jpeg,jpg,png,gif',
                "cat_id"        => 'required',
                "product_unit"  => 'required',
                "status"        => "nullable",
            ];
        }
    }
    public function messages()
    {
        return [
            "product_name.required" => 'Tên sản phẩm không được để trống',
            "product_name.unique"   => 'Tên sản phẩm đã tồn tại',
            "product_code.required" => 'Mã sản phẩm không được để trống',
            "product_code.regex"    => 'Mã sản phẩm không hợp lệ',
            "product_code.unique"   => 'Mã sản phẩm đã tồn tại',
            "price_in.required"     => 'Vui lòng điền giá nhập',
            "price_out.required"    => 'Vui lòng điền giá bán',
            "product_image.mimes"   => 'Định dạng file không hợp lệ',
            "cat_id.required"       => 'Vui lòng chọn danh mục sản phẩm',
            "product_unit.required" => 'Vui lòng chọn đơn vị sản phẩm',
        ];
    }
}
