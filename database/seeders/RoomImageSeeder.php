<?php

namespace Database\Seeders;

use App\Models\RoomImage;
use App\Models\Room; // Import the Room model
use Illuminate\Database\Seeder;

class RoomImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan kamar sudah ada di database sebelum menjalankan seeder ini.
        // Kami akan mencari kamar berdasarkan slug, yang lebih stabil daripada ID.
        $kamarStandard = Room::where('slug', 'kamar-standard')->first();
        $kamarDeluxe = Room::where('slug', 'kamar-deluxe')->first();
        $suiteKeluarga = Room::where('slug', 'suite-keluarga')->first();

        // Hapus gambar lama untuk menghindari duplikasi jika seeder dijalankan berulang kali
        // Ini penting agar tidak ada entri gambar yang salah di database
        if ($kamarStandard) {
            RoomImage::where('room_id', $kamarStandard->id)->delete();
        }
        if ($kamarDeluxe) {
            RoomImage::where('room_id', $kamarDeluxe->id)->delete();
        }
        if ($suiteKeluarga) {
            RoomImage::where('room_id', $suiteKeluarga->id)->delete();
        }


        if ($kamarStandard) {
            RoomImage::create([
                'room_id' => $kamarStandard->id,
                'path' => 'standar-room1.png', // Sesuaikan dengan nama file di public/image/details/
                'alt_text' => 'Kamar Standard Detail 1',
                'order' => 1,
            ]);
            RoomImage::create([
                'room_id' => $kamarStandard->id,
                'path' => 'standar-room2.png', // Sesuaikan dengan nama file di public/image/details/
                'alt_text' => 'Kamar Standard Detail 2',
                'order' => 2,
            ]);
            RoomImage::create([
                'room_id' => $kamarStandard->id,
                'path' => 'standar-room3.png', // Sesuaikan dengan nama file di public/image/details/
                'alt_text' => 'Kamar Standard Detail 3',
                'order' => 3,
            ]);
        }

        if ($kamarDeluxe) {
            RoomImage::create([
                'room_id' => $kamarDeluxe->id,
                'path' => 'deluxe-room1.png', // Sesuaikan dengan nama file di public/image/details/
                'alt_text' => 'Kamar Deluxe Detail 1',
                'order' => 1,
            ]);
            RoomImage::create([
                'room_id' => $kamarDeluxe->id,
                'path' => 'deluxe-room2.png', // Sesuaikan dengan nama file di public/image/details/
                'alt_text' => 'Kamar Deluxe Detail 2',
                'order' => 2,
            ]);
            RoomImage::create([
                'room_id' => $kamarDeluxe->id,
                'path' => 'deluxe-room3.png', // Sesuaikan dengan nama file di public/image/details/
                'alt_text' => 'Kamar Deluxe Detail 3',
                'order' => 3,
            ]);
        }

        if ($suiteKeluarga) {
            RoomImage::create([
                'room_id' => $suiteKeluarga->id,
                'path' => 'suite-room1.png', // Sesuaikan dengan nama file di public/image/details/
                'alt_text' => 'Suite Keluarga Detail 1',
                'order' => 1,
            ]);
            RoomImage::create([
                'room_id' => $suiteKeluarga->id,
                'path' => 'suite-room2.png', // Sesuaikan dengan nama file di public/image/details/
                'alt_text' => 'Suite Keluarga Detail 2',
                'order' => 2,
            ]);
            RoomImage::create([
                'room_id' => $suiteKeluarga->id,
                'path' => 'suite-room3.png', // Sesuaikan dengan nama file di public/image/details/
                'alt_text' => 'Suite Keluarga Detail 3',
                'order' => 3,
            ]);
        }
    }
}
