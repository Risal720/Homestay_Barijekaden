<?php

namespace App\Http\Controllers;

use App\Models\Reservation; // Pastikan Anda memiliki model Reservation
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource (Menampilkan daftar semua reservasi).
     * Ini kemungkinan adalah halaman yang Anda lihat di screenshot.
     */
    public function index()
    {
        // Mengambil semua reservasi (contoh sederhana)
        $reservations = Reservation::latest()->paginate(10); // Atau sesuai kebutuhan

        return view('admin.reservations.index', [
            'title'        => 'Manajemen Reservasi',
            'reservations' => $reservations,
        ]);
    }

    /**
     * Show the form for creating a new resource (Menampilkan form untuk membuat reservasi baru).
     */
    public function create()
    {
        // Anda bisa meneruskan data lain ke view jika diperlukan,
        // seperti daftar kamar yang tersedia, atau daftar layanan.
        return view('admin.reservations.create', [
            'title' => 'Tambah Reservasi Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage (Menyimpan reservasi baru ke database).
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email_pelanggan' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_check_in' => 'required|date|after_or_equal:today',
            'tanggal_check_out' => 'required|date|after:tanggal_check_in',
            'jumlah_tamu' => 'required|integer|min:1',
            'tipe_kamar_id' => 'required|exists:rooms,id', // Asumsi ada tabel 'rooms' dan id_kamar adalah 'tipe_kamar_id'
            'catatan' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled', // Status reservasi
        ]);

        try {
            DB::beginTransaction();
            Reservation::create($validatedData);
            DB::commit();

            return redirect()->route('admin.reservations.index')
                             ->with('success', 'Reservasi berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating reservation: ' . $e->getMessage());
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Terjadi kesalahan saat menambahkan reservasi. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('admin.reservations.show', [
            'title'       => 'Detail Reservasi',
            'reservation' => $reservation,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        return view('admin.reservations.edit', [
            'title'       => 'Edit Reservasi',
            'reservation' => $reservation,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $validatedData = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email_pelanggan' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_check_in' => 'required|date|after_or_equal:today',
            'tanggal_check_out' => 'required|date|after:tanggal_check_in',
            'jumlah_tamu' => 'required|integer|min:1',
            'tipe_kamar_id' => 'required|exists:rooms,id',
            'catatan' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        try {
            DB::beginTransaction();
            $reservation->update($validatedData);
            DB::commit();

            return redirect()->route('admin.reservations.index')
                             ->with('success', 'Reservasi berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating reservation ' . $reservation->id . ': ' . $e->getMessage());
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Terjadi kesalahan saat memperbarui reservasi. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        try {
            DB::beginTransaction();
            $reservation->delete();
            DB::commit();

            return redirect()->route('admin.reservations.index')
                             ->with('success', 'Reservasi berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting reservation ' . $reservation->id . ': ' . $e->getMessage());
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat menghapus reservasi. Silakan coba lagi.');
        }
    }
}
