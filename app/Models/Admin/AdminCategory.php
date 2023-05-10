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

    public static function getListCategory()
    {
        $dataCategory = AdminCategory::orderBy('id','DESC')->paginate(10);
        return $dataCategory;
    }
    // public static function boot()
    // {

    // }
}
