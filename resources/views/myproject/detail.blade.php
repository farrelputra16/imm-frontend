@php
    $layout = ($isUserRole && $status != 'benchmark') ? 'layouts.app-imm' : 'layouts.app-landingpage';
@endphp

@extends($layout)

@section('title', 'Detail Proyek')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
    <style>
        .header-image {
            width: 100%;
            height: auto;
        }

        .fa-trash-alt {
            cursor: pointer;
            color: red;
        }

        .content-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .left-content,
        .right-content {
            flex: 1;
            min-width: 300px;
        }

        .card-title {
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .input-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        .badge-pill {
            border-radius: 50rem;
        }

        .span-footer {
            font-size: 0.9rem;
        }

        .sosmed a {
            color: #ffffff;
            margin-left: 10px;
        }

        .sosmed a:hover {
            color: #007bff;
        }

        .btn-custom {
            width: 100px;
        }

        .edit-icon {
            cursor: pointer;
            font-size: 1.2rem;
            color: #007bff;
        }

        .edit-icon:hover {
            color: #0056b3;
        }

        .edit-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-wide {
            width: 300px;
            text-align: center;
        }

        .btn-purple {
            background-color: #5940cb;
            color: white;
        }

        .btn-purple:hover {
            background-color: #562dc7;
            color: white;
        }

        .mt-5 {
            margin-top: 3rem !important;
        }

        .scrollable {
            max-height: 700px;
            overflow-y: auto;
        }

        .upload-container {
            width: 100%;
            height: 200px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2px solid #ccc;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
            background-size: cover;
            object-fit: cover;
            /* Ensure the image covers the entire container without distortion */
            object-position: center;
            /* Center the image within the container */
        }

        .upload-container input[type="file"] {
            display: none;
        }

        .upload-container label {
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .upload-container label i {
            font-size: 2rem;
        }

        .hidden {
            display: none;
        }

        .disabled {
            cursor: not-allowed !important;
        }

        /* bread */
        .breadcrumb {
            background-color: white;
            padding: 0;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            margin-right: 14px;
            color: #9CA3AF;
        }

        /* Form */
        .background {
            max-width: 700px;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
        }

        .edit-icon {
            cursor: pointer;
            color: #6256CA; /* Warna untuk edit icon */
        }

        .edit-icon:hover {
            color: #4f46e5; /* Warna saat hover untuk edit icon */
        }

        .d-flex {
            display: flex;
            align-items: center;
        }

        .ms-2 {
            margin-left: 10px;
        }

        /* Ini merupkan bagian untuk preview video dan pdf */
        .background-preview {
            max-width: 700px;
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #343a40;
            margin-bottom: 20px;
        }

        #pitch-deck-preview, #video-preview, #roadmap-preview {
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #ced4da;
            border-radius: 8px;
        }

        /* Ini merupakan bagian untuk dokumen validasi data */
        .upload-box-custom {
            border: 2px solid #9b59b6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            cursor: pointer;
            background-color: transparent;
        }

        .upload-box-custom img {
            width: 40px;
            height: 40px;
            color: #9b59b6;
        }

        .upload-box-custom p {
            margin-top: 10px;
            color: #666;
        }

        .upload-box-custom input[type="file"] {
            display: none;
        }

        /* document list */
        .document-list-container {
            max-height: 300px;
            overflow-y: auto;
        }

        .document-list-container::-webkit-scrollbar {
            width: 8px;
        }

        .document-list-container::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .document-list-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .document-list-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        /* suvery list */
        .survey-list-container {
            max-height: 300px;
            overflow-y: auto;
        }

        .survey-list-container::-webkit-scrollbar {
            width: 8px;
        }

        .survey-list-container::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .survey-list-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 4px;
        }

        .survey-list-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
@endsection

