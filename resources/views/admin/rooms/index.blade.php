@extends('layouts.admin')

@section('title', 'Manajemen Kamar')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg mb-8">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-6">Manajemen Kamar Hotel</h1>

    <!-- Form Tambah Kamar Baru -->
    <div class="mb-10 p-6 bg-blue-50 rounded-lg border border-blue-200">
        <h2 class="text-2xl font-bold text-blue-800 mb-4">Tambah Kamar Baru</h2>
        <form id="addRoomForm" action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf
            <div>
                <label for="nama_room" class="block text-sm font-medium text-gray-700 mb-1">Nama Kamar</label>
                <input type="text" name="nama_room" id="nama_room" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                @error('nama_room') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="harga_room" class="block text-sm font-medium text-gray-700 mb-1">Harga Kamar (Rp)</label>
                <input type="number" name="harga_room" id="harga_room" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required min="0">
                @error('harga_room') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="col-span-1 md:col-span-2">
                <label for="detail_room" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kamar</label>
                <textarea name="detail_room" id="detail_room" rows="4" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                @error('detail_room') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="col-span-1 md:col-span-2">
                <label for="foto_logo" class="block text-sm font-medium text-gray-700 mb-1">Foto Logo / Thumbnail Kamar</label>
                <input type="file" name="foto_logo" id="foto_logo" class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100"
                    onchange="previewImage(event, 'foto_logo-preview')">
                @error('foto_logo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <div class="mt-4" id="foto_logo-preview-container" style="display: none;">
                    <p class="text-sm text-gray-600 mb-2">Pratinjau Foto Logo:</p>
                    <img id="foto_logo-preview" src="#" alt="Pratinjau Foto Logo" class="max-w-xs h-auto rounded-lg shadow-md border border-gray-200">
                </div>
            </div>
            <div class="col-span-1 md:col-span-2">
                <label for="room_images" class="block text-sm font-medium text-gray-700 mb-1">Foto Detail Kamar (Bisa Unggah Banyak)</label>
                <input type="file" name="room_images[]" id="room_images" multiple class="mt-1 block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700
                    hover:file:bg-blue-100"
                    onchange="previewMultipleImages(event, 'room_images-preview-container')">
                @error('room_images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4" id="room_images-preview-container">
                </div>
            </div>
            <div>
                <label for="prefix" class="block text-sm font-medium text-gray-700 mb-1">Awalan Kode Kamar (misal: A, B, DELUXE)</label>
                <input type="text" name="prefix" id="prefix" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required maxlength="10">
                @error('prefix') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="col-span-1 md:col-span-2 flex justify-end">
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                    Tambah Kamar
                </button>
            </div>
        </form>
    </div>

    <div class="mb-10 p-6 bg-purple-50 rounded-lg border border-purple-200">
        <h2 class="text-2xl font-bold text-purple-800 mb-4">Manajemen Awalan Kode Kamar</h2>
        <form action="{{ route('admin.room_prefixes.store_update') }}" method="POST" class="flex flex-col md:flex-row gap-4 items-end">
            @csrf
            <div class="flex-grow w-full md:w-auto">
                <label for="prefix_name" class="block text-sm font-medium text-gray-700 mb-1">Awalan Huruf</label>
                <input type="text" name="prefix_name" id="prefix_name" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" required maxlength="10">
                @error('prefix_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex-grow w-full md:w-auto">
                <label for="max_limit_value" class="block text-sm font-medium text-gray-700 mb-1">Batas Maksimal Kode</label>
                <input type="number" name="max_limit_value" id="max_limit_value" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500" required min="1">
                @error('max_limit_value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition duration-300 ease-in-out w-full md:w-auto">
                Simpan Awalan
            </button>
        </form>

        <div class="mt-6">
            <h3 class="text-xl font-semibold text-purple-700 mb-3">Daftar Awalan yang Ada:</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-purple-200 rounded-lg overflow-hidden shadow-sm">
                    <thead class="bg-purple-100">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Awalan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Batas Maksimal</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Nomor Selanjutnya</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-purple-200">
                        @forelse ($roomPrefixes as $prefix)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $prefix->prefix }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $prefix->max_limit }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $prefix->next_number }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('admin.room_prefixes.destroy', $prefix) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus awalan ini? Ini akan menghapus semua kode kamar yang terkait jika tidak digunakan.');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-300 ease-in-out">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada awalan kode kamar yang ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="bg-white p-6 rounded-lg border border-gray-200 shadow-sm">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Kamar</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden shadow-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kamar</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto Logo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Kamar & Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($rooms as $room)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $room->nama_room }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($room->foto_logo)
                                    <img src="{{ $room->foto_logo }}" alt="{{ $room->nama_room }}" class="w-20 h-20 object-cover rounded-md shadow-sm">
                                @else
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($room->harga_room, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 max-w-xs overflow-hidden text-ellipsis whitespace-nowrap">{{ $room->detail_room }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                @php
                                    $availableCodes = $room->roomCodes->where('status', 'Tersedia')->count();
                                    $totalCodes = $room->roomCodes->count();
                                @endphp
                                <button onclick="openRoomCodeModal({{ $room->id }}, '{{ route('admin.room_codes.update_status', ['roomCode' => 'CODE_ID_PLACEHOLDER']) }}', '{{ route('admin.room_codes.destroy', ['roomCode' => 'CODE_ID_PLACEHOLDER']) }}')"
                                    class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                                    Kelola Kode ({{ $availableCodes }}/{{ $totalCodes }})
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="text-indigo-600 hover:text-indigo-900 mr-3 transition duration-300 ease-in-out">Edit</a>
                                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini? Ini akan menghapus semua kode kamar dan gambar terkait.');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition duration-300 ease-in-out">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada kamar yang ditambahkan.</td>
                            </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- The Message Modal HTML has been removed as per your request. --}}

