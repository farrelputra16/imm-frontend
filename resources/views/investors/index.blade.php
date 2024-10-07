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
            <a href="#">Home</a> &gt; <a href="#">Find Investor</a>
        </div>
    </div>

    <h1 class="header">Investors</h1>

    <div class="row">
        <!-- Filter Section -->
        <div class="col-md-3 filter-section">
            <h5>FILTER</h5>
            <div class="mb-3">
                <h6>LOCATION</h6>
                <div class="form-check">
                    <input class="form-check-input" id="location1" type="checkbox" />
                    <label class="form-check-label" for="location1">Jabodetabek</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="location2" type="checkbox" />
                    <label class="form-check-label" for="location2">Bali</label>
                </div>
                <a class="btn btn-link" href="#">Others</a>
            </div>

            <div class="mb-3">
                <h6>INVESTMENT STAGE</h6>
                <div class="form-check">
                    <input class="form-check-input" id="stage1" type="checkbox" />
                    <label class="form-check-label" for="stage1">Seed Stage</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" id="stage2" type="checkbox" />
                    <label class="form-check-label" for="stage2">Early Stage Venture</label>
                </div>
            </div>

            <!-- Other filter options like Location, Investment Stage -->

            <!-- Industries Filter -->
            <div class="mb-3">
                <h6>INDUSTRIES</h6>
                <form method="GET" action="{{ route('investors.index') }}">
                    <div>
                        <button type="submit" name="industry" value="Software" class="tag">Software</button>
                        <button type="submit" name="industry" value="Health Care" class="tag">Health Care</button>
                        <button type="submit" name="industry" value="IT" class="tag">IT</button>
                        <button type="submit" name="industry" value="Education" class="tag">Education</button>
                        <button type="submit" name="industry" value="Manufacture" class="tag">Manufacture</button>
                        <button type="submit" name="industry" value="Energy" class="tag">Energy</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="col-md-9 table-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <input class="form-control w-75" placeholder="Search Investors" type="text" />
                <button class="btn btn-primary">Search</button>
            </div>

            <!-- Investors Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" />
                        </th>
                        <th scope="col">Organization Name</th>
                        <th scope="col">Number of Contacts</th>
                        <th scope="col">Number of Investments</th>
                        <th scope="col">Location</th>
                        <th scope="col">Description</th>
                        <th scope="col">Departments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($investors as $investor)
                    <tr onclick="window.location.href='{{ route('investors.show', $investor->id) }}'">
                        <td><input type="checkbox" /></td>
                        <td>
                            <img alt="Organization logo" height="20" src="https://placehold.co/20x20" width="20" />
                            {{ $investor->org_name }}
                        </td>
                        <td>{{ $investor->number_of_contacts }}</td>
                        <td>{{ $investor->number_of_investments }}</td>
                        <td>{{ $investor->location }}</td>
                        <td>{{ $investor->description }}</td>
                        <td>{{ $investor->departments }}</td>
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
@endsection
