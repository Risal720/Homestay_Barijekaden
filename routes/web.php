<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReviewsController;
use App\Models\Room;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home', ['tittle' => 'Home Page']);
});

Route::get('/rooms', function () {
    return view('rooms', ['tittle' => 'Rooms Page', 'rooms' => Room::all()]);
})->name('rooms.index');

Route::get('/rooms/{room:slug}', function(Room $room){
    return view('room', ['tittle' => 'Room', 'room' => $room]);
});

Route::get('/facilities', function () {
    return view('facilities', ['tittle' => 'Facilities Page']);
});


Route::get('/reviews', [App\Http\Controllers\ReviewsController::class, 'index'] );


Route::get('/about', function () {
    return view('about', ['tittle' => 'About Us']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
