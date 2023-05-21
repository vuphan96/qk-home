<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminCatController extends Controller
{
    public function index()
    {
        $dataSearch['keyword'] = request('keyword') ?? '';
        $dataTmp = AdminCategory::getListCategory($dataSearch);
        return view('admin.cat.index',compact('dataTmp'));
    }

    public function postCreateCategory(Request $request)
    {
        $data = $request->all();
        $listNameCat = AdminCategory::get()->pluck('name')->toArray();
        if(in_array($data['name'], $listNameCat)) {
            return response()->json(['error' => 1, 'message' => 'Tên danh mục đã tồn tại']);
        }
        $dataInsert = [
            'name' => $data['name'],
            'status' => $data['status'],
            'create_by' => 'Admin'
        ];
        $result = (new AdminCategory())->insert($dataInsert);
        if($result) {
            return response()->json(['error' => 0, 'message' => 'Thêm thành công']);
        } else {
            return response()->json(['error' => 1, 'message' => 'Đã có lỗi xãy ra']);
        }

    }
    public function updateCategory(Request $request) {
        $data = $request->all();
        $listNameCat = AdminCategory::whereNot('id', $data['id'])->get()->pluck('name')->toArray();
        if(in_array($data['name_edit'], $listNameCat)) {
            return response()->json(['error' => 1, 'message' => 'Tên danh mục đã tồn tại']);
        }
        $dataUpdate = [
            'name' => $data['name_edit'],
            'status' => $data['status']
        ];
        Log::info($dataUpdate);
        $result = (new AdminCategory())->find($data['id'])->update($dataUpdate);
        if($result) {
            return response()->json(['error' => 0, 'message' => 'Cập nhật thành công']);
        } else {
            return response()->json(['error' => 1, 'message' => 'Đã có lỗi xãy ra']);
        }
    }
    public function deleteCategory(Request $request) {
        $ids = $request->ids;
        $arrID = explode(',', $ids);
        Log::info($arrID);

        $result = (new AdminCategory())->destroy($arrID);

        if($result) {
            return response()->json(['error' => 0, 'message' => 'Xóa thành công']);
        } else {
            return response()->json(['error' => 1, 'message' => 'Đã có lỗi xãy ra']);
        }
    }
    public function getImport(){
        return view('admin.cat.import_list_cat');
    }
}
