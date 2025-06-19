<?php

use App\Http\Controllers\AuthController;
// use App\Http\Controllers\ReviewsAppController; // Dihapus karena tidak terlihat digunakan di sini
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminRoomController; // Dipastikan ada
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ReviewController; // Dipastikan ada

use App\Models\Room; // Dipastikan ada jika dipakai
// use Illuminate\Support\Arr; // Dihapus karena tidak terlihat digunakan di sini
use Illuminate\Support\Facades\Route;

// Rute Halaman Utama
Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
})->name('home');

// Rute Kamar yang Menghadap Pengguna (User-facing Room Routes)
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room:slug}', [RoomController::class, 'show'])->name('rooms.show');

// Rute Halaman Fasilitas
Route::get('/facilities', function () {
    return view('facilities', ['title' => 'Facilities Page']);
})->name('facilities');

// Rute Halaman Ulasan
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Rute Halaman Tentang Kami
Route::get('/about', function () {
    return view('about', ['title' => 'About Us']);
})->name('about');

// Rute Dashboard Utama
// PENTING: Middleware 'auth' DIHAPUS agar bisa diakses tanpa login.
// KEMBALIKAN INI UNTUK APLIKASI PRODUKSI!
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rute Halaman Pemesanan
Route::get('/booking', function () {
    return view('booking', ['title' => 'Booking']);
})->name('booking');

// Rute Dashboard Admin/Pengaturan
// PENTING: Middleware 'auth' DIHAPUS agar bisa diakses tanpa login.
// KEMBALIKAN INI UNTUK APLIKASI PRODUKSI!
Route::get('/settings', function () {
    return view('settings', ['title' => 'Settings']);
})->name('admin.settings'); // middleware('auth') DIHAPUS

// Rute Halaman Reservasi
Route::get('/reservation', function () {
    return view('reservation', ['title' => 'Reservation']);
})->name('reservation');

// Rute Otentikasi (Login dan Registrasi)
Route::get('/login', [AuthController::class, 'login'])->name('login'); // Menampilkan form login (view home)
Route::post('/login', [AuthController::class, 'authenticate']); // Memproses data login

// Rute untuk menampilkan form registrasi (Jika Anda ingin mengimplementasikan fitur registrasi)
// Jika Anda belum memiliki method showRegistrationForm di AuthController, ini bisa dikomentari dulu
// Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']); // Memproses data registrasi (Pastikan method register ada di AuthController)

// Rute Logout (PENTING: Gunakan method POST dan berikan nama rute)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Rute Admin untuk Manajemen Kamar, Produk, Pesanan, Laporan, Analisis, dan Diskon
// PENTING: Middleware 'auth' DIHAPUS dari grup ini agar bisa diakses tanpa login.
// KEMBALIKAN INI UNTUK APLIKASI PRODUKSI!
Route::prefix('admin')->name('admin.')->group(function () { // middleware('auth') DIHAPUS dari sini
    // Rute spesifik untuk Manajemen Kamar (PENTING: Pindahkan rute spesifik ini di atas Route::resource agar diprioritaskan)
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

    // Rute untuk Manajemen Analisis
    Route::get('analytics/customers', [AnalyticsController::class, 'customers'])->name('analytics.customers');

    // Resource Route untuk Manajemen Diskon
    Route::resource('discounts', DiscountController::class);
});