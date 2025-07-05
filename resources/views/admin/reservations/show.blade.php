{{-- resources/views/admin/reservations/show.blade.php --}}

@extends('layouts.app') {{-- Asumsikan Anda menggunakan layout aplikasi, sesuaikan jika berbeda --}}

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $title }}</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600 font-semibold">ID Reservasi:</p>
                <p class="text-lg font-medium">{{ $reservation->id }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Nama Pelanggan:</p>
                <p class="text-lg font-medium">{{ $reservation->nama_pelanggan }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Email Pelanggan:</p>
                <p class="text-lg font-medium">{{ $reservation->email_pelanggan }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Nomor Telepon:</p>
                <p class="text-lg font-medium">{{ $reservation->nomor_telepon }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Check-in:</p>
                <p class="text-lg font-medium">{{ \Carbon\Carbon::parse($reservation->tanggal_check_in)->format('d F Y') }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Check-out:</p>
                <p class="text-lg font-medium">{{ \Carbon\Carbon::parse($reservation->tanggal_check_out)->format('d F Y') }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Jumlah Tamu:</p>
                <p class="text-lg font-medium">{{ $reservation->jumlah_tamu }}</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Tipe Kamar ID:</p>
                <p class="text-lg font-medium">{{ $reservation->tipe_kamar_id }}</p>
                {{-- Anda mungkin ingin menampilkan nama kamar, bukan hanya ID.
                     Jika ada relasi, bisa menjadi $reservation->room->name atau sejenisnya. --}}
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Status:</p>
                <p class="text-lg font-medium">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        @if($reservation->status == 'pending') bg-yellow-200 text-yellow-800
                        @elseif($reservation->status == 'confirmed') bg-green-200 text-green-800
                        @elseif($reservation->status == 'cancelled') bg-red-200 text-red-800
                        @endif">
                        {{ ucfirst($reservation->status) }}
                    </span>
                </p>
            </div>
            <div class="col-span-1 md:col-span-2">
                <p class="text-gray-600 font-semibold">Catatan:</p>
                <p class="text-lg font-medium">{{ $reservation->catatan ?? 'Tidak ada catatan' }}</p>
            </div>
        </div>

        <div class="mt-6 flex space-x-2">
            <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Edit Reservasi
            </a>
            <a href="{{ route('admin.reservations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-full">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
