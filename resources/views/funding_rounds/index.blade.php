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
                            <option value="" {{ request()->get('funding_type') === null ? 'selected' : '' }}>Tipe Pendanaan</option>
                            <option value="pre_seed" {{ request()->get('funding_type') === 'pre_seed' ? 'selected' : '' }}>Pendanaan Pre-Seed</option>
                            <option value="seed" {{ request()->get('funding_type') === 'seed' ? 'selected' : '' }}>Pendanaan Seed</option>
                            <option value="series_a" {{ request()->get('funding_type') === 'series_a' ? 'selected' : '' }}>Pendanaan Series A</option>
                            <option value="series_b" {{ request()->get('funding_type') === 'series_b' ? 'selected' : '' }}>Pendanaan Series B</option>
                            <option value="series_c" {{ request()->get('funding_type') === 'series_c' ? 'selected' : '' }}>Pendanaan Series C</option>
                            <option value="series_d" {{ request()->get('funding_type') === 'series_d' ? 'selected' : '' }}>Pendanaan Series D</option>
                            <option value="series_e" {{ request()->get('funding_type') === 'series_e' ? 'selected' : '' }}>Pendanaan Series E</option>
                            <option value="series_f" {{ request()->get('funding_type') === 'series_f' ? 'selected' : '' }}>Pendanaan Series F</option>
                            <option value="series_g" {{ request()->get('funding_type') === 'series_g' ? 'selected' : '' }}>Pendanaan Series G</option>
                            <option value="series_h" {{ request()->get('funding_type') === 'series_h' ? 'selected' : '' }}>Pendanaan Series H</option>
                            <option value="series_i" {{ request()->get('funding_type') === 'series_i' ? 'selected' : '' }}>Pendanaan Series I</option>
                            <option value="series_j" {{ request()->get('funding_type') === 'series_j' ? 'selected' : '' }}>Pendanaan Series J</option>
                            <option value="venture_series_unknown" {{ request()->get('funding_type') === 'venture_series_unknown' ? 'selected' : '' }}>Venture - Seri Tidak Diketahui</option>
                            <option value="angel" {{ request()->get('funding_type') === 'angel' ? 'selected' : '' }}>Pendanaan Angel</option>
                            <option value="private_equity" {{ request()->get('funding_type') === 'private_equity' ? 'selected' : '' }}>Ekuitas Swasta</option>
                            <option value="debt" {{ request()->get('funding_type') === 'debt' ? 'selected' : '' }}>Pendanaan Utang</option>
                            <option value="convertible_debt" {{ request()->get('funding_type') === 'convertible_debt' ? 'selected' : '' }}>Utang Konversi</option>
                            <option value="grants" {{ request()->get('funding_type') === 'grants' ? 'selected' : '' }}>Hibah</option>
                            <option value="revenue_based" {{ request()->get('funding_type') === 'revenue_based' ? 'selected' : '' }}>Pendanaan Berbasis Pendapatan</option>
                            <option value="ipo" {{ request()->get('funding_type') === 'ipo' ? 'selected' : '' }}>Penawaran Umum Perdana (IPO)</option>
                            <option value="crowdfunding" {{ request()->get('funding_type') === 'crowdfunding' ? 'selected' : '' }}>Crowdfunding</option>
                            <option value="initial_coin_offering" {{ request()->get('funding_type') === 'initial_coin_offering' ? 'selected' : '' }}>Penawaran Koin Awal</option>
                            <option value="undisclosed" {{ request()->get('funding_type') === 'undisclosed' ? 'selected' : '' }}>Tidak Diketahui</option>
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
                                        {{ $fundingRound->funding_stage ?? 'N/A' }}
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
