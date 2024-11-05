@extends('layouts.app-landingpage')

@section('content')
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
    .header-title {
        margin-top: 20px;
        margin-bottom: 20px;
        color: #6256CA;
        font-size: 2.5rem;
        font-weight: bold;
    }
    /* Bagian Company */
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .card img {
        border-radius: 10px;
    }
    .card-title {
        font-weight: bold;
        margin-bottom: 0px;
    }
    .card-subtitle {
        color: #28a745;
        font-size: 1.25rem;
    }
    .card-text {
        margin-top: 2.0625rem; /* 33px in rem */
    }
    .contact-info {
        color: #6c757d;
        font-size: 1rem;
    }
    .align-items-center-profile {
        align-items: flex-start !important;
    }
    .additional-info {
        margin-top: 1rem;
    }
    .info-box {
        display: flex;
        align-items: center;
        border: 1px solid #dee2e6;
        border-radius: 10px;
        padding: 15px;
        gap: 10px;
        margin-bottom: 10px;
        height: 80px;
        width: 100%;
        max-width: 200px;
        transition: all 0.3s ease;
    }
    .custom-icon-color {
        color: #6f42c1 !important;
        font-size: 1rem;
    }
    .info-box:hover {
        background-color: #f1f1f1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .row .col-md-4 {
        padding-right: 5px;
        padding-left: 5px;
    }

    /* Bagian team */
    .team-section {
        display: flex;
        flex-wrap: wrap; /* Agar kolom dapat membungkus jika tidak muat */
        justify-content: space-between; /* Memberikan jarak antar kolom */
        gap: 20px; /* Menambahkan jarak antar kolom */
    }

    .card-team {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        flex: 0 1 calc(33.333% - 20px); /* Mengatur lebar kolom menjadi 1/3 dengan margin */
        margin-bottom: 20px; /* Jarak antara baris */
        transition: transform 0.3s, box-shadow 0.3s; /* Transisi untuk efek hover */
    }

    .card-team:hover {
        transform: translateY(-10px); /* Mengangkat kartu saat hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Menambah bayangan saat hover */
    }

    .card-img-top-profile {
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        height: 280px;
        object-fit: cover;
    }

    .card-title-profile {
        font-weight: bold;
        color: #333;
        margin-bottom: 0px;
    }

    .card-text-profile {
        color: #6c757d;
    }

    .team-section h2 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .funding-section h2 {
        color: #6256CA;
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 20px;
    }
</style>

