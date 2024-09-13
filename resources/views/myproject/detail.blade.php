@extends('layouts.app-imm')
@section('title', 'Detail Proyek')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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



        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px;
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
            max-height: 308px;
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
    </style>
@endsection

@section('content')

    <body>
        <form id="projectForm" action="{{ route('projects.update', $project->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Main Container -->
            <div class="container mt-5 pt-5 contentTop">
                <div class="row">
                    <div class="col-12">
                        <div class="container">
                            <label for="img-upload" class="w-100" aria-placeholder="">
                                <img class="upload-container"
                                    src="{{ $project->img ? asset('images/' . $project->img) : asset('images/default_project.png') }}"
                                    id="image-preview">
                            </label>
                            <input type="file" class="form-control" id="img-upload" name="img" accept="image/*"
                                style="display: none">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Section -->
            <div class="container mt-3">
                <div class="row">
                    <!-- Left Content -->
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="edit-container">
                                    <h5 class="card-title">Nama Proyek</h5>
                                    <i class="fas fa-edit edit-icon" id="edit-nama-proyek"
                                        onclick="enableEdit('nama-proyek')"></i>
                                </div>
                                <input type="text" class="form-control" id="nama-proyek" name="nama"
                                    value="{{ $project->nama }}" readonly>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="edit-container">
                                    <h5 class="card-title">Deskripsi Proyek</h5>
                                    <i class="fas fa-edit edit-icon" id="edit-deskripsi-proyek"
                                        onclick="enableEdit('deskripsi-proyek')"></i>
                                </div>
                                <textarea class="form-control" id="deskripsi-proyek" name="deskripsi" rows="4" readonly>{{ $project->deskripsi }}</textarea>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body ">
                                <h5 class="card-title">SDG'S</h5>
                                <div class="row d-flex justify-content-start ">
                                    @foreach ($project->sdgs as $sdg)
                                        <div class="col-3 d-flex justify-content-center align-items-center mt-3" >
                                            <img src="{{ env('APP_BACKEND_URL') . '/images/' . $sdg->img }}"
                                                class="img-fluid" alt="{{ $sdg->order }}. {{ $sdg->name }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Dokumen Validitas Data</h5>
                                <button type="button" class="btn btn-purple" id="tambah-dokumen"
                                    onclick="document.getElementById('file-input').click()">Tambah Dokumen</button>
                                <input type="file" class="form-control" id="file-input" name="documents[]"
                                    style="display: none;" multiple>
                            </div>
                            <ul class="list-group" id="file-list" style="scrolly">
                                @if ($documents->isEmpty())
                                    <li class="list-group-item no-documents">No documents found.</li>
                                @else
                                    @foreach ($documents as $document)
                                        <li class="list-group-item">
                                            <a href="{{ asset('public/files/' . $document->dokumen_validitas) }}"
                                                class="file-link">{{ $document->dokumen_validitas }}</a>
                                            <span class="float-right">
                                                <i class="fas fa-trash-alt delete-icon" data-id="{{ $document->id }}"
                                                    onclick="deleteDocument({{ $document->id }})"></i>
                                            </span>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>

                        {{-- <div class="container d-flex justify-content-center mt-5">
                            <button type="submit" class="btn w-50 btn-purple px-4 py-2 btn-wide text-white hidden"
                                id="save-button" style="font-weight:bold;">Simpan Perubahan Detail Proyek</button>
                        </div> --}}
        </form>

        <!-- Survey Pendukung section -->
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title">Survey Pendukung</h5>
                <a href="{{ route('surveys.create', $project->id) }}" class="btn btn-purple">Tambah Survey</a>
            </div>
            <ul class="list-group">
                @forelse ($project->surveys as $survey)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $survey->name }}
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
                    </li>
                @empty
                    <li class="list-group-item">No survey found.</li>
                @endforelse
            </ul>
        </div>
        
        <!-- Selesaikan Project Button -->
        <form id="completeProjectForm" action="{{ route('projects.complete', $project->id) }}" method="POST">
            @csrf
            <input type="hidden" name="status" value="Selesai">
            <input type="hidden" name="tanggal_penyelesaian" value="{{ now()->toDateString() }}">
            <button type="button" id="completeProjectBtn" class="btn btn-purple btn-block mb-5 {{ $project->status === 'Selesai' ? 'disabled' : '' }}"
                {{ $project->status === 'Selesai' ? 'disabled' : '' }}>
                {{ $project->status === 'Selesai' ? 'Project telah selesai' : 'Project Selesai' }}
            </button>
        </form>


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
        <!-- Right Content -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Metrics Anda</h5>
                    <input type="text" class="form-control" id="searchMetrics" placeholder="Cari metrics anda">
                    <ul class="list-group mt-3 scrollable" id="metricsList">
                        @foreach ($initialMetricProjects as $metricProject)
                            <li class="list-group-item">
                                <a href="{{ route('metric-impact.show', ['projectId' => $project->id, 'metricId' => $metricProject->metric_id, 'metricProjectId' => $metricProject->id]) }}"
                                    class="text-dark metric-item">{{ $metricProject->metric->name }}</a>
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
                            <li class="list-group-item">{{ $indicator->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            </div>

        <div class="container d-flex justify-content-center mt-5">
            <button type="submit" class="btn w-50 btn-purple px-4 py-2 btn-wide text-white hidden" id="save-button"
                style="font-weight:bold;">Simpan Perubahan Detail Proyek</button>
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