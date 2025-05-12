
<x-layout>
  <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
  <body>
  <div class="slider-container">
      <div class="slider-item">
        <img src="image/fasilitasimg/kolam.png" alt="">
        <div class="slider-content">
          <h2 class="slider-title">Swimming Pool</h2>
          <p class="slider-description">“Rasakan kesegaran tiada duanya di kolam renang kami yang dirancang untuk relaksasi dan kenyamanan maksimal—tempat sempurna melepas penat setelah seharian beraktivitas.”</p>
          <a class="slider-action" href="#">See More</a>
        </div>
      </div>
      <div class="slider-item">
        <img  src="image/fasilitasimg/meetingroom.png" alt="" />
        <div class="slider-content">
          <h2 class="slider-title">Meeting Room</h2>
          <p class="slider-description">“Temukan standar baru untuk pertemuan profesional dengan ruang meeting kami yang dapat disesuaikan untuk segala kebutuhan bisnis Anda.”</p>
          <a class="slider-action" href="#">See More</a>
        </div>
      </div>
      <div class="slider-item">
        <img  src="image/fasilitasimg/parkiran.png" alt="" />
        <div class="slider-content">
          <h2 class="slider-title">Area Parkir</h2>
          <p class="slider-description">“Fasilitas parkir luas, aman, dan bebas biaya—karena kenyamanan Anda adalah prioritas kami sejak langkah pertama.”</p>
          <a class="slider-action" href="#">See More</a>
        </div>
      </div>
      <div class="slider-item">
        <img src="image/fasilitasimg/gazebo.png" alt="" />
        <div class="slider-content">
          <h2 class="slider-title">Gazebo</h2>
          <p class="slider-description">"Santai sejenak di gazebo nyaman kami — tempat asyik buat ngopi, ngobrol, atau sekadar menikmati angin sepoi-sepoi dan suasana tenang di tengah hotel yang bikin betah."</p>
          <a class="slider-action" href="#">See More</a>
        </div>
      </div>
    </div>

    <style>
body {
    overflow-x: hidden;
    overflow-y: hidden;
    
}
.slider-container {
    
    width: 100vw;
    height: auto;
    isolation: isolate;
    margin-top: -3%;
}

.slider-container .slider-item {
    width: 100vw;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    position: absolute;
    transition: opacity 3000ms;
    padding-top: 0;
    padding-bottom: 0;
    

    
}
.slider-container .slider-item[data-show="show"] {
    opacity: 1;
}
.slider-container .slider-item[data-show="hidden"] {
    z-index: -1;
    opacity: 0;
}
.slider-container .slider-item::before {
    content: "";
    width: 100%;
    height: 100%;
    position: absolute;
    background-image: linear-gradient(
        to top,
        rgba(0, 0, 0, 0.416),
        rgba(0, 0, 0, 0.151),
        transparent
    );
}
.slider-container .slider-item img {
    max-width: 80%;
    max-height: 80%;
    width: 100%;
    height: auto;
    object-fit: contain;
    margin-top: 0;
    display: block;
}
.slider-item .slider-content {
    position: absolute;
    color: white;
    text-align: center;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
    
}
.slider-content .slider-title {
    font-size: 5rem;
}
.slider-content .slider-description {
    width: 80ch;
}
.slider-content .slider-action {
    color: white;
    border: 1px solid white;
    padding: 0.5rem 1.5rem;
    font-size: 1rem;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 4px;
    width: fit-content;
    position: relative;
    isolation: isolate;
    transition: all 500ms;
}
.slider-content .slider-action::before {
    content: "";
    background-color: white;
    position: absolute;
    inset: 0;
    z-index: -1;
    width: 0;
    transition: all 500ms;
}
.slider-content .slider-action:hover {
    color: black;
}
.slider-content .slider-action:hover::before {
    width: 100%;
}

    </style>


    <script>
      const sliderItems = document.querySelectorAll(".slider-item");

let sliderActive = 1;

if (sliderItems) {
  sliderItems.forEach((slider, index) => {
    if (index === 0) {
      slider.setAttribute("data-show", "show");
    } else {
      slider.setAttribute("data-show", "hidden");
    }
  });

  setInterval(() => {
    sliderItems.forEach((slider, index) => {
      if (sliderActive === index) {
        slider.setAttribute("data-show", "show");
      } else {
        slider.setAttribute("data-show", "hidden");
      }
    });

    if (sliderActive === sliderItems.length - 1) {
      sliderActive = 0;
    } else {
      sliderActive++;
    }
  }, 5000);
}

    </script>
  </body>
</x-layout>
