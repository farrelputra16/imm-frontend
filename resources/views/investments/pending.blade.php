@extends('layouts.app-investors')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
     /* Mengatur font family untuk seluruh halaman */
    body {
        font-family: 'Poppins', sans-serif; /* Menggunakan Inter untuk isi/content */
    }

    /* Mengatur font family untuk heading */
    h1, h2, h3, h4 {
        font-family: 'Poppins', sans-serif; /* Menggunakan Work Sans untuk heading */
    }

    /* Mengatur font family untuk sub-heading dan body */
    .sub-heading-1, .sub-heading-2, .body-1, .body-2 {
        font-family: 'Poppins', sans-serif; /* Set font to Poppins */
    }

    .container {
        flex: 1; /* Membuat kontainer mengambil ruang yang tersedia */
        max-width: 1400px;
        margin: 0 auto;
    }
    /* Table Styles */
    .table thead th {
        background-color: #6f42c1;
        color: white;
    }
    .table tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }
    .table tbody tr:nth-child(even) {
        background-color: white;
    }

    /* Button Styles */
    .btn-view-details {
        color: #6f42c1;
        text-decoration: underline;
        background: none;
        border: none;
        padding: 0;
    }
    .btn-report {
        background-color: #6f42c1;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
    }

    .btn-report:hover {
        background-color: #5a3ac5;
        color: white;
        text-decoration: none;
    }

    /* Status Styles */
    .status-approved {
        color: #28a745;
    }

     /* bread */
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

<div class="container">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="/" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="javascript:window.history.back();" style="text-decoration: none; color: #212B36;">Investment</a>
            </li>
        </ol>
    </nav>

    <h1 class="fw-bold">Pending Investments</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($investments->isEmpty())
        <p>No pending investments at the moment.</p>
    @else
        <div class="table-responsive mt-4" style="max-width: 100%; width: 100%;">
            <table class="table table-hover table-strip" style="margin-bottom: 0px;">
                <thead class="sub-heading-2">
                    <tr>
                        <th scope="col" class="sub-heading-2" style="border-top-left-radius: 20px; vertical-align: top; text-align: center; border-bottom: none;">Company Name</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Amount</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Investment Date</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Investment Type</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Status</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Action</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Reports Financial</th>
                        <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top; text-align: center; border-bottom: none;">Report Project</th>
                    </tr>
                </thead>
                <tbody>
                    @if($investments->isEmpty())
                        <tr>
                            <td colspan="8" style="text-align: center; vertical-align: middle; border-left: 1px solid #ddd;border-right: 1px solid #ddd;">
                                <strong>Tidak ada data yang tersedia.</strong>
                            </td>
                        </tr>
                    @else
                        @foreach($investments as $investment)
                            <tr>
                                <td style="vertical-align: middle;">
                                    <span class="body-2">{{ $investment->company->nama }}</span>
                                </td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">Rp{{ number_format($investment->amount) }}</td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $investment->investment_date->format('d-m-Y') }}</td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $investment->investment_type_label }}</td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2 {{ $investment->status == 'approved' ? 'status-approved' : '' }}">
                                    {{ ucfirst($investment->status) }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <a href="{{ route('investments.status', $investment->id) }}" class="btn-view-details">View Details</a>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    <a href="{{ route('company_finances.index', ['companyId' => $investment->company->id]) }}" class="btn-report">Report Financial</a>
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    @if($investment->company)
                                        <a href="{{ route('myproject.myproject', ['company_id' => $investment->company->id, 'status' => 'investor']) }}" class="btn-report">Report Project</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <!-- Footer sebagai bagian dari tabel -->
        <div class="d-flex justify-content-between align-items-center mb-3 align-self-center"
        style="padding: 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
            border-top: 1px solid #ddd;
            margin-top:0px;
            border-end-end-radius: 20px;
            border-end-start-radius: 20px;
            height: 60px;
            max-width: 100%;
            ">
            <form method="GET" action="{{ route('investments.pending') }}" class="mb-0">
                <div class="d-flex align-items-center">
                    <label for="rowsPerPage" class="me-2">Rows per page:</label>
                    <select name="rows"
                            id="rowsPerPage"
                            class="form-select me-2"
                            onchange="this.form.submit()"
                            style="width: 50%px; margin-left: 5px; margin-right: 5px;">
                        <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <div>
                        <span>Total {{ $investments->firstItem() }} - {{ $investments->lastItem() }} of {{ $investments->total() }}</span>
                    </div>
                </div>
            </form>
            <div style="margin-top: 10px;">
                {{ $investments->appends(request()->query())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    @endif
</div>
@endsection
