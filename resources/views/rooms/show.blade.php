<x-layout>
    {{-- Dua lapisan untuk latar belakang yang akan saling cross-fade --}}
    <div id="background-layer-1" class="background-layer"></div>
    <div id="background-layer-2" class="background-layer"></div>

    {{-- Overlay gelap untuk kontras, ditempatkan di belakang konten tetapi di atas lapisan background --}}
    {{-- Sesuaikan opasitas (misalnya bg-black/40) atau hapus jika tidak diperlukan --}}
    <div class="absolute inset-0 w-full h-full bg-black/40 -z-10"></div> 

    {{-- Tambahkan ID unik ke div utama untuk penargetan yang lebih mudah dengan latar belakang --}}
    {{-- Ubah bg-white menjadi bg-white/80 agar background terlihat lebih jelas --}}
    {{-- Menambahkan mt-16 (margin-top: 4rem) untuk menggeser konten ke bawah, menghindari navbar --}}
    <div id="main-content-wrapper" class="bg-white/80 rounded-md shadow-md overflow-hidden room-card mt-16">
        <div class="grid grid-cols-1 md:grid-cols-2">
            {{-- Bagian Kiri: Area Foto (Carousel) --}}
            <div class="bg-white relative aspect-w-16 aspect-h-9 overflow-hidden">
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
                    {{-- Placeholder jika tidak ada gambar detail --}}
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

            {{-- Bagian Kanan: Informasi Singkat --}}
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
                        <div></div> {{-- Placeholder jika tidak ada rating --}}
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
                            // Status 'Yang Dipilih' ditangani di sisi klien dan bukan dari admin
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
                </div>
            </div>
        </div>

        {{-- Bagian Bawah: Detail Lengkap --}}
        <div class="mt-4 bg-cyan-500 p-8 text-center relative">
            <div class="room-full-details text-gray-700">
                <h3 class="font-semibold text-lg mb-2">Detail Lengkap</h3>
                <p>{{ $room->detail_room ?? 'Ini adalah detail lengkap untuk kamar ini...' }}</p>
                {{-- Anda bisa menambahkan detail fasilitas di sini jika tersedia --}}
            </div>
        </div>
    </div>

    <style>
        .aspect-16-9 {
            aspect-ratio: 16 / 9;
        }

        /* Gaya dasar untuk body */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            overflow: hidden; /* Mencegah scrollbar jika gambar latar belakang lebih besar */
            min-height: 100vh; /* Memastikan halaman mengisi seluruh tinggi viewport */
            position: relative; /* Penting untuk posisi absolut lapisan latar belakang */
            background-color: transparent; /* Pastikan body tidak memiliki background solid bawaan */
        }

        /* Kelas untuk lapisan latar belakang dinamis */
        .background-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0; /* Mulai tersembunyi */
            transition: opacity 2s ease-in-out; /* Transisi halus untuk perubahan opacity (lebih cepat) */
            z-index: -2; /* Ditempatkan di belakang overlay dan konten */
        }

        /* Lapisan pertama dimulai dengan opacity 1 agar terlihat */
        #background-layer-1 {
            opacity: 1;
        }

        /* Pastikan elemen utama tidak memiliki latar belakang yang menutupi body */
        #main-content-wrapper {
            position: relative; /* Penting agar z-index bekerja dengan benar */
            z-index: 1; /* Pastikan konten utama berada di atas latar belakang */
            /* background-color: rgba(255, 255, 255, 0.9); Ini sudah diatur dengan Tailwind bg-white/80 */
            /* Anda mungkin perlu menyesuaikan tinggi atau margin/padding di sini
               agar konten tidak menutupi seluruh area dan background terlihat */
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

        // Inisialisasi carousel
        document.addEventListener('DOMContentLoaded', () => {
            if (slides.length > 0) {
                showSlide(currentIndex);
            }

            // JavaScript untuk mengubah gambar latar belakang
            const backgroundImages = [
                '/image/view.png', // Ganti dengan path gambar Anda yang sebenarnya
                '/image/view2.png',
                '/image/view3.png',
                '/image/view4.png',
                '/image/view5.png',
                '/image/fasilitasimg/gazebo.png',
                '/image/fasilitasimg/kolam.png',
                '/image/fasilitasimg/meetingroom.png',
                '/image/fasilitasimg/parkiran.png',
                '/image/fasilitasimg/restorasn.png'
                // Tambahkan lebih banyak path gambar sesuai kebutuhan
            ];

            let currentBackgroundIndex = 0;
            let currentLayer = document.getElementById('background-layer-1'); // Lapisan yang sedang aktif
            let nextLayer = document.getElementById('background-layer-2'); // Lapisan berikutnya

            // Fungsi untuk mengubah latar belakang secara berurutan dengan efek fade
            function changeSequentialBackground() {
                // Hitung indeks gambar berikutnya
                currentBackgroundIndex = (currentBackgroundIndex + 1) % backgroundImages.length;

                const imageUrl = backgroundImages[currentBackgroundIndex];

                // Atur gambar baru pada lapisan yang saat ini tidak terlihat
                nextLayer.style.backgroundImage = `url('${imageUrl}')`;

                // Mulai transisi: lapisan saat ini memudar keluar, lapisan berikutnya memudar masuk
                currentLayer.style.opacity = '0';
                nextLayer.style.opacity = '1';

                // Tukar referensi lapisan untuk siklus berikutnya
                [currentLayer, nextLayer] = [nextLayer, currentLayer];

                console.log('Mengganti latar belakang ke:', imageUrl); // Debugging: log path gambar
            }

            // Jalankan fungsi saat halaman dimuat pertama kali
            // Set gambar pertama pada lapisan awal
            currentLayer.style.backgroundImage =
                `url('${backgroundImages[0] || 'https://placehold.co/1920x1080/CCCCCC/000000?text=Initial+Background'}')`;

            // Ubah latar belakang setiap 5 detik (5000 milidetik)
            // Durasi interval (5s) harus lebih lama dari durasi transisi (2s) untuk transisi yang mulus
            setInterval(changeSequentialBackground, 5000);
        });
    </script>
</x-layout>
