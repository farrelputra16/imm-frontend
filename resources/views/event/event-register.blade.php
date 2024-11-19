@extends('layouts.app-landingpage')
@section('title', 'Event Register')

@section('css')
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        list-style-type: none;
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
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('events.index') }}" style="text-decoration: none; color: #212B36;">Event</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('events.view', ['id'=> $event->id]) }}" style="text-decoration: none; color: #212B36;">Event Detail</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="#" style="text-decoration: none; color: #5A5A5A;">Event Registration</a>
                </li>
            </ol>
        </nav>
    </div>
    <section class="banner" style="">
        <img class="banner-img" src="{{ env('APP_URL') . '/' . $event->hero_img }}"
             class="w-100 h-auto" alt="">
    </section>
    <div class="content d-flex flex-column justify-content-start">
        <div class="container">
            <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Menampilkan pesan error umum -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <p class="" style="font-size:40px; font-weight:bold">Isi Data Diri</p>

                <div class="mb-4 mt-4">
                    <label for="nama_depan" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_depan" id="nama_depan" class="form-control" placeholder="Isi disini" required>
                    @error('nama_depan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 mt-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Isi disini" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
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
                        <option value="Karyawan Perusahaan">Karyawan Perusahaan</option>
                        <option value="Manajer Proyek">Manajer Proyek</option>
                        <option value="Direktur">Direktur</option>
                        <option value="CEO">CEO</option>
                        <option value="CTO">CTO</option>
                        <option value="CFO">CFO</option>
                        <option value="Pengusaha">Pengusaha</option>
                        <option value="Staf HRD">Staf HRD</option>
                        <option value="Investor">Investor</option>
                        <option value="Angel Investor">Angel Investor</option>
                        <option value="Venture Capitalist">Venture Capitalist</option>
                        <option value="Penasihat Investasi">Penasihat Investasi</option>
                        <option value="Mentor Bisnis">Mentor Bisnis</option>
                        <option value="Mentor Karir">Mentor Karir</option>
                        <option value="Pelatih (Coach)">Pelatih (Coach)</option>
                        <option value="Konsultan">Konsultan</option>
                        <option value="Freelancer">Freelancer</option>
                        <option value="Wirausaha">Wirausaha</option>
                        <option value="Pekerja Lepas">Pekerja Lepas</option>
                        <option value="Pekerja Kreatif">Pekerja Kreatif</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    @error('pekerjaan')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror </div>

                <div class="mb-4 mt-4">
                    <label for="instansi" class="form-label">Nama Instansi/Perusahaan (Opsional)</label>
                    <input type="text" name="instansi" id="instansi" class="form-control" placeholder="Isi disini">
                    @error('instansi')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <button type="submit" class="btn-simpan mt-5" style="font-size: 20px; font-weight:bold">Simpan Data</button>
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
