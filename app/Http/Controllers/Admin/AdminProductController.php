<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminProduct;
use App\Models\Admin\AdminCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Aler;
use Session;


class AdminProductController extends Controller
{
    public function index()
    {
        $dataTmp = AdminProduct::getListProduct();
        return view('admin.product.index',compact('dataTmp'));
    }
    public function createProduct()
    {
        $dataCategory = AdminCategory::get();
        return view('admin.product.add', compact('dataCategory'));
    }
    public function postCreateProduct(AdminProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $file_name = '';
            if($request->has('product_image'))
            {
                $file = $request->file('product_image')->store('public/files');
                $file_name = explode('/',$file);
                $file_name = end($file_name);
            }
            $data = $request->validated();
            $status = 0;
            if(isset($data['status'])) {
                $status = 1;
            }
            $dataInsert = [
                'name' => $data['product_name'],
                'code' => $data['product_code'],
                'price_in' => $data['price_in'],
                'price_out' => $data['price_out'],
                'image' => $file_name ,
                'product_unit' => $data['product_unit'],
                'cat_id' => $data['cat_id'],
                'status' => $status,
            ];
            AdminProduct::create($dataInsert);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.product.index')->with('msg', 'error');
        }
        return redirect()->route('admin.product.index')->with('msg', 'success');
    }
}
