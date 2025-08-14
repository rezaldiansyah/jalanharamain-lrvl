<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('webinars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->date('date');
            $table->time('time');
            $table->string('platform'); // zoom, google meet, etc
            $table->string('meeting_link')->nullable();
            $table->integer('max_participants')->nullable();
            $table->enum('template', ['webinar', 'webinardua']);
            $table->enum('status', ['draft', 'published', 'completed'])->default('draft');
            $table->boolean('is_free')->default(true);
            $table->decimal('price', 10, 2)->nullable();
            $table->json('custom_content')->nullable(); // untuk override konten template
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('webinars');
    }
};