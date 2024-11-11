@extends('layouts.app-imm')
<style>
    /* Unique class prefix: .investment-page- */

    /* Body and Breadcrumb Styling */
    .investment-breadcrumb {
        margin-top:-40px;
        background-color: white;
        padding: 10px 15px;
        margin-bottom: 40px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        list-style-type: none; /* Remove default numbering */
        padding-left: 0; /* Remove default padding for ordered list */
    }
    .investment-breadcrumb-item {
        margin-right: 8px;
    }
    .investment-breadcrumb-item + .investment-breadcrumb-item::before {
        content: ">";
        margin-right: 8px;
        color: #6c757d; /* Add a lighter color for the separator */
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
        width: 100%; /* Make the dropdown full width */
    }
</style>
@section('content')
<div class="container investment-page-body">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="investment-breadcrumb">
        <ol class="investment-breadcrumb">
            <li class="investment-breadcrumb-item"><a href="/">Home</a></li>
            <li class="investment-breadcrumb-item active" aria-current="page">Investment</li>
        </ol>
    </nav>

    <h1 class="fw-bold" style="font-size: 2.5rem;">Approve or Reject Investments</h1>

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

        <table class="table mt-4 investment-page-table" id="investmentTable" style="margin-bottom:60px;">
            <thead>
                <tr>
                    <th>Investor</th>
                    <th>Amount</th>
                    <th>Investment Date</th>
                    <th>Funding Type</th>
                    <th>Investment Type</th>
                    <th>Sender</th>
                    <th>Origin Bank</th>
                    <th>Destination Bank</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                    <tr data-status="{{ $investment->status }}">
                        <td>{{ $investment->investor->org_name }}</td>
                        <td>{{ number_format($investment->amount, 0, ',', '.') }} IDR</td>
                        <td>{{ \Carbon\Carbon::parse($investment->investment_date)->format('j M, Y') }}</td>
                        <td>{{ $fundingTypes[$investment->funding_type] ?? 'Unknown Funding Type' }}</td>
                        <td>{{ $investment->investment_type_label }}</td>
                        <td>{{ $investment->pengirim }}</td>
                        <td>{{ $investment->bank_asal }}</td>
                        <td>{{ $investment->bank_tujuan }}</td>
                        <td class="{{ $investment->status == 'approved' ? 'investment-page-status-approved' : ($investment->status == 'rejected' ? 'investment-page-status-rejected' : '') }}">
                            {{ ucfirst($investment->status) }}
                        </td>
                        <td>
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
            </tbody>
        </table>
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
