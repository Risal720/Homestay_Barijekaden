{{-- resources/views/admin/reservations/edit.blade.php --}}

@extends('layouts.app') {{-- Asumsikan Anda menggunakan layout aplikasi, sesuaikan jika berbeda --}}

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $title }} - {{ $reservation->id }}</h1>

        {{-- Form untuk mengedit reservasi --}}
        <form action="{{ route('admin.reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Penting: Gunakan method PUT/PATCH untuk update di Laravel --}}

            <div class="mb-4">
                <label for="nama_pelanggan" class="block text-gray-700 text-sm font-bold mb-2">Nama Pelanggan:</label>
                <input type="text" name="nama_pelanggan" id="nama_pelanggan"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                              @error('nama_pelanggan') border-red-500 @enderror"
                       value="{{ old('nama_pelanggan', $reservation->nama_pelanggan) }}" required>
                @error('nama_pelanggan')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email_pelanggan" class="block text-gray-700 text-sm font-bold mb-2">Email Pelanggan:</label>
                <input type="email" name="email_pelanggan" id="email_pelanggan"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                              @error('email_pelanggan') border-red-500 @enderror"
                       value="{{ old('email_pelanggan', $reservation->email_pelanggan) }}" required>
                @error('email_pelanggan')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="nomor_telepon" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon:</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                              @error('nomor_telepon') border-red-500 @enderror"
                       value="{{ old('nomor_telepon', $reservation->nomor_telepon) }}" required>
                @error('nomor_telepon')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_check_in" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Check-in:</label>
                <input type="date" name="tanggal_check_in" id="tanggal_check_in"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                              @error('tanggal_check_in') border-red-500 @enderror"
                       value="{{ old('tanggal_check_in', \Carbon\Carbon::parse($reservation->tanggal_check_in)->format('Y-m-d')) }}" required>
                @error('tanggal_check_in')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal_check_out" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Check-out:</label>
                <input type="date" name="tanggal_check_out" id="tanggal_check_out"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                              @error('tanggal_check_out') border-red-500 @enderror"
                       value="{{ old('tanggal_check_out', \Carbon\Carbon::parse($reservation->tanggal_check_out)->format('Y-m-d')) }}" required>
                @error('tanggal_check_out')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jumlah_tamu" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Tamu:</label>
                <input type="number" name="jumlah_tamu" id="jumlah_tamu" min="1"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                              @error('jumlah_tamu') border-red-500 @enderror"
                       value="{{ old('jumlah_tamu', $reservation->jumlah_tamu) }}" required>
                @error('jumlah_tamu')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tipe_kamar_id" class="block text-gray-700 text-sm font-bold mb-2">Tipe Kamar ID:</label>
                {{-- Ini bisa diganti dengan dropdown jika Anda memiliki daftar kamar dari database --}}
                <input type="number" name="tipe_kamar_id" id="tipe_kamar_id"
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                              @error('tipe_kamar_id') border-red-500 @enderror"
                       value="{{ old('tipe_kamar_id', $reservation->tipe_kamar_id) }}" required>
                @error('tipe_kamar_id')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                <select name="status" id="status"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                               @error('status') border-red-500 @enderror"
                        required>
                    <option value="pending" {{ old('status', $reservation->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ old('status', $reservation->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ old('status', $reservation->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="catatan" class="block text-gray-700 text-sm font-bold mb-2">Catatan (Opsional):</label>
                <textarea name="catatan" id="catatan" rows="4"
                          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                                 @error('catatan') border-red-500 @enderror">{{ old('catatan', $reservation->catatan) }}</textarea>
                @error('catatan')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full focus:outline-none focus:shadow-outline">
                    Perbarui Reservasi
                </button>
                <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
