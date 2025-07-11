<x-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Ulasan Pengguna ⭐</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($reviews as $review)
                <div class="review-card"
                    style="border: 4px solid #38A169; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; background-color: white; border-radius: 10px; position: relative;">

                    <div
                        style="width: 50px; height: 50px; background-color: #38A169; color: white; display: flex; justify-content: center; align-items: center; font-weight: bold; border-radius: 50%; position: absolute; top: -10px; left: -10px;">
                        ⭐ {{ $review->rating }}
                    </div>

                    <div
                        style="width: 150px; padding: 10px; background-color: #4299E1; color: white; text-align: center; font-weight: bold; border-radius: 5px; margin-bottom: 10px;">
                        {{ $review->user->name }}
                    </div>

                    {{-- Perhatian: Struktur triangle Anda di CSS murni mungkin tidak menampilkan teks dengan baik.
                         Ini perlu penyesuaian jika Anda ingin teks komentar ada di dalam bentuk triangle.
                         Untuk tujuan fungsionalitas, saya akan tetap memakai div biasa dengan gaya komentar. --}}
                    <div class="review-comment" style="margin-top: 15px; color: #333; line-height: 1.6;">
                         {{ $review->comment }}
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-600 col-span-full">Belum ada ulasan. Jadilah yang pertama memberikan ulasan!</p>
            @endforelse
        </div>
    </div>

    <button id="addReviewButton" class="add-review-button">+</button>

    <div id="reviewFormModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Berikan Ulasan Anda</h2>
            <form id="newReviewForm" action="{{ route('reviews.store') }}" method="POST">
                @csrf {{-- Penting untuk Laravel, untuk perlindungan CSRF --}}

                <div class="mb-4">
                    <label for="reviewer_name" class="block text-gray-700 text-sm font-bold mb-2">Nama Anda:</label>
                    <input type="text" id="reviewer_name" name="reviewer_name"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           required>
                </div>

                <div class="mb-4">
                    <label for="review_rating" class="block text-gray-700 text-sm font-bold mb-2">Bintang:</label>
                    <select id="review_rating" name="review_rating"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            required>
                        <option value="">Pilih Bintang</option>
                        <option value="5">⭐⭐⭐⭐⭐ (Sangat Baik)</option>
                        <option value="4">⭐⭐⭐⭐ (Baik)</option>
                        <option value="3">⭐⭐⭐ (Cukup)</option>
                        <option value="2">⭐⭐ (Kurang)</option>
                        <option value="1">⭐ (Buruk)</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="review_comment" class="block text-gray-700 text-sm font-bold mb-2">Komentar Anda:</label>
                    <textarea id="review_comment" name="review_comment" rows="5"
                              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                              placeholder="Tulis ulasan Anda di sini..." required></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- CSS Inline untuk tombol dan modal (Bisa dipindahkan ke file CSS terpisah) --}}
    <style>
        /* Gaya untuk Tombol Tambah Ulasan (+) */
        .add-review-button {
            background-color: #bf7029; /* Warna biru */
            color: white;
            font-size: 2.5em; /* Ukuran tanda plus */
            border: none;
            border-radius: 50%; /* Membuat tombol bulat */
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            position: fixed; /* Membuat tombol tetap di posisi tertentu di layar */
            bottom: 30px; /* Jarak dari bawah */
            right: 30px; /* Jarak dari kanan */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); /* Efek bayangan */
            z-index: 1000; /* Pastikan tombol di atas elemen lain */
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .add-review-button:hover {
            background-color: #0056b3; /* Warna lebih gelap saat di-hover */
            transform: scale(1.05); /* Sedikit membesar saat di-hover */
        }

        /* Gaya untuk Modal (Pop-up Form) */
        .modal {
            display: none; /* Sembunyikan modal secara default */
            position: fixed; /* Tetap di tempat */
            z-index: 1001; /* Z-index lebih tinggi dari tombol */
            left: 0;
            top: 0;
            width: 100%; /* Lebar penuh */
            height: 100%; /* Tinggi penuh */
            overflow: auto; /* Aktifkan scroll jika konten terlalu panjang */
            background-color: rgba(0,0,0,0.6); /* Background hitam transparan */
            display: flex; /* Menggunakan flexbox untuk menengahkan konten */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            width: 90%; /* Lebar modal */
            max-width: 500px; /* Lebar maksimum */
            position: relative; /* Untuk posisi tombol close */
            animation: fadeIn 0.3s ease-out; /* Animasi muncul */
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .close-button {
            color: #aaa;
            position: absolute;
            top: 15px;
            right: 25px;
            font-size: 30px;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-button:hover,
        .close-button:focus {
            color: #333;
            text-decoration: none;
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .add-review-button {
                width: 50px;
                height: 50px;
                font-size: 2em;
                bottom: 20px;
                right: 20px;
            }

            .modal-content {
                width: 95%;
                margin: 5% auto; /* Sesuaikan margin untuk layar kecil */
            }
        }

        /* Catatan: Untuk bentuk triangle komentar, kode CSS murni Anda
           akan membuat div menjadi bentuk segitiga, bukan kotak berisi teks.
           Untuk menampilkan teks komentar dengan baik, Anda mungkin perlu
           menggunakan `::before` atau `::after` pada div komentar untuk
           membuat efek triangle, atau hanya menggunakan div biasa
           dengan padding dan background. Saya mempertahankan struktur asli Anda
           tapi menambahkan class `review-comment` untuk styling yang lebih standar
           untuk teks komentar. */
    </style>

    {{-- JavaScript untuk Interaksi Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addReviewButton = document.getElementById('addReviewButton');
            const reviewFormModal = document.getElementById('reviewFormModal');
            const closeButton = document.querySelector('.close-button');
            const newReviewForm = document.getElementById('newReviewForm');

            // Fungsi untuk menampilkan modal
            addReviewButton.onclick = function() {
                reviewFormModal.style.display = 'flex'; // Gunakan flex untuk menengahkan
            }

            // Fungsi untuk menyembunyikan modal dan mereset form
            function closeReviewModal() {
                reviewFormModal.style.display = 'none';
                newReviewForm.reset(); // Mengosongkan semua field form
            }

            // Ketika pengguna mengklik tombol (x), tutup modal
            closeButton.onclick = closeReviewModal;

            // Ketika pengguna mengklik di luar area modal, tutup modal
            window.onclick = function(event) {
                if (event.target == reviewFormModal) {
                    closeReviewModal();
                }
            }

            // Mengelola submit formulir
            newReviewForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form dari refresh halaman

                const formData = new FormData(this); // Mengambil semua data form
                const url = this.action; // Ambil URL dari atribut action form
                const method = this.method; // Ambil method dari atribut method form

                // Kirim data menggunakan Fetch API
                fetch(url, {
                    method: method,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // Laravel specific header for AJAX
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ambil CSRF token dari meta tag
                    },
                    body: formData // Kirim FormData langsung
                })
                .then(response => {
                    if (!response.ok) {
                        // Jika respons bukan OK (e.g., 400, 500), coba baca error
                        return response.json().then(errorData => {
                            throw new Error(errorData.message || 'Something went wrong');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Success:', data);
                    alert('Ulasan Anda berhasil dikirim!');
                    closeReviewModal();
                    // Opsional: Reload halaman untuk menampilkan ulasan baru
                    // Atau tambahkan ulasan baru secara dinamis ke DOM
                    window.location.reload(); // Pilihan mudah untuk memastikan ulasan muncul
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Gagal mengirim ulasan: ' + error.message);
                });
            });

            // Pastikan modal disembunyikan saat halaman dimuat
            reviewFormModal.style.display = 'none';
        });
    </script>
</x-layout>