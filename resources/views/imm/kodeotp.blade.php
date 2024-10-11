<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | OTP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/imm3.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="container min-vh-100 d-flex flex-column justify-content-center">
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-body">
                <h5 class="card-title text-center">Masukkan Kode Verifikasi Anda</h5>
                <p class="card-text text-center text-muted">
                    Masukkan kode verifikasi yang dikirim ke email Anda.
                </p>
                <form id="otp-form">
                    @csrf
                    <div class="form-group d-flex justify-content-between">
                        @for ($i = 0; $i < 6; $i++)
                            <input type="text" class="form-control text-center" name="otp_code[]" maxlength="1"
                                style="width: 50px;">
                        @endfor
                    </div>
                    <div id="error-message" class="text-danger text-center"></div>
                    <p class="text-center text-muted">Belum menerima kode? tunggu <span id="seconds-remaining">60</span> detik</p>
                    <div class="text-center mb-3">
                        <button type="button" id="resend-otp" class="bg-transparent border-0 btn-link">Kirim ulang kode</button>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Verifikasi</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/imm/verificationOtp.js') }}"></script>

</body>

</html>
