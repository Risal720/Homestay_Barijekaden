<x-layout>
      
    <x-slot:tittle>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>{{ $tittle }}</h1>
            <div>
                <button id="loginBtn" class=" rounded-md px-3 py-2 bg-[#5e3d13] p-1 text-[0.6em] text-[#bf7029] hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#bf7029] focus:outline-hidden">LOGIN</button>
            </div>
        </div>
    </x-slot:tittle>

    <div id="loginModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2 class="text-2xl font-semibold text-center text-gray-800 mb-4">Login</h2>
            <form action="/login" method="post" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" name="email" id="email"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                           placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                    @error('email')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                    <input type="password" name="password" id="password"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="password" required>
                </div>
                <div class="text-center">
                    <a href="#" class="inline-block align-baseline font-semibold text-sm text-blue-500 hover:text-blue-800">
                        Forgot Password?
                    </a>
                </div>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                    Login
                </button>
            </form>
        </div>
    </div>

    <div id="modalOverlay" class="modal-overlay"></div>

    <div>
        {{-- Konten lain di halaman home jika ada --}}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginButton = document.getElementById('loginBtn');
            const loginModal = document.getElementById('loginModal');
            const modalOverlay = document.getElementById('modalOverlay');
            const closeButton = document.querySelector('.modal-content .close-button');

            loginButton.addEventListener('click', function() {
                loginModal.style.display = 'block';
                modalOverlay.style.display = 'block';
            });

            closeButton.addEventListener('click', function() {
                loginModal.style.display = 'none';
                modalOverlay.style.display = 'none';
            });

            window.addEventListener('click', function(event) {
                if (event.target === modalOverlay) {
                    loginModal.style.display = 'none';
                    modalOverlay.style.display = 'none';
                }
            });
        });
    </script>

</x-layout>

<style>
    .modal-overlay {
        display: none; /* Sembunyikan overlay secara default */
        position: fixed; /* Tetap di viewport meskipun di-scroll */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Latar belakang gelap semi-transparan */
        z-index: 1000; /* Pastikan overlay di atas konten lain */
    }

    .modal {
        display: none; /* Sembunyikan modal secara default */
        position: fixed; /* Tetap di viewport meskipun di-scroll */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); /* Posisikan di tengah */
        z-index: 1001; /* Pastikan modal di atas overlay */
    }

    .modal-content {
        background-color: #fff; /* Warna latar belakang modal */
        padding: 20px;
        border-radius: 0.5rem; /* Sesuai dengan rounded-md */
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); /* Sesuai dengan shadow-md */
        width: auto; /* Biarkan lebar menyesuaikan konten */
        max-width: 480px; /* Contoh lebar maksimum */
        position: relative; /* Untuk memposisikan close button */
    }

    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
    }

    .close-button:hover,
    .close-button:focus {
        color: black;
    }
</style
