<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Daftar Reservasi' }}</title>
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
        .btn-success {
            background-color: #10b981; /* Green */
            border-color: #10b981;
        }
        .btn-success:hover {
            background-color: #059669; /* Darker green */
        }
        .btn-danger {
            background-color: #ef4444; /* Red */
            border-color: #ef4444;
        }
        .btn-danger:hover {
            background-color: #dc2626; /* Darker red */
        }
        .table-header th {
            background-color: #e5e7eb; /* Light gray for table header */
            padding: 12px 20px;
            text-align: left;
            font-size: 0.875rem; /* text-sm */
            font-weight: 600; /* font-semibold */
            color: #4b5563; /* text-gray-700 */
        }
        .table-row td {
            padding: 12px 20px;
            border-bottom: 1px solid #e5e7eb; /* border-gray-200 */
            font-size: 0.875rem; /* text-sm */
            color: #374151; /* text-gray-800 */
        }
        .pagination-link {
            padding: 8px 12px;
            margin: 0 4px;
            border-radius: 0.375rem; /* rounded-md */
            background-color: #e5e7eb; /* bg-gray-200 */
            color: #374151; /* text-gray-800 */
            text-decoration: none;
        }
        .pagination-link.active {
            background-color: #3b82f6; /* bg-blue-500 */
            color: white;
        }
        .pagination-link:hover:not(.active) {
            background-color: #d1d5db; /* bg-gray-300 */
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 p-4 sm:p-6 lg:p-8">
    <div class="container mx-auto max-w-7xl">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">{{ $title ?? 'Daftar Reservasi' }}</h1>
            {{-- INI ADALAH TOMBOL YANG ANDA KLIK --}}
            <a href="{{ route('admin.reservations.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150 btn-primary">
                + Tambah Reservasi Baru
            </a>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="table-header">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-out</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Tamu</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Kamar</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($reservations as $reservation)
                            <tr class="table-row">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->nama_pelanggan }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->tanggal_check_in->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->tanggal_check_out->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->jumlah_tamu }}</td>
                                {{-- Pastikan relasi room() di model Reservation sudah benar dan tabel rooms punya kolom 'name' --}}
                                <td class="px-6 py-4 whitespace-nowrap">{{ $reservation->room->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($reservation->status === 'confirmed') bg-green-100 text-green-800
                                        @elseif($reservation->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($reservation->status === 'cancelled') bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.reservations.show', $reservation->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">Lihat</a>
                                    <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Edit</a>
                                    <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus reservasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">Tidak ada data reservasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="p-4">
                {{ $reservations->links('vendor.pagination.tailwind') }} {{-- Menggunakan pagination Tailwind CSS --}}
            </div>
        </div>
    </div>
</body>
</html>
