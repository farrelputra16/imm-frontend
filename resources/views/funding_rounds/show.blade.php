@extends('layouts.app-landingpage')

@section('content')
<div class="container">
    <h1>{{ $fundingRound->name }}</h1>
    <p><strong>Target Amount:</strong> {{ number_format($fundingRound->target, 2) }}</p>
    <p><strong>Money Raised:</strong> {{ number_format($fundingRound->money_raised, 2) }}</p>
    <p><strong>Announced Date:</strong> {{ $fundingRound->announced_date ? \Carbon\Carbon::parse($fundingRound->announced_date)->format('j M, Y') : 'N/A' }}</p>
    <p><strong>Lead Investor:</strong> {{ $fundingRound->leadInvestor->org_name ?? 'N/A' }}</p>
    <p><strong>Company:</strong> {{ $fundingRound->company->nama }}</p>
</div>
@endsection
