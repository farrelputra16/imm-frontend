@extends('layouts.app-investors')
@section('title', 'Halaman IMM')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* CSS Umum */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.vid {
    width: 100%;
    max-width: 1080px;
    /* Optional: Set a max-width to limit container width */
    margin: 0 auto;
    /* Center the container */
}

#sdgs {
    margin-bottom: 20px;
}

.section-sdgs .row {
    justify-content: center;
}

.section-video {
    position: relative;
    margin-top: 100px;
    width: 100%;
    padding-bottom: 56.25%;
    /* Aspect ratio 16:9 */
    height: 0;
    overflow: hidden;
    background-color: #D9D9D9;
}

.section-video iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    pointer-events: none;
    /* Disable user interaction */
}

#title {
    font-size: 35px;
    color: #5940CB;
    font-weight: 400;
}

.btn-mulai {
    width: 275px;
    height: 48px;
    background-color: #6543FC;
    font-size: 20px;
    font-weight: 500;
    color: white;
    border-radius: 5px;
    border: none;
}

.btn-mulai:hover {
    background-color: #5837eb;
}

#sdgs {
    font-size: 40px;
    color: #5940CB;
    font-weight: 400;
}

.section-content1 {
    gap: 20px;
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    max-width: 400px;
}

.col-4 h5 {
    font-size: 32px;
    color: #5940CB;
    font-weight: 500;
}

.col-4 {
    color: #5940CB;
    font-size: 20px;
    font-weight: 400;
}

.section-sdgs {
    gap: 10px;
}

.bulat {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #5940CB;
    margin-right: 15px;
}

.text {
    color: #5940CB;
}

.bagaimana {
    margin-bottom: 100px;
    margin-top: 50px;
}

.text-content {
    font-size: 40px;
    color: #5940CB;
    font-weight: 400;
}

.section-sdgs,
.section-data,
.section-ukur,
.bagaimana {
    margin-top: 80px;
}


/* Media Queries untuk Responsif */


/* Tablet dan perangkat mobile dengan lebar maksimum 768px */

@media (max-width: 768px) {
    .section-content1 {
        max-width: 100%;
    }
    .col-4 {
        text-align: center;
        padding: 0 15px;
    }
    .section-sdgs .col-6 {
        text-align: center;
    }
    .section-sdgs .col-6 h5 {
        text-align: center;
    }
    .section-sdgs .col-6 img {
        display: block;
        margin: 0 auto;
    }
    .bagaimana .col-3 {
        flex-basis: 100%;
        margin-bottom: 30px;
    }
    .text-content {
        font-size: 30px;
    }
    .bulat {
        margin-right: 0;
        margin-bottom: 15px;
    }
}


/* Perangkat mobile dengan lebar maksimum 576px */

@media (max-width: 576px) {
    .col-4 {
        flex-basis: 100%;
    }
    .section-sdgs .col-6 h5 {
        font-size: 30px;
    }
    .section-sdgs .col-6 img {
        width: 60px;
        height: 60px;
    }
    .text-content {
        font-size: 25px;
    }
    .bulat {
        width: 30px;
        height: 30px;
    }
}
    </style>
@endsection
@section('content')
<body>
    <div class="container vid">
        <div class="section-video">
            <iframe src="https://www.youtube.com/embed/fdvrafScAa8?si=lo9MzS6TIqLEQJHd&controls=0&autoplay=1&mute=1&loop=1&playlist=fdvrafScAa8" allowfullscreen></iframe>
        </div>
    </div>
    <div class="container section-ukur d-flex justify-content-center">
        <div class="section-content1 text-center">
            <h5 id="title">Ukur dampak anda dengan <strong>percaya diri</strong></h5>
            <button class="btn btn-primary btn-mulai" onclick="window.location.href='/login';">Mulai Sekarang</button>
        </div>
    </div>

    <div class="container section-data">
        <div class="row mx-4">
            <div class="col-12 col-md-4 text-center mt-5">
                <img src="/images/icon-realtem.svg" class="img-fluid" alt="">
                <h5 style="font-size: 28px" class="mt-4 mb-2">Data Real-time</h5>
                <span style="font-size: 18px">Lacak dampak anda secara real-time dengan analitik yang tepat</span>
            </div>
            <div class="col-12 col-md-4 text-center mt-5">
                <img src="/images/icon-realtem.svg" class="img-fluid" alt="">
                <h5 style="font-size: 28px" class="mt-4 mb-2">Strategi Keterlibatan</h5>
                <span style="font-size: 18px">Sesuaikan strategi keterlibatan untuk kebutuhan organisasi anda</span>
            </div>
            <div class="col-12 col-md-4 text-center mt-5">
                <img src="/images/icon-realtem.svg" class="img-fluid" alt="">
                <h5 style="font-size: 28px" class="mt-4 mb-2">Laporan Komprehensif</h5>
                <span style="font-size: 18px">Hasilkan laporan komprehensif untuk menunjukkan dampak anda</span>
            </div>
        </div>
    </div>

    <div class="container section-sdgs">
        <div class="row d-flex justify-content-center align-items-center w-100">
            <div class="col-12 col-md-6 d-flex justify-content-center text-center">
                <h5 id="sdgs">Pengukuran dengan <br><strong>17 Sustainable <br>Development Goals</strong></h5>
            </div>
            <div class="col-12 col-md-6">
                <div class="row section-sdgs text-center">
                    @foreach (range(1, 17) as $goal)
                        <div class="col-4 col-sm-4 col-md-2 mb-3">
                            <img src="/images/E-WEB-Goal-{{ $goal }}.png" class="img-fluid" alt="">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container bagaimana">
        <h5 class="text-center text-content m-5">Bagaimana caranya?</h5>
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-3 d-flex align-items-start">
                <img src="/images/bulat.svg" class="img-fluid" alt="">
                <div class="text ml-3">
                    <h5 class="mb-3"><strong>Definisikan tujuan dampak anda</strong></h5>
                    <p>Tentukan tujuan dengan tag dampak dan 17 point SDGs</p>
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex align-items-start">
                <img src="/images/bulat.svg" class="img-fluid" alt="">
                <div class="text ml-3">
                    <h5 class="mb-3"><strong>Atur Metrik anda</strong></h5>
                    <p>Pilihan metrik yang beragam sesuai dengan kebutuhan dampak organisasi</p>
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex align-items-start">
                <img src="/images/bulat.svg" class="img-fluid" alt="">
                <div class="text ml-3">
                    <h5 class="mb-3"><strong>Kumpulkan dan analisa data</strong></h5>
                    <p>Didukung dengan fitur survey dan visualisasi data</p>
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex align-items-start">
                <img src="/images/bulat.svg" class="img-fluid" alt="">
                <div class="text ml-3">
                    <h5 class="mb-3"><strong>Hasilkan laporan</strong></h5>
                    <p>Dokumentasi dampak anda dalam bentuk laporan komprehensif</p>
                </div>
            </div>
        </div>
    </div>


</body>
@endsection

