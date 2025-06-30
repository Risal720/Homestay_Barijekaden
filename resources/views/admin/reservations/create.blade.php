<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barijekaden Homstay's</title>
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
                <h2 class="text-2xl font-semibold text-gray-800">Form Tambah Reservasi Baru</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.reservations.store') }}" method="POST" class="space-y-4">
                    @csrf <!-- Ini penting untuk keamanan Laravel -->

                    <div class="form-group">
                        <label for="nama_pelanggan" class="block text-sm font-medium text-gray-700">Nama Pelanggan:</label>
                        <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="nama_pelanggan" name="nama_pelanggan" required value="{{ old('nama_pelanggan') }}">
                        @error('nama_pelanggan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email_pelanggan" class="block text-sm font-medium text-gray-700">Email Pelanggan:</label>
                        <input type="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="email_pelanggan" name="email_pelanggan" required value="{{ old('email_pelanggan') }}">
                        @error('email_pelanggan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                        <input type="text" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="nomor_telepon" name="nomor_telepon" required value="{{ old('nomor_telepon') }}">
                        @error('nomor_telepon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_check_in" class="block text-sm font-medium text-gray-700">Tanggal Check-in:</label>
                        <input type="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="tanggal_check_in" name="tanggal_check_in" required value="{{ old('tanggal_check_in') }}">
                        @error('tanggal_check_in')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_check_out" class="block text-sm font-medium text-gray-700">Tanggal Check-out:</label>
                        <input type="date" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="tanggal_check_out" name="tanggal_check_out" required value="{{ old('tanggal_check_out') }}">
                        @error('tanggal_check_out')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jumlah_tamu" class="block text-sm font-medium text-gray-700">Jumlah Tamu:</label>
                        <input type="number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="jumlah_tamu" name="jumlah_tamu" min="1" required value="{{ old('jumlah_tamu') }}">
                        @error('jumlah_tamu')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tipe_kamar_id" class="block text-sm font-medium text-gray-700">Tipe Kamar:</label>
                        <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="tipe_kamar_id" name="tipe_kamar_id" required>
                            <option value="">Pilih Tipe Kamar</option>
                            <!-- Anda perlu mengisi opsi ini secara dinamis dari database, contoh: -->
                            {{-- @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('tipe_kamar_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                            @endforeach --}}
                            <option value="1" {{ old('tipe_kamar_id') == '1' ? 'selected' : '' }}>Standard Room (contoh)</option>
                            <option value="2" {{ old('tipe_kamar_id') == '2' ? 'selected' : '' }}>Deluxe Room (contoh)</option>
                        </select>
                        @error('tipe_kamar_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="catatan" class="block text-sm font-medium text-gray-700">Catatan (Opsional):</label>
                        <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
                        @error('catatan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status Reservasi:</label>
                        <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="status" name="status" required>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex justify-end space-x-3">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 btn-primary">Simpan Reservasi</button>
                        <a href="{{ route('admin.reservations.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
