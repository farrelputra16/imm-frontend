@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">

<div class="container-fluid">
    <div class="header d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('landingpage') }}">Home</a> &gt; <a href="#">Funding Rounds</a>
        </div>
    </div>

    <h1 class="header"><b>Funding Rounds</b></h1>

    <div class="row">
        <!-- Table Section -->
        <div class="col-md-12 table-section">
            <div class="search-container">
                <i class="fas fa-search" style="margin-left: 10px;"></i>
                <input class="form-control" placeholder="Search Funding Rounds" type="text" style="border: none;">
                <button class="btn">Search</button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-strip" style="margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">Funding Round Name</th>
                            <th scope="col" style="vertical-align: middle;">Target Amount</th>
                            <th scope="col" style="vertical-align: middle;">Money Raised</th>
                            <th scope="col" style="vertical-align: middle;">Announced Date</th>
                            <th scope="col" style="vertical-align: middle;">Lead Investor</th>
                            <th scope="col" style="vertical-align: middle;">Company Name</th>
                            <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fundingRounds as $fundingRound)
                            <tr data-href="{{ route('funding_rounds.show', $fundingRound->id) }}">
                                <td style="vertical-align: middle;">
                                    <span>{{ $fundingRound->name }}</span>
                                </td>
                                <td style="vertical-align: middle;">{{ $fundingRound->target ? number_format($fundingRound->target, 2) : 'N/A' }}</td>
                                <td style="vertical-align: middle;">{{ $fundingRound->money_raised ? number_format($fundingRound->money_raised, 2) : 'N/A' }}</td>
                                <td style="vertical-align: middle;">{{ $fundingRound->announced_date ? \Carbon\Carbon::parse($fundingRound->announced_date)->format('j M, Y') : 'N/A' }}</td>
                                <td style="vertical-align: middle;">{{ $fundingRound->lead_investor ?? 'N/A' }}</td>
                                <td style="vertical-align: middle;">
                                    {{ $fundingRound->company->nama ?? 'N/A' }}
                                </td>
                                <td style="vertical-align: middle;">
                                    <!-- Tombol untuk menuju halaman detail funding round -->
                                    <a href="{{ route('funding_rounds.show', $fundingRound->id) }}" class="btn btn-primary">View & Invest</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
