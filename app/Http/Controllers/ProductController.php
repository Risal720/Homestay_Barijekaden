<?php

namespace App\Http\Controllers;

use App\Models\Product; // Pastikan Anda memiliki Model Product
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan ini jika Anda ingin menggunakan Str::slug() untuk slug produk

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     * Menampilkan daftar semua produk.
     * Dipanggil oleh GET /admin/products
     */
    public function index()
    {
        // Ambil semua produk dari database
        $products = Product::all(); // Mengasumsikan ada tabel 'products' dan Model 'Product'

        // Mengarahkan ke view 'admin.products.index'
        // Pastikan Anda memiliki file resources/views/admin/products/index.blade.php
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     * Menampilkan formulir untuk membuat produk baru.
     * Dipanggil oleh GET /admin/products/create
     */
    public function create()
    {
        // Mengarahkan ke view 'admin.products.create'
        // Pastikan Anda memiliki file resources/views/admin/products/create.blade.php
        return view('admin.products.create');
    }

    /**
     * Store a newly created product in storage.
     * Menyimpan produk yang baru dibuat ke database.
     * Dipanggil oleh POST /admin/products
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk dari formulir
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name', // Nama produk harus unik
            'description' => 'nullable|string', // Deskripsi boleh kosong
            'price' => 'required|numeric|min:0', // Harga harus angka dan minimal 0
            // Tambahkan validasi lain sesuai kolom di tabel 'products' Anda
            // Contoh: 'stock' => 'required|integer|min:0',
        ]);

        // 2. Tambahkan slug otomatis (opsional, tetapi direkomendasikan untuk URL yang bersih)
        // Pastikan Anda memiliki kolom 'slug' di tabel 'products' Anda (string, unique, nullable)
        $validatedData['slug'] = Str::slug($validatedData['name']);

        // 3. Simpan data ke database menggunakan Model Product
        try {
            Product::create($validatedData);

            // 4. Redirect kembali ke daftar produk dengan pesan sukses
            // Pesan ini akan ditangkap oleh session('success') di view index
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Exception $e) {
            // Tangani error jika terjadi masalah saat menyimpan
            // Redirect kembali ke formulir create dengan input sebelumnya dan pesan error
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan produk: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified product.
     * Menampilkan detail produk tertentu.
     * Dipanggil oleh GET /admin/products/{id}
     */
    public function show(string $id)
    {
        // Temukan produk berdasarkan ID, atau tampilkan 404 jika tidak ditemukan
        $product = Product::findOrFail($id);
        // Mengarahkan ke view 'admin.products.show'
        // Pastikan Anda memiliki file resources/views/admin/products/show.blade.php
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     * Menampilkan formulir untuk mengedit produk tertentu.
     * Dipanggil oleh GET /admin/products/{id}/edit
     */
    public function edit(string $id)
    {
        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($id);
        // Mengarahkan ke view 'admin.products.edit'
        // Pastikan Anda memiliki file resources/views/admin/products/edit.blade.php
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     * Memperbarui data produk tertentu di database.
     * Dipanggil oleh PUT/PATCH /admin/products/{id}
     */
    public function update(Request $request, string $id)
    {
        // Temukan produk yang akan diperbarui
        $product = Product::findOrFail($id);

        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:products,name,' . $id, // Nama produk unik, kecuali untuk produk ini sendiri
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Perbarui slug
        $validatedData['slug'] = Str::slug($validatedData['name']);

        try {
            $product->update($validatedData);
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal memperbarui produk: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified product from storage.
     * Menghapus produk tertentu dari database.
     * Dipanggil oleh DELETE /admin/products/{id}
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus produk: ' . $e->getMessage()]);
        }
    }
}
