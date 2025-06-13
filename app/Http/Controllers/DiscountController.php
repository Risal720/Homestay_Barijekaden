<?php

namespace App\Http\Controllers;

use App\Models\Discount; // Pastikan model Discount Anda ada di App\Models
use Illuminate\Http\Request;
use Illuminate\Validation\Rule; // Diperlukan untuk validasi unique saat update

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource (Menampilkan daftar semua diskon).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua data diskon dari database, diurutkan berdasarkan 'created_at' terbaru.
        // Anda bisa menambahkan pagination jika data diskon akan sangat banyak, contoh:
        // $discounts = Discount::latest()->paginate(10);
        $discounts = Discount::latest()->get();

        // Mengembalikan view 'admin.discounts.index' dan mengirimkan data diskon.
        // Pastikan file view Anda ada di: resources/views/admin/discounts/index.blade.php
        return view('admin.discounts.index', [
            'title'     => 'Daftar Diskon', // Judul halaman
            'discounts' => $discounts,     // Variabel $discounts akan tersedia di view
        ]);
    }

    /**
     * Show the form for creating a new resource (Menampilkan form untuk membuat diskon baru).
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengembalikan view 'admin.discounts.create' untuk form pembuatan diskon.
        // Pastikan file view Anda ada di: resources/views/admin/discounts/create.blade.php
        return view('admin.discounts.create', [
            'title' => 'Buat Diskon Baru', // Judul halaman
        ]);
    }

    /**
     * Store a newly created resource in storage (Menyimpan diskon baru ke database).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form.
        $request->validate([
            'name'       => 'required|string|max:255',
            'code'       => 'nullable|string|unique:discounts,code|max:50', // Code harus unik jika diisi
            'type'       => 'required|in:percentage,fixed', // Tipe diskon harus 'percentage' atau 'fixed'
            'value'      => 'required|numeric|min:0', // Nilai diskon tidak boleh negatif
            'min_amount' => 'nullable|numeric|min:0', // Jumlah minimum order
            'max_uses'   => 'nullable|integer|min:1', // Batas penggunaan diskon
            'starts_at'  => 'nullable|date', // Tanggal mulai berlaku
            'expires_at' => 'nullable|date|after_or_equal:starts_at', // Tanggal kadaluarsa harus setelah atau sama dengan tanggal mulai
        ]);

        // Membuat record diskon baru di database menggunakan data yang tervalidasi.
        // Properti $fillable di model Discount harus disetel agar ini berfungsi.
        Discount::create($request->all());

        // Mengalihkan kembali ke halaman daftar diskon dengan pesan sukses.
        return redirect()->route('admin.discounts.index')
                         ->with('success', 'Diskon berhasil ditambahkan!');
    }

    /**
     * Display the specified resource (Menampilkan detail diskon tertentu).
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount) // Menggunakan Route Model Binding
    {
        // Mengembalikan view 'admin.discounts.show' dan mengirimkan data diskon.
        // Laravel secara otomatis akan menemukan diskon berdasarkan ID di URL jika menggunakan Route Model Binding.
        // Pastikan file view Anda ada di: resources/views/admin/discounts/show.blade.php
        return view('admin.discounts.show', [
            'title'    => 'Detail Diskon', // Judul halaman
            'discount' => $discount,      // Variabel $discount akan tersedia di view
        ]);
    }

    /**
     * Show the form for editing the specified resource (Menampilkan form untuk mengedit diskon).
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount) // Menggunakan Route Model Binding
    {
        // Mengembalikan view 'admin.discounts.edit' dan mengirimkan data diskon.
        // Pastikan file view Anda ada di: resources/views/admin/discounts/edit.blade.php
        return view('admin.discounts.edit', [
            'title'    => 'Edit Diskon', // Judul halaman
            'discount' => $discount,    // Variabel $discount akan tersedia di view
        ]);
    }

    /**
     * Update the specified resource in storage (Memperbarui diskon di database).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount) // Menggunakan Route Model Binding
    {
        // Validasi data yang masuk dari form.
        // Rule::unique di sini menggunakan $discount->id untuk mengecualikan diskon yang sedang diedit dari pemeriksaan keunikan code.
        $request->validate([
            'name'       => 'required|string|max:255',
            'code'       => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('discounts')->ignore($discount->id), // Pastikan code unik, kecuali untuk diskon ini sendiri
            ],
            'type'       => 'required|in:percentage,fixed',
            'value'      => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'max_uses'   => 'nullable|integer|min:1',
            'starts_at'  => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        // Memperbarui record diskon di database.
        $discount->update($request->all());

        // Mengalihkan kembali ke halaman daftar diskon dengan pesan sukses.
        return redirect()->route('admin.discounts.index')
                         ->with('success', 'Diskon berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage (Menghapus diskon dari database).
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount) // Menggunakan Route Model Binding
    {
        // Menghapus record diskon dari database.
        $discount->delete();

        // Mengalihkan kembali ke halaman daftar diskon dengan pesan sukses.
        return redirect()->route('admin.discounts.index')
                         ->with('success', 'Diskon berhasil dihapus!');
    }
}
