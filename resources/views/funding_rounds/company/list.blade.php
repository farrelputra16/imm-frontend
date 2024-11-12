@extends('layouts.app-imm')

@section('content')

<div class="container" style="margin-bottom: 220px;">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" style="margin-top: -40px; background-color: white; padding: 10px 15px; margin-bottom: 40px; border-radius: 5px;">
        <ol class="investment-breadcrumb" style="display: flex; align-items: center; list-style-type: none; padding-left: 0;">
            <li class="investment-breadcrumb-item"><a href="/">Home</a></li>
            <li class="investment-breadcrumb-item active" aria-current="page">Funding Rounds</li>
        </ol>
    </nav>

    <!-- Page Title -->
    <h1 class="fw-bold" style="color: #6256CA; font-size: 2.5rem;">Funding Rounds for {{ $company->nama }}</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Container for Styling -->
    <div class="table-container" style="background-color: white;margin-top:30px;">
        <table class="table investment-page-table table-bordered" style="margin-bottom: 60px;">
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
                        <td>{{ $round->leadInvestor->org_name ?? 'Not selected' }}</td>
                        <td>
                            <a href="{{ route('company.funding_rounds.detail', $round->id) }}" class="btn btn-primary">View & Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Button for New Funding Round -->
    <div class="mt-4">
        <a href="{{ route('company.funding_rounds.create') }}" class="btn btn-success">Create New Funding Round</a>
    </div>
</div>

@endsection

@section('css')
<style>
    .investment-breadcrumb-item + .investment-breadcrumb-item::before {
        content: ">";
        margin-right: 8px;
        color: #6c757d;
    }

    .investment-page-table thead th {
        background-color: #6256CA;
        color: white;
    }

    .investment-page-table tbody tr:nth-child(odd) {
        background-color: #f8f9fa;
    }
</style>
@endsection
