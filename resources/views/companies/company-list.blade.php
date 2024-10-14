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
                            <th scope="col" style="vertical-align: middle;">Organization <br> Name</th>
                            <th scope="col" style="vertical-align: middle;">Founded <br> Date</th>
                            <th scope="col" style="vertical-align: middle;">Last Funding <br> Date</th>
                            <th scope="col" style="vertical-align: middle;">Last Funding <br> Type</th>
                            <th scope="col" style="vertical-align: middle;">Number of <br> Employees</th>
                            <th scope="col" style="vertical-align: middle;">Business Model</th>
                            <th scope="col" style="vertical-align: middle;">Description</th>
                            <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Job Departments</th>
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
                        <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()" style="width: 75px;">
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
