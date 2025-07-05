<nav class="bg-[#432a0b] fixed-navbar" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="relative flex items-center">
                    <div class="shrink-0">
                        <img class="size-10 mr-2" src="{{ asset('image/logo.png') }}" alt="Your Company">
                    </div>
                    <a href="/">
                        <p class="text-[#bf7029] norican-regular">Barijekaden</p>
                    </a>
                </div>
            </div>
            <div class="flex items-center">
                <div class="hidden md:block">
                    <div class="ml-10 flex items-center space-x-4 justify-end">
                        <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
                        <x-nav-link href="/rooms" :active="request()->is('rooms')">Room</x-nav-link>
                        <x-nav-link href="/facilities" :active="request()->is('facilities')">Facilities</x-nav-link>
                        <x-nav-link href="/reviews" :active="request()->is('reviews')">Reviews</x-nav-link>
                        <x-nav-link href="/about" :active="request()->is('about')">About Us</x-nav-link>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <button type="button"
                            class="relative rounded-full bg-[#5e3d13] p-1 text-[#bf7029] hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#bf7029] focus:outline-hidden">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">View notifications</span>
                            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" data-slot="icon">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                            </svg>
                        </button>

                        <!-- Profile dropdown -->
                        <div class="relative ml-3">
                            <div>
                                <button type="button" @click="isOpen = !isOpen"
                                    class="relative flex max-w-xs items-center rounded-full bg-[#5e3d13] text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#bf7029] focus:outline-hidden"
                                    id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img class="size-8 rounded-full"
                                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                                </button>
                            </div>

                            <!--
                Dropdown menu, show/hide based on menu state.

                Entering: "transition ease-out duration-100"
                  From: "transform opacity-0 scale-95"
                  To: "transform opacity-100 scale-100"
                Leaving: "transition ease-in duration-75"
                  From: "transform opacity-100 scale-100"
                  To: "transform opacity-0 scale-95"
              -->
                            <div x-show="isOpen" x-transition:enter="transition ease-out duration-100 transform"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75 transform"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-[#432a0b] py-1 shadow-lg ring-1 ring-[#ffffff] focus:outline-hidden"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                tabindex="-1">
                                <!-- Active: "bg-gray-100 outline-hidden", Not Active: "" -->
                                <a href="/profile" class="block px-4 py-2 text-sm text-[#ffffff]" role="menuitem"
                                    tabindex="-1" id="user-menu-item-0">Profile</a>
                                <a href="/setting" class="block px-4 py-2 text-sm text-[#ffffff]" role="menuitem"
                                    tabindex="-1" id="user-menu-item-1">Settings</a>
                                <a href="#" id="openOverlayLink" class="block px-4 py-2 text-sm text-[#ffffff]"
                                    role="menuitem" tabindex="-1" id="user-menu-item-2">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="-mr-2 flex md:hidden">
                <!-- Mobile menu button -->
                <button type="button" @click="isOpen = !isOpen"
                    class="relative inline-flex items-center justify-center rounded-md bg-[#5e3d13] p-2 text-[#bf7029] hover:bg-[#885318] hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#bf7029] focus:outline-hidden"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                        data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                        data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
        <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
            <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link href="/rooms" :active="request()->is('rooms')">Room</x-nav-link>
            <x-nav-link href="/facilities" :active="request()->is('facilities')">Facilities</x-nav-link>
            <x-nav-link href="/reviews" :active="request()->is('reviews')">Reviews</x-nav-link>
            <x-nav-link href="/about" :active="request()->is('about')">About Us</x-nav-link>
        </div>
        <div class="border-t border-[#bf7029] pt-4 pb-3">
            <div class="flex items-center px-5">
                <div class="shrink-0">
                    <img class="size-10 rounded-full"
                        src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                        alt="">
                </div>
                <div class="ml-3">
                    <div class="text-base/5 font-medium text-white">Tom Cook</div>
                    <div class="text-sm font-medium text-[#bf7029]">tom@example.com</div>
                </div>
                <button type="button"
                    class="relative ml-auto shrink-0 rounded-full bg-[#5e3d13] p-1 text-[#bf7029] hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#bf7029] focus:outline-hidden">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                </button>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <a href="/profile"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#bf7029] hover:bg-[#885318] hover:text-white">Profile</a>
                <a href="/setting"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#bf7029] hover:bg-[#885318] hover:text-white">Settings</a>
                <a href="#" id="openOverlayLink"
                    class="block rounded-md px-3 py-2 text-base font-medium text-[#bf7029] hover:bg-[#885318] hover:text-white">Login</a>
            </div>
        </div>
    </div>

    {{-- overlay login --}}
    <div id="main-page-content">

        <!-- The Overlay -->
        <div id="authOverlay"
            class="overlay fixed top-0 left-0 w-full h-full bg-black/60 flex justify-center items-center z-[1000] hidden">
            <div
                class="modal-content bg-white rounded-2xl shadow-2xl w-[90%] max-w-[400px] p-6 relative animate-[fadeIn_0.3s_ease-out]">
                <!-- Close Button -->
                <button id="closeOverlayBtn"
                    class="close-button absolute top-4 right-4 bg-transparent border-none text-2xl cursor-pointer text-gray-500 transition-colors duration-200 ease-in-out hover:text-gray-700">
                    &times; <!-- Times symbol for close -->
                </button>

                <!-- Login Form -->
                <div id="loginForm" class="auth-form">
                    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Masuk</h2>
                    <form>
                        <!-- Added placeholder-gray-500 class -->
                        <input type="email" placeholder="Email"
                            class="input-field w-full py-3 px-4 border border-gray-300 rounded-lg mb-4 text-base transition-all duration-200 ease-in-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 placeholder-gray-500"
                            required>
                        <!-- Added placeholder-gray-500 class -->
                        <input type="password" placeholder="Kata Sandi"
                            class="input-field w-full py-3 px-4 border border-gray-300 rounded-lg mb-4 text-base transition-all duration-200 ease-in-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 placeholder-gray-500"
                            required>
                        <button type="submit"
                            class="btn btn-primary w-full py-3 px-4 rounded-lg text-base font-semibold cursor-pointer transition-all duration-200 ease-in-out bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md mb-4 flex items-center justify-center gap-2">Masuk</button>
                        <button type="button"
                            class="btn btn-google w-full py-3 px-4 rounded-lg text-base font-semibold cursor-pointer transition-all duration-200 ease-in-out bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 hover:shadow-md flex items-center justify-center gap-2">
                            <!-- Google Logo SVG -->
                            <svg class="w-5 h-5" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M533.5 272.3c0-18.7-1.5-36.8-4.7-54.3H272.1v102.4h147c-6.1 33.9-25.7 63.7-58.4 84.1l-0.6 0.6 84.1 65.2 0.6 0.6c51.5-47.4 81.5-117.4 81.5-200.2z"
                                    fill="#4285F4" />
                                <path
                                    d="M272.1 544.3c73.4 0 135.3-24.1 180.4-65.7l-84.1-65.2c-23.2 14.9-52.5 23.8-88.3 23.8-68.2 0-126.5-46.1-147.1-107.9l-1.3-0.6-83.8 64.7-0.6 1.3c43.6 86.4 128.6 147.2 229.8 147.2z"
                                    fill="#34A853" />
                                <path
                                    d="M125 321.3c-11.9-34.9-11.9-72.5 0-107.4l-1.3-0.6-83.5-64.4-0.6 1.3c-31.3 62.1-31.3 134.1 0 196.2l84.1 65.2z"
                                    fill="#FBBC05" />
                                <path
                                    d="M272.1 107.7c38.8 0 69.2 13.4 89.9 32.9l74.6-74.6c-44.4-41.6-102.3-67.7-164.5-67.7-101.2 0-186.2 60.8-229.8 147.2l84.1 65.2c20.6-61.8 78.9-107.9 147.1-107.9z"
                                    fill="#EA4335" />
                            </svg>
                            Masuk dengan Google
                        </button>
                    </form>
                    <p class="text-center text-sm text-gray-600 mt-4">
                        Belum punya akun? <span id="showRegister"
                            class="switch-link text-blue-500 cursor-pointer font-medium transition-colors duration-200 ease-in-out hover:text-blue-600 hover:underline">Daftar
                            sekarang</span>
                    </p>
                </div>

                <!-- Register Form (hidden by default) -->
                <div id="registerForm" class="auth-form hidden">
                    <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Daftar</h2>
                    <form>
                        <!-- Added placeholder-gray-500 class -->
                        <input type="email" placeholder="Email"
                            class="input-field w-full py-3 px-4 border border-gray-300 rounded-lg mb-4 text-base transition-all duration-200 ease-in-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 placeholder-gray-500"
                            required>
                        <!-- Added placeholder-gray-500 class -->
                        <input type="password" placeholder="Kata Sandi"
                            class="input-field w-full py-3 px-4 border border-gray-300 rounded-lg mb-4 text-base transition-all duration-200 ease-in-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 placeholder-gray-500"
                            required>
                        <!-- Added placeholder-gray-500 class -->
                        <input type="password" placeholder="Konfirmasi Kata Sandi"
                            class="input-field w-full py-3 px-4 border border-gray-300 rounded-lg mb-4 text-base transition-all duration-200 ease-in-out focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/25 placeholder-gray-500"
                            required>
                        <button type="submit"
                            class="btn btn-primary w-full py-3 px-4 rounded-lg text-base font-semibold cursor-pointer transition-all duration-200 ease-in-out bg-blue-500 text-white hover:bg-blue-600 hover:shadow-md flex items-center justify-center gap-2">Daftar</button>
                    </form>
                    <p class="text-center text-sm text-gray-600 mt-4">
                        Sudah punya akun? <span id="showLogin"
                            class="switch-link text-blue-500 cursor-pointer font-medium transition-colors duration-200 ease-in-out hover:text-blue-600 hover:underline">Masuk</span>
                    </p>
                </div>
            </div>
        </div>

        <script>
            // Get references to DOM elements
            const openOverlayLink = document.getElementById('openOverlayLink');
            const authOverlay = document.getElementById('authOverlay');
            const closeOverlayBtn = document.getElementById('closeOverlayBtn');
            const loginForm = document.getElementById('loginForm');
            const registerForm = document.getElementById('registerForm');
            const showRegisterLink = document.getElementById('showRegister');
            const showLoginLink = document.getElementById('showLogin');
            // Reference to html and body for overflow control
            const html = document.documentElement; // Refers to the <html> element
            const body = document.body; // Refers to the <body> element

            // Function to show the overlay
            function showOverlay() {
                authOverlay.classList.remove('hidden');
                html.classList.add('overflow-hidden'); // Prevent html scrolling
                body.classList.add('overflow-hidden'); // Prevent body scrolling
            }

            // Function to hide the overlay
            function hideOverlay() {
                authOverlay.classList.add('hidden');
                html.classList.remove('overflow-hidden'); // Allow html scrolling
                body.classList.remove('overflow-hidden'); // Allow body scrolling
            }

            // Function to switch to the register form
            function showRegisterForm() {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
            }

            // Function to switch to the login form
            function showLoginForm() {
                registerForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
            }

            // Event Listeners
            openOverlayLink.addEventListener('click', showOverlay);
            closeOverlayBtn.addEventListener('click', hideOverlay);
            showRegisterLink.addEventListener('click', showRegisterForm);
            showLoginLink.addEventListener('click', showLoginForm);

            // Close overlay when clicking outside the modal content
            authOverlay.addEventListener('click', (event) => {
                if (event.target === authOverlay) {
                    hideOverlay();
                }
            });
        </script>
    </div>
</nav>

<style>
    .fixed-navbar {
        position: fixed;
        top: 0;
        /* Sesuaikan dengan tinggi header Anda */
        left: 0;
        right: 0;
        z-index: 30;
    }

    .norican-regular {
        font-size: 2rem;
        font-family: "Norican", cursive;
        font-style: normal;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #main-page-content.overlay-active {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        /* Still needed to prevent scrolling */
    }
</style>
