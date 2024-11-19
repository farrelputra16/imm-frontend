@extends('layouts.app-imm')
@section('content')
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<style>
    th:nth-child(1),
    td:nth-child(1) {
        width: 10%; /* Checkbox column */
    }

    th:nth-child(2),
    td:nth-child(2) {
        width: 10%; /* Organization Name */
    }

    th:nth-child(3),
    td:nth-child(3) {
        width: 10%; /* Founded Date */
    }

    th:nth-child(4),
    td:nth-child(4) {
        width: 10%; /* Last Funding Date */
    }

    th:nth-child(5),
    td:nth-child(5) {
        width: 10%; /* Last Funding Type */
    }

    th:nth-child(6),
    td:nth-child(6) {
        width: 10%; /* Employee */
    }

    th:nth-child(7),
    td:nth-child(7) {
        width: 10%; /* Industries */
    }

    th:nth-child(8),
    td:nth-child(8) {
        width: 9%; /* Description */
    }

    th:nth-child(9),
    td:nth-child(9) {
        text-align: start;
        width: 10%; /* Job Departments */
    }

    /* Table Styling */
    .investment-page-table thead th {
        background-color: #6f42c1;
        color: white;
    }
    .investment-page-table tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }

    /* Status Styling */
    .investment-page-status-approved {
        color: green;
    }
    .investment-page-status-rejected {
        color: red;
    }

    /* Form Control Styling */
    .investment-page-form-control,
    .investment-page-form-select {
        border-radius: 10px;
        height: 52px;
        margin-top: 5px;
        padding-left: 15px;
        width: 100%; /* Make the dropdown full width */
    }
</style>
<div class="container">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Investment </a>
            </li>
        </ol>
    </nav>

    <h2>Approve or Reject Investments</h2>

    <!-- Status Filter -->
    <div class="mb-2">
        <label for="filter-status">Filter by Status:</label>
        <select id="filter-status" class="investment-page-form-select form-select" onchange="filterInvestments(this.value)">
            <option value="">All</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Investment Table -->
    @if ($investments->isEmpty())
        <p>No investments found.</p>
    @else
    @php
        $fundingTypes = [
            'Pre Seed' => 'Pre-Seed',
            'seed' => 'Seed',
            'Series A' => 'Series A',
            'Series B' => 'Series B',
            'Series C' => 'Series C',
            'Series D' => 'Series D',
            'Series E' => 'Series E',
            'Series F' => 'Series F',
            'Series G' => 'Series G',
            'Series H' => 'Series H',
            'Series I' => 'Series I',
            'Series J' => 'Series J',
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

        <div class="table-responsive" style="max-width: 100%; width: 100%;">
            <table class="table table-hover table-strip mt-4 investment-page-table" id="investmentTable">
                <thead class="sub-heading-2">
                    <tr>
                        <th scope="col" class="sub-heading-2" style="border-top-left-radius: 20px; vertical-align: top; text-align: center; border-bottom: none;">Investor</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Amount</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Investment Date</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Funding <br> Type</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Investment <br> Type</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Sender</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Origin Bank</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Destination Bank</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Status</th>
                        <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top; text-align: center; border-bottom: none;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($investments->isEmpty())
                        <tr>
                            <td colspan="11" style="text-align: center; vertical-align: middle; border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                                <strong>Tidak ada data yang tersedia.</strong>
                            </td>
                        </tr>
                    @else
                        @foreach($investments as $investment)
                            <tr data-status="{{ $investment->status }}">
                                <td style="vertical-align: middle;">
                                    <div style="display: flex; align-items: center;">
                                        <div style="flex-grow: 1; margin-left: 0px; margin-right: 10px; width: 100px; word-wrap: break-word; word-break: break-word; white-space: normal;"
                                            @if (strlen($investment->investor->org_name) > 10)
                                                title="{{ $investment->investor->org_name }}"
                                                style="cursor: pointer;"
                                            @endif>
                                            <span class="body-2">{{ $investment->investor->org_name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">{{ number_format($investment->amount, 0, ',', '.') }} IDR</td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">{{ \Carbon\Carbon::parse($investment->investment_date)->format('j M, Y') }}</td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $fundingTypes[$investment->funding_type] ?? 'Unknown Funding Type' }}</td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $investment->investment_type_label }}</td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $investment->pengirim }}</td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $investment->bank_asal }}</td>
                                <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $investment->bank_tujuan }}</td>
                                <td class="{{ $investment->status == 'approved' ? 'investment-page-status-approved' : ($investment->status == 'rejected' || $investment->status == 'pending' ? 'investment-page-status-rejected' : '') }}" style="vertical-align: middle; text-align: center;">
                                    {{ ucfirst($investment->status) }}
                                </td>
                                <td style="vertical-align: middle; text-align: center;">
                                    @if ($investment->status == 'pending')
                                        <form action="{{ route('investments.updateStatus', $investment->id) }}" method="POST">
                                            @csrf
                                            <select name="status" class="investment-page-form-control form-control">
                                                <option value="approved">Approve</option>
                                                <option value="rejected">Reject</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                        </form>
                                    @else
                                        <span>{{ ucfirst($investment->status) }}</span>
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
            <form method="GET" action="{{ route('investments.approvals') }}" class="mb-0">
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

<!-- Filter Script -->
<script>
    function filterInvestments(status) {
        const rows = document.querySelectorAll('#investmentTable tbody tr');
        rows.forEach(row => {
            if (status === '' || row.dataset.status === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endsection
