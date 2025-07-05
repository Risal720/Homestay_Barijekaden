{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Aplikasi Laravel' }}</title> {{-- Menampilkan judul dari view, atau default 'Aplikasi Laravel' --}}

    {{-- Link ke Tailwind CSS CDN. Untuk produksi, disarankan menggunakan kompilasi aset. --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Warna latar belakang umum */
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    {{-- Contoh Navbar --}}
    <nav class="bg-blue-600 p-4 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-2xl font-bold">Homestay Barjekaden</a>
            <div>
                <a href="{{ route('admin.reservations.index') }}" class="text-white hover:text-blue-200 px-3 py-2 rounded-md text-sm font-medium">Reservasi</a>
                {{-- Tambahkan link navigasi lain di sini --}}
            </div>
        </div>
    </nav>

    {{-- Konten Utama Aplikasi --}}
    <main class="flex-grow py-8">
        {{-- Pesan Sukses atau Error (jika ada) --}}
        @if (session('success'))
            <div class="container mx-auto px-4 mb-4">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="container mx-auto px-4 mb-4">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @yield('content') {{-- Di sinilah konten dari view seperti show.blade.php akan disisipkan --}}
    </main>

    {{-- Contoh Footer --}}
    <footer class="bg-gray-800 text-white p-4 mt-8">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Homestay Barjekaden. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
