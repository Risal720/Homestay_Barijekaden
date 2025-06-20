<?php

namespace App\Http\Controllers;

use App\Models\Room; // Pastikan model Room sudah ada dan benar
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan ini jika Anda ingin menggunakan Str::slug() untuk slug

class RoomController extends Controller
{
    /**
     * Display a listing of all rooms for the user.
     * Menampilkan daftar semua kamar untuk pengguna.
     */
    public function index()
    {
        // Fetch all rooms, you might want to add pagination later
        // Mengambil semua kamar, Anda mungkin ingin menambahkan paginasi nanti
        $rooms = Room::all();
        // Mengarahkan ke view 'rooms.index' atau 'admin.rooms.index'
        // Sesuaikan dengan nama view yang Anda gunakan untuk menampilkan daftar kamar
        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * Display the specified room details for the user.
     * Route Model Binding will automatically fetch the room by slug.
     * Menampilkan detail kamar tertentu untuk pengguna.
     * Route Model Binding akan secara otomatis mengambil kamar berdasarkan slug.
     */
    public function show(Room $room)
    {
        // Eager load room codes and room images for the specific room
        // Memuat (eager load) kode kamar dan gambar kamar untuk kamar tertentu
        $room->load(['roomCodes', 'roomImages']);
        return view('room', compact('room')); // Ini mungkin view untuk tampilan publik
    }

    /**
     * Show the form for creating a new room.
     * Menampilkan formulir untuk membuat kamar baru.
     * Ini adalah metode yang akan dipanggil ketika mengakses /admin/rooms/create
     */
    public function create()
    {
        // Mengarahkan ke view 'admin.rooms.create' yang berisi formulir
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created room in storage.
     * Menyimpan kamar yang baru dibuat ke database.
     * Ini adalah metode yang akan menerima data dari formulir 'create.blade.php'
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari formulir
        $validatedData = $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms,room_number', // room_number harus unik di tabel 'rooms'
            'type' => 'required|string|in:Standard,Deluxe,Suite', // Hanya izinkan nilai ini
            'price' => 'required|numeric|min:0', // Harga harus angka dan tidak negatif
            'capacity' => 'required|integer|min:1', // Kapasitas harus bilangan bulat dan minimal 1
            // Tambahkan validasi lain sesuai kolom di tabel 'rooms' Anda
        ]);

        // 2. Tambahkan slug otomatis (opsional, tapi disarankan untuk URL yang bersih)
        // Jika Anda memiliki kolom 'slug' di tabel 'rooms'
        $validatedData['slug'] = Str::slug($validatedData['room_number'] . '-' . $validatedData['type']);

        // 3. Simpan data ke database menggunakan Model Room
        try {
            Room::create($validatedData);

            // 4. Redirect kembali dengan pesan sukses
            return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Tangani error jika terjadi masalah saat menyimpan
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan kamar: ' . $e->getMessage()]);
        }
    }

    // Anda mungkin juga ingin menambahkan metode edit, update, dan destroy nanti
    // /**
    //  * Show the form for editing the specified room.
    //  */
    // public function edit(Room $room)
    // {
    //     return view('admin.rooms.edit', compact('room'));
    // }

    // /**
    //  * Update the specified room in storage.
    //  */
    // public function update(Request $request, Room $room)
    // {
    //     // ... validasi dan update data ...
    //     return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui!');
    // }

    // /**
    //  * Remove the specified room from storage.
    //  */
    // public function destroy(Room $room)
    // {
    //     // ... hapus data ...
    //     return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus!');
    // }
}
