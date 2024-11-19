@extends('layouts.app-table')
@section('title', 'Dampak Proyek')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
      integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

<style>
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
    .section-title {
        background-color: #5940CB;
        color: white;
        padding: 10px;
        border-radius: 5px;
    }
</style>

@section('content')
    <div class="container mt-5 detail-matrix-section">
        <h2>Detail Matrix</h2>
        <div class="card">
            <div class="card-header">Matrix: {{ $metricProject->metric->name }}</div>
            <div class="card-body shadown-sm">
                <div class="section-title">Deskripsi Matrix</div>
                <div class="form-section mt-2 shadow-sm" style="padding: 20px;">
                    <p>{{ $metricProject->metric->definition }}</p>
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

    <div class="container mt-5 mb-3 matrix-report-container">
        <h3>Matrix Report</h3>
        <div class="row d-flex align-items-center justify-content-center">
            @if ($matrixReports->isEmpty())
                <div class="col-12">
                    <p class="text-center">Belum ada laporan.</p>
                </div>
            @else
                @foreach ($matrixReports as $report)
                    <div class="col-6 col-md-4 col-lg-2 mb-4">
                        <a href="{{ route('metric-projects.showReport', ['projectId' => $project->id, 'metricId' => $report->metric_id, 'reportId' => $report->id, 'metricProjectId' => $metricProject->id, 'companyId' => $company->id]) }}">
                            <div class="card text-center">
                                <div class="card-body">
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
@endsection
