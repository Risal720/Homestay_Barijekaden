<x-layout>
    <style>
        .body {
            overflow-x: hidden;

        }

        .side-photo {
            position: fixed;
            top: 9.3rem;
            bottom: 0;
            width: 150px;
            background-color: #f08080;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 10;
        }

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
            /* Atur jarak antar card di sini */
            padding: 1rem;
            display: grid;
            grid-template-columns: 200px 1fr auto;
            gap: 1rem;
            align-items: start;
            transition: grid-template-rows 0.3s ease-in-out;
        }

        .room-image {
            background-color: #90ee90;
            aspect-ratio: 16 / 9;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
            font-size: 0.8rem;
            border-radius: 0.25rem;
        }

        .room-details {
            display: grid;
            grid-template-columns: 1fr;
            grid-row-gap: 0.5rem;
        }

        .room-name {
            background-color: #dda0dd;
            color: white;
            padding: 0.3rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: bold;
        }

        .room-info {
            background-color: #e6e6fa;
            color: #333;
            padding: 0.3rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.9rem;
        }

        .room-price {
            background-color: #dda0dd;
            color: white;
            padding: 0.5rem;
            border-radius: 0.25rem;
            text-align: right;
            font-weight: bold;
        }

        .book-button {
            background-color: #ffa07a;
            color: white;
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

        /* Responsive untuk layar yang lebih kecil */
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
        <div class="side-photo side-photo-left">FOTO BERGANTIAN</div>
        <div class="content-area ">

            @foreach ($rooms as $room)
                <div class="room-card relative">
                    <div class="room-image">
                        @if ($room->foto_logo)
                            <img src="{{ asset('image/logos/' . $room->foto_logo) }}"
                                alt="Logo {{ $room->nama_room }}" style="max-width: 100%; max-heigt: 100%;">
                        @else
                            Logo Tidak Tersedia
                        @endif

                    </div>
                    <div class="room-details">
                        <div class="room-name">{{ $room->nama_room }}</div>
                        <div class="room-info">{{-- Anda bisa menambahkan informasi rating di sini jika ada --}}</div>
                    </div>
                    <div class="price-button-container">
                        <div class="room-price">Rp {{ number_format($room->harga_room, 0, ',', '.') }}</div>
                        <a href="/rooms/{{ $room->slug }}" class="book-button">LIHAT DETAIL</a>
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

        <div class="side-photo side-photo-right">FOTO BERGANTIAN</div>
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
        });
    </script>

</x-layout>


{{-- <article class="py-8 max-w-screen-md border-b border-gray-300">
    <a href="/rooms/{{ $room['slug'] }}" class="hover:underline">
      <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $room['tittle'] }}</h2>
    </a>
    <div class="text-base text-gray-500">
      <a href="#">{{ $room['author'] }}</a> |{{ $room->created_at->diffForHumans()}}
    </div>
    <p class="my-4 font-light">{{ Str::limit($room['body'],150) }}</p>
    <a href="/rooms/{{ $room['slug'] }}" class="font-medium text-blue-500 hover:underline">Read more &raquo;</a>
  </article> --}}
