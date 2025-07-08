<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCode;
use App\Models\RoomImage;
use App\Models\RoomPrefix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan ini diimport jika Anda menggunakan Storage facade
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Import File facade
use Illuminate\Support\Facades\Log; // Import the Log facade

class AdminRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     * Menampilkan daftar semua kamar beserta kode kamar dan gambar kamar.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua kamar dengan eager loading relasi roomCodes dan roomImages
        // Diurutkan berdasarkan created_at secara descending
        $rooms = Room::with(['roomCodes', 'roomImages'])->orderBy('created_at', 'desc')->get();
        // Mengambil semua awalan kamar yang tersedia
        $roomPrefixes = RoomPrefix::all();

        // Mengembalikan view admin.rooms.index dengan data kamar dan awalan kamar
        return view('admin.rooms.index', compact('rooms', 'roomPrefixes'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan formulir untuk membuat kamar baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Mengambil semua awalan kamar untuk dropdown di formulir
        $roomPrefixes = RoomPrefix::all();
        // Mengembalikan view admin.rooms.create dengan data awalan kamar
        return view('admin.rooms.create', compact('roomPrefixes'));
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan kamar baru yang dibuat ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari request
        $request->validate([
            'nama_room' => 'required|string|max:255',
            'foto_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga_room' => 'required|numeric|min:0',
            'detail_room' => 'nullable|string',
            'prefix' => 'required|string|max:10', // Prefix untuk kode kamar awal
            'room_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi untuk multiple images
        ]);

        $fotoLogoFilename = null;
        // Jika ada file foto_logo yang diunggah
        if ($request->hasFile('foto_logo')) {
            $fotoLogoFilename = $request->file('foto_logo')->hashName(); // Dapatkan nama file unik
            // Pindahkan file foto_logo ke direktori public/image/logos
            $request->file('foto_logo')->move(public_path('image/logos'), $fotoLogoFilename);
        }

        // Buat entri kamar baru di database
        $room = Room::create([
            'nama_room' => $request->nama_room,
            'foto_logo' => $fotoLogoFilename, // Simpan hanya nama file
            'harga_room' => $request->harga_room,
            'detail_room' => $request->detail_room,
        ]);

        // Tangani upload multiple room images
        if ($request->hasFile('room_images')) {
            foreach ($request->file('room_images') as $index => $image) {
                $filename = $image->hashName(); // Buat nama file unik
                // Pindahkan gambar ke direktori public/image/details
                $image->move(public_path('image/details'), $filename);

                // Buat entri RoomImage di database
                RoomImage::create([
                    'room_id' => $room->id,
                    'path' => $filename, // Simpan hanya nama file
                    'alt_text' => $room->nama_room . ' - Gambar ' . ($index + 1),
                    'order' => $index,
                ]);
            }
        }

        // Generate kode kamar awal (initial room code)
        $prefix = Str::upper($request->prefix);
        // Cari atau buat RoomPrefix baru. Jika baru, set max_limit ke 999 dan next_number ke 1
        $roomPrefix = RoomPrefix::firstOrCreate(
            ['prefix' => $prefix],
            ['max_limit' => 999, 'next_number' => 1]
        );

        // Periksa apakah next_number masih dalam batas max_limit
        if ($roomPrefix->next_number <= $roomPrefix->max_limit) {
            // Bentuk kode kamar (misal: ABC-001)
            $code = $prefix . '-' . str_pad($roomPrefix->next_number, 3, '0', STR_PAD_LEFT);
            // Buat entri RoomCode baru
            $newRoomCode = RoomCode::create([
                'room_id' => $room->id,
                'code' => $code,
                'status' => 'Tersedia',
            ]);
            // Tingkatkan next_number untuk prefix ini
            $roomPrefix->increment('next_number');

            // Menggunakan redirect() untuk store method karena ini adalah form submission utama
            return redirect()->route('admin.rooms.index')->with('success', 'Kamar dan kode kamar awal ' . $code . ' berhasil ditambahkan!');
        } else {
            // Jika batas maksimal tercapai, kembalikan dengan pesan error
            return redirect()->route('admin.rooms.index')->with('error', 'Batas maksimal kode kamar untuk awalan ' . $prefix . ' telah tercapai. Kamar berhasil dibuat tanpa kode awal.');
        }
    }

    // ... metode show, edit, update, destroy untuk Room

    /**
     * Update the status of a specific room code.
     * Memperbarui status kode kamar tertentu.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomCode  $roomCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRoomCodeStatus(Request $request, RoomCode $roomCode)
    {
        // Validasi status yang masuk
        $request->validate([
            'status' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        // Perbarui status kode kamar
        $roomCode->update(['status' => $request->status]);

        // Mengembalikan respons JSON untuk permintaan AJAX
        return response()->json(['success' => true, 'message' => 'Status kode kamar berhasil diperbarui.']);
    }

    /**
     * Add a new room code for a given room and prefix.
     * Menambahkan kode kamar baru untuk kamar dan awalan yang diberikan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $roomId
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRoomCode(Request $request, $roomId)
    {
        // Temukan kamar berdasarkan ID
        $room = Room::find($roomId);

        // Jika kamar tidak ditemukan, kembalikan respons error
        if (!$room) {
            Log::error("Room with ID {$roomId} not found for addRoomCode method.");
            return response()->json(['success' => false, 'message' => 'Kamar tidak ditemukan.'], 404);
        }

        // Validasi awalan yang masuk
        $request->validate([
            'prefix_add' => 'required|string|max:10',
        ]);

        $prefix = Str::upper($request->prefix_add);
        // Cari atau buat RoomPrefix baru. Jika baru, set max_limit ke 999 dan next_number ke 1
        $roomPrefix = RoomPrefix::firstOrCreate(
            ['prefix' => $prefix],
            ['max_limit' => 999, 'next_number' => 1]
        );

        // Periksa apakah next_number masih dalam batas max_limit
        if ($roomPrefix->next_number <= $roomPrefix->max_limit) {
            // Bentuk kode kamar (misal: ABC-001)
            $code = $prefix . '-' . str_pad($roomPrefix->next_number, 3, '0', STR_PAD_LEFT);
            // Buat entri RoomCode baru
            $newRoomCode = RoomCode::create([
                'room_id' => $room->id,
                'code' => $code,
                'status' => 'Tersedia',
            ]);
            // Tingkatkan next_number untuk prefix ini
            $roomPrefix->increment('next_number');

            // Mengembalikan respons JSON untuk permintaan AJAX, termasuk data kode yang baru dibuat
            return response()->json(['success' => true, 'message' => 'Kode kamar baru ' . $code . ' berhasil ditambahkan.', 'code' => $newRoomCode]);
        } else {
            // Jika batas maksimal tercapai, kembalikan respons JSON
            return response()->json(['success' => false, 'message' => 'Batas maksimal kode kamar untuk awalan ' . $prefix . ' telah tercapai.']);
        }
    }

    /**
     * Delete a specific room code.
     * Menghapus kode kamar tertentu.
     *
     * @param  \App\Models\RoomCode  $roomCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoomCode(RoomCode $roomCode)
    {
        $roomCode->delete();
        // Mengembalikan respons JSON untuk permintaan AJAX
        return response()->json(['success' => true, 'message' => 'Kode kamar berhasil dihapus.']);
    }

    /**
     * Delete a specific room image.
     * Menghapus gambar kamar tertentu.
     *
     * @param  \App\Models\RoomImage  $roomImage
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRoomImage(RoomImage $roomImage)
    {
        // Dapatkan nama file gambar mentah dari database
        $imageFilename = $roomImage->getRawOriginal('path');
        // Jika file ada di direktori, hapus
        if ($imageFilename && File::exists(public_path('image/details/' . $imageFilename))) {
            File::delete(public_path('image/details/' . $imageFilename));
        }
        $roomImage->delete(); // Hapus entri gambar dari database
        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Gambar kamar berhasil dihapus.');
    }

    /**
     * Store or update a room prefix.
     * Menyimpan atau memperbarui awalan kamar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeOrUpdatePrefix(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'prefix_name' => 'required|string|max:10|unique:room_prefixes,prefix,' . $request->id, // id digunakan untuk update
            'max_limit_value' => 'required|integer|min:1',
        ]);

        // Jika ada ID di request, berarti ini adalah operasi update
        if ($request->id) {
            $prefix = RoomPrefix::find($request->id);
            if (!$prefix) {
                return back()->with('error', 'Awalan kamar tidak ditemukan untuk diperbarui.');
            }
            $prefix->update([
                'prefix' => Str::upper($request->prefix_name),
                'max_limit' => $request->max_limit_value,
            ]);
            $message = 'Awalan kamar berhasil diperbarui.';
        } else {
            // Jika tidak ada ID, berarti ini adalah operasi create
            RoomPrefix::create([
                'prefix' => Str::upper($request->prefix_name),
                'max_limit' => $request->max_limit_value,
                'next_number' => 1,
            ]);
            $message = 'Awalan kamar berhasil ditambahkan.';
        }

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', $message);
    }

    /**
     * Delete a room prefix.
     * Menghapus awalan kamar.
     *
     * @param  \App\Models\RoomPrefix  $roomPrefix
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deletePrefix(RoomPrefix $roomPrefix)
    {
        // Periksa apakah ada kode kamar yang masih menggunakan awalan ini
        if (RoomCode::where('code', 'LIKE', $roomPrefix->prefix . '-%')->exists()) {
            return back()->with('error', 'Tidak dapat menghapus awalan karena masih ada kode kamar yang menggunakannya.');
        }
        $roomPrefix->delete(); // Hapus awalan kamar
        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Awalan kamar berhasil dihapus.');
    }

    /**
     * Get room codes for a specific room.
     * Mengambil daftar kode kamar untuk kamar tertentu.
     *
     * @param  int  $roomId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoomCodes($roomId)
    {
        // Temukan kamar berdasarkan ID
        $room = Room::find($roomId);

        // Jika kamar tidak ditemukan, log error dan kembalikan respons error
        if (!$room) {
            Log::error("Room with ID {$roomId} not found for getRoomCodes method.");
            return response()->json(['error' => 'Kamar tidak ditemukan.'], 404);
        }

        // Mengembalikan kode kamar terkait dalam format JSON
        return response()->json($room->roomCodes);
    }
}
