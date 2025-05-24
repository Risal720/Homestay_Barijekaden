<x-layout>
  <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
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
                            <a href="#" class="slider-button">Lihat Selengkapnya</a>
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
                            <a href="#" class="slider-button">Lihat Selengkapnya</a>
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
                            <a href="#" class="slider-button">Lihat Selengkapnya</a>
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
                            <a href="#" class="slider-button">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    <style>
        body{
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
        .slider-title {
            color: white;
            font-size: 2rem;
            font-weight: bold;
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
</x-layout>
