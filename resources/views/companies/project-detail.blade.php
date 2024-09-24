@extends('layouts.app-table')
@section('title', 'Detail Proyek')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .disabled {
            cursor: not-allowed !important;
        }

        /* Scrollbar */
        .scrollable {
            max-height: 408px;
            overflow-y: auto;
        }

        .upload-container {
            max-width: 400px; /* Tambahkan batasan maksimum lebar */
            max-height: 300px; /* Tambahkan batasan maksimum tinggi */
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #ccc;
            background-size: cover;
            object-fit: cover;
            object-position: center;
        }

        .upload-container label {
            cursor: default;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .hidden {
            display: none;
        }

        .card-title {
            font-weight: bold;
        }

        .edit-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Non-editable input styles */
        input[readonly],
        textarea[readonly] {
            background-color: #e9ecef;
            pointer-events: none;
        }

        /* Disabled buttons */
        .disabled-btn {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <!-- Image Container -->
                    <label for="img-upload" class="w-100">
                        <img class="upload-container"
                            src="{{ $project->img ? asset('images/' . $project->img) : asset('images/default_project.png') }}"
                            id="image-preview" width="100%" height="400px;">
                    </label>
                </div>
            </div>
        </div>        

        <!-- Left Content -->
        <div class="row mt-3">
            <div class="col-lg-8">
                <!-- Nama Proyek -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Nama Proyek</h5>
                        <input type="text" class="form-control" id="nama-proyek" name="nama"
                            value="{{ $project->nama }}" readonly>
                    </div>
                </div>

                <!-- Deskripsi Proyek -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Deskripsi Proyek</h5>
                        <textarea class="form-control" id="deskripsi-proyek" name="deskripsi" rows="4" readonly>{{ $project->deskripsi }}</textarea>
                    </div>
                </div>

                <!-- SDG's Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">SDG'S</h5>
                        <div class="row">
                            @foreach ($project->sdgs as $sdg)
                                <div class="col-3 d-flex justify-content-center align-items-center mt-3">
                                    <img src="{{ env('APP_BACKEND_URL') . '/images/' . $sdg->img }}"
                                        class="img-fluid" alt="{{ $sdg->order }}. {{ $sdg->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Dokumen Validitas -->
                <div class="card mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Dokumen Validitas Data</h5>
                        <ul class="list-group" id="file-list">
                            @if ($documents->isEmpty())
                                <li class="list-group-item no-documents">No documents found.</li>
                            @else
                                @foreach ($documents as $document)
                                    <li class="list-group-item">
                                        <a href="{{ asset('public/files/' . $document->dokumen_validitas) }}"
                                            class="file-link">{{ $document->dokumen_validitas }}</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <!-- Survey Pendukung -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Survey Pendukung</h5>
                        <ul class="list-group">
                            @forelse ($project->surveys as $survey)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $survey->name }}
                                </li>
                            @empty
                                <li class="list-group-item">No survey found.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-lg-4">
                <!-- Metrics Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Metrics Anda</h5>
                        <ul class="list-group mt-3 scrollable" id="metricsList">
                            @foreach ($initialMetricProjects as $metricProject)
                                <li class="list-group-item">
                                    <a href="{{ route('companies-metric-impact.show', ['projectId' => $project->id, 'metricId' => $metricProject->metric_id, 'metricProjectId' => $metricProject->id]) }}"
                                        class="text-dark metric-item">{{ $metricProject->metric->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Indicator Section -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Indicator</h5>
                        <ul class="list-group scrollable" style="max-height: 200px; overflow-y: auto;"> <!-- Menambahkan style untuk scroll -->
                            @foreach ($project->indicators as $indicator)
                                <li class="list-group-item">{{ $indicator->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Script untuk menangani klik pada tombol Project Selesai
        document.getElementById('completeProjectBtn').addEventListener('click', function() {
            $('#confirmCompleteModal').modal('show'); // Tampilkan modal konfirmasi
        });
    
        // Script untuk menangani klik pada tombol konfirmasi di modal
        document.getElementById('confirmCompleteBtn').addEventListener('click', function() {
            document.getElementById('completeProjectForm').submit(); // Kirim form jika dikonfirmasi
        });
    
        $(document).ready(function() {
            // Hanya menampilkan file yang sudah di-upload tanpa fungsi edit
            $('#file-input').on('change', function() {
                var files = this.files;
                $('#file-list').empty(); // Hapus isi daftar file
    
                if (files.length === 0) {
                    $('#file-list').append('<li class="list-group-item no-documents">No documents found.</li>');
                } else {
                    for (var i = 0; i < files.length; i++) {
                        var fileName = files[i].name;
                        var listItem = $('<li class="list-group-item"></li>').text(fileName);
                        $('#file-list').append(listItem);
                    }
                }
            });
    
            // Pencarian Metrics
            document.getElementById('searchMetrics').addEventListener('input', function() {
                let filter = this.value.toLowerCase();
                let metricItems = document.querySelectorAll('#metricsList .list-group-item');
                let noMetricsMessage = document.getElementById('noMetricsMessage');
                let found = false;
    
                metricItems.forEach(function(item) {
                    let text = item.textContent || item.innerText;
                    if (text.toLowerCase().includes(filter)) {
                        item.style.display = '';
                        found = true;
                    } else {
                        item.style.display = 'none';
                    }
                });
    
                if (found) {
                    noMetricsMessage.style.display = 'none';
                } else {
                    noMetricsMessage.style.display = 'block';
                }
            });
        });
    </script>        
@endsection
