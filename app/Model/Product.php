<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'detail',
        'price',
        'stock',
        'discount',
    ];
    protected $primaryKey = 'id';
    protected $table = 'products';
    protected $dates = ['deleted_at'];

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
