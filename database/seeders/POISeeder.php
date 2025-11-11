<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Poi;

class POISeeder extends Seeder
{
    public function run(): void
    {
        $pois = [
            [
                'name' => 'Masjid al-Haram',
                'slug' => 'masjid-al-haram',
                'category' => 'mosque',
                'city' => 'makkah',
                'lat' => 21.422487,
                'lng' => 39.826206,
                'address' => 'Makkah',
                'description' => 'Masjid terbesar di dunia, pusat Ka\'bah.',
                'priority' => 100,
                'is_active' => true,
            ],
            [
                'name' => 'Gerbang Raja Abdul Aziz',
                'slug' => 'king-abdul-aziz-gate',
                'category' => 'gate',
                'city' => 'makkah',
                'lat' => 21.420657,
                'lng' => 39.826179,
                'address' => 'Masjid al-Haram',
                'description' => 'Gerbang utama menuju Masjid al-Haram.',
                'priority' => 80,
                'is_active' => true,
            ],
            [
                'name' => 'Jabal Arafah (Arafat)',
                'slug' => 'mount-arafat',
                'category' => 'site',
                'city' => 'makkah',
                'lat' => 21.355820,
                'lng' => 39.984928,
                'address' => 'Arafat, Makkah',
                'description' => 'Lokasi wukuf saat haji.',
                'priority' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Masjid Nabawi',
                'slug' => 'masjid-nabawi',
                'category' => 'mosque',
                'city' => 'madinah',
                'lat' => 24.467240,
                'lng' => 39.611353,
                'address' => 'Madinah',
                'description' => 'Masjid kedua paling suci dalam Islam.',
                'priority' => 100,
                'is_active' => true,
            ],
            [
                'name' => 'Makam Baqi',
                'slug' => 'jannat-al-baqi',
                'category' => 'cemetery',
                'city' => 'madinah',
                'lat' => 24.467947,
                'lng' => 39.614830,
                'address' => 'Dekat Masjid Nabawi',
                'description' => 'Pemakaman bersejarah di Madinah.',
                'priority' => 70,
                'is_active' => true,
            ],
        ];

        foreach ($pois as $poi) {
            Poi::updateOrCreate(['slug' => $poi['slug']], $poi);
        }
    }
}