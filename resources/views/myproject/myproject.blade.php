@extends('layouts.app-imm')
@section('title', 'Proyek Saya')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/myproject/myproject.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <meta name="description" content="Manage your projects efficiently with MyProject">
    <meta name="keywords" content="project management, task management, productivity">
    <meta name="author" content="Your Name">
    <style>
        body {
            padding-top: 115px;
            /* Adjust this value according to the height of your navbar */
        }

        .btn-create-project {
            background-color: #5940CB;
            color: white;
            width: 200px;
            height: 40px;
            border: none;
            border-radius: 5px;
        }

        thead {
            background-color: #6c63ff;
            color: white;
        }

        #DataTables_Table_1_wrapper label {
            margin-top: -50px;
            display: flex;
            align-items: center;
        }

        #DataTables_Table_0_wrapper label {
            margin-top: -50px;
            display: flex;
            align-items: center;
        }
        .dataTables_info{
    display: none;
}
tr{

  
}

th{
    color: white;    background-color: #5940cb;
}

td{
    color: black;
}
        .dataTables_paginate {
            margin-top: 20px;
        }

        .btn-delete,
        .btn-detail {
            width: 140px;
            height: 33px;
            border: 1px solid black;
            font-weight: 500;
        }

        .btn-delete {
            background-color: rgba(255, 26, 26, 0.5);
        }

        .btn-detail {
            background-color: rgba(217, 217, 217, 0.44);
        }

        .see-all-button {
            text-align: center;
            margin-top: 20px;
        }

        .card-body {
            background-color: rgba(255, 250, 250, 0.5);
        }

        .see-all-button button {
            background-color: #6c63ff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .seeAll {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h2 class="project-title">Draft Project</h2>
        <div class="row mt-5">
            <div class="col-md-8">
                <div class="input-group">
                    <input type="text" id="search-all-projects" class="form-control search-input"
                        placeholder="Cari project anda" aria-label="Search">
                    <div class="input-group-append">
                        <button type="button" class="input-group-text search-icon" aria-label="Search Button"><i
                                class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <a href="creatproject">
                    <button class="btn-primary btn-create-project">Create New Project</button>
                </a>
            </div>
        </div>

        <div class="section d-flex justify-content-between justify-content-center">
            <h4 class="project-title mb-5 mt-5">Semua Proyek ({{ $allProjects->count() }})</h4>
            @if ($allProjects->count() > 6)
                <h5 class="seeAll" id="show-all-btn">Lihat Semua</h5>
            @endif
        </div>

        <div class="row mt-3" id="draft-project-list">
            <div class="col-md-12 no-projects mt-3">
                @if ($allProjects->isEmpty())
                    <div class="container text-center py-3 border">
                        <p>Tidak ada proyek yang ditemukan.</p>
                    </div>
                @else
                    <div class="row">
                        @foreach ($allProjects as $index => $project)
                            <div class="col-md-4 mb-4" id="project-{{ $project->id }}"
                                @if ($index >= 6) style="display: none;" @endif>
                                <div class="card project-card" style="height: 300px">
                                    <img height="150px"
                                        src="{{ $project->img ? asset('images/' . $project->img) : asset('images/default_project.png') }}"
                                        class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $project->nama }}</h5>
                                        <div class="d-flex">
                                            <a href="detail/{{ $project->id }}" class="btn btn-detail mt-2">Detail</a>
                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-delete mt-2" data-project-id="{{ $project->id }}">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus Proyek</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin menghapus Proyek ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Ya, Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <h2 class="project-title mb-5 mt-5">Proyek yang sedang dikerjakan</h2>
            <div class="row mt-5">
              
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3 mt-3 ongoing-projects-filters">
                <div class="dropdown">
                    <div class="  p-2 d-flex justify-content-center align-items-center " style="border: 1px solid #6c63ff; width:90px; border-radius:5px;">
                        {{ $ongoingProjects->count() }} of {{ $allProjects->count() }}
                    </div>
                </div>
            </div>
            <table class="table mt-3 ongoing-projects-table border text-center">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Tanggal Mulai</th>
                        <th>Tenggat Waktu</th>
                        <th>Tujuan SDGs</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="ongoing-project-list">
                    @if ($ongoingProjects->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="container border py-3">
                                    Tidak ada project yang sedang dikerjakan.
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach ($ongoingProjects as $project)
                            <tr>
                                <td>{{ $project->nama }}</td>
                                <td>{{ $project->start_date }}</td>
                                <td>{{ $project->end_date }}</td>
                                <td>{{ $project->sdgs->implode('order', ', ') }}</td>
                                <td>{{ 'Rp' . number_format($project->jumlah_pendanaan, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="container">
            <h2 class="project-title mb-5 mt-5">Proyek Selesai</h2>

            <div class="d-flex justify-content-between align-items-center mb-3 mt-3 ongoing-projects-filters">
                <div class="dropdown">
                    <div class="  p-2 d-flex justify-content-center align-items-center " style="border: 1px solid #6c63ff; width:90px;border-radius:5px;">
                        {{ $completedProjects->count() }} of {{ $allProjects->count() }}
                    </div>
                </div>
            </div>
            <table class="table mt-3 done-projects-table border text-center">
                <thead>
                    <tr>
                        <th>Nama Proyek</th>
                        <th>Tanggal Penyelesaian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="done-project-list">
                    @if ($completedProjects->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">
                                <div class="container border py-3">
                                    Tidak ada project yang terselesaikan.
                                </div>
                            </td>
                        </tr>
                    @else
                        @foreach ($completedProjects as $project)
                            <tr>
                                <td>{{ $project->nama }}</td>
                                <td>{{ $project->tanggal_penyelesaian }}</td>
                                <td>
                                    <div class="span bg-success text-white" style="padding: 5px 0; border-radius:50px">
                                        {{ $project->status }}</div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
            $('.btn-delete').on('click', function(e) {
                e.preventDefault();
                var projectId = $(this).data('project-id');
                $('#confirmDeleteBtn').data('project-id', projectId);
                $('#confirmDeleteModal').modal('show');
            });

            $('#confirmDeleteBtn').on('click', function() {
                var projectId = $(this).data('project-id');
                var form = $('button[data-project-id="' + projectId + '"]').closest('form');
                form.submit();
            });
    </script>
    <script>
                        document.addEventListener("DOMContentLoaded", function() {
            // Function to handle search
            function handleSearch(inputId, listId, noResultsMessage, isTable) {
                const searchInput = document.getElementById(inputId);
                const projectList = document.getElementById(listId);
                const table = isTable ? projectList.closest('table') : null;
                let noResultsElement = projectList.querySelector('.no-results') || projectList.parentElement
                    .querySelector('.no-results');

                // Ensure no-results element exists
                if (!noResultsElement) {
                    noResultsElement = document.createElement('div');
                    noResultsElement.className = 'no-results col-12 text-center py-3 border';
                    noResultsElement.textContent = noResultsMessage;
                    noResultsElement.hidden = true;
                    if (isTable) {
                        table.parentNode.insertBefore(noResultsElement, table.nextSibling);
                    } else {
                        projectList.appendChild(noResultsElement);
                    }
                }

                searchInput.addEventListener('input', function() {
                    const filter = this.value.toLowerCase();
                    const projectItems = projectList.querySelectorAll(isTable ? 'tr:not(.no-results)' :
                        '.col-md-4');
                    let found = false;

                    projectItems.forEach(function(project) {
                        const projectName = project.querySelector(isTable ? 'td:first-child' :
                            '.card-title').textContent.toLowerCase();
                        if (projectName.includes(filter)) {
                            project.hidden = false;
                            found = true;
                        } else {
                            project.hidden = true;
                        }
                    });

                    if (!found) {
                        noResultsElement.hidden = false;
                        if (isTable) {
                            table.style.display = 'none';
                        }
                    } else {
                        noResultsElement.hidden = true;
                        if (isTable) {
                            table.style.display = '';
                        }
                    }
                });
            }

            // Apply search functionality to all project sections
            handleSearch('search-all-projects', 'draft-project-list', 'Project tidak ditemukan', false);
        });
        document.querySelector('.seeAll').addEventListener('click', function() {
            document.querySelectorAll('#draft-project-list .col-md-4').forEach(function(project, index) {
                if (index >= 6) {
                    project.style.display = 'block';
                }
            });
            document.querySelector('.seeAll').style.display = 'none';
        });
    
        document.getElementById('show-all-btn').addEventListener('click', function() {
            document.querySelectorAll('#draft-project-list .col-md-4').forEach(function(project) {
                project.style.display = 'block';
            });
            document.getElementById('show-all-btn').style.display = 'none';
        });
    </script>
    <script>
        jQuery(document).ready(function($) {
            // Initialize DataTables for ongoing and completed projects
            $('.ongoing-projects-table').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "lengthChange": false,
                "order": [
                    [1, "asc"]
                ] // Adjust this index based on which column you want to sort by default
            });

            $('.done-projects-table').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "lengthChange": false,
                "order": [
                    [1, "asc"]
                ] // Adjust this index based on which column you want to sort by default
            });
            // Functionality for 'See All' button
            const showAllBtn = document.getElementById('show-all-btn');
            if (showAllBtn) {
                showAllBtn.addEventListener('click', function() {
                    document.querySelectorAll('#draft-project-list .col-md-4').forEach(function(project) {
                        project.hidden = false;
                    });
                    this.style.display = 'none';
                });
            }
        });
    </script>
@endsection
