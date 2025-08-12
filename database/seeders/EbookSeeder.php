<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ebook;

class EbookSeeder extends Seeder
{
    public function run(): void
    {
        $ebooks = [
            [
                'title' => 'Panduan Lengkap Umroh untuk Pemula',
                'description' => 'Ebook lengkap yang membahas semua hal yang perlu diketahui sebelum berangkat umroh.',
                'file_path' => 'ebooks/panduan-umroh-pemula.pdf',
                'is_active' => true,
            ],
            [
                'title' => 'Doa-doa Haji dan Umroh',
                'description' => 'Kumpulan doa-doa penting yang dibaca saat melaksanakan ibadah haji dan umroh.',
                'file_path' => 'ebooks/doa-haji-umroh.pdf',
                'is_active' => true,
            ],
            [
                'title' => 'Tips Persiapan Haji',
                'description' => 'Tips dan trik persiapan fisik, mental, dan spiritual sebelum berangkat haji.',
                'file_path' => 'ebooks/tips-persiapan-haji.pdf',
                'is_active' => true,
            ],
            [
                'title' => 'Sejarah Masjidil Haram dan Masjid Nabawi',
                'description' => 'Mengenal sejarah dan keistimewaan dua masjid suci umat Islam.',
                'file_path' => 'ebooks/sejarah-masjid-suci.pdf',
                'is_active' => true,
            ],
        ];

        foreach ($ebooks as $ebook) {
            Ebook::create($ebook);
        }
    }
}