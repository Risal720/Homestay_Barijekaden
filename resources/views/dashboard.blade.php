<x-controlpanel>
    {{-- Hanya definisikan slot title sekali --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Container utama untuk layout dashboard --}}
    <div class="p-6 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Selamat datang di Dashboard Admin!</h1>

        {{-- Grid untuk statistik ringkasan di bagian atas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-emerald-100 p-6 rounded-lg shadow-md border-b-4 border-emerald-500">
                <h3 class="text-lg font-semibold text-emerald-800 mb-2">Pendapatan Bulan Ini</h3>
                <p class="text-3xl font-bold text-emerald-900">Rp {{ number_format($income ?? 0) }}</p>
            </div>

            <div class="bg-emerald-100 p-6 rounded-lg shadow-md border-b-4 border-blue-500">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Total Reservasi</h3>
                <p class="text-3xl font-bold text-blue-900">150</p>
            </div>

            <div class="bg-emerald-100 p-6 rounded-lg shadow-md border-b-4 border-purple-500">
                <h3 class="text-lg font-semibold text-purple-800 mb-2">Kamar Tersedia</h3>
                <p class="text-3xl font-bold text-purple-900">35</p>
            </div>
        </div>

        {{-- Grid utama untuk berbagai bagian dashboard lainnya --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 space-y-6">

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
                    {{-- Mengubah gap-4 agar sesuai gambar --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Tombol "Tambah Produk" --}}
                        <a href="{{ route('admin.products.create') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">
                            <i class="fa-solid fa-plus-circle mr-2"></i> Tambah Produk
                        </a>
                        {{-- Tombol "Kelola Pesanan" --}}
                        <a href="{{ route('admin.orders.index') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">
                            <i class="fa-solid fa-clipboard-list mr-2"></i> Kelola Pesanan
                        </a>
                        {{-- Tombol "Tambah Kamar" --}}
                        <a href="{{ route('admin.rooms.create') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">
                            <i class="fa-solid fa-bed mr-2"></i> Tambah Kamar
                        </a>
                        {{-- Tombol "Kelola Kamar" --}}
                        <a href="{{ route('admin.rooms.index') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">
                            <i class="fa-solid fa-hotel mr-2"></i> Kelola Kamar
                        </a>
                    </div>
                </div>

                {{-- Card: Placeholder untuk Grafik (contoh) --}}
                <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-emerald-800">Tren Data </h2>
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
                        {{-- PERBAIKAN SAYA: Mengarahkan ke admin.settings jika 'profile.settings' belum ada --}}
                        <a href="{{ route('admin.settings') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">
                            <i class="fa-solid fa-user-cog mr-2"></i> Pengaturan Akun
                        </a>
                    @else
                        <p class="mb-4 text-emerald-500">Anda belum login.</p>
                        {{-- Ini yang PENTING: Mengarah ke halaman home yang berisi form login --}}
                        <a href="{{ route('home') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">
                            <i class="fa-solid fa-right-to-bracket mr-2"></i> Login
                        </a>
                    @endauth
                </div>

                {{-- Card: Fitur Khusus --}}
                <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4 text-emerald-800">Fitur Khusus</h2>
                    <div class="space-y-3">
                        <a href="{{ route('admin.reports.sales') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">
                            <i class="fa-solid fa-chart-line mr-2"></i> Laporan Penjualan
                        </a>
                        <a href="{{ route('admin.analytics.customers') }}" class="btn-dashboard bg-emerald-500 hover:bg-emerald-600">
                            <i class="fa-solid fa-users-viewfinder mr-2"></i> Analisis Pelanggan
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-controlpanel>

{{-- PENTING: HAPUS SEMUA BLOK <style> INI JIKA MASIH ADA DI FILE INI --}}
{{-- Kode CSS kustom (seperti .btn-dashboard) harus ada di resources/css/app.css --}}