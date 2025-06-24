<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomPrefix; // TAMBAHKAN INI
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        // Ambil semua RoomPrefix dari database
        $roomPrefixes = RoomPrefix::all(); // UBAH INI

        return view('admin.rooms.index', compact('rooms', 'roomPrefixes'));
    }

    // ... metode show, create, dll.

    public function store(Request $request)
    {
        // ... (kode store Room Anda yang sudah ada) ...
    }

    // Tambahkan metode untuk mengelola RoomPrefixes
    public function storeUpdateRoomPrefix(Request $request)
    {
        $validatedData = $request->validate([
            'prefix_name' => 'required|string|max:10|unique:room_prefixes,prefix,' . $request->input('id'), // id digunakan untuk update
            'max_limit_value' => 'required|integer|min:1',
        ]);

        // Cek apakah prefix sudah ada
        $roomPrefix = RoomPrefix::where('prefix', $validatedData['prefix_name'])->first();

        if ($roomPrefix) {
            // Update yang sudah ada
            $roomPrefix->update([
                'max_limit' => $validatedData['max_limit_value'],
            ]);
            $message = 'Awalan kode kamar berhasil diperbarui!';
        } else {
            // Buat baru
            RoomPrefix::create([
                'prefix' => $validatedData['prefix_name'],
                'max_limit' => $validatedData['max_limit_value'],
                'next_number' => 1, // Atur nilai awal untuk next_number
            ]);
            $message = 'Awalan kode kamar berhasil ditambahkan!';
        }

        return redirect()->route('admin.rooms.index')->with('success', $message);
    }

    public function destroyRoomPrefix(RoomPrefix $roomPrefix)
    {
        try {
            // Anda mungkin ingin menambahkan logika untuk memeriksa apakah ada kamar yang menggunakan prefix ini
            // sebelum menghapusnya, atau menghapus kode kamar terkait.
            // Contoh:
            // RoomCode::where('prefix_id', $roomPrefix->id)->delete(); // Hapus kode kamar yang terkait
            $roomPrefix->delete();
            return redirect()->route('admin.rooms.index')->with('success', 'Awalan kode kamar berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus awalan kode kamar: ' . $e->getMessage()]);
        }
    }
}