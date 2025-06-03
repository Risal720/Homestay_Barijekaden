@extends('layouts.admin')

@section('title', 'Edit Kamar')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg mb-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Kamar: {{ $room->nama_room }}</h1>

    <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @csrf
        @method('PUT')
        <div>
            <label for="nama_room" class="block text-sm font-medium text-gray-700 mb-1">Nama Kamar</label>
            <input type="text" name="nama_room" id="nama_room" value="{{ old('nama_room', $room->nama_room) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            @error('nama_room') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="harga_room" class="block text-sm font-medium text-gray-700 mb-1">Harga Kamar (Rp)</label>
            <input type="number" name="harga_room" id="harga_room" value="{{ old('harga_room', $room->harga_room) }}" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required min="0">
            @error('harga_room') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div class="col-span-1 md:col-span-2">
            <label for="detail_room" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Kamar</label>
            <textarea name="detail_room" id="detail_room" rows="4" class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('detail_room', $room->detail_room) }}</textarea>
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
            <div class="mt-4" id="foto_logo-preview-container" style="{{ $room->foto_logo ? 'display: block;' : 'display: none;' }}">
                <p class="text-sm text-gray-600 mb-2">Pratinjau Foto Logo:</p>
                <img id="foto_logo-preview" src="{{ $room->foto_logo ?? '#' }}" alt="Pratinjau Foto Logo" class="max-w-xs h-auto rounded-lg shadow-md border border-gray-200">
            </div>
        </div>

        <div class="col-span-1 md:col-span-2">
            <label for="room_images" class="block text-sm font-medium text-gray-700 mb-1">Foto Detail Kamar (Unggah Baru)</label>
            <input type="file" name="room_images[]" id="room_images" multiple class="mt-1 block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-blue-50 file:text-blue-700
                hover:file:bg-blue-100"
                onchange="previewMultipleImages(event, 'new-room_images-preview-container')">
            @error('room_images.*') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            <div class="mt-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4" id="new-room_images-preview-container">
                </div>

            <h3 class="text-lg font-medium text-gray-700 mt-6 mb-3">Gambar Detail Kamar Saat Ini:</h3>
            @if ($room->roomImages->isNotEmpty())
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($room->roomImages as $image)
                        <div class="relative group">
                            <img src="{{ $image->path }}" alt="{{ $image->alt_text }}" class="w-full h-32 object-cover rounded-md shadow-sm border border-gray-200">
                            <button type="button" onclick="confirmDeleteRoomImage({{ $image->id }})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                            <form id="delete-room-image-form-{{ $image->id }}" action="{{ route('admin.room_images.destroy', $image) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-sm">Tidak ada gambar detail kamar yang diunggah.</p>
            @endif
        </div>

        <div class="col-span-1 md:col-span-2 flex justify-end space-x-4">
            <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                Batal
            </a>
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                Perbarui Kamar
            </button>
        </div>
    </form>
</div>

<div id="deleteImageConfirmationModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Penghapusan Gambar</h3>
            <div class="mt-2 px-7 py-3">
                <p class="text-sm text-gray-500">Apakah Anda yakin ingin menghapus gambar ini?</p>
            </div>
            <div class="items-center px-4 py-3">
                <button id="confirmDeleteImageButton" class="px-4 py-2 bg-red-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 ease-in-out sm:ml-3 sm:w-auto sm:text-sm">
                    Hapus
                </button>
                <button id="cancelDeleteImageButton" class="mt-3 px-4 py-2 bg-gray-300 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-300 ease-in-out sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
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

    // JavaScript for room image deletion confirmation modal
    let roomImageToDeleteId = null;
    const deleteImageConfirmationModal = document.getElementById('deleteImageConfirmationModal');
    const confirmDeleteImageButton = document.getElementById('confirmDeleteImageButton');
    const cancelDeleteImageButton = document.getElementById('cancelDeleteImageButton');

    function confirmDeleteRoomImage(imageId) {
        roomImageToDeleteId = imageId;
        deleteImageConfirmationModal.classList.remove('hidden');
    }

    confirmDeleteImageButton.onclick = function() {
        if (roomImageToDeleteId) {
            document.getElementById('delete-room-image-form-' + roomImageToDeleteId).submit();
        }
        deleteImageConfirmationModal.classList.add('hidden');
    }

    cancelDeleteImageButton.onclick = function() {
        deleteImageConfirmationModal.classList.add('hidden');
        roomImageToDeleteId = null;
    }

    window.onclick = function(event) {
        if (event.target == deleteImageConfirmationModal) {
            deleteImageConfirmationModal.classList.add('hidden');
            roomImageToDeleteId = null;
        }
    }
</script>
@endsection