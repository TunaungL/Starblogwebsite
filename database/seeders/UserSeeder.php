<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        User::create([
            'id'   => '1',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // choose a secure password
            'role' => 'admin',
        ]);

        // Regular user
        User::create([
            'id'  => '2',
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'), // choose a secure password
            'role' => 'user',
        ]);
    }
}
