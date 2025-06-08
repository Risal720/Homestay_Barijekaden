<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'title' => 'Dashboard',
            'income' => 1500000, // Contoh data income
            'notifications' => [
                (object)['message' => 'Pesanan baru dari Budi'],
                (object)['message' => 'Produk berhasil ditambahkan'],
            ]
        ]);
    }
 }
