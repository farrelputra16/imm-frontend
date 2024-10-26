@extends('layouts.app-imm')
@section('title', 'Kelola Pengeluaran')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
    /* Styling tetap sama */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        list-style-type: none;
    }

    body {
        padding-top: 115px;
    }

    .tabel {
        background-color: #F7F6FB;
        border-radius: 5px;
    }

    .btn-unggah, .btn-tambah, .btn-tambahdana, .btn-tambah-proyek {
        background-color: #5940CB;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 8px 16px;
    }

    .form-control {
        width: 298px;
    }

    .biaya {
        font-size: 24px;
    }

    a {
        color: black;
    }

    a:hover {
        color: black;
        text-decoration: none;
    }

    input[type="date"],
    input[type="number"] {
        width: 274px;
    }

    .modal-body {
        max-height: 700px;
        overflow-y: auto;
    }

/* Styleing untuk add new dan search */
    .header-title {
        color: #6f42c1;
        font-weight: bold;
    }
    .sub-title {
        color: #6f42c1;
        font-weight: bold;
        margin-top: 20px; /* Add more space between titles */
    }
    .search-input {
        border-radius: 8px;
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
    }
    .add-new-link {
        background-color: #6f42c1;
        color: white;
        border: none;
        padding: 0.375rem 1.5rem; /* Increase padding for wider button */
        border-radius: 0.25rem;
        white-space: nowrap; /* Prevent text from wrapping */
        text-decoration: none; /* Remove underline */
        display: inline-block; /* Make it behave like a button */
    }
    /* breadcumb */
    .breadcrumb {
        background-color: white;
        padding: 0;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        margin-right: 14px;
        color: #9CA3AF;
    }

    .navtabs{
        border: none;
        display: flex; /* Menggunakan flexbox */
        margin-bottom: 32px;
        margin-top: 32px;
        padding: 0; /* Menghapus padding pada nav-tabs */
        gap: 0px;
    }

    /* Gaya untuk tab yang tidak aktif */
    .navlinkexpend {
        color: #000; /* Warna teks default */
        font-size: 24px; /* Ukuran font */
        padding: 10px 20px 10px; /* Padding untuk mengecilkan tab */
        text-align: center; /* Menyelaraskan teks ke tengah */
        background-color: #ffffff; /* Warna latar belakang untuk tab tidak aktif */
        border: none; /* Tanpa border untuk tab tidak aktif */
        border-bottom: 1px solid #dee2e6; /* Border bawah untuk tab tidak aktif */
        border-radius: 0.25rem; /* Sudut melengkung */
        transition: background-color 0.3s; /* Efek transisi saat hover */
    }
    /* Gaya untuk tab yang aktif */
    .nav-link-active {
        color: #000; /* Mengubah warna teks tab aktif menjadi hitam */
        background-color: #ffffff; /* Mengubah latar belakang tab aktif */
        font-size: 24px; /* Ukuran font */
        padding: 10px 20px; /* Padding untuk mengecilkan tab */
        border-top: 1px solid #dee2e6; /* Border atas untuk tab aktif */
        border-left: 2px solid #dee2e6; /* Border kiri untuk tab aktif */
        border-right: 2px solid #dee2e6; /* Border kanan untuk tab aktif */
        border-bottom: none; /* Tanpa border bawah untuk tab aktif */
        border-radius: 0.25rem 0.25rem 0 0; /* Sudut melengkung hanya di atas */
        margin-bottom: -1px; /* Menghindari overlap dengan border bawah tab tidak aktif */
    }
</style>
@endsection

