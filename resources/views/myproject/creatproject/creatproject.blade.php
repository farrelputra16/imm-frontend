@extends('layouts.app-imm')
@section('title', 'Membuat Proyek')

@section('css')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}

    <link rel="stylesheet" href="{{ asset('css/myproject/creatproject/creatproject.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/myproject/creatproject/pemilihansdgs.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.12/plyr.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
    <style>
        .breadcrumb {
            background-color: white;
            padding: 0;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            margin-right: 14px;
            color: #9CA3AF;
        }
        .popup-notification {
            position: fixed; /* Relative untuk posisi tombol "X" */
            background-color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            z-index: 1000;
            animation: pop-up 1s ease-out;
        }

        /* Tombol "X" di pojok kanan atas */
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #c72828;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Overlay untuk membuat layar menjadi gelap di belakang pop-up */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }
        .target-pelanggan table {
            border-collapse: collapse;
            width: 100%;
        }

        .target-pelanggan th, .target-pelanggan td {
            padding: 10px;
            text-align: center;
        }

        .target-pelanggan th {
            font-weight: bold;
            color: #333;
            border-bottom: none;
        }

        .target-pelanggan td:last-child {
            border-bottom: none;
        }

        .target-pelanggan input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 40px; /* tambahkan ini untuk membuat ukuran input sama */
        }

        .target-pelanggan textarea {
            height: 40px; /* ubah ukuran textarea menjadi lebih tinggi */
            resize: none; /* tambahkan ini untuk membuat textarea tidak dapat di-resize */
        }
        .custom-select-wrapper {
        position: relative;
        display: inline-block;
        }

        .custom-select {
        background-color: #f0f0ff;
        border: 1px solid #7a5cff;
        border-radius: 8px;
        padding: 5px 10px;
        margin-right: 10px;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: none;
        }

        .custom-select-wrapper .custom-select {
        padding-right: 30px;
        }

        .custom-select-arrow {
        position: absolute;
        top: 50%;
        right: 20px;
        transform: translateY(-50%);
        pointer-events: none;
        }

        .custom-select-arrow::after {
        content: "\25BC";
        font-size: 12px;
        }

        .custom-select::-webkit-scrollbar {
        display: none;
        }

        .label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .section-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        .upload-box-custom {
            border: 2px solid #9b59b6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            cursor: pointer;
            background-color: none;
        }
        .upload-box-custom img {
            width: 40px;
            height: 40px;
            color: #9b59b6;
            background-color: none;
        }
        .upload-box-custom p {
            margin-top: 10px;
            color: #666;
        }
        .upload-box-custom input[type="file"] {
            display: none;
            background-color: none;
        }

        .upload-box-custom.dragover {
            border-color: #007bff; /* Warna border saat dragover */
            background-color: #f0f8ff; /* Warna latar belakang saat dragover */
        }
        .custom-button {
            width: 100%;
            padding: 10px;
            border: 1px solid #808080;
            border-radius: 8px;
            font-size: 1rem;
            color: #6f42c1;
            background-color: white;
            text-align: center;
        }

        /* Bagian Searching container */
        .search-container {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            margin-top: 0px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }
        .search-container input {
            border: none;
            outline: none;
            padding: 10px 15px;
            flex-grow: 1;
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .search-container button {
            background-color: #6257CB;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .search-container button:hover {
            background-color: #5146a6;
        }
        .search-container i {
            margin-left: 10px;
            color: #aaa;
        }
        .search-container input:focus {
            outline: none;
            box-shadow: none;
        }

        /* Bagian untuk membuat img dan check box nya */
        .image-container {
            position: relative;
            display: inline-block;
            margin: 0px;
            padding: 0px;
            margin-right: 2px;
            margin-bottom: 22px;
            visibility: visible; /* Make images visible by default */
            opacity: 1;
            transition: visibility 0s, opacity 0.5s;
        }

        .image-container.hide {
            visibility: hidden;
            opacity: 0;
        }

        .image-container.show {
            visibility: visible;
            opacity: 1;
        }
        .image-container img {
            width: 100%;
            height: 100%;
            border-radius: 16px !important;
            cursor: pointer;
            transition-duration: 1.2s !important;
        }
        .image-container.selected img {
            filter: brightness(0.5); /* adjust the value to your liking */
            box-shadow: inset 0 0 0 100px rgba(0, 0, 0, 0.5); /* adjust the value to your liking */
        }
        .sdg-checkbox-img {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: white;
            border-radius: 3px;
        }

        /* Bagian Filter */
        .filter-section {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 16px;
        }

        .filter-section h5 {
            font-weight: bold;
        }

        .filter-section .form-check-label {
            margin-left: 10px;
        }

        .filter-section .btn-link {
            color: #6c757d;
            text-decoration: none;
        }

        .filter-section .btn-link:hover {
            text-decoration: underline;
        }

        .filter-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            margin-top: 0px !important;
            margin-left: 10px;
        }

        /* Form chekbox filter */
        .categories-container {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 16px;
            width: 100%;
        }
        .form-check-label {
            font-size: 16px;
            margin-bottom: 12px;
        }
        .form-check-input:checked + .form-check-label {
            color: #6256CA;
            font-weight: bold;
        }

        /* Bagian Indikator untuk perubahan cara penambpilan indicatornya */
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .list-group-item .number {
            font-weight: bold;
            margin-right: 10px;
        }
        .list-group-item .title {
            flex-grow: 1;
        }
        .list-group-item .info {
            display: flex;
            align-items: center;
        }
        .list-group-item .selected {
            color: #6f42c1;
            font-weight: bold;
            margin-right: 10px;
        }
        .content-container {
            display: none;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-top: 2px;
            margin-bottom: 48px;
        }
        /* Bagian list label  */
        .form-check-input:checked {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }

        /* Bagian matriks */
        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 0;
            margin: 16px 0;
        }
        .card-header {
            display: flex;
            align-items: flex-start;
            padding: 8px 16px;
            border-bottom: none;
        }
        .card-body {
            padding: 8px 24px;
            color: #6c757d;
        }
        .card:nth-child(odd) {
            background-color: #ffffff;
        }
        .card:nth-child(even) {
            background-color: #f8f9fa;
        }
        .header-left {
            display: flex;
            align-items: center;
            margin-right: 16px;
            margin-top: 2px;
        }
        .header-right {
            flex-grow: 1;
        }
        .header-right strong {
            display: block;
        }
        .header-content {
            display: flex;
            align-items: flex-start;
        }
        .header-right div {
            margin-left: 0;
        }
        .checkbox-container, .number-container {
            display: flex;
            align-items: center;
        }
        .number-container{
            margin-left: 10px;
        }

        /* Bagian khusus untuk map */
        .map-container {
            position: relative;
            width: 100%;
            height: 400px;
            margin: 20px 0;
        }

        #map {
            height: 100%; /* Pastikan peta mengisi seluruh kontainer */
            width: 100%; /* Pastikan peta mengisi seluruh kontainer */
            z-index: 0; /* Pastikan peta berada di belakang elemen lain */
        }

        .location-info {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')

    <body>
        {{-- Membuat notifikasi bila terjadi input yang belum di isi di dalam form required --}}
        <div class="popup-overlay" id="popup-overlay"></div>
        <div class="popup-notification" id="form-notification" style="display: none">
            <button class="close-button" id="close-notification">X</button>
            <div style="display: flex; flex-direction: column; gap: 20px; align-items: center;">
                <img src="images/Warning_icon.svg" alt="Warning!" style="width: 100px;">
                <b>Harap Isi Semua Data Yang Diperlukan</b>
            </div>
        </div>
        {{-- Akhir dari notifikasi --}}
        <div class="container">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <nav aria-label="breadcrumb" class="mb-5">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                            <a href="#" style="text-decoration: none; color: #212B36;">Home</a>
                        </li>
                        <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                            <a href="#" style="text-decoration: none; color: #212B36;">Project Registration</a>
                        </li>
                        <li aria-current="page" class="breadcrumb-item active sub-heading-1" id="projectbread" style="margin-right: 4px;">
                            <span class="breadcrumb-span" id="projectspan" style="color: #5A5A5A;">Register New Project</span>
                        </li>
                        <li aria-current="page" class="breadcrumb-item active sub-heading-1" id="sdgbread" style="margin-right: 4px; display: none;">
                            <span class="breadcrumb-span" id="sdgspan" style="color: #5A5A5A; display: none;">SDGs Categories</span>
                        </li>
                        <li aria-current="page" class="breadcrumb-item active sub-heading-1" id="indikatorbread" style="margin-right: 4px; display: none;">
                            <span class="breadcrumb-span" id="indikatorspan" style="color: #5A5A5A; display: none;">SDGs Indicators</span>
                        </li>
                        <li aria-current="page" class="breadcrumb-item active sub-heading-1" id="metricsbread" style="margin-right: 4px; display: none;">
                            <span class="breadcrumb-span" id="metricsspan" style="color: #5A5A5A; display: none;">SDGs Metrics</span>
                        </li>
                        <li aria-current="page" class="breadcrumb-item active sub-heading-1" id="reviewbread" style="margin-right: 4px; display: none;">
                            <span class="breadcrumb-span" id="reviewspan" style="color: #5A5A5A; display: none;">Review</span>
                        </li>
                    </ol>
                </nav>

                {{-- Bagian awal project --}}
                <h2 class="mb-5" id="buatproject" style="color: #6256CA;">Register New Project</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div id="form-section">
                    <div class="row">
                        {{-- Input bagian kiri --}}
                        <div class="col-md-6">
                            <h3 class="project-title">Basic Project Information</h3>
                            <div class="form-group">
                                <input type="file" class="form-control-file" id="img" name="img" hidden>
                            </div>

                            {{-- Bagian Tag Tema untuk Pendaftaran Project --}}
                            <div class="form-group">
                                @if (auth()->check() && auth()->user()->companies)
                                    <input type="hidden" name="company_id" value="{{ auth()->user()->companies->id }}"
                                        id="company_id">
                                @endif
                            </div>
                            <div class="form-group" style="margin-bottom: 24px;">
                                <label for="impactTags" class="sub-heading-1">Tag</label>
                                <div class="tags-container scrollbar" style="height: 200px; overflow-y: auto; border-radius: 6px;">
                                    @foreach ($tags as $tag)
                                        <div class="form-check ">
                                            <button class="tag-button" data-tag-id="{{ $tag->id }}" type="button">
                                                {{ $tag->nama }}
                                            </button>
                                            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                                id="tag{{ $tag->id }}" name="tag_ids[]" style="display: none;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 24px;">
                                <label for="nama" class="sub-heading-1">Project Name</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Input your project name" required>
                            </div>

                            <div class="form-group" style="margin-bottom: 24px;">
                                <label for="deskripsi" class="sub-heading-1">Project Description</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" placeholder="Input your project description" required></textarea>
                            </div>

                            <div class="form-group" style="margin-bottom: 24px;">
                                <label for="tujuan" class="sub-heading-1">Project Goals</label>
                                <textarea class="form-control" name="tujuan" id="tujuan" rows="5" placeholder="Input your project goals" required></textarea>
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="targetCustomers" class="sub-heading-1">Target Market</label>
                                {{-- <button type="button" class="btn btn-primary btn-add-pelanggan ml-2 mb-2"><i class="fa-solid fa-plus" style="color: #ffffff;"></i></button> --}}
                                <div class="target-pelanggan">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">Status Pekerjaan</th>
                                                <th style="text-align: center;">Rentang Usia</th>
                                                <th style="text-align: center;">Deskripsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="target_pelanggans[0][status]" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="target_pelanggans[0][rentang_usia]" required>
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="target_pelanggans[0][deskripsi_pelanggan]" required></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="label sub-heading-1">Tanggal Mulai Proyek</div>
                                    <div class="d-flex">
                                        <div class="custom-select-wrapper">
                                            <select class="custom-select scrollbar" style="width: 79px;" id="start_day" name="start_day" required>
                                                <option value="">Date</option>
                                            </select>
                                        <div class="custom-select-arrow"></div>
                                        </div>
                                            <div class="custom-select-wrapper" style="margin-left: 10px;">
                                                <select class="custom-select scrollbar" style="width: 135px;" id="start_month" name="start_month" required>
                                                    <option value="">Month</option>
                                                </select>
                                            <div class="custom-select-arrow"></div>
                                        </div>
                                            <div class="custom-select-wrapper" style="margin-left: 10px;">
                                                <select class="custom-select scrollbar" style="width: 80px;" id="start_year" name="start_year" required>
                                                    <option value="">Year</option>
                                                </select>
                                            <div class="custom-select-arrow"></div>
                                        </div>
                                        <input type="hidden" id="start_date" name="start_date">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="label sub-heading-1">Tanggal Berakhir Proyek</div>
                                    <div class="d-flex">
                                        <div class="custom-select-wrapper">
                                            <select class="custom-select scrollbar" style="width: 79px;" id="end_day" name="end_day" required>
                                            <option value="">Date</option>
                                            </select>
                                            <div class="custom-select-arrow"></div>
                                        </div>
                                        <div class="custom-select-wrapper" style="margin-left: 10px;">
                                            <select class="custom-select scrollbar" style="width: 135px;" id="end_month" name="end_month" required>
                                            <option value="">Month</option>
                                            </select>
                                            <div class="custom-select-arrow"></div>
                                        </div>
                                        <div class="custom-select-wrapper" style="margin-left: 10px;">
                                            <select class="custom-select scrollbar" style="width: 80px;" id="end_year" name="end_year" required>
                                            <option value="">Year</option>
                                            </select>
                                            <div class="custom-select-arrow"></div>
                                        </div>
                                        <input type="hidden" id="end_date" name="end_date">
                                    </div>
                                </div>
                            </div>

                            {{-- Penambahan baru Supporting Material --}}
                            <div class="section-title">Supporting Materials</div>
                            <div class="mt-4">
                                <div class="mb-2 sub-heading-1">Pitch Deck</div>
                                <div class="upload-box-custom" id="pitch-deck-dropzone">
                                    <img src="{{ asset('images/upload.svg') }}" alt="Upload icon">
                                    <p>Upload your PDF pitch deck outlining your project and investment needs.</p>
                                    <input type="file" id="pitch-deck-upload" name="pitch_deck" accept=".pdf, .ppt, .pptx" style="display:none;">
                                </div>
                                <div id="pitch-deck-preview"></div>
                            </div>

                            <div class="mt-4">
                                <div class="mb-2 sub-heading-1">Video Presentation</div>
                                <div class="upload-box-custom" id="video-dropzone">
                                    <img src="{{ asset('images/upload.svg') }}" alt="Upload icon">
                                    <p>Upload a short video presenting your project and its key highlights.</p>
                                    <input type="file" id="video-upload" name="video_pitch" accept="video/*" style="display:none;">
                                </div>
                                <div id="video-preview" class="video-js vjs-default-skin" style="margin-bottom: 250px; display: none; width: 100%;">
                                    <video id="video" width="100%" height="auto" controls></video>
                                </div>
                                <div id="video-name" style="margin-bottom: 20px; margin-top: 20px;"></div>
                            </div>
                        </div>

                        {{-- Bagian input sebelah kanan --}}
                        <div class="col-md-6">
                            <h3 class=" project-title" style="margin-bottom: 15px;">Investment Details</h3>
                            <div class="form-group mt-3">
                                <label for="jumlah_pendanaan_display" class="sub-heading-1">Investment Needs</label>
                                <input type="text" class="form-control" id="jumlah_pendanaan_display"> <!-- Hanya untuk ditampilkan -->
                                <!-- Hidden input untuk menyimpan nilai asli tanpa format -->
                                <input type="hidden" class="form-control" name="jumlah_pendanaan" id="jumlah_pendanaan">
                            </div>

                            {{-- Tempat project Road Map --}}
                            <div class="mt-4">
                                <div class="mb-2 sub-heading-1">Project Roadmap</div>
                                <div class="upload-box-custom" id="roadmap-dropzone">
                                    <img src="{{ asset('images/upload.svg') }}" alt="Upload icon">
                                    <p>Upload Your Project Roadmap Document (PDF atau PPT Format).</p>
                                    <input type="file" id="roadmap-upload" name="roadmap" accept=".pdf, .ppt, .pptx" style="display:none;">
                                </div>
                                <div id="roadmap-preview"></div>
                            </div>

                            <div class="form-group">
                                <label for="provinsi" class="sub-heading-1">Provinsi</label>
                                <select class="form-control" name="provinsi" id="provinsi" required>
                                    <!-- Placeholder option -->
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kota" class="sub-heading-1">Kota/Kabupaten</label>
                                <select class="form-control" name="kota" id="kota" required>
                                    <!-- Placeholder option -->
                                    <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gmaps" class="sub-heading-1">Google Maps URL:</label>
                                <input type="text" class="form-control" id="gmaps" name="gmaps" required>
                            </div>

                            {{-- Tempat untuk menjadi bagian container dari peta --}}
                            <div class="form-group">
                                <div class="map-container">
                                    <div id="map"></div>
                                    <div id="modal-content" class="location-info"></div>
                                </div>
                            </div>
                            <input type="hidden" id="latitude" name="latitude">
                            <input type="hidden" id="longitude" name="longitude">

                            <div class="form-group">
                                <div class="section-img">
                                    <h5>Unggah Foto Sampul Proyek</h5>
                                    <p>Gunakan foto Default</p>
                                    <label for="imageInput" class="choose-file-label">
                                        <div class="unggah-image">
                                            <img id="previewImage" src=""
                                                alt="Unggah foto sampul 1920x1080(.png, .jpg, .jpeg) Maximal 5 MB">
                                        </div>
                                    </label>
                                    <input type="file" id="imageInput" name="img" style="display: none;">

                                </div>
                            </div>

                            {{-- Tempar Impat dan Matriks --}}
                            <div class="form-group">
                                <div class="section-title">Impact and Metrics</div>
                                <div class="mt-4">
                                    <div class="mt-3 sub-heading-1">SDGs Categories, Indicators, and Metrics</div>
                                    <button type="button" class="custom-button mt-3" id="next-to-sdg-section">Add SDGs, Indicators, Metric</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Bagian SDG --}}
                <div class="container-fluid mt-5">
                    <div class="form-group">
                        <div id="sdg-section" style="display: none;">
                            <h2 style="color: #6256CA;" class="mb-5">SDGs Categories</h2>
                            <div class="row">
                                {{-- Bagian filter --}}
                                <div class="col-md-3">
                                    <div class="filter-header" style="vertical-align: center;">
                                        <h4><b>FILTER</b></h4>
                                        <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 10px;">
                                    </div>
                                    <div class="categories-container mt-3">
                                        <div class="sub-heading-1" style="margin-bottom: 16px;">CATEGORIES</div>
                                        <div class="form-check">
                                            <input class="form-check-input filter-checkbox" type="checkbox" value="" id="socialImpact">
                                            <label class="form-check-label" for="socialImpact">
                                                Social Impact
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter-checkbox" type="checkbox" value="" id="environmentalImpact">
                                            <label class="form-check-label" for="environmentalImpact">
                                                Environmental Impact
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter-checkbox" type="checkbox" value="" id="economicImpact">
                                            <label class="form-check-label" for="economicImpact">
                                                Economic Impact
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter-checkbox" type="checkbox" value="" id="institutionalCollaborative">
                                            <label class="form-check-label" for="institutionalCollaborative">
                                                Institutional and Collaborative
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input filter-checkbox" type="checkbox" value="" id="urbanCommunityDevelopment">
                                            <label class="form-check-label" for="urbanCommunityDevelopment">
                                                Urban and Community Development
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                {{-- Bagian SDG --}}
                                <div class="col-md-9">
                                    <div class="search-container">
                                        <i class="fas fa-search" style="margin-left: 10px;"></i>
                                        <input class="form-control" placeholder="Search Data" type="text" style="border: none;">
                                        <button class="btn">Search</button>
                                    </div>
                                    @foreach ($sdgs as $sdg)
                                        <div class="image-container" data-sdg="{{ $sdg->id }}">
                                            @php
                                                // Mendefinisikan URL gambar dari backend
                                                $backendImage = env('APP_BACKEND_URL') . '/images/' . $sdg->img;

                                                // Mendefinisikan path gambar default di public folder
                                                $defaultImage = asset('images/' . $sdg->img);

                                                // Logika pengecekan apakah gambar ada
                                                $imageUrl = $sdg->img ? $backendImage : $defaultImage;
                                            @endphp
                                            <img src="{{ $imageUrl }}" alt="SDG {{ $sdg->order }}">
                                            <input class="sdg-checkbox-img" name="sdg_ids[]" type="checkbox" value="{{ $sdg->id }}"/>
                                        </div>
                                        {{-- <div class="sdg-item" data-sdg="{{ $sdg->id }} ">
                                            <img src="{{ env('APP_BACKEND_URL') . '/images/' . $sdg->img }}"
                                                alt="SDG {{ $sdg->order }}">
                                            <h5 class="sdg-name">{{ $sdg->order }}. {{ $sdg->name }}</h5>
                                            <i class="fas fa-chevron-down sdg-toggle"></i>
                                            <input type="checkbox" class="sdg-checkbox-img" name="sdg_ids[]"
                                                value="{{ $sdg->id }}">
                                        </div> --}}
                                        {{-- <div class="sdg-description">
                                            <p>{{ $sdg->description ?? 'Tidak ada deskripsi' }}</p>
                                        </div> --}}
                                    @endforeach
                                    <div>
                                        <span class="sub-heading-1" id="category-selected" value=""></span>
                                    </div>
                                    <div class="d-flex justify-content-between mt-3">
                                        <button type="button" class="btn btn-secondary"
                                            id="back-to-form-section">Kembali</button>
                                        <button type="button" class="btn btn-primary" id="next-to-indicator-section">Simpan dan
                                            Lanjutkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Indikator --}}
                <div id="indicator-section" style="display:none">
                    <div class="container mt-5">
                        <h2 style="color: #6256CA;" class="mb-5">SDGs Indicators</h2>
                        <div class="search-container" style="max-width: 2000px;">
                            <i class="fas fa-search" style="margin-left: 10px;"></i>
                            <input class="form-control" placeholder="Search Data" type="text" style="border: none;">
                            <button class="btn">Search</button>
                        </div>
                        <span class="sub-heading-1" id="category-selected-indikator" style="margin-top: 24px;"></span>
                        <div class="d-flex justify-content-start mb-4" id="sdg-images-container" style="margin-top: 24px;"></div>
                        {{-- <div class="text-center bg-light p-3 mb-4" id="project-long-description"></div> --}}

                        <ul class="list-group">
                            @foreach ($sdgs as $sdg)
                                <li class="list-group-item" data-target="#content{{ $sdg->id }}">
                                    <span class="number">{{ $sdg->id }}.</span>
                                    <span class="title">{{ $sdg->short_name }}</span>
                                    <div class="info">
                                        <span class="selected-{{ $sdg->id }}" style="color: #6f42c1; font-weight: bold; margin-right: 10px;"></span>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </li>
                                <div id="content{{ $sdg->id }}" class="content-container" style="display: none;">
                                    @foreach ($sdg->indicators as $indicator)
                                        <div class="indicator" style="margin-bottom: 16px;">
                                            <label for="indicator-{{ $indicator->id }}" class="form-check-label" style="margin-left: 24px;">
                                                <input type="checkbox" class="indicator-checkbox form-check-input filter-checkbox" id="indicator-{{ $indicator->id }}" name="indicator_ids[]" value="{{ $indicator->id }}" data-sdg="{{ $indicator->sdg_id }}" data-target="sub-container-{{ $indicator->id }}">
                                                <span style="margin-right: 20px;">{{ $indicator->order }} </span><span>{{ $indicator->name }}</span>
                                            </label>
                                            <div class="sub-container" id="sub-container-{{ $indicator->id }}" style="display: none; margin-top: 10px;">
                                                <div class="d-flex flex-column" style="gap: 15px; margin-left:45px;">
                                                    @foreach ($indicator->childIndicators as $childIndicator)
                                                        <div class="d-flex">
                                                            <span>{{ $childIndicator->order }}</span>
                                                            <span class="ml-2">{{ $childIndicator->name }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </ul>

                        {{-- @foreach ($sdgs as $sdg)
                            <div class="goal-description mb-4 p-3 bg-white shadow-sm rounded" id="goal{{ $sdg->id }}-description">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h5 class="mb-0">SDGs Goals {{ $sdg->id }}</h5>
                                        <p class="mb-0">{{ $sdg->name }}</p>
                                    </div>
                                </div>

                                @foreach ($sdg->indicators as $indicator)
                                    @if ($indicator->level == 1)
                                        <div class="mt-3 d-flex align-items-center level-1-indicator" style="gap: 15px">
                                            <label for="indicator-{{ $indicator->id }}">
                                                <input type="checkbox" class="indicator-checkbox"
                                                    id="indicator-{{ $indicator->id }}" name="indicator_ids[]"
                                                    value="{{ $indicator->id }}"
                                                    data-target="sub-container-{{ $indicator->id }}">
                                                <span class="ml-2">{{ $indicator->order }} </span><span class="ml-2">{{ $indicator->name }}</span>
                                            </label>
                                        </div>
                                    @endif --}}

                                    {{-- Sub-container untuk indikator level 2 --}}
                                    {{-- @if ($indicator->level == 1)
                                        <div class="sub-container" id="sub-container-{{ $indicator->id }}"
                                            style="display: none; margin-top: 10px;">
                                            <div class="d-flex flex-column" style="gap: 15px; margin-left:45px;">
                                                @foreach ($indicator->childIndicators as $childIndicator)
                                                    <div class=" d-flex">
                                                        <span>{{ $childIndicator->order }}
                                                        </span><span class="ml-2">{{ $childIndicator->name }}</span><br>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach  --}}


                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" id="back-to-sdg-section">Kembali</button>
                            <button type="button" class="btn btn-primary" id="next-to-metric-section">Simpan dan Lanjutkan</button>
                        </div>
                    </div>

                </div>

                {{-- Bagian Matriks --}}
                <div id="metric-section" style="display: none;">
                    <div class="container mt-5">
                        <h2 style="color: #6256CA;" class="mb-5">SDGs Metrics</h2>
                        <div class="search-container" style="max-width: 2000px;">
                            <i class="fas fa-search" style="margin-left: 10px;"></i>
                            <input class="form-control" placeholder="Search Data" type="text" style="border: none;">
                            <button class="btn">Search</button>
                        </div>
                        <div id="metrics"></div>
                        <div class="header-content justify-content-center">
                            <div class="header-right">
                                <!-- Page numbers will be dynamically inserted here -->
                                <span id="pagination-numbers" class="mx-2"></span>
                            </div>
                            <div class="header-left">
                                <button type="button" class="btn btn-primary" id="next-page">Berikutnya</button>
                            </div>
                        </div>


                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary"
                                id="back-to-indicator-section">Kembali</button>
                            <button type="button" class="btn btn-primary" id="next-to-review-section">Simpan dan
                                Lanjutkan</button>
                        </div>
                    </div>
                </div>

                {{-- Bagian Review --}}
                <div id="review-section" style="display: none;">

                    <div class="container mt-5 pt-5">
                        <h2 class="text-center">Detail Review: SDGs Goals, Indicators, dan Metrix</h2>
                        <p class="text-center">Goals SDGs project anda</p>
                        <div class="d-flex justify-content-center mb-4" id="review-sdg-images-container"></div>
                        <div class="goals-text mt-4">
                            <span class="goal-description" id="selected-sdgs-container"></span>
                        </div>
                    </div>
                    <!-- Bagian Indicators -->
                    <div class="indicators mt-5">
                        <h2 class="text-center">Indicators</h2>
                        <div id="selected-indicators-container"></div>
                    </div>
                    <!-- Bagian Metrics -->
                    <div class="indicators mt-5">
                        <h2 class="text-center">Metrics</h2>
                        <div id="review-selected-metrics"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-secondary" id="back-to-metric-section">Kembali</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>


            </form>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
           function updateBreadcrumb(activeSection) {
                const sections = ['project', 'sdg', 'indikator', 'metrics', 'review'];
                const sectionIndex = sections.indexOf(activeSection);

                sections.forEach((section, index) => {
                    const spanId = section + 'span';
                    const liId = section + 'bread';
                    const spanElement = document.getElementById(spanId);
                    const liElement = document.getElementById(liId);

                    if (index <= sectionIndex) {
                        liElement.removeAttribute('style');
                        spanElement.removeAttribute('style');
                        if (index === sectionIndex) {
                            spanElement.style.color = '#5A5A5A';
                        } else {
                            spanElement.style.color = '#212B36';
                        }
                    } else {
                        liElement.style.display = 'none';
                        spanElement.style.display = 'none';
                    }
                });
            }
        </script>

        <script>
            function validationSection(sectionId){
                let section = document.getElementById(sectionId);
                let inputs = section.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;
                inputs.forEach(function(input){
                    if(input.value === ''){
                        isValid = false;
                        input.classList.add('is-invalid');
                    }else{
                        input.classList.remove('is-invalid');
                    }
                });
                return isValid;
            }
        </script>

        {{-- Bagian untuk melakukan isi ke tanggal --}}
        <script>
            // Function to populate month options
            function populateMonths(selectId) {
              const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
              for (let i = 0; i < months.length; i++) {
                const monthOption = document.createElement('option');
                monthOption.value = (i + 1).toString().padStart(2, '0');
                monthOption.text = months[i];
                document.getElementById(selectId).appendChild(monthOption);
              }
            }

            // Function to populate year options
            function populateYears(selectId) {
              const currentYear = new Date().getFullYear();
              const startYear = 1900;
              for (let i = startYear; i <= currentYear + 100; i++) {
                const yearOption = document.createElement('option');
                yearOption.value = i.toString();
                yearOption.text = i.toString();
                document.getElementById(selectId).appendChild(yearOption);
              }
              document.getElementById(selectId).value = currentYear;
            }

            // Function to update date input
            function updateDateInput(daySelectId, monthSelectId, yearSelectId, dateInputId) {
              const day = document.getElementById(daySelectId).value;
              const month = document.getElementById(monthSelectId).value;
              const year = document.getElementById(yearSelectId).value;

              if (day && month && year) {
                const formattedDate = `${year}-${month}-${day}`;
                document.getElementById(dateInputId).value = formattedDate;
                console.log(formattedDate)
              }
            }

            // Function to update days based on month and year selection
            function updateDays(daySelectId, monthSelectId, yearSelectId) {
              const daySelect = document.getElementById(daySelectId);
              const monthSelect = document.getElementById(monthSelectId);
              const yearSelect = document.getElementById(yearSelectId);

              const previousDay = daySelect.value;
              daySelect.innerHTML = '<option value="">Date</option>';

              const selectedMonth = parseInt(monthSelect.value);
              const selectedYear = parseInt(yearSelect.value);
              let daysInMonth;

              if (selectedMonth === 2) { // Februari
                daysInMonth = (selectedYear % 4 === 0 && (selectedYear % 100 !== 0 || selectedYear % 400 === 0)) ? 29 : 28;
              } else if ([4, 6, 9, 11].includes(selectedMonth)) { // April, Juni, September, November
                daysInMonth = 30;
              } else { // Januari, Maret, Mei, Juli, Agustus, Oktober, Desember
                daysInMonth = 31;
              }

              for (let i = 1; i <= daysInMonth; i++) {
                const dayOption = document.createElement('option');
                dayOption.value = i.toString().padStart(2, '0');
                dayOption.text = i.toString().padStart(2, '0');
                daySelect.appendChild(dayOption);

                if (i === parseInt(previousDay) && parseInt(previousDay) <= daysInMonth) {
                  daySelect.value = previousDay;
                }
              }

              if (parseInt(previousDay) > daysInMonth) {
                daySelect.value = "";
              }
            }

            // Initialize date pickers
            populateMonths('start_month');
            populateYears('start_year');
            populateMonths('end_month');
            populateYears('end_year');

            // Add event listeners
            document.getElementById('start_day').addEventListener('change', () => updateDateInput('start_day', 'start_month', 'start_year', 'start_date'));
            document.getElementById('start_month').addEventListener('change', () => updateDays('start_day', 'start_month', 'start_year'));
            document.getElementById('start_year').addEventListener('change', () => updateDays('start_day', 'start_month', 'start_year'));

            document.getElementById('end_day').addEventListener('change', () => updateDateInput('end_day', 'end_month', 'end_year', 'end_date'));
            document.getElementById('end_month').addEventListener('change', () => updateDays('end_day', 'end_month', 'end_year'));
            document.getElementById('end_year').addEventListener('change', () => updateDays('end_day', 'end_month', 'end_year'));
        </script>

        {{-- Bagian melakukan Input klik dan dropodown dari pitch_deck, video_dropzone, roadmap --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function handleFileUpload(input, previewContainer) {
                    var file = input.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            if (file.type.startsWith('video/')) {
                                var videoPreview = document.getElementById('video');
                                var namePreview = document.getElementById('video-name');
                                // Membersihkan preview sebelumnya
                                videoPreview.src = '';
                                namePreview.textContent = '';
                                // Menampilkan video preview
                                videoPreview.src = e.target.result;
                                previewContainer.style.display = 'block';
                                namePreview.innerHTML += `<p>File name: ${file.name}</p>`;
                            } else {
                                var pdfPreview = document.createElement('embed');
                                pdfPreview.src = e.target.result;
                                pdfPreview.width = '100%';
                                pdfPreview.height = '500px';
                                previewContainer.innerHTML = '';
                                previewContainer.appendChild(pdfPreview);
                                previewContainer.innerHTML += `<p>File name: ${file.name}</p>`;
                            }
                        };
                        reader.readAsDataURL(file);
                    }
                }

                function setupFileInput(dropzoneId, inputId, previewContainerId) {
                    var dropzone = document.getElementById(dropzoneId);
                    var input = document.getElementById(inputId);
                    var previewContainer = document.getElementById(previewContainerId);

                    // Fungsi untuk menangani klik pada dropzone
                    dropzone.addEventListener('click', function() {
                        input.click();
                    });

                    // Event listener untuk input file
                    input.addEventListener('change', function() {
                        handleFileUpload(input, previewContainer);
                    });

                    // Event listener untuk drag-and-drop
                    dropzone.addEventListener('dragover', function(e) {
                        e.preventDefault();
                        dropzone.classList.add('dragover');
                    });

                    dropzone.addEventListener('dragleave', function() {
                        dropzone.classList.remove('dragover');
                    });

                    dropzone.addEventListener('drop', function(e) {
                        e.preventDefault();
                        dropzone.classList.remove('dragover');
                        var files = e.dataTransfer.files;
                        if (files.length > 0) {
                            input.files = files;
                            handleFileUpload(input, previewContainer);
                        }
                    });
                }

                // Setup untuk setiap dropzone
                setupFileInput('pitch-deck-dropzone', 'pitch-deck-upload', 'pitch-deck-preview');
                setupFileInput('video-dropzone', 'video-upload', 'video-preview');
                setupFileInput('roadmap-dropzone', 'roadmap-upload', 'roadmap-preview');
            });
        </script>
        <script src="https://vjs.zencdn.net/7.10.1/video.js"></script>


        {{-- Bagian untuk peta penting mendapatkan langitud  dan logitude yang nantinya akan dimasukkan ke dalam link google maps --}}
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <script>
            const provinsiSelect = document.getElementById('provinsi');
            const kotaSelect = document.getElementById('kota');
            let provincesData = [];
            let currentMarker = null; // Variable to store the current marker

            // Initialize the map without zoom controls and attribution
            const map = L.map('map', {
                zoomControl: false,
                attributionControl: false
            }).setView([-2.5, 118], 4); // Default view

            // Add tile layer from OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19
            }).addTo(map);

            // Fetch provinces data
            fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json')
                .then(response => response.json())
                .then(provinces => {
                    provincesData = provinces;
                    provinces.forEach(provinsi => {
                        const option = document.createElement('option');
                        option.value = provinsi.id; // Use ID as value
                        option.textContent = provinsi.name;
                        provinsiSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching provinces:', error));

            // Populate cities based on selected province
            function populateCities() {
                const selectedProvinsiId = provinsiSelect.value;
                const regenciesUrl = `https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`;

                // Clear previous city options
                kotaSelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';

                fetch(regenciesUrl)
                    .then(response => response.json())
                    .then(regencies => {
                        regencies.forEach(regency => {
                            const option = document.createElement('option');
                            option.value = regency.name; // Use city name as value
                            option.textContent = regency.name;
                            kotaSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error(`Error fetching regencies for provinsi ${selectedProvinsiId}:`, error));
            }

            // Update map view when a city is selected
            kotaSelect.addEventListener('change', function () {
                const selectedCity = this.value;

                // Use Nominatim API to get the latitude and longitude
                fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(selectedCity)}, Indonesia&format=json`)
                    .then(response => response.json())
                    .then(data => {
                        const lat = data[0].lat;
                        const lng = data[0].lon;

                        // Set map view to the selected city
                        map.setView([lat, lng], 10); // Zoom in to the city

         // Update hidden inputs for latitude and longitude
                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lng;

                        // Update Google Maps URL
                        const gmapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
                        document.getElementById('gmaps').value = gmapsUrl;

                        // Remove previous marker
                        if (currentMarker) {
                            map.removeLayer(currentMarker);
                        }

                        // Add a new marker at the selected city
                        currentMarker = L.marker([lat, lng]).addTo(map)
                            .bindPopup('Latitude: ' + lat + '<br>Longitude: ' + lng)
                            .openPopup();
                    })
                    .catch(error => console.error('Error fetching coordinates:', error));
            });

            // Add event listener for province selection
            provinsiSelect.addEventListener('change', populateCities);

            // Add event listener for map click
            map.on('click', function (e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;

                // Remove previous marker
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                }

                // Add a new marker at the clicked location
                currentMarker = L.marker([lat, lng]).addTo(map)
                    .bindPopup('Latitude: ' + lat + '<br>Longitude: ' + lng)
                    .openPopup();

                // Update hidden inputs for latitude and longitude
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // Update Google Maps URL
                const gmapsUrl = `https://www.google.com/maps?q=${lat},${lng}`;
                document.getElementById('gmaps').value = gmapsUrl;
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var imageInput = document.getElementById('imageInput');
                var previewImage = document.getElementById('previewImage');

                imageInput.addEventListener('change', function() {
                    var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewImage.src = "";
                    }
                });
            });
        </script>

        {{-- ada hubungkan ke indicator --}}
        <script>
            $(document).ready(function() {
                // Menangani klik pada gambar untuk checkbox SDG
                $('.image-container').on('click', function(e) {
                    if (!$(e.target).is('.sdg-checkbox-img')) {
                        var checkbox = $(this).find('.sdg-checkbox-img');
                        checkbox.prop('checked', !checkbox.prop('checked'));
                        $(this).toggleClass('selected');
                        updateCheckboxCount(); // Update the count whenever an image is clicked
                    }
                });

                // Menangani klik pada checkbox SDG
                $('.sdg-checkbox-img').on('click', function(e) {
                    e.stopPropagation(); // Prevent the event from bubbling up to the parent div
                    updateCheckboxCount(); // Update the count when checkbox is clicked
                });

                // Bagian filtering SDG
                const sdgIdsByCategory = {
                    social: [1, 3, 4, 5, 16],
                    environmental: [6, 7, 12, 13, 14, 15],
                    economic: [8, 9, 10, 11],
                    institutional: [16, 17],
                    urban: [11, 9]
                };

                // Mengambil semua checkbox filter
                const checkboxesFilter = document.querySelectorAll('.filter-checkbox');

                // Menambahkan event listener untuk checkbox filter
                checkboxesFilter.forEach(checkbox => {
                    checkbox.addEventListener('change', filterItems);
                });

                // Fungsi untuk memfilter item berdasarkan checkbox yang dipilih
                function filterItems() {
                    const sdgItems = document.querySelectorAll('.image-container');
                    const selectedCategories = Array.from(checkboxesFilter)
                        .filter(checkbox => checkbox.checked)
                        .map(checkbox => {
                            if (checkbox.id === 'socialImpact') return 'social';
                            if (checkbox.id === 'environmentalImpact') return 'environmental';
                            if (checkbox.id === 'economicImpact') return 'economic';
                            if (checkbox.id === 'institutionalCollaborative') return 'institutional';
                            if (checkbox.id === 'urbanCommunityDevelopment') return 'urban';
                        });

                    sdgItems.forEach(item => {
                        const sdgId = item.getAttribute('data-sdg');
                        const shouldDisplay = selectedCategories.length === 0 || selectedCategories.some(category => sdgIdsByCategory[category].includes(parseInt(sdgId)));
                        if (shouldDisplay) {
                            item.classList.remove('hide'); // Remove the hide class to display the image
                        } else {
                            item.classList.add('hide'); // Add the hide class to hide the image
                        }
                    });
                }

                // Fungsi untuk menghitung jumlah checkbox SDG yang dipilih
                function updateCheckboxCount() {
                    const categorySelectedSpan = document.getElementById('category-selected');
                    const checkboxes = document.querySelectorAll('.sdg-checkbox-img');
                    const checkedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
                    categorySelectedSpan.textContent = `${checkedCount} Categories Selected`;
                }

                $('#next-to-indicator-section').on('click', function() {
                    $('#sdg-section').hide();
                    $('#indicator-section').show();

                    var selectedSdgIds = $('.sdg-checkbox-img:checked').map(function() {
                        var sdgId = $(this).val();
                        $('#goal' + sdgId + '-description').show();
                    }).get();
                    console.log(selectedSdgIds);
                    updateBreadcrumb('indikator');
                });

                $('#back-to-sdg-section').on('click', function() {
                    $('#indicator-section').hide();
                    $('#sdg-section').show();
                    updateBreadcrumb('sdg');
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                $('.tag-button').click(function() {
                    var $button = $(this);
                    var tagId = $button.data('tag-id');
                    var $checkbox = $('#tag' + tagId);

                    // Toggle the selected state
                    $button.toggleClass('selected');

                    // Sync the checkbox with the button state
                    $checkbox.prop('checked', $button.hasClass('selected'));
                });

                // Initialize button states based on checkboxes
                $('.form-check-input').each(function() {
                    var $checkbox = $(this);
                    var tagId = $checkbox.val();
                    var $button = $('button[data-tag-id="' + tagId + '"]');

                    if ($checkbox.prop('checked')) {
                        $button.addClass('selected');
                    }
                });
            });
        </script>

        {{-- style terbaru javascript dari list group --}}
        <script>
            // Script untuk menampilkan dan menyembunyikan konten
            document.querySelectorAll('.list-group-item').forEach(item => {
                item.addEventListener('click', function() {
                    const targetId = this.getAttribute('data-target');
                    const content = document.querySelector(targetId);
                    content.style.display = content.style.display === 'none' ? 'block' : 'none';
                });
            });

            // Script untuk menampilkan dan menyembunyikan sub-container indikator
            document.querySelectorAll('.indicator-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const subContainerId = this.getAttribute('data-target');
                    const subContainer = document.getElementById(subContainerId);
                    subContainer.style.display = this.checked ? 'block' : 'none';
                });
            });
        </script>

        {{-- Campur aduk antara indikator, metriks, review --}}
        <script>
           // Event listener untuk checkbox indikator
            $('.indicator-checkbox').on('change', function() {
                var subContainerId = $(this).data('target');
                var subContainer = $('#' + subContainerId);

                if ($(this).is(':checked')) {
                    subContainer.show(); // Menampilkan sub-container
                } else {
                    subContainer.hide(); // Menyembunyikan sub-container
                }
            });
            $(document).ready(function() {
                var index = 1;
                $(".btn-add-pelanggan").click(function() {
                    var newRow = '<tr>' +
                        '<td><input type="text" class="form-control" name="target_pelanggans[' + index +
                        '][status]" required></td>' +
                        '<td><input type="text" class="form-control" name="target_pelanggans[' + index +
                        '][rentang_usia]" required></td>' +
                        '<td><textarea class="form-control" name="target_pelanggans[' + index +
                        '][deskripsi_pelanggan]" required></textarea></td>' +
                        '<td><button type="button" class="btn btn-danger btn-remove-pelanggan"><i class="fa-solid fa-minus" style="color: #ffffff;"></i></button></td>' +
                        '</tr>';
                    $('.target-pelanggan tbody').append(newRow);
                    index++;
                });

                $(document).on('click', '.btn-remove-pelanggan', function() {
                    $(this).closest('tr').remove();
                });

                // Fungsi untuk menghapus format Rupiah
                function removeFormatRupiah(angka) {
                    return angka.replace(/[^,\d]/g, '');
                }

                // Fungsi untuk memformat input menjadi Rupiah
                function formatRupiah(angka) {
                    if (angka == '') {
                        return '';
                    }

                    var number_string = angka.replace(/[^,\d]/g, '').toString(),
                        split = number_string.split(','),
                        sisa = split[0].length % 3,
                        rupiah = split[0].substr(0, sisa),
                        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                    if (ribuan) {
                        separator = sisa ? '.' : '';
                        rupiah += separator + ribuan.join('.');
                    }

                    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
                    return 'Rp. ' + rupiah;
                }

                // Update jumlah pendanaan saat input berubah
                $("#jumlah_pendanaan_display").on('input', function() {
                    var nominal = $(this).val();
                    var originalValue = removeFormatRupiah(nominal);
                    $(this).val(formatRupiah(originalValue));
                    $("#jumlah_pendanaan").val(originalValue);
                });

                // Tombol Next ke SDG section ditambahkan check input required
                $('#next-to-sdg-section').on('click', function() {
                    // Validasi section form-section sebelum pindah
                    if (validationSection('form-section')) {
                        $('#form-section').hide();
                        $('#buatproject').hide();
                        $('#sdg-section').show();
                        updateBreadcrumb('sdg');
                    } else {
                        console.log('Ada field yang kosong');
                        // Tampilkan notifikasi kalau ada field yang kosong
                        document.getElementById('form-notification').style.display = 'block';
                        document.getElementById('popup-overlay').style.display = 'block';
                        document.getElementById('close-notification').addEventListener('click', function() {
                            document.getElementById('form-notification').style.display = 'none';
                            document.getElementById('popup-overlay').style.display = 'none';
                        });
                        window.scrollTo(0, 0); // Scroll ke atas untuk menampilkan notifikasi
                    }
                });

                $('#back-to-form-section').on('click', function() {
                    $('#sdg-section').hide();
                    $('#form-section').show();
                    $('#buatproject').show();
                    updateBreadcrumb('project');
                });

                $('#next-to-metric-section').on('click', function() {
                    $('#indicator-section').hide();
                    $('#metric-section').show();
                    updateBreadcrumb('metrics');
                });

                $('#next-to-review-section').on('click', function() {
                    $('#metric-section').hide();
                    $('#review-section').show();
                    updateBreadcrumb('review');
                });

                $('#back-to-metric-section').on('click', function() {
                    $('#review-section').hide();
                    $('#metric-section').show();
                    updateBreadcrumb('metrics');
                });


                // Fungsi untuk mendapatkan SDG yang dipilih
                function getSelectedSdgs() {
                    return $('.sdg-checkbox-img:checked').map(function() {
                        return $(this).val();
                    }).get(); // Mengembalikan array dari nilai checkbox yang terpilih
                }

                function countSelectedIndicators() {
                    var selectedSdgs = getSelectedSdgs();

                    // Buat objek untuk menyimpan jumlah indikator terpilih per SDG
                    var selectedIndicatorsCountBySdg = {};

                    // Pastikan selectedSdgs adalah array
                    if (!Array.isArray(selectedSdgs)) {
                        selectedSdgs = [];
                    }

                    // Hitung jumlah indikator yang terpilih berdasarkan SDG yang dipilih
                    $('.indicator-checkbox').each(function() {
                        var indicatorSdgId = $(this).data('sdg'); // Ambil sdg_id dari checkbox
                        if (selectedSdgs.includes(indicatorSdgId.toString()) && $(this).is(':checked')) {
                            // Jika SDG ini belum ada di objek, inisialisasi dengan 0
                            if (!selectedIndicatorsCountBySdg[indicatorSdgId]) {
                                selectedIndicatorsCountBySdg[indicatorSdgId] = 0;
                            }
                            selectedIndicatorsCountBySdg[indicatorSdgId]++;
                        }
                    });

                    // Perbarui tampilan jumlah indikator terpilih untuk setiap SDG
                    for (var sdgId in selectedIndicatorsCountBySdg) {
                        $('.selected-' + sdgId).text(selectedIndicatorsCountBySdg[sdgId] + ' Selected');
                    }

                    // Reset counter untuk SDG yang tidak dipilih
                    $('.sdg-checkbox-img').each(function() {
                        var sdgId = $(this).val();
                        if (!selectedSdgs.includes(sdgId)) {
                            $('.selected-' + sdgId).text('0 Selected'); // Reset ke 0 jika SDG tidak dipilih
                        }
                    });
                }

                // Fungsi untuk memperbarui visibilitas indikator dan elemen <li> berdasarkan SDG yang dipilih
                function updateIndicatorVisibility() {
                    var selectedSdgs = getSelectedSdgs();
                    console.log("Selected SDGs: ", selectedSdgs); // Debugging

                    // Menyembunyikan elemen <li> untuk SDG yang tidak dipilih
                    $('.list-group-item').each(function() {
                        var sdgId = $(this).data('target').replace('#content', ''); // Mengambil ID SDG dari data-target
                        if (selectedSdgs.includes(sdgId.toString())) {
                            $(this).show(); // Tampilkan elemen <li> jika SDG dipilih
                        } else {
                            $(this).hide(); // Sembunyikan elemen <li> jika SDG tidak dipilih
                            // Sembunyikan konten terkait SDG yang dihapus
                            $('#content' + sdgId).hide(); // Sembunyikan konten
                        }
                    });

                    // Memperbarui visibilitas indikator
                    $('.indicator').each(function() {
                        var indicatorSdgId = $(this).find('.indicator-checkbox').data('sdg'); // Ambil sdg_id dari checkbox
                        if (selectedSdgs.includes(indicatorSdgId.toString())) {
                            $(this).show(); // Tampilkan indikator jika sdg_id sesuai
                        } else {
                            $(this).hide(); // Sembunyikan indikator
                            $(this).find('.indicator-checkbox').prop('checked', false); // Uncheck checkbox
                            $(this).find('.sub-container').hide(); // Sembunyikan sub-container
                            $(this).find('.sub-container input[type="checkbox"]').prop('checked', false); // Uncheck child checkboxes
                            countSelectedIndicators();
                        }
                    });

                    // Jika tidak ada SDG yang dipilih, sembunyikan semua elemen terkait
                    if (selectedSdgs.length === 0) {
                        $('.list-group-item').hide(); // Sembunyikan semua elemen <li>
                        $('.indicator').hide(); // Sembunyikan semua indikator
                    }
                }

                // Panggil fungsi untuk menghitung indikator yang dipilih
                countSelectedIndicators();

                // Ketika SDG checkbox diubah
                $('.sdg-checkbox-img').on('change', function() {
                    updateIndicatorVisibility();
                    countSelectedIndicators(); // Panggil untuk menghitung indikator setelah memperbarui visibilitas
                });

                // Event listener untuk checkbox indikator
                $(document).on('change', '.indicator-checkbox', function() {
                    var subContainerId = $(this).data('target');
                    var subContainer = $('#' + subContainerId);

                    if ($(this).is(':checked')) {
                        subContainer.show(); // Menampilkan sub-container
                    } else {
                        subContainer.hide(); // Menyembunyikan sub-container
                        subContainer.find('input[type="checkbox"]').prop('checked', false); // Uncheck child checkboxes
                    }
                    countSelectedIndicators(); // Panggil untuk menghitung indikator setelah perubahan
                });

                // Inisialisasi tampilan saat halaman dimuat
                updateIndicatorVisibility();

                // Masuk section indicator
                $('#next-to-indicator-section').on('click', function() {
                    const projectName = $('#nama').val();
                    const projectDescription = $('#deskripsi').val();

                    // Mendapatkan gambar SDG yang dipilih
                    const selectedSdgImages = $('.sdg-checkbox-img:checked').map(function() {
                        return $(this).closest('.image-container').find('img').attr('src');
                    }).get();

                    // Menampilkan gambar SDG yang dipilih
                    $('#sdg-images-container').html('');
                    selectedSdgImages.forEach(function(src) {
                        $('#sdg-images-container').append(
                            '<img src="' + src + '" alt="SDG" class="img-fluid mx-2 sdg-goal" style="border-radius: 8px;" data-target="#goal15-description">'
                        );
                    });

                    // Mengosongkan checklist indikator
                    updateIndicatorVisibility(); // Perbarui visibilitas indikator

                    // Fungsi untuk menghitung jumlah checkbox SDG yang dipilih untuk bagian indikator
                    function updateCheckboxCount() {
                        const categorySelectedSpan = document.getElementById('category -selected-indikator');
                        const checkboxes = document.querySelectorAll('.sdg-checkbox-img');
                        const checkedCount = Array.from(checkboxes).filter(checkbox => checkbox.checked).length;
                        categorySelectedSpan.textContent = `${ checkedCount} Categories Selected`;
                    }

                    // Menyembunyikan SDG Section dan menampilkan Indicator Section
                    $('#sdg-section').hide();
                    $('#indicator-section').show();
                    updateBreadcrumb('indikator');
                    updateCheckboxCount();
                });


                $('#back-to-sdg-section').on('click', function() {
                    $('#indicator-section').hide();
                    $('#sdg-section').show();
                    updateBreadcrumb('sdg');
                });


                // Masuk Section indikator
                // Menambahkan untuk menghilangkan checklist indikator yang terkait bila sdg nya tidak dicentang
                $('.sdg-checkbox-img').on('change', function() {
                    var sdgId = $(this).val();
                    $('.goal-description').hide();
                    $('#goal' + sdgId + '-description').show();
                    $('#goal' + sdgId + '-description .sub-container').hide();
                    $('#goal' + sdgId + '-description .sub-container[data-level="2"]').show();

                    // Jika SDG tidak dicentang, hilangkan checklist indikator yang terkait
                    if (!$(this).is(':checked')) {
                        // Temukan semua indikator yang terkait dengan SDG ini
                        var relatedIndicators = $('.indicator-checkbox[data-sdg="' + sdgId + '"]');
                        // Uncheck indikator terkait dan sembunyikan sub-container
                        relatedIndicators.prop('checked', false).closest('.sub-container').hide();
                    }
                });

                // Bagian Indidcator
                $(document).on('change', '.indicator-checkbox', function() {
                    var indicatorId = $(this).val();
                    var subContainer = $('#sub-container-' + indicatorId);
                    if ($(this).is(':checked')) {
                        subContainer.insertAfter($(this).closest('.level-1-indicator')).show();
                    } else {
                        subContainer.hide();
                        subContainer.find('input[type="checkbox"]').prop('checked', false);
                    }
                });

                var checkbox = document.getElementById("subscribe");
                var subContainer = document.getElementById("sub-container");

                checkbox.addEventListener("change", function() {
                    if (checkbox.checked) {
                        subContainer.style.display = "block";
                    } else {
                        subContainer.style.display = "none"; // Corrected to hide when not checked
                    }
                });

                var sdgGoals = document.querySelectorAll(".sdg-goal");

                sdgGoals.forEach(function(goal) {
                    goal.addEventListener("click", function() {
                        var target = document.querySelector(goal.getAttribute("data-target"));
                        var descriptionVisible = target.classList.contains("show");

                        if (!descriptionVisible) {
                            target.classList.remove("hide");
                            target.classList.add("show");
                        } else {
                            target.classList.remove("show");
                            target.classList.add("hide");
                        }
                    });
                });

                setTimeout(function() {
                    var loading = document.getElementById("loading");
                    loading.style.display = "none";
                }, 1000);
            });
            document.addEventListener("DOMContentLoaded", function() {
                var checkbox = document.getElementById("subscribe");
                var subContainer = document.getElementById("sub-container");

                checkbox.addEventListener("change", function() {
                    if (checkbox.checked) {
                        subContainer.style.display = "block"; // Show sub-container when checkbox is checked
                    } else {
                        subContainer.style.display = "none"; // Hide sub-container when checkbox is unchecked
                    }
                });
            });


            // namabah baru ini masuk metrik
            $(document).ready(function() {
                var metricsPerPage = 15; // Jumlah metrik per halaman
                var currentPage = 1; // Halaman saat ini
                var metricsData = []; // Array untuk menyimpan data metrik dari response

                // Fungsi untuk menampilkan metrik pada halaman tertentu
               // Fungsi untuk menampilkan metrik pada halaman tertentu
                function displayMetrics(page) {
                    var startIndex = (page - 1) * metricsPerPage;
                    var endIndex = startIndex + metricsPerPage;
                    var metricsSlice = metricsData.slice(startIndex, endIndex);

                    $('#metrics').empty(); // Kosongkan container metrik terlebih dahulu
                    $.each(metricsSlice, function(index, metric) {
                        var metricHtml = `
                            <div class="card">
                                <div class="card-header">
                                    <div class="header-content">
                                        <div class="header-left">
                                            <div class="checkbox-container">
                                                <input type="checkbox" class="metric-checkbox" name="metric_ids[]" value="${metric.id}">
                                            </div>
                                            <div class="number-container ms-2">
                                                <span>${startIndex + index + 1}</span> <!-- Menampilkan nomor urut -->
                                            </div>
                                        </div>
                                        <div class="header-right">
                                            <strong style="color:#5940CB">(${metric.code}) ${metric.name}</strong>
                                            <div>${metric.definition}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#metrics').append(metricHtml);
                    });

                    // Update pagination links
                    updatePagination();
                }

                // Fungsi untuk membuat dan mengatur tombol-tombol pagination
                function updatePagination() {
                    var totalPages = Math.ceil(metricsData.length / metricsPerPage);
                    var paginationLinks = $('#pagination-links');
                    paginationLinks.empty(); // Kosongkan tombol-tombol pagination terlebih dahulu

                    for (var i = 1; i <= totalPages; i++) {
                        var activeClass = (i === currentPage) ? 'active' : '';
                        var paginationBtn = $('<li class="page-item ' + activeClass +
                            '"><a class="page-link" href="#">' + i + '</a></li>');

                        paginationBtn.on('click', function() {
                            currentPage = parseInt($(this).text()); // Perbarui halaman saat ini
                            displayMetrics(currentPage); // Tampilkan metrik untuk halaman yang diklik
                        });

                        paginationLinks.append(paginationBtn);
                    }
                }

                // Event listener untuk tombol Kembali ke Bagian Indikator
                $('#back-to-indicator-section').on('click', function() {
                    $('#metric-section').hide();
                    $('#indicator-section').show();
                    updateBreadcrumb('indikator');
                });

                // Event listener untuk tombol Simpan dan Lanjutkan ke Bagian Review
                $('#next-to-review-section').on('click', function() {
                    $('#metric-section').hide();
                    $('#review-section').show();
                    updateBreadcrumb('review');
                });

                // Contoh penggunaan AJAX untuk mendapatkan data metrik dari server
                $.ajax({
                    url: '{{ route('projects.filterMetrics') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        tag_ids: selectedTags,
                        indicator_ids: selectedIndicators
                    },
                    success: function(response) {
                        metricsData = response; // Simpan data metrik dari response
                        displayMetrics(currentPage); // Tampilkan metrik untuk halaman pertama
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching metrics:', error);
                        // Handle error case if needed
                    }
                });
                $('.search-container input').on('input', function() {
                    var searchTerm = $(this).val().toLowerCase(); // Ambil nilai pencarian dan ubah menjadi huruf kecil

                    // Menyembunyikan semua metrik
                    $('#metrics .card').each(function() {
                        var metricName = $(this).find('strong').text().toLowerCase(); // Ambil nama metrik dan ubah menjadi huruf kecil
                        var metricDefinition = $(this).find('.sdg-name-metric').text().toLowerCase(); // Ambil definisi metrik

                        // Jika nama atau definisi metrik mengandung istilah pencarian, tampilkan
                        if (metricName.includes(searchTerm) || metricDefinition.includes(searchTerm)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });

            // Menambahkan logika untuk menyesuaikan matriks dengan indikator yang dipilih
            $('#next-to-metric-section').on('click', function() {
                var selectedTags = $('input[name="tag_ids[]"]:checked').map(function() {
                    return $(this).val();
                }).get();
                var selectedIndicators = $('.indicator-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                $(document).ready(function() {
                    var currentPage = 1; // Initial page
                    var totalPages = 1; // Total pages, will be updated after receiving response from server
                    var selectedMetricsIds = {}; // Object to store selected metric IDs
                    var allMetrics = {}; // Object to store all fetched metrics
                    var isFirstLoad = true; // Flag untuk check apakah ini load pertama kali

                    // Fungsi untuk mereset metrik
                    function resetMetrics() {
                        $('#metrics').empty(); // Clear metrics yang sebelumnya ditampilkan
                        selectedMetricsIds = {}; // Reset metrics yang dipilih
                    }

                    var matriksIndeksCount = 0;
                    // Function to fetch metrics based on selected tags and indicators
                    function fetchMetrics() {
                        console.log("matriks Indeks count = ", matriksIndeksCount); // Debugging log
                        // Check jika ini load pertama kali
                        if (isFirstLoad) {
                            resetMetrics();
                            isFirstLoad = false;
                        }
                        $.ajax({
                            url: '{{ route('projects.filterMetrics') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                tag_ids: selectedTags,
                                indicator_ids: selectedIndicators,
                                page: currentPage // Send current page number to server
                            },
                            success: function(response) {
                                console.log("Metrics fetched successfully:", response); // Debugging log
                                if (response.data.length === 0) {
                                    console.log("No metrics found."); // Debugging log
                                }


                                // Iterate through metrics and append to #metrics container
                                $.each(response.data, function(index, metric) {
                                    // Check if this metric is selected
                                    var isChecked = selectedMetricsIds[metric.id] ? 'checked' : '';

                                    // Tentukan warna latar belakang berdasarkan indeks
                                    var backgroundColor = (index % 2 === 0) ? '#ffffff' : '#F0F1F2'; // Abu-abu untuk genap, putih untuk ganjil
                                    console.log("Ini merupakan Index", index)

                                    if(index > matriksIndeksCount){
                                        matriksIndeksCount = index;
                                    } else{
                                        matriksIndeksCount = matriksIndeksCount + 1;
                                    }

                                    var metricHtml = `
                                        <div class="card metric-text" style="background-color: ${backgroundColor};">
                                            <div class="card-header" style="margin-bottom: 0px;">
                                                <div class="header-content">
                                                    <div class="header-left">
                                                        <div class="checkbox-container">
                                                            <input type="checkbox" class="metric-checkbox" name="metric_ids[]" value="${metric.id}" ${isChecked}>
                                                        </div>
                                                        <div class="number-container ms-2">
                                                            <span>${matriksIndeksCount}</span>
                                                        </div>
                                                    </div>
                                                    <div class="header-right">
                                                        <strong style="color:#111928; font-weight:600; font-size:20px; margin-bottom: 8px;">(${metric.code}) ${metric.name}</strong>
                                                        <div class="sdg-name-metric body-1" style="color:#6B7280; width:100%;">${metric.definition}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                    $('#metrics').append(metricHtml);
                                });

                                // Update total pages based on response
                                totalPages = response.last_page;

                                // Update pagination links
                                updatePagination();

                                // Initialize event handlers for newly added checkboxes
                                initializeCheckboxEventHandlers();
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching metrics:', error);
                            }
                        });
                    }

                    function updatePagination() {
                        console.log("Updating pagination..."); // Debugging log
                        $('#pagination-links').empty(); // Clear existing pagination links

                        var startPage = Math.max(currentPage - 5, 1);
                        var endPage = Math.min(currentPage + 5, totalPages);

                        // Add first page button if startPage is greater than 1
                        if (startPage > 1) {
                            $('#pagination-links').append(`
                                <li class="page-item">
                                    <button type="button" class="btn btn-link page-link page-number">1</button>
                                </li>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            `);
                        }

                        // Add next button
                        $('#pagination-links').append(`
                            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}" id="next-page-li">
                                <button type="button" class="btn btn-primary page-link" id="next-page">Berikutnya</button>
                            </li>
                        `);

                        $('#next-page').on('click', function() {
                            if (currentPage < totalPages) {
                                currentPage++;
                                fetchMetrics(); // Fetch metrics for the next page
                            }
                        });
                    }

                    // Function to initialize event handlers for checkboxes
                    function initializeCheckboxEventHandlers() {
                        console.log("Initializing checkbox event handlers..."); // Debugging log

                        // Event handler for checkbox change
                        $('.metric-checkbox').off('change').on('change', function() {
                            var metricId = $(this).val();
                            if ($(this).prop('checked')) {
                                selectedMetricsIds[metricId] = true; // Store the ID in selectedMetricsIds
                            } else {
                                delete selectedMetricsIds[metricId]; // Remove the ID from selectedMetricsIds
                            }
                        });

                        // Make the metric-text div clickable to toggle the checkbox
                        $('.metric-text').off('click').on('click', function() {
                            var checkbox = $(this).find('.metric-checkbox'); // Use find instead of siblings
                            checkbox.prop('checked', !checkbox.prop('checked'));
                            checkbox.trigger('change'); // Trigger the change event
                        });
                    }

                    // Event handler untuk "Kembali" button untuk reset isFirstLoad
                    $('#back-to-indicator-section').on('click', function() {
                        $('#metric-section').hide();
                        $('#indicator-section').show();
                        updateBreadcrumb('indikator');
                        isFirstLoad = true; // Reset flag ke true ketika "Kembali" button ditekan
                    });

                    // Initial fetch for metrics
                    fetchMetrics();

                    $('.search-container input').on('input', function() {
                        var searchTerm = $(this).val().toLowerCase(); // Ambil nilai pencarian dan ubah menjadi huruf kecil

                        // Menyembunyikan semua metrik
                        $('#metrics .card').each(function() {
                            var metricName = $(this).find('strong').text().toLowerCase(); // Ambil nama metrik dan ubah menjadi huruf kecil
                            var metricDefinition = $(this).find('.sdg-name-metric').text().toLowerCase(); // Ambil definisi metrik

                            // Jika nama atau definisi metrik mengandung istilah pencarian, tampilkan
                            if (metricName.includes(searchTerm) || metricDefinition.includes(searchTerm)) {
                                $(this).show();
                            } else {
                                $(this).hide();
                            }
                        });
                    });
                });
            });

            $('#back-to-indicator-section').on('click', function() {
                $('#metric-section').hide();
                $('#indicator-section').show();
                updateBreadcrumb('indikator');
                matriksIndeksCount = 0;
            });

            $(document).ready(function() {

                function getSelectedIndicators() {
                    var selectedIndicators = [];

                    // Loop through each SDG
                    $('.list-group-item').each(function() {
                        var sdgId = $(this).data('target').replace('#content', '');

                        // Loop through each indicator under the SDG
                        $('#content' + sdgId + ' .indicator-checkbox:checked').each(function() {
                            var indicatorOrder = $(this).closest('label').find('span:first').text().trim();
                            var indicatorName = $(this).closest('label').find('span:last').text().trim();
                            selectedIndicators.push({
                                sdgId: sdgId,
                                order: indicatorOrder,
                                name: indicatorName
                            });
                        });
                    });

                    return selectedIndicators;
                }

                function getSelectedMetrics() {
                    var selectedMetrics = [];
                    console.log("Selected Metrics :", selectedMetrics);

                    // Loop through each metric checkbox
                    $('.metric-checkbox:checked').each(function() {
                        var metricId = $(this).val();
                        var metricName = $(this).closest('.metric-text').find('strong').text().trim();
                        var metricDefinition = $(this).closest('.metric-text').find('.sdg-name-metric').text().trim();
                        var metricCode = $(this).closest('.metric-text').find('strong').text().match(/\((.*?)\)/)[1]; // Ambil kode dari teks

                        selectedMetrics.push({
                            id: metricId,
                            name: metricName,
                            definition: metricDefinition,
                            code: metricCode
                        });
                    });

                    return selectedMetrics;
                }

                // Function to update review section with selected project details
                function updateReviewSection() {
                    // Project Name
                    var projectName = $('#nama').val();
                    $('#project-title').text(projectName);

                    // Project Description
                    var projectDescription = $('#deskripsi').val();
                    $('#project-long-description').text(projectDescription);

                    // Selected SDG Images
                    var selectedSdgImages = $('.sdg-checkbox-img:checked').map(function() {
                        return $(this).closest('.image-container').find('img').attr('src');
                    }).get();

                    $('#review-sdg-images-container').html('');
                    selectedSdgImages.forEach(function(src) {
                        $('#review-sdg-images-container').append('<img src="' + src + '" alt="SDG" class="img-fluid mx-2 sdg-goal" style="width: 150px; height: auto;">');
                    });

                    // Selected Indicators
                    var selectedIndicators = getSelectedIndicators(); // Panggil fungsi baru
                    var selectedIndicatorsHtml = '<h4>Selected Indicators:</h4>';

                    if (selectedIndicators.length > 0) {
                        // Kelompokkan indikator berdasarkan SDG
                        var groupedIndicators = {};

                        selectedIndicators.forEach(function(indicator) {
                            if (!groupedIndicators[indicator.sdgId]) {
                                groupedIndicators[indicator.sdgId] = [];
                            }
                            groupedIndicators[indicator.sdgId].push(indicator);
                        });

                        // Buat HTML untuk setiap SDG dan indikatornya
                        for (var sdgId in groupedIndicators) {
                            selectedIndicatorsHtml += '<div class="sdg-group">';
                            selectedIndicatorsHtml += '<h5>SDGs ' + sdgId + '</h5>'; // Header untuk SDG
                            selectedIndicatorsHtml += '<ul class="list-unstyled">';

                            groupedIndicators[sdgId].forEach(function(indicator) {
                                selectedIndicatorsHtml += '<li>' + indicator.order + '. ' + indicator.name + '</li>';
                            });

                            selectedIndicatorsHtml += '</ul>';
                            selectedIndicatorsHtml += '<hr>'; // Pemisah antara SDG
                            selectedIndicatorsHtml += '</div>';
                        }
                    } else {
                        selectedIndicatorsHtml += '<p>No indicators selected.</p>';
                    }

                    $('#selected-indicators-container').html(selectedIndicatorsHtml);

                    // Selected Metrics
                    var selectedMetrics = getSelectedMetrics(); // Panggil fungsi baru
                    var metricsHtml = '<h4>Selected Metrics:</h4>';

                    if (selectedMetrics.length > 0) {
                        // Kelompokkan matriks berdasarkan kategori (misalkan kita menggunakan property 'category')
                        var groupedMetrics = {};

                        selectedMetrics.forEach(function(metric) {
                            var category = metric.category || 'Uncategorized'; // Ganti dengan kategori yang sesuai jika ada
                            if (!groupedMetrics[category]) {
                                groupedMetrics[category] = [];
                            }
                            groupedMetrics[category].push(metric);
                        });

                        // Buat HTML untuk setiap kategori dan matriksnya
                        for (var category in groupedMetrics) {
                            metricsHtml += '<div class="metric-group">';
                            groupedMetrics[category].forEach(function(metric) {
                                metricsHtml += `
                                    <div class="card metric-text">
                                        <div class="card-header" style="margin-bottom: 0px;">
                                            <div class="header-content">
                                                <div class="header-left">
                                                    <div class="checkbox-container">
                                                        <input type="checkbox" class="metric-checkbox" name="metric_ids[]" value="${metric.id}" checked readonly>
                                                    </div>
                                                    <div class="number-container ms-2">
                                                        <span>${metric.code}</span>
                                                    </div>
                                                </div>
                                                <div class="header-right">
                                                    <strong style="color:#111928; font-weight:600; font-size:20px; margin-bottom: 8px;">(${metric.code}) ${metric.name}</strong>
                                                    <div class="sdg-name-metric body-1" style="color:#6B7280; width:100%;">${metric.definition}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`;
                            });
                            metricsHtml += '<hr>'; // Pemisah antara kategori
                            metricsHtml += '</div>';
                        }
                    } else {
                        metricsHtml += '<p>No metrics selected.</p>';
                    }

                    $('#review-selected-metrics').html(metricsHtml);
                }

                // Update review section when the Next or Back buttons are clicked
                $('#next-to-review-section, #back-to-metric-section').on('click', function() {
                    updateReviewSection();
                });

                $('#next-to-review-section').on('click', function() {
                    $('#metric-section').hide();
                    $('#review-section').show();
                    updateBreadcrumb('review');
                });

                $('#back-to-metric-section').on('click', function() {
                    $('#review-section').hide();
                    $('#metric-section').show();
                    updateBreadcrumb('metrics');
                });
            });
        </script>
    </body>
@endsection
