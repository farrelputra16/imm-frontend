@extends('layouts.app-imm')
@section('title', 'Kelola Pengeluaran')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<style>
    /* Styling tetap sama */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        list-style-type: none;
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
</style>
@endsection

@section('content')
@php
    // Mapping antara funding type dan label yang ingin ditampilkan
    $fundingTypes = [
        'pre_seed' => 'Pre-seed Funding',
        'seed' => 'Seed Funding',
        'series_a' => 'Series A Funding',
        'series_b' => 'Series B Funding',
        'series_c' => 'Series C Funding',
        'series_d' => 'Series D Funding',
        'series_e' => 'Series E Funding',
        'debt' => 'Debt Funding',
        'equity' => 'Equity Funding',
        'convertible_debt' => 'Convertible Debt',
        'grants' => 'Grants',
        'revenue_based' => 'Revenue-Based Financing',
        'private_equity' => 'Private Equity',
        'ipo' => 'Initial Public Offering (IPO)',
    ];
@endphp
<div class="container" style="padding-top: 120px">
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="homepage" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #212B36;">Financial Management</a>
            </li>
        </ol>
    </nav>
</div>

<div class="container my-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="header-title">Financial Management</h1>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="sub-title">Income Overview</h4>
        <div class="d-flex align-items-center">
            <div class="search-container" style="margin-right:10px; margin-bottom: 0px;">
                <i class="fas fa-search" style="margin-left: 10px;"></i>
                <form method="GET" action="{{ route('kelolapengeluaran') }}">
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
                <form method="GET" action="{{ route('kelolapengeluaran') }}" class="mb-0">
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
                            <th scope="col" style="vertical-align: middle;">Budget Plan</th>
                            <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Expense Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
                                <td style="vertical-align: middle;">{{ $project->nama }}</td>
                                <td style="vertical-align: middle;">Rp{{ number_format($project->jumlah_pendanaan, 0, ',', '.') }}</td> <!-- Menampilkan total dana tersedia -->
                                <td style="vertical-align: middle; border-right: 1px solid #BBBEC5;">
                                    <a href="{{ route('homepageimm.detailbiaya', ['project_id' => $project->id]) }}" style="text-decoration: underline;">cek disini</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Footer sebagai bagian dari tabel -->
            <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
                <form method="GET" action="{{ route('kelolapengeluaran') }}" class="mb-0">
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
