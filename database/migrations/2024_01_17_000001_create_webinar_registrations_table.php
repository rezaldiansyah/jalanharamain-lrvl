<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('webinar_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->string('email');
            $table->string('whatsapp');
            $table->string('city');
            $table->string('source');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('webinar_registrations');
    }
};