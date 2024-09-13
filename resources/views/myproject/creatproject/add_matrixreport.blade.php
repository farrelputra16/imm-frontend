@extends('layouts.app-imm')
@section('title', 'Tambah Laporan Matrix')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/myproject/creatproject/matrixreport.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<style>

    body{
      padding-top: 55px;  
    }
    .content-container h1 {
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
    .content-box h2 {
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

<div class="container mt-5 content-container">
    <h1>Tambah Matrix: {{ $metricProject->metric ? $metricProject->metric->name : 'New Matrix' }}</h1>
    <h2>Perkembangan Matrix</h2>
    <div class="chart-container">
        {!! $chart->container() !!}
    </div>
</div>

<div class="container mt-5 main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="content-box">
                <h2>Evaluasi Matrix</h2>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('js/myproject/impact.js') }}"></script>

@endsection
