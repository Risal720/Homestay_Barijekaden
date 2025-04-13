<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/room', function () {
    return view('room');
});

Route::get('/facilities', function () {
    return view('facilities');
});

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/contact', function () {
    return view('contact');
});
