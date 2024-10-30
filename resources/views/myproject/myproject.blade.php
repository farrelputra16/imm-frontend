@extends('layouts.app-imm')
@section('title', 'Proyek Saya')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @if ($isUserRole)
        <link rel="stylesheet" href="{{ asset('css/myproject/myproject.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <meta name="description" content="Manage your projects efficiently with MyProject">
    <meta name="keywords" content="project management, task management, productivity">
    <meta name="author" content="Your Name">
    <style>
        body {
            padding-top: 115px;
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

        .dataTables_info {
            display: none;
        }

        th {
            color: white;
            background-color: #5940cb;
        }

        td {
            color: black;
        }

        .dataTables_paginate {
            margin-top: 20px;
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

        .breadcrumb {
            background-color: white;
            padding: 0;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            margin-right: 14px;
            color: #9CA3AF;
        }

        .nav-tabs {
            border: none;
            display: flex; /* Menggunakan flexbox */
            margin-bottom: 40px;
            padding: 0; /* Menghapus padding pada nav-tabs */
            gap: 0px;
        }

        .navtabs{
            border: none;
            display: flex; /* Menggunakan flexbox */
            margin-bottom: 32px;
            margin-top: 32px;
            padding: 0; /* Menghapus padding pada nav-tabs */
            gap: 0px;
        }

        /* Gaya untuk tab yang tidak aktif */
        .navlinkexpend {
            color: #000; /* Warna teks default */
            font-size: 24px; /* Ukuran font */
            padding: 10px 20px 10px; /* Padding untuk mengecilkan tab */
            text-align: center; /* Menyelaraskan teks ke tengah */
            background-color: #ffffff; /* Warna latar belakang untuk tab tidak aktif */
            border: none; /* Tanpa border untuk tab tidak aktif */
            border-bottom: 1px solid #dee2e6; /* Border bawah untuk tab tidak aktif */
            border-radius: 0.25rem; /* Sudut melengkung */
            transition: background-color 0.3s; /* Efek transisi saat hover */
        }
        /* Gaya untuk tab yang aktif */
        .nav-link-active {
            color: #000; /* Mengubah warna teks tab aktif menjadi hitam */
            background-color: #ffffff; /* Mengubah latar belakang tab aktif */
            font-size: 24px; /* Ukuran font */
            padding: 10px 20px; /* Padding untuk mengecilkan tab */
            border-top: 1px solid #dee2e6; /* Border atas untuk tab aktif */
            border-left: 2px solid #dee2e6; /* Border kiri untuk tab aktif */
            border-right: 2px solid #dee2e6; /* Border kanan untuk tab aktif */
            border-bottom: none; /* Tanpa border bawah untuk tab aktif */
            border-radius: 0.25rem 0.25rem 0 0; /* Sudut melengkung hanya di atas */
            margin-bottom: -1px; /* Menghindari overlap dengan border bawah tab tidak aktif */
        }

        /* Initial Card Body */
        .card-body {
            max-height: 180px; /* Initial height */
            overflow: hidden; /* Hide overflow when not expanded */
            transition: max-height 0.5s ease; /* Smooth transition for max-height */
            background-color: white; /* Default background color */
        }

        /* Expand Card Body on Hover */
        .card:hover .card-body {
            max-height: 500px; /* Maximum height when expanded */
            background-color: #6256CA; /* Background turns purple */
        }

        /* Card styles */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease; /* Smooth transition for card */
            overflow: hidden; /* Ensure content fits */
            background-color: #fff; /* Default background */
        }

        .card-img-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        /* Card title and text */
        .card-title {
            color: #6A1B9A;
            font-weight: bold;
            transition: color 0.3s ease; /* Smooth transition for color */
        }

        .card-text {
            color: #757575;
            transition: color 0.3s ease; /* Smooth transition for color */
        }

        .icon-text {
            display: flex;
            align-items: center;
            color: #6A1B9A;
            transition: color 0.3s ease; /* Smooth transition for color */
        }

        .icon-text img {
            margin-right: 5px;
            width: 16px;
            height: 16px;
        }

        /* Button Styles */
        .btn-delete, .btn-detail {
            width: 140px;
            height: 33px;
            border: 1px solid white; /* Default border */
            font-weight: 500;
            background-color: transparent; /* Transparent background */
            color: white; /* White text */
            opacity: 0; /* Initially hidden */
            transition: opacity 0.3s ease, background-color 0.3s ease;
        }

        /* Delete Button Style */
        .btn-delete {
            background-color: rgba(255, 26, 26, 0.5);
        }

        /* Detail Button Style */
        .btn-detail {
            background-color: rgba(217, 217, 217, 0.44);
        }

        /* Show buttons on hover */
        .card:hover .btn-delete,
        .card:hover .btn-detail {
            opacity: 1; /* Buttons become visible */
            border-color: white; /* White border */
            color: white; /* White text */
        }

        /* Change text color on hover */
        .card:hover .card-title,
        .card:hover .card-text,
        .card:hover .icon-text,
        .card:hover .icon-text span {
            color: white; /* Change all text inside card-body to white */
        }

        /* Card and Icon Styles */
        .icon-text {
            display: flex;
            align-items: center;
            color: #6A1B9A; /* Purple color by default */
            transition: color 0.3s ease; /* Smooth transition for color */
        }

        .iconify {
            color: #6A1B9A; /* Purple color by default */
            transition: color 0.3s ease; /* Smooth transition for icon color */
            font-size: 18px; /* Default icon size */
        }

        .icon-text span {
            margin-left: 5px; /* Space between icon and text */
        }

        /* Hover effect */
        .card:hover .iconify,
        .card:hover .icon-text {
            color: white; /* Change color to white on hover */
        }


        /* Hover state of buttons */
        .btn-delete:hover,
        .btn-detail:hover {
            background-color: transparent; /* No background on hover */
            border-color: white; /* White border on hover */
        }
        .three-dots {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #000;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        {{-- Ini bagian untuk breadcumb --}}
        @if (!$isUserRole)
            <nav aria-label="breadcrumb" class="mb-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="{{ route('investments.pending') }}" style="text-decoration: none; color: #212B36;">Home</a>
                    </li>
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="#" style="text-decoration: none; color: #212B36;">Project Reports</a>
                    </li>
                </ol>
            </nav>

            <ul class="navtabs">
                <li class="nav-item" style="margin-right: 0px;">
                    <a class="nav-link-active sub-heading-1" href="{{ route('myproject.myproject', ['company_id' => $companyId]) }}" style="text-decoration: none; color: #212B36;">Project Reports</a>
                </li>
                <li class="nav-item" style="margin-left: 0px;">
                    <a class="navlinkexpend project-reports sub-heading-1" href="{{ route('kelolapengeluaran', ['company_id' => $companyId]) }}" style="text-decoration: none; color: #6256CA;">Expenditure Reports</a>
                </li>
            </ul>
        @endif

        @if ($isUserRole)
            <nav aria-label="breadcrumb" class="mb-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                    </li>
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="#" style="text-decoration: none; color: #212B36;">Impact Measurement & Management</a>
                    </li>
                </ol>
            </nav>

            <h2 class="project-title" style="color: #6256CA;">Dashboard IMM</h2>
            @if ($allProjects->count() > 6)
                <div class="row mt-5">
                    <div class="col-md-8">
                            <div class="input-group">
                                <input type="text" id="search-all-projects" class="form-control search-input"
                                    placeholder="Cari project anda" aria-label="Search">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text search-icon" aria-label="Search Button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                    </div>
                    @if ($isUserRole) <!-- Jika bukan USER, tampilkan tombol Create New Project -->
                    <div class="col-md-4 text-right">
                        <a href="creatproject">
                            <button class="btn-primary btn-create-project">Create New Project</button>
                        </a>
                    </div>
                    @endif
                </div>
            @endif

            <div class="section d-flex justify-content-between justify-content-center" style="margin-top: 60px;">
                <h3 class="project-title" style="color: #6256CA;">Recent Projects</h3>
                @if ($allProjects->count() > 6)
                    <h5 class="seeAll" id="show-all-btn">View All</h5>
                @else
                    <div class="col-md-4 text-right">
                        <a href="creatproject">
                            <button class="btn-primary btn-create-project">Create New Project</button>
                        </a>
                    </div>
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
                                    <div class="card project-card" style="width: 20rem;">
                                        <img
                                            class="card-img-top"
                                            src="{{ $project->img ? asset('storage/project/' . $project->nama . '/' . $project->img) : asset('images/default_project.png') }}"
                                            alt="Project Image"
                                            width="286"
                                            height="160"
                                        />
                                        <div class="card-body position-relative">
                                            <h5 class="card-title">{{ $project->nama }}</h5>
                                            <p class="card-text">
                                                Bringing together skills training and support for women to start or expand their own businesses
                                            </p>
                                            <div class="d-flex justify-content-start">
                                                <div class="icon-text me-3">
                                                    <span class="iconify" data-icon="mdi:calendar-month" data-inline="false" style="font-size: 18px;"></span>
                                                    <span>May 2024</span>
                                                </div>
                                                <div class="icon-text" style="margin-left: 10px; margin-right: 10px; opacity: 0.5;"> | </div>
                                                <div class="icon-text">
                                                    <span class="iconify" data-icon="mdi:map-marker" data-inline="false" style="font-size: 18px;"></span>
                                                    <span>DKI Jakarta</span>
                                                </div>
                                            </div>

                                            <!-- Button container -->
                                            <div class="d-flex mt-3">
                                                    <a href="detail/{{ $project->id }}" class="btn btn-detail">Detail</a>
                                                @if ($isUserRole)
                                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-delete" data-project-id="{{ $project->id }}">Delete</button>
                                                    </form>
                                                @endif
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
        @else
            {{-- Bagian ini untuk investor --}}
            <div class="row">
                <div class="col-md-12">
                    <!-- Tabel untuk Proyek Belum Selesai -->
                    <h3 style="color: #6256CA">Proyek Belum Selesai</h3>
                    <div class="table-responsive">
                        <table id="ongoing-project-table" class="table table-hover table-strip mt-3" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">No.</th>
                                    <th scope="col" style="vertical-align: middle;">Project Name</th>
                                    <th scope="col" style="vertical-align: middle;">Budget Plan</th>
                                    <th scope="col" style="vertical-align: middle;">Start Date</th>
                                    <th scope="col" style="vertical-align: middle;">End Date</th>
                                    <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Expense Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ongoingProjects as $project)
                                    <tr>
                                        <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">{{ $loop->iteration }}</td>
                                        <td style="vertical-align: middle;">{{ $project->nama }}</td>
                                        <td style="vertical-align: middle;">Rp{{ number_format($project->jumlah_pendanaan, 0, ',', '.') }}</td>
                                        <td style="vertical-align: middle;">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('j M, Y') : 'N/A' }}</td>
                                        <td style="vertical-align: middle;">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('j M, Y') : 'N/A' }}</td>
                                        <td style="vertical-align: middle; border-right: 1px solid #BBBEC5; text-align: center;">
                                            <a href="detail/{{ $project->id }}" style="color: black; text-decoration: underline;">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Footer untuk Proyek Belum Selesai -->
                    <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
                        <form method="GET" action="{{ route('myproject.myproject', ['company_id' => $companyId]) }}" class="mb-0">
                            <div class="d-flex align-items-center">
                                <label for="rowsPerPageOngoing" class="me-2">Rows per page:</label>
                                <select name="rows" id="rowsPerPageOngoing" class="form-select me-2" onchange="this.form.submit()" style="width: 50px; margin-left: 5px; margin-right: 5px;">
                                    <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <div>
                                    <span>Total {{ $ongoingProjects->firstItem() }} - {{ $ongoingProjects->lastItem() }} of {{ $ongoingProjects->total() }}</span>
                                </div>
                            </div>
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="company_id" value="{{ $companyId }}">
                        </form>
                        <div >
                            {{ $ongoingProjects->appends(['search' => request('search'), 'rows' => request('rows')])->links('pagination::bootstrap-4') }}
                        </div>
                    </div>

                    <!-- Tabel untuk Proyek Sudah Selesai -->
                    <h3 style="color: #6256CA">Proyek Sudah Selesai</h3>
                    <div class="table-responsive">
                        <table id="completed-project-table" class="table table-hover table-strip mt-3" style="margin-bottom: 0px;">
                            <thead>
                                <tr>
                                    <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">No.</th>
                                    <th scope="col" style="vertical-align: middle;">Project Name</th>
                                    <th scope="col" style="vertical-align: middle;">Status</th>
                                    <th scope="col" style="vertical-align: middle;">Budget Plan</th>
                                    <th scope="col" style="vertical-align: middle;">Start Date</th>
                                    <th scope="col" style="vertical-align: middle;">End Date</th>
                                    <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Expense Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($completedProjects as $project)
                                    <tr>
                                        <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">{{ $loop->iteration }}</td>
                                        <td style="vertical-align: middle;">{{ $project->nama }}</td>
                                        <td style="vertical-align: middle;">{{ $project->status }}</td>
                                        <td style="vertical-align: middle;">Rp{{ number_format($project->jumlah_pendanaan, 0, ',', '.') }}</td>
                                        <td style="vertical-align: middle;">{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('j M, Y') : 'N/A' }}</td>
                                        <td style="vertical-align: middle;">{{ $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('j M, Y') : 'N/A' }}</td>
                                        <td style="vertical-align: middle; border-right: 1px solid #BBBEC5; text-align: center;">
                                            <a href="detail/{{ $project->id }}" style="color: black; text-decoration: underline;">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Footer untuk Proyek Sudah Selesai -->
                    <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
                        <form method="GET" action="{{ route('myproject.myproject', ['company_id' => $companyId]) }}" class="mb-0">
                            <div class="d-flex align-items-center">
                                <label for="rowsPerPageCompleted" class="me-2">Rows per page:</label>
                                <select name="rows" id="rowsPerPageCompleted" class="form-select me-2" onchange="this.form.submit()" style="width: 50px; margin-left: 5px; margin-right: 5px;">
                                    <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <div>
                                    <span>Total {{ $completedProjects->firstItem() }} - {{ $completedProjects->lastItem() }} of {{ $completedProjects->total() }}</span>
                                </div>
                            </div>
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="company_id" value="{{ $companyId }}">
                        </form>
                        <div>
                            {{ $completedProjects->appends(['search' => request('search'), 'rows' => request('rows')])->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

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
                    const filter = this .value.toLowerCase();
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
