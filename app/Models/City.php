<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    // protected $append=["status"];
    public function getStatusAttribute(){
        return $this->active ? "active":"disable";
    }
    
}
