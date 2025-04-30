<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Database\Seeder;

class RoomImageSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua data kamar yang telah dibuat oleh RoomSeeder
        $rooms = Room::all();

        // Loop melalui setiap kamar dan tambahkan beberapa foto detail untuk carousel
        foreach ($rooms as $room) {
            switch ($room->slug) {
                case 'kamar-standard':
                    $this->createRoomImages($room->id, [
                        'standar-room1.png' => 'Foto detail Kamar Standard 1', // Nama file => Alt text
                        'standar-room2.png' => 'Foto detail Kamar Standard 2',
                        'standar-room3.png' => 'Foto detail Kamar Standard 3',
                    ]);
                    break;
                case 'kamar-deluxe':
                    $this->createRoomImages($room->id, [
                        'deluxe-room1.png' => 'Foto detail Kamar Deluxe 1', // Nama file => Alt text
                        'deluxe-room2.png' => 'Foto detail Kamar Deluxe 2',
                        'deluxe-room3.png' => 'Foto detail Kamar Deluxe 3',
                    ]);
                    break;
                case 'suite-keluarga':
                    $this->createRoomImages($room->id, [
                        'suite-room1.png' => 'Foto detail Suite Keluarga 1', // Nama file => Alt text
                        'suite-room2.png' => 'Foto detail Suite Keluarga 2',
                        'suite-room3.png' => 'Foto detail Suite Keluarga 3',
                    ]);
                    break;
                // Tambahkan case lain jika Anda menambahkan lebih banyak jenis kamar di RoomSeeder
            }
        }
    }

    /**
     * Helper function untuk membuat banyak gambar untuk satu kamar.
     *
     * @param int $roomId
     * @param array $imagesData [path => alt_text]
     * @return void
     */
    protected function createRoomImages(int $roomId, array $imagesData): void
    {
        foreach ($imagesData as $path => $altText) {
            RoomImage::create([
                'room_id' => $roomId,
                'path' => $path, // Key dari array menjadi path
                'alt_text' => $altText, // Value dari array menjadi alt_text
            ]);
        }
    }
}