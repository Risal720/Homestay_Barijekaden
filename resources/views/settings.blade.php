<x-controlpanel>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>

    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-8 text-center">Dashboard Admin</h1>

        <style>
            /* Styles for flash messages, can be moved to a global CSS if x-controlpanel supports it */
            .flash-message {
                padding: 1rem;
                margin-bottom: 1rem;
                border-radius: 0.5rem;
                font-weight: 500;
            }
            .flash-success {
                background-color: #d1fae5; /* green-100 */
                color: #065f46; /* green-800 */
                border: 1px solid #34d399; /* green-400 */
            }
            .flash-error {
                background-color: #fee2e2; /* red-100 */
                color: #991b1b; /* red-800 */
                border: 1px solid #f87171; /* red-400 */
            }
        </style>

        @if (session('success'))
            <div class="flash-message flash-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="flash-message flash-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="{{ route('admin.rooms.index') }}" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mx-auto mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2H7a2 2 0 00-2 2v2m14 0h-2M5 11H3m0 0V9a2 2 0 012-2h2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 text-center mb-2">Manajemen Kamar</h2>
                <p class="text-gray-600 text-center">Kelola detail kamar, harga, gambar, dan kode kamar.</p>
            </a>

            <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2m2 0h11m-1 4h-1.293c-.788 0-1.5-.324-1.923-.955L2 16m2-2h11m-1 4h.857C21.43 16.485 22 15.234 22 14V8a2 2 0 00-2-2h-3.293c-.788 0-1.5-.324-1.923-.955L9 2m7 14V4a2 2 0 00-2-2H7a2 2 0 00-2 2v12m7 0h.01"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 text-center mb-2">Manajemen Pengguna</h2>
                <p class="text-gray-600 text-center">Kelola akun pengguna dan peran.</p>
            </a>

            <a href="#" class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out transform hover:-translate-y-1">
                <div class="flex items-center justify-center w-16 h-16 bg-yellow-100 rounded-full mx-auto mb-4">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 text-center mb-2">Laporan & Statistik</h2>
                <p class="text-gray-600 text-center">Lihat data pemesanan dan performa.</p>
            </a>
        </div>
    </div>
</x-controlpanel>
