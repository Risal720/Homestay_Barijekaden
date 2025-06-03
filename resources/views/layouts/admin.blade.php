<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- PENTING: Meta tag CSRF ini diperlukan untuk semua permintaan AJAX di Laravel --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - @yield('title', 'Manajemen Hotel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7f6; /* Warna latar belakang umum */
        }
        /* Gaya untuk pesan flash */
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
</head>
<body class="min-h-screen flex flex-col">
    <nav class="bg-gradient-to-r from-blue-600 to-indigo-700 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('admin.rooms.index') }}" class="text-white text-2xl font-bold tracking-wide rounded-md px-3 py-1 hover:bg-blue-700 transition duration-300">
                Admin Hotel
            </a>
            <div class="space-x-4">
                <a href="{{ route('admin.rooms.index') }}" class="text-white hover:text-blue-200 transition duration-300 ease-in-out px-3 py-1 rounded-md hover:bg-blue-700">
                    Manajemen Kamar
                </a>
                <a href="{{ route('admin.settings') }}" class="text-white hover:text-blue-200 transition duration-300 ease-in-out px-3 py-1 rounded-md hover:bg-blue-700">
                    Dashboard Admin
                </a>
                </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto p-6">
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

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center mt-8 rounded-t-lg">
        <div class="container mx-auto">
            &copy; {{ date('Y') }} Admin Hotel. Hak Cipta Dilindungi.
        </div>
    </footer>
</body>
</html>