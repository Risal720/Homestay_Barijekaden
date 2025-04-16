<?php 

namespace App\Models;
use Illuminate\Support\Arr;

class Room{
    public static function all(){
        return [
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
    }

    public static function find($slug){
        // return Arr::first(static::all(), function($room) use ($slug) {
        //     return $room['slug'] == $slug;
        // }); (CALLBACK)

        $room = Arr::first(static::all(), fn ($room) => $room['slug'] == $slug);
        if (!$room){
            abort(404);
        }
        return $room;
    }
}