@extends('layouts.app-investors')
@section('css')
<style>
    /* Global Styles */
    body {
        font-family: Arial, sans-serif;
    }
    .breadcrumb {
        background-color: white;
        padding: 0;
        margin-bottom: 20px;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Investment</li>
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

