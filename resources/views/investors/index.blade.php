@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Tambahkan CSS Select2 -->
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<style>
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
</style>

<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" style="margin-bottom: 32px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #212B36;">Find Investor</a>
            </li>
        </ol>
    </nav>

    <h2 style="margin-bottom: 32px; color: #6256CA;">Find Investor</h2>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <div class="filter-header" style="vertical-align: center;">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 10px;">
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('investors.index') }}" id="investorFilterForm">
                    @csrf
                    <!-- Location Filter -->
                    <div class="mb-3">
                        <h6>LOCATION</h6>
                        <label><input type="checkbox" name="location[]" value="Jakarta" onchange="autoFilter()"> Jakarta</label>
                        <label><input type="checkbox" name="location[]" value="Bali" onchange="autoFilter()"> Bali</label>
                        <label><input type="checkbox" name="location[]" value="Yogyakarta" onchange="autoFilter()"> Yogyakarta</label>
                        <label><input type="checkbox" name="location[]" value="Sumatera Timur" onchange="autoFilter()"> Sumatera Timur</label>

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
                        <h6>INVESTMENT STAGE</h6>
                        @foreach (['Pre Seed', 'seed', 'Series A', 'Series B'] as $stage)
                            <label><input type="checkbox" name="investment_stage[]" value="{{ $stage }}" onchange="autoFilter()" class="investment-stage"> {{ ucfirst(str_replace('_', ' ', $stage)) }}</label>
                        @endforeach
                        <div class="extra-funding" style="display: none;">
                            @foreach (['Series C', 'Series D', 'Series E', 'Series F', 'Series G', 'Series H', 'Series I', 'Series J', 'venture_series_unknown', 'angel', 'private_equity', 'debt', 'convertible_debt', 'grants', 'revenue_based', 'ipo', 'crowdfunding', 'initial_coin_offering', 'undisclosed'] as $stage)
                                <label>
                                    <input type="checkbox" name="investment_stage[]" value="{{ $stage }}" onchange="autoFilter()" class="investment-stage"> {{ ucfirst(str_replace('_', ' ', $stage)) }}
                                </label>
                            @endforeach
                        </div>
                        <label class="others-funding" onclick="togglefunding()" style="justify-content: space-between"><div>Others</div> <i class="fas fa-chevron-down"></i></label>
                    </div>

                    <div class="mb-3">
                        <h6>INVESTOR TYPE</h6>
                        @foreach ([
                            'venture_capital',
                            'individual_angel',
                            'private_equity_firm',
                            'accelerator'
                        ] as $type)
                            <label>
                                <input type="checkbox"
                                       name="investor_type[]"
                                       value="{{ $type }}"
                                       onchange="autoFilter()"
                                       class="investor-type">
                                {{ ucfirst(str_replace('_', ' ', $type)) }}
                            </label>
                        @endforeach
                        <div class="extra-tipe" style="display: none;">
                            @foreach ([
                                'investment_partner',
                                'corporate_venture_capital',
                                'micro_vc',
                                'angel_group',
                                'incubator',
                                'investment_bank',
                                'family_investment_office',
                                'venture_debt',
                                'co_working_space',
                                'fund_of_funds',
                                'hedge_fund',
                                'government_office',
                                'university_program',
                                'entrepreneurship_program',
                                'secondary_purchaser',
                                'startup_competition',
                                'syndicate',
                                'pension_funds'
                            ] as $type)
                                <label>
                                    <input type="checkbox"
                                           name="investor_type[]"
                                           value="{{ $type }}"
                                           onchange="autoFilter()"
                                           class="investor-type">
                                    {{ ucfirst(str_replace('_', ' ', $type)) }}
                                </label>
                            @endforeach
                        </div>
                        <label class="others-tipe"
                               onclick="toggleTipe()"
                               style="justify-content: space-between">
                            <div>Others</div>
                            <i class="fas fa-chevron-down"></i>
                        </label>
                    </div>

                    <!-- Industries Filter -->
                    <div class="mb-3">
                        <h6>DEPARTMENTS</h6>
                        <div>
                            <button type="submit" name="departments" value="Software" class="tag">Software</button>
                            <button type="submit" name="departments" value="Health Care" class="tag">Health Care</button>
                            <button type="submit" name="departments" value="IT" class="tag">IT</button>
                            <button type="submit" name="departments" value="Education" class="tag">Education</button>
                            <button type="submit" name="departments" value="Manufacture" class="tag">Manufacture</button>
                            <button type="submit" name="departments" value="Energy" class="tag">Energy</button>
                            <button type="submit" name="departments" value="Engineering" class="tag">Engineering</button>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    <button type="button" onclick="clearFilters()" style="margin-top: 10px;" class="btn btn-primary w-100">Clear Filters</button>

                    <!-- Hidden inputs container -->
                    <div id="hidden-inputs"></div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-md-9 table-section">
            <form method="GET" action="{{ route('investors.index') }}"  id="companySearchForm">
                @csrf
                <div class="search-container">
                    <i class="fas fa-search" style="margin-left: 10px;"></i>
                    <input class="form-control" placeholder="Search Investors" type="text" name="search" value="{{ request('search') }}" />
                    <button class="btn" type="submit">Search</button>
                </div>
            </form>

            {{-- Tempat menaruh tombol wishlist --}}
            <div style="margin: 0px; padding: 0px;  display: flex; justify-content: flex-end;">
                <button class="wishlist-button" style="display: none;">
                    <img alt="Icon representing a list" height="20" src="{{ asset('images/WishlistIcon.svg') }}" width="20"/>
                    Add to Wishlist
                </button>
            </div>

            <form id="wishlist-form" method="POST" action="{{ route('wishlist.add') }}">
                @csrf
                <input type="hidden" name="investor_ids" id="investor_ids" value="">
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-strip" style="margin-bottom: 0px;">
                    <thead class="sub-heading-2">
                        <tr>
                            <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle; border-bottom: none;"><input type="checkbox" value="all_check" id="select_all"></th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Organization Name</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Number of Contacts</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Number of Investments</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Invesment Stage</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Location</th>
                            <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top; text-align: left; border-bottom: none;">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($investors as $investor)
                        <tr data-href="{{ route('investors.show', $investor->id) }}">
                            <td style="vertical-align: middle; border-left: 1px solid #ddd;"><input type="checkbox" class="select_investor" data-id="{{ $investor->id }}"></td>
                            <td style="vertical-align: middle;">
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 2px;">
                                        <img src="{{ !empty($investor->image) ? asset($investor->image) : asset('images/logo-maxy.png') }}" alt="" width="30" height="30" style="border-radius: 8px; object-fit:cover;">
                                    </div>
                                    <div style="flex-grow: 1; margin-left: 0px; margin-right: 10px; width: 100px; word-wrap: break-word; word-break: break-word; white-space: normal;"
                                        @if (strlen($investor->org_name) > 10)
                                            title="{{ $investor->org_name }}"
                                            style="cursor: pointer;"
                                        @endif
                                    >
                                        <span class="body-2">{{ $investor->org_name }}</span>
                                    </div>
                                    <div style="margin-left: 0px; margin-right: 0px;">
                                        <i class="fas fa-search" style="color: #aee1b7;"></i>
                                    </div>
                                </div>
                            </td>
                            <td  style="vertical-align: middle; text-align: center;" class="body-2">{{ $investor->number_of_contacts }}</td>
                            <td  style="vertical-align: middle; text-align: center;" class="body-2">{{ $investor->number_of_investments }}</td>
                            <td  style="vertical-align: middle; text-align: center;" class="body-2 investment-stage">{{ $investor->investment_stage }}</td>
                            <td  style="vertical-align: middle; text-align: start;" class="body-2">{{ $investor->location }}</td>
                            <td style="vertical-align: middle; text-align: start; border-right: 1px solid #ddd;" class="body-2">{{ Str::limit($investor->description, 20, '...') }}</td>
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
                height: 60px;">
                <form method="GET" action="{{ route('investors.index') }}" class="mb-0">
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
                            <span>Total {{ $investors->firstItem() }} - {{ $investors->lastItem() }} of {{ $investors->total() }}</span>
                        </div>
                    </div>
                </form>
                <div style="margin-top: 10px;">
                    {{ $investors->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{-- script untuk memunculkan lebih banyak pilihan --}}
<script>
    function toggleLocations() {
        const extraLocations = document.querySelector('.extra-locations');
        const othersLabel = document.querySelector('.others-label');

        if (extraLocations.style.display === "none" || extraLocations.style.display === "") {
            othersLabel.innerHTML = 'Others <i class="fas fa-chevron-up"></i>';
            extraLocations.style.display = "block";
        } else {
            othersLabel.innerHTML = 'Others <i class="fas fa-chevron-down"></i>';
            extraLocations.style.display = "none";
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

    function toggleTipe() {
        const extraTipe = document.querySelector('.extra-tipe');
        const othersTipe = document.querySelector('.others-tipe');

        if (extraTipe.style.display === "none" || extraTipe.style.display === "") {
            extraTipe.style.display = "block";
            othersTipe.innerHTML = 'Others <i class="fas fa-chevron-up"></i>';
        } else {
            extraTipe.style.display = "none";
            othersTipe.innerHTML = 'Others <i class="fas fa-chevron-down"></i>';
        }
    }
</script>

<script>
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
        document.querySelectorAll('.select_investor').forEach(checkbox => {
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
        if (e.target.classList.contains('select_investor')) {
            updateWishlistButton();
        }
    });

    function updateWishlistButton() {
        const selectedInvestors = Array.from(document.querySelectorAll('.select_investor:checked')).map(cb => cb.dataset.id);
        if (selectedInvestors.length > 0) {
            document.querySelector('.wishlist-button').style.display = 'inline-block';
            document.getElementById('investor_ids').value = selectedInvestors.join(',');
            document.querySelector('.search-container').style.marginBottom = '0px';
        } else {
            document.querySelector('.wishlist-button').style.display = 'none';
            document.getElementById('investor_ids').value = '';
            document.querySelector('.search-container').style.marginBottom = '20px';
        }
    }
    // Get the wishlist button
    const wishlistButton = document.querySelector('.wishlist-button');

    // Add an event listener to the wishlist button
    wishlistButton.addEventListener('click', function() {
        // Update nilai investor_ids sebelum mengirimkan form
        updateWishlistButton();
        // Submit the wishlist form
        document.getElementById('wishlist-form').submit();
    });
</script>

{{-- script untuk ngeformat investment_stage --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.investment-stage').forEach(function(element) {
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

{{-- Filter untuk search --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menyimpan nilai pencarian ke localStorage saat form di-submit
        document.getElementById('companySearchForm').addEventListener('submit', function() {
            localStorage.setItem('investorSearch', document.querySelector('input[name="search"]').value);
        });

        // Mengisi input pencarian dengan nilai dari localStorage saat halaman dimuat
        var savedSearch = localStorage.getItem('investorSearch');
        if (savedSearch) {
            document.querySelector('input[name="search"]').value = savedSearch;
        }
    });
</script>

{{-- script untuk filter --}}
<script>
    // Fungsi untuk menyimpan status checkbox
    function saveCheckboxState() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            localStorage.setItem(checkbox.value, checkbox.checked);
        });
    }

    // Fungsi untuk memuat status checkbox
    function loadCheckboxState() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            const checked = localStorage.getItem(checkbox.value) === 'true';
            checkbox.checked = checked;
        });
    }

    // Fungsi untuk mengirimkan form ketika checkbox berubah
    function autoFilterCheckbox() {
        saveCheckboxState();
        document.getElementById('investorFilterForm').submit();
    }

    function autoFilter() {
        const form = document.getElementById('investorFilterForm');
        const hiddenInputsContainer = document.getElementById('hidden-inputs');

        // Bersihkan hidden inputs yang ada
        hiddenInputsContainer.innerHTML = '';

        // // Proses departments tags
        // const selectedDepartments = document.querySelectorAll('.tag[data-filter="departments"].selected');
        // selectedDepartments.forEach(tag => {
        //     const input = document.createElement('input');
        //     input.type = 'hidden';
        //     input.name = 'departments[]';
        //     input.value = tag.getAttribute('data-value');
        //     hiddenInputsContainer.appendChild(input);
        // });

        // // Proses business model tags
        // const selectedBusinessModels = document.querySelectorAll('.tag[data-filter="business_model"].selected');
        // selectedBusinessModels.forEach(tag => {
        //     const input = document.createElement('input');
        //     input.type = 'hidden';
        //     input.name = 'business_model[]';
        //     input.value = tag.getAttribute('data-value');
        //     hiddenInputsContainer.appendChild(input);
        // });

        // // Debug: Log selected values
        // console.log('Selected Departments:', Array.from(selectedDepartments).map(tag => tag.getAttribute('data-value')));
        // console.log('Selected Business Models:', Array.from(selectedBusinessModels).map(tag => tag.getAttribute('data-value')));

        // // Simpan status ke localStorage
        // saveFilterState();

        // Submit form
        form.submit();
    }

    // Initialize checkbox functionality
    document.addEventListener('DOMContentLoaded', () => {
        loadCheckboxState();

        // Setup checkbox change listeners
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.addEventListener('change', autoFilterCheckbox);
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
                    label.innerHTML = `<input type="checkbox" name="location[]" value="${city.name}" onchange="autoFilter()"> ${city.name}`;
                    citiesCheckboxes.appendChild(label);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    }

    // Memanggil fetchProvinces saat dokumen dimuat
    document.addEventListener('DOMContentLoaded', fetchProvinces);
</script>
@endsection