<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #212B36;">Find Company</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px; color: #5A5A5A;" aria-current="page">Profile Company</li>
        </ol>
    </nav>

    <div>
        <h2 style="color: #6256CA;">StartUp Profile</h2>
    </div>

    <div class="container mt-5 mb-5" style="padding: 0px;">
        <div class="card p-4">
            <div class="row align-items-center-profile">
                <div class="col-md-3">
                    <img
                        alt="Lion Bird logo with a lion's face and bird's body"
                        class="img-fluid"
                        height="200"
                        src="{{ env('APP_URL') . $company->image ? env('APP_URL') . $company->image : asset('images/1720765715.webp') }}"
                        width="200"
                    />
                </div>
                <div class="col-md-9">
                    <h2 class="card-title">{{ $company->nama }}</h2>
                    <h2 class="card-subtitle mb-2">{{ $company->business_model }}</h2>
                    <p class="card-text">
                        {{ $company->startup_summary }}
                    </p>
                    <div class="additional-info">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <i class="fas fa-phone-alt custom-icon-color"></i>
                                    <span>{{ $company->telepon }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <i class="fas fa-map-marker-alt custom-icon-color"></i>
                                    <span>{{ $company->negara }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ $company->profile }}" target="_blank" title="{{ $company->profile }}" style="color: black; text-decoration: none;">
                                    <div class="info-box">
                                        <i class="fas fa-globe custom-icon-color"></i>
                                        <span id="company-profile">{{ Str::limit($company->profile, 18, '...') }}</span>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <i class="fas fa-users custom-icon-color"></i>
                                    <span>{{ $company->jumlah_karyawan }}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <i class="fas fa-dollar-sign custom-icon-color"></i>
                                    <span id="funding-stage">{{ $company->funding_stage }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 align-content-center">
        <div>
            <h2 class="text-center" style="color: #5A5A5A;">Our Team</h2>
        </div>
        <div class="row"> <!-- Tambahkan wrapper untuk membuat kolom -->
            @foreach ($team as $person)
                <div class="col-md-4 mb-4" style="padding: 10px;"> <!-- Menggunakan Bootstrap untuk 3 kolom dan menambahkan margin bottom -->
                    <div class="card-team" style="width: 100%;">
                        <img
                            alt="Person wearing glasses and a beanie, smiling while looking away, with an urban background"
                            class="card-img-top card-img-top-profile"
                            height="227"
                            src="{{  env('APP_URL') . $person->pivot->image ? env('APP_URL') . $person->pivot->image : asset('images/1720765715.webp') }}"
                            width="286"
                        />
                        <div class="card-body">
                            <h3 class="card-title-profile" style="margin-bottom: 5px; padding:0px;">{{ $person->name }}</h3>
                            <p class="card-text-profile sub-heading-1">{{$person->pivot->primary_job_title}} {{ $person->department }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="funding-section mt-5">
        <h2>Funding</h2>
        {{-- Bagian table dengan desain baru --}}
        <div class="table-responsive" style="border-top: none;">
            <table class="table table-hover table-strip">
                <thead>
                    <tr>
                        <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle; border-top: none; border-bottom: none;">No</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: middle; border-top: none; border-bottom: none;">Name</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: middle; border-top: none; border-bottom: none;">Target</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: middle; border-top: none; border-bottom: none;">Amount Raised</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: middle; border-top: none; border-bottom: none;">Lead Investor</th>
                        <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: middle; border-top: none; border-bottom: none;">Tahun</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fundingRounds as $round)
                        <tr>
                            <td style="vertical-align: middle; border-left: 1px solid #ddd;">
                                {{ $loop->iteration + ($fundingRounds->currentPage() - 1) * $fundingRounds->perPage() }}
                            </td>
                            <td style="vertical-align: middle;">{{ $round->name }}</td>
                            <td style="vertical-align: middle;">Rp {{ number_format($round->target, 0, ',', '.') }}</td>
                            <td style="vertical-align: middle;">Rp {{ number_format($round->money_raised, 0, ',', '.') }}</td>
                            <td style="vertical-align: middle;">
                                @if ($round->leadInvestor)
                                    <a href="{{ route('investors.show', $round->leadInvestor->id) }}">{{ $round->leadInvestor->org_name }}</a>
                                @else
                                    No
                                @endif
                            </td>
                            <td style="vertical-align: middle; border-right: 1px solid #ddd;">{{ date('Y', strtotime($round->announced_date)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer sebagai bagian dari tabel -->
       <!-- Footer untuk Funding Rounds -->
        <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
            <form method="GET" action="{{ route('companies.show', $company->id) }}" class="mb-0">
                <div class="d-flex align-items-center">
                    <label for="rowsPerPage" class="me-2">Rows per page:</label>
                    <select name="funding_rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()" style="width: 50px; margin-left: 5px; margin-right: 5px;">
                        <option value="10" {{ request('funding_rows') == 10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ request('funding_rows') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('funding_rows') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <div>
                        @if(!$fundingRounds->isEmpty())
                            <span>Total {{ ($fundingRounds->currentPage() - 1) * $fundingRounds->perPage() + 1 }} - {{ ($fundingRounds->currentPage() - 1) * $fundingRounds->perPage() + $fundingRounds->count() }} of {{ $fundingRounds->total() }}</span>
                        @else
                            <span>No funding rounds found.</span>
                        @endif
                    </div>
                </div>
            </form>
            <div style="margin-top: 5px;">
                {{ $fundingRounds->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    {{-- Bagian table untuk project list --}}
    <div class="funding-section mt-5">
        <h2>Project List</h2>
        <div class="table-responsive">
            <table id="ongoing-project-table" class="table table-hover table-strip mt-3">
                <thead>
                    <tr>
                        <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">No.</th>
                        <th scope="col" style="vertical-align: middle;">Project Name</th>
                        <th scope="col" style="vertical-align: middle;">Budget Plan</th>
                        <th scope="col" style="vertical-align: middle;">Start Date</th>
                        <th scope="col" style="vertical-align: middle;">End Date</th>
                        <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Details Project</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allProjectsQuery as $project)
                        <tr>
                            <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">{{ $loop->iteration  + ($allProjectsQuery->currentPage() - 1) * $allProjectsQuery->perPage()}}</td>
                            <td style="vertical-align: middle;">{{ $project->nama }}</td>
                            <td style="vertical-align: middle;">Rp{{ number_format($project->jumlah_pendanaan, 0, ',', '.') }}</td>
                            <td style="vertical-align: middle;">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('j M, Y') : 'N/A' }}</td>
                            <td style="vertical-align: middle;">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('j M, Y') : 'N/A' }}</td>
                            <td style="vertical-align: middle; border-right: 1px solid #BBBEC5; text-align: center;">
                                <a href="{{ route('projects_company.view', ['id' => $project->id]) }}" style="color: black; text-decoration: underline;">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Footer untuk Proyek Belum Selesai -->
        <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
            <form method="GET" action="{{ route('companies.show', $company->id) }}" class="mb-0">
                <div class="d-flex align-items-center">
                    <label for="rowsPerPageOngoing" class="me-2">Rows per page:</label>
                    <select name="project_rows" id="rowsPerPageOngoing" class="form-select me-2" onchange="this.form.submit()" style="width: 50px; margin-left: 5px; margin-right: 5px;">
                        <option value="10" {{ request('project_rows') == 10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ request('project_rows') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('project_rows') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <div>
                        <span>Total {{ $allProjectsQuery->firstItem() }} - {{ $allProjectsQuery->lastItem() }} of {{ $allProjectsQuery->total() }}</span>
                    </div>
                </div>
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="company_id" value="{{ $company->id }}">
            </form>
            <div style="margin-top: 5px;">
                {{ $allProjectsQuery->appends(['search' => request('search'), 'project_rows' => request('project_rows')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('start.invest', ['companyId' => $company->id]) }}" class="btn btn-primary btn-lg">Start Invest</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Fungsi untuk memformat teks
    function formatText(text) {
        // Menghilangkan tanda "_" dan mengganti dengan spasi
        text = text.replace(/_/g, ' ');

        // Mengkapitalisasi huruf pertama dari setiap kata
        text = text.split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');

        return text;
    }

    // Ambil elemen span dan format teksnya
    const fundingStageElement = document.getElementById('funding-stage');
    const fundingStageText = fundingStageElement.innerText; // Mengambil teks dari span
    fundingStageElement.innerText = formatText(fundingStageText); // Mengatur teks yang sudah diformat
</script>
@endsection
