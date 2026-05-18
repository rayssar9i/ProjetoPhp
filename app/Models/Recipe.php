<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public function category(){
        return $this-> beLongsTo(category::class);
    }
    protected $fillable = ['title', 'ingredients', 'instructions', 'image', 'category_id', 'user_id', 'status', 'rejection_reason', 'approved_by', 'approved_at'];

    public function scopePending($query){
        return $query ->where('status', 'pending');
    }
    public function scopeApproved($query){
        return $query -> where('satus', 'approved');
    }
    public function approver(){
        return $this ->belongsTo(User::class, 'approved_by');
    }
    public function author(){
        return $this -> belongsto(User:: class, 'user_id');
    }
}
