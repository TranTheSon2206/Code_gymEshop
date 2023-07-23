<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;

    protected $table = 'product_comments';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function product(){
        return $this->belongsto(Product::class,'product_id','id');
    }

    public function user(){
        return $this->belongsto(User::class,'user_id','id');
    }
}
