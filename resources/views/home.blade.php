<x-layout>
    <x-slot:tittle>{{ $tittle }}
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login Page</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <style>
                .login-box {
                    width: 300px;
                    padding: 20px;
                    background: #f8f9fa;
                    border-radius: 5px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
            </style>
        </head>
    
        <body class="d-flex justify-content-center align-items-center vh-100">
            <div class="login-box">
                <h2 class="text-center">Login</h2>
                <form action="/login" method="post">
                    @csrf
                    <div class="form-floating">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                        <label for="email">Email:</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="password" required>
                        <label for="password">Password:</label>
                    </div>
                    <div class="text-center">
                        <a href="#">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            
        </body>
    
    </x-slot:tittle>

</x-layout> 
