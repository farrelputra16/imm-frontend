@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
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
/* Custom width for columns */
th:nth-child(1),
td:nth-child(1) {
    width: 10%; /* Checkbox column */
}

th:nth-child(2),
td:nth-child(2) {
    width: 20%; /* Organization Name */
}

th:nth-child(3),
td:nth-child(3) {
    width: 15%; /* Founded Date */
}

th:nth-child(4),
td:nth-child(4) {
    width: 15%; /* Last Funding Date */
}

th:nth-child(5),
td:nth-child(5) {
    width: 20%; /* Last Funding Type */
}

th:nth-child(6),
td:nth-child(6) {
    width: 15%; /* Employee */
}

th:nth-child(7),
td:nth-child(7) {
    width: 10%; /* Industries */
}

th:nth-child(8),
td:nth-child(8) {
    width: 15%; /* Description */
}

th:nth-child(9),
td:nth-child(9) {
    text-align: start;
    width: 10%; /* Job Departments */
}

/* Align text to the start (left-aligned) for specific columns */
td:nth-child(7), /* Industries */
td:nth-child(8), /* Description */
td:nth-child(9)  /* Job Departments */ {
    text-align: start;
    vertical-align: middle;
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
                <a href="#" style="text-decoration: none; color: #212B36;">Innovation Hub</a>
            </li>
        </ol>
    </nav>

    <h2 class="header"><b>Hubs</b></h2>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <div class="filter-header"  style="vertical-align: center;  justify-content: flex-start;">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 140px;">
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('hubs.index') }}" id="hubsFilterForm">
                    @csrf
                    <!-- Location Filter -->
                    <div class="mb-3">
                        <h6>LOCATION</h6>
                        <label><input type="checkbox" class="filter-checkbox" name="location[]" value="Jakarta" onchange="autoFilter()"> Jakarta</label>
                        <label><input type="checkbox" class="filter-checkbox" name="location[]" value="Bali" onchange="autoFilter()"> Bali</label>
                        <label><input type="checkbox" class="filter-checkbox" name="location[]" value="Yogyakarta" onchange="autoFilter()"> Yogyakarta</label>
                        <label><input type="checkbox" class="filter-checkbox" name="location[]" value="Sumatera Timur" onchange="autoFilter()"> Sumatera Timur</label>

                        <!-- Dropdown Provinsi -->
                        <div style="display: none;" id="extra-locations">
                            <h6>PROVINCE</h6>
                            <select id="province-select" onchange="fetchCitiesByProvince()" style="width: 100%;">
                                <option value="">Pilih Provinsi</option>
                                <!-- Provinsi akan diisi oleh JavaScript -->
                            </select>

                            <input type="hidden" id="province-hidden" name="province_hidden">

                            <!-- Daftar Kota -->
                            <h6>CITIES</h6>
                            <div id="cities-checkboxes">
                                <!-- Checkbox kota akan diisi oleh JavaScript -->
                            </div>
                        </div>

                        <label class="others-label" onclick="toggleLocations()">Others <i class="fas fa-chevron-down"></i></label>
                    </div>

                    <!-- Rank Search -->
                    <div class="mb-3">
                        <h6>Rank</h6>
                        <select name="rank" class="form-control" onchange="submitForm()" id="rank-select">
                            <option value="">Pilih Rank</option>
                            <option value="10" {{ request()->rank == '10' ? 'selected' : '' }}>Top 10</option>
                            <option value="50" {{ request()->rank == '50' ? 'selected' : '' }}>Top 50</option>
                            <option value="100" {{ request()->rank == '100' ? 'selected' : '' }}>Top 100</option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <h6>Status</h6>
                        <select name="status" class="form-control" onchange="submitForm()" id="status-select">
                            <option value="">Pilih status</option>
                            <option value="approved" {{ request()->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="pending" {{ request()->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        </select>
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
            <div class="search-container" style="max-width: 100%;">
                <i class="fas fa-search" style="margin-left: 10px;"></i>
                <input class="form-control" placeholder="Search Data" type="text" style="border: none;">
                <button class="btn">Search</button>
            </div>

            <div class="table-responsive" style="max-width: 100%;">
                <table class="table table-hover table-strip" style="margin-bottom: 0px;">
                    <thead class="sub-heading-2">
                        <tr>
                            <th scope="col" style="border-top-left-radius: 20px; vertical-align: top; border-bottom: none; text-align: left;">Submission Number</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Innovation Hub Name</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Applicant Name</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Province</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Top Investor Types</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Top Funding Types</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Rank</th>
                            <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top; text-align: left; border-bottom: none;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($hubs->isEmpty())
                            <tr>
                                <td colspan="8" style="text-align: center; border-left: 1px solid #ddd;border-right: 1px solid #ddd;">Tidak ada data yang tersedia.</td>
                            </tr>
                        @else
                            @foreach($hubs as $index => $hub)
                                <tr data-href="{{ route('hubs.show', $hub->id) }}">
                                    <td style="vertical-align: middle; text-align: center; border-left: 1px solid #ddd;">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <div style="display: flex; align-items: center;">
                                            <div style="margin-right: 2px;">
                                                <img src="{{ !empty($hub->image) ? asset($hub->image) : asset('images/logo-maxy.png') }}" alt="" width="30" height="30" style="border-radius: 8px; object-fit:cover;">
                                            </div>
                                            <div style="flex-grow: 1; margin-left: 0px; margin-right: 10px; width: 100px; word-wrap: break-word; word-break: break-word; white-space: normal;"
                                                @if (strlen($hub->name) > 10)
                                                    title="{{ $hub->name }}"
                                                    style="cursor: pointer;"
                                                @endif
                                            >
                                                <span class="body-2">{{ $hub->name }}</span>
                                            </div>
                                            <div style="margin-left: 0px; margin-right: 0px;">
                                                <i class="fas fa-search" style="color: #aee1b7;"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $hub->user_id }}</td>
                                    <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $hub->provinsi }}</td>
                                    <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $hub->top_investor_types }}</td>
                                    <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $hub->top_funding_types }}</td>
                                    <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $hub->rank }}</td>
                                    <td style="vertical-align: middle; text-align: start; border-right: 1px solid #ddd;" class="body-2">{{ $hub->status }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

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
                <form method="GET" action="{{ route('hubs.index') }}" class="mb-0">
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
                            <span>Total {{ $hubs->firstItem() }} - {{ $hubs->lastItem() }} of {{ $hubs->total() }}</span>
                        </div>
                    </div>
                </form>
                <div style="margin-top: 10px;">
                    {{ $hubs->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('tr[data-href]').forEach(tr => {
        tr.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox') {
                window.location.href = this.dataset.href;
            }
        });
    });
