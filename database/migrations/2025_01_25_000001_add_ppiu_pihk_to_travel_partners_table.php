<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('travel_partners', function (Blueprint $table) {
            $table->string('ppiu_number')->nullable()->after('address');
            $table->string('pihk_number')->nullable()->after('ppiu_number');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null')->after('pihk_number');
        });
    }

    public function down(): void
    {
        Schema::table('travel_partners', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['ppiu_number', 'pihk_number', 'user_id']);
        });
    }
};