<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan ini
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory; // Gunakan HasFactory jika Anda ingin menggunakan factory untuk seeding atau testing

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'type',
        'value',
        'min_amount',   // Pastikan kolom ini ada di tabel database Anda
        'max_uses',     // Pastikan kolom ini ada di tabel database Anda
        'starts_at',    // Pastikan kolom ini ada di tabel database Anda
        'expires_at',   // Pastikan kolom ini ada di tabel database Anda
        // Tambahkan kolom lain di sini jika ada di tabel 'discounts' Anda dan ingin diisi
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'starts_at' => 'datetime',
        'expires_at' => 'datetime',
        'value' => 'float', // Jika nilai diskon bisa desimal
        'min_amount' => 'float', // Jika jumlah minimum bisa desimal
        'max_uses' => 'integer', // Pastikan ini integer
    ];

    // Jika Anda ingin nama tabel berbeda dari 'discounts'
    // protected $table = 'nama_tabel_diskon_anda';

    // Jika Anda tidak menggunakan primary key 'id'
    // protected $primaryKey = 'uuid';

    // Jika primary key bukan auto-incrementing
    // public $incrementing = false;

    // Jika primary key bukan integer
    // protected $keyType = 'string';
}
