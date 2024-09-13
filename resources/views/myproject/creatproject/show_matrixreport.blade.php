@extends('layouts.app-imm')
@section('title', 'Laporan Matrix')

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
<div class="container mt-5 content-container" id="content-to-export">
    <h1>Matrix: {{ $metricProject->metric ? $metricProject->metric->name : 'Matrix Report' }}</h1>
    <h2>Perkembangan Matrix</h2>
    <div class="date-box">
        Tanggal: {{ \Carbon\Carbon::parse($matrixReport->created_at)->format('d/m/Y') }}
    </div>
    <div class="chart-container">
        {!! $chart->container() !!}
    </div>
    <div class="container mt-5 main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="content-box">
                    <h2>Evaluasi Matrix</h2>
                    <form action="{{ route('metric-projects.updateMatrixReport', [$project->id, $matrixReport->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="evaluation">Evaluation</label>
                            <textarea class="form-control" name="evaluation" id="evaluation" rows="3" required>{{ $matrixReport->evaluation }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="analysis">Analysis</label>
                            <textarea class="form-control" name="analysis" id="analysis" rows="3" required>{{ $matrixReport->analysis }}</textarea>
                        </div>
                        <input type="hidden" name="metric_id" value="{{ $metricProject->metric ? $metricProject->metric->id : '' }}">
                        <div class="btn-container">
                            <button type="submit" class="btn save-btn">Save</button>
                            <button id="export-btn" type="button" class="btn export-btn">Export PDF</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    document.getElementById('export-btn').addEventListener('click', function () {
        var elementHTML = document.getElementById('content-to-export');

        // Temporarily hide buttons and footer elements
        document.querySelectorAll('.btn-container, footer').forEach(function(element) {
            element.style.display = 'none';
        });

        html2canvas(elementHTML, {
            useCORS: true,
            scale: 2
        }).then(function (canvas) {
            // Restore buttons and footer after screenshot is taken
            document.querySelectorAll('.btn-container, footer').forEach(function(element) {
                element.style.display = '';
            });

            var imgData = canvas.toDataURL('image/png');
            var doc = new jspdf.jsPDF('p', 'mm', 'a4');
            var imgWidth = 210; // Width of A4 page in mm
            var pageHeight = 295; // Height of A4 page in mm
            var imgHeight = canvas.height * imgWidth / canvas.width;
            var heightLeft = imgHeight;
            var position = 20; // Starting position, 4 cm from the top

            doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight - 20;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                doc.addPage();
                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            doc.save('matrix-report.pdf');
        }).catch(function (error) {
            console.error("html2canvas error: ", error);
        });
    });
</script>

@endsection
