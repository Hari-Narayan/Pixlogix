<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder {
    public function run() {
        User::create([
            'first_name' => 'Hari',
            'last_name' => 'Narayan',
            'email' => 'admin@dinkar.com',
            'password' => 'Dinkar@123',
            'dailing_code' => '+91',
            'mobile_number' => '9316155166',
            'profile_photo' => 'avatar.jpg',
            'gender' => 1,
            'role_id' => 1,
            'is_email_verified' => 1,
            'status' => 1,
        ]);
    }
}