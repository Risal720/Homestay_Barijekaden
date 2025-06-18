<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review; // Pastikan Anda memiliki Model Review yang benar
use App\Models\User;   // Jika Anda mengaitkan ulasan dengan pengguna
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Untuk logging error yang lebih baik

class ReviewController extends Controller
{
    /**
     * Menampilkan daftar semua ulasan.
     * Dipanggil oleh Route::get('/reviews', [ReviewController::class, 'index']);
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Mengambil semua ulasan, dengan eager loading relasi 'user'
            // dan mengurutkannya dari yang terbaru.
            // Pastikan relasi 'user' didefinisikan di model Review Anda.
            $reviews = Review::with('user')->latest()->get();

            // Jika Anda ingin menampilkan juga ulasan dari pengguna anonim,
            // dan Anda memiliki kolom `user_name` di tabel `reviews`,
            // pastikan juga untuk menanganinya di view.
            // Contoh jika user_name ada:
            // $reviews = Review::query()
            //     ->latest()
            //     ->get()
            //     ->map(function($review) {
            //         // Pastikan ada relasi user, jika tidak, gunakan user_name
            //         $review->display_name = $review->user ? $review->user->name : $review->user_name;
            //         return $review;
            //     });


            return view('reviews', compact('reviews'));
        } catch (\Exception $e) {
            Log::error('Error loading reviews: ' . $e->getMessage());
            // Berikan pesan error yang ramah pengguna atau redirect
            return redirect()->back()->with('error', 'Gagal memuat ulasan. Silakan coba lagi nanti.');
        }
    }

    /**
     * Menyimpan ulasan baru ke database.
     * Dipanggil oleh Route::post('/reviews', [ReviewController::class, 'store']);
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari formulir
        $request->validate([
            'reviewer_name' => 'required|string|max:255',
            'review_rating' => 'required|integer|min:1|max:5',
            'review_comment' => 'required|string|max:1000', // Batasi panjang komentar
        ]);

        try {
            $review = new Review();

            // Logika untuk mengaitkan ulasan dengan pengguna
            if (Auth::check()) {
                // Jika pengguna login, gunakan ID pengguna yang sedang login
                $review->user_id = Auth::id();
                // Nama pengulas bisa diambil dari pengguna yang login, atau dari input form jika diinginkan
                // $review->user_name = Auth::user()->name; // Jika Anda memiliki kolom user_name
            } else {
                // Jika pengguna TIDAK login
                // Opsi 1: Simpan nama dari input formulir ke kolom `user_name` di tabel `reviews`
                //         (Anda harus menambahkan kolom `user_name` di migration tabel `reviews`)
                $review->user_name = $request->reviewer_name;
                $review->user_id = null; // Set user_id ke null jika ulasan dari anonim diizinkan
                                        // Pastikan kolom user_id di migration Anda nullable()

                // Opsi 2: (Alternatif) Jika user_id tidak boleh null, Anda harus meminta pengguna login
                //         Atau membuat pengguna placeholder, tergantung kebijakan Anda.
                //         Jika Anda ingin memaksa login, tambahkan middleware 'auth' pada route 'reviews.store'
                //         Contoh: Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
                //         Maka Anda tidak perlu blok `else` ini.
            }

            $review->rating = $request->review_rating;
            $review->comment = $request->review_comment;
            $review->save();

            // Mengembalikan respons JSON untuk permintaan AJAX
            return response()->json(['message' => 'Ulasan berhasil disimpan!', 'review' => $review], 200);

        } catch (\Exception $e) {
            // Log kesalahan untuk debugging di server
            Log::error('Gagal menyimpan ulasan: ' . $e->getMessage() . ' - Request Data: ' . json_encode($request->all()));
            // Mengembalikan respons JSON dengan pesan error
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan ulasan. Silakan coba lagi.', 'error' => $e->getMessage()], 500);
        }
    }
}