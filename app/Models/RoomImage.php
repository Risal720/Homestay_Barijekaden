<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class RoomImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'path',
        'alt_text',
        'order',
    ];

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Accessor to get the full asset path for the image.
     * This will automatically prepend 'asset('image/details/')' to the 'path' stored in DB.
     * Assumes file is stored in public/image/details.
     */
    public function getPathAttribute($value)
    {
        if (!$value) {
            // Return a placeholder image if no image is set
            return 'https://placehold.co/600x400/cccccc/333333?text=No+Image';
        }
        return asset('image/details/' . $value);
    }
}