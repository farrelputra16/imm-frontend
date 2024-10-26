@extends('layouts.app-landingpage')

@section('content')

<div class="container">
    <h1 class="my-4">Create New Funding Round</h1>

    <!-- Menampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk membuat funding round baru -->
    <form method="POST" action="{{ route('company.funding_rounds.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Funding Round Name</label>
            <!-- Set as readonly so the user cannot edit -->
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" readonly>
        </div>


        <div class="mb-3">
            <label for="target" class="form-label">Target Amount</label>
            <input type="number" class="form-control" id="target" name="target" value="{{ old('target') }}">
        </div>

        <div class="mb-3">
            <label for="announced_date" class="form-label">Announced Date</label>
            <input type="date" class="form-control" id="announced_date" name="announced_date" value="{{ old('announced_date') }}">
        </div>

        <!-- Tambahkan field funding_stage -->
        <div class="mb-3">
            <label for="funding_stage" class="form-label">Funding Stage</label>
            <select class="form-control" id="funding_stage" name="funding_stage">
                <option value="" {{ old('funding_stage') === null ? 'selected' : '' }}>Tipe Pendanaan</option>
                <option value="pre_seed" {{ old('funding_stage') === 'pre_seed' ? 'selected' : '' }}>Pendanaan Pre-Seed</option>
                <option value="seed" {{ old('funding_stage') === 'seed' ? 'selected' : '' }}>Pendanaan Seed</option>
                <option value="series_a" {{ old('funding_stage') === 'series_a' ? 'selected' : '' }}>Pendanaan Series A</option>
                <option value="series_b" {{ old('funding_stage') === 'series_b' ? 'selected' : '' }}>Pendanaan Series B</option>
                <option value="series_c" {{ old('funding_stage') === 'series_c' ? 'selected' : '' }}>Pendanaan Series C</option>
                <option value="series_d" {{ old('funding_stage') === 'series_d' ? 'selected' : '' }}>Pendanaan Series D</option>
                <option value="series_e" {{ old('funding_stage') === 'series_e' ? 'selected' : '' }}>Pendanaan Series E</option>
                <option value="series_f" {{ old('funding_stage') === 'series_f' ? 'selected' : '' }}>Pendanaan Series F</option>
                <option value="series_g" {{ old('funding_stage') === 'series_g' ? 'selected' : '' }}>Pendanaan Series G</option>
                <option value="series_h" {{ old('funding_stage') === 'series_h' ? 'selected' : '' }}>Pendanaan Series H</option>
                <option value="series_i" {{ old('funding_stage') === 'series_i' ? 'selected' : '' }}>Pendanaan Series I</option>
                <option value="series_j" {{ old('funding_stage') === 'series_j' ? 'selected' : '' }}>Pendanaan Series J</option>
                <option value="venture_series_unknown" {{ old('funding_stage') === 'venture_series_unknown' ? 'selected' : '' }}>Venture - Seri Tidak Diketahui</option>
                <option value="angel" {{ old('funding_stage') === 'angel' ? 'selected' : '' }}>Pendanaan Angel</option>
                <option value="private_equity" {{ old('funding_stage') === 'private_equity' ? 'selected' : '' }}>Ekuitas Swasta</option>
                <option value="debt" {{ old('funding_stage') === 'debt' ? 'selected' : '' }}>Pendanaan Utang</option>
                <option value="convertible_debt" {{ old('funding_stage') === 'convertible_debt' ? 'selected' : '' }}>Utang Konversi</option>
                <option value="grants" {{ old('funding_stage') === 'grants' ? 'selected' : '' }}>Hibah</option>
                <option value="revenue_based" {{ old('funding_stage') === 'revenue_based' ? 'selected' : '' }}>Pendanaan Berbasis Pendapatan</option>
                <option value="ipo" {{ old('funding_stage') === 'ipo' ? 'selected' : '' }}>Penawaran Umum Perdana (IPO)</option>
                <option value="crowdfunding" {{ old('funding_stage') === 'crowdfunding' ? 'selected' : '' }}>Crowdfunding</option>
                <option value="initial_coin_offering" {{ old('funding_stage') === 'initial_coin_offering' ? 'selected' : '' }}>Penawaran Koin Awal</option>
                <option value="undisclosed" {{ old('funding_stage') === 'undisclosed' ? 'selected' : '' }}>Tidak Diketahui</option>
            </select>
        </div>

        <!-- Tambahkan field description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Create Funding Round</button>
    </form>

    <!-- Tombol untuk kembali ke halaman list funding round -->
    <div class="mt-4">
        <a href="{{ route('company.funding_rounds.list') }}" class="btn btn-secondary">Back to Funding Rounds</a>
    </div>
</div>
<script>
    // Ketika DOM siap
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen-elemen yang diperlukan
        const fundingStage = document.getElementById('funding_stage');
        const fundingName = document.getElementById('name');
        const companyName = '{{ $company->name }}'; // Ambil nama perusahaan dari PHP

        // Fungsi untuk mengubah nama funding round secara otomatis
        function updateFundingName() {
            const stageValue = fundingStage.options[fundingStage.selectedIndex].text; // Ambil teks dari stage yang dipilih
            if (stageValue && companyName) {
                fundingName.value = stageValue + ' - ' + companyName; // Gabungkan stage dan nama perusahaan
            }
        }

        // Panggil fungsi saat page load dan saat funding stage berubah
        fundingStage.addEventListener('change', updateFundingName);

        // Set awal nilai nama funding round
        updateFundingName();
    });
 </script>
<script>
   // Ketika DOM siap
   document.addEventListener('DOMContentLoaded', function() {
       // Ambil elemen-elemen yang diperlukan
       const fundingStage = document.getElementById('funding_stage');
       const fundingName = document.getElementById('name');
       const companyName = '{{ $company->nama }}'; // Ambil nama perusahaan dari PHP

       // Fungsi untuk mengubah nama funding round secara otomatis
       function updateFundingName() {
           const stageValue = fundingStage.options[fundingStage.selectedIndex].text; // Ambil teks dari stage yang dipilih
           if (stageValue && companyName) {
               fundingName.value = stageValue + ' - ' + companyName; // Gabungkan stage dan nama perusahaan
           }
       }

       // Panggil fungsi saat page load dan saat funding stage berubah
       fundingStage.addEventListener('change', updateFundingName);

       // Set awal nilai nama funding round
       updateFundingName();
   });
</script>

@endsection
