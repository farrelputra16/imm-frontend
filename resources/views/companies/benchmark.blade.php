@extends('layouts.app-landingpage')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
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
        max-width: 60%;
    }
    .info-box {
        border: 1px solid #d3d3d3;
        padding-top: 15px;
        padding-bottom: 15px;
        padding-left: 15px;
        text-align: start;
        margin: 5% auto;
        border-radius: 2px;
        gap: 10px;
        transition: all 0.3s ease;
    }
    .funding-title {
        color: #7d7d7d;
    }
    .funding-amount {
        color: #333333;
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

</style>
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('companies.list', ['status' => 'benchmark']) }}" style="text-decoration: none; color: #212B36;">Find Company</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px; color: #5A5A5A;" aria-current="page">Company Profile</li>
        </ol>
    </nav>

    <div>
        <h2 style="color: #6256CA;">Company Profile</h2>
    </div>

    <div style="padding: 0px; margin-top: 32px;">
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
            </div>
        </div>
    </div>
    {{-- <p class="card-text">
        {{ $company->startup_summary }}
    </p> --}}
    <div class="additional-info" style="margin-top: 16px;">
        <div class="row">
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Total Funding</div>
                    <div class="funding-amount">
                        <h4>
                            <?php
                                $formatted_amount = '';

                                if ($total_funding >= 1000000) {
                                    $formatted_amount = number_format($total_funding / 1000000, 2, ',', '.') . 'M'; // M untuk million
                                } elseif ($total_funding >= 1000) {
                                    $formatted_amount = number_format($total_funding / 1000, 2, ',', '.') . 'K'; // K untuk thousand
                                } else {
                                    $formatted_amount = number_format($total_funding, 0, ',', '.');
                                }

                                // Menambahkan simbol dollar
                                $formatted_amount = '$' . $formatted_amount;

                                echo $formatted_amount;
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Location</div>
                    <div class="funding-amount">
                        <h4>
                            {{ $company->negara }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Last Funding</div>
                    <div class="funding-amount">
                        <h4>
                            <?php
                                $formatted_amount = '';

                                if ($funding_terbaru->money_raised >= 1000000) {
                                    $formatted_amount = number_format($funding_terbaru->money_raised / 1000000, 2, ',', '.') . 'M'; // M untuk million
                                } elseif ($funding_terbaru->money_raised >= 1000) {
                                    $formatted_amount = number_format($funding_terbaru->money_raised / 1000, 2, ',', '.') . 'K'; // K untuk thousand
                                } else {
                                    $formatted_amount = number_format($funding_terbaru->money_raised, 0, ',', '.');
                                }

                                // Menambahkan simbol dollar
                                $formatted_amount = '$' . $formatted_amount;

                                echo $formatted_amount;
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Funding Stage</div>
                    <div class="funding-amount">
                        <h4>
                            {{ $company->funding_stage }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Total Rounds</div>
                    <div class="funding-amount">
                        <h4>
                            {{ $total_round }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="info-box">
                    <div class="funding-title body-1">Investors</div>
                    <div class="funding-amount">
                        <h4>
                            {{ $total_investor }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <hr style="margin-top: 32px; margin-bottom: 32px; border-top: 2px solid #000000; opacity: 0.2;">
    </div>
    <div>
        <h3 style="color: #6256CA;">{{ $company->nama }} Overview</h3>
    </div>
    <div style="margin-top: 24px; margin-bottom: 24px;" class="body-1">
        {{ $company->startup_summary }}
    </div>
    <div>
        <hr style="margin-top: 32px; margin-bottom: 32px; border-top: 2px solid #000000; opacity: 0.2;">
    </div>
    <div class="row">
        {{-- Investment Over Time Chart --}}
        <div class="col-md-6">
            <h3 style="color: #6256CA;">Investment Over Time</h3>
            <div id="investmentChartContainer" style="width: 100%; height: 400px;">
                {!! $chart_investment->container() !!}
            </div>
        </div>

        {{-- Laba Bersih by Quarter Chart --}}
        <div class="col-md-6">
            <h3 style="color: #6256CA;">Net Profit by Quarter</h3>
            <div id="labaBersihChartContainer" style="width: 100%; height: 400px;">
                {!! $chart_laba_bersih->container() !!}
            </div>
        </div>
    </div>

    {{-- Include scripts once --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    {!! $chart_investment->script() !!}
    {!! $chart_laba_bersih->script() !!}

    <div>
        <hr style="margin-top: 32px; margin-bottom: 32px; border-top: 2px solid #000000; opacity: 0.2;">
    </div>

    {{-- Bagian Proejct --}}
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
                    @if ($allProjectsQuery->isEmpty())
                        <tr>
                            <td colspan="6" style="text-align: center; vertical-align: middle;">
                                <strong>Data kosong</strong>
                            </td>
                        </tr>
                    @else
                        @foreach ($allProjectsQuery as $project)
                            <tr>
                                <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">
                                    {{ $loop->iteration + ($allProjectsQuery->currentPage() - 1) * $allProjectsQuery->perPage() }}
                                </td>
                                <td style="vertical-align: middle;">{{ $project->nama }}</td>
                                <td style="vertical-align: middle;">Rp {{ number_format($project->jumlah_pendanaan, 0, ',', '.') }}</td>
                                <td style="vertical-align: middle;">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('j M, Y') : 'N/A' }}</td>
                                <td style="vertical-align: middle;">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('j M, Y') : 'N/A' }}</td>
                                <td style="vertical-align: middle; border-right: 1px solid #BBBEC5; text-align: center;">
                                    <a href="{{ route('projects_company.view', ['id' => $project->id, 'status' => 'benchmark', 'companyId' => $company->id]) }}" style="color: black; text-decoration: underline;">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
</div>
@endsection
