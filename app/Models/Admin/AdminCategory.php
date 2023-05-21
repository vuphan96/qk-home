<?php

namespace App\Models\Admin;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminCategory extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    public $uarded = [];
    protected $fillable = ['name'];

    public static function getListCategory($dataSearch)
    {
        $keyword = $dataSearch['keyword'];
        $customerList = new AdminCategory();
        if ($keyword) {
            $customerList = $customerList->where('name', 'like', '%' . $keyword . '%');
                // ->orWhere('code', 'like', '%' . $keyword . '%');
        }
        $customerList = $customerList->orderBy('id','DESC')->paginate(10);
        return $customerList;
    }
    // public static function boot()
    // {

    // }
}
