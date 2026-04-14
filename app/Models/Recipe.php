<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function category(){
        return $this-> beLongsTo(category::class);
    }
    
}
