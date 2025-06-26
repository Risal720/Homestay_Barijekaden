<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Diskon Baru</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6; /* Light gray background */
        }
        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }
        .btn-primary {
            background-color: #3b82f6; /* Blue */
            border-color: #3b82f6;
        }
        .btn-primary:hover {
            background-color: #2563eb; /* Darker blue */
        }
        .btn-secondary {
            background-color: #6b7280; /* Gray */
            border-color: #6b7280;
        }
        .btn-secondary:hover {
            background-color: #4b5563; /* Darker gray */
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="container mx-auto p-4 md:p-6 lg:p-8 max-w-2xl">
        <div class="card bg-white rounded-lg p-6 shadow-lg">
            <div class="card-header border-b pb-4 mb-4">
                <h2 class="text-2xl font-semibold text-gray-800">Form Buat Diskon Baru</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.discounts.store') }}" method="POST" class="space-y-4">
                    @csrf <!-- Ini penting untuk keamanan Laravel -->

                    <!-- Tambah field Name -->
                    <div class="form-group">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Diskon:</label>
                        <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="name" name="name" required value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="kode_diskon" class="block text-sm font-medium text-gray-700">Kode Diskon:</label>
                        <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="kode_diskon" name="kode_diskon" value="{{ old('kode_diskon') }}">
                        <p class="mt-1 text-xs text-gray-500">Kosongkan jika ingin digenerate otomatis, atau masukkan kode unik.</p>
                        @error('kode_diskon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tipe_diskon" class="block text-sm font-medium text-gray-700">Tipe Diskon:</label>
                        <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="tipe_diskon" name="tipe_diskon" required>
                            <option value="">Pilih Tipe Diskon</option>
                            <option value="percentage" {{ old('tipe_diskon') == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                            <option value="fixed" {{ old('tipe_diskon') == 'fixed' ? 'selected' : '' }}>Jumlah Tetap</option>
                        </select>
                        @error('tipe_diskon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nilai_diskon" class="block text-sm font-medium text-gray-700">Nilai Diskon:</label>
                        <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="nilai_diskon" name="nilai_diskon" min="0" step="0.01" required value="{{ old('nilai_diskon') }}">
                        <p class="mt-1 text-xs text-gray-500">Jika persentase, masukkan 1-100. Jika jumlah tetap, masukkan nilai rupiah.</p>
                        @error('nilai_diskon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jika Anda ingin menggunakan min_amount, tambahkan input ini -->
                    <!--
                    <div class="form-group">
                        <label for="min_amount" class="block text-sm font-medium text-gray-700">Minimum Jumlah Pembelian:</label>
                        <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="min_amount" name="min_amount" min="0" step="0.01" value="{{ old('min_amount') }}">
                        <p class="mt-1 text-xs text-gray-500">Minimum jumlah pembelian agar diskon berlaku. Kosongkan jika tidak ada.</p>
                        @error('min_amount')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    -->

                    <div class="form-group">
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai:</label>
                        <input type="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="tanggal_mulai" name="tanggal_mulai" required value="{{ old('tanggal_mulai') }}">
                        @error('tanggal_mulai')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_berakhir" class="block text-sm font-medium text-gray-700">Tanggal Berakhir (Opsional):</label>
                        <input type="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="tanggal_berakhir" name="tanggal_berakhir" value="{{ old('tanggal_berakhir') }}">
                        @error('tanggal_berakhir')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="batas_penggunaan" class="block text-sm font-medium text-gray-700">Batas Penggunaan (Opsional):</label>
                        <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="batas_penggunaan" name="batas_penggunaan" min="0" value="{{ old('batas_penggunaan') }}">
                        <p class="mt-1 text-xs text-gray-500">Jumlah total kali diskon bisa digunakan. Kosongkan jika tidak ada batas.</p>
                        @error('batas_penggunaan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 btn-primary">Simpan Diskon</button>
                        <a href="{{ route('admin.discounts.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
