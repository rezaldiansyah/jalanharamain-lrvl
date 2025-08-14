<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Webinar;

return new class extends Migration
{
    public function up()
    {
        // Tambah kolom slug sebagai nullable dulu
        Schema::table('webinars', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });
        
        // Generate slug untuk data yang sudah ada
        $webinars = Webinar::all();
        foreach ($webinars as $webinar) {
            $type = ($webinar->price == 0 || $webinar->is_free) ? 'free' : 'paid';
            $date = $webinar->date->format('Ymd');
            $baseSlug = "webinar/{$type}/{$date}";
            
            // Cek duplikat dan tambah counter jika perlu
            $slug = $baseSlug;
            $counter = 1;
            while (Webinar::where('slug', $slug)->where('id', '!=', $webinar->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $webinar->update(['slug' => $slug]);
        }
        
        // Setelah semua data punya slug, ubah kolom jadi NOT NULL dan unique
        Schema::table('webinars', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};