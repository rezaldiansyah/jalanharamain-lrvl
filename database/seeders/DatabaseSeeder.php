<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            TravelPartnerSeeder::class,
            TravelPackageSeeder::class,
            WebinarRegistrationSeeder::class,
            EbookSeeder::class,
            $this->call(POISeeder::class);
        ]);
    }
}
