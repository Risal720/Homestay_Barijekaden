<x-controlpanel>
    {{-- Hanya definisikan slot title sekali --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Container utama untuk layout dashboard --}}
    <div class="p-6 bg-gray-50 min-h-screen"> {{-- Tambahkan padding di sekitar dashboard, latar belakang abu-abu muda untuk kontras --}}
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Selamat datang di Dashboard Admin!</h1>

        {{-- Grid untuk statistik ringkasan di bagian atas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            {{-- Card: Pendapatan Bulan Ini --}}
            <div class="bg-emerald-100 p-6 rounded-lg shadow-md border-b-4 border-emerald-500"> {{-- Warna hijau muda untuk kartu --}}
                <h3 class="text-lg font-semibold text-emerald-800 mb-2">Pendapatan Bulan Ini</h3>
                <p class="text-3xl font-bold text-emerald-900">Rp {{ number_format($income ?? 0) }}</p>
            </div>

            {{-- Card: Placeholder Statistik 2 (contoh) --}}
            <div class="bg-emerald-100 p-6 rounded-lg shadow-md border-b-4 border-blue-500">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Total Reservasi</h3>
                <p class="text-3xl font-bold text-blue-900">150</p> {{-- Data placeholder --}}
            </div>

            {{-- Card: Placeholder Statistik 3 (contoh) --}}
            <div class="bg-emerald-100 p-6 rounded-lg shadow-md border-b-4 border-purple-500">
                <h3 class="text-lg font-semibold text-purple-800 mb-2">Kamar Tersedia</h3>
                <p class="text-3xl font-bold text-purple-900">35</p> {{-- Data placeholder --}}
            </div>
        </div>

        {{-- Grid utama untuk berbagai bagian dashboard lainnya --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6"> {{-- Layout 3 kolom untuk layar besar, 1 kolom untuk layar kecil --}}

            {{-- Kolom Kiri (misal 2/3 lebar di layar besar) --}}
            <div class="lg:col-span-2 space-y-6"> {{-- Memakan 2 kolom dari 3 di layar besar --}}

                {{-- Card: Notifikasi & Pembaruan --}}
                <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-emerald-800">Notifikasi</h2>
                    <ul>
                        @forelse($notifications as $notification)
                            <li class="border-b border-emerald-200 py-2 last:border-b-0 text-emerald-700">
                                <span class="font-medium">Pesan:</span> {{ $notification->message }}
                            </li>
                        @empty
                            <li class="py-2 text-emerald-500">Tidak ada notifikasi baru.</li>
                        @endforelse
                    </ul>
                </div>

                {{-- Card: Menu Cepat --}}
                <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-emerald-800">Menu Cepat</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4"> {{-- Grid 2 kolom untuk tombol --}}
                        <a href="{{ route('admin.products.create') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">Tambah Produk</a>
                        <a href="{{ route('admin.orders.index') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">Kelola Pesanan</a>
                        <a href="{{ route('admin.rooms.create') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">Tambah Kamar</a>
                        <a href="{{ route('admin.rooms.index') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">Kelola Kamar</a>
                    </div>
                </div>

                {{-- Card: Placeholder untuk Grafik (contoh) --}}
                <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-emerald-800">Tren Data (Contoh Grafik)</h2>
                    <div class="bg-emerald-200 h-48 flex items-center justify-center text-emerald-600 font-medium">
                        Area untuk Grafik (misal: Chart.js)
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan (misal 1/3 lebar di layar besar) --}}
            <div class="space-y-6">

                {{-- Card: Profil Pengguna --}}
                <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-emerald-800">Profil Pengguna</h2>
                    @auth
                        <p class="mb-2 text-emerald-700">Nama: <span class="font-medium">{{ Auth::user()->name }}</span></p>
                        <p class="mb-4 text-emerald-700">Email: <span class="font-medium">{{ Auth::user()->email }}</span></p>
                        <a href="{{ route('profile.settings') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">Pengaturan Akun</a>
                    @else
                        <p class="mb-4 text-emerald-500">Anda belum login.</p>
                        <a href="{{ route('login') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">Login</a>
                    @endauth
                </div>

                {{-- Card: Fitur Khusus --}}
                <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-emerald-800">Fitur Khusus</h2>
                    <div class="space-y-3"> {{-- Jarak antar tombol --}}
                        <a href="{{ route('admin.reports.sales') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">Laporan Penjualan</a>
                        <a href="{{ route('admin.analytics.customers') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">Analisis Pelanggan</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-controlpanel>

<style>
    /* CSS Kustom (jika perlu) - Pastikan Tailwind CSS sudah terkonfigurasi dengan baik */
    .btn-dashboard {
        /* Menggunakan @apply untuk mengelompokkan class Tailwind */
        @apply inline-block w-full text-center py-2 px-4 rounded-md text-white font-semibold transition duration-200 ease-in-out;
    }
</style>