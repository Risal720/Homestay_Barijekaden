    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         * Jalankan migrasi.
         */
        public function up(): void
        {
            Schema::create('orders', function (Blueprint $table) {
                $table->id(); // Kolom ID otomatis (primary key, auto-increment)
                $table->string('customer_name'); // Nama pelanggan yang memesan
                $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); // Foreign key ke tabel 'rooms', jika pesanan terhubung ke kamar
                $table->date('check_in_date'); // Tanggal check-in
                $table->date('check_out_date'); // Tanggal check-out
                $table->integer('number_of_guests')->default(1); // Jumlah tamu, default 1
                $table->decimal('total_price', 10, 2); // Total harga pesanan (10 digit total, 2 di belakang koma)
                $table->string('status')->default('pending'); // Status pesanan: pending, confirmed, completed, cancelled
                $table->timestamps(); // Kolom created_at dan updated_at otomatis
            });
        }

        /**
         * Reverse the migrations.
         * Batalkan migrasi (rollback).
         */
        public function down(): void
        {
            Schema::dropIfExists('orders');
        }
    };
    