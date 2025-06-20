<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kamar Baru</title>
    <!-- Memuat Tailwind CSS untuk styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menggunakan font Inter secara default */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8; /* Warna latar belakang lembut */
        }
    </style>
</head>
<body class="bg-gray-100 p-4 sm:p-6 md:p-8 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 sm:p-8 md:p-10 rounded-lg shadow-xl w-full max-w-md">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 text-center">Tambah Kamar Baru</h1>

        <!-- Formulir untuk menambahkan kamar baru -->
        <!-- *** PERUBAHAN DI SINI: action mengarah ke 'admin.rooms.store' *** -->
        <form action="{{ route('admin.rooms.store') }}" method="POST">
            @csrf <!-- Token CSRF untuk keamanan Laravel -->

            <div class="mb-4">
                <label for="room_number" class="block text-gray-700 text-sm font-semibold mb-2">Nomor Kamar:</label>
                <input type="text" id="room_number" name="room_number"
                       class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                       placeholder="Contoh: A-101" required>
                <!-- Menampilkan pesan error jika ada validasi untuk room_number -->
                @error('room_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="type" class="block text-gray-700 text-sm font-semibold mb-2">Tipe Kamar:</label>
                <select id="type" name="type"
                        class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                        required>
                    <option value="">Pilih Tipe Kamar</option>
                    <option value="Standard">Standard</option>
                    <option value="Deluxe">Deluxe</option>
                    <option value="Suite">Suite</option>
                </select>
                @error('type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-sm font-semibold mb-2">Harga per Malam:</label>
                <input type="number" id="price" name="price"
                       class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                       placeholder="Contoh: 350000" min="0" step="1000" required>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="capacity" class="block text-gray-700 text-sm font-semibold mb-2">Kapasitas (Orang):</label>
                <input type="number" id="capacity" name="capacity"
                       class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                       placeholder="Contoh: 2" min="1" required>
                @error('capacity')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 w-full">
                    Simpan Kamar
                </button>
            </div>
            <div class="mt-4 text-center">
                <!-- *** PERUBAHAN DI SINI: href mengarah ke 'admin.rooms.index' *** -->
                <a href="{{ route('admin.rooms.index') }}"
                   class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 transition duration-200">
                    Kembali ke Daftar Kamar
                </a>
            </div>
        </form>
    </div>
</body>
</html>
