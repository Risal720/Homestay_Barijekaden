<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPrefix extends Model
{
    use HasFactory;

    protected $fillable = [
        'prefix',
        'max_limit',
        'next_number',
    ];

    // Opsional: Anda bisa menambahkan relationship jika RoomPrefix punya banyak RoomCodes
    // public function roomCodes()
    // {
    //     return $this->hasMany(RoomCode::class, 'prefix'); // Sesuaikan foreign key jika tidak standar
    // }
}