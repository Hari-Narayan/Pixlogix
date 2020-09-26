<?php

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategorySeeder extends Seeder {
    public function run() {
        $categories = [
            [
                'title' => 'Electronics',
                'parent_id' => 0,
                'status' => 1,
            ],
            [
                'title' => 'Mobile',
                'parent_id' => 1,
                'status' => 1,
            ],
        ];

        foreach ($categories as $key => $value) {
            Category::create($value);
        }
    }
}