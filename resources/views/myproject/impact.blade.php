@extends('layouts.app-imm')
@section('title', 'Dampak Proyek')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            padding-top: 55px;
        }

        .navbar-brand {
            font-weight: bold;
        }
        .file-item-report{
            color:  #5940CB;
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

        .detail-matrix-section {
            margin-top: 20px;
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
            background-color: #f5f5f5;
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
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    /* Add animation */
    float: right;
    position: relative;
   
    text-decoration: none;
    /* Remove underline for link */
    display: inline-block;
    /* Ensure it behaves like a button */
}


    </style>
@endsection
@section('content')

    <body>


        <div class="container mt-5 detail-matrix-section">
            <h2>Detail Matrix</h2>
            <div class="card-header">Matrix : {{ $metricProject->metric->name }}</div>
            <div class="card">
                <div class="card-body">
                    <div class="section-title">Deskripsi Matrix</div>
                    <div class="form-section mt-2">
                        <p>{{ $metricProject->metric->definition }}</p>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="section-title">Input Data Matrix</div>
                            <div class="form-section mt-2">
                                <form id="metricForm"
                                    action="{{ route('metric-projects.storeReport', [$project->id, $metricProject->id]) }}"
                                    method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nilaiData">Nilai Data</label>
                                        <input type="text" name="value" id="value" class="form-control"
                                            value="{{ old('value') }}" placeholder="Masukkan nilai disini">
                                    </div>
                                    <div class="form-group">
                                        <label for="report_month">Bulan</label>
                                        <input type="number" name="report_month" id="report_month" class="form-control"
                                            value="{{ $nextMonth }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="report_year">Tahun</label>
                                        <input type="number" name="report_year" id="report_year" class="form-control"
                                            value="{{ $nextYear }}" readonly>
                                    </div>
                                    <button type="button" class="btn-save-custom" data-toggle="modal"
                                        data-target="#confirmationModal">Simpan Data</button>
                                </form>
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
                            <div class="section-title">Cara Hitung Matrix</div>
                            <div class="form-section mt-2">
                                @if (!empty($calculation))
                                    <p>{{ $calculation }}</p>
                                @else
                                    <p>Silahkan baca deskripsi matrix. Masukkan value sesuai dengan arahan deskripsi matrix
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <h3 class="text-center mt-3">Perkembangan Matrix</h3>
            <div>{!! $chart->container() !!}</div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            {!! $chart->script() !!}
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
                    <div class="col d-flex justify-content-end">
                        <a
                            href="{{ route('metric-projects.createMatrixReport', ['projectId' => $project->id, 'metricId' => $metricProject->metric_id, 'metricProjectId' => $metricProject->id]) }}"
                            class="add-report-btn">Tambah Laporan</a></div>




                </div>
            </div>
    
            <div class="container " style="margin-top: 100px;">
                <div class="row d-flex align-items-center justify-content-center">
                    @if ($matrixReports->isEmpty())
                        <div class="col-12">
                            <p class="text-center">Belum ada laporan.</p>
                        </div>
                    @else
                        @foreach ($matrixReports as $report)
                        <div class="col-6 col-md-4 col-lg-2">
                            <a href="{{ route('metric-projects.showReport', ['projectId' => $project->id, 'metricId' => $report->metric_id, 'reportId' => $report->id, 'metricProjectId' => $metricProject->id]) }}" >
                                <div class="file-report text-center">
                                    <div class="file-item-report mb-5">
                                        <i class="fas fa-file-alt fa-5x mb-2"></i>
                                        <p>{{ \Carbon\Carbon::parse($report->created_at)->format('d/m/y') }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            

    </body>


@endsection
