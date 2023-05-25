<?php

namespace App\Models\Admin;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUnit extends Model
{
    protected $table = 'phv_unit';
    protected $primaryKey = 'id';
    public $uarded = [];
    protected $fillable = ['name'];

    public static function getListUnit($dataSearch)
    {
        $keyword = $dataSearch['keyword'];
        $unitList = new AdminUnit();
        if ($keyword) {
            $unitList = $unitList->where('name', 'like', '%' . $keyword . '%');
                // ->orWhere('code', 'like', '%' . $keyword . '%');
        }
        $unitList = $unitList->orderBy('id','DESC')->paginate(10);
        return $unitList;
    }
}
