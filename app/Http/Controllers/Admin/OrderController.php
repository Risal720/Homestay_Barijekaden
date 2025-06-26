<?php

namespace App\Http\Controllers; // Pastikan namespace ini sesuai dengan lokasi OrderController Anda

use Illuminate\Http\Request;
// use App\Models\Order; // Uncomment jika Anda sudah memiliki model Order dan ingin berinteraksi dengan database

class OrderController extends Controller
{
    /**
     * Menampilkan daftar semua pesanan.
     * Metode ini dipanggil oleh rute 'admin.orders.index'.
     * Anda perlu membuat file 'index.blade.php' di 'resources/views/admin/orders/'
     * untuk method ini jika Anda belum memilikinya.
     */
    public function index()
    {
        // Contoh: Mengambil semua pesanan dari database jika Anda memiliki model Order
        // $orders = Order::all();
        // return view('admin.orders.index', compact('orders'));

        // Untuk sementara, kita bisa mengembalikan view kosong atau redirect
        return view('admin.orders.index'); // Pastikan Anda memiliki view ini
    }

    /**
     * Menampilkan form untuk membuat pesanan baru.
     * Metode ini dipanggil oleh rute 'admin.orders.create'.
     * Ini adalah metode yang perlu menampilkan 'admin.orders.create' view.
     */
    public function create()
    {
        // Baris ini sangat penting: mengembalikan view 'admin.orders.create'
        return view('admin.orders.create');
    }

    /**
     * Menyimpan pesanan baru ke database.
     * Metode ini dipanggil oleh rute 'admin.orders.store' (POST request dari form).
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'produk' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'catatan' => 'nullable|string',
        ]);

        // --- Contoh Logika Penyimpanan Data ---
        // Jika Anda memiliki model 'Order', Anda bisa menyimpannya seperti ini:
        /*
        Order::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'produk' => $request->produk,
            'jumlah' => $request->jumlah,
            'catatan' => $request->catatan,
            // Pastikan untuk menambahkan kolom lain yang sesuai dengan tabel 'orders' Anda
        ]);
        */

        // Jika Anda belum memiliki model atau tabel database 'orders',
        // Anda bisa mencetak data untuk verifikasi sementara:
        // dd($request->all());

        // Redirect kembali ke halaman daftar pesanan dengan pesan sukses
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail pesanan tertentu.
     */
    public function show($id)
    {
        // Logic untuk menampilkan detail pesanan berdasarkan ID
        // Contoh: $order = Order::findOrFail($id);
        // return view('admin.orders.show', compact('order'));
        return "Show Order ID: " . $id;
    }

    /**
     * Menampilkan form untuk mengedit pesanan tertentu.
     */
    public function edit($id)
    {
        // Logic untuk menampilkan form edit pesanan berdasarkan ID
        // Contoh: $order = Order::findOrFail($id);
        // return view('admin.orders.edit', compact('order'));
        return "Edit Order ID: " . $id;
    }

    /**
     * Memperbarui pesanan tertentu di database.
     */
    public function update(Request $request, $id)
    {
        // Logic untuk memperbarui pesanan berdasarkan ID
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil diperbarui!');
    }

    /**
     * Menghapus pesanan tertentu dari database.
     */
    public function destroy($id)
    {
        // Logic untuk menghapus pesanan berdasarkan ID
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus!');
    }
}
