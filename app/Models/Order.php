<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function orderDetails(){
        return $this->hasMany(Order_Product::class,'order_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function products(){
        return $this->belongsToMany(Product::class,Order_Product::class,'order_id','product_id')
        ->withPivot('item_price');
    }
    // public function products(){
    //     return $this->hasManyThrough(Product::class,Order_Product::class,'order_id','product_id');
    // }
    public function colors(){
        return $this->morphToMany(Color::class,'object','object_type','object_id','id');
       }
}
