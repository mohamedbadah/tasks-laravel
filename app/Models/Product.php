<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    public function ProductDetails(){
        return $this->hasMany(Order_Product::class,'product_id','id');
    }
    public function subCategory(){
       return $this->belongsTo(Product::class,'sub_category_id','id');
    }
    public function orders(){
        return $this->belongsToMany(Order::class,Order_Product::class,'product_id','order_id');
    }
    public function information(){
        return $this->hasOne(product_Information::class,'product_id','id');
    }
    public function colors(){
     return $this->morphToMany(Color::class,'object','object_type','object_id','id');
    }
}
