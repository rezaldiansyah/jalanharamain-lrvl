<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pois', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('category', 50)->nullable(); // e.g., mosque, gate, site
            $table->string('city', 50)->nullable(); // e.g., makkah, madinah
            $table->decimal('lat', 10, 6);
            $table->decimal('lng', 10, 6);
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->integer('priority')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['city', 'category']);
            $table->index(['lat', 'lng']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pois');
    }
};