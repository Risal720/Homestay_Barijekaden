<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Digunakan untuk fungsi otentikasi
use Illuminate\Validation\ValidationException; // Digunakan untuk kesalahan validasi

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     * Dipanggil oleh Route::get('/login', [AuthController::class, 'login'])->name('login');
     */
    public function login()
    {
        // PENTING: BARIS INI YANG DIUBAH!
        // Sekarang form login ada di resources/views/home.blade.php
        return view('home'); // Mengarahkan ke halaman home yang berisi form login
    }

    /**
     * Memproses permintaan otentikasi (saat form login disubmit).
     * Dipanggil oleh Route::post('/login', [AuthController::class, 'authenticate']);
     */
    public function authenticate(Request $request)
    {
        // Validasi input dari form (email dan password harus diisi)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba untuk mengautentikasi pengguna menggunakan kredensial yang diberikan
        // `Auth::attempt` akan memeriksa kredensial terhadap data di tabel 'users'
        // `$request->boolean('remember')` akan menangani checkbox "Remember me"
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Jika otentikasi berhasil:
            // Regenerasi session ID untuk mencegah session fixation attacks
            $request->session()->regenerate();

            // Arahkan pengguna ke halaman yang mereka coba akses sebelumnya (`intended`),
            // atau ke '/dashboard' jika tidak ada tujuan sebelumnya.
            return redirect()->intended('/dashboard');
        }

        // Jika otentikasi gagal:
        // Lemparkan pengecualian validasi dengan pesan error.
        // 'auth.failed' akan mengambil pesan error default dari file bahasa Laravel (resources/lang/en/auth.php)
        throw ValidationException::withMessages([
            'email' => trans('auth.failed'),
        ]);
    }

    /**
     * Memproses permintaan logout.
     * Dipanggil oleh Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna dari aplikasi

        $request->session()->invalidate(); // Batalkan session yang ada (hapus semua data session)
        $request->session()->regenerateToken(); // Regenerasi token CSRF untuk keamanan

        // Arahkan pengguna ke halaman utama (root) setelah logout berhasil.
        return redirect('/');
    }

    // --- Opsional: Method untuk Registrasi (Jika Anda mengimplementasikan fitur registrasi) ---
    // (bagian ini tidak berubah)
}