@section('content')
@php
    // Mapping antara funding type dan label yang ingin ditampilkan
    $fundingTypes = [
       'pre_seed' => 'Pre-Seed',
        'seed' => 'Seed',
        'series_a' => 'Series A',
        'series_b' => 'Series B',
        'series_c' => 'Series C',
        'series_d' => 'Series D',
        'series_e' => 'Series E',
        'series_f' => 'Series F', // Jika Anda ingin menambahkan ini
        'series_g' => 'Series G', // Jika Anda ingin menambahkan ini
        'series_h' => 'Series H', // Jika Anda ingin menambahkan ini
        'series_i' => 'Series I', // Jika Anda ingin menambahkan ini
        'series_j' => 'Series J', // Jika Anda ingin menambahkan ini
        'venture_series_unknown' => 'Venture - Seri Tidak Diketahui',
        'angel' => 'Angel',
        'private_equity' => 'Ekuitas Swasta',
        'debt' => 'Utang',
        'convertible_debt' => 'Utang Konversi',
        'grants' => 'Hibah',
        'revenue_based' => 'Berbasis Pendapatan',
        'ipo' => 'Penawaran Umum Perdana (IPO)',
        'crowdfunding' => 'Crowdfunding',
        'initial_coin_offering' => 'Penawaran Koin Awal',
        'undisclosed' => 'Tidak Diketahui',
    ];
@endphp
<div class="container">
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                @if ($isUserRole)
                    <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                @else
                    <a href="{{ route('investments.pending') }}" style="text-decoration: none; color: #212B36;">Home</a>
                @endif
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #212B36;">Financial Management</a>
            </li>
        </ol>
    </nav>

    @if (!$isUserRole)
        <ul class="navtabs">
            <li class="nav-item" style="margin-right: 0px;">
                <a class="navlinkexpend project-reports sub-heading-1" href="{{ route('myproject.myproject', ['company_id' => $company->id]) }}" style="text-decoration: none; color: #212B36;">Project Reports</a>
            </li>
            <li class="nav-item" style="margin-left: 0px;">
                <a class="nav-link-active sub-heading-1" href="{{ route('kelolapengeluaran', ['company_id' => $company->id]) }}" style="text-decoration: none; color: #6256CA;">Expenditure Reports</a>
            </li>
        </ul>
    @endif
</div>

<div class="container my-3" style="margin-top: 32px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        @if ($isUserRole)
            <h2 class="header-title">Financial Management</h2>
        @else
            <h2 class="header-title">Project Reports</h2>
        @endif
    </div>
</div>

