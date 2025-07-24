<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calagen_ebook', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->string('kota_domisili');
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nomor_whatsapp');
            $table->enum('jenis_kelamin', ['Laki-Laki', 'Perempuan']);
            $table->boolean('is_converted_to_user')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calagen_ebook');
    }
};
