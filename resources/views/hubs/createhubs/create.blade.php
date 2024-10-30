@extends('layouts.app-hubsubmission')

@section('title', 'Ajukan Innovation Hub Baru')

@section('css')
<style>
    select {
        background-color: #343a40;
        color: white;
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        width: 100%;
        box-sizing: border-box;
    }

    option {
        background-color: #343a40;
        color: white;
    }

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

    /* Dynamic fields button styling */
    .add-field-btn {
        background-color: #343a40;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 10px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Ajukan Innovation Hub Baru</h1>

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

    <form id="hub-form" action="{{ route('hubs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama Hub:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>

            <label for="provinsi">Provinsi:</label>
            <select class="form-control" id="provinsi" name="provinsi" required>
                <option value="" disabled selected>Pilih Provinsi</option>
            </select>

            <label for="kota">Kota/Kabupaten:</label>
            <select class="form-control" id="kota" name="kota" required>
                <option value="" disabled selected>Pilih Kota/Kabupaten</option>
            </select>

            <label for="rank">Rank:</label>
            <input type="number" class="form-control" id="rank" name="rank" value="{{ old('rank') }}">

            <label for="top_investor_types">Top Investor Types:</label>
            <input type="text" class="form-control" id="top_investor_types" name="top_investor_types" value="{{ old('top_investor_types') }}">

            <label for="top_funding_types">Top Funding Types:</label>
            <input type="text" class="form-control" id="top_funding_types" name="top_funding_types" value="{{ old('top_funding_types') }}">

            <label for="description">Deskripsi:</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>

            <!-- Dynamic Facilities Field -->
            <label>Fasilitas:</label>
            <div id="facilities-wrapper">
                <div class="d-flex align-items-center mb-2">
                    <input type="text" class="form-control" name="facilities[]" placeholder="Contoh: Wi-Fi, Lab, Kantin">
                    <button type="button" class="add-field-btn" onclick="addField('facilities-wrapper', 'facilities[]')">+</button>
                </div>
            </div>

            <!-- Dynamic Programs Field -->
            <label>Program:</label>
            <div id="programs-wrapper">
                <div class="d-flex align-items-center mb-2">
                    <input type="text" class="form-control" name="programs[]" placeholder="Contoh: Startup Accelerator, Community Development">
                    <button type="button" class="add-field-btn" onclick="addField('programs-wrapper', 'programs[]')">+</button>
                </div>
            </div>

            <!-- Alumni Field with Tagging Feature -->
            <label for="alumni">Alumni:</label>
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
    const provinsiSelect = document.getElementById('provinsi');
    const kotaSelect = document.getElementById('kota');
    let provincesData = [];

    // Fetch Provinsi
    fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json')
        .then(response => response.json())
        .then(provinces => {
            provincesData = provinces;
            provinces.forEach(provinsi => {
                const option = document.createElement('option');
                option.value = provinsi.name;
                option.textContent = provinsi.name;
                option.dataset.id = provinsi.id;
                provinsiSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching provinces:', error));

    // Populate Cities
    function populateCities() {
        const selectedProvinsiName = provinsiSelect.value;
        const selectedProvinsiId = getProvinsiIdByName(selectedProvinsiName);
        const regenciesUrl = `https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`;

        kotaSelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';
        fetch(regenciesUrl)
            .then(response => response.json())
            .then(regencies => {
                regencies.forEach(regency => {
                    const option = document.createElement('option');
                    option.value = regency.name;
                    option.textContent = regency.name;
                    kotaSelect.appendChild(option);
                });
            })
            .catch(error => console.error(`Error fetching regencies for provinsi ${selectedProvinsiId}:`, error));
    }

    function getProvinsiIdByName(name) {
        const provinsi = provincesData.find(provinsi => provinsi.name === name);
        return provinsi ? provinsi.id : null;
    }

    provinsiSelect.addEventListener('change', populateCities);

    // Add Dynamic Field
    function addField(wrapperId, fieldName) {
        const wrapper = document.getElementById(wrapperId);
        const newField = document.createElement('div');
        newField.classList.add('d-flex', 'align-items-center', 'mb-2');
        newField.innerHTML = `<input type="text" class="form-control" name="${fieldName}" placeholder="Masukkan ${wrapperId === 'facilities-wrapper' ? 'Fasilitas' : 'Program'}">
                              <button type="button" class="add-field-btn" onclick="removeField(this)">-</button>`;
        wrapper.appendChild(newField);
    }

    // Remove Dynamic Field
    function removeField(button) {
        button.parentNode.remove();
    }

    // Concatenate facilities, programs, and alumni into strings before submission
    document.getElementById('hub-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const facilitiesFields = document.querySelectorAll('input[name="facilities[]"]');
        const programsFields = document.querySelectorAll('input[name="programs[]"]');
        const alumniSelect = document.getElementById('alumni');

        const facilities = Array.from(facilitiesFields).map(input => input.value).join(',');
        const programs = Array.from(programsFields).map(input => input.value).join(',');

        const alumni = Array.from(alumniSelect.selectedOptions).map(option => option.value).join(',');

        // Set values as hidden fields for the server
        const facilitiesInput = document.createElement('input');
        facilitiesInput.type = 'hidden';
        facilitiesInput.name = 'facilities';
        facilitiesInput.value = facilities;

        const programsInput = document.createElement('input');
        programsInput.type = 'hidden';
        programsInput.name = 'programs';
        programsInput.value = programs;

        const alumniInput = document.createElement('input');
        alumniInput.type = 'hidden';
        alumniInput.name = 'alumni';
        alumniInput.value = alumni;

        this.appendChild(facilitiesInput);
        this.appendChild(programsInput);
        this.appendChild(alumniInput);

        this.submit(); // Submit the form
    });
</script>
@endsection
