<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {
    use SoftDeletes;

    protected $fillable = ['title', 'sku', 'short_description', 'description', 'status'];

    public function images() {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function categories() {
        return $this->hasMany(ProductCategory::class, 'product_id');
    }
}
