<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DiscountController; 
use App\Models\Room;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

// Rute Halaman Utama
Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

// Rute Kamar yang Menghadap Pengguna (User-facing Room Routes)
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room:slug}', [RoomController::class, 'show'])->name('rooms.show');

// Rute Halaman Fasilitas
Route::get('/facilities', function () {
    return view('facilities', ['title' => 'Facilities Page']);
});

// Rute Halaman Ulasan
Route::get('/reviews', [App\Http\Controllers\ReviewsController::class, 'index'] );

// Rute Halaman Tentang Kami
Route::get('/about', function () {
    return view('about', ['title' => 'About Us']);
});

// Rute Dashboard Utama
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rute Halaman Pemesanan
Route::get('/booking', function () {
    return view('booking', ['tittle' => 'Booking']);
});


Route::get('/discounts', function () {
    return view('discounts', ['tittle' => 'Discount']);
});

// >>>>>> BAGIAN YANG DIHAPUS/DIUBAH <<<<<<
// Rute ini dikomentari karena rute `admin.discounts.index` akan menanganinya
// Route::get('/discounts', function () {
//     return view('discounts', ['title' => 'Discount']);
// });
// >>>>>> AKHIR BAGIAN YANG DIHAPUS/DIUBAH <<<<<<
f16b6539ffc89b7b6cd08a3430a190fbae4fb091


// Rute Dashboard Admin/Pengaturan
Route::get('/settings', function () {
    return view('settings', ['tittle' => 'Settings']);
})->name('admin.settings');

// Rute Halaman Reservasi
Route::get('/reservation', function () {
    return view('reservation', ['tittle' => 'Reservation']);
});

// Rute Otentikasi (Login dan Registrasi)
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/register', [AuthController::class, 'register']);

// Rute Admin untuk Manajemen Kamar, Produk, Pesanan, Laporan, Analisis, dan Diskon
Route::prefix('admin')->name('admin.')->group(function () {
    // Rute spesifik untuk Manajemen Kamar (PENTING: Pindahkan rute spesifik ini di atas Route::resource)
    Route::post('rooms/{room}/add-code', [AdminRoomController::class, 'addRoomCode'])->name('rooms.add_code');
    Route::post('room-codes/{roomCode}/status', [AdminRoomController::class, 'updateRoomCodeStatus'])->name('room_codes.update_status');
    Route::delete('room-codes/{roomCode}', [AdminRoomController::class, 'deleteRoomCode'])->name('room_codes.destroy');
    Route::get('rooms/{room}/room-codes', [AdminRoomController::class, 'getRoomCodes'])->name('rooms.get_room_codes');

    // Resource Route untuk Manajemen Kamar (akan membuat rute CRUD standar)
    Route::resource('rooms', AdminRoomController::class);

    // Rute spesifik untuk Manajemen Gambar Kamar dan Awalan Kamar
    Route::delete('room-images/{roomImage}', [AdminRoomController::class, 'deleteRoomImage'])->name('room_images.destroy');
    Route::post('room-prefixes', [AdminRoomController::class, 'storeOrUpdatePrefix'])->name('room_prefixes.store_update');
    Route::delete('room-prefixes/{roomPrefix}', [AdminRoomController::class, 'deletePrefix'])->name('room_prefixes.destroy');

    // Resource Route untuk Manajemen Produk
    Route::resource('products', ProductController::class);

    // Resource Route untuk Manajemen Pesanan
    Route::resource('orders', OrderController::class);

    // Rute untuk Laporan (misalnya, laporan penjualan)
    Route::get('reports/sales', [ReportController::class, 'sales'])->name('reports.sales');

    // --- Tambahan untuk Manajemen Analisis ---
    // Definisikan rute spesifik untuk analisis pelanggan
    Route::get('analytics/customers', [AnalyticsController::class, 'customers'])->name('analytics.customers');
    // --- Akhir tambahan ---

    // --- TAMBAHAN UNTUK DISCOUNT MANAGEMENT ---
    // Resource Route untuk Manajemen Diskon (ini akan membuat rute CRUD standar untuk diskon dengan awalan admin.)
    Route::resource('discounts', DiscountController::class);
    // --- AKHIR TAMBAHAN ---
});
