@extends('layouts.app-2fa')
@section('title', 'Daftar')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: "Roboto", sans-serif;
        }


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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


        .register-container {
            background-color: #fff;
            padding: 20px;
            width: 727px;
            margin: 0 auto;
            margin-top: 80px;
        }

        .register-container {
            background-color: #fff;

            width: 727px;
            margin: 0 auto;
            margin-top: 50px
        }

        .register-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .register-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .brand-logo {
            width: 137px;
            margin-bottom: 20px;
        }

        .brand-logo {
            width: 137px;

        }

        .register-form h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #000000;
            font-weight: bold;
        }

        .register-form h2 {

            font-size: 26px;
            color: #000000;
            font-weight: bold;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-bottom: 15px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            width: 100%;

        }

        .form-group {
            display: flex;
            flex-direction: column;
            width: 48%;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            width: 48%;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 2px;
            color: #000000;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 2px;
            color: #000000;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f9fa;
            font-size: 16px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f8f9fa;
            font-size: 16px;
        }

        .btn-register {
            padding: 10px 20px;
            background-color: #5940cb;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-register {
            padding: 10px 20px;
            background-color: #5940cb;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-register:hover {
            background-color: #524eff;
            transform: scale(1.05);
        }

        .btn-register:hover {
            background-color: #524eff;
            transform: scale(1.05);
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
            color: #000000;
        }

        .login-link {
            margin-top: 15px;
            font-size: 14px;
            color: #000000;
        }

        .login-link a {
            color: #000000;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a {
            color: #000000;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Media query for responsiveness */
        @media (max-width: 768px) {
            .navbar {
                position: relative;
            }

            /* Media query for responsiveness */
            @media (max-width: 768px) {

                body {
                    padding-top: 20px;
                }

                .navbar {
                    position: relative;
                }

                .navbar-links {
                    flex-direction: column;
                    margin-left: 0;
                    margin-top: 10px;
                }

                .navbar-links {
                    flex-direction: column;
                    margin-left: 0;
                    margin-top: 10px;
                }

                .navbar-links li {
                    margin: 10px 0;
                }

                .navbar-links li {
                    margin: 10px 0;
                }

                .navbar-actions {
                    flex-direction: column;
                    margin-right: 0;
                    margin-top: 10px;
                }

                .navbar-actions {
                    flex-direction: column;
                    margin-right: 0;
                    margin-top: 10px;
                }

                .btn {
                    width: 100%;
                    text-align: center;
                    margin: 5px 0;
                }

                .btn {
                    width: 100%;
                    text-align: center;
                    margin: 5px 0;
                }

                .register-container {
                    width: 100%;
                    padding: 10px;
                    top: auto;
                    right: auto;
                    margin-top: 70px;
                }

                .register-container {

                    width: 100%;
                    padding: 10px;


                }

                .brand-logo {
                    width: 100px;
                    position: relative;
                    top: 0;
                    right: 0;
                    margin-top: 20px;
                }

                .brand-logo {
                    width: 100px;
                    position: relative;
                    top: 0;
                    right: 0;

                }

                .register-form h2 {
                    font-size: 22px;
                    position: relative;
                    top: 0;
                    right: 0;
                    text-align: center;
                }

                .register-form h2 {
                    font-size: 22px;
                    position: relative;
                    top: 0;
                    right: 0;
                    text-align: center;
                }

                .form-row {
                    flex-direction: column;
                    width: 100%;
                }

                .form-row {
                    flex-direction: column;
                    width: 100%;
                }

                .form-group {
                    width: 100%;
                    margin-bottom: 10px;
                }

                .form-group {
                    width: 100%;

                }

                .form-group label {
                    font-size: 14px;
                }

                .form-group label {
                    font-size: 14px;
                }

                .form-group input,
                .form-group select {
                    font-size: 14px;
                    padding: 10px;
                }

                .form-group input,
                .form-group select {
                    font-size: 14px;
                    padding: 10px;
                }

                .btn-register {
                    font-size: 14px;
                    padding: 10px;
                }

                .btn-register {
                    font-size: 14px;
                    padding: 10px;
                }

                .login-link {
                    font-size: 12px;
                    text-align: center;
                }
            }

            .login-link {
                font-size: 12px;
                text-align: center;
            }
        }

    </style>
@endsection

@section('content')
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container">
        <div class="register-container">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <div class="register-form">
                    <img src="images/imm.png" alt="Brand Logo" class="brand-logo">
                    <h2>Daftarkan akun</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="fullName">Nama Lengkap</label>
                            <input type="text" id="fullName" name="nama" placeholder="Masukkan nama lengkap anda" required />
                        </div>
                        <div class="form-group">
                            <label for="negara">Negara</label>
                            <input type="text" id="negara" name="negara" placeholder="Masukkan negara anda" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" id="nik" name="nik" placeholder="Masukkan NIK anda" required minlength="16" maxlength="16" />
                                <div id="error-message" class="error"></div>
                        </div>
                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" id="provinsi" name="provinsi" placeholder="Masukkan provinsi anda" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukkan email anda" required />
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat Lengkap</label>
                            <input type="text" id="address" name="alamat" placeholder="Masukkan alamat lengkap anda" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi anda" required minlength="8" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Nomor Telepon</label>
                            <input type="number" id="telepon" name="telepon" placeholder="Masukkan nomor telepon anda" required />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="confirmPassword">Konfirmasi Kata Sandi</label>
                            <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Konfirmasi kata sandi anda" required />
                        </div>
                    </div>
                    <button class="btn-register" type="submit" id="simpanBtn">Simpan Data</button>
                    <div class="login-link">Sudah punya akun? <a href="login">Masuk</a></div>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  

    <script>
        // Function to validate form and show SweetAlert2 popups
        function validateForm(event) {
            event.preventDefault(); // Prevent form submission initially

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const nik = document.getElementById('nik').value;

            if (password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password minimal 8 karakter.',
                });
                return;
            }

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password dan konfirmasi password tidak sama.',
                });
                return;
            }

            if (nik.length !== 16) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'NIK harus 16 digit.',
                });
                return;
            }

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Pastikan NIK dan Email benar karena tidak bisa di edit nantinya.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('registerForm').submit();
                    return false;
                }
            });
        }
        document.getElementById('nik').addEventListener('input', function (event) {
            // Hanya memperbolehkan angka 0-9
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        document.getElementById('telepon').addEventListener('input', function (event) {
            // Hanya memperbolehkan angka 0-9
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        document.getElementById('telepon').addEventListener('keypress', function (event) {
            // Mencegah masukan selain angka
            if (!/\d/.test(event.key)) {
                event.preventDefault();
            }
        });
        document.getElementById('nik').addEventListener('keypress', function (event) {
            // Mencegah masukan selain angka
            if (!/\d/.test(event.key)) {
                event.preventDefault();
            }
        });

        document.getElementById('nik').addEventListener('blur', function (event) {
            // Validasi panjang input saat kehilangan fokus
            const errorMessage = document.getElementById('error-message');
            if (this.value.length !== 16) {
                errorMessage.textContent = 'NIK harus terdiri dari 16 digit angka.';
            } else {
                errorMessage.textContent = '';
            }
        });

        document.getElementById('registerForm').addEventListener('submit', validateForm);

        // Handle server-side validation errors
        @if ($errors->any())
            let errorMessage = '';
            @foreach ($errors->all() as $error)
                errorMessage += '{{ $error }}\n';
            @endforeach
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: errorMessage,
            });
        @endif

    </script>
</body>

</html>
@endsection