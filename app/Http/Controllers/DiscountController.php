<?php // PASTIКAN INI ADALAH HAL PERTAMA DI FILE, TANPA SPASI ATAU KARAKTER DI DEPANNYA

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount; // Pastikan ini di-uncomment jika Anda punya model Discount
// Tambahkan use statement untuk model Discount Anda jika sudah ada.
// Contoh: use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Menampilkan daftar semua diskon.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Logika untuk menampilkan daftar diskon
        // return view('admin.discounts.index'); // Sesuaikan dengan nama view Anda
        return view('discounts.index', ['title' => 'Discounts']); // Contoh umum untuk view admin
    }

    /**
     * Menampilkan form untuk membuat diskon baru.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Logika untuk menampilkan form pembuatan diskon
        // return view('admin.discounts.create'); // Sesuaikan dengan nama view Anda
        return view('discounts.create', ['title' => 'Buat Diskon Baru']);
    }

    /**
     * Menyimpan diskon baru ke database.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Logika untuk validasi dan menyimpan diskon
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|unique:discounts,code|max:50', // asumsi ada tabel discounts
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        // Jika Anda memiliki model Discount, uncomment baris ini:
        // Discount::create($request->all());

        return redirect()->route('admin.discounts.index')->with('success', 'Diskon berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail diskon tertentu.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Jika Anda memiliki model Discount, uncomment baris ini:
        // $discount = Discount::findOrFail($id);
        // return view('discounts.show', compact('discount'));
        return view('discounts.show', ['title' => 'Detail Diskon', 'id' => $id]); // Contoh sementara
    }

    /**
     * Menampilkan form untuk mengedit diskon.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Jika Anda memiliki model Discount, uncomment baris ini:
        // $discount = Discount::findOrFail($id);
        // return view('discounts.edit', compact('discount'));
        return view('discounts.edit', ['title' => 'Edit Diskon', 'id' => $id]); // Contoh sementara
    }

    /**
     * Memperbarui diskon di database.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Logika untuk validasi dan memperbarui diskon
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|unique:discounts,code,' . $id . '|max:50', // asumsi ada tabel discounts
            'type' => 'required|in:percentage,fixed',
            'value' => 'required|numeric|min:0',
            'min_amount' => 'nullable|numeric|min:0',
            'max_uses' => 'nullable|integer|min:1',
            'starts_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:starts_at',
        ]);

        // Jika Anda memiliki model Discount, uncomment baris ini:
        // $discount = Discount::findOrFail($id);
        // $discount->update($request->all());

        return redirect()->route('admin.discounts.index')->with('success', 'Diskon berhasil diperbarui!');
    }

    /**
     * Menghapus diskon dari database.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Jika Anda memiliki model Discount, uncomment baris ini:
        // $discount = Discount::findOrFail($id);
        // $discount->delete();

        return redirect()->route('admin.discounts.index')->with('success', 'Diskon berhasil dihapus!');
    }
}
