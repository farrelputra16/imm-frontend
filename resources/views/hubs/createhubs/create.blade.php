@extends('layouts.app-landingpage')

@section('title', 'Ajukan Innovation Hub Baru')

@section('css')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 2.5rem;
            color: #6c757d;
        }
        .header h1 span {
            color: #6f42c1;
        }
        .header h2 {
            font-size: 1.5rem;
            color: #6f42c1;
        }
        .form-section {
            margin-bottom: 30px;
        }
        .form-section h3 {
            font-size: 1.25rem;
            color: #343a40;
            margin-bottom: 15px;
        }
        .form-control, .form-select {
            margin-bottom: 15px;
        }
        select {
            background-color: #6256CA;
            color: white;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            box-sizing: border-box;
        }
        .btn-primary {
            background-color: #6256CA;
            border-color: #6256CA;
        }
        .btn-primary:hover {
            background-color: #495057;
            border-color: #495057;
        }
    </style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="header">
        <h1>Innovation <span>Hub</span></h1>
        <h2>Innovation Hub (InnovHub) Creation Application Form</h2>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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

        <div class="form-section">
            <h3>Innovation Hub Proposal Description</h3>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Proposed Innovation Hub Name" required>
                </div>
                <div class="col-md-6">
                    <label for="provinsi">Provinsi:</label>
                    <select id="provinsi" name="provinsi" class="form-select" required>
                        <option value="" disabled selected>Pilih Provinsi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="kota">Kota/Kabupaten:</label>
                    <select id="kota" name="kota" class="form-select" required>
                        <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Proposed Design and Facilities</h3>
            <div class="row">
                <div class="col-md-6">
                    <select name="facilities" class="form-select">
                        <option selected>Choose your type facilities</option>
                        <option value="Coworking Space">Coworking Space</option>
                        <option value="StartUp Incubation Space">StartUp Incubation Space</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" name="location_size" class="form-control" placeholder="Location Size">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Operational Plan</h3>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="operating_hours" class="form-control" placeholder="Operating Hours">
                </div>
                <div class="col-md-6">
                    <input type="text" name="funding_sources" class="form-control" placeholder="Funding Model (Investment, Sponsorship, Others)">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="market_and_promotion_plan" class="form-control" placeholder="Marketing and Promotion Plan">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Impact Analysis</h3>
            <div class="row">
                <div class="col-md-12">
                    <input type="text" name="target_participant" class="form-control" placeholder="Target Participants (Startups, Freelancers, SMEs, etc.)">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <input type="number" name="estimated_user" class="form-control" placeholder="Estimated Number of Users per Year">
                </div>
                <div class="col-md-6">
                    <input type="text" name="benefit" class="form-control" placeholder="Expected Benefits to the Community/Industry">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3>Budget and Funding</h3>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="estimated_setup_cost" class="form-control" placeholder="Total Estimated Setup Costs">
                </div>
                <div class="col-md-6">
                    <input type="text" name="funding_sources" class="form-control" placeholder="Available Funding Sources">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <select name="investor_id" class="form-select">
                        <option value="">Select Investor</option>
                        @foreach($investors as $investor)
                            <option value="{{ $investor->id }}">{{ $investor->display_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="submit-btn">
            <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const provinsiSelect = document.getElementById('provinsi');
        const kotaSelect = document.getElementById('kota');
        let provincesData = [];

        // Fetch Provinsi
        async function fetchProvinces() {
            try {
                const response = await fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json');
                if (!response.ok) throw new Error('Network response was not ok');

                provincesData = await response.json();
                provincesData.forEach(provinsi => {
                    const option = document.createElement('option');
                    option.value = provinsi.name;
                    option.textContent = provinsi.name;
                    option.dataset.id = provinsi.id;
                    provinsiSelect.appendChild(option);
                });
            } catch (error) {
                console.error('Error fetching provinces:', error);
            }
        }

        // Populate Cities based on selected province
        async function populateCities() {
            const selectedProvinsiName = provinsiSelect.value;
            const selectedProvinsiId = getProvinsiIdByName(selectedProvinsiName);
            if (!selectedProvinsiId) return;

            kotaSelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';

            try {
                const regenciesUrl = `https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`;
                const response = await fetch(regenciesUrl);
                if (!response.ok) throw new Error('Network response was not ok');

                const regencies = await response.json();
                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.name;
                    option.textContent = regency.name;
                    kotaSelect.appendChild(option);
                });
            } catch (error) {
                console.error(`Error fetching regencies for provinsi ${selectedProvinsiId}:`, error);
            }
        }

        // Get province ID by name
        function getProvinsiIdByName(name) {
            const provinsi = provincesData.find(provinsi => provinsi.name === name);
            return provinsi ? provinsi.id : null;
        }

        // Event listener for province selection
        provinsiSelect.addEventListener('change', populateCities);

        // Initial fetch of provinces
        fetchProvinces();
    });
</script>


@endsection

