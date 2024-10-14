@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">

<div class="container-fluid">
    <div class="header d-flex justify-content-between align-items-center">
        <div>
            <a href="{{ route('landingpage') }}">Home</a> &gt; <a href="#">People</a>
        </div>
    </div>

    <h1 class="header"><b>People</b></h1>

    <div class="row">
        <!-- Sidebar Filter Section -->
        <div class="col-md-3">
            <div class="filter-header">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Filter Icon" style="width: 20px; height: 20px; margin-left: 10px;">
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('people.index') }}">
                    <div class="mb-3">
                        <h6>Location</h6>
                        <input type="text" name="location" class="form-control" placeholder="Location" value="{{ request()->location }}">
                    </div>

                    <!-- Role Dropdown -->
                    <div class="mb-3">
                        <h6>Role</h6>
                        <select name="role" class="form-control">
                            <option value="">Select Role</option>
                            <option value="mentor" {{ request()->role == 'mentor' ? 'selected' : '' }}>Mentor</option>
                            <option value="pekerja" {{ request()->role == 'pekerja' ? 'selected' : '' }}>Pekerja</option>
                            <option value="konsultan" {{ request()->role == 'konsultan' ? 'selected' : '' }}>Konsultan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <h6>Organization</h6>
                        <input type="text" name="primary_organization" class="form-control" placeholder="Organization" value="{{ request()->primary_organization }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </form>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="col-md-9 table-section">
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input class="form-control" placeholder="Search People" type="text">
                <button class="btn">Search</button>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-strip">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Primary Job Title</th>
                            <th>Primary Organization</th>
                            <th>Role</th>
                            <th>Location</th>
                            <th>Linkedin</th>
                            <th>Phone Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($people as $person)
                        <tr data-href="{{ route('people.show', $person->id) }}">
                            <td>{{ $person->name }}</td>
                            <td>{{ $person->primary_job_title }}</td>
                            <td>{{ $person->company ? $person->company->nama : 'N/A' }}</td>
                            <td>{{ ucfirst($person->role) }}</td>
                            <td>{{ $person->location }}</td>
                            <td>
                                @if($person->linkedin_link)
                                    <a href="{{ $person->linkedin_link }}" target="_blank">Link</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ $person->phone_number }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3" style="padding: 20px;">
                <form method="GET" action="{{ route('people.index') }}" class="mb-0">
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
