<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        // ===== ADMIN =====
        User::updateOrCreate(
            ['email' => 'quebac@gmail.com'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('123456789'),
                'role'     => 'admin',
                'phone'    => null,
                'hobbies'  => null,
                'avatar'   => null,
            ]
        );

        // ===== CUSTOMER =====
        User::updateOrCreate(
            ['email' => 'kietdz@gmail.com'],
            [
                'name'     => 'Customer User',
                'password' => Hash::make('987654321'),
                'role'     => 'customer',
                'phone'    => null,
                'hobbies'  => null,
                'avatar'   => null,
            ]
        );
    }
}
