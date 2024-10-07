@extends('layouts.app-imm')
@section('title', 'Detail Biaya')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    list-style-type: none;
}
tr{
    background-color: #5940cb;
  
}

th{
    color: white;
}

td{
    color: black;
}
.tabel {
    background-color: #F7F6FB;
    border-radius: 5px;
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
    width: 246px;
    height: 35px;
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
<div class="container" style="padding-top: 120px">
    <div class="row d-flex justify-content-between">
        <a href="{{ route('kelolapengeluaran') }}">
            <h4 class=" d-flex align-items-center"><strong style="font-size: 40px;">&lt;</strong> Detail penggunaan biaya proyek {{ $project->nama }}</h4>
        </a>
        <a href="{{ route('selectProjectOutcome', ['project_id' => $project_id]) }}">
            <button class="btn-tambahdana">Tambah Penggunaan Dana</button>
        </a>
    </div>
   
</div>

<div class="container mt-2">

    <h5>Detail Biaya</h5>
    <table id="details-table" class="table text-center border"> 
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah Biaya</th>
                <th>Pelaporan_dana</th>
                <th>Keterangan</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody id="outcome-list">
            @foreach ($outcomes as $outcome)
            <tr>
                <td>{{ $outcome->date }}</td>
                <td>Rp{{ number_format($outcome->jumlah_biaya, 0, ',', '.') }}</td>
                <td>{{ $outcome->pelaporan_dana }}</td>
                <td>{{ $outcome->keterangan }}</td>
                <td>
                    <span data-toggle="modal" style="cursor: pointer" data-target="#notificationModal{{ $outcome->id }}">
                        <img src="{{ asset('images/icon-bukti.svg') }}" alt="Bukti">
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

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
                @if($outcome->pelaporan_dana === 'external')
                    <img src="{{ Storage::url('laporan_pengeluaran_eksternal/' . $outcome->bukti) }}" alt="Bukti Pengeluaran" class="img-fluid my-4">
                @else
                    <img src="{{ Storage::url('laporan_pengeluaran_internal/' . $outcome->bukti) }}" alt="Bukti Pengeluaran" class="img-fluid my-4">
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