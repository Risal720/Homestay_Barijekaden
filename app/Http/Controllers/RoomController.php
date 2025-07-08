<?php

namespace App\Http\Controllers;

use App\Models\Room; // Pastikan model Room diimport
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Pastikan Str diimport jika digunakan (meskipun tidak langsung di sini, sering digunakan)

class RoomController extends Controller
{
    /**
     * Menampilkan daftar semua kamar yang tersedia untuk publik.
     * Ini adalah metode untuk rute '/rooms'.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua kamar yang ingin Anda tampilkan di halaman publik
        // Sesuaikan query ini jika Anda memiliki filter atau pagination
        $rooms = Room::all();

        // Mengembalikan view untuk daftar kamar publik (misalnya, rooms.blade.php)
        // Pastikan Anda memiliki file view di resources/views/rooms.blade.php
        // Atau jika Anda menggunakan subfolder, misalnya resources/views/rooms/index.blade.php,
        // maka gunakan 'rooms.index'
        return view('rooms', compact('rooms'));
    }

    /**
     * Menampilkan detail satu kamar tertentu untuk publik.
     * Ini adalah metode untuk rute '/rooms/{room:slug}'.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\View\View
     */
    public function show(Room $room)
    {
        // Logika untuk menampilkan detail kamar
        return view('rooms.show', compact('room'));
    }

    // PENTING: PASTIKAN TIDAK ADA KODE LAIN DI BAWAH INI.
    // Tidak ada definisi kelas lain (seperti AdminRoomController) di sini.
    // Tidak ada metode CRUD admin (store, create, edit, update, destroy) di sini.
    // Metode-metode tersebut harus berada di AdminRoomController.php.
}
