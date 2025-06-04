<x-layout>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Halaman Login/Register</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Inter', sans-serif;
                /* Using Inter font */
                margin: 0;
                padding: 0;
                color: #333;
                display: flex;
                flex-direction: column;
                /* Set flex direction to column */
                align-items: center;
                /* Center horizontally */
                min-height: 100vh;
                position: relative;
                /* Needed for z-index of background */
                overflow: hidden;
                /* Prevent scrollbars from background */
            }

            /* Custom message box style */
            #messageBox {
                position: fixed;
                top: 1rem;
                /* Distance from top */
                left: 50%;
                transform: translateX(-50%);
                background-color: #4CAF50;
                /* Default green for success */
                color: white;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                opacity: 0;
                transition: opacity 0.3s ease-in-out;
                display: none;
                /* Hidden by default */
                text-align: center;
            }

            /* Background slideshow container */
            .background-slideshow {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                /* Place behind other content */
                background-size: cover;
                background-position: center;
                background-repeat: no-repeat;
                animation: slideshow 30s infinite;
                /* 3 images * 10 seconds = 30s cycle */
                transition: background-image 1s ease-in-out;
                /* Smooth transition for image change */
            }

            /* Keyframes for the background slideshow animation */
            @keyframes slideshow {
                0% {
                    background-image: url('image/orang.png');
                    opacity: 1;
                }

                /* Image 1 */
                10% {
                    opacity: 1;
                }

                /* Hold image 1 */
                23% {
                    opacity: 0;
                }

                /* Fade out image 1 */
                25% {
                    background-image: url('image/room.png');
                    opacity: 0;
                }

                /* Switch to image 2 */
                33% {
                    opacity: 1;
                }

                /* Fade in image 2 */
                43% {
                    opacity: 1;
                }

                /* Hold image 2 */
                56% {
                    opacity: 0;
                }

                /* Fade out image 2 */
                58% {
                    background-image: url('image/view.png');
                    opacity: 0;
                }

                /* Switch to image 3 */
                66% {
                    opacity: 1;
                }

                /* Fade in image 3 */
                76% {
                    opacity: 1;
                }

                /* Hold image 3 */
                89% {
                    opacity: 0;
                }

                /* Fade out image 3 */
                91% {
                    background-image: url('image/view2.png');
                    opacity: 0;
                }

                /* Switch back to image 1 */
                100% {
                    opacity: 1;
                }

                /* Fade in image 1 for next cycle */
            }


            .container {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                width: 300px;
                margin-top: 20vh;
                /* Changed from 10vh to 20vh to move it down */
                margin-bottom: auto;
                /* Ensure container stays centered if other content below */
                position: relative;
                /* Ensure it's above the background */
                z-index: 1;
                /* Place above the background slideshow */
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
            }

            .form-group input {
                width: 100%;
                padding: 8px 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .form-group button {
                width: 100%;
                padding: 10px;
                background-color: #5c3d2e;
                /* Brown color */
                color: #fff;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                display: block;
                text-align: center;
            }

            .form-group button:hover {
                background-color: #73513d;
                /* Darker brown */
            }

            .form-group .error-message {
                color: red;
                font-size: 0.9em;
                margin-top: 5px;
            }

            .switch-form {
                text-align: center;
                margin-top: 15px;
                font-size: 0.9em;
            }

            .switch-form a {
                color: #5c3d2e;
                text-decoration: none;
            }

            .switch-form a:hover {
                text-decoration: underline;
            }

            .google-login-button {
                background-color: #fff;
                /* White background for Google button */
                color: #757575;
                /* Gray text color for Google */
                border: 1px solid #dadada;
                /* Light gray border */
                padding: 10px;
                border-radius: 4px;
                cursor: pointer;
                display: block;
                width: 100%;
                text-align: center;
                margin-top: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                /* Soft shadow */
            }

            .google-login-button:hover {
                background-color: #f7f7f7;
                /* Slightly darker on hover */
            }

            .google-icon {
                width: 20px;
                height: 20px;
                margin-right: 10px;
                /* Space between icon and text */
            }
        </style>
    </head>

    <body>
        <div class="background-slideshow"></div>

        <div id="messageBox"
            class="fixed top-4 left-1/2 -translate-x-1/2 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transition-all duration-300 ease-in-out opacity-0"
            style="display: none;">
        </div>

        <main class="flex-grow flex flex-col items-center justify-center p-4">
            <div class="container" id="login-form">
                <h2>Login</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username Anda">
                    <div id="username-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password Anda">
                    <div id="password-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <button id="login-button">Login</button>
                </div>
                <div class="form-group">
                    <button class="google-login-button" id="google-login-button">
                        <svg class="google-icon" viewBox="0 0 24 24">
                            <path fill="#4285F4"
                                d="M22.75 12.25c0-.8-.06-1.55-.18-2.25H12v4.25h6.25c-.25 1.5-1.1 2.75-2.5 3.5v2.75h3.5c2.05-1.9 3.25-4.7 3.25-8.25z" />
                            <path fill="#34A853"
                                d="M12 23.5c3.25 0 6.05-1.05 8.05-3.22l-3.5-2.75c-1.05.7-2.45 1.12-4.55 1.12-3.55 0-6.55-2.4-7.65-5.62H.85v2.88c2.15 4.25 6.4 7.25 11.15 7.25z" />
                            <path fill="#FBBC05"
                                d="M4.35 14.25c-.25-.7-.38-1.45-.38-2.25s.13-1.55.38-2.25V7.05H.85C.3 8.15 0 9.65 0 12s.3 3.85.85 4.95l3.5-2.7z" />
                            <path fill="#EA4335"
                                d="M12 4.75c1.8 0 3.4.65 4.65 1.85l3.15-3.15C17.95 1.45 15.25 0 12 0 7.25 0 3 2.75.85 7.05l3.5 2.7c1.1-3.25 4.1-5.55 7.65-5.55z" />
                        </svg>
                        <span>Login with Google</span>
                    </button>
                </div>
                <div class="switch-form">
                    <a href="#" id="switch-to-register">Belum punya akun? Daftar di sini</a>
                </div>
            </div>

            <div class="container" id="register-form" style="display: none;">
                <h2>Register</h2>
                <div class="form-group">
                    <label for="register-name">Nama</label>
                    <input type="text" id="register-name" name="name" placeholder="Masukkan nama Anda">
                    <div id="register-name-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="email" id="register-email" name="email" placeholder="Masukkan email Anda">
                    <div id="register-email-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" name="password" placeholder="Masukkan password Anda">
                    <div id="register-password-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <button id="register-button">Register</button>
                </div>
                <div class="switch-form">
                    <a href="#" id="switch-to-login">Sudah punya akun? Login di sini</a>
                </div>
            </div>
        </main>

        <script>
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const switchToRegisterLink = document.getElementById('switch-to-register');
            const switchToLoginLink = document.getElementById('switch-to-login');
            const loginButton = document.getElementById('login-button');
            const registerButton = document.getElementById('register-button');
            const googleLoginButton = document.getElementById('google-login-button');

            // Function to display custom messages
            function showMessage(message, type = 'success') {
                const messageBox = document.getElementById('messageBox');
                messageBox.textContent = message;
                messageBox.classList.remove('bg-green-500', 'bg-red-500'); // Remove previous color classes
                if (type === 'success') {
                    messageBox.classList.add('bg-green-500');
                } else if (type === 'error') {
                    messageBox.classList.add('bg-red-500');
                }
                messageBox.style.display = 'block'; // Show element
                setTimeout(() => {
                    messageBox.classList.remove('opacity-0');
                    messageBox.classList.add('opacity-100');
                }, 10); // Small delay for transition

                setTimeout(() => {
                    messageBox.classList.remove('opacity-100');
                    messageBox.classList.add('opacity-0');
                    setTimeout(() => {
                        messageBox.style.display = 'none'; // Hide after transition completes
                    }, 300); // Match CSS transition duration
                }, 3000); // Message will disappear after 3 seconds
            }

            // Event listener to switch to register form
            switchToRegisterLink.addEventListener('click', (event) => {
                event.preventDefault();
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            });

            // Event listener to switch to login form
            switchToLoginLink.addEventListener('click', (event) => {
                event.preventDefault();
                registerForm.style.display = 'none';
                loginForm.style.display = 'block';
            });

            // Event listener for login button click
            loginButton.addEventListener('click', () => {
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                let hasErrors = false;

                document.getElementById('username-error').textContent = '';
                document.getElementById('password-error').textContent = '';

                if (!username) {
                    document.getElementById('username-error').textContent = 'Username harus diisi';
                    hasErrors = true;
                }

                if (!password) {
                    document.getElementById('password-error').textContent = 'Password harus diisi';
                    hasErrors = true;
                }

                if (!hasErrors) {
                    // Simulate API login (replace with actual fetch() call)
                    console.log('Melakukan login dengan:', username, password);
                    showMessage(`Berhasil login dengan username: ${username}`, 'success');
                } else {
                    showMessage('Login gagal. Harap periksa input Anda.', 'error');
                }
            });

            // Event listener for register button click
            registerButton.addEventListener('click', () => {
                const name = document.getElementById('register-name').value;
                const email = document.getElementById('register-email').value;
                const password = document.getElementById('register-password').value;
                let hasErrors = false;

                document.getElementById('register-name-error').textContent = '';
                document.getElementById('register-email-error').textContent = '';
                document.getElementById('register-password-error').textContent = '';

                if (!name) {
                    document.getElementById('register-name-error').textContent = 'Nama harus diisi';
                    hasErrors = true;
                }
                if (!email) {
                    document.getElementById('register-email-error').textContent = 'Email harus diisi';
                    hasErrors = true;
                }
                if (!password) {
                    document.getElementById('register-password-error').textContent = 'Password harus diisi';
                    hasErrors = true;
                }

                if (!hasErrors) {
                    // Simulate API register (replace with actual fetch() call)
                    console.log('Melakukan registrasi dengan:', name, email, password);
                    showMessage(`Berhasil mendaftar dengan nama: ${name} dan email: ${email}`, 'success');
                } else {
                    showMessage('Registrasi gagal. Harap periksa input Anda.', 'error');
                }
            });

            // Event listener for Google login button click
            googleLoginButton.addEventListener('click', () => {
                console.log('Memulai proses login dengan Google');
                showMessage('Fitur Login dengan Google belum diimplementasikan. Harap gunakan tombol Login biasa.',
                    'error');
            });
        </script>
    </body>
</x-layout>
