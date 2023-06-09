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
        $categoryList = new AdminCategory();
        if ($keyword) {
            $categoryList = $categoryList->where('name', 'like', '%' . $keyword . '%');
                // ->orWhere('code', 'like', '%' . $keyword . '%');
        }
        $categoryList = $categoryList->orderBy('id','DESC')->paginate(10);
        return $categoryList;
    }
    // public static function boot()
    // {

    // }
}
