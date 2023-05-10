<?php

namespace App\Models\Admin;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProduct extends Model
{
    protected $table = 'product';
    public $uarded = [];
    protected $fillable = ['name'];

    public static function getListProduct()
    {
        $dataPoduct = AdminProduct::orderBy('created_at','DESC')->paginate(20);
        return $dataPoduct;
    }

    // public static function boot()
    // {

    // }
}
