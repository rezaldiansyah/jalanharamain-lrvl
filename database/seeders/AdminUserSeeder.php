<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin utama
        User::create([
            'name' => 'Admin Web',
            'email' => 'adminweb@jalanharamain.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        // Admin tambahan
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@jalanharamain.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'admin',
        ]);

        // User agen sample
        User::create([
            'name' => 'Agen Jakarta',
            'email' => 'agen.jakarta@jalanharamain.com',
            'password' => Hash::make('agen123'),
            'role' => 'agen',
        ]);

        User::create([
            'name' => 'Calon Agen Bandung',
            'email' => 'calagen.bandung@jalanharamain.com',
            'password' => Hash::make('calagen123'),
            'role' => 'calagen-agen',
        ]);
    }
}