<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\TravelPartner;
use Illuminate\Support\Facades\Hash;

class TravelPartnerSeeder extends Seeder
{
    public function run(): void
    {
        // Create travel users and their partners
        $travelData = [
            [
                'user' => [
                    'name' => 'PT Haji Umroh Berkah',
                    'email' => 'admin@hajiumrohberkah.com',
                    'password' => Hash::make('password123'),
                    'role' => 'travel',
                ],
                'partner' => [
                    'name' => 'PT Haji Umroh Berkah',
                    'description' => 'Travel haji dan umroh terpercaya dengan pengalaman lebih dari 10 tahun melayani jamaah Indonesia.',
                    'contact_person' => 'Ahmad Fauzi',
                    'phone' => '021-12345678',
                    'email' => 'admin@hajiumrohberkah.com',
                    'address' => 'Jl. Raya Haji No. 123, Jakarta Selatan, DKI Jakarta',
                    'ppiu_number' => 'PPIU-001/2023',
                    'pihk_number' => 'PIHK-001/2023',
                    'is_active' => true,
                ]
            ],
            [
                'user' => [
                    'name' => 'CV Wisata Islami Nusantara',
                    'email' => 'info@wisataislami.com',
                    'password' => Hash::make('password123'),
                    'role' => 'travel',
                ],
                'partner' => [
                    'name' => 'CV Wisata Islami Nusantara',
                    'description' => 'Spesialis tour wisata religi dan umroh dengan paket terjangkau dan pelayanan prima.',
                    'contact_person' => 'Siti Aminah',
                    'phone' => '022-87654321',
                    'email' => 'info@wisataislami.com',
                    'address' => 'Jl. Dago Raya No. 456, Bandung, Jawa Barat',
                    'ppiu_number' => 'PPIU-002/2023',
                    'pihk_number' => 'PIHK-002/2023',
                    'is_active' => true,
                ]
            ],
            [
                'user' => [
                    'name' => 'Madinah Travel',
                    'email' => 'cs@madinahtravel.com',
                    'password' => Hash::make('password123'),
                    'role' => 'travel',
                ],
                'partner' => [
                    'name' => 'Madinah Travel',
                    'description' => 'Travel umroh dan haji plus dengan fasilitas lengkap dan bimbingan spiritual.',
                    'contact_person' => 'Ustadz Abdullah',
                    'phone' => '031-11223344',
                    'email' => 'cs@madinahtravel.com',
                    'address' => 'Jl. Masjid Agung No. 789, Surabaya, Jawa Timur',
                    'ppiu_number' => 'PPIU-003/2023',
                    'pihk_number' => 'PIHK-003/2023',
                    'is_active' => true,
                ]
            ],
        ];

        foreach ($travelData as $data) {
            $user = User::create($data['user']);
            
            $partnerData = $data['partner'];
            $partnerData['user_id'] = $user->id;
            
            TravelPartner::create($partnerData);
        }
    }
}