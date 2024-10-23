@extends('layouts.app-landingpage')

@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
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
    .header-title {
        margin-top: 20px;
        margin-bottom: 20px;
        color: #6256CA;
        font-size: 2.5rem;
        font-weight: bold;
    }
    .company-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 40px;
    }
    .company-logo {
        width: 100px;
        height: 100px;
        border-radius: 10px;
    }
    .company-info h1 {
        font-size: 2rem;
        font-weight: bold;
    }
    .company-info h2 {
        color: #4caf50;
        font-size: 1.2rem;
    }
    .team-section h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .team-member {
        text-align: center;
        margin-bottom: 20px;
    }
    .team-member img {
        width: 100%;
        height: auto;
        border-radius: 10px;
    }
    .team-member h5 {
        margin-top: 10px;
        font-size: 1.1rem;
        font-weight: bold;
    }
    .team-member p {
        color: #777;
    }
    .funding-section h2 {
        color: #6256CA;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .table th {
        background-color: #6256CA;
        color: #fff;
    }
</style>

<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#" style="text-decoration: none; color: #212B36;">Find Company</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Profile Company</li>
        </ol>
    </nav>

    <h1 class="header-title">StartUp Profile</h1>

    <div class="company-card d-flex align-items-center">
        <img src="https://storage.googleapis.com/a1aa/image/s4A1ZQ8Gnf0wSCS0Sm0jNlEdWXp0yZo5LHBMaXXYTMRSzxzJA.jpg" alt="Lion Bird Logo" class="company-logo me-4" width="100" height="100" />
        <div class="company-info">
            <h1>{{ $company->nama }}</h1>
            <h2>{{ $company->business_model }}</h2>
            <p>{{ $company->startup_summary }}</p>
            <p>
                <i class="fas fa-phone-alt"></i> {{ $company->telepon }}<br />
                <i class="fas fa-map-marker-alt"></i> {{ $company->negara }}
            </p>
        </div>
    </div>

    <div class="team-section">
        <h2>Our Team</h2>
        <div class="row">
            <div class="col-md-3 team-member">
                <img src="https://storage.googleapis.com/a1aa/image/vA7bDlzrWyKfTyexGmFJ3A7PL8AoMBK1nVKmMvghDsf7MHPnA.jpg" alt="Claire - Web Designer" width="200" height="200" />
                <h5>Claire</h5>
                <p>Web Designer</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://storage.googleapis.com/a1aa/image/K0i4sHqkMHoyKJtmt3CExneik4YcQ4BxIUruSagQDrpQzxzJA.jpg" alt="Albert Flores - Marketing Coordinator" width="200" height="200" />
                <h5>Albert Flores</h5>
                <p>Marketing Coordinator</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://storage.googleapis.com/a1aa/image/W9cvDejWBenueJAsNFK1NCwkWneJ1yjTFExNesYxOeE9o545E.jpg" alt="Theresa Webb - Medical Assistant" width="200" height="200" />
                <h5>Theresa Webb</h5>
                <p>Medical Assistant</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://storage.googleapis.com/a1aa/image/03NVr7RZsmIJB9xo7BMLeJlfWEXlLSfZUyjlorEEhAF9MHPnA.jpg" alt="Eleanor Pena - UI/UX Designer" width="200" height="200" />
                <h5>Eleanor Pena</h5>
                <p>UI/UX Designer</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://storage.googleapis.com/a1aa/image/EjD92uHAXuIABRJGL5Mweak2KWXAhRepucAqDgkLOPyomjnTA.jpg" alt="Dianne Russell - Software Developer" width="200" height="200" />
                <h5>Dianne Russell</h5>
                <p>Software Developer</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://storage.googleapis.com/a1aa/image/Z1A9z2V3EYbdDFV43wtzvmxzZQbA3JaFCUX4Qsk29dtp545E.jpg" alt="Devon Lane - Project Manager" width="200" height="200" />
                <h5>Devon Lane</h5>
                <p>Project Manager</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://storage.googleapis.com/a1aa/image/ZGLdbWJITPo5MVCUrW0ETtD5YKFgVMIiDec4XVZZihwTzxzJA.jpg" alt="Marvin McKinney - Ethical Hacker" width="200" height="200" />
                <h5>Marvin McKinney</h5>
                <p>Ethical Hacker</p>
            </div>
            <div class="col-md-3 team-member">
                <img src="https://storage.googleapis.com/a1aa/image/wtLp4fePJ6od40JJ949nbeMBMe473aJW0J5r4szbYSqAaOecC.jpg" alt="Jerome Bell - UI/UX Designer" width="200" height="200" />
                <h5>Jerome Bell</h5>
                <p>UI/UX Designer</p>
            </div>
        </div>
    </div>

    <div class="funding-section mt-5">
        <h2>Previous Funding</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Target</th>
                    <th>Amount Raised</th>
                    <th>Lead Investor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($company->fundingRounds as $round)
                    <tr>
                        <td>{{ $round->name }}</td>
                        <td>Rp {{ number_format($round->target, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($round->money_raised, 0, ',', '.') }}</td>
                        <td>
                            @if ($round->leadInvestor)
                                <a href="{{ route('investors.show', $round->leadInvestor->id) }}">{{ $round->leadInvestor->org_name }}</a>
                            @else
                                No
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            <a href="{{ route('start.invest', ['companyId' => $company->id]) }}" class="btn btn-primary btn-lg">Start Invest</a>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#investorTable').DataTable({
            paging: false,
            ordering: true,
            info: false,
            responsive: true,
            searching: false,
            columnDefs: [{ targets: 1, orderable: false }]
        });
    });
</script>
@endsection
