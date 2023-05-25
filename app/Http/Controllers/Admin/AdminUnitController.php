<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\AdminUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelIgnition\FlareMiddleware\AddJobs;

class AdminUnitController extends Controller
{
    public function index()
    {
        $dataSearch['keyword'] = request('keyword') ?? '';
        $dataTmp = AdminUnit::getListUnit($dataSearch);
        return view('admin.unit.index',compact('dataTmp'));
    }

    public function postCreateUnit(Request $request)
    {
        $data = $request->all();
        $listNameUnit = AdminUnit::get()->pluck('name')->toArray();
        if(in_array($data['name'], $listNameUnit)) {
            return response()->json(['error' => 1, 'message' => 'Tên đơn vị đã tồn tại']);
        }
        $dataInsert = [
            'name' => $data['name'],
            'status' => $data['status']
        ];
        $result = (new AdminUnit())->insert($dataInsert);
        if($result) {
            return response()->json(['error' => 0, 'message' => 'Thêm thành công']);
        } else {
            return response()->json(['error' => 1, 'message' => 'Đã có lỗi xãy ra']);
        }

    }
    public function postUpdateUnit(Request $request) {
        $data = $request->all();
        $listNameUnit = AdminUnit::whereNot('id', $data['id'])->get()->pluck('name')->toArray();
        if(in_array($data['name_edit'], $listNameUnit)) {
            return response()->json(['error' => 1, 'message' => 'Tên đơn vị đã tồn tại']);
        }
        $dataUpdate = [
            'name' => $data['name_edit'],
            'status' => $data['status']
        ];
        Log::info($dataUpdate);
        $result = (new AdminUnit())->find($data['id'])->update($dataUpdate);
        if($result) {
            return response()->json(['error' => 0, 'message' => 'Cập nhật thành công']);
        } else {
            return response()->json(['error' => 1, 'message' => 'Đã có lỗi xãy ra']);
        }
    }
    public function deleteUnit(Request $request) {
        $ids = $request->ids;
        $arrID = explode(',', $ids);
        Log::info($arrID);

        $result = (new AdminUnit())->destroy($arrID);

        if($result) {
            return response()->json(['error' => 0, 'message' => 'Xóa thành công']);
        } else {
            return response()->json(['error' => 1, 'message' => 'Đã có lỗi xãy ra']);
        }
    }
}
