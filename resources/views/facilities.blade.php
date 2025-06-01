<x-layout>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <div class="slider-container">
                <div class="slider-item active">
                    <img src="image/fasilitasimg/kolam.png" alt="Kolam Renang">
                    <div class="text-container">
                        <h2 class="slider-title">Kolam Renang</h2>
                        <p class="slider-description">
                            Rasakan kesegaran tiada duanya di kolam renang kami yang dirancang untuk
                            relaksasi dan kenyamanan maksimal—tempat sempurna melepas penat setelah
                            seharian beraktivitas.
                        </p>
                        <a href="#" class="slider-button show-details-button" data-facility-id="kolam-renang">Lihat
                            Selengkapnya</a>
                    </div>
                </div>
                <div class="slider-item">
                    <img src="image/fasilitasimg/meetingroom.png" alt="Ruang Rapat">
                    <div class="text-container">
                        <h2 class="slider-title">Ruang Rapat</h2>
                        <p class="slider-description">
                            Temukan standar baru untuk pertemuan profesional dengan ruang rapat
                            kami yang dapat disesuaikan untuk segala kebutuhan bisnis Anda.
                        </p>
                        <a href="#" class="slider-button show-details-button" data-facility-id="ruang-rapat">Lihat
                            Selengkapnya</a>
                    </div>
                </div>
                <div class="slider-item">
                    <img src="image/fasilitasimg/parkiran.png" alt="Area Parkir">
                    <div class="text-container">
                        <h2 class="slider-title">Area Parkir</h2>
                        <p class="slider-description">
                            Fasilitas parkir luas, aman, dan bebas biaya—karena kenyamanan Anda
                            adalah prioritas kami sejak langkah pertama.
                        </p>
                        <a href="#" class="slider-button show-details-button" data-facility-id="area-parkir">Lihat
                            Selengkapnya</a>
                    </div>
                </div>
                <div class="slider-item">
                    <img src="image/fasilitasimg/gazebo.png" alt="Gazebo">
                    <div class="text-container">
                        <h2 class="slider-title">Gazebo</h2>
                        <p class="slider-description">
                            Santai sejenak di gazebo nyaman kami — tempat asyik buat ngopi, ngobrol,
                            atau sekadar menikmati angin sepoi-sepoi dan suasana tenang di tengah
                            hotel yang bikin betah.
                        </p>
                        <a href="#" class="slider-button show-details-button" data-facility-id="gazebo">Lihat
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="modal-overlay" id="facilityDetailModal">
        <div class="modal-content">
            <button class="modal-close-button" id="closeModalButton">&times;</button>
            <h3 class="modal-title" id="modalTitle"></h3>
            <p class="modal-description" id="modalDescription"></p>
        </div>
    </div>
    <style>
        body {
            padding-top: 10rem;
            overflow-y: hidden;
            margin: 0;
            padding-top: 0;
        }

        .slider-container {
            width: 100%;
            height: 100vh;
            position: relative;
            overflow: hidden;
            margin-left: calc(50% - 50vw);
            width: 100vw;
        }

        .slider-item {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0;
            object-fit: cover;
        }

        .slider-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider-item.active {
            opacity: 1;
            z-index: 1;
        }

        .text-container {
            padding-bottom: 50px;
        }

        .slider-title {
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            text-align: right;
        }

        .slider-description {
            color: white;
            font-size: 1rem;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            max-width: 80%;
            margin-left: auto;
            margin-right: 0;
            text-align: right;
        }

        .slider-button {
            background-color: #4caf50;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            text-align: right;
        }

        .slider-button:hover {
            background-color: #45a049;
        }

        /* Gaya untuk Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Latar belakang gelap transparan */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 2000;
            /* Pastikan di atas semua konten */
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 1rem;
            max-width: 600px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
            transform: translateY(20px);
            /* Efek masuk */
            transition: transform 0.3s ease;
        }

        .modal-overlay.active .modal-content {
            transform: translateY(0);
        }

        .modal-close-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
            transition: color 0.2s ease;
        }

        .modal-close-button:hover {
            color: #1f2937;
        }

        .modal-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .modal-description {
            font-size: 1rem;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .slider-item .text-container {
            position: absolute;
            bottom: 2rem;
            right: 2rem;
            text-align: right;
            width: 80%;
        }
    </style>
    <script>
        const sliderItems = document.querySelectorAll(".slider-item");
        let currentSlide = 0;
        const intervalTime = 3000;

        function showSlide(slideIndex) {
            sliderItems.forEach((item, index) => {
                item.classList.remove("active");
            });
            sliderItems[slideIndex].classList.add("active");
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % sliderItems.length;
            showSlide(currentSlide);
        }

        showSlide(currentSlide);
        setInterval(nextSlide, intervalTime);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderItems = document.querySelectorAll(".slider-item");
            let currentSlide = 0;
            const intervalTime = 3000; // Ganti gambar setiap 3 detik

            // Slider functionality
            function showSlide(slideIndex) {
                sliderItems.forEach((item) => {
                    item.classList.remove("active");
                });
                sliderItems[slideIndex].classList.add("active");
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % sliderItems.length;
                showSlide(currentSlide);
            }

            showSlide(currentSlide);
            setInterval(nextSlide, intervalTime);

            // Modal functionality
            const showDetailsButtons = document.querySelectorAll('.show-details-button');
            const facilityDetailModal = document.getElementById('facilityDetailModal');
            const closeModalButton = document.getElementById('closeModalButton');
            const modalTitle = document.getElementById('modalTitle');
            const modalDescription = document.getElementById('modalDescription');

            // Data deskripsi panjang untuk setiap fasilitas
            const facilityDetails = {
                'kolam-renang': {
                    title: 'Kolam Renang',
                    description: 'Kolam renang di Homestay Barijekaden dirancang untuk relaksasi dan kesenangan keluarga. Dengan kedalaman yang bervariasi, kolam ini cocok untuk dewasa maupun anak-anak. Air kolam selalu dijaga kebersihannya dan dilengkapi dengan area berjemur serta kursi santai. Buka dari pagi hingga sore hari, ini adalah tempat yang sempurna untuk menyegarkan diri setelah seharian beraktivitas. Kami juga menyediakan handuk bersih dan area bilas yang nyaman.'
                },
                'ruang-rapat': {
                    title: 'Ruang Rapat',
                    description: 'Ruang rapat kami di Homestay Barijekaden menawarkan lingkungan yang profesional dan kondusif untuk segala jenis pertemuan bisnis, workshop, atau presentasi. Dilengkapi dengan proyektor, layar, Wi-Fi berkecepatan tinggi, dan fasilitas audio visual modern. Kapasitas ruang dapat disesuaikan untuk kelompok kecil maupun menengah, memastikan kenyamanan dan produktivitas maksimal bagi peserta Anda.'
                },
                'area-parkir': {
                    title: 'Area Parkir',
                    description: 'Homestay Barijekaden menyediakan area parkir yang sangat luas dan aman, mampu menampung puluhan kendaraan roda empat dan roda dua. Area ini dilengkapi dengan pencahayaan yang memadai di malam hari dan pengawasan CCTV 24 jam untuk memastikan keamanan kendaraan Anda selama menginap. Parkir gratis untuk semua tamu homestay, memberikan ketenangan pikiran selama liburan atau perjalanan bisnis Anda.'
                },
                'gazebo': {
                    title: 'Gazebo',
                    description: 'Nikmati suasana tenang dan sejuk di gazebo-gazebo kami yang tersebar di area taman Homestay Barijekaden. Setiap gazebo dilengkapi dengan tempat duduk nyaman, ideal untuk bersantai sambil menikmati kopi, membaca buku, atau berbincang santai dengan keluarga dan teman. Dikelilingi oleh pepohonan rindang dan suara alam, gazebo kami menawarkan privasi dan ketenangan yang sempurna untuk melepas penat.'
                }
                // Tambahkan fasilitas lain di sini jika ada
            };

            // Fungsi untuk menampilkan modal
            function openModal(facilityId) {
                const details = facilityDetails[facilityId];
                if (details) {
                    modalTitle.textContent = details.title;
                    modalDescription.textContent = details.description;
                    facilityDetailModal.classList.add('active');
                    document.body.style.overflow = 'hidden'; // Mencegah scroll body saat modal terbuka
                }
            }

            // Fungsi untuk menutup modal
            function closeModal() {
                facilityDetailModal.classList.remove('active');
                document.body.style.overflow = ''; // Mengembalikan scroll body
            }

            // Event listener untuk semua tombol "Lihat Selengkapnya"
            showDetailsButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah navigasi default link
                    const facilityId = this.dataset
                    .facilityId; // Ambil ID fasilitas dari data-attribute
                    openModal(facilityId);
                });
            });

            // Event listener untuk tombol tutup modal
            closeModalButton.addEventListener('click', closeModal);

            // Event listener untuk menutup modal saat mengklik di luar konten modal
            facilityDetailModal.addEventListener('click', function(event) {
                if (event.target === facilityDetailModal) {
                    closeModal();
                }
            });
        });
    </script>
</x-layout>
