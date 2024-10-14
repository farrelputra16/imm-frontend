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
                <!-- Provinsi akan dimuat secara dinamis dari API -->
            </select>

            <!-- Kota/Kabupaten -->
            <label for="kota">Kota/Kabupaten:</label>
            <select class="form-control" id="kota" name="kota" required>
                <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                <!-- Kota/Kabupaten akan dimuat secara dinamis dari API -->
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

<script>
    // Ambil elemen select untuk provinsi dan kota/kabupaten
    const provinsiSelect = document.getElementById('provinsi');
    const kotaSelect = document.getElementById('kota');
    let provincesData = []; // Simpan data provinsi yang di-fetch

    // Fetch data provinsi saat halaman dimuat
    fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json')
        .then(response => response.json())
        .then(provinces => {
            provincesData = provinces; // Simpan data provinsi
            // Iterasi setiap provinsi dan tambahkan sebagai option ke select provinsi
            provinces.forEach(provinsi => {
                const option = document.createElement('option');
                option.value = provinsi.name; // Menggunakan nama sebagai nilai
                option.textContent = provinsi.name;
                option.dataset.id = provinsi.id; // Simpan ID provinsi di dataset
                provinsiSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching provinces:', error));

    // Fungsi untuk memanggil API kota/kabupaten berdasarkan ID provinsi
    function populateCities() {
        const selectedProvinsiName = provinsiSelect.value;
        const selectedProvinsiId = getProvinsiIdByName(selectedProvinsiName);
        const regenciesUrl = `https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`;

        // Kosongkan dropdown kota/kabupaten saat memilih provinsi baru
        kotaSelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';

        // Fetch data kota/kabupaten berdasarkan ID provinsi yang dipilih
        fetch(regenciesUrl)
            .then(response => response.json())
            .then(regencies => {
                // Iterasi setiap kota/kabupaten dan tambahkan sebagai option ke select kota/kabupaten
                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.name; // Menggunakan nama sebagai nilai
                    option.textContent = regency.name;
                    kotaSelect.appendChild(option);
                });
            })
            .catch(error => console.error(`Error fetching regencies for provinsi ${selectedProvinsiId}:`, error));
    }

    // Fungsi untuk mendapatkan ID provinsi berdasarkan nama
    function getProvinsiIdByName(name) {
        const provinsi = provincesData.find(provinsi => provinsi.name === name);
        return provinsi ? provinsi.id : null;
    }

    // Tambahkan event listener untuk dropdown provinsi
    provinsiSelect.addEventListener('change', populateCities);
</script>

@endsection
