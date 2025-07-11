<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barijekaden Homstay's</title>
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
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 text-center">Tambah Produk Baru</h1>

        <!-- Formulir untuk menambahkan produk baru -->
        <!-- Action akan mengarah ke route 'admin.products.store' yang akan menangani penyimpanan data -->
        <!-- Method POST digunakan untuk mengirimkan data formulir -->
        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf <!-- Token CSRF untuk keamanan Laravel -->

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-semibold mb-2">Nama Produk:</label>
                <input type="text" id="name" name="name"
                       class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                       placeholder="Contoh: Sarapan Pagi" required>
                <!-- Menampilkan pesan error jika ada validasi untuk 'name' -->
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-semibold mb-2">Deskripsi:</label>
                <textarea id="description" name="description" rows="4"
                          class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                          placeholder="Deskripsi singkat produk..."></textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="price" class="block text-gray-700 text-sm font-semibold mb-2">Harga:</label>
                <input type="number" id="price" name="price"
                       class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                       placeholder="Contoh: 50000" min="0" step="1000" required>
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline transition duration-200 w-full">
                    Simpan Produk
                </button>
            </div>
            <div class="mt-4 text-center">
                <a href="{{ route('admin.products.index') }}"
                   class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 transition duration-200">
                    Kembali ke Daftar Produk
                </a>
            </div>
        </form>
    </div>
</body>
</html>
