<?php

namespace App\Http\Controllers;

use App\Models\Discount; // Pastikan model Discount Anda ada di App\Models
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB; // Diperlukan untuk transaksi database (opsional)
use Illuminate\Support\Facades\Log; // Diperlukan untuk logging error (opsional)

// Import Policy jika Anda akan menggunakannya untuk otorisasi (opsional)
// use App\Policies\DiscountPolicy;
// use Illuminate\Auth\Access\AuthorizationException; // Diperlukan jika menggunakan kebijakan/policy

class DiscountController extends Controller
{
    /**
     * Konstruktor
     * Anda bisa menambahkan middleware otorisasi di sini
     * untuk menerapkan kebijakan akses di seluruh controller.
     */
    public function __construct()
    {
        // Contoh: Hanya pengguna yang memiliki kemampuan 'manage-discounts' yang bisa mengakses semua metode
        // $this->middleware('can:manage-discounts');

        // Contoh: Menggunakan Laravel Policy (pastikan DiscountPolicy dibuat)
        // $this->authorizeResource(Discount::class, 'discount');
    }

    /**
     * Display a listing of the resource (Menampilkan daftar semua diskon).
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Opsi 1: Mengambil semua data diskon
        // $discounts = Discount::latest()->get();

        // Opsi 2: Menggunakan paginasi (lebih disarankan untuk data banyak)
        $discounts = Discount::latest()->paginate(10); // Menampilkan 10 diskon per halaman

        return view('admin.discounts.index', [
            'title'     => 'Daftar Diskon',
            'discounts' => $discounts,
        ]);
    }

    /**
     * Show the form for creating a new resource (Menampilkan form untuk membuat diskon baru).
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Jika Anda menggunakan Policy dan ingin otorisasi per metode
        // $this->authorize('create', Discount::class);

        return view('admin.discounts.create', [
            'title' => 'Buat Diskon Baru',
        ]);
    }

    /**
     * Store a newly created resource in storage (Menyimpan diskon baru ke database).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Jika Anda menggunakan Policy
        // $this->authorize('create', Discount::class);

        // Validasi disesuaikan dengan nama input dari form HTML
        $validatedData = $request->validate([
            'name'             => 'required|string|max:255', // Pastikan Anda menambahkan input 'name' di form HTML
            'kode_diskon'      => 'nullable|string|unique:discounts,code|max:50',
            'tipe_diskon'      => 'required|in:percentage,fixed',
            'nilai_diskon'     => 'required|numeric|min:0',
            'tanggal_mulai'    => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
            'batas_penggunaan' => 'nullable|integer|min:1',
            // 'min_amount' => 'nullable|numeric|min:0', // Jika Anda masih ingin menggunakan 'min_amount', tambahkan di form HTML
        ]);

        try {
            DB::beginTransaction();

            // Mapping data dari nama input form ke nama kolom database (jika berbeda)
            Discount::create([
                'name'         => $validatedData['name'],
                'code'         => $validatedData['kode_diskon'],
                'type'         => $validatedData['tipe_diskon'],
                'value'        => $validatedData['nilai_diskon'],
                'starts_at'    => $validatedData['tanggal_mulai'],
                'expires_at'   => $validatedData['tanggal_berakhir'],
                'max_uses'     => $validatedData['batas_penggunaan'],
                // 'min_amount' => $validatedData['min_amount'] ?? null, // Sesuaikan jika 'min_amount' ada di form
            ]);

            DB::commit();

            return redirect()->route('admin.discounts.index')
                             ->with('success', 'Diskon berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika ada error
            Log::error('Error creating discount: ' . $e->getMessage()); // Catat error
            return redirect()->back()
                             ->withInput() // Isi kembali form dengan input sebelumnya
                             ->with('error', 'Terjadi kesalahan saat menambahkan diskon. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource (Menampilkan detail diskon tertentu).
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        // Jika Anda menggunakan Policy
        // $this->authorize('view', $discount);

        return view('admin.discounts.show', [
            'title'    => 'Detail Diskon',
            'discount' => $discount,
        ]);
    }

    /**
     * Show the form for editing the specified resource (Menampilkan form untuk mengedit diskon).
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        // Jika Anda menggunakan Policy
        // $this->authorize('update', $discount);

        return view('admin.discounts.edit', [
            'title'    => 'Edit Diskon',
            'discount' => $discount,
        ]);
    }

    /**
     * Update the specified resource in storage (Memperbarui diskon di database).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        // Jika Anda menggunakan Policy
        // $this->authorize('update', $discount);

        // Validasi disesuaikan dengan nama input dari form HTML
        $validatedData = $request->validate([
            'name'             => 'required|string|max:255', // Pastikan Anda menambahkan input 'name' di form HTML
            'kode_diskon'      => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('discounts', 'code')->ignore($discount->id),
            ],
            'tipe_diskon'      => 'required|in:percentage,fixed',
            'nilai_diskon'     => 'required|numeric|min:0',
            'tanggal_mulai'    => 'nullable|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
            'batas_penggunaan' => 'nullable|integer|min:1',
            // 'min_amount' => 'nullable|numeric|min:0', // Jika Anda masih ingin menggunakan 'min_amount', tambahkan di form HTML
        ]);

        try {
            DB::beginTransaction();

            // Mapping data dari nama input form ke nama kolom database (jika berbeda)
            $discount->update([
                'name'         => $validatedData['name'],
                'code'         => $validatedData['kode_diskon'],
                'type'         => $validatedData['tipe_diskon'],
                'value'        => $validatedData['nilai_diskon'],
                'starts_at'    => $validatedData['tanggal_mulai'],
                'expires_at'   => $validatedData['tanggal_berakhir'],
                'max_uses'     => $validatedData['batas_penggunaan'],
                // 'min_amount' => $validatedData['min_amount'] ?? null, // Sesuaikan jika 'min_amount' ada di form
            ]);

            DB::commit();

            return redirect()->route('admin.discounts.index')
                             ->with('success', 'Diskon berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating discount ' . $discount->id . ': ' . $e->getMessage());
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Terjadi kesalahan saat memperbarui diskon. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage (Menghapus diskon dari database).
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        // Jika Anda menggunakan Policy
        // $this->authorize('delete', $discount);

        try {
            DB::beginTransaction();
            $discount->delete();
            DB::commit();

            return redirect()->route('admin.discounts.index')
                             ->with('success', 'Diskon berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting discount ' . $discount->id . ': ' . $e->getMessage());
            return redirect()->back()
                             ->with('error', 'Terjadi kesalahan saat menghapus diskon. Silakan coba lagi.');
        }
    }
}
