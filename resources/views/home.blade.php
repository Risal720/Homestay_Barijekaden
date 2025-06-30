<x-layout>

    <head>
        <style>
            /* Gaya dasar untuk body */
            body {
                font-family: 'Inter', sans-serif;
                /* Font dasar untuk seluruh body */
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                overflow: hidden;
                /* Mencegah scrollbar jika gambar latar belakang lebih besar */
                color: #fff;
                /* Warna teks putih agar kontras dengan latar belakang gelap */
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                /* Memastikan halaman mengisi seluruh tinggi viewport */
                position: relative;
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
                opacity: 0;
                /* Mulai tersembunyi */
                transition: opacity 5s ease-in-out;
                /* Transisi halus untuk perubahan opacity */
                z-index: -2;
                /* Ditempatkan di belakang overlay dan konten */
            }

            /* Lapisan pertama dimulai dengan opacity 1 agar terlihat */
            #background-layer-1 {
                opacity: 1;
            }

            /* Kelas kustom untuk efek text-shadow */
            .text-shadow-md {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
            }

            .text-shadow-lg {
                text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.8);
            }

            .text-shadow-sm {
                text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            }

            /* Kelas kustom untuk font Playfair Display */
            .font-playfair {
                font-family: 'Playfair Display', serif;
            }

            .homestay-title-font {
                font-size: 50px;
                font-family: "Norican", cursive;
                font-style: normal;
            }

            .text-shadow-custom {
                text-shadow: 8px 8px 32px rgb(0, 0, 0);
                /* Bayangan teks: offset-x, offset-y, blur-radius, warna (putih, opacity 0.8) */
            }
        </style>
    </head>

    <body class="m-0 p-0 box-border overflow-hidden text-white flex justify-center items-center min-h-screen relative">
        <!-- Dua lapisan untuk latar belakang yang akan saling cross-fade -->
        <div id="background-layer-1" class="background-layer"></div>
        <div id="background-layer-2" class="background-layer"></div>

        <!-- Overlay gelap untuk kontras, ditempatkan di belakang konten tetapi di atas lapisan background -->
        <div class="absolute inset-0 w-full h-full bg-black/40 -z-20"></div>

        <!-- Container utama untuk konten teks -->
        <div class="mt-4 flex flex-col items-center justify-center">
            <!-- Div untuk margin atas 4rem seperti yang diminta -->
            <div class="mt-50">
                <!-- Div untuk teks "Welcome to" -->
                <div class="text-3xl font-semibold text-center text-shadow-custom">
                    Welcome to
                </div>
                <!-- Div untuk nama homestay -->
                <div class="text-4xl font-semibold mt-2 text-center homestay-title-font text-shadow-custom">
                    Barijekaden Homestay's
                </div>
            </div>

            <!-- Div untuk kotak deskripsi berwarna oranye -->
            <!-- Mengatur margin atas 4rem, latar belakang oranye, sudut membulat, padding, lebar responsif, dan item terpusat -->
            <div class="mt-55 bg-[#00000061] rounded-lg p-8 max-w-full flex items-center justify-center min-h-[150px]">
                <!-- Div untuk teks "deskripsi" di dalam kotak oranye -->
                <div class="text-white text-l font-medium text-center">
                    Rasakan pengalaman menginap tak terlupakan di BARIJEKADEN Homestay, yang terletak di kawasan
                    pegunungan yang tenang dan dikelilingi hutan pinus yang mempesona. Kami hadirkan akomodasi yang
                    nyaman dengan desain yang mengutamakan keindahan alam, menciptakan suasana hangat dan santai untuk
                    setiap tamu. Manfaatkan berbagai fasilitas yang kami sediakan, mulai dari kamar-kamar dengan
                    panorama yang menakjubkan, area outdoor yang asri, hingga kemudahan akses ke jalur hiking dan
                    destinasi wisata alam. BARIJEKADEN adalah tempat yang tepat untuk mewujudkan liburan impian Anda,
                    baik untuk bersantai, berpetualang, maupun menikmati keindahan alam pegunungan yang menyegarkan.
                </div>
            </div>
        </div>

        <script>
            // Daftar path gambar latar belakang Anda.
            // Ganti URL placeholder ini dengan path gambar Anda yang sebenarnya.
            // Pastikan path ini benar relatif terhadap file HTML Anda.
            const backgroundImages = [
                'image/view2.png',
                'image/orang.png',
                'image/room.png',
                'image/view3.png',
                'image/view.png',
                'image/view4.png',
                'image/view2.png',
                'image/view5.png',
                'image/fasilitasimg/gazebo.png', // Contoh gambar dari subfolder 'fasilitasimg'
                'image/fasilitasimg/kolam.png',
                'image/fasilitasimg/meetingroom.png', // Contoh placeholder jika Anda masih ingin menggunakannya
                'image/fasilitasimg/parkiran.png',
                'image/fasilitasimg/restoran.png'
            ];

            // ,'https://placehold.co/1920x1080/9C27B0/FFFFFF?text=Pemandangan+Hutan+4'
            let currentImageIndex = 0; // Mulai dari indeks 0 untuk looping sequential
            let currentLayer = document.getElementById('background-layer-1'); // Lapisan yang sedang aktif
            let nextLayer = document.getElementById('background-layer-2'); // Lapisan berikutnya

            // Fungsi untuk mengubah latar belakang secara berurutan dengan efek fade
            function changeSequentialBackground() {
                // Hitung indeks gambar berikutnya
                currentImageIndex = (currentImageIndex + 1) % backgroundImages.length;

                const imageUrl = backgroundImages[currentImageIndex];

                // Atur gambar baru pada lapisan yang saat ini tidak terlihat
                nextLayer.style.backgroundImage = `url('${imageUrl}')`;

                // Mulai transisi: lapisan saat ini memudar keluar, lapisan berikutnya memudar masuk
                currentLayer.style.opacity = '0';
                nextLayer.style.opacity = '1';

                // Tukar referensi lapisan untuk siklus berikutnya
                // currentLayer akan menjadi nextLayer yang baru saja terlihat, dan sebaliknya
                [currentLayer, nextLayer] = [nextLayer, currentLayer];
            }

            // Jalankan fungsi saat halaman dimuat pertama kali
            window.onload = function() {
                // Set gambar pertama pada lapisan awal
                currentLayer.style.backgroundImage =
                    `url('${backgroundImages[0] || 'https://placehold.co/1920x1080/CCCCCC/000000?text=Initial+Background'}')`;

                // Ubah latar belakang setiap 1 detik (1000 milidetik)
                // Durasi interval harus lebih lama dari durasi transisi (0.5s)
                setInterval(changeSequentialBackground, 5000);
            };
        </script>
    </body>
</x-layout>
