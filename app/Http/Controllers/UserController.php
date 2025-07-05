<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Pastikan Anda mengimpor model User
use Illuminate\Support\Facades\Hash; // Untuk meng-hash password

class UserController extends Controller
{
    /**
     * Menampilkan daftar semua pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::all(); // Mengambil semua data pengguna dari database
        return view('admin.users.index', [ // Mengembalikan view 'admin/users/index.blade.php'
            'title' => 'Manajemen Pengguna',
            'users' => $users // Mengirim data pengguna ke view
        ]);
    }

    /**
     * Menampilkan form untuk membuat pengguna baru.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create', ['title' => 'Tambah Pengguna Baru']);
    }

    /**
     * Menyimpan pengguna baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi data input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Gunakan Hash::make() untuk enkripsi password
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail satu pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.users.show', ['title' => 'Detail Pengguna', 'user' => $user]);
    }

    /**
     * Menampilkan form untuk mengedit pengguna.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', ['title' => 'Edit Pengguna', 'user' => $user]);
    }

    /**
     * Memperbarui pengguna di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Abaikan email saat ini untuk update
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }

        $request->validate($rules);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    /**
     * Menghapus pengguna dari database.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
