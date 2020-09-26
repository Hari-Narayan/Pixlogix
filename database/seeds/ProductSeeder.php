<?php

use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder {
    public function run() {
        Product::create([
            'title' => 'Electronics',
            'sku' => 156465,
            'short_description' => 'kjdfngfsd jgjfd dfngkdf',
            'description' => '<p>kjdfngfsd jgjfd dfngkdf</p>',
            'status' => 1,
        ]);
    }
}