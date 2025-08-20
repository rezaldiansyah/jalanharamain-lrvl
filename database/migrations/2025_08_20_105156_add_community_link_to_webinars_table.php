<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->string('community_link')->nullable()->after('meeting_link');
        });
    }

    public function down()
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropColumn('community_link');
        });
    }
};