@section('content')
    <body>
        {{-- Bagian Breadcumb project --}}
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        @if ($isUserRole && $status != 'benchmark')
                            <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                        @else
                            @if ($status == 'benchmark' || $status == 'company')
                                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                            @else
                                <a href="{{ route('investments.pending') }}" style="text-decoration: none; color: #212B36;">Home</a>
                            @endif
                        @endif
                    </li>
                    @if ($isUserRole && $status != 'benchmark')
                        <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                            <a href="{{ route('myproject.myproject') }}" style="text-decoration: none; color: #212B36;">IMM</a>
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
                    @endif
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="detail/{{ $project->id }}" style="text-decoration: none; color: #5A5A5A;">Project Report</a>
                    </li>
                </ol>
            </nav>
        </div>

        <form id="projectForm" action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            <!-- Content Section -->
            <div class="container mt-6">
                <h2 style="color: #6256CA; margin-top: 30px; margin-bottom: 42px;">Project Report</h2>
                <div class="row">
                    <!-- Left Content -->
                    <div class="col-lg-7">
                        @csrf
                        @method('PUT')
                        <div class="background">
                            <div class="header">Basic Project Information</div>

                            <!-- Nama Proyek -->
                            <div class="mb-3">
                                <label for="nama-proyek" class="form-label">Nama Proyek</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control" id="nama-proyek" name="nama" value="{{ $project->nama }}" readonly>
                                    @if ($isUserRole && $status != 'benchmark')
                                        <i class="fas fa-edit edit-icon ms-2" id="edit-nama-proyek" onclick="enableEdit('nama-proyek')"></i>
                                    @endif
                                </div>
                            </div>

                            <!-- Deskripsi Proyek -->
                            <div class="mb-3">
                                <label for="deskripsi-proyek" class="form-label">Deskripsi Proyek</label>
                                <div class="d-flex">
                                    <textarea class="form-control" id="deskripsi-proyek" name="deskripsi" rows="3" readonly>{{ $project->deskripsi }}</textarea>
                                    @if ($isUserRole && $status != 'benchmark')
                                        <i class="fas fa-edit edit-icon ms-2" id="edit-deskripsi-proyek" onclick="enableEdit('deskripsi-proyek')"></i>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="background">
                            <h5 class="card-title" style="margin-bottom: 0px;">SDG'S</h5>
                            <div class="row d-flex justify-content-start ">
                                @foreach ($project->sdgs as $sdg)
                                    <div class="col-3 d-flex justify-content-center align-items-center mt-3" >
                                        <img src="{{ env('APP_BACKEND_URL') . '/images/' . $sdg->img }}"
                                            class="img-fluid" alt="{{ $sdg->order }}. {{ $sdg->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="background-preview">
                            <div class="section-title">Supporting Materials</div>
                            <!-- Preview Pitch Deck -->
                            <div class="mt-4">
                                <div class="mb-2 sub-heading-1">Pitch Deck</div>
                                <div id="pitch-deck-preview">
                                    @if ($project->pitch_deck)
                                        <embed src="{{ asset('storage/project/' . $project->nama . '/' . $project->pitch_deck) }}" type="application/pdf" width="100%" height="500px" />
                                        <p>File name: {{ $project->pitch_deck }}</p>
                                    @else
                                        <p>No Pitch Deck available.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Preview Video -->
                            <div class="mt-4">
                                <div class="mb-2 sub-heading-1">Video Presentation</div>
                                <div id="video-preview" class="video-js vjs-default-skin" style="margin-bottom: 20px; width: 100%;">
                                    @if ($project->video_pitch)
                                        <video id="video" width="100%" height="auto" controls>
                                            <source src="{{ asset('storage/project/' . $project->nama . '/' . $project->video_pitch) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <p>File name: {{ $project->video_pitch }}</p>
                                    @else
                                        <p>No Video available.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Preview Roadmap -->
                            <div class="mt-4">
                                <div class="mb-2 sub-heading-1">Roadmap</div>
                                <div id="roadmap-preview">
                                    @if ($project->roadmap)
                                        <embed src="{{ asset('storage/project/' . $project->nama . '/' . $project->roadmap) }}" type="application/pdf" width="100%" height="500px" />
                                        <p>File name: {{ $project->roadmap }}</p>
                                    @else
                                        <p>No Roadmap available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Ini merupakan bagian dokumen validasi data --}}
                        <div class="card mb-4" style="max-width: 700px;">
                            <div class="card-body">
                                <h5 class="card-title">Dokumen Validitas Data</h5>
                                @if ($isUserRole && $status != 'benchmark')
                                    <div class="upload-box-custom" onclick="document.getElementById('file-input').click();">
                                        <img src="{{ asset('images/upload.svg') }}" alt="Upload icon">
                                        <p>Tambah Dokumen</p>
                                        <input type="file" class="form-control" id="file-input" name="documents[]" multiple>
                                    </div>
                                @endif
                                <h5 class="card-title">Daftar Dokumen</h5>
                                <div class="document-list-container">
                                    <ul class="list-group" id="file-list">
                                        @if ($documents->isEmpty())
                                            <li class="list-group-item no-documents">No documents found.</li>
                                        @else
                                            @foreach ($documents as $document)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <a href="{{ env('APP_URL') }}/storage/project/{{ $project->nama }}/{{ $document->dokumen_validitas }}" class="file-link">
                                                        {{ $document->dokumen_validitas }}
                                                    </a>
                                                    @if ($isUserRole && $status != 'benchmark')
                                                        <i class="fas fa-trash-alt delete-icon" data-id="{{ $document->id }}" onclick="deleteDocument({{ $document->id }})"></i>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Ini merupakan bagian dokumen Survey Pendukung --}}
                        <div class="card mb-4" style="max-width: 700px;">
                            <div class="card-body">
                                <h5 class="card-title">Survey Pendukung</h5>
                                @if ($isUserRole && $status != 'benchmark')
                                    <div class="upload-box-custom" onclick="window.location='{{ route('surveys.create', $project->id) }}'">
                                        <img src="{{ asset('images/upload.svg') }}" alt="Upload icon">
                                        <p>Tambah Survey</p>
                                    </div>
                                @endif
                                <h5 class="card-title">Daftar Survey</h5>
                                <div class="document-list-container">
                                    <ul class="list-group">
                                        @forelse ($project->surveys as $survey)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{ $survey->name }}
                                                @if ($isUserRole && $status != 'benchmark')
                                                    <div>
                                                        <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-sm"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('surveys.destroy', $survey->id) }}" method="POST" class="delete-survey-form" id="delete-survey-{{ $survey->id }}" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm delete-survey-btn" onclick="return confirm('Apakah anda yakin akan menghapus survey ini?')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </li>
                                        @empty
                                            <li class="list-group-item">No survey found.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content -->
                    <div class="col-lg-5">
                        <div class="card mb-4" style="max-width: 900px;">
                            <div class="card-body">
                                <h5 class="card-title">SDG Metrics</h5>
                                <input type="text" class="form-control" id="searchMetrics" placeholder="Cari metrics anda">
                                <ul class="list-group mt-3 scrollable" id="metricsList">
                                    @foreach ($initialMetricProjects as $metricProject)
                                        <li class="list-group-item">
                                            @if ($isUserRole && $status != 'benchmark')
                                                <a href="{{ route('metric-impact.show', ['projectId' => $project->id, 'metricId' => $metricProject->metric_id, 'metricProjectId' => $metricProject->id]) }}"
                                                    class="text-dark metric-item">{{ $metricProject->metric->name }}</a>
                                            @else
                                                <a href="{{ route('metric-impact.show', ['projectId' => $project->id, 'metricId' => $metricProject->metric_id, 'metricProjectId' => $metricProject->id, 'status' => $status, 'companyId' =>  $companyId]) }}"
                                                    class="text-dark metric-item">{{ $metricProject->metric->name }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                                <p id="noMetricsMessage" class="text-center mt-3" style="display: none;">Metric tidak ditemukan</p>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Indicator</h5>
                                <ul class="list-group scrollable">
                                    @foreach ($project->indicators as $indicator)
                                        <li class="list-group-item">{{ $indicator->order }}* {{ $indicator->name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                <!-- Selesaikan Project Button -->
                @if ($isUserRole && $status != 'benchmark')
                    <hr style="border: none; height: 0.2px; background-color: #000000; margin-left: 15px; margin-bottom: 40px; margin-top 86px; margin-right 0px; opacity: 0.2; width: 100%;;">
                    <form id="completeProjectForm" action="{{ route('projects.complete', $project->id) }}" method="POST" style="width: 100%;">
                        @csrf
                        <input type="hidden" name="status" value="Selesai">
                        <input type="hidden" name="tanggal_penyelesaian" value="{{ now()->toDateString() }}">
                        <button type="button" id="completeProjectBtn" class="btn btn-purple btn-block mb-5 {{ $project->status === 'Selesai' ? 'disabled' : '' }}"
                            {{ $project->status === 'Selesai' ? 'disabled' : '' }}>
                            {{ $project->status === 'Selesai' ? 'Project telah selesai' : 'Project Selesai' }}
                        </button>
                    </form>
                @endif
                @if ($isUserRole && $status != 'benchmark')
                    <div class="container d-flex justify-content-center" style="margin: 0px; padding: 0px;">
                        <button type="submit" class="btn btn-purple text-white hidden" id="save-button" style="font-weight:bold; width: 100%;">Simpan Perubahan Detail Proyek</button>
                    </div>
                @endif

                <div class="modal fade" id="confirmCompleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmCompleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmCompleteModalLabel">Konfirmasi Penyelesaian Project</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin akan menyelesaikan project ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="button" id="confirmCompleteBtn" class="btn btn-primary">Ya, Selesaikan Project</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            // Script untuk menangani klik pada tombol Project Selesai
            document.getElementById('completeProjectBtn').addEventListener('click', function() {
                $('#confirmCompleteModal').modal('show'); // Tampilkan modal konfirmasi
            });

            // Script untuk menangani klik pada tombol konfirmasi di modal
            document.getElementById('confirmCompleteBtn').addEventListener('click', function() {
                document.getElementById('completeProjectForm').submit(); // Kirim form jika dikonfirmasi
            });
        </script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

        <script>
            $(document).ready(function() {
                function showSaveButton() {
                    $('#save-button').removeClass('hidden');
                }

                $('#img-upload').on('change', function() {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image-preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                    showSaveButton();
                });



                $('#file-input').on('change', function() {
                    var files = this.files;
                    // Hapus pesan "No documents found" jika dokumen ditambahkan
                    $('#file-list').find('.no-documents').remove();

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        var fileName = file.name;
                        var listItem = $('<li class="list-group-item"></li>');
                        var fileLink = $('<span class="file-link"></span>').text(fileName);
                        var deleteIcon = $('<i class="fas fa-trash-alt delete-icon"></i>');

                        deleteIcon.on('click', function() {
                            listItem.remove();
                            showSaveButton();
                        });

                        listItem.append(fileLink).append($('<span class="float-right"></span>').append(
                            deleteIcon));
                        $('#file-list').append(listItem);
                    }
                    showSaveButton();
                });


                $('form').on('submit', function() {
                    console.log('Form is submitting');
                });

                function enableEdit(id) {
                    document.getElementById(id).removeAttribute('readonly');
                    document.getElementById(id).focus();
                    showSaveButton();
                }

                function deleteDocument(docId) {
                    var deleteInput = document.createElement('input');
                    deleteInput.type = 'hidden';
                    deleteInput.name = 'delete_documents[]';
                    deleteInput.value = docId;

                    document.getElementById('projectForm').appendChild(deleteInput);

                    var docElement = document.querySelector('.delete-icon[data-id="' + docId + '"]').closest('li');
                    docElement.parentNode.removeChild(docElement);

                    showSaveButton();
                }

                // Add event listeners for text inputs
                $('#nama-proyek').on('input', showSaveButton);
                $('#deskripsi-proyek').on('input', showSaveButton);

                // Make the edit icons functional
                $('.edit-icon').on('click', function() {
                    var targetId = $(this).attr('id').replace('edit-', '');
                    enableEdit(targetId);
                });

                // Add functionality to existing document delete icons
                $('.delete-icon').on('click', function() {
                    var docId = $(this).data('id');
                    deleteDocument(docId);
                });
            });
        </script>
        <script>
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
        </script>
    </body>
@endsection
