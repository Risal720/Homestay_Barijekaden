<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pesanan Baru</title>
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
                <h2 class="text-2xl font-semibold text-gray-800">Form Tambah Pesanan Baru</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.store') }}" method="POST" class="space-y-4">
                    @csrf <!-- Ini penting untuk keamanan Laravel -->

                    <div class="form-group">
                        <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan:</label>
                        <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="nama_pelanggan" name="nama_pelanggan" required>
                    </div>

                    <div class="form-group">
                        <label for="produk" class="block text-sm font-medium text-gray-700">Produk:</label>
                        <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="produk" name="produk" required>
                    </div>

                    <div class="form-group">
                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah:</label>
                        <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="jumlah" name="jumlah" min="1" required>
                    </div>

                    <div class="form-group">
                        <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan (Opsional):</label>
                        <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="catatan" name="catatan" rows="3"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 btn-primary">Simpan Pesanan</button>
                        <a href="{{ route('admin.orders.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
