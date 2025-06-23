<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk', // Contoh: sesuaikan dengan kolom di tabel produk Anda
        'harga',
        'deskripsi',
        // tambahkan kolom lain yang relevan
    ];
    // Atau gunakan protected $guarded = []; jika Anda ingin mengizinkan semua kolom
}