<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Same demo admin account referenced on the original login page.
        User::firstOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@demo.com'],
            [
                'name' => 'Demo User',
                'password' => Hash::make('user1234'),
                'role' => 'user',
            ]
        );
    }
}
