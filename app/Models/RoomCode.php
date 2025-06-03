<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'code',
        'status', // 'Tersedia' or 'Tidak Tersedia'
    ];

    /**
     * Get the room that owns the room code.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}