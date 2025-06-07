<x-controlpanel>
    {{-- Hanya definisikan slot title sekali --}}
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="dashboard">
        <p>Selamat datang di Dashboard Admin!</p> {{-- Pesan selamat datang --}}

        <!-- Ringkasan Data & Statistik -->
        <section class="summary">
            <h2>Ringkasan Data</h2>
            <div class="stats">
                {{-- Pastikan variabel $income dikirim dari DashboardController --}}
                <p>Pendapatan Bulan Ini: Rp {{ number_format($income ?? 0) }}</p> {{-- Menambahkan ?? 0 untuk mencegah error jika $income null --}}
                {{-- Tambahkan statistik lain di sini jika ada, contoh: --}}
                {{-- <p>Total Kamar Terisi: {{ $bookedRooms ?? 0 }}</p> --}}
            </div>
        </section>

        <!-- Navigasi & Menu Cepat -->
        <section class="quick-menu">
            <h2>Menu Cepat</h2>
            {{-- Pastikan ini adalah rute admin yang benar --}}
            <a href="{{ route('admin.products.create') }}" class="btn">Tambah Produk</a>
            <a href="{{ route('admin.orders.index') }}" class="btn">Kelola Pesanan</a>
            <a href="{{ route('admin.rooms.create') }}" class="btn">Tambah Kamar</a> {{-- Menambahkan contoh rute untuk tambah kamar --}}
            <a href="{{ route('admin.rooms.index') }}" class="btn">Kelola Kamar</a> {{-- Menambahkan contoh rute untuk kelola kamar --}}
        </section>

        <!-- Notifikasi & Pembaruan -->
        <section class="notifications">
            <h2>Notifikasi</h2>
            <ul>
                {{-- Pastikan variabel $notifications dikirim dari DashboardController --}}
                @forelse($notifications as $notification) {{-- Menggunakan @forelse untuk kasus notifikasi kosong --}}
                    <li>{{ $notification->message }}</li>
                @empty
                    <li>Tidak ada notifikasi baru.</li>
                @endforelse
            </ul>
        </section>

        <!-- Manajemen Pengguna & Profil -->
        <section class="user-management">
            <h2>Profil Pengguna</h2>
            @auth
                <p>Nama: {{ Auth::user()->name }}</p>
                <p>Email: {{ Auth::user()->email }}</p> {{-- Menambahkan email --}}
                {{-- PERHATIAN: Rute 'profile.settings' ini HARUS didefinisikan di routes/web.php --}}
                <a href="{{ route('profile.settings') }}" class="btn">Pengaturan Akun</a>
            @else
                <p>Anda belum login.</p>
                <a href="{{ route('login') }}" class="btn">Login</a>
            @endauth
        </section>

        <!-- Tools & Fitur Khusus -->
        <section class="tools">
            <h2>Fitur Khusus</h2>
            {{-- Pastikan ini adalah rute admin yang benar --}}
            <a href="{{ route('admin.reports.sales') }}" class="btn">Laporan Penjualan</a>
            <a href="{{ route('admin.analytics.customers') }}" class="btn">Analisis Pelanggan</a>
        </section>
    </div>
</x-controlpanel>
