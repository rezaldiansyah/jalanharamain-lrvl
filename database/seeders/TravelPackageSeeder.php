<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TravelPartner;
use App\Models\TravelPackage;
use Carbon\Carbon;

class TravelPackageSeeder extends Seeder
{
    public function run(): void
    {
        $partners = TravelPartner::all();
        
        foreach ($partners as $partner) {
            // Create multiple packages for each partner
            $packages = [
                [
                    'name' => 'Paket Umroh Ekonomis 9 Hari',
                    'description' => 'Paket umroh ekonomis dengan fasilitas lengkap, hotel bintang 3, dan bimbingan spiritual.',
                    'destination' => 'Makkah - Madinah',
                    'duration_days' => 9,
                    'price' => 25000000,
                    'start_date' => Carbon::now()->addMonths(2),
                    'end_date' => Carbon::now()->addMonths(2)->addDays(8),
                    'max_participants' => 45,
                    'itinerary' => "Hari 1-3: Makkah (Tawaf, Sai, Ibadah di Masjidil Haram)\nHari 4-6: Madinah (Ziarah Masjid Nabawi, Raudhah)\nHari 7-9: Makkah (Tawaf Wada, Persiapan Pulang)",
                    'includes' => 'Tiket pesawat PP, Hotel 3*, Makan 3x sehari, Transport AC, Bimbingan manasik, Perlengkapan umroh',
                    'excludes' => 'Visa (ditanggung travel), Asuransi perjalanan, Pengeluaran pribadi, Tips guide',
                    'is_active' => true,
                ],
                [
                    'name' => 'Paket Umroh VIP 12 Hari',
                    'description' => 'Paket umroh VIP dengan hotel bintang 5, dekat Masjidil Haram dan Masjid Nabawi.',
                    'destination' => 'Makkah - Madinah',
                    'duration_days' => 12,
                    'price' => 45000000,
                    'start_date' => Carbon::now()->addMonths(3),
                    'end_date' => Carbon::now()->addMonths(3)->addDays(11),
                    'max_participants' => 25,
                    'itinerary' => "Hari 1-5: Makkah (Hotel dekat Haram, Tawaf, Sai, Ibadah)\nHari 6-9: Madinah (Hotel dekat Nabawi, Ziarah)\nHari 10-12: Makkah (Tawaf Wada, Shopping)",
                    'includes' => 'Tiket pesawat PP, Hotel 5*, Makan 3x sehari, Transport VIP, Bimbingan ustadz, Perlengkapan lengkap',
                    'excludes' => 'Visa (ditanggung travel), Pengeluaran pribadi, Oleh-oleh',
                    'is_active' => true,
                ],
                [
                    'name' => 'Paket Haji Plus 40 Hari',
                    'description' => 'Paket haji plus dengan fasilitas premium dan bimbingan intensif.',
                    'destination' => 'Makkah - Madinah - Arafah - Mina',
                    'duration_days' => 40,
                    'price' => 85000000,
                    'start_date' => Carbon::now()->addMonths(6),
                    'end_date' => Carbon::now()->addMonths(6)->addDays(39),
                    'max_participants' => 350,
                    'itinerary' => "Minggu 1-2: Makkah (Persiapan, Tawaf, Sai)\nMinggu 3: Pelaksanaan Haji (Arafah, Mina, Muzdalifah)\nMinggu 4-5: Madinah (Ziarah, Istirahat)\nMinggu 6: Makkah (Tawaf Wada)",
                    'includes' => 'Tiket pesawat PP, Hotel 4*, Makan 3x sehari, Transport AC, Bimbingan manasik lengkap, Perlengkapan haji',
                    'excludes' => 'Visa haji (ditanggung travel), Asuransi, Pengeluaran pribadi',
                    'is_active' => true,
                ],
            ];
            
            foreach ($packages as $packageData) {
                $packageData['travel_partner_id'] = $partner->id;
                TravelPackage::create($packageData);
            }
        }
    }
}