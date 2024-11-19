@php
    $layout = ($userRole == 'USER' && $status != 'benchmark') ? 'layouts.app-imm' : 'layouts.app-landingpage';
@endphp

@extends($layout)

@section('title', 'Dampak Proyek')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <style>
        .navbar-brand {
            font-weight: bold;
        }
        .file-item-report{
            color:  #5940CB;
        }
        .matrix-report-container {
            background-color: #f8f9fa; /* Warna latar belakang untuk kontainer */
            border-radius: 0.5rem; /* Sudut melengkung */
            padding: 20px; /* Padding di dalam kontainer */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bayangan */
        }

        .file-report {
            background-color: #ffffff; /* Warna latar belakang kartu */
            border: 1px solid #dee2e6; /* Border */
            border-radius: 0.5rem; /* Sudut melengkung */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bayangan */
        }

        .file-item-report {
            margin-bottom: 15px; /* Jarak bawah untuk item file */
            transition: transform 0.2s; /* Transisi saat hover */
        }

        .file-item-report:hover {
            transform: scale(1.05); /* Efek zoom saat hover */
        }
        .matrix-section {
            margin-top: 20px;
        }

        .matrix-section h2 {
            font-size: 24px;
            font-weight: bold;
        }

        .matrix-section .card {
            border: none;
            margin-bottom: 20px;
        }

        .matrix-section .card-header {
            background-color: #5940CB;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
        }

        .matrix-section .card-body {
            background-color: #f5f5f5;
            padding: 20px;
        }

        .matrix-section .form-group label {
            font-weight: bold;
        }

        .matrix-section .form-group input,
        .matrix-section .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-export {
            background-color: transparent;
            color: #3F3F46;
            border: 1px solid #6256CA;
            padding: 10px 20px;
            border-radius: 8px;
            margin-right: 20px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
        }

        .matrix-section .btn-save {
            background-color: #5940CB;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            display: inline-block;
            width: 100%;
            text-align: center;
        }

        .matrix-section .btn-save:hover {
            background-color: #4A35B1;
        }

        .btn-save-custom {
            background-color: transparent;
            border: 2px solid #5940CB;
            color: #5940CB;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            padding: 10px 20px;
            text-align: center;
            display: block;
            margin-top: 10px;
            width: fit-content;
        }

        .btn-save-custom:hover {
            background-color: #5940CB;
            color: white;
        }

        .detail-matrix-section .card-header {
            background-color: #5940CB;
            color: white;
            font-weight: bold;
        }

        .detail-matrix-section .section-title {
            background-color: #5940CB;
            color: white;
            padding: 10px;
            border-radius: 5px;
        }

        .detail-matrix-section .form-section {
            background-color: #E9EBF8;
            padding: 20px;
            border-radius: 5px;
        }

        .btn-keluar {
            width: 183px;
            height: 50px;
            background-color: white;
            border: 2px solid #5940CB;
            color: #5940CB;
            border-radius: 7px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-masuk {
            width: 183px;
            height: 50px;
            background-color: #5940CB;
            color: white;
            border: none;
            border-radius: 7px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .modal-body {
            margin: 0;
            padding: 20px;
        }

        .btnn {
            display: flex;
            justify-content: center;
            gap: 20px;
            /* Adds space between buttons */
            margin-top: 20px;
        }

        .add-report-btn {
            background-color: #5940cb;
            color: white; /* Warna teks tombol */
            padding: 10px 20px; /* Padding tombol */
            border-radius: 0.25rem; /* Sudut melengkung tombol */
            text-decoration: none; /* Menghilangkan garis bawah */
            transition: background-color 0.3s; /* Transisi saat hover */
        }

        .add-report-btn:hover {
            background-color: #5940ba; /* Warna saat hover */
            color: white;
            text-decoration: none;
        }

        /* bread */
        .breadcrumb {
            background-color: white;
            padding: 0;
            margin-bottom: 32px;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            margin-right: 14px;
            color: #9CA3AF;
        }

        .custom-select-wrapper {
            position: relative;
            display: inline-block;
            justify-content: end;
        }

        .custom-select {
            background-color: #f0f0ff;
            border: 1px solid #7a5cff;
            border-radius: 8px;
            padding: 5px 10px;
            margin-right: 10px;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: none;
        }

        .custom-select-wrapper .custom-select {
            padding-right: 30px;
        }

        .custom-select-arrow {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .custom-select-arrow::after {
            content: "\25BC";
            font-size: 12px;
        }

        .custom-select::-webkit-scrollbar {
            display: none;
        }

    </style>
@endsection
@section('content')
    <body>
        <div class="container detail-matrix-section">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        @if ($userRole == 'USER' && $status != 'benchmark')
                            <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                        @else
                            @if ($status == 'benchmark' || $status == 'company')
                                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                            @else
                                <a href="{{ route('investments.pending') }}" style="text-decoration: none; color: #212B36;">Home</a>
                            @endif
                        @endif
                    </li>
                    @if ($userRole == 'USER' && $status != 'benchmark')
                        <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                            <a href="{{ route('myproject.myproject') }}" style="text-decoration: none; color: #212B36;">IMM</a>
                        </li>
                        <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                            <a href="{{ route('projects.view', ['id' => $project->id]) }}" style="text-decoration: none; color: #212B36;">Project Report</a>
                        </li>
                    @else
                        <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                            @if ($status == 'benchmark')
                                <a href="{{ route('companies.list', ['status' => 'benchmark']) }}" style="text-decoration: none; color: #212B36;">Find Company</a>
                            @elseif ($status == 'company')
                                <a href="{{ route('companies.list', ['status' => 'company']) }}" style="text-decoration: none; color: #212B36;">Find Company</a>
                            @endif
                        </li>
                        <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px; color: #212B36;" aria-current="page">
                            @if ($status == 'company')
                                <a href="{{ route('companies.show', $companyId) }}" style="text-decoration: none; color: #212B36;">Company Profile</a>
                            @elseif ($status == 'benchmark')
                                <a href="{{ route('companies.benchmark', ['id' => $companyId]) }}" style="text-decoration: none; color: #212B36;">Company Profile</a>
                            @endif
                        </li>
                        <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                            @if ($status == 'company')
                                <a href="{{ route('projects_company.view', ['id' => $project->id, 'status' => 'company', 'companyId' => $companyId]) }}" style="text-decoration: none; color: #5A5A5A;">Project Report</a>
                            @elseif ($status == 'benchmark')
                                <a href="{{ route('projects_company.view', ['id' => $project->id, 'status' => 'benchmark', 'companyId' => $companyId]) }}" style="text-decoration: none; color: #5A5A5A;">Project Report</a>
                            @endif
                        </li>
                    @endif
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="#" style="text-decoration: none; color: #5A5A5A;">Metrics Score</a>
                    </li>
                </ol>
            </nav>
            <h2 style="margin-bottom: 22px;">Detail Matrix</h2>
            <div class="card-header sub-heading-1" style="color: #DADBE3">Matrix : {{ $metricProject->metric->name }}</div>
            <div class="card">
                <div class="card-body">
                    <div class="section-title sub-heading-1" style="color: #DADBE3">Deskripsi Matrix</div>
                    <div class="form-section mt-2">
                        <p class="body-2" style="color: #3F3F46">{{ $metricProject->metric->definition }}</p>
                    </div>
                    @if ($userRole == 'USER' && $status != 'benchmark')
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="section-title sub-heading-1" style="color: #DADBE3">Input Data Matrix</div>
                                <div class="form-section mt-2">
                                    <form id="metricForm"
                                        action="{{ route('metric-projects.storeReport', [$project->id, $metricProject->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nilaiData sub-heading-1" style="color: #3F3F46">Nilai Pengukuran</label>
                                            <input type="text" name="value" id="value" class="form-control body-2"
                                                value="{{ old('value') }}" placeholder="Masukkan nilai disini">
                                        </div>
                                        <div class="form-group">
                                            <label for="report_month sub-heading-1" style="color: #3F3F46">Bulan</label>
                                            <input type="text" name="report_month" id="report_month" class="form-control body-2"
                                                value="{{ $nextMonthName }}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="report_year sub-heading-1" style="color: #3F3F46">Tahun</label>
                                            <input type="number" name="report_year" id="report_year" class="form-control body-2"
                                                value="{{ $nextYear }}" readonly>
                                        </div>
                                        <button type="button" class="btn-save-custom" data-toggle="modal"
                                            data-target="#confirmationModal">Save</button>
                                    </form>

                                    {{-- Buat nambah data poup konfirmasi --}}
                                    <div class="modal fade" id="confirmationModal" tabindex="-1"
                                        aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content shadow">
                                                <div class="modal-body">
                                                    <h5 class="modal-title" id="confirmationModalLabel">Apakah data sudah benar?
                                                    </h5>
                                                    <p class="text-muted">Note: Data yang anda tambahkan tidak bisa diubah
                                                        kembali, pastikan semua input
                                                        data sudah benar</p>
                                                    <div class="btnn">
                                                        <button type="button" class="btn btn-keluar" id="confirmUpdate">Belum,
                                                            cek kembali</button>
                                                        <button type="submit" form="metricForm" class="btn btn-masuk">Ya, sudah
                                                            benar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="section-title sub-heading-1" style="color: #DADBE3" >Cara Hitung Matrix</div>
                                <div class="form-section mt-2">
                                    @if (!empty($calculation))
                                        <p class="body-2" style="color: #3F3F46">{{ $calculation }}</p>
                                    @else
                                        <p class="body-2" style="color: #3F3F46">Silahkan baca deskripsi matrix. Masukkan value sesuai dengan arahan deskripsi matrix
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-between" style="margin-bottom: 20px;">
                <h3 class="text-start mt-3">Perkembangan Matrix</h3>
                <button id="exportBtn" class="btn-export mt-3">Export as PDF</button>
            </div>
            <div style="display: flex; justify-content: flex-end;">
                <div class="custom-select-wrapper">
                    <form action="{{ route('metric-impact.show', ['projectId' => $projectId, 'metricId' => $metricId, 'metricProjectId' => $metricProjectId]) }}" method="get">
                        <select class="custom-select scrollbar" style="width: 110px;" id="year" name="year" onchange="this.form.submit()">
                            <option value="">All Years</option>  <!-- Menambahkan opsi "All Years" yang akan mengosongkan filter tahun -->
                            @foreach(range(now()->year - 10, now()->year + 10) as $yearOption)
                                <option value="{{ $yearOption }}" {{ request('year') == $yearOption ? 'selected' : '' }}>{{ $yearOption }}</option>
                            @endforeach
                        </select>
                        <div class="custom-select-arrow"></div>
                    </form>
                </div>
            </div>

            <div id="chartContainer">{!! $chart->container() !!}</div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
            {!! $chart->script() !!}

            <script>
                // Export chart as PDF
                document.getElementById('exportBtn').addEventListener('click', function (event) {
                    event.preventDefault();
                    const { jsPDF } = window.jspdf;

                    const title = document.querySelector('h3').innerText;
                    const matrix = document.querySelector('.card-header.sub-heading-1').innerText;

                    const pdf = new jsPDF({
                        orientation: 'landscape',
                        unit: 'pt',
                        format: 'a4'
                    });

                    pdf.setFontSize(16);
                    pdf.text(title, 40, 40);
                    pdf.text(matrix, 40, 60);

                    html2canvas(document.getElementById('chartContainer'), {
                        scale: 2,
                        useCORS: true,
                        allowTaint: true
                    }).then(function (canvas) {
                        const imgData = canvas.toDataURL('image/png');
                        const imgWidth = pdf.internal.pageSize.getWidth() - 80;
                        const imgHeight = (canvas.height * imgWidth) / canvas.width;

                        pdf.addImage(imgData, 'PNG', 40, 80, imgWidth, imgHeight);
                        pdf.save('Impact-Report.pdf');
                    });
                });
            </script>
        </div>

        <div class="container mt-5 survey-support-container">
            <div class="months-new d-flex justify-content-between">
            </div>
        </div>

        <div class="container mt-5 mb-3 matrix-report-container">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col">
                    <h3>Matrix Report</h3>
                </div>
                @if ($userRole == 'USER' && $status != 'benchmark')
                    <div class="col d-flex justify-content-end">
                        <a href="{{ route('metric-projects.createMatrixReport', ['projectId' => $project->id, 'metricId' => $metricProject->metric_id, 'metricProjectId' => $metricProject->id, 'companyId' => $companyId]) }}" class="add-report-btn">Tambah Laporan</a>
                    </div>
                @endif
            </div>

            <div class="row mt-3">
                @if ($matrixReports->isEmpty())
                    <div class="col-12">
                        <p class="text-center">Belum ada laporan.</p>
                    </div>
                @else
                    <div class="col-12">
                        <div class="file-report card">
                            <div class="card-body text-center">
                                <div class="row">
                                    @foreach ($matrixReports as $report)
                                    <div class="col-6 col-md-4 col-lg-2 mb-4">
                                        <a href="{{ route('metric-projects.showReport', ['projectId' => $project->id, 'metricId' => $report->metric_id, 'reportId' => $report->id, 'metricProjectId' => $metricProject->id, 'status' => $status, 'userRole' => $userRole, 'companyId' => $companyId]) }}">
                                            <div class="file-item-report">
                                                <i class="fas fa-file-alt fa-5x mb-2"></i>
                                                <p>{{ \Carbon\Carbon::parse($report->created_at)->format('d M Y') }}</p>
                                            </div>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
@endsection
