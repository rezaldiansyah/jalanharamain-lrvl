<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Web',
            'email' => 'adminweb@jalanharamain.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);
    }
}