<!-- resources/views/funding_rounds/start_invest.blade.php -->
@extends('layouts.app-landingpage')

@section('content')

<div class="container mt-5">
    <h1 class="text-center mb-4">Funding Rounds for {{ $company->nama }}</h1>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Target</th>
                    <th>Amount Raised</th>
                    <th>Lead Investor</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fundingRounds as $round)
                    <tr>
                        <td>{{ $round->name }}</td>
                        <td>Rp {{ number_format($round->target, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($round->money_raised, 0, ',', '.') }}</td>
                        <td>
                            @if ($round->leadInvestor)
                                <a href="{{ route('investors.show', $round->leadInvestor->id) }}">
                                    {{ $round->leadInvestor->org_name }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('funding_rounds.show', $round->id) }}" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
