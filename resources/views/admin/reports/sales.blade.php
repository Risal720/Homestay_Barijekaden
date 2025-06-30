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
<body class="bg-gray-100 p-4 sm:p-6 md:p-8">
    <div class="container mx-auto bg-white p-6 rounded-lg shadow-xl">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-6 text-center">Laporan Penjualan</h1>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-md" role="alert">
                <p class="font-bold">Sukses!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <div class="mb-6 flex justify-end">
            <a href="{{ route('dashboard') }}"
               class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg inline-block transition duration-200">
                Kembali ke Dashboard
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md">
                <thead>
                    <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID Pesanan</th>
                        <th class="py-3 px-6 text-left">Nama Pelanggan</th>
                        <th class="py-3 px-6 text-left">Tanggal Check-in</th>
                        <th class="py-3 px-6 text-left">Tanggal Check-out</th>
                        <th class="py-3 px-6 text-right">Total Harga</th>
                        <th class="py-3 px-6 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @forelse($salesData as $sale)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $sale->id }}</td>
                        <td class="py-3 px-6 text-left">{{ $sale->customer_name ?? 'N/A' }}</td>
                        <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($sale->check_in_date)->format('d M Y') ?? 'N/A' }}</td>
                        <td class="py-3 px-6 text-left">{{ \Carbon\Carbon::parse($sale->check_out_date)->format('d M Y') ?? 'N/A' }}</td>
                        <td class="py-3 px-6 text-right">Rp {{ number_format($sale->total_price ?? 0, 0, ',', '.') }}</td>
                        <td class="py-3 px-6 text-left">{{ $sale->status }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-3 px-6 text-center text-gray-500">Tidak ada data penjualan yang ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
