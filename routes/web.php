<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminRoomController;
use App\Models\Room;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['tittle' => 'Home Page']);
});

// User-facing Room Routes
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::get('/rooms/{room:slug}', [RoomController::class, 'show'])->name('rooms.show');

Route::get('/facilities', function () {
    return view('facilities', ['tittle' => 'Facilities Page']);
});

Route::get('/reviews', [App\Http\Controllers\ReviewsController::class, 'index'] );

Route::get('/about', function () {
    return view('about', ['tittle' => 'About Us']);
});

Route::get('/dashboard', function () {
    return view('dashboard', ['tittle' => 'Dashboard']);
});

Route::get('/booking', function () {
    return view('booking', ['tittle' => 'Booking']);
});

Route::get('/discounts', function () {
    return view('discounts', ['tittle' => 'Discount']);
});

// Admin Dashboard/Settings Route
Route::get('/settings', function () {
    return view('settings', ['tittle' => 'Settings']);
})->name('admin.settings');

Route::get('/reservation', function () {
    return view('reservation', ['tittle' => 'Reservation']);
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']); // Removed duplicate login route

// Admin Routes for Room Management
Route::prefix('admin')->name('admin.')->group(function () {
    // PENTING: Pindahkan rute spesifik ini di atas Route::resource
    Route::post('rooms/{room}/add-code', [AdminRoomController::class, 'addRoomCode'])->name('rooms.add_code');
    Route::post('room-codes/{roomCode}/status', [AdminRoomController::class, 'updateRoomCodeStatus'])->name('room_codes.update_status');
    Route::delete('room-codes/{roomCode}', [AdminRoomController::class, 'deleteRoomCode'])->name('room_codes.destroy');

    Route::resource('rooms', AdminRoomController::class); // Route::resource harus di bawah rute spesifik

    Route::delete('room-images/{roomImage}', [AdminRoomController::class, 'deleteRoomImage'])->name('room_images.destroy');
    Route::post('room-prefixes', [AdminRoomController::class, 'storeOrUpdatePrefix'])->name('room_prefixes.store_update');
    Route::delete('room-prefixes/{roomPrefix}', [AdminRoomController::class, 'deletePrefix'])->name('room_prefixes.destroy');
});