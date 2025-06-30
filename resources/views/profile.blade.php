<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barijekaden Homstay's</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f2f5;
            /* Warna latar belakang abu-abu muda */
            display: flex;
            flex-direction: column;
            /* Mengatur tata letak kolom untuk navbar dan konten */
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding-top: 80px;
            /* Padding atas untuk mengakomodasi navbar tetap */
            box-sizing: border-box;
        }

        .navbar {
            width: 100%;
            background-color: #432a0b;
            /* Warna latar belakang navbar sesuai gambar */
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            /* Untuk menyebarkan item */
            align-items: center;
            color: white;
            position: fixed;
            /* Membuat navbar tetap di atas */
            top: 0;
            left: 0;
            z-index: 10;
            /* Memastikan navbar berada di atas konten lain */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* Bayangan lembut */
        }

        .navbar-brand-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            /* Jarak antara logo dan teks */
        }

        .navbar-brand-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #bf7029;
            /* Warna teks Barijekaden */
            /* Pastikan font Norican diimpor jika digunakan */
            /* @import url('https://fonts.googleapis.com/css2?family=Norican&display=swap'); */
            /* font-family: 'Norican', cursive; */
        }


        .navbar-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: white;
            /* Warna judul Profil */
            flex-grow: 1;
            /* Memungkinkan judul mengambil ruang sebanyak mungkin */
            text-align: center;
            /* Memusatkan judul */
        }

        .navbar-button {
            background-color: #357ABD;
            /* Warna biru lebih gelap untuk tombol */
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s ease-in-out;
        }

        .navbar-button:hover {
            background-color: #2a6599;
            /* Warna biru lebih gelap saat hover */
        }

        .profile-card {
            background-color: #ffffff;
            /* Latar belakang kartu putih */
            border-radius: 1.5rem;
            /* Sudut membulat */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            /* Bayangan lembut */
            padding: 2.5rem;
            /* Padding internal */
            text-align: center;
            max-width: 768px;
            /* Lebar maksimum kartu ditingkatkan untuk konten lebih banyak */
            width: 100%;
            /* Lebar responsif */
            box-sizing: border-box;
            margin-bottom: 20px;
            /* Margin bawah agar tidak terlalu mepet footer/ujung layar */
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 2rem;
        }

        .profile-picture {
            width: 120px;
            /* Lebar gambar profil */
            height: 120px;
            /* Tinggi gambar profil */
            border-radius: 50%;
            /* Bentuk lingkaran */
            object-fit: cover;
            /* Memastikan gambar mengisi area tanpa distorsi */
            border: 4px solid #4a90e2;
            /* Border biru */
            margin-bottom: 1.5rem;
            /* Margin bawah */
        }

        .profile-name {
            font-size: 2.5rem;
            /* Ukuran font besar */
            font-weight: 700;
            /* Tebal */
            color: #333333;
            /* Warna teks gelap */
            margin-bottom: 0.5rem;
            /* Margin bawah */
        }

        .profile-title {
            font-size: 1.25rem;
            /* Ukuran font sedang */
            font-weight: 600;
            /* Sedang tebal */
            color: #666666;
            /* Warna teks abu-abu */
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #333333;
            margin-top: 3rem;
            margin-bottom: 1.5rem;
            text-align: left;
            /* Rata kiri untuk judul bagian */
            border-bottom: 2px solid #e0e0e0;
            /* Garis bawah */
            padding-bottom: 0.75rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            /* Kolom responsif */
            gap: 1.5rem;
            text-align: left;
        }

        .info-item {
            background-color: #f9f9f9;
            border-radius: 0.75rem;
            padding: 1.25rem 1.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease-in-out;
        }

        .info-item:hover {
            transform: translateY(-3px);
            /* Efek angkat saat hover */
        }

        .info-item strong {
            color: #4a90e2;
            display: block;
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }

        .info-item p {
            color: #555555;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .list-item {
            background-color: #f9f9f9;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            margin-bottom: 0.75rem;
            text-align: left;
            /* Rata kiri untuk item daftar */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease-in-out;
        }

        .list-item:hover {
            transform: translateY(-3px);
            /* Efek angkat saat hover */
        }

        .list-item strong {
            color: #4a90e2;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            flex-wrap: wrap;
            /* Tombol responsif */
            justify-content: center;
        }

        .action-button {
            background-color: #4a90e2;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.2s ease-in-out;
        }

        .action-button:hover {
            background-color: #357ABD;
        }

        .review-text {
            margin-top: 0.5rem;
            font-style: italic;
            color: #777;
        }

        /* Responsivitas untuk layar kecil */
        @media (max-width: 768px) {
            .profile-card {
                padding: 1.5rem;
            }

            .profile-name {
                font-size: 2rem;
            }

            .profile-title {
                font-size: 1.1rem;
            }

            .section-title {
                font-size: 1.5rem;
                margin-top: 2rem;
                margin-bottom: 1rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
                /* Satu kolom di layar kecil */
            }

            .info-item {
                padding: 1rem;
            }

            .list-item {
                padding: 0.75rem 1rem;
            }

            .profile-header {
                text-align: center;
            }

            .button-group {
                flex-direction: column;
                align-items: center;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .navbar-title {
                font-size: 1.5rem;
            }

            .navbar-button {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-brand-group">
            <img class="size-10 mr-2" src="{{ asset('image/logo.png') }}" alt="Your Company">
            <a href="/">
                <p class="navbar-brand-text">Barijekaden</p>
            </a>
        </div>
        <div class="navbar-title">Profil</div>
        <a href="#" class="navbar-button">Kembali</a>
    </nav>

    <div class="profile-card">
        <div class="profile-header">
            <!-- Gambar Profil -->
            <img src="https://placehold.co/120x120/4a90e2/ffffff?text=JD" alt="Gambar Profil" class="profile-picture">

            <!-- Nama Pengguna -->
            <h1 class="profile-name">John Doe</h1>

            <!-- Jabatan/Status -->
            <p class="profile-title">Anggota Elite | Hotel Booking App</p>
        </div>

        <!-- Informasi Dasar Pengguna -->
        <h2 class="section-title">Informasi Dasar</h2>
        <div class="info-grid">
            <div class="info-item">
                <strong>Nama Lengkap</strong>
                <p>John Doe</p>
            </div>
            <div class="info-item">
                <strong>Alamat Email</strong>
                <p>john.doe@example.com</p>
            </div>
            <div class="info-item">
                <strong>Nomor Telepon</strong>
                <p>+62 812-3456-7890</p>
            </div>
            <div class="info-item">
                <strong>Alamat</strong>
                <p>Jl. Merdeka No. 45, Jakarta Pusat, 10110</p>
            </div>
            <div class="info-item">
                <strong>Tanggal Lahir</strong>
                <p>15 Januari 1990</p>
            </div>
            <div class="info-item">
                <strong>Jenis Kelamin</strong>
                <p>Pria</p>
            </div>
        </div>

        <!-- Ulasan Saya -->
        <h2 class="section-title">Ulasan Saya</h2>
        <div class="space-y-3">
            <div class="list-item">
                <p><strong>Ulasan untuk Hotel Indah Permai</strong></p>
                <p class="text-sm text-gray-500">Tanggal Menginap: 10-12 Juni 2025 | Rating:
                    &#9733;&#9733;&#9733;&#9733;&#9734; (4/5)</p>
                <p class="review-text">"Pengalaman menginap yang menyenangkan! Kamar bersih dan staf sangat ramah.
                    Sarapan juga enak."</p>
                <div class="button-group">
                    <a href="#" class="action-button">Edit Ulasan</a>
                    <a href="#" class="action-button" style="background-color: #dc3545;">Hapus Ulasan</a>
                </div>
            </div>
            <div class="list-item">
                <p><strong>Ulasan untuk Hotel Damai Sentosa</strong></p>
                <p class="text-sm text-gray-500">Tanggal Menginap: 01-03 Mei 2025 | Rating:
                    &#9733;&#9733;&#9733;&#9733;&#9733; (5/5)</p>
                <p class="review-text">"Hotel ini luar biasa! Pemandangan lautnya menakjubkan dan fasilitasnya lengkap.
                    Pasti akan kembali lagi."</p>
                <div class="button-group">
                    <a href="#" class="action-button">Edit Ulasan</a>
                    <a href="#" class="action-button" style="background-color: #dc3545;">Hapus Ulasan</a>
                </div>
            </div>
        </div>

        <!-- Bantuan & Dukungan -->
        <h2 class="section-title">Bantuan & Dukungan</h2>
        <div class="button-group">
            <a href="#" class="action-button">FAQ (Pertanyaan Umum)</a>
            <a href="#" class="action-button">Hubungi Kami</a>
        </div>

    </div>
</body>

</html>
