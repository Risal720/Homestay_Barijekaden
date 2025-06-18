<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review; // Asumsi Anda punya model Review
use Illuminate\Support\Facades\Auth; // Jika Anda menggunakan otentikasi

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'review_rating' => 'required|integer|min:1|max:5',
            'review_comment' => 'required|string',
        ]);

        try {
            // Simpan ulasan ke database
            $review = new Review();
            // Jika user login, gunakan user_id dari Auth
            // Perlu disesuaikan dengan logika Anda apakah review bisa anonim atau harus login
            if (Auth::check()) {
                $review->user_id = Auth::id();
            } else {
                // Contoh jika reviewer_name dari form akan disimpan di kolom terpisah
                // atau jika Anda ingin mengaitkannya dengan user_id tertentu untuk anonim
                $review->user_name = $request->reviewer_name; // Pastikan kolom ini ada di tabel reviews
                $review->user_id = null; // Atau ID user default jika diperlukan
            }

            $review->rating = $request->review_rating;
            $review->comment = $request->review_comment;
            $review->save();

            return response()->json(['message' => 'Ulasan berhasil disimpan!', 'review' => $review], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan ulasan.', 'error' => $e->getMessage()], 500);
        }
    }
}