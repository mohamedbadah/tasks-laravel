<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $append=['status'];
    public function getStatusAttribute(){
        return $this->active ? 'active':'disable';
    }
    public function subCategories(){
        return $this->hasMany(SubCategory::class,'category_id','id');
    }
    public function products(){
        return $this->hasManyThrough(Product::class,SubCategory::class,'category_id','sub_category_id');
    }
    public function colors(){
        return $this->morphMany(Color::class,'object','object_type','object_id','id');
       }
    public function users(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault([
            'name'=>'Hayley Alford'
        ]);
    }
       public static function rules($id=null){
        return [
            'name'=>'required|min:2|max:20',
            'image'=>'required|image|mimes:jpg,png,max:2040'
        ];
    }
}
