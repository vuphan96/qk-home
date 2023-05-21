<?php

namespace App\Models\Admin;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AdminProduct extends Model
{
    protected $table = 'product';
    protected $guarded = [];
     /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    public static function getListProduct()
    {
        $dataPoduct = AdminProduct::orderBy('created_at','DESC')->paginate(20);
        return $dataPoduct;
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
