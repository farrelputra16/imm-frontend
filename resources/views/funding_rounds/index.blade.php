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
        <!-- Filter Section -->
        <div class="col-md-3">
            <!-- Filter Header -->
            <div class="filter-header d-flex align-items-center mb-3">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 10px;">
            </div>

            <!-- Filter Form -->
            <div class="filter-section">
                <form method="GET" action="{{ route('funding_rounds.index') }}" class="mb-4" id="companySearchForm">
                    @csrf

                    <!-- Company Filter -->
                    <div class="mb-3">
                        <h6>Company</h6>
                        <input type="text" name="company_name" class="form-control" placeholder="Search by Company" value="{{ request()->get('company_name') }}">
                    </div>

                    <!-- Funding Type Filter -->
                    <div class="mb-3">
                        <h6>FUNDING TYPE</h6>
                        <select name="funding_type" id="funding_type" class="form-control">
                            <option value="" {{ request()->get('funding_type') === null ? 'selected' : '' }}>Funding Type</option>
                            <option value="pre_seed" {{ request()->get('funding_type') === 'pre_seed' ? 'selected' : '' }}>Pre-seed Funding</option>
                            <option value="seed" {{ request()->get('funding_type') === 'seed' ? 'selected' : '' }}>Seed Funding</option>
                            <option value="series_a" {{ request()->get('funding_type') === 'series_a' ? 'selected' : '' }}>Series A Funding</option>
                            <option value="series_b" {{ request()->get('funding_type') === 'series_b' ? 'selected' : '' }}>Series B Funding</option>
                            <option value="series_c" {{ request()->get('funding_type') === 'series_c' ? 'selected' : '' }}>Series C Funding</option>
                            <option value="series_d" {{ request()->get('funding_type') === 'series_d' ? 'selected' : '' }}>Series D Funding</option>
                            <option value="series_e" {{ request()->get('funding_type') === 'series_e' ? 'selected' : '' }}>Series E Funding</option>
                            <option value="debt" {{ request()->get('funding_type') === 'debt' ? 'selected' : '' }}>Debt Funding</option>
                            <option value="equity" {{ request()->get('funding_type') === 'equity' ? 'selected' : '' }}>Equity Funding</option>
                            <option value="convertible_debt" {{ request()->get('funding_type') === 'convertible_debt' ? 'selected' : '' }}>Convertible Debt</option>
                            <option value="grants" {{ request()->get('funding_type') === 'grants' ? 'selected' : '' }}>Grants</option>
                            <option value="revenue_based" {{ request()->get('funding_type') === 'revenue_based' ? 'selected' : '' }}>Revenue-Based Financing</option>
                            <option value="private_equity" {{ request()->get('funding_type') === 'private_equity' ? 'selected' : '' }}>Private Equity</option>
                            <option value="ipo" {{ request()->get('funding_type') === 'ipo' ? 'selected' : '' }}>Initial Public Offering (IPO)</option>
                        </select>
                    </div>

                    <!-- Announced Date Filter -->
                    <div class="mb-3">
                        <h6>Announced</h6>
                        <select name="announced_date" class="form-control">
                            <option value="" {{ request()->get('announced_date') === null ? 'selected' : '' }}>Select Period</option>
                            <option value="30" {{ request()->get('announced_date') == '30' ? 'selected' : '' }}>Past 30 Days</option>
                            <option value="60" {{ request()->get('announced_date') == '60' ? 'selected' : '' }}>Past 60 Days</option>
                            <option value="90" {{ request()->get('announced_date') == '90' ? 'selected' : '' }}>Past 90 Days</option>
                            <option value="365" {{ request()->get('announced_date') == '365' ? 'selected' : '' }}>Past Year</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </form>
            </div>
        </div>

        <div class="col-md-9 table-section">
            <div class="search-container mb-3">
                <i class="fas fa-search" style="margin-left: 10px;"></i>
                <input class="form-control" placeholder="Search Data" type="text" style="border: none;">
                <button class="btn">Search</button>
            </div>

            <!-- Table Section -->
            <div class="table-section">
                <div class="table-responsive">
                    <table class="table table-hover table-strip" style="margin-bottom: 0px;">
                        <thead class="sub-heading-2">
                            <tr>
                                <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">Name</th>
                                <th scope="col" style="vertical-align: middle;">Company</th>
                                <th scope="col" style="vertical-align: middle;">Funding Type</th>
                                <th scope="col" style="vertical-align: middle;">Target Amount</th>
                                <th scope="col" style="vertical-align: middle;">Money Raised</th>
                                <th scope="col" style="vertical-align: middle;">Announced</th>
                                <th scope="col" style="vertical-align: middle;">Lead Investor</th>
                                <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fundingRounds as $fundingRound)
                                <tr data-href="{{ route('funding_rounds.show', $fundingRound->id) }}">
                                    <td style="vertical-align: middle;">
                                        <span>{{ $fundingRound->name }}</span>
                                    </td>
                                    <td style="vertical-align: middle;">
                                        @if ($fundingRound->company)
                                            <a href="{{ route('companies.show', $fundingRound->company->id) }}">
                                                {{ $fundingRound->company->nama ?? 'N/A' }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle;">
                                        {{ $fundingRound->company->funding_stage ?? 'N/A' }}
                                    </td>
                                    <td style="vertical-align: middle;">Rp {{ $fundingRound->target ? number_format($fundingRound->target,0, ',', '.') : 'N/A' }}</td>
                                    <td style="vertical-align: middle;">Rp {{ $fundingRound->money_raised ? number_format($fundingRound->money_raised,0, ',', '.') : 'N/A' }}</td>
                                    <td style="vertical-align: middle;">{{ $fundingRound->announced_date ? \Carbon\Carbon::parse($fundingRound->announced_date)->format('j M, Y') : 'N/A' }}</td>
                                    <td style="vertical-align: middle;">
                                        @if ($fundingRound->leadInvestor)
                                            <a href="{{ route('investors.show', $fundingRound->leadInvestor->id) }}">
                                                {{ $fundingRound->leadInvestor->org_name }}
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td style="vertical-align: middle;">
                                        <a href="{{ route('funding_rounds.show', $fundingRound->id) }}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
