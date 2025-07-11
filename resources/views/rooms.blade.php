<x-layout>
    <style>
        .body {
            overflow-x: hidden;
        }

        .side-photo {
            position: fixed;
            top: 4rem; /* Sesuaikan dengan tinggi header Anda */
            bottom: 0;
            width: 150px;
            background-color: #ffffff;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
            overflow: hidden;
            /* Perubahan: 'position: relative;' dihapus karena tidak lagi diperlukan untuk satu lapisan gambar */
        }

        .side-photo img {
            /* Perubahan: Properti 'position: absolute;', 'top: 0;', 'left: 0;' dihapus */
            width: 100%;
            height: 100%;
            object-fit: cover; /* Menggunakan 'contain' agar seluruh gambar terlihat */
            opacity: 1; /* Perubahan: Atur opacity awal ke 1 (terlihat) */
            transition: opacity 1s ease-in-out; /* Perubahan: Tambahkan transisi untuk opacity */
        }

        /* Perubahan: Aturan CSS '.side-photo img.active' dihapus */

        .side-photo-left {
            left: 0;
        }

        .side-photo-right {
            right: 0;
        }

        .content-area {
            margin-left: 150px;
            margin-right: 150px;
        }

        .room-card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            padding: 1rem;
            display: grid;
            grid-template-columns: 200px 1fr auto;
            gap: 1rem;
            align-items: start;
            transition: grid-template-rows 0.3s ease-in-out;
        }

        .room-image {
            background-color: #ffffff;
            /* Placeholder background */
            aspect-ratio: 16 / 9;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            font-size: 0.8rem;
            border-radius: 0.25rem;
            overflow: hidden;
            /* Ensure image fits */
        }

        .room-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* Cover the area without distortion */
        }


        .room-details {
            display: grid;
            grid-template-columns: 1fr;
            grid-row-gap: 0.5rem;
        }

        .room-name {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            padding: 0.3rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: bold;
        }

        .room-info {
            background-color: #ffffff;
            color: #333;
            padding: 0.3rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.9rem;
        }

        .room-price {
            background-color: #ffffff;
            color: rgb(0, 0, 0);
            padding: 0.5rem;
            border-radius: 0.25rem;
            text-align: right;
            font-weight: bold;
        }

        .book-button {
            background-color: #bf7029;
            color: rgb(255, 255, 255);
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-align: center;
            cursor: pointer;
        }

        .price-button-container {
            display: grid;
            grid-template-rows: auto auto;
            gap: 0.5rem;
            align-items: start;
        }

        .room-card>.room-price {
            grid-column: 2 / 3;
            text-align: left;
        }

        .room-card>.book-button {
            grid-column: 2 / 3;
        }

        .room-card.expanded {
            grid-template-rows: auto auto auto auto;
        }

        .room-card.expanded .room-full-details {
            display: block !important;
            grid-column: 1 / -1;
            padding-top: 1rem;
            border-top: 1px solid #ccc;
            padding-left: 1rem;
            padding-right: 1rem;
            padding-bottom: 1rem;
        }

        .room-card.expanded .show-details-arrow svg {
            transform: rotate(180deg);
        }


        .show-details-arrow svg {
            transition: transform 0.3s ease-in-out;
        }

        /* Responsive for smaller screens */
        @media (max-width: 768px) {
            .side-photo {
                display: none;
            }

            .content-area {
                margin-left: 0;
                margin-right: 0;
                padding: 1rem;
            }

            .room-card {
                grid-template-columns: 1fr;
            }

            .room-price {
                text-align: left;
            }

            .book-button {
                justify-self: start;
            }

            .room-card.expanded {
                grid-template-rows: auto auto auto auto auto;
            }
        }
    </style>

    <div class="body">
        <div class="side-photo side-photo-left">
            <!-- Perubahan: Hanya satu lapisan gambar per sisi -->
            <img id="sidePhotoLeft" alt="Side Photo Left">
        </div>
        <div class="content-area ">

            @foreach ($rooms as $room)
                <div class="room-card relative">
                    <div class="room-image">
                        @if ($room->foto_logo)
                            <img src="{{ $room->foto_logo }}" alt="Foto Logo {{ $room->nama_room }}">
                        @else
                            <span class="text-gray-500">Tidak ada gambar</span>
                        @endif
                    </div>
                    <div class="room-details">
                        <div class="room-name">{{ $room->nama_room }}</div>
                        <div class="room-info">{{-- You can add rating information here if available --}}</div>
                    </div>
                    <div class="price-button-container">
                        <div class="room-price">Rp {{ number_format($room->harga_room, 0, ',', '.') }}</div>
                        <a href="{{ route('rooms.show', $room->slug) }}" class="book-button">LIHAT DETAIL</a>
                    </div>
                    <div class="hidden room-full-details ">
                        <p>
                            {{ $room->detail_room }}
                        </p>
                    </div>
                    <div
                        class="show-details-arrow cursor-pointer text-center absolute bottom-4 left-1/2 -translate-x-1/2">
                        <svg class="w-6 h-6 mx-auto transform rotate-0 transition-transform duration-300" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="side-photo side-photo-right">
            <!-- Perubahan: Hanya satu lapisan gambar per sisi -->
            <img id="sidePhotoRight" alt="Side Photo Right">
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roomCards = document.querySelectorAll('.room-card');

            roomCards.forEach(card => {
                const arrow = card.querySelector('.show-details-arrow');
                const fullDetails = card.querySelector('.room-full-details');

                arrow.addEventListener('click', function() {
                    card.classList.toggle('expanded');
                    fullDetails.classList.toggle('hidden');
                });
            });

            const sidePhotoLeft = document.getElementById('sidePhotoLeft');
            const sidePhotoRight = document.getElementById('sidePhotoRight');

            const images = [
                'image/view.png',
                'image/view2.png',
                'image/view3.png',
                'image/view4.png',
                'image/view5.png',
            ];

            let currentImageIndex = 0;
            const transitionDuration = 1000; // Durasi transisi fade dalam milidetik (1 detik)
            const displayDuration = 5000; // Total durasi tampilan gambar (5 detik)

            function changeSidePhotosSequentially() {
                // Langkah 1: Fade out gambar saat ini
                sidePhotoLeft.style.opacity = 0;
                sidePhotoRight.style.opacity = 0;

                // Langkah 2: Setelah fade out selesai, ganti src dan fade in gambar baru
                setTimeout(() => {
                    // Tingkatkan indeks gambar untuk gambar berikutnya
                    currentImageIndex++;
                    if (currentImageIndex >= images.length) {
                        currentImageIndex = 0; // Kembali ke awal jika sudah mencapai akhir array
                    }

                    // Ganti src gambar
                    sidePhotoLeft.src = images[currentImageIndex];
                    sidePhotoRight.src = images[currentImageIndex]; // Menggunakan gambar yang sama untuk kedua sisi

                    // Fade in gambar baru
                    sidePhotoLeft.style.opacity = 1;
                    sidePhotoRight.style.opacity = 1;
                }, transitionDuration); // Waktu tunggu sesuai durasi transisi CSS
            }

            // Panggil sekali saat dimuat untuk menampilkan gambar pertama dari urutan
            // Ini akan langsung mengatur src dan opacity ke 1
            changeSidePhotosSequentially();

            // Ganti foto setiap 'displayDuration' milidetik secara berurutan dengan efek fade
            setInterval(changeSidePhotosSequentially, displayDuration);
        });
    </script>

</x-layout>
