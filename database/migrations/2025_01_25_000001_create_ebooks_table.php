<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('category', ['gratis', 'berbayar'])->default('gratis');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('file_name');
            $table->string('file_path'); // Path di Bunny.net
            $table->string('bunny_url'); // URL lengkap dari Bunny.net
            $table->integer('file_size')->nullable(); // dalam bytes
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ebooks');
    }
};