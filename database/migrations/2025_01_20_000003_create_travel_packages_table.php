<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('travel_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('travel_partner_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('destination');
            $table->integer('duration_days');
            $table->decimal('price', 12, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('max_participants');
            $table->text('itinerary')->nullable();
            $table->text('includes')->nullable();
            $table->text('excludes')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('travel_packages');
    }
};