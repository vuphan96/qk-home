<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminProduct;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $dataTmp = AdminProduct::getListProduct();
        return view('admin.product.index',compact('dataTmp'));
    }
    public function createProduct()
    {
        $dataTmp = '';
        return view('admin.product.add', compact('dataTmp'));
    }
}
