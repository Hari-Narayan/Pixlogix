<?php

use Illuminate\Database\Seeder;

use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder {
    public function run() {
        $categories = [
            [
                'product_id' => 1,
                'category_id' => 1,
            ],
            [
                'product_id' => 1,
                'category_id' => 2,
            ],
        ];

        foreach ($categories as $key => $value) {
            ProductCategory::create($value);
        }
    }
}