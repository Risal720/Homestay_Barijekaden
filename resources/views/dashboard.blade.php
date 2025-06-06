<x-controlpanel>
<<<<<<< HEAD
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <p>ini dashboard</p>
=======
    <x-slot:title>{{ $tittle }}</x-slot:title>

    <div class="dashboard">
        <!-- Ringkasan Data & Statistik -->
        <section class="summary">
            <h2>Ringkasan Data</h2>
            <div class="stats">
                <p>Pendapatan Bulan Ini: Rp {{ number_format($income) }}</p>
            </div>
        </section>

        <!-- Navigasi & Menu Cepat -->
        <section class="quick-menu">
            <h2>Menu Cepat</h2>
            <a href="{{ route('products.create') }}" class="btn">Tambah Produk</a>
            <a href="{{ route('orders.index') }}" class="btn">Kelola Pesanan</a>
        </section>

        <!-- Notifikasi & Pembaruan -->
        <section class="notifications">
            <h2>Notifikasi</h2>
            <ul>
                @foreach($notifications as $notification)
                    <li>{{ $notification->message }}</li>
                @endforeach
            </ul>
        </section>

        <!-- Manajemen Pengguna & Profil -->
        <section class="user-management">
            <h2>Profil Pengguna</h2>
            <p>Nama: {{ Auth::user()->name }}</p>
            <a href="{{ route('profile.settings') }}" class="btn">Pengaturan Akun</a>
        </section>

        <!-- Tools & Fitur Khusus -->
        <section class="tools">
            <h2>Fitur Khusus</h2>
            <a href="{{ route('reports.sales') }}" class="btn">Laporan Penjualan</a>
            <a href="{{ route('analytics.customers') }}" class="btn">Analisis Pelanggan</a>
        </section>
    </div>
</x-controlpanel>
>>>>>>> 71a5ce30d70cbb8660228de8fee35ba67da67e60
