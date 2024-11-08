@extends('layouts.app-investors')
@section('css')
<style>
    /* Global Styles */
    body {
        font-family: Arial, sans-serif;
    }

    /* Unique Breadcrumb Styles */
    .investment-breadcrumb {
        margin-top:-40px;
        background-color: white;
        padding: 10px 15px;
        margin-bottom: 70px;
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

    /* Status Styles */
    .status-approved {
        color: #28a745;
    }
</style>
@endsection
@section('content')
<div class="container mt-5">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="investment-breadcrumb">
        <ol class="investment-breadcrumb">
            <li class="investment-breadcrumb-item"><a href="/">Home</a></li>
            <li class="investment-breadcrumb-item active" aria-current="page">Investment</li>
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
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Amount</th>
                    <th>Investment Date</th>
                    <th>Investment Type</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>Report Financial</th>
                    <th>Report Project</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                    <tr>
                        <td>{{ $investment->company->nama }}</td>
                        <td>Rp{{ number_format($investment->amount) }}</td>
                        <td>{{ $investment->investment_date->format('d-m-Y') }}</td>
                        <td>{{ $investment->investment_type_label }}</td>
                        <td class="{{ $investment->status == 'approved' ? 'status-approved' : '' }}">
                            {{ ucfirst($investment->status) }}
                        </td>
                        <td>
                            <a href="{{ route('investments.status', $investment->id) }}" class="btn-view-details">View Details</a>
                        </td>
                        <td>
                            <a href="{{ route('company_finances.index', ['companyId' => $investment->company->id]) }}" class="btn-report">Report Financial</a>
                        </td>
                        <td>
                            @if($investment->company)
                                <a href="{{ route('myproject.myproject', ['company_id' => $investment->company->id]) }}" class="btn-report">Report Project</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
