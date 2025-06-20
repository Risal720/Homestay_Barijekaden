<?php // Pastikan tidak ada spasi atau karakter lain di baris ini sebelum <?php

namespace App\Http\Controllers; // Pastikan tidak ada spasi di baris ini sebelum namespace

use Illuminate\Http\Request;
use App\Models\Order; // Pastikan Anda mengimpor Model Order

class ReportController extends Controller
{
    /**
     * Menampilkan laporan penjualan.
     * Dipanggil oleh GET /admin/reports/sales
     */
    public function sales()
    {
        // Ambil data penjualan dari database.
        // Contoh: Mengambil semua pesanan yang statusnya 'completed' atau 'confirmed'
        $salesData = Order::whereIn('status', ['completed', 'confirmed'])->get();

        // Atau, jika Anda ingin mengambil semua pesanan tanpa filter:
        // $salesData = Order::all();

        // Mengarahkan ke view 'admin.reports.sales' dan mengirimkan data penjualan
        // Pastikan file resources/views/admin/reports/sales.blade.php sudah ada
        return view('admin.reports.sales', compact('salesData'));
    }

    // Anda bisa menambahkan metode laporan lain di sini
    // public function monthlySales()
    // {
    //     // Logika untuk laporan penjualan bulanan
    // }
}
