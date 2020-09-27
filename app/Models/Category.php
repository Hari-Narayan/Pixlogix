<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model {
    use SoftDeletes;

    protected $fillable = ['title', 'parent_id', 'status'];

    function subCategory(){
        return $this->hasMany('App\Models\Category', 'parent_id');
    }
}
