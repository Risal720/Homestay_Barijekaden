<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AnalyticsController; // Tambahkan ini
use App\Models\Room;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['title' => 'Home Page']);
});

// User-facing Room Routes
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room:slug}', [RoomController::class, 'show'])->name('rooms.show');

Route::get('/facilities', function () {
    return view('facilities', ['title' => 'Facilities Page']);
});

Route::get('/reviews', [App\Http\Controllers\ReviewsController::class, 'index'] );

Route::get('/about', function () {
    return view('about', ['title' => 'About Us']);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/booking', function () {
    return view('booking', ['title' => 'Booking']);
});

Route::get('/discounts', function () {
    return view('discounts', ['title' => 'Discount']);
});

// Admin Dashboard/Settings Route
Route::get('/settings', function () {
    return view('settings', ['title' => 'Settings']);
})->name('admin.settings');

Route::get('/reservation', function () {
    return view('reservation', ['title' => 'Reservation']);
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/register', [AuthController::class, 'register']);

// Admin Routes for Room, Product, Order, Report, and Analytics Management
Route::prefix('admin')->name('admin.')->group(function () {
    // PENTING: Pindahkan rute spesifik ini di atas Route::resource
    Route::post('rooms/{room}/add-code', [AdminRoomController::class, 'addRoomCode'])->name('rooms.add_code');
    Route::post('room-codes/{roomCode}/status', [AdminRoomController::class, 'updateRoomCodeStatus'])->name('room_codes.update_status');
    Route::delete('room-codes/{roomCode}', [AdminRoomController::class, 'deleteRoomCode'])->name('room_codes.destroy');

    // Pastikan rute ini berada DI ATAS Route::resource('rooms', AdminRoomController::class);
    Route::get('rooms/{room}/room-codes', [AdminRoomController::class, 'getRoomCodes'])->name('rooms.get_room_codes');

    Route::resource('rooms', AdminRoomController::class);

    Route::delete('room-images/{roomImage}', [AdminRoomController::class, 'deleteRoomImage'])->name('room_images.destroy');
    Route::post('room-prefixes', [AdminRoomController::class, 'storeOrUpdatePrefix'])->name('room_prefixes.store_update');
    Route::delete('room-prefixes/{roomPrefix}', [AdminRoomController::class, 'deletePrefix'])->name('room_prefixes.destroy');

    // Untuk Product Management
    Route::resource('products', ProductController::class);

    // Untuk Order Management
    Route::resource('orders', OrderController::class);

    // Untuk Report Management
    Route::get('reports/sales', [ReportController::class, 'sales'])->name('reports.sales');

    // --- Tambahan untuk Analytics Management ---
    // Definisikan rute spesifik untuk analisis pelanggan
    Route::get('analytics/customers', [AnalyticsController::class, 'customers'])->name('analytics.customers');
    // --- Akhir tambahan ---
});
