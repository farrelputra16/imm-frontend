@extends('layouts.app-imm')
@section('title', 'Detail Biaya')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
* {
    text-decoration: none;
    list-style-type: none;
}

.btn-unggah {
    width: 136px;
    height: 35px;
    background-color: #5940CB;
    color: white;
    border: none;
    border-radius: 5px;
}

.btn-tambah {
    width: 156px;
    height: 35px;
    background-color: #5940CB;
    color: white;
    border: none;
    border-radius: 5px;
}

.btn-tambahdana {
    width: 120px;
    height: 40px;
    background-color: #5940CB;
    color: white;
    border: none;
    border-radius: 5px;
}

.form-control {
    width: 298px;
}

.biaya {
    font-size: 24px;
}

a {
    color: black;
}

a:hover {
    color: black;
    text-decoration: none;
}

input[type="date"] {
    width: 274px;
}

input[type="number"] {
    width: 274px;
}

.upload-container input[type="file"] {
    display: none;
}

.upload-container button {
    margin-right: 10px;
    padding: 10px 20px;
    border: none;
    background-color: #007bff;
    color: white;
    cursor: pointer;
    border-radius: 5px;
}

.upload-container .file-name {
    font-size: 14px;
    color: #333;
}

.btn-keluar {
    width: 183px;
    height: 35px;
    background-color: white;
    border: 2px solid #5940cb;
    border-radius: 7px;
}

.btn-masuk {
    width: 183px;
    height: 35px;
    background-color: #5940cb;
    color: white;
    border: none;
    border-radius: 7px;
}

.modal-content {
    width: 699px;
    height: 253px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.modal-body img{
    width: 100%;
    height: 100%
}
.dataTables_paginate {
margin-top: 20px;
}
.modal-body {
    gap: 20px;
    margin: 0 51px;
    height: 100%;
    display: flex;
    align-items: start;
    justify-content: center;
    flex-direction: column;
}

.btnn {
    display: flex;
    align-content: center;
    justify-content: space-around;
    width: 100%;
}


/* Custom styles for the modal */

.modal-body {
    max-height: 700px;
    /* Adjust the height as needed */
    overflow-y: auto;
    ;
}

.list-group {
    display: flex;
    justify-content: center;
    width: 400px;
}


#details-table_wrapper label{
    margin-top: -40px;
    display: flex;
    align-items: center;
    padding: 10px;

}

.paginate_button.current{
    background-color: #007bff;
}

.dataTables_info{
    display: none;
}

.list-group-item {
    display: flex;
    justify-content: center;
    font-size: 14px;
    /* Adjust the font size as needed */
}
</style>

