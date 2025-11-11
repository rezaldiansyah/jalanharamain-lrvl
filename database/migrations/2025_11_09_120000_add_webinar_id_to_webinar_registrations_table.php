<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('webinar_registrations', function (Blueprint $table) {
            if (!Schema::hasColumn('webinar_registrations', 'webinar_id')) {
                $table->foreignId('webinar_id')
                    ->nullable()
                    ->constrained('webinars')
                    ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('webinar_registrations', function (Blueprint $table) {
            if (Schema::hasColumn('webinar_registrations', 'webinar_id')) {
                $table->dropForeign(['webinar_id']);
                $table->dropColumn('webinar_id');
            }
        });
    }
};