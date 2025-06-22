<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * Nama tabel di database yang terhubung dengan model ini.
     * Defaultnya adalah bentuk plural dari nama model (Order -> orders).
     * Jika tabel Anda bernama 'orders', baris ini tidak wajib, tapi bagus untuk eksplisit.
     */
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     * Kolom-kolom di tabel yang boleh diisi secara massal (mass assignment).
     * Pastikan semua kolom yang akan Anda isi dari formulir ada di sini.
     */
    protected $fillable = [
        'customer_name', // Contoh kolom: nama pelanggan
        'room_id',       // Contoh kolom: ID kamar yang dipesan (foreign key)
        'check_in_date', // Contoh kolom: tanggal check-in
        'check_out_date',// Contoh kolom: tanggal check-out
        'total_price',   // Contoh kolom: total harga pesanan
        'status',        // Contoh kolom: status pesanan (pending, confirmed, cancelled, completed)
        // Tambahkan kolom lain yang ada di tabel 'orders' Anda
    ];

    /**
     * The attributes that should be cast to native types.
     * Contoh untuk mengubah tipe data kolom secara otomatis.
     * Jika Anda memiliki kolom tanggal, sangat direkomendasikan untuk menggunakan 'datetime'.
     */
    protected $casts = [
        'check_in_date' => 'datetime',
        'check_out_date' => 'datetime',
        'total_price' => 'float', // Contoh: memastikan total_price adalah float
    ];

    /**
     * Define the relationship with the Room model.
     * Mendefinisikan relasi dengan Model Room.
     * Asumsi satu pesanan terkait dengan satu kamar.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Anda bisa menambahkan relasi lain di sini, misalnya ke User jika ada user yang memesan
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
