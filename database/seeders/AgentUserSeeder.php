<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AgentUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'agent@example.com'],
            [
                'name' => 'Agent Demo',
                'password' => Hash::make('password'),
                'role' => 'agent',
            ]
        );
    }
}