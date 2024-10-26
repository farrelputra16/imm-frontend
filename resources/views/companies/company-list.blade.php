@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">


<div class="container-fluid">
    <div class="header d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('landingpage') }}">Home</a> &gt; <a href="#">Find StartUp</a>
        </div>
    </div>

    <h1 class="header"><b>Find StartUp</b></h1>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <!-- Filter Header -->
            <div class="filter-header" style="vertical-align: center;">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 10px;">
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('companies.list') }}" class="mb-4" id="companySearchForm">
                    @csrf
                    <div class="mb-3">
                        <h6>LOCATION</h6>
                        <input type="text" name="location" class="form-control" placeholder="Location" value="{{ request()->location }}">
                    </div>

                    <div class="mb-3">
                        <h6>INDUSTRY</h6>
                        <input type="text" name="industry" class="form-control" placeholder="Industry" value="{{ request()->industry }}">
                    </div>

                    <div class="mb-3">
                        <h6>DEPARTMENTS</h6>
                        <input type="text" name="departments" class="form-control" placeholder="Departments" value="{{ request()->departments }}">
                    </div>

                    <div class="mb-3">
                        <h6>FUNDING TYPE</h6>
                        <select name="funding_type" id="funding_type" class="form-control" onchange="filterByFundingType(this.value)">
                            <option value="" {{ request()->get('investment_stage') === null ? 'selected' : '' }}>Pilih Tahap Investasi</option>
                            <option value="pre_seed" {{ request()->get('investment_stage') === 'pre_seed' ? 'selected' : '' }}>Pendanaan Pre-Seed</option>
                            <option value="seed" {{ request()->get('investment_stage') === 'seed' ? 'selected' : '' }}>Pendanaan Seed</option>
                            <option value="series_a" {{ request()->get('investment_stage') === 'series_a' ? 'selected' : '' }}>Pendanaan Series A</option>
                            <option value="series_b" {{ request()->get('investment_stage') === 'series_b' ? 'selected' : '' }}>Pendanaan Series B</option>
                            <option value="series_c" {{ request()->get('investment_stage') === 'series_c' ? 'selected' : '' }}>Pendanaan Series C</option>
                            <option value="series_d" {{ request()->get('investment_stage') === 'series_d' ? 'selected' : '' }}>Pendanaan Series D</option>
                            <option value="series_e" {{ request()->get('investment_stage') === 'series_e' ? 'selected' : '' }}>Pendanaan Series E</option>
                            <option value="series_f" {{ request()->get('investment_stage') === 'series_f' ? 'selected' : '' }}>Pendanaan Series F</option>
                            <option value="series_g" {{ request()->get('investment_stage') === 'series_g' ? 'selected' : '' }}>Pendanaan Series G</option>
                            <option value="series_h" {{ request()->get('investment_stage') === 'series_h' ? 'selected' : '' }}>Pendanaan Series H</option>
                            <option value="series_i" {{ request()->get('investment_stage') === 'series_i' ? 'selected' : '' }}>Pendanaan Series I</option>
                            <option value="series_j" {{ request()->get('investment_stage') === 'series_j' ? 'selected' : '' }}>Pendanaan Series J</option>
                            <option value="venture_series_unknown" {{ request()->get('investment_stage') === 'venture_series_unknown' ? 'selected' : '' }}>Venture - Seri Tidak Diketahui</option>
                            <option value="angel" {{ request()->get('investment_stage') === 'angel' ? 'selected' : '' }}>Pendanaan Angel</option>
                            <option value="private_equity" {{ request()->get('investment_stage') === 'private_equity' ? 'selected' : '' }}>Ekuitas Swasta</option>
                            <option value="debt_financing" {{ request()->get('investment_stage') === 'debt_financing' ? 'selected' : '' }}>Pendanaan Utang</option>
                            <option value="convertible_note" {{ request()->get('investment_stage') === 'convertible_note' ? 'selected' : '' }}>Nota Konversi</option>
                            <option value="grant" {{ request()->get('investment_stage') === 'grant' ? 'selected' : '' }}>Hibah</option>
                            <option value="corporate_round" {{ request()->get('investment_stage') === 'corporate_round' ? 'selected' : '' }}>Putaran Korporat</option>
                            <option value="equity_crowdfunding" {{ request()->get('investment_stage') === 'equity_crowdfunding' ? 'selected' : '' }}>Crowdfunding Ekuitas</option>
                            <option value="product_crowdfunding" {{ request()->get('investment_stage') === 'product_crowdfunding' ? 'selected' : '' }}>Crowdfunding Produk</option>
                            <option value="secondary_market" {{ request()->get('investment_stage') === 'secondary_market' ? 'selected' : '' }}>Pasar Sekunder</option>
                            <option value="post_ipo_equity" {{ request()->get('investment_stage') === 'post_ipo_equity' ? 'selected' : '' }}>Ekuitas Pasca-IPO</option>
                            <option value="post_ipo_debt" {{ request()->get('investment_stage') === 'post_ipo_debt' ? 'selected' : '' }}>Utang Pasca-IPO</option>
                            <option value="post_ipo_secondary" {{ request()->get('investment_stage') === 'post_ipo_secondary' ? 'selected' : '' }}>Sekunder Pasca-IPO</option>
                            <option value="non_equity_assistance" {{ request()->get('investment_stage') === 'non_equity_assistance' ? 'selected' : '' }}>Bantuan Non-Ekuitas</option>
                            <option value="initial_coin_offering" {{ request()->get('investment_stage') === 'initial_coin_offering' ? 'selected' : '' }}>Penawaran Koin Awal</option>
                            <option value="undisclosed" {{ request()->get('investment_stage') === ' undisclosed' ? 'selected' : '' }}>Tidak Diketahui</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-md-9 table-section">
            <div class="search-container">
                <i class="fas fa-search" style="margin-left: 10px;"></i>
                <input class="form-control" placeholder="Search Data" type="text" style="border: none;">
                <button class="btn">Search</button>
            </div>

            {{-- Tempat menaruh tombol wishlist --}}
            <div style="margin: 0px; padding: 0px;  display: flex; justify-content: flex-end;">
                <button class="wishlist-button" style="display: none;">
                    <img alt="Icon representing a list" height="20" src="{{ asset('images/WishlistIcon.svg') }}" width="20"/>
                    Add to Wishlist
                </button>
            </div>

            <form id="wishlist-form" method="POST" action="{{ route('wishlist.add') }}">
                @csrf
                <input type="hidden" name="company_ids" id="company_ids" value="">
            </form>


            <!-- Companies Table -->
            <div class="table-responsive">
                <table class="table table-hover table-strip" style="margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;"><input type="checkbox" value="all_check" id="select_all"></th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: middle;">Organization <br> Name</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: middle;">Founded <br> Date</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: middle;">Last Funding <br> Date</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: middle;">Last Funding <br> Type</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: middle;">Number of <br> Employees</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: middle;">Business Model</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: middle;">Description</th>
                            <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: middle;">Job Departments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr data-href="{{ route('companies.show', $company->id) }}">
                                <td style="vertical-align: middle;"><input type="checkbox" class="select_company" data-id="{{ $company->id }}"></td>
                                <td style="vertical-align: middle;">
                                    <div style="display: flex; align-items: center;">
                                        <div style="margin-right: 5px;">
                                            <img src="{{ !empty($company->image) ? asset($company->image) : asset('images/logo-maxy.png') }}" alt="" width="50" height="50" style="border-radius: 8px; object-fit:cover;">
                                        </div>
                                        <div style="flex-grow: 1; margin-left: 0px; margin-right: 0px; width: 100px; word-wrap: break-word; word-break: break-word; white-space: normal;"
                                            @if (strlen($company->nama) > 20)
                                                title="{{ $company->nama }}"
                                                style="cursor: pointer;"
                                            @endif
                                        >
                                            <span>{{ $company->nama }}</span>
                                        </div>
                                        <div style="margin-left: 10px;, margin-right: 0px;">
                                            <i class="fas fa-search" style="color: #aee1b7;"></i>
                                        </div>
                                    </div>
                                </td>
                                <td style="vertical-align: middle;">{{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('j M, Y') : 'N/A' }}</td>
                                <td style="vertical-align: middle;">{{ $company->latest_income_date ? \Carbon\Carbon::parse($company->latest_income_date)->format('j M, Y') : 'N/A' }}</td>
                                <td style="vertical-align: middle;">
                                    @if ($company->latest_funding_type)
                                        <div>{{ $company->latest_funding_type }}</div>
                                    @else
                                        No funding data available
                                    @endif
                                </td>
                                <td style="vertical-align: middle;">{{ $company->jumlah_karyawan }}</td>
                                <td style="vertical-align: middle;">{{ $company->business_model }}</td>
                                <td style="vertical-align: middle;">{{ Str::limit($company->startup_summary, 20, '...') }}</td>
                                <td style="vertical-align: middle; cursor: pointer;" title={{ $company->all_departments }}>
                                    {{ $company->departments->join(', ') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer sebagai bagian dari tabel -->
            <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 0px solid #ffffff; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
                <form method="GET" action="{{ route('companies.list') }}" class="mb-0">
                    <div class="d-flex align-items-center">
                        <label for="rowsPerPage" class="me-2">Rows per page:</label>
                        <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()" style="width: 50%px; margin-left: 5px; margin-right: 5px;">
                            <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                            <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <div>
                            <span>Total {{ $companies->firstItem() }} - {{ $companies->lastItem() }} of {{ $companies->total() }}</span>
                        </div>
                    </div>
                </form>
                <div>
                    {{ $companies->appends($request->only(['location', 'industry', 'departments', 'funding_type']))->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Handle form submission -->
<script>
    document.getElementById('funding_type').addEventListener('change', function() {
        document.getElementById('companySearchForm').submit();
    });

    // Handle row click event and checkbox logic
    document.querySelectorAll('tr[data-href]').forEach(tr => {
        tr.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox') {
                window.location.href = this.dataset.href;
            }
        });
    });

    // Handle select all functionality
    document.getElementById('select_all').addEventListener('change', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.select_company').forEach(checkbox => {
            checkbox.checked = isChecked;
            if (isChecked) {
                document.querySelector('.wishlist-button').style.display = 'inline-block';
                document.querySelector('.search-container').style.marginBottom = '0px';
            } else {
                document.querySelector('.wishlist-button').style.display = 'none';
                document.querySelector('.search-container').style.marginBottom = '20px';
            }
        });
    });

    // Handle checkboxes dynamically using event delegation
    document.querySelector('tbody').addEventListener('change', function(e) {
        if (e.target.classList.contains('select_company')) {
            updateWishlistButton();
        }
    });

    function updateWishlistButton() {
        const selectedCompanies = Array.from(document.querySelectorAll('.select_company:checked')).map(cb => cb.dataset.id);
        if (selectedCompanies.length > 0) {
            document.querySelector('.wishlist-button').style.display = 'inline-block';
            document.getElementById('company_ids').value = selectedCompanies.join(',');
            document.querySelector('.search-container').style.marginBottom = '0px';
        } else {
            document.querySelector('.wishlist-button').style.display = 'none';
            document.getElementById('company_ids').value = '';
            document.querySelector('.search-container').style.marginBottom = '20px';
        }
    }
    // Get the wishlist button
    const wishlistButton = document.querySelector('.wishlist-button');

    // Add an event listener to the wishlist button
    wishlistButton.addEventListener('click', function() {
        // Update nilai company_ids sebelum mengirimkan form
        updateWishlistButton();
        // Submit the wishlist form
        document.getElementById('wishlist-form').submit();
    });
</script>
<script>
    function filterByFundingType(fundingType) {
        var form = document.getElementById('companySearchForm');
        form.action = '{{ route('companies.list') }}';
        form.submit();
    }
</script>
@endsection
