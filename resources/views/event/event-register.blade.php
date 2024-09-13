@extends('layouts.app-navbar')
@section('title', 'Event Register')

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

.content-container h1,
.date-box,
.chart-container,
.analysis-matrix .content-box,
.target-check .target-check-box,
.icon-box .icon-item,
.btn {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.content-container h1:hover,
.date-box:hover,
.chart-container:hover,
.analysis-matrix .content-box:hover,
.target-check .target-check-box:hover,
.icon-box .icon-item:hover,
.btn:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}
    </style>
@endsection
@section('content')
<!DOCTYPE html>
<html lang="en">


<body>



    <section class="banner" style=""> <img class="banner-img" src="{{ env('APP_BACKEND_URL') . '/images/' . $event->hero_img }}"
            class="w-100 h-auto" alt=""></section>
    <div class="content d-flex flex-column justify-content-start">
        <div class="container">
            <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <p class="" style="font-size:40px; font-weight:bold">Isi Data Diri</p>
                <div class="mb-4 mt-4">
                    <label for="nama_depan" class="form-label">Nama Lengkap</label>
                    <input type="text" name="" id="nama_depan" class="form-control" placeholder="Isi disini"
                        required>
                </div>
                <div class="mb-4 mt-4">
                    <label for="nama_depan" class="form-label">Email</label>
                    <input type="text" name="" id="nama_depan" class="form-control" placeholder="Isi disini"
                        required>
                </div>

                <div class="mb-4 mt-4">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <select id="pekerjaan" name="pekerjaan" class="form-control" required>
                        <option value="" disabled selected>Pilih Pekerjaan</option>
                        <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                        <option value="Guru/Dosen">Guru/Dosen</option>
                        <option value="Swasta">Swasta</option>
                        <option value="PNS">PNS</option>
                        <option value="Belum Bekerja">Belum Bekerja</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    {{-- <input type="text" id="customPekerjaan" class="form-control hidden-input mt-2" placeholder="Isi disini" required> --}}
                </div>


                <div class="mb-4 mt-4">
                    <label for="nama_depan" class="form-label">Nama Instansi/Perusahaan ( Opsional )</label>
                    <input type="text" name="instansi" id="nama_depan" class="form-control" placeholder="Isi disini">
                </div>

                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <button type="submit" class="btn-simpan mt-5"
                        style="font-size: 20px; font-weight:bold">Simpan Data</button>

            </form>
        </div>
    </div>


    <script>
        document.getElementById('pekerjaan').addEventListener('change', function() {
            var customInput = document.getElementById('customPekerjaan');
            if (this.value === 'Lainnya') {
                customInput.classList.remove('hidden-input');
            } else {
                customInput.classList.add('hidden-input');
            }
        });
    </script>
</body>

@endsection
