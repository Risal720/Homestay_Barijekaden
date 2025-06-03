<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of all rooms for the user.
     */
    public function index()
    {
        // Fetch all rooms, you might want to add pagination later
        $rooms = Room::all();
        return view('rooms', compact('rooms'));
    }

    /**
     * Display the specified room details for the user.
     * Route Model Binding will automatically fetch the room by slug.
     */
    public function show(Room $room)
    {
        // Eager load room codes and room images for the specific room
        $room->load(['roomCodes', 'roomImages']);
        return view('room', compact('room'));
    }
}