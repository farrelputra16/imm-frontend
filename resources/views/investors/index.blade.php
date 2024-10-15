@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<!-- Tambahkan CSS Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">

<div class="container-fluid">
    <div class="header d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('landingpage') }}">Home</a> &gt; <a href="#">Find Investor</a>
        </div>
    </div>

    <h1 class="header"><b>Investors</b></h1>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <div class="filter-header" style="vertical-align: center;">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 10px;">
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('investors.index') }}">
                    <!-- Location Search -->
                    <div class="mb-3">
                        <h6>LOCATION</h6>
                        <input type="text" name="location" class="form-control" placeholder="Enter location" value="{{ request()->location }}">
                    </div>

                    <!-- Investment Stage Dropdown -->
                    <div class="mb-3">
                        <h6>INVESTMENT STAGE</h6>
                        <select class="form-control select2" name="investment_stage">
                            <option value="">Select Investment Stage</option>
                            <option value="Pre-Seed" {{ old('investment_stage') == 'Pre-Seed' ? 'selected' : '' }}>Pre-Seed</option>
                            <option value="Seed" {{ old('investment_stage') == 'Seed' ? 'selected' : '' }}>Seed</option>
                            <option value="Series A" {{ old('investment_stage') == 'Series A' ? 'selected' : '' }}>Series A</option>
                            <option value="Series B" {{ old('investment_stage') == 'Series B' ? 'selected' : '' }}>Series B</option>
                            <option value="Series C" {{ old('investment_stage') == 'Series C' ? 'selected' : '' }}>Series C</option>
                            <option value="Series D" {{ old('investment_stage') == 'Series D' ? 'selected' : '' }}>Series D</option>
                            <option value="IPO" {{ old('investment_stage') == 'IPO' ? 'selected' : '' }}>IPO</option>
                        </select>
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

                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-md-9 table-section">
            <div class="search-container">
                <i class="fas fa-search" style="margin-left: 10px;"></i>
                <input class="form-control" placeholder="Search Investors" type="text" />
                <button class="btn">Search</button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-strip" style="margin-bottom: 0px; border-top-left-radius: 20px; border-top-right-radius: 20px; overflow: hidden;">
                    <thead>
                        <tr>
                            <th><input type="checkbox" /></th>
                            <th>Organization Name</th>
                            <th>Number of Contacts</th>
                            <th>Number of Investments</th>
                            <th>Location</th>
                            <th>Departments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($investors as $investor)
                        <tr data-href="{{ route('investors.show', $investor->id) }}">
                            <td><input type="checkbox" /></td>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 5px;">
                                        <img alt="Organization logo" height="20" src="https://placehold.co/20x20" width="20" />
                                    </div>
                                    <div>{{ $investor->org_name }}</div>
                                </div>
                            </td>
                            <td>{{ $investor->number_of_contacts }}</td>
                            <td>{{ $investor->number_of_investments }}</td>
                            <td>{{ $investor->location }}</td>
                            <td>{{ $investor->departments }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3" style="padding: 20px;">
                <form method="GET" action="{{ route('investors.index') }}" class="mb-0">
                    <div class="d-flex align-items-center">
                        <label for="rowsPerPage" class="me-2">Rows per page:</label>
                        <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()">
                            <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                            <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <div>Total</div>
                    </div>
                </form>
                <div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan script untuk Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    // Inisialisasi Select2 untuk dropdown Investment Stage
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Select Investment Stage',
            allowClear: true
        });
    });

    document.querySelectorAll('tr[data-href]').forEach(tr => {
        tr.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox') {
                window.location.href = this.dataset.href;
            }
        });
    });
</script>
@endsection
