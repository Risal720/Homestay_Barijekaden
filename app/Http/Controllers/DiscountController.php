// app/Http/Controllers/DiscountController.php

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Discount; // Pastikan ini di-uncomment jika Anda punya model Discount

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data diskon. Contoh:
        // $discounts = \App\Models\Discount::all();

        // Jika belum ada model atau data, kirim koleksi kosong untuk menghindari error
        $discounts = collect([]);

        return view('discounts', [ // Pastikan ini mengarah ke file Blade Anda (misal: resources/views/discounts.blade.php)
            'title' => 'Discounts',
            'discounts' => $discounts // Sangat penting: kirimkan variabel $discounts ke view
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ini akan menampilkan formulir untuk menambah diskon.
        // Anda perlu membuat view ini, misal: resources/views/admin/discounts/create.blade.php
        return view('admin.discounts.create', ['title' => 'Tambah Diskon Baru']);
    }

    // ... method store, show, edit, update, destroy lainnya
}