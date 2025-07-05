{{-- resources/views/admin/users/index.blade.php --}}
<x-controlpanel>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="p-6 bg-gray-50 min-h-screen">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">{{ $title }}</h1>

        <div class="bg-white p-6 rounded-lg shadow-md">
            {{-- Tombol Tambah Pengguna --}}
            <a href="{{ route('admin.users.create') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 mb-4">
                Tambah Pengguna Baru
            </a>

            {{-- Pesan Sukses (jika ada) --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-3 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tl-lg">
                                ID
                            </th>
                            <th class="py-3 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="py-3 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Email
                            </th>
                            <th class="py-3 px-4 border-b border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider rounded-tr-lg">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $user->id }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $user->name }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm text-gray-700">{{ $user->email }}</td>
                                <td class="py-3 px-4 border-b border-gray-200 text-sm">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3 font-medium">Edit</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini secara permanen?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-gray-500">Tidak ada pengguna yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-controlpanel>
