<?php // Pastikan tidak ada spasi atau karakter lain di baris ini sebelum <?php

namespace App\Http\Controllers; // Pastikan tidak ada spasi di baris ini sebelum namespace

use App\Models\Order; // Pastikan Anda memiliki Model Order
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders for administration.
     * Menampilkan daftar semua pesanan untuk keperluan administrasi.
     * Dipanggil oleh GET /admin/orders
     */
    public function index()
    {
        // Ambil semua pesanan dari database
        // Anda mungkin ingin menambahkan paginasi atau filter di sini di kemudian hari
        $orders = Order::all(); // Mengasumsikan ada tabel 'orders' dan Model 'Order'

        // Mengarahkan ke view 'admin.orders.index'
        // Pastikan Anda memiliki file resources/views/admin/orders/index.blade.php
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     * Menampilkan formulir untuk membuat pesanan baru.
     */
    public function create()
    {
        // Menampilkan formulir untuk membuat pesanan baru
        return view('admin.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     * Menyimpan pesanan yang baru dibuat ke database.
     */
    public function store(Request $request)
    {
        // Logika validasi dan penyimpanan pesanan
        $validatedData = $request->validate([
            // Contoh validasi:
            // 'customer_name' => 'required|string|max:255',
            // 'room_id' => 'required|exists:rooms,id', // Jika pesanan terkait dengan kamar
            // 'total_price' => 'required|numeric|min:0',
            // 'status' => 'required|in:pending,confirmed,completed,cancelled',
            // Sesuaikan validasi ini dengan kolom di tabel 'orders' Anda
        ]);

        try {
            Order::create($validatedData); // Buat record pesanan baru
            return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Gagal menambahkan pesanan: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        // Logika validasi dan update pesanan
        $validatedData = $request->validate([
            // Contoh validasi untuk update:
            // 'customer_name' => 'required|string|max:255',
            // 'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);
        // $order->update($validatedData); // Uncomment ini setelah validasi disesuaikan
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Order::findOrFail($id)->delete();
            return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus pesanan: ' . $e->getMessage()]);
        }
    }
}
