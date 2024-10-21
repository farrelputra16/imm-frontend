@extends('layouts.app-investments')

@section('content')
<div class="container">
    <h1>Pending Investments</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Company</th>
                <th>Amount</th>
                <th>Investment Date</th>
                <th>Funding Type</th>
                <th>Investment Type</th>
                <th>Sender</th>
                <th>Origin Bank</th>
                <th>Destination Bank</th>
                <th>Status</th>
                <th>Report Financial</th>
                <th>Report Project</th>
            </tr>
        </thead>
        <tbody>
            @foreach($investments as $investment)
                <tr>
                    <td>{{ $investment->company->nama }}</td>
                    <td>Rp{{ number_format($investment->amount, 0, ',', '.') }}</td>
                    <td>{{ $investment->investment_date ? \Carbon\Carbon::parse($investment->investment_date)->format('j M, Y') : 'N/A' }}</td>
                    <td>{{ $investment->funding_type }}</td>
                    <td>{{ $investment->investment_type_label }}</td>
                    <td>{{ $investment->pengirim }}</td>
                    <td>{{ $investment->bank_asal }}</td>
                    <td>{{ $investment->bank_tujuan }}</td>
                    <td>{{ ucfirst($investment->status) }}</td>
                    <!-- Bagian untuk Report Project -->
                    <!-- Report Company (biarkan logika ini tetap sesuai kebutuhan Anda) -->
    @if($investments->isEmpty())
        <p>No pending investments at the moment.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Amount</th>
                    <th>Investment Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                    <tr>
                        <td>{{ $investment->company->nama }}</td>
                        <td>Rp{{ number_format($investment->amount) }}</td>
                        <td>{{ $investment->investment_date->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($investment->status) }}</td>
                        <td>
                            <a href="{{ route('investments.status', $investment->id) }}" class="btn btn-info">View Details</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
