<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {
    protected $fillable = ['product_id', 'category_id'];

    public function category() {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }
}