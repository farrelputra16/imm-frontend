
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/imm.png" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IMM | Reset Kata Sandi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
    font-family: "Roboto", sans-serif;
}


/* Media query for responsiveness */

@media only screen and (max-width: 768px) {
    .brand-info,
    .footer-links,
    .social-media {
        flex-basis: 100%;
        /* Set width to 100% on small screens */
        text-align: center;
    }
    .footer {
        background-color: #5940cb;
        color: #ffffff;
        padding: 48px 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
        left: 0%;
        border-top-left-radius: 60px;
        border-top-right-radius: 60px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        z-index: 1000;
    }
    .social-media {
        margin-right: auto;
        position: absolute;
        top: 29px;
        right: 23px;
    }
    .social-media a {
        color: #ffffff;
        text-decoration: none;
        font-size: 20px;
        margin-left: 10px;
    }
    .footer-nav ul {
        list-style-type: none;
        padding: 0px;
        margin: 0;
        position: absolute;
        top: 30px;
        right: 86px;
    }
}

.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-form {
    width: 609px;
    padding: 10px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.login-form h2 {
    text-align: center;
    margin-bottom: 20px;
    right: -11px;
    position: relative;
}

table {
    width: 100%;
}

td {
    padding: 10px;
}

.input-icon {
    display: inline-block;
    width: 40px;
    text-align: center;
}

.input-icon i {
    font-size: 18px;
    line-height: 40px;
}

input[type="email"],
input[type="number"] {
    width: calc(100% - 40px);
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.btn-login {
    width:70%;
    border: none;
padding: 5px;
border-radius: 5px;
    background-color: #5940cb;
    color: #ffffff;
    font-size: 13px;
    cursor: pointer;

    /* Menambahkan efek transisi untuk perubahan background */
}
.btn-login:hover{
    background-color: #6b51e0;
}

.card-header{
    background-color: #6b51e0;
    color: white;
}

.notification {
    display: none;
    /* Sembunyikan notifikasi secara default */
    background-color: #f2f2f2;
    color: #333;
    padding: 15px;
    margin-top: 20px;
    border-radius: 5px;
}
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-form">
         
            <div class="card">
                <div class="card-header text-center font-weight-bold">{{ __('Lupa Kata Sandi') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email anda" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class=" btn-login">
                            {{ __('Kirim link reset sandi') }}
                        </button>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/imm/sendOtp.js') }}"></script>

</body>

</html>




