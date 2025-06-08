<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales()
    {
        return view('admin.reports.sales', ['title' => 'Laporan Penjualan']);
        // Anda perlu membuat file view ini: resources/views/admin/reports/sales.blade.php
        // Untuk sementara, Anda bisa juga hanya mengembalikan string: return "Halaman Laporan Penjualan";
    }
}