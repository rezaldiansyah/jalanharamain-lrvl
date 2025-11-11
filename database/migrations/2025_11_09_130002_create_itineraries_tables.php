<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('itineraries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->nullable();
            $table->string('city', 50)->nullable(); // makkah/madinah/other
            $table->integer('days')->default(1);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('itinerary_stops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('itinerary_id')->constrained('itineraries')->cascadeOnDelete();
            $table->integer('day')->default(1);
            $table->integer('sequence')->default(1);
            $table->foreignId('poi_id')->nullable()->constrained('pois')->nullOnDelete();
            $table->string('custom_name')->nullable();
            $table->text('notes')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->decimal('lat', 10, 6)->nullable();
            $table->decimal('lng', 10, 6)->nullable();
            $table->timestamps();

            $table->index(['itinerary_id', 'day', 'sequence']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('itinerary_stops');
        Schema::dropIfExists('itineraries');
    }
};