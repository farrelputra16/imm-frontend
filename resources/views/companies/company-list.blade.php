@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<!-- Updated Styles -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    h1 {
        font-size: 2.5rem;
        color: #6f42c1;
        margin-bottom: 30px;
        text-align: center;
    }

    .header a {
        color: #6c757d;
        text-decoration: none;
    }

    .header a:hover {
        text-decoration: underline;
    }

    .filter-section {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 5px;
    }

    .filter-section h5 {
        font-weight: bold;
    }

    .filter-section .form-check-label {
        margin-left: 10px;
    }

    .filter-section .btn-link {
        color: #6c757d;
        text-decoration: none;
    }

    .filter-section .btn-link:hover {
        text-decoration: underline;
    }

    .table-section {
        padding-left: 20px;
    }

    .table-section .form-control {
        border-radius: 20px;
    }

    .table-section .btn {
        border-radius: 20px;
    }

    .table-section .table th {
        background-color: #6f42c1;
        color: white;
    }

    .table-section .table td {
        vertical-align: middle;
        cursor: pointer; /* Add cursor pointer to show that rows are clickable */
    }

    .table-section .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .pagination {
        justify-content: flex-end;
    }

    .tag {
        display: inline-block;
        padding: 0.25em 0.4em;
        margin: 0.2em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        background-color: #6c757d;
        border-radius: 0.2rem;
        cursor: pointer; /* Indicate that tags are clickable */
    }

    .tag:hover {
        background-color: #5a6268; /* Darken the tag on hover */
    }
</style>

<div class="container-fluid">
    <div class="header d-flex justify-content-between align-items-center">
        <div>
            <a href="#">Home</a> &gt; <a href="#">Find Company</a>
        </div>
    </div>

    <h1 class="header">Companies</h1>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3 filter-section">
            <h5>FILTER</h5>
            <form method="GET" action="{{ route('companies.list') }}" class="mb-4" id="companySearchForm">
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
                    <select name="funding_type" id="funding_type" class="form-control" required>
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

        <!-- Table Section -->
        <div class="col-md-9 table-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <input class="form-control w-75" placeholder="Search Companies" type="text" />
                <button class="btn btn-primary">Search</button>
            </div>

            <!-- Companies Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="select_all">
                        </th>
                        <th scope="col">Organization Name</th>
                        <th scope="col">Founded Date</th>
                        <th scope="col">Last Funding Date</th>
                        <th scope="col">Last Funding Type</th>
                        <th scope="col">Number of Employees</th>
                        <th scope="col">Industries</th>
                        <th scope="col">Description</th>
                        <th scope="col">Job Departments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr data-href="{{ route('companies.show', $company->id) }}">
                            <td><input type="checkbox" class="select_company" data-id="{{ $company->id }}"></td>
                            <td>{{ $company->nama }}</td>
                            <td>{{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('j M, Y') : 'N/A' }}</td>
                            <td>{{ $company->latest_income_date ? \Carbon\Carbon::parse($company->latest_income_date)->format('j M, Y') : 'N/A' }}</td>
                            <td>
                                @if ($company->latest_funding_type)
                                    <div>{{ $company->latest_funding_type }}</div>
                                @else
                                    No funding data available
                                @endif
                            </td>
                            <td>{{ $company->jumlah_karyawan }}</td>
                            <td>{{ $company->tipe }}</td>
                            <td>{{ Str::limit($company->startup_summary, 100, '...') }}</td>
                            <td>{{ $company->posisi_pic }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    Row per page
                    <select class="form-select d-inline w-auto">
                        <option>10</option>
                        <option>20</option>
                        <option>30</option>
                    </select>
                    Total 1 - 10 of 200
                </div>
                <nav>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
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
            } else {
                document.querySelector('.wishlist-button').style.display = 'none';
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
        } else {
            document.querySelector('.wishlist-button').style.display = 'none';
            document.getElementById('company_ids').value = '';
        }
    }
</script>
@endsection
