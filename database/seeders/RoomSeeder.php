<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Import File facade

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // --- PENTING: MENYIAPKAN GAMBAR UNTUK SEEDER ---
        // Pastikan Anda telah menempatkan file gambar ini secara manual di lokasi berikut:
        // - public/image/logos/deluxe-logo.png
        // - public/image/logos/standar-logo.png
        // - public/image/logos/suite-logo.png
        // (dan file logo lain yang Anda gunakan di sini)
        // Anda mungkin perlu membuat direktori 'public/image/logos' jika belum ada.
        // File gambar detail (untuk room_images) juga perlu ditempatkan di:
        // - public/image/details/detail-1.jpg
        // - public/image/details/detail-2.jpg
        // - public/image/details/detail-3.jpg
        // (atau nama file lain yang Anda gunakan di RoomImageSeeder)
        // --- AKHIR PENTING ---

        Room::create([
            'nama_room' => 'Kamar Standard',
            'harga_room' => 150000,
            'slug' => Str::slug('Kamar Standard'),
            'detail_room' => 'Kamar nyaman dengan satu tempat tidur ukuran sedang.',
            'foto_logo' => 'standar-logo.png', // Store only the filename
        ]);

        Room::create([
            'nama_room' => 'Kamar Deluxe',
            'harga_room' => 250000,
            'slug' => Str::slug('Kamar Deluxe'),
            'detail_room' => 'Kamar lebih luas dengan fasilitas tambahan dan pemandangan menarik.',
            'foto_logo' => 'deluxe-logo.png', // Store only the filename
        ]);

        Room::create([
            'nama_room' => 'Suite Keluarga',
            'harga_room' => 400000,
            'slug' => Str::slug('Suite Keluarga'),
            'detail_room' => 'Suite dengan beberapa tempat tidur, cocok untuk keluarga.',
            'foto_logo' => 'suite-logo.png', // Store only the filename
        ]);

        // Add other room data as needed
    }
}