<div id="roomCodeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-2/3 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
            <h3 class="text-xl font-bold text-gray-900">Kelola Kode Kamar untuk <span id="modalRoomName"></span></h3>
            <button class="text-gray-400 hover:text-gray-600 text-2xl" onclick="closeRoomCodeModal()">&times;</button>
        </div>
        <div class="mt-4">
            <form id="addRoomCodeForm" method="POST" class="flex flex-col sm:flex-row gap-2 mb-4">
                @csrf
                <input type="hidden" name="room_id" id="modalRoomId">
                <input type="text" name="prefix_add" placeholder="Awalan baru (misal: A)" class="flex-grow p-2 border border-gray-300 rounded-md text-sm" required maxlength="10">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md text-sm shadow-sm">
                    Tambah Kode
                </button>
            </form>
            <div id="roomCodesList" class="max-h-40 overflow-y-auto pr-2"> {{-- max-h-40 for scrollbar --}}
                </div>
        </div>
        <div class="mt-4 text-right">
            <button class="px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md hover:bg-gray-400" onclick="closeRoomCodeModal()">Tutup</button>
        </div>
    </div>
</div>

<div id="deleteConfirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Penghapusan</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus kode kamar ini?</p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirmDeleteButton" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 ease-in-out sm:ml-3 sm:w-auto sm:text-sm">
                    Hapus
                </button>
                <button id="cancelDeleteButton" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-300 ease-in-out sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>


