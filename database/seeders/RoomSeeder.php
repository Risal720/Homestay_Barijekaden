<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        Room::create([
            'nama_room' => 'Kamar Standard',
            'harga_room' => 150000,
            'slug' => Str::slug('Kamar Standard'),
            'detail_room' => 'Kamar nyaman dengan satu tempat tidur ukuran sedang.',
            'foto_logo' => 'standar-logo.png', // Pastikan file ini ada di public/images/rooms/logos/
        ]);

        Room::create([
            'nama_room' => 'Kamar Deluxe',
            'harga_room' => 250000,
            'slug' => Str::slug('Kamar Deluxe'),
            'detail_room' => 'Kamar lebih luas dengan fasilitas tambahan dan pemandangan menarik.',
            'foto_logo' => 'deluxe-logo.png', // Pastikan file ini ada di public/images/rooms/logos/
        ]);

        Room::create([
            'nama_room' => 'Suite Keluarga',
            'harga_room' => 400000,
            'slug' => Str::slug('Suite Keluarga'),
            'detail_room' => 'Suite dengan beberapa tempat tidur, cocok untuk keluarga.',
            'foto_logo' => 'suite-logo.png', // Pastikan file ini ada di public/images/rooms/logos/
        ]);

        // Tambahkan data kamar lainnya sesuai kebutuhan Anda
    }
}