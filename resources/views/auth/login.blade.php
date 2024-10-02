@extends('layouts.app-2fa')
@section('title', 'Log In')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
<style>
    * {
        overflow: hidden;
    }

    body {
        font-family: "Roboto", sans-serif;
        background-color: #f5f5f5;
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
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    h2 {
        color: #5940cb;
        font-size: 30px;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    p {
        color: #6c6c6c;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 25px;
    }

    /* Login Form Styling */
    .login-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 494px;
        background-color: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .brand-logo {
        width: 100px; /* Memperbesar ikon lonceng */
        margin-right: 10px;
        transform: rotate(-15deg); /* Miringkan ke kiri */
    }

    .login-form h2 {
        font-size: 24px;
        color: #5940cb;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .login-form p {
        color: black;
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 25px;
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
        border: 1px solid #d1d1d1;
        border-radius: 5px;
        background-color: #ffffff;
        font-size: 14px;
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-login {
        padding: 12px 20px;
        background-color: #6c63ff;
        color: #fff;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
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
        color: #6c63ff;
        text-decoration: none;
        font-weight: bold;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    /* Responsive Styling */
    @media (max-width: 768px) {
        .login-form {
            width: 80%;
            padding: 20px;
        }

        .brand-logo {
            width: 60px; /* Sesuaikan ukuran untuk layar lebih kecil */
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
    }

    @media (max-width: 576px) {
        .login-form {
            width: 100%;
            padding: 10px;
        }

        .brand-logo {
            width: 50px;
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
</style>
@endsection


@section('content')

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center">
        <div class="container d-flex justify-content-center">
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="login-form text-center">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <img src="{{ asset('images/register/bell.png') }}" alt="Bell Icon" class="brand-logo">
                        <h2>Log in to your account</h2>
                    </div>
                    <p>Please enter your email and password to continue.</p>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                        <input id="email" type="email" placeholder="Input your Email" name="email" required />
                    </div>
                    <div class="input-group">
                        <label for="password">Password</label>
                        <span class="input-icon"><i class="fas fa-lock"></i></span>
                        <input id="password" type="password" placeholder='Input your Password' name="password" required />
                    </div>
                    <div class="register-link">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Password? Recovery Password') }}
                        </a>
                    </div>
                    <button class="btn-login" type="submit">Log in</button>
                    <div class="register-link">Don't have an account? <a href="{{ route('register') }}">Sign Up</a></div>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
