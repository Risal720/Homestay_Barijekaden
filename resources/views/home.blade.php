<x-layout>
      
    <x-slot:tittle>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h1>{{ $tittle }}</h1>
            <div>
                <button id="loginBtn" class=" rounded-md px-3 py-2 bg-[#5e3d13] p-1 text-[0.6em] text-[#bf7029] hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#bf7029] focus:outline-hidden">LOGIN</button>
            </div>
        </div>
    </x-slot:tittle>

    <div class="container" id="login-form">
        <h2>Login</h2>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email Anda">
            <div id="email-error" class="error-message"></div>
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
                <svg class="google-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                    <path fill="#4285F4" d="M45.23 24.25H24v9.46h12.19c-.83 5.65-4.76 9.8-10.8 9.8-6.62 0-12-5.43-12-12s5.38-12 12-12c3.17 0 5.97 1.25 8.05 3.22l5.97-5.73c-3.44-3.14-7.9-5-13.8-5-11.05 0-20 8.95-20 20s8.95 20 20 20c11.04 0 20-8.95 20-20z"/>
                    <path fill="#34A853" d="M24 48c13.255 0 24-10.745 24-24S37.255 0 24 0 0 10.745 0 24s10.745 24 24 24z"/>
                    <path fill="#FBBC05" d="M24 48c6.475 0 12-2.13 15.89-5.61l-6.1-5.24c-2.45 1.6-5.56 2.55-9.79 2.55-5.38 0-9.94-3.66-11.44-8.43h-14.7v5.24c3.18 5.9 9.95 9.84 17.63 9.84z"/>
                    <path fill="#EA4335" d="M24 0c-13.255 0-24 10.745-24 24s10.745 24 24 24c4.72 0 8.91-1.63 12.23-4.36l-6.53-5.63c-2.75 1.9-6.62 3.03-12.7 3.03-9.89 0-18-6.89-20.87-16.25H0v-5.24c3.91-7.13 11.92-12 20.87-12 5.8 0 10.98 2.27 14.73 5.97l-6.1 5.24c-3.6-2.45-8.22-3.89-14.63-3.89z"/>
                </svg>
                Login with Google
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

    <div>
        {{-- Konten lain di halaman home jika ada --}}
    </div>
     <script>
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const switchToRegisterLink = document.getElementById('switch-to-register');
        const switchToLoginLink = document.getElementById('switch-to-login');
        const loginButton = document.getElementById('login-button');
        const registerButton = document.getElementById('register-button');
        const googleLoginButton = document.getElementById('google-login-button');

        switchToRegisterLink.addEventListener('click', (event) => {
            event.preventDefault();
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
        });

        switchToLoginLink.addEventListener('click', (event) => {
            event.preventDefault();
            registerForm.style.display = 'none';
            loginForm.style.display = 'block';
        });

        loginButton.addEventListener('click', () => {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            let hasErrors = false;

            document.getElementById('email-error').textContent = '';
            document.getElementById('password-error').textContent = '';

            if (!email) {
                document.getElementById('email-error').textContent = 'Email harus diisi';
                hasErrors = true;
            }

            if (!password) {
                document.getElementById('password-error').textContent = 'Password harus diisi';
                hasErrors = true;
            }

            if (!hasErrors) {
                // Simulasi API login (ganti dengan fetch() yang sebenarnya)
                console.log('Melakukan login dengan:', email, password);
                alert(`Berhasil login dengan email: ${email}`);
            }
        });

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
                // Simulasi API register (ganti dengan fetch() yang sebenarnya)
                console.log('Melakukan registrasi dengan:', name, email, password);
                alert(`Berhasil mendaftar dengan nama: ${name} dan email: ${email}`);
            }
        });

        googleLoginButton.addEventListener('click', () => {
            // Kode untuk memulai proses login dengan Google
            console.log('Memulai proses login dengan Google');
            alert('Fitur Login dengan Google belum diimplementasikan. Harap gunakan tombol Login biasa.');
            // Anda akan menggunakan library seperti Google Sign-In for JavaScript untuk ini.
            // Lihat: https://developers.google.com/identity/sign-in/web
        });
    </script>
</x-layout>

 <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
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
            background-color: #5c3d2e; /* Brown color */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            text-align: center;
        }

        .form-group button:hover {
            background-color: #73513d; /* Darker brown */
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
            background-color: #4285f4; /* Google blue */
            color: #fff;
            border: none;
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
        }

        .google-login-button:hover {
            background-color: #357ae8;
        }

        .google-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
    </style>
