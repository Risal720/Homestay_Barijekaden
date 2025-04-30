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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('foto_logo')->nullable(); // Untuk foto logo/thumbnail di halaman daftar
            $table->string('nama_room');
            $table->decimal('harga_room', 10, 2);
            $table->string('slug')->unique();
            $table->text('detail_room');
            $table->timestamps();
        });

        Schema::create('room_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->onDelete('cascade'); // Relasi ke tabel rooms
            $table->string('path'); // Path atau nama file foto detail
            $table->string('alt_text')->nullable(); // Teks alternatif untuk SEO
            $table->integer('order')->default(0); // Untuk mengatur urutan tampilan foto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_images');
        Schema::dropIfExists('rooms');
    }
};