@endsection

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-start">
            <nav aria-label="breadcrumb" class="mb-5">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        @if ($isCompany)
                            <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                        @else
                            <a href="{{ route('investments.pending') }}" style="text-decoration: none; color: #212B36;">Home</a>
                        @endif
                    </li>
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="{{ route('kelolapengeluaran', ['company_id' => $companyId]) }}" style="text-decoration: none; color: #212B36;">Financial Management</a>
                    </li>
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="{{ url()->previous() }}" style="text-decoration: none; color: #212B36;">Expense Details</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>


    <div class="container">
        <h2>Detail Biaya</h2>
        <!-- Tampilkan tombol "Tambah Penggunaan Dana" hanya jika role-nya company -->
        <div class="d-flex justify-content-end align-items-center" >
            <div class="d-flex align-items-center">
                <div class="search-container" style="margin-right:10px; margin-bottom: 0px;">
                    <i class="fas fa-search" style="margin-left: 10px;"></i>
                    <form method="GET" action="{{ route('homepageimm.detailbiaya', ['project_id' => $project->id]) }}">
                        <input class="form-control" placeholder="Search Income" type="text" style="border: none;" name="search_income" id="search_Income" value="{{ request('search_income') }}">
                        <input type="hidden" name="rows" value="{{ request('rows', 10) }}">
                    </form>
                </div>
                @if($isCompany)
                <a href="{{ route('selectProjectOutcome', ['project_id' => $project_id, 'company_id' => $companyId]) }}">
                    <button class="btn-tambahdana">Add New</button>
                </a>
                @endif
            </div>
        </div>

        <div class="table-responsive" style="margin-bottom: 0px;">
            <table id="details-table" class="table table-hover table-strip mt-3" style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">No.</th>
                        <th scope="col" style="vertical-align: middle;">Tanggal</th>
                        <th scope="col" style="vertical-align: middle;">Jumlah Biaya</th>
                        <th scope="col" style="vertical-align: middle;">Pelaporan Dana</th>
                        <th scope="col" style="border-top-right-radius: 20px; vertical-align: middle;">Bukti</th>
                    </tr>
                </thead>
                <tbody id="outcome-list">
                    @if ($outcomes->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center" style="border-left: 1px solid #BBBEC5; border-right: 1px solid #BBBEC5;">Tidak ada Outcome</td>
                        </tr>
                    @else
                        @foreach ($outcomes as $outcome)
                        <tr>
                            <td style="vertical-align: middle; border-left: 1px solid #BBBEC5;">{{ $loop->iteration + ($outcomes->currentPage() - 1) * $outcomes->perPage() }}</td>
                            <td style="vertical-align: middle;">{{ $outcome->date ? \Carbon\Carbon::parse($outcome->date)->format('j M, Y') : 'N/A' }}</td>
                            <td style="vertical-align: middle;">Rp{{ number_format($outcome->jumlah_biaya, 0, ',', '.') }}</td>
                            <td style="vertical-align: middle;">{{ $outcome->pelaporan_dana }}</td>
                            <td style="vertical-align: middle; border-right: 1px solid #BBBEC5;">
                                <span data-toggle="modal" style="cursor: pointer" data-target="#notificationModal{{ $outcome->id }}">
                                    <img src="{{ asset('images/icon-bukti.svg') }}" alt="Bukti">
                                </span>
                            </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td colspan="2" class="text-right" style="border-left: 1px solid #BBBEC5; border-right: 1px solid #BBBEC5;">Total</td>
                            <td style="vertical-align: middle;">Rp{{ number_format($outcomes->sum('jumlah_biaya'), 0, ',', '.') }}</td>
                            <td colspan="2" style="border-right: 1px solid #BBBEC5;"></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Footer sebagai bagian dari tabel -->
        <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 1px solid #BBBEC5; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
            <form method="GET" action="{{ route('homepageimm.detailbiaya', ['project_id' => $project->id]) }}" class="mb-0">
                <div class="d-flex align-items-center">
                    <label for="rowsPerPage" class="me-2">Rows per page:</label>
                    <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()" style="width: 50%px; margin-left: 5px; margin-right: 5px;">
                        <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <div>
                        @if(!$outcomes->isEmpty())
                            <span>Total {{ ($outcomes->currentPage() - 1) * $outcomes->perPage() + 1 }} - {{ ($outcomes->currentPage() - 1) * $outcomes->perPage() + $outcomes->count() }} of {{ $outcomes->total() }}</span>
                        @else
                            <span>No outcomes found.</span>
                        @endif
                    </div>
                </div>
            </form>
            <div>
                {{ $outcomes->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>

        <!-- "Detail biaya tidak ditemukan" message -->
        <div id="no-results" class="text-center py-3" style="display: none;">
            Detail biaya tidak ditemukan.
        </div>
    </div>

    <!-- Modals for Each Outcome -->
    @foreach ($outcomes as $outcome)
        <div class="modal fade" id="notificationModal{{ $outcome->id }}" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content pb-4" style="height: 400px">
                    <div class="modal-header">
                        <h5 class="modal-title" id="notificationModalLabel">Bukti Pengeluaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($outcome->bukti)
                            @php
                                $folderName = $companyName; // Ganti dengan nama folder yang sesuai
                                $filePath = $outcome->bukti; // Menggunakan path yang sudah disimpan
                                $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                            @endphp

                            @if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ env('APP_URL') . '/' . $filePath }}" alt="Bukti Pengeluaran" class="img-fluid my-4">
                            @elseif ($fileExtension === 'pdf')
                                <iframe src="{{ env('APP_URL') . '/' . $filePath }}" width="100%" height="400px"></iframe>
                            @else
                                <p>Format file tidak didukung.</p>
                            @endif
                        @else
                            <p>Tidak ada bukti pengeluaran yang tersedia.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
    jQuery(document).ready(function($) {
        // Initialize DataTables for details table
        $('#details-table').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": false,
            "pageLength": 5,
            "order": [[0, "desc"]]
        });

        // Existing search functionality can be integrated or adjusted as necessary
        $('#search-outcomes').on('keyup', function() {
            $('#details-table').DataTable().search($(this).val()).draw();
        });
    });
    </script>
@endsection