<script>
    // Log untuk memastikan skrip ini dimuat dan dieksekusi
    console.log('admin/rooms/index.blade.php script loaded.');

    // JavaScript for single image preview (foto_logo)
    function previewImage(event, previewId) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById(previewId);
            const container = document.getElementById(previewId + '-container');
            output.src = reader.result;
            container.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    // JavaScript for multiple image preview (room_images)
    function previewMultipleImages(event, containerId) {
        const container = document.getElementById(containerId);
        container.innerHTML = ''; // Clear previous previews

        if (event.target.files) {
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgDiv = document.createElement('div');
                    imgDiv.classList.add('relative');
                    imgDiv.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-md shadow-sm border border-gray-200">
                    `;
                    container.appendChild(imgDiv);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    // --- Room Code Modal Logic ---
    const roomCodeModal = document.getElementById('roomCodeModal');
    const modalRoomName = document.getElementById('modalRoomName');
    const modalRoomId = document.getElementById('modalRoomId');
    const roomCodesList = document.getElementById('roomCodesList');
    const addRoomCodeForm = document.getElementById('addRoomCodeForm');

    let currentRoomCodes = {}; // To store room codes for the active room
    let currentRoomButton = null; // Reference to the button that opened the modal
    let updateStatusBaseUrl = ''; // Base URL for updating status
    let deleteCodeBaseUrl = ''; // Base URL for deleting code

    // Modified openRoomCodeModal to accept base URLs
    function openRoomCodeModal(roomId, updateStatusUrl, deleteCodeUrl) {
        // Ensure $rooms is available and parsed correctly from Blade
        const roomsData = @json($rooms->keyBy('id') ?? []);
        console.log('roomsData yang diterima:', roomsData); // Debugging: Lihat data kamar yang diterima
        const selectedRoom = roomsData[roomId];
        console.log('selectedRoom:', selectedRoom); // Debugging: Lihat kamar yang dipilih

        if (selectedRoom) {
            modalRoomName.textContent = selectedRoom.nama_room;
            modalRoomId.value = selectedRoom.id;
            // Set the action for adding a new code
            const addCodeUrl = `/admin/rooms/${selectedRoom.id}/add-code`;
            addRoomCodeForm.action = addCodeUrl;
            console.log(`URL untuk menambahkan kode kamar: ${addCodeUrl}`);

            // Store the base URLs for dynamic use
            updateStatusBaseUrl = updateStatusUrl;
            deleteCodeBaseUrl = deleteCodeUrl;

            currentRoomButton = document.querySelector(`button[onclick*="openRoomCodeModal(${roomId})"]`);

            // Initial population of currentRoomCodes
            currentRoomCodes = JSON.parse(JSON.stringify(selectedRoom.room_codes)).reduce((acc, code) => {
                acc[code.id] = code;
                return acc;
            }, {});
            console.log('currentRoomCodes after initial population:', currentRoomCodes); // New log
            renderRoomCodes(Object.values(currentRoomCodes));
            roomCodeModal.classList.remove('hidden');
        } else {
            console.error('Error!', `Kamar dengan ID ${roomId} tidak ditemukan. Pastikan kamar sudah ada di database.`);
            return; // Prevent further execution if room is not found
        }
    }

    function closeRoomCodeModal() {
        roomCodeModal.classList.add('hidden');
        roomCodesList.innerHTML = '';
        currentRoomButton = null;
        updateStatusBaseUrl = '';
        deleteCodeBaseUrl = '';
    }

    function renderRoomCodes(codes) {
        console.log('renderRoomCodes called with codes:', codes); // New log
        roomCodesList.innerHTML = '';
        if (codes.length === 0) {
            roomCodesList.innerHTML = '<p class="text-gray-500 text-center py-4">Belum ada kode kamar untuk kamar ini.</p>';
            return;
        }

        codes.forEach(code => {
            // Add check for valid code object structure
            if (!code || !code.id || !code.code || code.status === undefined) {
                console.error('Skipping malformed room code object:', code);
                return; // Skip rendering this malformed object
            }
            const codeDiv = document.createElement('div');
            codeDiv.id = `room-code-item-${code.id}`;
            codeDiv.classList.add('flex', 'items-center', 'justify-between', 'p-2', 'bg-gray-50', 'rounded-md', 'border', 'border-gray-200', 'mb-2');
            codeDiv.innerHTML = `
                <span class="font-semibold text-gray-800">${code.code}</span>
                <form action="${updateStatusBaseUrl.replace('CODE_ID_PLACEHOLDER', code.id)}" method="POST" class="flex items-center space-x-2 room-code-status-form">
                    @csrf
                    <select name="status" class="block w-full py-1 px-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="Tersedia" ${code.status == 'Tersedia' ? 'selected' : ''}>Tersedia</option>
                        <option value="Tidak Tersedia" ${code.status == 'Tidak Tersedia' ? 'selected' : ''}>Tidak Tersedia</option>
                    </select>
                    <button type="button" onclick="confirmDeleteRoomCode(${code.id})" class="text-red-500 hover:text-red-700 transition duration-300 ease-in-out text-lg leading-none">&times;</button>
                </form>
                <form id="delete-room-code-form-${code.id}" action="${deleteCodeBaseUrl.replace('CODE_ID_PLACEHOLDER', code.id)}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            `;
            roomCodesList.appendChild(codeDiv);
        });

        // Add event listeners to the newly rendered select elements
        roomCodesList.querySelectorAll('select[name="status"]').forEach(selectElement => {
            selectElement.addEventListener('change', function(event) {
                const form = event.target.closest('form');
                const formData = new FormData(form);
                const url = form.action;
                const method = 'POST';
                const roomCodeId = parseInt(url.split('/').slice(-2, -1)[0]); 

                console.log(`Mengirim permintaan AJAX: ${method} ${url}`);

                fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    console.log(`Status respons untuk ${url}: ${response.status}`);
                    console.log(`Content-Type respons untuk ${url}: ${response.headers.get('content-type')}`);
                    if (!response.ok) {
                        return response.text().then(text => { throw new Error(text) });
                    }
                    const contentType = response.headers.get('content-type');
                    if (contentType && contentType.includes('application/json')) {
                        return response.json();
                    } else {
                        return response.text().then(text => {
                            console.error('Respons non-JSON diterima:', text);
                            throw new Error('Respons bukan JSON. Detail: ' + text.substring(0, 100) + '...');
                        });
                    }
                })
                .then(data => {
                    console.log('Data diterima (pembaruan status):', data);
                    try {
                        if (data.success) {
                            console.log('roomCodeId:', roomCodeId);
                            console.log('currentRoomCodes SEBELUM mengambil kode yang diperbarui:', currentRoomCodes);

                            const currentRoomId = modalRoomId.value;
                            const fetchRoomCodesUrl = `/admin/rooms/${currentRoomId}/room-codes`; 
                            console.log('Mengambil kode kamar yang diperbarui dari:', fetchRoomCodesUrl);
                            
                            fetch(fetchRoomCodesUrl)
                                .then(response => {
                                    console.log(`Status respons untuk ${fetchRoomCodesUrl}: ${response.status}`);
                                    console.log(`Content-Type respons untuk ${fetchRoomCodesUrl}: ${response.headers.get('content-type')}`);
                                    if (!response.ok) {
                                        return response.text().then(text => { throw new Error('Gagal mengambil kode kamar terbaru. Detail: ' + text.substring(0, 100) + '...') });
                                    }
                                    const contentType = response.headers.get('content-type');
                                    if (contentType && contentType.includes('application/json')) {
                                        return response.json();
                                    } else {
                                        return response.text().then(text => {
                                            console.error('Respons non-JSON diterima saat mengambil kode yang diperbarui:', text);
                                            throw new Error('Respons bukan JSON saat mengambil kode terbaru. Detail: ' + text.substring(0, 100) + '...');
                                        });
                                    }
                                })
                                .then(updatedRoomCodes => {
                                    console.log('Kode kamar yang diperbarui diambil dari server:', updatedRoomCodes);
                                    currentRoomCodes = updatedRoomCodes.reduce((acc, code) => {
                                        acc[code.id] = code;
                                        return acc;
                                    }, {});
                                    console.log('currentRoomCodes dibangun ulang dari data yang diambil:', currentRoomCodes);
                                    renderRoomCodes(Object.values(currentRoomCodes));
                                    refreshRoomCodeDisplay();
                                    console.log('Berhasil!', data.message);
                                })
                                .catch(fetchError => {
                                    console.error('Error mengambil kode kamar yang diperbarui:', fetchError);
                                    console.error('Error!', 'Status berhasil diperbarui, tetapi gagal memuat daftar kode kamar terbaru. Periksa konsol untuk detail.');
                                });

                        } else {
                            console.error('Gagal!', data.message || 'Gagal memperbarui status kode kamar.');
                        }
                    } catch (innerError) {
                        console.error('Error internal dalam blok .then yang berhasil (pembaruan status):', innerError);
                        console.error('Error!', 'Terjadi kesalahan internal saat memperbarui tampilan. Periksa konsol.');
                    }
                })
                .catch(error => {
                    console.error('Error saat fetch atau pemrosesan respons awal (pembaruan status):', error);
                    let errorMessage = 'Terjadi kesalahan saat memperbarui status kode kamar. Periksa konsol untuk detail.';
                    if (error.message && error.message.includes('<!DOCTYPE html>')) {
                        errorMessage += ' Server mengembalikan halaman HTML (mungkin 404 Not Found atau error server).';
                    } else {
                        errorMessage += ' ' + error.message;
                    }
                    console.error('Error!', errorMessage);
                });
            });
        });
    }

    function refreshRoomCodeDisplay() {
        if (currentRoomButton) {
            const availableCodes = Object.values(currentRoomCodes).filter(code => code.status === 'Tersedia').length;
            const totalCodes = Object.values(currentRoomCodes).length;
            currentRoomButton.textContent = `Kelola Kode (${availableCodes}/${totalCodes})`;
        }
    }

    // Event listener for the main "Tambah Kamar" form
    document.addEventListener('DOMContentLoaded', function() {
        const addRoomForm = document.getElementById('addRoomForm');
        if (addRoomForm) {
            addRoomForm.addEventListener('submit', function(e) {
                e.preventDefault(); // Mencegah pengiriman formulir default

                const form = e.target;
                const formData = new FormData(form);
                const url = form.action;
                const method = 'POST';

                console.log(`Mengirim permintaan AJAX untuk Tambah Kamar: ${method} ${url}`);

                fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    console.log(`Status respons untuk ${url}: ${response.status}`);
                    if (!response.ok) {
                        return response.text().then(text => { throw new Error(text) });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data diterima (Tambah Kamar):', data);
                    if (data.success) {
                        console.log('Berhasil!', data.message);
                        // Mengarahkan ke halaman indeks kamar setelah penambahan berhasil
                        window.location.href = "{{ route('admin.rooms.index') }}";
                    } else {
                        console.error('Gagal!', data.message || 'Gagal menambahkan kamar.');
                    }
                })
                .catch(error => {
                    console.error('Error saat fetch atau pemrosesan respons (Tambah Kamar):', error);
                    let errorMessage = 'Terjadi kesalahan saat menambahkan kamar. Periksa konsol untuk detail.';
                    if (error.message && error.message.includes('<!DOCTYPE html>')) {
                        errorMessage += ' Server mengembalikan halaman HTML (mungkin 404 Not Found atau error server).';
                    } else {
                        errorMessage += ' ' + error.message;
                    }
                    console.error('Error!', errorMessage);
                });
            });
        } else {
            console.error('Elemen formulir dengan ID "addRoomForm" tidak ditemukan.');
        }
    });

    // Event listener for the "Tambah Kode" form inside the modal
    // This listener is outside DOMContentLoaded because addRoomCodeForm is a static element
    // and its listener should be attached as soon as the script runs.
    addRoomCodeForm.addEventListener('submit', function(e) {
        console.log('addRoomCodeForm submit event triggered.'); // NEW LOG: Konfirmasi pemicuan event
        e.preventDefault(); // Mencegah pengiriman formulir default

        const form = e.target;
        const formData = new FormData(form);
        const url = form.action;
        const method = 'POST';

        console.log(`Mengirim permintaan AJAX untuk Tambah Kode: ${method} ${url}`);

        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            console.log(`Status respons untuk ${url}: ${response.status}`);
            if (!response.ok) {
                return response.text().then(text => { throw new Error(text) });
            }
            return response.json();
        })
        .then(data => {
            console.log('Data diterima (Tambah Kode):', data);
            try {
                if (data.success) {
                    currentRoomCodes[data.code.id] = data.code;
                    renderRoomCodes(Object.values(currentRoomCodes));
                    refreshRoomCodeDisplay();
                    form.reset();
                    console.log('Berhasil!', data.message);
                } else {
                    console.error('Gagal!', data.message || 'Gagal menambahkan kode kamar.');
                }
            } catch (innerError) {
                console.error('Error internal dalam blok .then yang berhasil (Tambah Kode):', innerError);
                console.error('Error!', 'Terjadi kesalahan internal saat menambahkan kode kamar. Periksa konsol.');
            }
        })
        .catch(error => {
            console.error('Error saat fetch atau pemrosesan respons (Tambah Kode):', error);
            let errorMessage = 'Terjadi kesalahan saat menambahkan kode kamar. Periksa konsol untuk detail.';
            if (error.message && error.message.includes('<!DOCTYPE html>')) {
                errorMessage += ' Server mengembalikan halaman HTML (mungkin 404 Not Found atau error server).';
            } else {
                errorMessage += ' ' + error.message;
            }
            console.error('Error!', errorMessage);
        });
    });


    // --- Room Code Deletion Confirmation Modal Logic ---
    let roomCodeToDeleteId = null;
    const deleteConfirmationModal = document.getElementById('deleteConfirmationModal');
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');
    const cancelDeleteButton = document.getElementById('cancelDeleteButton');

    function confirmDeleteRoomCode(roomCodeId) {
        roomCodeToDeleteId = roomCodeId;
        deleteConfirmationModal.classList.remove('hidden');
    }

    confirmDeleteButton.onclick = function() {
        if (roomCodeToDeleteId) {
            const form = document.getElementById('delete-room-code-form-' + roomCodeToDeleteId);
            const formData = new FormData(form);
            const url = form.action;
            const method = 'POST'; // This will be handled by @method('DELETE') in Laravel
            const roomCodeId = parseInt(roomCodeToDeleteId); 

            console.log(`Mengirim permintaan AJAX: ${method} ${url}`);

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                console.log(`Status respons untuk ${url}: ${response.status}`);
                console.log(`Content-Type respons untuk ${url}: ${response.headers.get('content-type')}`); // New log
                if (!response.ok) {
                    return response.text().then(text => { throw new Error(text) });
                }
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        console.error('Respons non-JSON diterima:', text);
                        throw new Error('Respons bukan JSON. Detail: ' + text.substring(0, 100) + '...');
                    });
                }
            })
            .then(data => {
                console.log('Data diterima (hapus kode):', data); // New log
                try { // New try-catch block
                    if (data.success) {
                        const currentRoomId = modalRoomId.value;
                        const fetchRoomCodesUrl = `/admin/rooms/${currentRoomId}/room-codes`; 
                        console.log('Mengambil kode kamar yang diperbarui setelah penghapusan dari:', fetchRoomCodesUrl); // New log
                        
                        fetch(fetchRoomCodesUrl)
                            .then(response => {
                                console.log(`Status respons untuk ${fetchRoomCodesUrl}: ${response.status}`); // New log
                                console.log(`Content-Type respons untuk ${fetchRoomCodesUrl}: ${response.headers.get('content-type')}`); // New log
                                if (!response.ok) {
                                    throw new Error('Gagal mengambil kode kamar terbaru setelah penghapusan.');
                                }
                                const contentType = response.headers.get('content-type');
                                if (contentType && contentType.includes('application/json')) {
                                    return response.json();
                                } else {
                                    return response.text().then(text => {
                                        console.error('Respons non-JSON diterima saat mengambil kode yang diperbarui setelah penghapusan:', text);
                                        throw new Error('Respons bukan JSON saat mengambil kode terbaru setelah penghapusan. Detail: ' + text.substring(0, 100) + '...');
                                    });
                                }
                            })
                            .then(updatedRoomCodes => {
                                console.log('Kode kamar yang diperbarui diambil dari server setelah penghapusan:', updatedRoomCodes);
                                currentRoomCodes = updatedRoomCodes.reduce((acc, code) => {
                                    acc[code.id] = code;
                                    return acc;
                                }, {});
                                console.log('currentRoomCodes dibangun ulang dari data yang diambil (hapus):', currentRoomCodes); // New log
                                renderRoomCodes(Object.values(currentRoomCodes));
                                refreshRoomCodeDisplay();
                                console.log('Berhasil!', data.message); // Changed from showMessageModal
                            })
                            .catch(fetchError => {
                                console.error('Error mengambil kode kamar yang diperbarui setelah penghapusan:', fetchError);
                                console.error('Error!', 'Kode berhasil dihapus, tetapi gagal memuat daftar kode kamar terbaru. Periksa konsol.'); // Changed from showMessageModal
                            });
                    } else {
                        console.error('Gagal!', data.message || 'Gagal menghapus kode kamar.'); // Changed from showMessageModal
                    }
                } catch (innerError) {
                    console.error('Error internal dalam blok .then yang berhasil (hapus kode):', innerError);
                    console.error('Error!', 'Terjadi kesalahan internal saat menghapus kode kamar. Periksa konsol.'); // Changed from showMessageModal
                }
            })
            .catch(error => {
                console.error('Error saat fetch atau pemrosesan respons awal (hapus kode):', error);
                let errorMessage = 'Terjadi kesalahan saat menghapus kode kamar. Periksa konsol untuk detail.';
                if (error.message && error.message.includes('<!DOCTYPE html>')) {
                    errorMessage += ' Server mengembalikan halaman HTML (mungkin 404 Not Found atau error server).';
                } else {
                    errorMessage += ' ' + error.message;
                }
                console.error('Error!', errorMessage); // Changed from showMessageModal
            })
            .finally(() => {
                deleteConfirmationModal.classList.add('hidden');
                roomCodeToDeleteId = null;
            });
        }
    }

    cancelDeleteButton.onclick = function() {
        deleteConfirmationModal.classList.add('hidden');
        roomCodeToDeleteId = null;
    }

    window.onclick = function(event) {
        // Only close if clicking outside the modal content, but not the modal itself
        if (event.target == deleteConfirmationModal) {
            deleteConfirmationModal.classList.add('hidden');
            roomCodeToDeleteId = null;
        } else if (event.target == roomCodeModal) {
            closeRoomCodeModal();
        }
    }
</script>
@endsection
