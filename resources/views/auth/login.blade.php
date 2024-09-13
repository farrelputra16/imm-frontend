@extends('layouts.app-2fa')
@section('title', 'Masuk')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<style>
    *{
        overflow: hidden;
    }
    body {
    font-family: "Roboto", sans-serif;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container-fluid {
    margin: 0;
    padding: 0;
    display: flex;
    height: 100vh;
}

.col-6 {
    padding: 0;
}


/* Navbar */

.navbar {
    background-color: #ffffff;
    color: #000000;
    padding: 15px 0;
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1000;
    border-bottom: 3px solid #4834a9;
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar-logo {
    font-size: 24px;
    margin-left: 60px;
}

.navbar-links {
    list-style-type: none;
    display: flex;
    margin-left: -580px;
}

.navbar-links li {
    margin-right: 20px;
}

.navbar-links li:last-child {
    margin-right: 0;
}

.navbar-links a {
    color: inherit;
    text-decoration: none;
}

.navbar-links a:hover {
    text-decoration: underline;
}

.navbar-actions {
    display: flex;
    margin-right: 20px;
}

.btn {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 12px;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn-primary {
    background-color: #ffffff;
    color: #0e0d13;
    border: 2px solid #5940cb;
}

.btn-outline-primary {
    background-color: #5940cb;
    color: #ffffff;
    border: 2px solid #5940cb8a;
    margin-left: 10px;
}

.btn-primary:hover,
.btn-outline-primary:hover {
    background-color: #5940cb8a;
}

.navbar-collapse {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.navbar-nav {
    margin-left: 52px;
}

.navbar-brand {
    margin-right: auto;
}

.login-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 494px;
}

.brand-logo {
    width: 100px;
    display: flex;
    justify-content: start;
    align-items: start;
}

.login-form h2 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #000000;
    font-weight: bold;
}

.input-group {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 15px;
    width: 100%;
    position: relative;
}

.input-group label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #000000;
}

.input-icon {
    position: absolute;
    right: 10px;
    top: 36px;
    color: #000000;
}

.input-group input {
    width: 100%;
    padding: 12px 40px 12px 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f8f9fa;
    font-size: 14px;
}

.btn-login {
    padding: 10px 20px;
    background-color: #6c63ff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    margin-top: 20px;
}

.btn-login:hover {
    background-color: #524eff;
}

.register-link {
    margin-top: 15px;
    font-size: 14px;
    color: #000000;
}

.register-link a {
    color: #000000;
    text-decoration: none;
    font-weight: bold;
}

.register-link a:hover {
    text-decoration: underline;
}


/* Media query for responsiveness */

@media (max-width: 768px) {
    .container-fluid {
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .col-6 {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .login-form {
        width: 163%;
        padding: 20px;
        position: absolute;
        top: 165px;
        right: -61px;
    }
    .register-link {
        text-align: center;
    }
    .col-6 img {
        display: none;
    }
    .brand-logo {
        width: 80px;
    }
    .login-form h2 {
        font-size: 20px;
    }
    .input-group input {
        padding: 10px 35px 10px 10px;
        font-size: 14px;
    }
    .input-icon {
        top: 28px;
    }
    .btn-login {
        padding: 10px;
        font-size: 14px;
    }
    .register-link {
        font-size: 12px;
    }
    .image-container img {
        position: static;
        width: 110%;
        height: 98px;
    }
}

@media (max-width: 576px) {
    .login-form {
        width: 164%;
        padding: 10px;
    }
    .brand-logo {
        width: 70px;
    }
    .login-form h2 {
        font-size: 18px;
    }
    .input-group input {
        padding: 8px 30px 8px 8px;
        font-size: 12px;
    }
    .input-icon {
        top: 24px;
    }
    .btn-login {
        padding: 8px;
        font-size: 12px;
    }
    .register-link {
        font-size: 10px;
    }
}


/* Efek loading */


/* Menambahkan transisi pada navbar */

.navbar {
    transition: background-color 0.3s ease;
}

.navbar:hover {
    background-color: #e3e3e3;
}


/* Efek loading */

#loading {
    position: fixed;
    width: 100%;
    height: 100%;
    background: #fff;
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
    top: 5px;
}

#loading img {
    width: 100px;
    height: 100px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    100% {
        transform: rotate(360deg);
    }
}
    </style>
@endsection



@section('content')

<body>
    <div class="container-fluid d-flex justify-content-between" style="height: 100vh">
        <div class="col-6 w-100 d-flex justify-content-center align-items-center">
            <div class="container d-flex justify-content-center ">
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf
                    <div class="login-form">
                        <img src="{{ asset('images/imm.png') }}" alt="Brand Logo" class="brand-logo">
                        <h2>Masuk ke akun anda</h2>
                        <div class="input-group">
                            <label for="email">Email</label>
                            <span class="input-icon"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email" placeholder="Masukkan email anda" name="email" required />
                        </div>
                        <div class="input-group">
                            <label for="password">Password</label>
                            <span class="input-icon"><i class="fas fa-lock"></i></span>
                            <input id="password" type="password" placeholder='Masukkan password anda' name="password" required />
                        </div>

                        <button class="btn-login" type="submit" id="masukBtn">Masuk</button>
                        @if (Route::has('password.request'))
                            <div class="register-link">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Lupa Password Anda?') }}
                                </a>
                            </div>
                        @endif
                        <div class="register-link">Belum punya akun? <a href="register">Daftar</a></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <img src="{{ asset('images/6.png') }}" style="height: 100vh" alt="Your Image" />
        </div>
    </div>

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Check for session messages and display SweetAlert2 popups
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Email atau Password Salah',
                text: '{{ session('error') }}',
            });
        @endif

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
</body>

@endsection
