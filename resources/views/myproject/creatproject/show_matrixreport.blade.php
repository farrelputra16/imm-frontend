@php
    $layout = ($userRole == 'USER' && $status != 'benchmark') ? 'layouts.app-imm' : 'layouts.app-landingpage';
    if ($status == 'investor'){
        $layout = 'layouts.app-investors';
    }
@endphp

@extends($layout)

@section('title', 'Laporan Matrix')

@section('content')
<link rel="stylesheet" href="{{ asset('css/myproject/creatproject/matrixreport.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
    /* Mengatur font family untuk seluruh halaman */
    body {
        font-family: 'Poppins', sans-serif; /* Menggunakan Inter untuk isi/content */
    }

    /* Mengatur font family untuk heading */
    h1, h2, h3, h4 {
        font-family: 'Poppins', sans-serif; /* Menggunakan Work Sans untuk heading */
    }

    /* Mengatur font family untuk sub-heading dan body */
    .sub-heading-1, .sub-heading-2, .body-1, .body-2 {
        font-family: 'Poppins', sans-serif; /* Set font to Poppins */
    }

    .container {
        flex: 1; /* Membuat kontainer mengambil ruang yang tersedia */
        max-width: 1400px;
        margin: 0 auto;
    }
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
<div class="container content-container" id="content-to-export" style="margin-bottom: 50px;">
    <nav aria-label="breadcrumb" style="margin-bottom: 32px;">
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
                @if ($status != 'investor')
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
            @endif
            @if ($status == 'investor')
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('myproject.myproject', ['company_id' => $companyId, 'status' => $status]) }}" style="text-decoration: none; color: #5A5A5A;">Project Report</a>
                </li>
            @endif
            @if ($status == 'investor')
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('projects.view', ['id' => $project->id, 'status' => $status, 'companyId' => $companyId]) }}" style="text-decoration: none; color: #5A5A5A;">Project Detail</a>
                </li>
            @endif
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('metric-impact.show', ['projectId' => $project->id, 'metricId' => $metricProject->metric_id, 'metricProjectId' => $metricProject->id, 'status' => $status, 'companyId' => $companyId]) }}" style="text-decoration: none; color: #212B36;">Metrics Score</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #5A5A5A;">Metrics Report</a>
            </li>
        </ol>
    </nav>
    <h3>Matrix: {{ $metricProject->metric ? $metricProject->metric->name : 'Matrix Report' }}</h3>
    <h4>Perkembangan Matrix</h4>
    <div class="date-box">
        Tanggal: {{ \Carbon\Carbon::parse($matrixReport->created_at)->translatedFormat('d F Y') }}
    </div>
    <div class="chart-container">
        {!! $chart->container() !!}
    </div>
    <div class="container mt-5 main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="content-box">
                    <h4>Evaluasi Matrix</h4>
                    <form action="{{ route('metric-projects.updateMatrixReport', [$project->id, $matrixReport->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="evaluation">Evaluation</label>
                            @if ($userRole == 'USER' && $status != 'benchmark')
                                <textarea class="form-control" name="evaluation" id="evaluation" rows="3" required>{{ $matrixReport->evaluation }}</textarea>
                            @else
                                <textarea class="form-control" name="evaluation" id="evaluation" rows="3" required readonly>{{ $matrixReport->evaluation }}</textarea>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="analysis">Analysis</label>
                            @if ($userRole == 'USER' && $status != 'benchmark')
                                <textarea class="form-control" name="analysis" id="analysis" rows="3" required>{{ $matrixReport->analysis }}</textarea>
                            @else
                                <textarea class="form-control" name="analysis" id="analysis" rows="3" required readonly>{{ $matrixReport->analysis }}</textarea>
                            @endif
                        </div>
                        <input type="hidden" name="metric_id" value="{{ $metricProject->metric ? $metricProject->metric->id : '' }}">
                        <div class="btn-container">
                            @if ($userRole == 'USER' && $status != 'benchmark')
                                <button type="submit" class="btn save-btn">Save</button>
                            @endif
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
