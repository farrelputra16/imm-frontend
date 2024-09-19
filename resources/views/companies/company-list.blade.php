@extends('layouts.app-table')
{{-- Masukkan style yang dibutuhkan --}}
@push('styles')
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    h2 {
        font-size: 2rem;
        color: #5940CB; /* Mengubah warna tulisan COMPANIES */
        text-align: center; /* Menempatkan tulisan COMPANIES di tengah */
        margin-bottom: 30px;
    }

    /* Search Form Styles */
    form {
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    input[type="text"] {
        font-size: 1rem;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .btn-primary {
        background-color: #5940CB; /* Warna tombol Search */
        color: white; /* Warna teks tombol */
        border: none;
        font-size: 1rem;
        padding: 10px 20px;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #4838b1; /* Warna tombol saat hover */
    }

    /* Table Styles */
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    thead {
        background-color: #5940CB; /* Warna header tabel */
        color: white;
    }

    th, td {
        padding: 15px;
        text-align: left;
        font-size: 1rem;
    }

    tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tbody tr:hover {
        background-color: #f1f1f1;
        cursor: pointer; /* Add cursor pointer to show clickable row */
    }

    td {
        color: #333;
        font-weight: 400;
    }

    th {
        font-weight: 600;
    }
</style>
@endpush



@section('content')
    <h2><b>COMPANIES</b></h2> <!-- Judul COMPANIES di tengah dengan warna #5940CB -->

    <!-- Form Pencarian -->
    <form method="GET" action="{{ route('companies.list') }}" class="mb-4" id="companySearchForm">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="location" class="form-control" placeholder="Location" value="{{ request()->location }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="industry" class="form-control" placeholder="Industry" value="{{ request()->industry }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="departments" class="form-control" placeholder="Departments" value="{{ request()->departments }}">
            </div>
            <div class="col-md-3">  
                <div class="form-group">
                    <select name="funding_type" id="funding_type" class="form-control" required>
                        <option value="" {{ request()->get('funding_type') === null ? 'selected' : '' }}>Funding Type</option>
                        <option value="pre_seed" {{ request()->get('funding_type') === 'pre_seed' ? 'selected' : '' }}>Pre-seed Funding</option>
                        <option value="seed" {{ request()->get('funding_type') === 'seed' ? 'selected' : '' }}>Seed Funding</option>
                        <option value="series_a" {{ request()->get('funding_type') === 'series_a' ? 'selected' : '' }}>Series A Funding</option>
                        <option value="series_b" {{ request()->get('funding_type') === 'series_b' ? 'selected' : '' }}>Series B Funding</option>
                        <option value="series_c" {{ request()->get('funding_type') === 'series_c' ? 'selected' : '' }}>Series C Funding</option>
                        <option value="series_d" {{ request()->get('funding_type') === 'series_d' ? 'selected' : '' }}>Series D Funding</option>
                        <option value="series_e" {{ request()->get('funding_type') === 'series_e' ? 'selected' : '' }}>Series E Funding</option>
                        <option value="debt" {{ request()->get('funding_type') === 'debt' ? 'selected' : '' }}>Debt Funding</option>
                        <option value="equity" {{ request()->get('funding_type') === 'equity' ? 'selected' : '' }}>Equity Funding</option>
                        <option value="convertible_debt" {{ request()->get('funding_type') === 'convertible_debt' ? 'selected' : '' }}>Convertible Debt</option>
                        <option value="grants" {{ request()->get('funding_type') === 'grants' ? 'selected' : '' }}>Grants</option>
                        <option value="revenue_based" {{ request()->get('funding_type') === 'revenue_based' ? 'selected' : '' }}>Revenue-Based Financing</option>
                        <option value="private_equity" {{ request()->get('funding_type') === 'private_equity' ? 'selected' : '' }}>Private Equity</option>
                        <option value="ipo" {{ request()->get('funding_type') === 'ipo' ? 'selected' : '' }}>Initial Public Offering (IPO)</option>
                    </select>
                </div>                
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    <!-- Table -->
    <table class="table table-hover mt-4">
        <thead class="table-light">
            <tr>
                <th>Organization Name</th>
                <th>Founded Date</th>
                <th>Last Funding Date</th>
                <th>Last Funding Type</th>
                <th>Number of Employees</th>
                <th>Industries</th>
                <th>Description</th>
                <th>Job Departments</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr onclick="window.location.href='{{ route('companies.show', $company->id) }}'">
                    <td>{{ $company->nama }}</td>
                    <td>{{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('F j, Y') : 'N/A' }}</td>
                    <td>{{ $company->latest_income_date ? \Carbon\Carbon::parse($company->latest_income_date)->format('F j, Y') : 'N/A' }}</td>
                    <td>
                        @if ($company->latest_funding_type)
                            <div>
                                {{ $company->latest_funding_type }}
                            </div>
                        @else
                            No funding data available
                        @endif
                    </td>
                    <td>{{ $company->jumlah_karyawan }}</td>
                    <td>{{ $company->tipe }}</td>
                    <td>{{Str::limit( $company->startup_summary, 100, '...') }}</td>
                    <td>{{ $company->posisi_pic }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        document.getElementById('funding_type').addEventListener('change', function() {
            document.getElementById('companySearchForm').submit();
        });
    </script>
@endsection
