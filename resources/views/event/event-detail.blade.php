@extends('layouts.app-landingpage')
@section('title', 'Event Detail')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        list-style-type: none;
        font-family: "Quicksand", sans-serif;
    }

    body {
        background-color: white;
    }

    .banner {
        width: 100%; /* Menggunakan 100vw untuk memenuhi lebar viewport */
        height: 400px;
        overflow: hidden; /* Menyembunyikan bagian gambar yang melampaui */
        position: relative; /* Menambahkan posisi relatif untuk elemen anak */
    }

    .banner-img {
        width: 100%; /* Memastikan gambar memenuhi lebar banner */
        height: 100%; /* Memastikan gambar memenuhi tinggi banner */
        object-fit: cover; /* Memastikan gambar terpotong dengan baik */
    }

    .banner-text {
        position: absolute; /* Mengatur posisi absolut untuk menimpa gambar */
        top: 50%; /* Menempatkan teks di tengah vertikal */
        right: 10px; /* Menempatkan teks sedikit dari kanan */
        transform: translateY(-50%); /* Mengatur posisi vertikal agar tepat di tengah */
        color: black; /* Warna teks */
        font-size: 24px; /* Ukuran font */
    }
    .btn{
        background-color: #C1E2A4;
        border : none;
    }
    .header {
        text-align: center;
        margin-top: 20px;
    }

    .header h1 {
        color: #6a0dad;
        font-weight: bold;
    }

    .activities {
        text-align: center;
        margin-top: 40px;
    }

    .activities .icon {
        font-size: 50px;
        margin-bottom: 10px;
    }

    .activities .description {
        font-weight: bold;
    }

    .activities .sub-description {
        color: #555;
    }

    .call-to-action {
        text-align: center;
        margin-top: 40px;
        font-weight: bold;
        font-size: 24px;
    }

    .content {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 40px;
    }

    .text-section {
        flex: 1;
        min-width: 300px;
        text-align: center;
    }

    .image-section {
        flex: 1;
        min-width: 300px;
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .image-section img {
        margin: 5px;
    }

    @media (max-width: 768px) {
        .img-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<body>
    <section class="banner">
        <img class="banner-img" src="{{ env('APP_BACKEND_URL') . '/images/' . $event->hero_img }}" alt="Banner Image">
        <div class="banner-text">
            {{ $event->topic }} <!-- Menampilkan topik dari event -->
        </div>
    </section>

    <div class="d-flex justify-content-center">
        @if (in_array(Auth::id(), $eventUsers))
            <button class="btn btn-success mt-4" style="color:#5A5A5A" disabled>Has Been Registered</button>
        @else
            <a href="/event-register/{{ $event->id }}">
                <button class="btn btn-primary mt-4" style="color:#212B36">Daftar Sekarang</button>
            </a>
        @endif
    </div>

    <div class="header">
        <h1>Sustainable Development Activities</h1>
    </div>

    <div class="activities container">
 <div class="row">
            <div class="col">
                <div class="icon text-success">
                    <i class="fas fa-tree"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub-description">Tree Planting and Reforestation</div>
            </div>
            <div class="col">
                <div class="icon text-danger">
                    <i class="fas fa-recycle"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub-description">Waste Management and Recycling</div>
            </div>
            <div class="col">
                <div class="icon text-warning">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub -description">Renewable Energy Awareness</div>
            </div>
            <div class="col">
                <div class="icon text-secondary">
                    <i class="fas fa-book"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub-description">Education for Sustainable Development</div>
            </div>
            <div class="col">
                <div class="icon text-primary">
                    <i class="fas fa-faucet"></i>
                </div>
                <div class="description">SDGs:</div>
                <div class="sub-description">Water Conservation Initiatives</div>
            </div>
        </div>
    </div>

    <div class="container content">
        <div class="row">
            <div class="col-md-12 text-section">
                <div class="call-to-action">
                    Let’s Take Part In These Activities And Contribute To The Global Movement Towards Sustainability
                </div>
            </div>
            <div class="col-md-12 image-section d-flex justify-content-center">
                <img alt="People participating in a community event" height="100" src="{{ asset('images/gambar1_event.svg')}}" width="200"/>
                <img alt="People installing solar panels" height="100" src="{{ asset('images/gambar_event2.svg') }}" width="200"/>
                <img alt="Community gathering in a rural area" height="100" src="{{ asset('images/gambar_event3.svg') }}" width="200"/>
                <img alt="Person teaching a group of people outdoors" height="100" src="{{ asset('images/gambar_event4.svg') }}" width="200"/>
            </div>
        </div>
    </div>
</body>
@endsection
