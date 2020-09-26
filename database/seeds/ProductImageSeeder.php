<?php

use Illuminate\Database\Seeder;

use App\Models\ProductImage;

class ProductImageSeeder extends Seeder {
    public function run() {
        $images = [
            [
                'product_id' => 1,
                'file_name' => 'abc.jpg',
            ],
            [
                'product_id' => 1,
                'file_name' => 'pqr.jpg',
            ]
        ];

        foreach ($images as $key => $value) {
            ProductImage::create($value);
        }
    }
}