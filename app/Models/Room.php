<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto_logo',
        'nama_room',
        'harga_room',
        'slug',
        'detail_room',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(RoomImage::class);
    }

    public function getFotoLogoPathAttribute()
    {
        return $this->foto_logo ? asset('images/rooms/logos/' . $this->foto_logo) : asset('images/rooms/default-logo.jpg');
    }
}