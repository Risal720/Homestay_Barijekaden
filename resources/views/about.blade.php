<x-layout>
  <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="konten-area">
            <div class="deskripsi-area">
                <h2>Deskripsi</h2>
                <p>
                Rasakan pengalaman menginap tak terlupakan di BARIJEKADEN Homestay, yang terletak di kawasan pegunungan yang tenang dan dikelilingi hutan pinus yang mempesona. Kami hadirkan akomodasi yang nyaman dengan desain yang mengutamakan keindahan alam, menciptakan suasana hangat dan santai untuk setiap tamu. Manfaatkan berbagai fasilitas yang kami sediakan, mulai dari kamar-kamar dengan panorama yang menakjubkan, area outdoor yang asri, hingga kemudahan akses ke jalur hiking dan destinasi wisata alam. BARIJEKADEN adalah tempat yang tepat untuk mewujudkan liburan impian Anda, baik untuk bersantai, berpetualang, maupun menikmati keindahan alam pegunungan yang menyegarkan. 
                </p>
            </div>
            <div class="peta-area">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1270.113110701437!2d107.09415190314877!3d-6.36412066321592!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1sid!2sid!4v1747326854450!5m2!1sid!2sid"
                    style="border: 0"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
            <div class="kontak-area">
                <h2>Hubungi kami</h2>
                
                <p>Telepon: (021) 12345678</p>
                <p>Email: info@example.com</p>
                <p>Media Sosial: @example_sosmed</p>
                <p>Jam Operasional: 09:00 - 17:00 WIB</p>
                <p>Alamat: Jl. Medan Merdeka, Jakarta Pusat</p>
            </div>
        </div>
    </div>
</x-layout>
<style>
      .konten-area {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: stretch;
        margin-top: 0;
      }
      .deskripsi-area {
        flex: 1 1 40%;
        padding: 1.5rem;
        background-color: #f0fdf4;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
      }
      .peta-area {
        flex: 1 1 55%;
        height: 400px;
        background-color: #fce7f3;
        border-radius: 0.5rem;
        margin-bottom: 1rem;
        display: flex; /* Tambahkan flex display */
        align-items: stretch; /* Agar iframe mengisi tinggi peta-area */
        overflow: hidden;
      }
      .peta-area iframe {
        width: 100%;
        height: 100%;
        border: 0;
      }
      .kontak-area {
        flex: 1 1 100%;
        padding: 1.5rem;
        background-color: #e0f2fe;
        border-radius: 0.5rem;
      }
    </style>
