@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}"> --}}
<style>
     /* Mengatur font family untuk seluruh halaman */
     body {
        font-family: 'Poppins', sans-serif; /* Menggunakan Inter untuk isi/content */
    }

    /* Mengatur font family untuk heading */
    h1, h2, h3, h4 {
        font-family: 'Poppins', sans-serif; /* Menggunakan Work Sans untuk heading */
    }

    /* Mengatur font family untuk sub-heading dan body */
    .sub-heading-1, .sub-heading-2, .body-1, .body-2 {
        font-family: 'Poppins', sans-serif; /* Set font to Poppins */
    }
</style>

<div class="container">
    <nav aria-label="breadcrumb" style="margin-bottom: 32px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #212B36;">Funding Rounds</a>
            </li>
        </ol>
    </nav>

    <h2 style="margin-bottom: 32px; color: #6256CA;">Funding Rounds</h2>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <!-- Filter Header -->
            <div class="filter-header d-flex align-items-center mb-3">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 140px;">
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
                            <option value="Pre Seed" {{ request()->get('funding_type') === 'Pre Seed' ? 'selected' : '' }}>Pendanaan Pre-Seed</option>
                            <option value="seed" {{ request()->get('funding_type') === 'seed' ? 'selected' : '' }}>Pendanaan Seed</option>
                            <option value="Series A" {{ request()->get('funding_type') === 'Series A' ? 'selected' : '' }}>Pendanaan Series A</option>
                            <option value="Series B" {{ request()->get('funding_type') === 'Series B' ? 'selected' : '' }}>Pendanaan Series B</option>
                            <option value="Series C" {{ request()->get('funding_type') === 'Series C' ? 'selected' : '' }}>Pendanaan Series C</option>
                            <option value="Series D" {{ request()->get('funding_type') === 'Series D' ? 'selected' : '' }}>Pendanaan Series D</option>
                            <option value="Series E" {{ request()->get('funding_type') === 'Series E' ? 'selected' : '' }}>Pendanaan Series E</option>
                            <option value="Series F" {{ request()->get('funding_type') === 'Series F' ? 'selected' : '' }}>Pendanaan Series F</option>
                            <option value="Series G" {{ request()->get('funding_type') === 'Series G' ? 'selected' : '' }}>Pendanaan Series G</option>
                            <option value="Series H" {{ request()->get('funding_type') === 'Series H' ? 'selected' : '' }}>Pendanaan Series H</option>
                            <option value="Series I" {{ request()->get('funding_type') === 'Series I' ? 'selected' : '' }}>Pendanaan Series I</option>
                            <option value="Series J" {{ request()->get('funding_type') === 'Series J' ? 'selected' : '' }}>Pendanaan Series J</option>
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
            <div class="search-container mb-3"  style="max-width: 100%; width: 100%;">
                <i class="fas fa-search" style="margin-left: 10px;"></i>
                <input class="form-control" placeholder="Search Data" type="text" style="border: none;">
                <button class="btn">Search</button>
            </div>

            <!-- Table Section -->
            <div class="table-responsive"  style="max-width: 100%; width: 100%;">
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
             <!-- Footer sebagai bagian dari tabel -->
             <div class="d-flex justify-content-between align-items-center mb-3 align-self-center"
             style="padding: 20px;
                 background-color: #ffffff;
                 border-bottom: 1px solid #ddd;
                 border-left: 1px solid #ddd;
                 border-right: 1px solid #ddd;
                 border-top: 1px solid #ddd;
                 margin-top:0px;
                 border-end-end-radius: 20px;
                 border-end-start-radius: 20px;
                 height: 60px;
                 max-width: 100%;
                 ">
                 <form method="GET" action="{{ route('funding_rounds.index') }}" class="mb-0">
                     <div class="d-flex align-items-center">
                         <label for="rowsPerPage" class="me-2">Rows per page:</label>
                         <select name="rows"
                                 id="rowsPerPage"
                                 class="form-select me-2"
                                 onchange="this.form.submit()"
                                 style="width: 50%px; margin-left: 5px; margin-right: 5px;">
                             <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                             <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                             <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                         </select>
                         <div>
                             <span>Total {{ $fundingRounds->firstItem() }} - {{ $fundingRounds->lastItem() }} of {{ $fundingRounds->total() }}</span>
                         </div>
                     </div>
                 </form>
                 <div style="margin-top: 10px;">
                     {{ $fundingRounds->appends(request()->query())->links('pagination::bootstrap-4') }}
                 </div>
             </div>
        </div>
    </div>
</div>
@endsection
