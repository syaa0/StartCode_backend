<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('codes', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Nama
            $table->text('deskripsi')->nullable(); // Deskripsi (nullable)
            $table->string('logo')->nullable(); // Logo (untuk menyimpan gambar, nullable)
            $table->unsignedBigInteger('user_id'); // Foreign key ke tabel users
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps(); // Created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codes');
    }
};
