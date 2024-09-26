<!-- resources/views/hubs/createhubs/create.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Ajukan Innovation Hub Baru</title>
    <!-- Menambahkan CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h1>Ajukan Innovation Hub Baru</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Menampilkan error validasi -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
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
            </select>

            <!-- Kota/Kabupaten -->
            <label for="kota">Kota/Kabupaten:</label>
            <select class="form-control" id="kota" name="kota" required>
                <option value="" disabled selected>Pilih Kota/Kabupaten</option>
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

            <!-- Organizations -->
            <label for="organization_ids">Organizations:</label>
            <select name="organization_ids[]" id="organization_ids" class="form-control" multiple>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->nama }}</option>
                @endforeach
            </select>

            <!-- People -->
            <label for="people_ids">People:</label>
            <select name="people_ids[]" id="people_ids" class="form-control" multiple>
                @foreach($people as $person)
                    <option value="{{ $person->id }}">{{ $person->name }}</option>
                @endforeach
            </select>

            <!-- Events -->
            <label for="event_ids">Events:</label>
            <select name="event_ids[]" id="event_ids" class="form-control" multiple>
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
    </form>
</div>

<!-- Menambahkan jQuery dan JS Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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

</body>
</html>
