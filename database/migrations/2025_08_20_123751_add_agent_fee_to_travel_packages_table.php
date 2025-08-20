<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('travel_packages', function (Blueprint $table) {
            $table->decimal('agent_fee', 12, 2)->nullable()->after('price');
            $table->enum('agent_fee_type', ['fixed', 'percentage'])->default('fixed')->after('agent_fee');
        });
    }

    public function down(): void
    {
        Schema::table('travel_packages', function (Blueprint $table) {
            $table->dropColumn(['agent_fee', 'agent_fee_type']);
        });
    }
};