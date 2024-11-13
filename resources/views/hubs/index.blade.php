@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">

<div class="container-fluid">
    <div class="header d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('landingpage') }}">Home</a> &gt; <a href="#">Innovation Hub</a>
        </div>
    </div>

    <h2 class="header"><b>Hubs</b></h2>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3">
            <div class="filter-header" style="vertical-align: center;">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 10px;">
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('hubs.index') }}" class="mb-4">
                    @csrf
                    <!-- Province Search -->
                    <div class="mb-3">
                        <h6>Province</h6>
                        <input type="text" name="provinsi" class="form-control" placeholder="Province" value="{{ request()->provinsi }}">
                    </div>
                    <!-- City Search -->
                    <div class="mb-3">
                        <h6>City</h6>
                        <input type="text" name="kota" class="form-control" placeholder="City" value="{{ request()->kota }}">
                    </div>
                    <!-- Rank Search -->
                    <div class="mb-3">
                        <h6>Rank</h6>
                        <input type="text" name="rank" class="form-control" placeholder="Rank" value="{{ request()->rank }}">
                    </div>
                    <!-- Hub Name Search -->
                    <div class="mb-3">
                        <h6>Hub Name</h6>
                        <input type="text" name="name" class="form-control" placeholder="Hub Name" value="{{ request()->name }}">
                    </div>
                    <!-- Search Button -->
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

            <div class="table-responsive">
                <table class="table table-hover table-strip" style="margin-bottom: 0px; border-top-left-radius: 20px; border-top-right-radius: 20px; overflow: hidden; ">
                    <thead class="sub-heading-2">
                        <tr>
                            <th>Hub Name</th>
                            <th>Province</th>
                            <th>City</th>
                            <th>Top Investor Types</th>
                            <th>Top Funding Types</th>
                            <th>Rank</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hubs as $hub)
                        <tr data-href="{{ route('hubs.show', $hub->id) }}">
                            <td>{{ $hub->name }}</td>
                            <td>{{ $hub->provinsi }}</td>
                            <td>{{ $hub->kota }}</td>
                            <td>{{ $hub->top_investor_types }}</td>
                            <td>{{ $hub->top_funding_types }}</td>
                            <td>{{ $hub->rank }}</td>
                            <td>{{ $hub->description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3" style="padding: 20px;">
                <form method="GET" action="{{ route('hubs.index') }}" class="mb-0">
                    <div class="d-flex align-items-center">
                        <label for="rowsPerPage" class="me-2">Rows per page:</label>
                        <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()">
                            <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                            <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                        <div>
                            <span>Total</span>
                        </div>
                    </div>
                </form>
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
@endsection
