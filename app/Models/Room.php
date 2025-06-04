<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_logo',    // Thumbnail/main image path
        'nama_room',    // Room name
        'harga_room',   // Room price
        'slug',         // Unique slug for URL
        'detail_room',  // Room description/details
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * The "booted" method of the model.
     * Automatically generate slug when creating/updating a room.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($room) {
            $room->slug = Str::slug($room->nama_room);
        });

        static::updating(function ($room) {
            if ($room->isDirty('nama_room')) {
                $room->slug = Str::slug($room->nama_room);
            }
        });
    }

    /**
     * Accessor to get the full asset path for the foto_logo.
     * Assumes file is stored directly in public/image/logos.
     */
    public function getFotoLogoAttribute($value)
    {
        if (!$value) {
            // Return a placeholder image if no logo is set
            return 'https://placehold.co/200x150/cccccc/333333?text=No+Logo';
        }
        // Return the full URL using asset() for public/image/logos
        return asset('image/logos/' . $value);
    }

    /**
     * Get the room codes associated with the room.
     */
    public function roomCodes()
    {
        return $this->hasMany(RoomCode::class);
    }

    /**
     * Get the room images associated with the room.
     */
    public function roomImages()
    {
        return $this->hasMany(RoomImage::class)->orderBy('order');
    }
}