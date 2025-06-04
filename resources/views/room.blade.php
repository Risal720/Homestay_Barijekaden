<x-layout>
    <div class="bg-white rounded-md shadow-md overflow-hidden room-card">
        <div class="grid grid-cols-1 md:grid-cols-2">
            {{-- Left Section: Photo Area (Carousel) --}}
            <div class="bg-gray-200 relative aspect-w-16 aspect-h-9 overflow-hidden">
                @if ($room->roomImages->isNotEmpty())
                    <div class="carousel-container absolute top-0 left-0 w-full h-full">
                        @foreach ($room->roomImages as $index => $image)
                            <div class="carousel-slide absolute top-0 left-0 w-full h-full transition-opacity duration-500 opacity-0 {{ $index === 0 ? 'opacity-100' : '' }}"
                                data-slide-index="{{ $index }}">
                                <img src="{{ $image->path }}" alt="{{ $image->alt_text }}"
                                    class="object-cover w-full h-full">
                            </div>
                        @endforeach
                        <button
                            class="absolute top-1/2 left-2 sm:left-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full w-8 h-8 flex justify-center items-center focus:outline-none"
                            onclick="prevSlide()">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button
                            class="absolute top-1/2 right-2 sm:right-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white rounded-full w-8 h-8 flex justify-center items-center focus:outline-none"
                            onclick="nextSlide()">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                        <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 flex space-x-2">
                            @foreach ($room->roomImages as $index => $image)
                                <button class="w-2 h-2 sm:w-3 sm:h-3 rounded-full {{ $index === 0 ? 'bg-gray-600' : 'bg-gray-300' }} focus:outline-none"
                                    onclick="goToSlide({{ $index }})"></button>
                            @endforeach
                        </div>
                    </div>
                @else
                    {{-- Placeholder if no detail images --}}
                    <div class="bg-blue-500 inset-0 flex items-center justify-center">
                        <div class="bg-brown-300 p-8 rounded-md">
                            <div class="relative">
                                <div class="w-48 h-32 bg-brown-400 rounded-t-md"></div>
                                <div class="absolute top-8 left-8">
                                    <div class="w-16 h-8 bg-linen-200 rounded-md"></div>
                                </div>
                                <div class="absolute top-8 right-8">
                                    <div class="w-16 h-8 bg-linen-200 rounded-md"></div>
                                </div>
                                <div class="w-56 h-16 bg-brown-500 rounded-b-md"></div>
                            </div>
                            <h2 class="text-yellow-300 font-semibold mt-4">{{ $room->nama_room }}</h2>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right Section: Brief Information --}}
            <div class="p-6">
                <div class="mb-2">
                    <div class="bg-pink-300 text-white py-2 px-4 rounded-md inline-block">{{ $room->nama_room }}</div>
                </div>
                <div class="flex justify-between mb-4">
                    <a href="{{ route('rooms.index') }}"
                        class="bg-violet-500 text-white py-2 px-4 rounded-md">Kembali</a>
                    <div class="bg-purple-400 text-white py-2 px-4 rounded-md">Harga: Rp
                        {{ number_format($room->harga_room, 0, ',', '.') }}</div>
                </div>

                <div class="flex justify-between mb-4">
                    @if (isset($room->rating))
                        <button class="bg-yellow-300 text-gray-800 py-2 px-4 rounded-md flex items-center">
                            <svg class="h-5 w-5 text-yellow-500 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M9.049 2.928c.374-1.136 1.607-1.136 1.981 0l2.692 8.156c.265.808.998 1.392 1.79 1.392h8.418c1.03 0 1.53.667.997 1.22l-6.22 5.93c-.26.248-.356.577-.268.893l2.692 8.157c.374 1.136-.088 2.272-1.981 2.272H3.099c-1.893 0-2.355-1.136-1.982-2.272l2.692-8.157c.088-.316-.008-.645-.269-.893l-6.22-5.93c-.533-.553-.032-1.22.998-1.22h8.418c.792 0 1.525-.584 1.79-1.392l2.692-8.156z" />
                            </svg>
                            {{ $room->rating }}
                        </button>
                    @else
                        <div></div> {{-- Placeholder if no rating --}}
                    @endif
                    <button class="bg-green-400 text-white py-2 px-4 rounded-md">PESAN</button>
                </div>
                <div class="grid grid-cols-5 gap-2 mb-4">
                    @forelse ($room->roomCodes as $roomCode)
                        @php
                            $statusClass = '';
                            if ($roomCode->status == 'Tersedia') {
                                $statusClass = 'bg-teal-400';
                            } elseif ($roomCode->status == 'Tidak Tersedia') {
                                $statusClass = 'bg-blue-500';
                            }
                            // 'Yang Dipilih' status is handled client-side and not from admin
                        @endphp
                        <button
                            class="{{ $statusClass }} text-white py-2 px-3 rounded-md text-xs">{{ $roomCode->code }}</button>
                    @empty
                        <p class="col-span-5 text-gray-500 text-sm">Tidak ada kode kamar yang tersedia untuk kamar ini.</p>
                    @endforelse
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-4 h-4 bg-teal-400 rounded-full"></div>
                    <span class="text-xs">Tersedia</span>
                    <div class="w-4 h-4 bg-blue-500 rounded-full"></div>
                    <span class="text-xs">Tidak Tersedia</span>
                    <div class="w-4 h-4 bg-purple-600 rounded-full"></div>
                    <span class="text-xs">Yang Dipilih</span>
                </div>
            </div>
        </div>

        {{-- Bottom Section: Full Details --}}
        <div class="mt-4 bg-cyan-500 p-8 text-center relative">
            <div class="room-full-details text-gray-700">
                <h3 class="font-semibold text-lg mb-2">Detail Lengkap</h3>
                <p>{{ $room->detail_room ?? 'Ini adalah detail lengkap untuk kamar ini...' }}</p>
                {{-- You can add facility details here if available --}}
            </div>
        </div>
    </div>

    <style>
        .aspect-16-9 {
            aspect-ratio: 16 / 9;
        }
    </style>

    <script>
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-container .space-x-2 button');
        let currentIndex = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('opacity-100', i === index);
                slide.classList.toggle('opacity-0', i !== index);
            });
            indicators.forEach((indicator, i) => {
                indicator.classList.toggle('bg-gray-600', i === index);
                indicator.classList.toggle('bg-gray-300', i !== index);
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        function prevSlide() {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(currentIndex);
        }

        function goToSlide(index) {
            currentIndex = index;
            showSlide(currentIndex);
        }

        // Initialize carousel
        document.addEventListener('DOMContentLoaded', () => {
            if (slides.length > 0) {
                showSlide(currentIndex);
            }
        });
    </script>
</x-layout>