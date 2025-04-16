<?php

use App\Models\Room;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home', ['tittle' => 'Home Page']);
});

Route::get('/rooms', function () {
    return view('rooms', ['tittle' => 'Room Page', 'rooms' => Room::all()]);
});

Route::get('/rooms/{slug}', function($slug){
    $room = Room::find($slug);
    return view('room', ['tittle' => 'Single Post', 'room' => $room]);
});

Route::get('/facilities', function () {
    return view('facilities', ['tittle' => 'Facilities Page']);
});

Route::get('/reviews', function () {
    return view('reviews', ['tittle' => 'Reviews Page']);
});

Route::get('/contact', function () {
    return view('contact', ['tittle' => 'Contact Page']);
});
