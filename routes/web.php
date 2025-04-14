<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['tittle' => 'Home Page']);
});

Route::get('/room', function () {
    return view('room', ['tittle' => 'Room Page']);
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
