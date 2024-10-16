@extends('layouts.app-landingpage')

@section('content')

<div class="container">
    <h1 class="my-4">Funding Rounds for {{ $company->nama }}</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- List Funding Rounds -->
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Target</th>
                <th>Announced Date</th>
                <th>Money Raised</th>
                <th>Lead Investor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fundingRounds as $round)
                <tr>
                    <td>{{ $round->name }}</td>
                    <td>Rp {{ number_format($round->target, 0, ',', '.') }}</td>
                    <td>{{ $round->announced_date ? \Carbon\Carbon::parse($round->announced_date)->format('j M, Y') : 'N/A' }}</td>
                    <td>Rp {{ number_format($round->money_raised, 0, ',', '.') }}</td>
                    <td>{{ $round->leadInvestor->nama ?? 'Not selected' }}</td>
                    <td>
                        <a href="{{ route('company.funding_rounds.detail', $round->id) }}" class="btn btn-primary">View & Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Button untuk Ajukan Funding Round Baru -->
    <div class="mt-4">
        <a href="{{ route('company.funding_rounds.create') }}" class="btn btn-success">Create New Funding Round</a>
    </div>
</div>

@endsection
