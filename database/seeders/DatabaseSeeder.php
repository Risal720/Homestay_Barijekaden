<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoomSeeder::class,
            RoomImageSeeder::class, // Panggil RoomImageSeeder
            // Anda juga bisa memanggil RoomCodeSeeder dan RoomPrefixSeeder di sini jika Anda membuatnya
        ]);
    }
}