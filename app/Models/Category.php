<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $fillable = ['title', 'parent_id', 'status'];

    function category(){
        return $this->hasMany('App\Models\Category', 'parent_id');
    }
}
