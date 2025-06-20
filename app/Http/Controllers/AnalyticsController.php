<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;   // Asumsi Anda memiliki Model User untuk data pelanggan
use App\Models\Order;  // Atau Anda bisa mengambil data dari Order jika itu sumber data pelanggan Anda
use Illuminate\Support\Facades\DB; // Untuk query database yang lebih kompleks

class AnalyticsController extends Controller
{
    /**
     * Menampilkan analisis data pelanggan.
     * Dipanggil oleh GET /admin/analytics/customers
     */
    public function customers()
    {
        // Contoh sederhana: Mengambil semua pengguna (asumsi mereka adalah pelanggan)
        // $customersData = User::all();

        // Contoh lebih kompleks: Menghitung jumlah pesanan dan total pengeluaran per pelanggan
        // Ini mengasumsikan ada kolom 'user_id' di tabel 'orders' Anda
        $customersData = DB::table('orders')
            ->select(
                'user_id', // Jika Anda memiliki user_id di tabel orders
                DB::raw('COUNT(id) as order_count'),
                DB::raw('SUM(total_price) as total_spent')
            )
            // ->join('users', 'orders.user_id', '=', 'users.id') // Jika ingin mengambil nama dari tabel users
            ->groupBy('user_id') // Group berdasarkan user_id
            ->get();

        // Jika Anda tidak memiliki user_id di tabel orders dan hanya melacak nama pelanggan di tabel orders
        // Maka Anda perlu mengambil data dari tabel orders itu sendiri
        // $customersData = DB::table('orders')
        //     ->select(
        //         'customer_name',
        //         DB::raw('COUNT(id) as order_count'),
        //         DB::raw('SUM(total_price) as total_spent')
        //     )
        //     ->groupBy('customer_name')
        //     ->get();

        // Untuk contoh ini, saya akan menggunakan dummy data atau mengambil dari Order Model
        // Jika Anda tidak memiliki tabel user, gunakan saja Order model dan group by customer_name
        $customersData = Order::select(
                'customer_name', // Asumsi ada kolom customer_name di tabel orders
                DB::raw('COUNT(id) as order_count'),
                DB::raw('SUM(total_price) as total_spent')
            )
            ->groupBy('customer_name')
            ->get();


        // Mengarahkan ke view 'admin.analytics.customers' dan mengirimkan data pelanggan
        // Pastikan file resources/views/admin/analytics/customers.blade.php sudah ada
        return view('admin.analytics.customers', compact('customersData'));
    }

    // Anda bisa menambahkan metode analisis lain di sini
    // public function trafficSources()
    // {
    //     // Logika untuk analisis sumber trafik
    // }
}
