<x-controlpanel>
    <x-slot:title>{{ $title }}</x-slot:title>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barijekaden Homsetay's</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom CSS untuk melengkapi Tailwind */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F9F5F0; /* Warna latar belakang yang lembut */
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-confirmed {
            background-color: #D1FAE5; /* Hijau */
            color: #065F46;
        }
        .status-pending {
            background-color: #FEF3C7; /* Kuning */
            color: #92400E;
        }
        .status-cancelled {
            background-color: #FEE2E2; /* Merah */
            color: #991B1B;
        }
        .status-completed {
            background-color: #DBEAFE; /* Biru */
            color: #1E40AF;
        }
        /* Style untuk scrollbar agar lebih estetik */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #C87941;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a16235;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#C87941',
                        'primary-dark': '#a16235',
                        background: '#F9F5F0',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background">

    <!-- Main Content -->
    <main class="flex-1 p-6 md:p-10">
        
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-800">Manajemen Reservasi</h2>
                <p class="text-gray-500 mt-1">Kelola semua reservasi pelanggan di sini.</p>
            </div>
            <!-- TOMBOL TAMBAH RESERVASI YANG SUDAH DIPERBAIKI -->
            <a href="{{ route('admin.reservations.create') }}" class="mt-4 md:mt-0 bg-primary hover:bg-primary-dark text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" /></svg>
                Tambah Reservasi
            </a>
        </div>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-sm font-medium text-gray-500">Reservasi Hari Ini</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">15</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-sm font-medium text-gray-500">Total Tamu Hari Ini</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">45 <span class="text-lg font-medium text-gray-600">Orang</span></p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h3 class="text-sm font-medium text-gray-500">Menunggu Konfirmasi</h3>
                <p class="text-3xl font-bold text-yellow-500 mt-2">3</p>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="date" value="2025-06-14" class="p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                <select class="p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option>Semua Status</option>
                    <option>Dikonfirmasi</option>
                    <option>Tertunda</option>
                    <option>Dibatalkan</option>
                    <option>Selesai</option>
                </select>
                <div class="md:col-span-2 relative">
                    <input type="text" placeholder="Cari nama, kontak, atau catatan..." class="w-full p-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <svg class="w-5 h-5 text-gray-400 absolute top-1/2 left-3 transform -translate-y-1/2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
            </div>
        </div>

        <!-- Reservation Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Pelanggan</th>
                            <th scope="col" class="px-6 py-3">Kontak</th>
                            <th scope="col" class="px-6 py-3">Tanggal & Waktu</th>
                            <th scope="col" class="px-6 py-3 text-center">Pax</th>
                            <th scope="col" class="px-6 py-3 text-center">Status</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Item 1 -->
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">Budi Santoso</td>
                            <td class="px-6 py-4">081234567890</td>
                            <td class="px-6 py-4">14 Jun 2025, 19:00</td>
                            <td class="px-6 py-4 text-center">4</td>
                            <td class="px-6 py-4 text-center">
                                <span class="status-badge status-confirmed">Dikonfirmasi</span>
                            </td>
                            <td class="px-6 py-4 text-center flex justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                <button class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                        <!-- Item 2 -->
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">Citra Lestari</td>
                            <td class="px-6 py-4">citra.l@email.com</td>
                            <td class="px-6 py-4">14 Jun 2025, 18:30</td>
                            <td class="px-6 py-4 text-center">2</td>
                            <td class="px-6 py-4 text-center">
                                <span class="status-badge status-pending">Tertunda</span>
                            </td>
                            <td class="px-6 py-4 text-center flex justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                <button class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                        <!-- Item 3 -->
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">Agus Wijaya</td>
                            <td class="px-6 py-4">085678901234</td>
                            <td class="px-6 py-4">15 Jun 2025, 20:00</td>
                            <td class="px-6 py-4 text-center">6</td>
                            <td class="px-6 py-4 text-center">
                                <span class="status-badge status-confirmed">Dikonfirmasi</span>
                            </td>
                            <td class="px-6 py-4 text-center flex justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                <button class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                        <!-- Item 4 -->
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">Dewi Anggraini</td>
                            <td class="px-6 py-4">087712345678</td>
                            <td class="px-6 py-4">13 Jun 2025, 12:00</td>
                            <td class="px-6 py-4 text-center">5</td>
                            <td class="px-6 py-4 text-center">
                                <span class="status-badge status-completed">Selesai</span>
                            </td>
                            <td class="px-6 py-4 text-center flex justify-center space-x-2">
                                <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                <button class="text-red-600 hover:text-red-900">Hapus</button>
                            </td>
                        </tr>
                           <!-- Item 5 -->
                           <tr class="bg-white hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900">Eko Prasetyo</td>
                                <td class="px-6 py-4">089956781234</td>
                                <td class="px-6 py-4">12 Jun 2025, 19:30</td>
                                <td class="px-6 py-4 text-center">3</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="status-badge status-cancelled">Dibatalkan</span>
                                </td>
                                <td class="px-6 py-4 text-center flex justify-center space-x-2">
                                    <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                    <button class="text-red-600 hover:text-red-900">Hapus</button>
                                </td>
                           </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
               <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                <div class="flex flex-1 justify-between sm:hidden">
                  <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                  <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                </div>
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                  <div>
                    <p class="text-sm text-gray-700">
                      Menampilkan
                      <span class="font-medium">1</span>
                      sampai
                      <span class="font-medium">5</span>
                      dari
                      <span class="font-medium">25</span>
                      hasil
                    </p>
                  </div>
                  <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                      <a href="#" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Previous</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" /></svg>
                      </a>
                      <a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-primary px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">1</a>
                      <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">2</a>
                      <a href="#" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">3</a>
                      <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                      <a href="#" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">5</a>
                      <a href="#" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                        <span class="sr-only">Next</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" /></svg>
                      </a>
                    </nav>
                  </div>
                </div>
            </div>
        </div>
    </main>

</body>
</x-controlpanel>
