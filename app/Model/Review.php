<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'product_id',
        'review',
        'star',
    ];
    protected $primaryKey = 'id';
    protected $table = 'reviews';
    protected $dates = ['deleted_at'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
