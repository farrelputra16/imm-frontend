@extends('layouts.app-landingpage')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
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
    .breadcrumb {
        background-color: white;
        padding: 0;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        margin-right: 14px;
        color: #9CA3AF;
    }
    .tag {
        cursor: pointer; /* Menampilkan cursor pointer saat hover */
        border: 2px solid transparent; /* Border default tidak terlihat */
        padding: 5px 10px; /* Padding untuk memberikan ruang di dalam tag */
        border-radius: 5px; /* Sudut border yang melengkung */
        transition: border-color 0.3s; /* Transisi halus untuk perubahan border */
    }

    .tag:hover {
        border-color: #6256CA; /* Warna border saat hover */
    }

    .tag.selected {
        border-color: #6256CA; /* Warna border saat tag aktif */
        color: #6256CA; /* Mengubah warna teks saat tag aktif */
        font-weight: bold; /* Menebalkan teks saat tag aktif */
    }
    .btn-primary {
        background-color: #6256CA;
        border-color: #6256CA;
    }

    .btn-primary:hover {
        background-color: #4c43b3;
        border-color: #4c43b3;
    }
    .container {
        flex: 1; /* Membuat kontainer mengambil ruang yang tersedia */
        max-width: 1400px;
        margin: 0 auto;
    }
</style>
<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" style="margin-bottom: 32px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                @if ($status == 'company')
                    <a href="{{ route('companies.list', ['status' => 'company']) }}" style="text-decoration: none; color: #212B36;">Find StartUp</a>

                @elseif ($status == 'benchmark')
                    <a href="{{ route('companies.list', ['status' => 'benchmark']) }}" style="text-decoration: none; color: #212B36;">Benchmark StartUp</a>
                @endif
            </li>
        </ol>
    </nav>

    @if ($status == 'company')
        <h2 style="margin-bottom: 32px; color: #6256CA;">Find StartUp</h2>
    @elseif ($status == 'benchmark')
        <h2 style="margin-bottom: 32px; color: #6256CA;">Benchmark StartUp</h2>
    @endif

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <!-- Filter Header -->
            <div class="filter-header" style="vertical-align: center;  justify-content: flex-start;">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 140px;">
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('companies.list', ['status' => $status]) }}" id="companyFilterForm">
                    @csrf
                    <input type="hidden" name="status" value="{{ $status }}">
                    <!-- LOCATION Filter -->
                    <div class="mb-3">
                        <h6>LOCATION</h6>
                        <label><input type="checkbox" class="filter-checkbox" name="location[]" value="Jakarta"> Jakarta</label>
                        <label><input type="checkbox" class="filter-checkbox" name="location[]" value="Bali"> Bali</label>
                        <label><input type="checkbox" class="filter-checkbox" name="location[]" value="Yogyakarta"> Yogyakarta</label>
                        <label><input type="checkbox" class="filter-checkbox" name="location[]" value="Sumatera Timur"> Sumatera Timur</label>

                        <!-- Dropdown Provinsi -->
                        <div style="display: none;" id="extra-locations">
                            <h6>PROVINCE</h6>
                            <select id="province-select" onchange="fetchCitiesByProvince()" style="width: 100%;">
                                <option value="">Pilih Provinsi</option>
                                <!-- Provinsi akan diisi oleh JavaScript -->
                            </select>

                            <!-- Daftar Kota -->
                            <h6>CITIES</h6>
                            <div id="cities-checkboxes">
                                <!-- Checkbox kota akan diisi oleh JavaScript -->
                            </div>
                        </div>

                        <label class="others-label" onclick="toggleLocations()">Others <i class="fas fa-chevron-down"></i></label>
                    </div>

                    <!-- DEVELOPMENT STAGE Filter -->
                    <div class="mb-3">
                        <h6>DEVELOPMENT STAGE</h6>
                        @foreach (['Pre Seed', 'seed', 'Series A', 'Series B'] as $stage)
                            <label><input type="checkbox" name="funding_stage[]" value="{{ $stage }}" class="funding-stage filter-checkbox" > {{ ucfirst(str_replace('_', ' ', $stage)) }}</label>
                        @endforeach
                        <div class="extra-funding" style="display: none;">
                            @foreach (['Series C', 'Series D', 'Series E', 'Series F', 'Series G', 'Series H', 'Series I', 'Series J', 'venture_series_unknown', 'angel', 'private_equity', 'debt', 'convertible_debt', 'grants', 'revenue_based', 'ipo', 'crowdfunding', 'initial_coin_offering', 'undisclosed'] as $stage)
                                <label>
                                    <input type="checkbox" name="funding_stage[]" value="{{ $stage }}" class="funding-stage filter-checkbox"> {{ ucfirst(str_replace('_', ' ', $stage)) }}
                                </label>
                            @endforeach
                        </div>
                        <label class="others-funding" onclick="togglefunding()" style="justify-content: space-between"><div>Others</div> <i class="fas fa-chevron-down"></i></label>
                    </div>

                  <!-- INDUSTRIES Filter -->
                    <h6>INDUSTRIES</h6>
                    <div class="tags-container">
                        @foreach ($department as $dept)
                            <div class="tag"
                                data-filter="departments"
                                data-value="{{ $dept->name }}">
                                {{ $dept->name }}
                            </div>
                        @endforeach
                    </div>

                    <!-- BUSINESS MODEL Filter -->
                    <h6>BUSINESS MODEL</h6>
                    <div class="tags-container">
                        @foreach (['P2P', 'D2C', 'C2C', 'B2B', 'B2B2C', 'B2C'] as $model)
                            <div class="tag"
                                data-filter="business_model"
                                data-value="{{ $model }}">
                                {{ $model }}
                            </div>
                        @endforeach
                    </div>

                    <!-- Clear Filters Button -->
                    <button type="button" onclick="clearFilters()" style="margin-top: 10px;"  class="btn btn-primary w-100">Clear Filters</button>

                    <!-- Form untuk filter -->

                    <!-- Hidden inputs container -->
                    <div id="hidden-inputs"></div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-md-9 table-section">
            <form method="GET" action="{{ route('companies.list') }}"  id="companySearchForm">
                @csrf
                <input type="hidden" name="status" value="{{ $status }}">
                <div class="search-container"  style="max-width: 100%;">
                    <i class="fas fa-search" style="margin-left: 10px;"></i>
                    <input class="form-control" placeholder="Search Investors" type="text" name="search" id="search_input" value="{{ request('search') }}" />
                    <button class="btn" type="submit">Search</button>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Tempat menaruh tombol wishlist --}}
            <div style="margin: 0px; padding: 0px;">
                <div id="wishlist-info" style="margin-bottom: 10px;"></div>
                <div style="display: flex; justify-content: flex-end;">
                    <button class="wishlist-button" style="display: none; position: relative;">
                        <img alt="Icon representing a list" height="20" src="{{ asset('images/WishlistIcon.svg') }}" width="20"/>
                        Add to Wishlist
                        <span id="wishlist-counter" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">
                            0
                        </span>
                    </button>
                </div>
            </div>

            <form id="wishlist-form" method="POST" action="{{ route('wishlist.add') }}">
                @csrf
                <input type="hidden" name="company_ids" id="company_ids" value="">
            </form>

            <!-- Companies Table -->
            <div class="table-responsive"  style="max-width: 100%;">
                <table class="table table-hover table-strip" style="margin-bottom: 0px;">
                    <thead>
                        <tr>
                            <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">
                                <input type="checkbox" value="all_check" id="select_all" class="select_company">
                            </th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left;">Organization <br> Name</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top;">Founded <br> Date</th>
                            @if ($status == 'benchmark')
                                <th scope="col" class="sub-heading-2" style="vertical-align: top;">Business <br> Model</th>
                            @elseif ($status == 'company')
                                <th scope="col" class="sub-heading-2" style="vertical-align: top;">Last Funding <br> Date</th>
                            @endif
                            <th scope="col" class="sub-heading-2" style="vertical-align: top;">Last Funding <br> Type</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top;">Number of <br> Employees</th>
                            @if ($status == 'company')
                                <th scope="col" class="sub-heading-2" style="vertical-align: top;">Business Model</th>
                            @elseif ($status == 'benchmark')
                                <th scope="col" class="sub-heading-2" style="vertical-align: top;">Last Funding <br> Date</th>
                            @endif
                            @if ($status == 'benchmark')
                                <th scope="col" class="sub-heading-2" style="vertical-align: top;">Total Raised</th>
                            @elseif ($status == 'company')
                                <th scope="col" class="sub-heading-2" style="vertical-align: top;">Description</th>
                            @endif
                            <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top;">Job Departments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($companies->isEmpty())
                            <tr>
                                <td colspan="9" style="text-align: center; vertical-align: middle;">
                                    <strong>Tidak ada data yang tersedia.</strong>
                                </td>
                            </tr>
                        @else
                            @foreach ($companies as $company)
                                @if ($status == 'company')
                                    <tr data-href="{{ route('companies.show', $company->id) }}">
                                @elseif ($status == 'benchmark')
                                    <tr data-href="{{ route('companies.benchmark', $company->id) }}">
                                @endif
                                    <td style="vertical-align: middle;">
                                        <input type="checkbox" class="select_company" data-id="{{ $company->id }}">
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <div style="display: flex; align-items: center;">
                                            <div style="margin-right: 2px;">
                                                <img src="{{ !empty($company->image) ? env('APP_URL') . $company->image : asset('images/logo-maxy.png') }}" alt="" width="30" height="30"
                                                style="border-radius: 8px; object-fit:cover;">
                                            </div>
                                            <div style="flex-grow: 1; margin-left: 0px; margin-right: 0px; width: 100px; word-wrap: break-word; word-break: break-word; white-space: normal;"
                                                @if (strlen($company->nama) > 10)
                                                    title="{{ $company->nama }}"
                                                    style="cursor: pointer;"
                                                @endif
                                            >
                                                <span class="body-2">{{ $company->nama }}</span>
                                            </div>
                                            <div style="margin-left: 0px; margin-right: 0px;">
                                                <i class="fas fa-search" style="color: #aee1b7;"></i>
                                            </div>
                                        </div>
                                    </td>
                                    @if ($status == 'company')
                                        <td style="vertical-align: middle;" class="body-2">{{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('j M, Y') : 'N/A' }}</td>
                                    @elseif ($status == 'benchmark')
                                        <td style="vertical-align: middle;" class="body-2">{{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('Y') : 'N/A' }}</td>
                                    @endif
                                    @if ($status == 'benchmark')
                                        <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $company->business_model }}</td>
                                    @endif
                                    <td style="vertical-align: middle;" class="body-2">{{ $company->latest_funding_date ? \Carbon\Carbon::parse($company->latest_funding_date)->format('j M, Y') : 'N/A' }}</td>
                                    <td style="vertical-align: middle;" class="body-2">
                                        <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                                            @if ($company->funding_stage)
                                                <div class="funding-stage">{{ $company->funding_stage }}</div>
                                            @else
                                                <div>No funding data available</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle;" class="body-2">{{ $company->jumlah_karyawan }}</td>
                                    @if ($status == 'company')
                                        <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $company->business_model }}</td>
                                    @endif
                                    @if ($status == 'benchmark')
                                        <td style="vertical-align: middle;" class="body-2">{{ number_format($company->total_funding, 0, ',', '.') }} IDR</td>
                                    @elseif ($status == 'company')
                                        <td style="vertical-align: middle;" class="body-2">{{ Str::limit($company->startup_summary, 20, '...') }}</td>
                                    @endif
                                    <td style="vertical-align: middle; cursor: pointer;" title="{{ $company->all_departments }}" class="body-2">
                                        {{ $company->departments->join(', ') }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Footer sebagai bagian dari tabel -->
            <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 0px solid #ffffff; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px; max-width: 100%;">
                <form method="GET" action="{{ route('companies.list') }}" class="mb-0">
                    <input type="hidden" name="status" value="{{ $status }}">
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
                <div style="margin-top: 10px;">
                    {{ $companies->appends($request->only(['location', 'industry', 'departments', 'funding_stage','search', 'status']))->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Handle form submission -->
<script>
    // Handle row click event and checkbox logic
    document.querySelectorAll('tr[data-href]').forEach(tr => {
        tr.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox' && !e.target.closest('.wishlist-button')) {
                window.location.href = this.dataset.href;
            }
        });
    });

    // Handle select all functionality
    document.getElementById('select_all').addEventListener('change', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.select_company').forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateWishlistButton();
        updateWishlistCounter();
        saveWishlistState();
    });

    // Handle checkboxes dynamically using event delegation
    document.querySelector('tbody').addEventListener('change', function(e) {
        if (e.target.classList.contains('select_company')) {
            e.preventDefault();
            updateWishlistButton();
            updateWishlistCounter();
            saveWishlistState();

            const allCheckboxes = document.querySelectorAll('.select_company');
            const checkedCheckboxes = document.querySelectorAll('.select_company:checked');
            document.getElementById('select_all').checked = allCheckboxes.length === checkedCheckboxes.length;
        }
    });

    // Fungsi untuk update counter wishlist
    function updateWishlistCounter() {
        const selectedCount = document.querySelectorAll('.select_company:checked').length;
        const totalCount = document.querySelectorAll('.select_company').length;

        // Update counter di navbar jika ada
        const wishlistCounter = document.getElementById('wishlist-counter');
        if (wishlistCounter) {
            wishlistCounter.textContent = selectedCount;
            wishlistCounter.style.display = selectedCount > 0 ? 'inline-block' : 'none';
        }

        // Update counter info di atas tabel
        const wishlistInfo = document.getElementById('wishlist-info');
        if (!wishlistInfo) {
            const infoDiv = document.createElement('div');
            infoDiv.id = 'wishlist-info';
            infoDiv.style.marginBottom = '10px';
            document.querySelector('.wishlist-button').parentElement.insertBefore(infoDiv, document.querySelector('.wishlist-button'));
        }
    }

    // Fungsi untuk update tampilan tombol wishlist
    function updateWishlistButton() {
        const selectedCompany = Array.from(document.querySelectorAll('.select_company:checked')).map(cb => cb.dataset.id);
        const wishlistButton = document.querySelector('.wishlist-button');
        const searchContainer = document.querySelector('.search-container');

        if (selectedCompany.length > 0) {
            wishlistButton.style.display = 'inline-block';
            document.getElementById('company_ids').value = selectedCompany.join(',');
            searchContainer.style.marginBottom = '0px';

            wishlistButton.innerHTML = `
                <img alt="Icon representing a list" height="20" src="${wishlistButton.querySelector('img').src}" width="20"/>
                Add to Wishlist (${selectedCompany.length})
            `;
        } else {
            wishlistButton.style.display = 'none';
            document.getElementById('company_ids').value = '';
            searchContainer.style.marginBottom = '20px';
        }
    }

    // Fungsi untuk menyimpan state wishlist ke localStorage
    function saveWishlistState() {
        const selectedCompany = Array.from(document.querySelectorAll('.select_company:checked')).map(cb => cb.dataset.id);
        localStorage.setItem('investorWishlistSelection', JSON.stringify(selectedCompany));
    }

    // Fungsi untuk memuat state wishlist dari localStorage
    function loadWishlistState() {
        const savedSelection = JSON.parse(localStorage.getItem('investorWishlistSelection')) || [];
        savedSelection.forEach(id => {
            const checkbox = document.querySelector(`.select_company[data-id="${id}"]`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
        updateWishlistButton();
        updateWishlistCounter();
    }

    // Handle wishlist button click
    const wishlistButton = document.querySelector('.wishlist-button');
    wishlistButton.addEventListener('click', function(e) {
        e.preventDefault();

        // Ambil semua checkbox yang tercentang
        const selectedCompany = document.querySelectorAll('.select_company:checked');
        const selectedIds = Array.from(selectedCompany).map(cb => cb.dataset.id); // Ambil ID dari data-id

        // Hapus nilai kosong
        const filteredIds = selectedIds.filter(id => id !== "0" && id !== "");

        if (filteredIds.length === 0) {
            alert('Please select at least one investor to add to wishlist');
            return;
        }

        // Update hidden input dengan selected IDs
        document.getElementById('company_ids').value = filteredIds.join(',');

        // Tambahkan animasi loading
        wishlistButton.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Adding to Wishlist...
        `;
        wishlistButton.disabled = true;

        // Submit form
        document.getElementById('wishlist-form').submit();
        localStorage.removeItem('investorWishlistSelection');
    });

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', () => {
        loadWishlistState();

        // Add initial counter display
        const counterDiv = document.createElement('div');
        counterDiv.id = 'wishlist-info';
        counterDiv.style.marginBottom = '10px';
        document.querySelector('.wishlist-button').parentElement.insertBefore(counterDiv, document.querySelector('.wishlist-button'));

        updateWishlistCounter();
    });
</script>

{{-- script untuk ngeformat funding_stage --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.funding-stage').forEach(function(element) {
            // Mengambil teks dari label yang bersangkutan
            const labelText = element.textContent.trim();
            element.textContent = formatFundingStage(labelText);
        });
    });

    // Fungsi untuk format tampilan funding stage
    function formatFundingStage(text) {
        // Mengganti underscore dengan spasi
        let formatted = text.replace(/_/g, ' ');

        // Mengubah huruf pertama menjadi kapital dan sisanya menjadi huruf kecil
        if (formatted.length > 0) {
            formatted = formatted.charAt(0).toUpperCase() + formatted.slice(1).toLowerCase();
        }

        return formatted;
    }
</script>

{{-- script untuk memunculkan lebih banyak pilihan --}}
<script>
    function toggleLocations() {
        const extraLocations = document.querySelector('.extra-locations');
        const othersLabel = document.querySelector('.others-label');

        if (extraLocations.style.display === "none" || extraLocations.style.display === "") {
            extraLocations.style.display = "block";
            othersLabel.innerHTML = 'Others <i class="fas fa-chevron-up"></i>';
        } else {
            extraLocations.style.display = "none";
            othersLabel.innerHTML = 'Others <i class="fas fa-chevron-down"></i>';
        }
    }

    function togglefunding() {
        const extraFunding = document.querySelector('.extra-funding');
        const othersFunding = document.querySelector('.others-funding');

        if (extraFunding.style.display === "none" || extraFunding.style.display === "") {
            extraFunding.style.display = "block";
            othersFunding.innerHTML = 'Others <i class="fas fa-chevron-up"></i>';
        } else {
            extraFunding.style.display = "none";
            othersFunding.innerHTML = 'Others <i class="fas fa-chevron-down"></i>';
        }
    }
</script>

{{-- Filter untuk search --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menyimpan nilai pencarian ke localStorage saat form di-submit
        document.getElementById('companySearchForm').addEventListener('submit', function() {
            localStorage.setItem('companySearch', document.querySelector('input[name="search"]').value);
        });

        // Mengisi input pencarian dengan nilai dari localStorage saat halaman dimuat
        var savedSearch = localStorage.getItem('companySearch');
        if (savedSearch) {
            document.querySelector('input[name="search"]').value = savedSearch;
        }
    });
</script>

{{-- Script untuk checkbox filter --}}
<script>
    // Fungsi untuk menyimpan status checkbox filter
    function saveCheckboxState() {
        const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
        filterCheckboxes.forEach(checkbox => {
            localStorage.setItem(checkbox.value, checkbox.checked);
        });
    }

    // Fungsi untuk memuat status checkbox filter
    function loadCheckboxState() {
        const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
        filterCheckboxes.forEach(checkbox => {
            const checked = localStorage.getItem(checkbox.value) === 'true';
            checkbox.checked = checked;
        });
    }

    // Fungsi untuk mengirimkan form ketika checkbox filter berubah
    function autoFilterCheckbox(event) {
        // Pastikan ini bukan checkbox wishlist
        if (event.target.classList.contains('filter-checkbox')) {
            saveCheckboxState();
            document.getElementById('companyFilterForm').submit();
        }
    }

    // Initialize checkbox filter functionality
    document.addEventListener('DOMContentLoaded', () => {
        loadCheckboxState();

        // Setup checkbox change listeners khusus untuk filter
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', autoFilterCheckbox);
        });
    });
</script>

{{-- Script untuk tag filter --}}
<script>
    // Fungsi untuk toggle filter
    function toggleFilter(tagElement) {
        tagElement.classList.toggle('selected');
        autoFilter();
    }

    // Fungsi untuk mengirimkan form secara otomatis
    function autoFilter() {
        const form = document.getElementById('companyFilterForm');
        const hiddenInputsContainer = document.getElementById('hidden-inputs');

        // Bersihkan hidden inputs yang ada
        hiddenInputsContainer.innerHTML = '';

        // Proses departments tags
        const selectedDepartments = document.querySelectorAll('.tag[data-filter="departments"].selected');
        selectedDepartments.forEach(tag => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'departments[]';
            input.value = tag.getAttribute('data-value');
            hiddenInputsContainer.appendChild(input);
        });

        // Proses business model tags
        const selectedBusinessModels = document.querySelectorAll('.tag[data-filter="business_model"].selected');
        selectedBusinessModels.forEach(tag => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'business_model[]';
            input.value = tag.getAttribute('data-value');
            hiddenInputsContainer.appendChild(input);
        });

        // Debug: Log selected values
        console.log('Selected Departments:', Array.from(selectedDepartments).map(tag => tag.getAttribute('data-value')));
        console.log('Selected Business Models:', Array.from(selectedBusinessModels).map(tag => tag.getAttribute('data-value')));

        // Simpan status ke localStorage
        saveFilterState();

        // Submit form
        form.submit();
    }

    // Fungsi untuk menyimpan status filter ke localStorage
    function saveFilterState() {
        const selectedTags = {
            departments: Array.from(document.querySelectorAll('.tag[data-filter="departments"].selected'))
                .map(tag => tag.getAttribute('data-value')),
            business_model: Array.from(document.querySelectorAll('.tag[data-filter="business_model"].selected'))
                .map(tag => tag.getAttribute('data-value'))
        };
        localStorage.setItem('selectedTags', JSON.stringify(selectedTags));
    }

    // Fungsi untuk memuat status filter dari localStorage
    function loadFilterState() {
        const savedTags = JSON.parse(localStorage.getItem('selectedTags'));
        if (savedTags) {
            // Restore departments
            if (savedTags.departments) {
                savedTags.departments.forEach(value => {
                    const tag = document.querySelector(`.tag[data-filter="departments"][data-value="${value}"]`);
                    if (tag) tag.classList.add('selected');
                });
            }

            // Restore business models
            if (savedTags.business_model) {
                savedTags.business_model.forEach(value => {
                    const tag = document.querySelector(`.tag[data-filter="business_model"][data-value="${value}"]`);
                    if (tag) tag.classList.add('selected');
                });
            }
        }
    }

    // Fungsi untuk membersihkan semua filter
    function clearFilters() {
        // Clear tags
        document.querySelectorAll('.tag').forEach(tag => {
            tag.classList.remove('selected');
        });

        // Clear filter checkboxes only
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.checked = false;
            localStorage.removeItem(checkbox.value);
        });

        // Clear hidden inputs dan search input
        document.getElementById('hidden-inputs').innerHTML = '';
        document.querySelector('input[name="search"]').value = '';

        // Clear localStorage
        localStorage.removeItem('selectedTags');
        localStorage.removeItem('companySearch');

        // Submit form
        document.getElementById('companyFilterForm').submit();
    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', () => {
        loadFilterState();

        // Tambahkan event listener untuk setiap tag
        document.querySelectorAll('.tag').forEach(tag => {
            tag.addEventListener('click', function() {
                toggleFilter(this);
            });
        });
    });
</script>

{{-- script untuk mengambil data kota dari API --}}
<script>
    // URL untuk API provinsi dan kota
    const provinceApiUrl = 'https://xenodrom31.github.io/api-wilayah-indonesia/api/provinces.json';
    const cityApiUrlBase = 'https://xenodrom31.github.io/api-wilayah-indonesia/api/regencies/';

    // Fungsi untuk menampilkan atau menyembunyikan extra locations
    function toggleLocations() {
        const extraLocationsDiv = document.getElementById('extra-locations');
        extraLocationsDiv.style.display = extraLocationsDiv.style.display === 'none' ? 'block' : 'none';
        if (extraLocationsDiv.style.display === 'block') {
            fetchProvinces(); // Muat provinsi saat "Others" diklik
        }
    }

    // Fungsi untuk mengambil dan menampilkan daftar provinsi
    function fetchProvinces() {
        fetch(provinceApiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const provinceSelect = document.getElementById('province-select');
                provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>'; // Clear dan isi ulang
                data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id; // Menyimpan ID provinsi
                    option.textContent = province.name; // Menampilkan nama provinsi
                    provinceSelect.appendChild(option);
                });
                provinceSelect.onchange = fetchCitiesByProvince; // Panggil fungsi untuk mengambil kota saat provinsi dipilih
            })
            .catch(error => console.error('Error fetching provinces:', error));
    }

    // Fungsi untuk mengambil daftar kota berdasarkan provinsi yang dipilih
    function fetchCitiesByProvince() {
        const provinceId = document.getElementById('province-select').value; // Ambil ID provinsi terpilih
        if (!provinceId) {
            document.getElementById('cities-checkboxes').innerHTML = ''; // Kosongkan kota jika tidak ada provinsi terpilih
            return;
        }

        const cityApiUrl = `${cityApiUrlBase}${provinceId}.json`; // Buat URL API kota
        fetch(cityApiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                const citiesCheckboxes = document.getElementById('cities-checkboxes');
                citiesCheckboxes.innerHTML = ''; // Kosongkan kota sebelumnya
                data.forEach(city => {
                    const label = document.createElement('label');
                    label.innerHTML = `<input type="checkbox" name="location[]" value="${city.name}" onchange="autoFilter()" class="filter-checkbox"> ${city.name}`;
                    citiesCheckboxes.appendChild(label);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    }

    // Memanggil fetchProvinces saat dokumen dimuat
    document.addEventListener('DOMContentLoaded', fetchProvinces);
</script>
@endsection
