
@extends('layouts.app-imm')
@section('title', 'Kelola Pengeluaran')

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

.tabel {
    background-color: #F7F6FB;
    border-radius: 5px;
}

.dataTables_wrapper .dataTables_filter input {
    width: 300px; /* Adjust width for search input */
    margin-left: 0.5em;
 
    float: right;

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
#income-table_filter label{
    margin-top: -50px;
    display: flex;
    align-items: center;
}

#project-table_filter label{
    margin-top: -50px;
    display: flex;
    align-items: center;
}

.biaya {
    font-size: 24px;
    margin-bottom: 
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
    <a href="homepage">
        <h4 class="d-flex align-items-center"><strong style="font-size: 40px;">&lt;</strong> Pengelolaan Dana</h4>
    </a>
</div>
<div class="container">
<span class="biaya">Dana Masuk</span>
</div>
<div class="container mt-3">
    

    <table id="income-table" class="table tabel mt-3 text-center border">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Bank Asal</th>
                <th>Bank Tujuan</th>
                <th>Jumlah (Rp)</th>
                <th>Funding Type</th>
                <th>Tipe Investasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companyIncomes as $income)
            <tr>
                <td>{{ $income->date }}</td>
                <td>{{ $income->pengirim }}</td>
                <td>{{ $income->bank_asal }}</td>
                <td>{{ $income->bank_tujuan }}</td>
                <td>Rp{{ number_format($income->jumlah, 0, ',', '.') }}</td>
                <td>{{ $income->funding_type }}</td>
                <td>
                    @if ($income->tipe_investasi)
                        {{ $income->tipe_investasi }}
                    @else
                        Tidak ada tipe investasi
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container my-3 d-flex justify-content-between align-items-center">
    <span class="biaya">Rancangan pengeluaran Proyek</span>
</div>

<div class="container">
    <table id="project-table" class="table tabel mt-3 text-center border">
        <thead>
            <tr>
                <th>Nama Proyek</th>
                <th>Rancangan Biaya Grant</th>
                <th>Detail penggunaan biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->nama }}</td>
                <td>Rp{{ number_format($project->dana->first()->nominal, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('homepageimm.detailbiaya', ['project_id' => $project->id]) }}" style="text-decoration: underline">cek disini</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    // Initialize DataTables for income table
    $('#income-table').DataTable({
        "paging": true,
        "searching": true,
        "info": false,
        "lengthChange": false,
        "pageLength": 5,
        "order": [[0, "desc"]]
    });

    // Initialize DataTables for project table
    $('#project-table').DataTable({
        "paging": true,
        "searching": true,
        "info": false,
        "lengthChange": false,
        "pageLength": 5,
        "order": [[0, "desc"]]
    });

    // Handle search input for income table
    $('#search-income').on('keyup', function() {
        $('#income-table').DataTable().search($(this).val()).draw();
    });

    // Handle search input for project table
    $('#search-project').on('keyup', function() {
        $('#project-table').DataTable().search($(this).val()).draw();
    });
});
</script>
@endsection