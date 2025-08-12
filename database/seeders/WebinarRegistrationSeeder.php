<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebinarRegistration;

class WebinarRegistrationSeeder extends Seeder
{
    public function run(): void
    {
        $registrations = [
            [
                'name' => 'Ahmad Fauzi',
                'gender' => 'male',
                'email' => 'ahmad.fauzi@email.com',
                'whatsapp' => '6281234567890',
                'city' => 'Jakarta',
                'source' => 'instagram',
            ],
            [
                'name' => 'Siti Aminah',
                'gender' => 'female',
                'email' => 'siti.aminah@email.com',
                'whatsapp' => '6281234567891',
                'city' => 'Bandung',
                'source' => 'whatsapp',
            ],
            [
                'name' => 'Muhammad Rizki',
                'gender' => 'male',
                'email' => 'muhammad.rizki@email.com',
                'whatsapp' => '6281234567892',
                'city' => 'Surabaya',
                'source' => 'facebook',
            ],
            [
                'name' => 'Fatimah Zahra',
                'gender' => 'female',
                'email' => 'fatimah.zahra@email.com',
                'whatsapp' => '6281234567893',
                'city' => 'Medan',
                'source' => 'instagram',
            ],
            [
                'name' => 'Abdullah Rahman',
                'gender' => 'male',
                'email' => 'abdullah.rahman@email.com',
                'whatsapp' => '6281234567894',
                'city' => 'Yogyakarta',
                'source' => 'whatsapp',
            ],
        ];

        foreach ($registrations as $registration) {
            WebinarRegistration::create($registration);
        }
    }
}