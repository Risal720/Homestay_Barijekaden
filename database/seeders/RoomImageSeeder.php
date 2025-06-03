<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Database\Seeder;

class RoomImageSeeder extends Seeder
{
    public function run(): void
    {
        $roomStandard = Room::where('slug', 'kamar-standard')->first();
        if ($roomStandard) {
            RoomImage::create([
                'room_id' => $roomStandard->id,
                'path' => 'detail-1.jpg', // Pastikan file ini ada di public/image/details/
                'alt_text' => 'Kamar Standard Detail 1',
                'order' => 0,
            ]);
            RoomImage::create([
                'room_id' => $roomStandard->id,
                'path' => 'detail-2.jpg', // Pastikan file ini ada di public/image/details/
                'alt_text' => 'Kamar Standard Detail 2',
                'order' => 1,
            ]);
        }

        $roomDeluxe = Room::where('slug', 'kamar-deluxe')->first();
        if ($roomDeluxe) {
            RoomImage::create([
                'room_id' => $roomDeluxe->id,
                'path' => 'deluxe-detail-1.jpg', // Pastikan file ini ada di public/image/details/
                'alt_text' => 'Kamar Deluxe Detail 1',
                'order' => 0,
            ]);
        }
        // Add more room image data as needed
    }
}