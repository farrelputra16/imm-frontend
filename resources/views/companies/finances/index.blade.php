@extends('layouts.app-imm')
@section('title', 'Halaman Perusahaan')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<style>
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
    .add-new-link {
        background-color: #6f42c1;
        color: white;
        border: none;
        padding: 0.375rem 1.5rem; /* Increase padding for wider button */
        border-radius: 0.25rem;
        white-space: nowrap; /* Prevent text from wrapping */
        text-decoration: none !important; /* Remove underline with !important */
        display: inline-block; /* Make it behave like a button */
        cursor: pointer; /* Change cursor on hover */
    }

    .add-new-link:hover{
        color: #ffffff;
    }

    th:nth-child(2),
    td:nth-child(2) {
        width: 10%; /* Organization Name */
    }

    th:nth-child(7),
    td:nth-child(7) {
        width: 10%; /* Industries */
        text-align: center;
    }

    th:nth-child(8),
    td:nth-child(8) {
        width: 20%; /* Industries */
        text-align: center;
    }
</style>
@endsection
@section('content')
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

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="header-title" style="color: #6256CA">Financial Management</h2>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <h4 class="sub-title">Report Overview</h4>
        <div class="d-flex align-items-center">
            <div class="search-container" style="margin-right:10px; margin-bottom: 0px;">
                <i class="fas fa-search" style="margin-left: 10px;"></i>
                <form method="GET" action="{{ route('company_finances.index', ['companyId' => $companyId]) }}">
                    <input class="form-control" placeholder="Search finance" type="text" style="border: none;" name="search_finance" id="search_finance" value="{{ request('search_finance') }}">
                    <input type="hidden" name="rows" value="{{ request('rows', 10) }}">
                </form>
            </div>
            @if ($isUserRole)
                <a href="{{ route('company_finances.create',['companyId' => $companyId]) }}" class="add-new-link" style="text-decoration: none;">Add New</a>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive" style="margin-bottom: 0px;">
                <table id="finance-table" class="table table-hover table-strip mt-3" style="margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">No.</th>
                            <th scope="col" style="vertical-align: middle;">Tahun dan Quarter</th>
                            <th scope="col" style="vertical-align: middle;">Total Pendapatan</th>
                            <th scope="col" style="vertical-align: middle;">Laba Kotor</th>
                            <th scope="col" style="vertical-align: middle;">Laba Usaha</th>
                            <th scope="col" style="vertical-align: middle;">Laba Sebelum Pajak</th>
                            <th scope="col" style="vertical-align: middle;">Laba Bersih Tahun Berjalan</th>
                            <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Tanggal Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($finances->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center" style="border-left: 1px solid #BBBEC5; border-right: 1px solid #BBBEC5;">Tidak ada data pendapatan</td>
                            </tr>
                        @else
                            @foreach ($finances as $finance)
                            <tr>
                                <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">{{ $loop->iteration + ($finances->currentPage() - 1) * $finances->perPage() }}</td>
                                <td style="vertical-align: middle;">{{ $finance->status_quarter }} {{ $finance->tahun }}</td>
                                <td style="vertical-align: middle;">Rp{{ number_format($finance->total_pendapatan, 0, ',', '.') }}</td>
                                <td style="vertical-align: middle;">Rp{{ number_format($finance->laba_kotor, 0, ',', '.') }}</td>
                                <td style="vertical-align: middle;">Rp{{ number_format($finance->laba_usaha, 0, ',', '.') }}</td>
                                <td style="vertical-align: middle;">Rp{{ number_format($finance->laba_sebelum_pajak, 0, ',', '.') }}</td>
                                <td style="vertical-align: middle;">Rp{{ number_format($finance->laba_bersih_tahun_berjalan, 0, ',', '.') }}</td>
                                <td style="vertical-align: middle; border-right: 1px solid #BBBEC5;">{{ $finance->created_at ? \Carbon\Carbon::parse($finance->created_at)->format('j M, Y') : 'N/A' }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- Footer sebagai bagian dari tabel -->
            <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
                <form method="GET" action="{{ route('company_finances.index', ['companyId' => $companyId]) }}" class="mb-0">
                    <div class="d-flex align-items-center">
                        <label for="rowsPerPage" class="me-2">Rows per page:</label>
                        <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()" style="width: 50px; margin-left: 5px; margin-right: 5px;">
                            <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                            <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <div>
                            @if ($finances->total() > 0)
                                <span>Total {{ $finances->firstItem() }} - {{ $finances->lastItem() }} of {{ $finances->total() }}</span>
                            @else
                                <span>Tidak ada data yang tersedia.</span>
                            @endif
                        </div>
                    </div>
                </form>
                <div>
                    {{ $finances->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
