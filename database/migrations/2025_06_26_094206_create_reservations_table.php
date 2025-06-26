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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('email_pelanggan');
            $table->string('nomor_telepon');
            $table->date('tanggal_check_in');
            $table->date('tanggal_check_out');
            $table->integer('jumlah_tamu');
            $table->foreignId('tipe_kamar_id')->constrained('rooms')->onDelete('cascade'); // Foreign key ke tabel 'rooms'
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};