@if ($isUserRole) <!-- Jika USER, tampilkan Income Overview -->
    <div class="container my-3">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="sub-title">Income Overview</h4>
            <div class="d-flex align-items-center">
                <div class="search-container" style="margin-right:10px; margin-bottom: 0px;">
                    <i class="fas fa-search" style="margin-left: 10px;"></i>
                    <form method="GET" action="{{ route('kelolapengeluaran', ['company_id' => $company->id]) }}">
                        <input class="form-control" placeholder="Search Income" type="text" style="border: none;" name="search_income" id="search_Income" value="{{ request('search_income') }}">
                        <input type="hidden" name="rows" value="{{ request('rows', 10) }}">
                    </form>
                </div>
                <a href="{{ route('createCompanyIncome') }}" class="add-new-link">Add New</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive" style="margin-bottom: 0px;">
                    <table id="income-table" class="table table-hover table-strip mt-3" style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">No.</th>
                                <th scope="col" style="vertical-align: middle;">Date</th>
                                <th scope="col" style="vertical-align: middle;">Sender</th>
                                <th scope="col" style="vertical-align: middle;">Source Bank</th>
                                <th scope="col" style="vertical-align: middle;">Destination Bank</th>
                                <th scope="col" style="vertical-align: middle;">Amount</th>
                                <th scope="col" style="vertical-align: middle;">Funding Type</th>
                                <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Investment Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($companyIncomes->isEmpty())
                                <tr>
                                    <td colspan="8" class="text-center" style="border-left: 1px solid #BBBEC5; border-right: 1px solid #BBBEC5;">Tidak ada Income</td>
                                </tr>
                            @else
                                @foreach ($companyIncomes as $income)
                                <tr>
                                    <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">{{ $loop->iteration + ($companyIncomes->currentPage() - 1) * $companyIncomes->perPage() }}</td>
                                    <td style="vertical-align: middle;">{{ $income->date ? \Carbon\Carbon::parse($income->date)->format('j M, Y') : 'N/A' }}</td>
                                    <td style="vertical-align: middle;">{{ $income->pengirim }}</td>
                                    <td style="vertical-align: middle;">{{ $income->bank_asal }}</td>
                                    <td style="vertical-align: middle;">{{ $income->bank_tujuan }}</td>
                                    <td style="vertical-align: middle;">Rp{{ number_format($income->jumlah, 0, ',', '.') }}</td>
                                    <td style="vertical-align: middle;">{{ $fundingTypes[$income->funding_type] ?? 'Unknown Funding Type' }}</td>
                                    <td style="vertical-align: middle; border-right: 1px solid #BBBEC5;">
                                        {{ $income->investment_type_label ?? 'Tidak ada tipe investasi' }} <!-- Menggunakan accessor -->
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Footer sebagai bagian dari tabel -->
                <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
                    <form method="GET" action="{{ route('kelolapengeluaran', ['company_id' => $company->id]) }}" class="mb-0">
                        <div class="d-flex align-items-center">
                            <label for="rowsPerPage" class="me-2">Rows per page:</label>
                            <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()" style="width: 50%px; margin-left: 5px; margin-right: 5px;">
                                <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                                <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            <div>
                                <span>Total {{ $companyIncomes->firstItem() }} - {{ $companyIncomes->lastItem() }} of {{ $companyIncomes->total() }}</span>
                            </div>
                        </div>
                    </form>
                    <div>
                        {{ $companyIncomes->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <hr style="border: none; height: 0.2px; background-color: #000000; margin: 64px 0; opacity: 0.2;">
    </div>
@endif


<div class="container my-3">
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="sub-title">Expense Tracker</h4>
        <div class="search-container" style="margin-right:10px; margin-bottom: 0px; width: 300px;">
            <i class="fas fa-search" style="margin-left: 10px;"></i>
            <form method="GET" action="{{ route('searchExpense') }}">
                <input class="form-control" placeholder="Search Expense" type="text" style="border: none;" name="search_expense" id="search_expense" value="{{ request('search_expense') }}">
                <input type="hidden" name="rows" value="{{ request('rows', 10) }}">
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="project-table" class="table table-hover table-strip mt-3" style="margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th scope=" col" style="border-top-left-radius: 20px; vertical-align: middle;">No.</th>
                            <th scope="col" style="vertical-align: middle;">Project Name</th>
                            <th scope="col" style="vertical-align: middle;">Status</th>
                            @if (!$isUserRole)
                                <th scope="col" style="vertical-align: middle;">Budget Plan</th>
                                <th scope="col" style="vertical-align: middle;">Start Date</th>
                                <th scope="col" style="vertical-align: middle;">End Date</th>
                            @endif
                            <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Expense Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                                <td style="vertical-align: middle;">{{ $project->nama }}</td>
                                <td style="vertical-align: middle;">{{ $project->status }}</td> <!-- Menampilkan status proyek -->
                                @if (!$isUserRole)
                                    <td style="vertical-align: middle;">Rp{{ number_format($project->jumlah_pendanaan, 0, ',', '.') }}</td> <!-- Menampilkan total dana tersedia -->
                                    <td style="vertical-align: middle;">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('j M, Y') : 'N/A' }}</td>
                                    <td style="vertical-align: middle;">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('j M, Y') : 'N/A' }}</td>
                                @endif
                                <td style="vertical-align: middle; border-right: 1px solid #BBBEC5; text-align: center  ;">
                                    <a href="{{ route('homepageimm.detailbiaya', ['project_id' => $project->id]) }}" style="text-decoration: underline;">cek disini</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Footer sebagai bagian dari tabel -->
            <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
                <form method="GET" action="{{ route('kelolapengeluaran', ['company_id' => $company->id]) }}" class="mb-0">
                    <div class="d-flex align-items-center">
                        <label for="rowsPerPage" class="me-2">Rows per page:</label>
                        <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()" style="width: 50%px; margin-left: 5px; margin-right: 5px;">
                            <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                            <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <div>
                            <span>Total {{ $projects->firstItem() }} - {{ $projects->lastItem() }} of {{ $projects->total() }}</span>
                        </div>
                    </div>
                </form>
                <div>
                    {{ $projects->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
