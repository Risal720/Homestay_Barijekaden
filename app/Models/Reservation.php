<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pelanggan',
        'email_pelanggan',
        'nomor_telepon',
        'tanggal_check_in',
        'tanggal_check_out',
        'jumlah_tamu',
        'tipe_kamar_id', // Pastikan kolom ini ada di database Anda
        'catatan',
        'status',
        // Tambahkan kolom lain di sini jika ada di tabel 'reservations' Anda
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_check_in' => 'datetime',
        'tanggal_check_out' => 'datetime',
        'jumlah_tamu' => 'integer',
    ];

    /**
     * Get the room type associated with the reservation.
     * (Relasi dengan model Room jika Anda memilikinya)
     */
    public function room()
    {
        return $this->belongsTo(Room::class, 'tipe_kamar_id');
    }
}