</script>

{{-- script untuk filter --}}
<script>
    // Fungsi untuk menyimpan status checkbox
    function saveCheckboxState() {
        const checkboxes = document.querySelectorAll('.filter-checkbox');
        checkboxes.forEach(checkbox => {
            localStorage.setItem(checkbox.value, checkbox.checked);
        });
    }

    // Fungsi untuk memuat status checkbox
    function loadCheckboxState() {
        const checkboxes = document.querySelectorAll('.filter-checkbox');
        checkboxes.forEach(checkbox => {
            const checked = localStorage.getItem(checkbox.value) === 'true';
            checkbox.checked = checked;
        });
    }

    // Fungsi untuk mengirimkan form ketika checkbox berubah
    function autoFilterCheckbox() {
        saveCheckboxState();
        document.getElementById('hubsFilterForm').submit();
    }

    function autoFilter() {
        const form = document.getElementById('hubsFilterForm');
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

        // Debug: Log selected values
        console.log('Selected Departments:', Array.from(selectedDepartments).map(tag => tag.getAttribute('data-value')));

        // Simpan status ke localStorage
        saveFilterState();

        // Submit form
        form.submit();
    }

    // Initialize checkbox functionality
    document.addEventListener('DOMContentLoaded', () => {
        loadCheckboxState();

        // Setup checkbox change listeners
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', autoFilterCheckbox);
        });
    });
</script>

{{-- Script untuk tag filter --}}
<script>
    // Fungsi untuk menyimpan status filter ke localStorage
    function saveFilterState() {
        const selectedTags = {
            departments: Array.from(document.querySelectorAll('.tag[data-filter="departments"].selected')).map(tag => tag.getAttribute('data-value')),
        };
        localStorage.setItem('selectedTags', JSON.stringify(selectedTags));
    }

    // Fungsi untuk memuat status filter dari localStorage
    function loadFilterState() {
        const savedTags = JSON.parse(localStorage.getItem('selectedTags'));
        if (savedTags) {
            if (savedTags.departments) {
                savedTags.departments.forEach(value => {
                    const tag = document.querySelector(`.tag[data-filter="departments"][data-value="${value}"]`);
                    if (tag) tag.classList.add('selected');
                });
            }
        }
    }

    // Fungsi untuk toggle filter
    function toggleFilter(tagElement) {
        tagElement.classList.toggle('selected');
        autoFilter();
    }
</script>

{{-- Script clear filter --}}
<script>
    const rankSelect = document.getElementById('rank-select');
    const statusSelect = document.getElementById('status-select');
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

        // Clear rank select
        rankSelect.value = '';
        statusSelect.value = '';

        // Clear localStorage
        localStorage.removeItem('selectedTags');
        localStorage.removeItem('investorSearch');

        // Submit form
        document.getElementById('hubsFilterForm').submit();
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

{{-- Script untuk mengirimkan form saat rank dipilih --}}
<script>
    // Fungsi untuk mengirimkan form
    function submitForm() {
        document.getElementById('hubsFilterForm').submit();
    }

    // Menangani event keydown untuk menangkap Enter
    document.addEventListener('DOMContentLoaded', () => {
        const rankSelect = document.getElementById('rank-select');
        rankSelect.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Mencegah form dari pengiriman default
                submitForm(); // Panggil fungsi submitForm
            }
        });
    });
</script>

{{-- script untuk mengirimkan form saat status dipilih --}}
<script>
    // Fungsi untuk mengirimkan form
    function submitForm() {
        document.getElementById('hubsFilterForm').submit();
    }

    // Menangani event keydown untuk menangkap Enter
    document.addEventListener('DOMContentLoaded', () => {
        const statusSelect = document.getElementById('status-select');
        statusSelect.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Mencegah form dari pengiriman default
                submitForm(); // Panggil fungsi submitForm
            }
        });
    });
</script>

{{-- script untuk mengambil data kota dari API --}}
<script>
    // URL untuk API provinsi dan kota
    const provinceApiUrl = 'https://xenodrom31.github.io/api-wilayah-indonesia/api/provinces.json';
    const cityApiUrlBase = 'https://xenodrom31.github.io/api-wilayah-indonesia/api/regencies/';
    const province_hidden = document.getElementById('province-hidden');

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
                    province_hidden.value = province.name;
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
