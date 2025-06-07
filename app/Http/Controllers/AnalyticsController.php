<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function customers()
    {
        return view('admin.analytics.customers', ['title' => 'Analisis Pelanggan']);
        // Anda perlu membuat file view ini: resources/views/admin/analytics/customers.blade.php
        // Untuk sementara, Anda bisa juga hanya mengembalikan string: return "Halaman Analisis Pelanggan";
    }
}