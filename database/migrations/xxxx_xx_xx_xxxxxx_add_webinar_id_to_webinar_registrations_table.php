<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('webinar_registrations', function (Blueprint $table) {
            $table->unsignedBigInteger('webinar_id')->nullable()->after('id');
            $table->foreign('webinar_id')->references('id')->on('webinars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('webinar_registrations', function (Blueprint $table) {
            $table->dropForeign(['webinar_id']);
            $table->dropColumn('webinar_id');
        });
    }
};