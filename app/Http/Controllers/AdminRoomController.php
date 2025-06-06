<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomCode;
use App\Models\RoomImage;
use App\Models\RoomPrefix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Import File facade
use Illuminate\Support\Facades\Log; // Import the Log facade

class AdminRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::with(['roomCodes', 'roomImages'])->orderBy('created_at', 'desc')->get();
        $roomPrefixes = RoomPrefix::all();
        return view('admin.rooms.index', compact('rooms', 'roomPrefixes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roomPrefixes = RoomPrefix::all();
        return view('admin.rooms.create', compact('roomPrefixes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_room' => 'required|string|max:255',
            'foto_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga_room' => 'required|numeric|min:0',
            'detail_room' => 'nullable|string',
            'prefix' => 'required|string|max:10',
            'room_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for multiple images
        ]);

        $fotoLogoFilename = null;
        if ($request->hasFile('foto_logo')) {
            $fotoLogoFilename = $request->file('foto_logo')->hashName(); // Get unique filename
            // Store directly in public/image/logos
            $request->file('foto_logo')->move(public_path('image/logos'), $fotoLogoFilename);
        }

        $room = Room::create([
            'nama_room' => $request->nama_room,
            'foto_logo' => $fotoLogoFilename, // Store only the filename
            'harga_room' => $request->harga_room,
            'detail_room' => $request->detail_room,
        ]);

        // Handle multiple room images
        if ($request->hasFile('room_images')) {
            foreach ($request->file('room_images') as $index => $image) {
                $filename = $image->hashName(); // Generate a unique filename
                // Store directly in public/image/details
                $image->move(public_path('image/details'), $filename);

                RoomImage::create([
                    'room_id' => $room->id,
                    'path' => $filename, // Store only the filename here
                    'alt_text' => $room->nama_room . ' - Gambar ' . ($index + 1),
                    'order' => $index,
                ]);
            }
        }

        // Generate initial room code
        $prefix = Str::upper($request->prefix);
        $roomPrefix = RoomPrefix::firstOrCreate(
            ['prefix' => $prefix],
            ['max_limit' => 999, 'next_number' => 1]
        );

        if ($roomPrefix->next_number <= $roomPrefix->max_limit) {
            $code = $prefix . '-' . str_pad($roomPrefix->next_number, 3, '0', STR_PAD_LEFT);
            $newRoomCode = RoomCode::create([ // Capture the created model
                'room_id' => $room->id,
                'code' => $code,
                'status' => 'Tersedia',
            ]);
            $roomPrefix->increment('next_number');
            // Return JSON for AJAX, including the newly created code's data
            return response()->json(['success' => true, 'message' => 'Kode kamar baru ' . $code . ' berhasil ditambahkan.', 'code' => $newRoomCode]);
        } else {
            // Return JSON for AJAX
            return response()->json(['success' => false, 'message' => 'Batas maksimal kode kamar untuk awalan ' . $prefix . ' telah tercapai.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        $room->load('roomImages'); // Load room images for editing
        $roomPrefixes = RoomPrefix::all();
        return view('admin.rooms.edit', compact('room', 'roomPrefixes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'nama_room' => 'required|string|max:255',
            'foto_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga_room' => 'required|numeric|min:0',
            'detail_room' => 'nullable|string',
            'room_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validation for multiple images
        ]);

        $fotoLogoFilename = $room->getRawOriginal('foto_logo'); // Get the raw filename from DB
        if ($request->hasFile('foto_logo')) {
            // Delete old file if exists
            if ($fotoLogoFilename && File::exists(public_path('image/logos/' . $fotoLogoFilename))) {
                File::delete(public_path('image/logos/' . $fotoLogoFilename));
            }
            $fotoLogoFilename = $request->file('foto_logo')->hashName();
            $request->file('foto_logo')->move(public_path('image/logos'), $fotoLogoFilename);
        }

        $room->update([
            'nama_room' => $request->nama_room,
            'foto_logo' => $fotoLogoFilename, // Store only the filename
            'harga_room' => $request->harga_room,
            'detail_room' => $request->detail_room,
        ]);

        // Handle multiple room images upload
        if ($request->hasFile('room_images')) {
            foreach ($request->file('room_images') as $index => $image) {
                $filename = $image->hashName();
                $image->move(public_path('image/details'), $filename); // Store in public/image/details

                RoomImage::create([
                    'room_id' => $room->id,
                    'path' => $filename, // Store only the filename here
                    'alt_text' => $room->nama_room . ' - Gambar Baru ' . ($index + 1),
                    'order' => $room->roomImages()->count() + $index, // Append to existing order
                ]);
            }
        }

        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        // Delete foto_logo
        $fotoLogoFilename = $room->getRawOriginal('foto_logo');
        if ($fotoLogoFilename && File::exists(public_path('image/logos/' . $fotoLogoFilename))) {
            File::delete(public_path('image/logos/' . $fotoLogoFilename));
        }

        // Delete all associated room images
        foreach ($room->roomImages as $image) {
            $imageFilename = $image->getRawOriginal('path'); // Get raw filename from DB
            if ($imageFilename && File::exists(public_path('image/details/' . $imageFilename))) {
                File::delete(public_path('image/details/' . $imageFilename));
            }
            $image->delete();
        }

        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Kamar berhasil dihapus!');
    }

    /**
     * Update the status of a specific room code.
     */
    public function updateRoomCodeStatus(Request $request, RoomCode $roomCode)
    {
        $request->validate([
            'status' => 'required|in:Tersedia,Tidak Tersedia',
        ]);

        $roomCode->update(['status' => $request->status]);

        // Return JSON response for AJAX
        return response()->json(['success' => true, 'message' => 'Status kode kamar berhasil diperbarui.']);
    }

    /**
     * Add a new room code for a given room and prefix.
     */
    public function addRoomCode(Request $request, $roomId) // Modified to accept $roomId directly
    {
        // Temporarily bypass implicit model binding for debugging
        $room = Room::find($roomId);

        if (!$room) {
            // Log this error if the room is not found
            Log::error("Room with ID {$roomId} not found for addRoomCode method.");
            return response()->json(['success' => false, 'message' => 'Kamar tidak ditemukan.'], 404);
        }

        $request->validate([
            'prefix_add' => 'required|string|max:10',
        ]);

        $prefix = Str::upper($request->prefix_add);
        $roomPrefix = RoomPrefix::firstOrCreate(
            ['prefix' => $prefix],
            ['max_limit' => 999, 'next_number' => 1]
        );

        if ($roomPrefix->next_number <= $roomPrefix->max_limit) {
            $code = $prefix . '-' . str_pad($roomPrefix->next_number, 3, '0', STR_PAD_LEFT);
            $newRoomCode = RoomCode::create([ // Capture the created model
                'room_id' => $room->id,
                'code' => $code,
                'status' => 'Tersedia',
            ]);
            $roomPrefix->increment('next_number');
            // Return JSON for AJAX, including the newly created code's data
            return response()->json(['success' => true, 'message' => 'Kode kamar baru ' . $code . ' berhasil ditambahkan.', 'code' => $newRoomCode]);
        } else {
            // Return JSON for AJAX
            return response()->json(['success' => false, 'message' => 'Batas maksimal kode kamar untuk awalan ' . $prefix . ' telah tercapai.']);
        }
    }

    /**
     * Delete a specific room code.
     */
    public function deleteRoomCode(RoomCode $roomCode)
    {
        $roomCode->delete();
        // Return JSON response for AJAX
        return response()->json(['success' => true, 'message' => 'Kode kamar berhasil dihapus.']);
    }

    /**
     * Delete a specific room image.
     */
    public function deleteRoomImage(RoomImage $roomImage)
    {
        $imageFilename = $roomImage->getRawOriginal('path');
        if ($imageFilename && File::exists(public_path('image/details/' . $imageFilename))) {
            File::delete(public_path('image/details/' . $imageFilename));
        }
        $roomImage->delete();
        return back()->with('success', 'Gambar kamar berhasil dihapus.');
    }

    /**
     * Store or update a room prefix.
     */
    public function storeOrUpdatePrefix(Request $request)
    {
        $request->validate([
            'prefix_name' => 'required|string|max:10|unique:room_prefixes,prefix,' . $request->id,
            'max_limit_value' => 'required|integer|min:1',
        ]);

        if ($request->id) {
            $prefix = RoomPrefix::find($request->id);
            $prefix->update([
                'prefix' => Str::upper($request->prefix_name),
                'max_limit' => $request->max_limit_value,
            ]);
            $message = 'Awalan kamar berhasil diperbarui.';
        } else {
            RoomPrefix::create([
                'prefix' => Str::upper($request->prefix_name),
                'max_limit' => $request->max_limit_value,
                'next_number' => 1,
            ]);
            $message = 'Awalan kamar berhasil ditambahkan.';
        }

        return back()->with('success', $message);
    }

    /**
     * Delete a room prefix.
     */
    public function deletePrefix(RoomPrefix $roomPrefix)
    {
        if (RoomCode::where('code', 'LIKE', $roomPrefix->prefix . '-%')->exists()) {
            return back()->with('error', 'Tidak dapat menghapus awalan karena masih ada kode kamar yang menggunakannya.');
        }
        $roomPrefix->delete();
        return back()->with('success', 'Awalan kamar berhasil dihapus.');
    }

    // Di AdminRoomController.php
    public function getRoomCodes($roomId) // Modified to accept $roomId directly
    {
        // Temporarily bypass implicit model binding for debugging
        $room = Room::find($roomId); 

        if (!$room) {
            // Log this error if the room is not found
            Log::error("Room with ID {$roomId} not found for getRoomCodes method.");
            return response()->json(['error' => 'Kamar tidak ditemukan.'], 404);
        }

        return response()->json($room->roomCodes);
    }
}
