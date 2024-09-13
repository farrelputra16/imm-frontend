@extends('layouts.app-navbar')
@section('title', 'Event Detail')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap');
@import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap");
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    list-style-type: none;
    font-family: "Quicksand", sans-serif;
    overflow-x: none;
}

body {
    background-color: white;
}

.btn {
    width: 155px;
    height: 44px;
    background-color: transparent;
    border: 2px solid #ffc107;
    border-radius: 10px;
    font-size: 20px;
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    color: #ffc107;
}

.btn-simpan {
    width: 232px;
    height: 58px;
    border-radius: 10px;
    border: none;
    color: white;
    background-color: #5940cb;
}

.btn-daftar {
    width: 356px;
    height: 44px;
    background-color: #ffc107;
    border-radius: 10px;
    font-size: 24px;
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    color: #302400;
}

.banner {
    width: 100%;
    height: 610px;
}

.banner-img {
    background-size: cover;
    width: 100%;
    height: 610px;
}

.content {
    margin-top: 170px;
    gap: 40px;
}

.nama-kegiatan {
    font-size: 28px;
    font-weight: 500;
    max-width: 217px;
    text-align: center;
}

footer {
    width: 100%;
    height: 481px;
    background-color: #5271ff;
    margin-top: 170px;
}

.row-footer {
    margin-right: 5%;
    margin-left: 5%;
    height: 481px;
}

.row-footer-in {
    width: 1220px;
    height: 255px;
}

.span-footer {
    font-size: 15px;
    font-weight: bold;
    color: #fff;
}

.sosmed {
    gap: 10px;
}

.sosmed a {
    color: #fff;
    gap: 30px;
    margin: 0 10px;
}

.col-footer {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.col {
    display: flex;
    align-items: center;
    justify-content: center;
}

.col-text2 {
    display: flex;
    justify-content: start;
}

.img-event {
    width: 100%;
    height: auto;
    border-radius: 8px;
}

.btn-daftar {
    background-color: #ffc107;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 18px;
    font-weight: bold;
    margin-top: 20px;
    border-radius: 8px;
}

.form-control {
    width: 494px;
    height: 53px;
    background-color: #e4e4e4;
}

.hidden-input {
    display: none;
}

.btn-daftar:hover {
    background-color: #e0a800;
}

.img-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 25px;
}

@media (max-width: 768px) {
    .img-grid {
        grid-template-columns: 1fr;
    }
}


/* Efek loading */


/* Animasi umum untuk elemen lainnya */
    
</style>
@endsection
@section('content')


<body>


    <section class="banner" style=""> <img class="banner-img" src="{{ env('APP_BACKEND_URL') . '/images/' . $event->hero_img }}"
            class="w-100 h-auto" alt=""></section>
    <div class="container content">
        <div class="container">
            <div class="row d-flex flex-column align-items-center justify-content-center text-center">
                <p class="" style="max-width: 701px; font-size:32px">{{ $event->description }}</p>
                @if (in_array(Auth::id(), $eventUsers))
                    <a href="/event-register/{{ $event->id }}"><button class="btn-daftar mt-4" disabled>Anda Telah
                            Terdaftar</button></a>
                @else
                    <a href="/event-register/{{ $event->id }}"><button class="btn-daftar mt-4">Daftar
                            Sekarang</button></a>
                @endif
            </div>
        </div>

    </div>
    <div class="container content d-flex flex-column justify-content-center">
        <p class="text-center" style="font-size:32px; font-weight:bold">Kegiatan Bootcamp</p>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('images/icon-workshop.png') }}" alt="">
                <span class="nama-kegiatan">Workshop dan Pelatihan</span>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('images/icon-diskusi.png') }}" alt="">
                <span class="nama-kegiatan">Panel
                    Diskusi</span>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('images/icon-mentor.png') }}" alt="">
                <span class="nama-kegiatan">Mentorship Session</span>
            </div>
        </div>
        <div class="row mt-4 d-flex justify-content-center align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('images/icon-networking.png') }}" alt="">
                <span class="nama-kegiatan">Networking Lunch</span>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('images/icon-pitching.png') }}" alt="">
                <span class="nama-kegiatan">Pitching Session</span>
            </div>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="col-md-6">
                <p style="font-size:40px">Bergabunglah dalam Bootcamp yang <strong>Akan Mengubah Bisnis Anda</strong>
                </p>
                @if (in_array(Auth::id(), $eventUsers))
                    <a href="/event-register/{{ $event->id }}"><button class="btn-daftar mt-4" disabled>Anda Telah
                            Terdaftar</button></a>
                @else
                    <a href="/event-register/{{ $event->id }}"><button class="btn-daftar mt-4">Daftar
                            Sekarang</button></a>
                @endif
            </div>
            <div class="col-md-6">
                <div class="img-grid">
                    <img src="{{ asset('images/img1-event.png') }}" class="img-event" alt="Event Image 1">
                    <img src="{{ asset('images/img2-event.png') }}" class="img-event" alt="Event Image 2">
                    <img src="{{ asset('images/img3-event.png') }}" class="img-event" alt="Event Image 3">
                    <img src="{{ asset('images/img4-event.png') }}" class="img-event" alt="Event Image 4">
                </div>
            </div>
        </div>
    </div>


</body>


@endsection
