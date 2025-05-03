<x-layout>
    <x-slot:tittle>{{ $tittle }}</x-slot:tittle>
    <section class="flex justify-center items-start h-screen bg-gray-100">
        <div class="w-72 p-5 bg-white rounded-md shadow-md">
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
    </section>
    <div>
        {{-- Konten lain di halaman home jika ada --}}
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1>Home Page</h1>
        <div>
            <button id="loginBtn" style="margin-left: 10px;">LOGIN</button>
            <span style="margin: 0 5px;">|</span>
            <button id="registerBtn" style="margin-left: 5px;">REGISTER</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginButton = document.getElementById('loginBtn');
            const registerButton = document.getElementById('registerBtn');
    
            loginButton.addEventListener('click', function() {
                window.location.href = '/login';
            });
    
            registerButton.addEventListener('click', function() {
                window.location.href = '/register';
            });
        });
    </script>

</x-layout>

