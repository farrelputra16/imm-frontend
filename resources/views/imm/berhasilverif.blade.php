@extends('layouts.app-2fa')
@section('title', 'Berhasil Verifikasi')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/imm/berhasilverif.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
@endsection
@section('content')

<body>

<div class="container text-center mt-5">
    <h1>Selamat! Berhasil Verifikasi Akun</h1>
    <div class="icon">
        <i class="fas fa-check-circle"></i>
    </div>
    <p>Anda akan dialihkan ke halaman selanjutnya dalam <span id="countdown">5</span> detik</p>
    <a href="#" class="link">Klik disini jika bermasalah</a>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Fungsi untuk countdown dan redirect
    function startCountdown(seconds, url) {
        var countdownElement = document.getElementById('countdown');
        var interval = setInterval(function() {
            seconds--;
            countdownElement.textContent = seconds;
            if (seconds <= 0) {
                clearInterval(interval);
                window.location.href = url;
            }
        }, 1000);
    }

    // Mulai countdown dari 5 detik dan redirect ke halaman berikutnya
    document.addEventListener("DOMContentLoaded", function() {
        startCountdown(5, "pendaftaranperusahaan"); // Ganti "next-page-url" dengan URL halaman berikutnya
    });
</script>
</body>@endsection

