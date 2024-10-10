@extends('layouts.app-hubsubmission')

@section('title', 'Ajukan Innovation Hub Baru')

@section('css')
    <style>
        /* Styling sederhana untuk dropdown */
        select {
            background-color: #343a40; /* Abu-abu gelap */
            color: white;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Styling untuk opsi dropdown */
        option {
            background-color: #343a40; /* Warna sama dengan dropdown */
            color: white;
        }

        /* Styling untuk form dan tombol */
        .form-control {
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-primary:hover {
            background-color: #495057;
            border-color: #495057;
        }
    </style>
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Ajukan Innovation Hub Baru</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan error validasi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('hubs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <!-- Nama Hub -->
            <label for="name">Nama Hub:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>

            <!-- Provinsi -->
            <label for="provinsi">Provinsi:</label>
            <select class="form-control" id="provinsi" name="provinsi" required>
                <option value="" disabled selected>Pilih Provinsi</option>
                <option value="Jawa Barat">Jawa Barat</option>
                <option value="Jawa Tengah">Jawa Tengah</option>
                <option value="Jawa Timur">Jawa Timur</option>
                <option value="DKI Jakarta">DKI Jakarta</option>
                <option value="Banten">Banten</option>
                <option value="Bali">Bali</option>
                <!-- Tambahkan provinsi lainnya sesuai kebutuhan -->
            </select>

            <!-- Kota/Kabupaten -->
            <label for="kota">Kota/Kabupaten:</label>
            <select class="form-control" id="kota" name="kota" required>
                <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                <option value="Bandung">Bandung</option>
                <option value="Semarang">Semarang</option>
                <option value="Surabaya">Surabaya</option>
                <option value="Jakarta">Jakarta</option>
                <option value="Tangerang">Tangerang</option>
                <option value="Denpasar">Denpasar</option>
                <!-- Tambahkan kota/kabupaten lainnya sesuai kebutuhan -->
            </select>

            <!-- Rank -->
            <label for="rank">Rank:</label>
            <input type="number" class="form-control" id="rank" name="rank" value="{{ old('rank') }}">

            <!-- Top Investor Types -->
            <label for="top_investor_types">Top Investor Types:</label>
            <input type="text" class="form-control" id="top_investor_types" name="top_investor_types" value="{{ old('top_investor_types') }}">

            <!-- Top Funding Types -->
            <label for="top_funding_types">Top Funding Types:</label>
            <input type="text" class="form-control" id="top_funding_types" name="top_funding_types" value="{{ old('top_funding_types') }}">

            <!-- Description -->
            <label for="description">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>

            <!-- Facilities -->
            <label for="facilities">Fasilitas (Pisahkan dengan koma):</label>
            <input type="text" class="form-control" id="facilities" name="facilities" value="{{ old('facilities') }}" placeholder="Contoh: Wi-Fi, Lab, Kantin">

            <!-- Programs -->
            <label for="programs">Program (Pisahkan dengan koma):</label>
            <input type="text" class="form-control" id="programs" name="programs" value="{{ old('programs') }}" placeholder="Contoh: Startup Accelerator, Community Development">

           <!-- Alumni (Multiple Dropdown) -->
<label for="alumni">Alumni (Pilih dari perusahaan):</label>
<select class="form-control" id="alumni" name="alumni[]" multiple>
    @foreach($companies as $company)
        <option value="{{ $company->id }}">{{ $company->nama }}</option>
    @endforeach
</select>
<small class="text-muted">Tekan Ctrl (Windows) atau Cmd (Mac) untuk memilih lebih dari satu perusahaan.</small>


        </div>
        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
    </form>
</div>
@endsection
