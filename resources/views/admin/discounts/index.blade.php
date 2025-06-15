<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Halaman Diskon Admin' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Selamat Datang di Halaman Diskon Admin!</h1>
        <p class="text-gray-600 mb-6">View ini berhasil ditemukan.</p>

        <a href="{{ url('/admin/discounts/create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-full transition duration-300 ease-in-out">
            Buat Diskon Baru
        </a>

        <h2 class="text-xl font-semibold text-gray-700 mt-8 mb-4">Daftar Diskon:</h2>
        @if (isset($discounts) && $discounts->count() > 0)
            <ul class="list-disc list-inside text-left mx-auto max-w-md">
                @foreach ($discounts as $discount)
                    <li class="mb-2 p-2 bg-gray-50 rounded-md shadow-sm">
                        <span class="font-medium text-gray-900">{{ $discount->name }}</span>
                        @if ($discount->code)
                            (<span class="text-green-600 font-mono">{{ $discount->code }}</span>)
                        @endif
                        - {{ $discount->value }}{{ $discount->type == 'percentage' ? '%' : ' (Fixed)' }}
                        <br>
                        <span class="text-sm text-gray-500">Berlaku dari: {{ $discount->starts_at?->format('d M Y H:i') ?? 'Sekarang' }} hingga: {{ $discount->expires_at?->format('d M Y H:i') ?? 'Selamanya' }}</span>
                        <div class="mt-2 text-right">
                            <a href="{{ url('/admin/discounts/' . $discount->id . '/edit') }}" class="text-indigo-600 hover:text-indigo-900 text-sm mr-2">Edit</a>
                            <form action="{{ url('/admin/discounts/' . $discount->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus diskon ini?')">Hapus</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">Belum ada diskon yang ditambahkan.</p>
        @endif

        @if (session('success'))
            <div class="mt-6 p-4 bg-green-100 text-green-800 rounded-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif
    </div>
</body>
</html>