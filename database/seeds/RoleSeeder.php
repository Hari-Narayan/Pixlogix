<?php

use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder {
    public function run() {
        $data = [
            [
                'name' => 'Admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Suppliers',
                'guard_name' => 'web'
            ],
        ];

        foreach ($data as $value) {
            Role::create($value);
        }
    }
}