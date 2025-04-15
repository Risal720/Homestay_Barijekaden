<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', ['tittle' => 'Home Page']);
});

Route::get('/room', function () {
    return view('room', ['tittle' => 'Room Page', 'room' => [
        [
            'id' => '1',
            'slug' => 'judul-artikel-1',
            'tittle' => 'Judul Artikel 1',
            'author' => 'Risal Subekti',
            'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem illum rem quidem, porro eaque nobis nostrum alias ratione obcaecati ipsa debitis mollitia voluptatibus! Et deserunt nemo repellat officiis veniam earum.'
        ],

        [
            'id' => '2',
            'slug' => 'judul-artikel-2',
            'tittle' => 'Judul Artikel 2',
            'author' => 'Risal Subekti',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat illo, sequi laudantium deserunt architecto similique quas aperiam? Dolor fugit ratione inventore. Sapiente cupiditate dolorum consequatur animi corrupti odit vitae totam.'
        ]
        ]]);
});

Route::get('/room/{slug}', function($slug){
    $room = [
        [
            'id' => '1',
            'slug' => 'judul-artikel-1',
            'tittle' => 'Judul Artikel 1',
            'author' => 'Risal Subekti',
            'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorem illum rem quidem, porro eaque nobis nostrum alias ratione obcaecati ipsa debitis mollitia voluptatibus! Et deserunt nemo repellat officiis veniam earum.'
        ],

        [
            'id' => '2',
            'slug' => 'judul-artikel-2',
            'tittle' => 'Judul Artikel 2',
            'author' => 'Risal Subekti',
            'body' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat illo, sequi laudantium deserunt architecto similique quas aperiam? Dolor fugit ratione inventore. Sapiente cupiditate dolorum consequatur animi corrupti odit vitae totam.'
        ]
    ];
    $post = Arr::first($room, function($post) use ($slug) {
        return $post['slug'] == $slug;
    });
    return view('post', ['tittle' => 'Single Post', 'post' => $post]);
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
