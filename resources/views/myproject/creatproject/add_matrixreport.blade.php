@extends('layouts.app-imm')
@section('title', 'Tambah Laporan Matrix')

@section('css')
<link rel="stylesheet" href="{{ asset('css/myproject/creatproject/matrixreport.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
    .content-container h3 {
        background-color: #5940CB;
        color: #FFFFFF;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
    }
    .date-box {
        background-color: #ffffff;
        color: #000000;
        padding: 10px;
        text-align: center;
        margin: 20px 0;
        border-radius: 5px;
        width: 250px;
        margin-left: auto;
        margin-right: auto;
    }
    .content-box {
        border: 2px solid #D9D9D9;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    .content-box h4 {
        background-color: #5940CB;
        color: #FFFFFF;
        padding: 10px;
        margin: -20px -20px 20px -20px;
        text-align: center;
        border-radius: 5px 5px 0 0;
    }
    .btn {
        width: 150px;
        height: 40px;
        margin: 10px 5px;
        font-weight: bold;
        border-radius: 5px;
        border: 2px solid #5940CB;
        text-align: center;
        line-height: 28px;
    }
    .btn.export-btn {
        background-color: white;
        color: #5940CB;
    }
    .btn.export-btn:hover {
        background-color: #5940CB;
        color: white;
    }
    .btn.save-btn {
        background-color: #5940CB;
        color: white;
    }
    .btn.save-btn:hover {
        background-color: #4A235A;
    }
    .btn-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    input {
        border: none;
    }
    .table-container {
        margin-top: 20px;
    }
</style>
@endsection

@section('content')

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('myproject.myproject') }}" style="text-decoration: none; color: #212B36;">IMM</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('projects.view', ['id' => $project->id]) }}" style="text-decoration: none; color: #212B36;">Project Report</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('metric-impact.show', ['projectId' => $project->id, 'metricId' => $metricProject->metric_id, 'metricProjectId' => $metricProject->id]) }}" style="text-decoration: none; color: #212B36;">Metrics Score</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #5A5A5A;">Metrics Report</a>
            </li>

        </ol>
    </nav>
</div>

<div class="container mt-5 content-container">
    <h3>Tambah Matrix: {{ $metricProject->metric ? $metricProject->metric->name : 'New Matrix' }}</h3>
    <h4>Perkembangan Matrix</h4>
    <div class="chart-container">
        {!! $chart->container() !!}
    </div>
</div>

<div class="container mt-5 main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="content-box">
                <h4>Evaluasi Matrix</h4>
                <form action="{{ route('metric-projects.storeMatrixReport', [$project->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="evaluation">Evaluation</label>
                        <textarea class="form-control" name="evaluation" id="evaluation" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="analysis">Analysis</label>
                        <textarea class="form-control" name="analysis" id="analysis" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="metric_id" value="{{ $metricProject->metric ? $metricProject->metric->id : '' }}">
                    <div class="btn-container">
                        <button type="submit" class="btn save-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{!! $chart->script() !!}
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="{{ asset('js/myproject/impact.js') }}"></script>

@endsection
