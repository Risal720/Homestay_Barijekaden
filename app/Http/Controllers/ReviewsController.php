<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


namespace App\Http\Controllers;

use App\Models\Review;

class ReviewsController extends Controller
{
    public function index()
{
    $reviews = Review::with('user')->get();
    return view('reviews', [
        'tittle' => 'Reviews Page',
        'reviews' => $reviews
    ]);
}
}