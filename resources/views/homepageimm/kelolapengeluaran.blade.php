@extends('layouts.app-imm')
@section('title', 'Kelola Pengeluaran')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<style>
/* Styling tetap sama */
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
    width: 300px;
    margin-left: 0.5em;
    float: none;
}

tr {
    background-color: #5940cb;
}

th {
    color: white;
}

td {
    color: black;
}

.btn-unggah, .btn-tambah, .btn-tambahdana, .btn-tambah-proyek {
    background-color: #5940CB;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 8px 16px;
}

.form-control {
    width: 298px;
}

#income-table_filter label,
#project-table_filter label {
    display: flex;
    align-items: center;
    justify-content: flex-end;
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

input[type="date"],
input[type="number"] {
    width: 274px;
}

.modal-body {
    max-height: 700px;
    overflow-y: auto;
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
    <div class="row">
        <div class="col-md-6">
            <span class="biaya">Dana Masuk</span>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('createCompanyIncome') }}" class="btn btn-tambahdana">Tambah Dana</a>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
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
                        <td>{{ $income->tipe_investasi ?? 'Tidak ada tipe investasi' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="container my-3">
    <div class="row">
        <div class="col-md-6">
            <span class="biaya">Rancangan pengeluaran Proyek</span>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table id="project-table" class="table tabel mt-3 text-center border">
                <thead>
                    <tr>
                        <th>Nama Proyek</th>
                        <th>Rancangan Biaya Eksternal</th>
                        <th>Rancangan Biaya Internal</th>
                        <th>Total Dana Tersedia</th> <!-- Kolom baru -->
                        <th>Detail penggunaan biaya</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projectsWithFunding as $project)
                        <tr>
                            <td>{{ $project->nama }}</td>
                            <td>
                                @if($project->externalFunding->count() > 0)
                                    Rp{{ number_format($project->externalFunding->sum('nominal'), 0, ',', '.') }}
                                    <br>
                                    <small>
                                        @foreach ($project->externalFunding as $dana)
                                            {{ $dana->jenis_dana }}
                                        @endforeach
                                    </small>
                                @else
                                    Tidak ada pendanaan eksternal
                                @endif
                            </td>
                            <td>
                                @if($project->internalFunding->count() > 0)
                                    Rp{{ number_format($project->internalFunding->sum('nominal'), 0, ',', '.') }}
                                    <br>
                                    <small>
                                        @foreach ($project->internalFunding as $dana)
                                            <span class="badge badge-secondary">{{ $dana->jenis_dana }}</span>
                                        @endforeach
                                    </small>
                                @else
                                    Tidak ada pendanaan internal
                                @endif
                            </td>
                            <td>
                                Rp{{ number_format($project->totalDanaTersedia, 0, ',', '.') }} <!-- Menampilkan total dana tersedia -->
                            </td>
                            <td>
                                <a href="{{ route('homepageimm.detailbiaya', ['project_id' => $project->id]) }}" style="text-decoration: underline">cek disini</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
jQuery(document).ready(function($) {
    $('#income-table').DataTable({
        "paging": true,
        "searching": true,
        "info": false,
        "lengthChange": false,
        "pageLength": 5,
        "order": [[0, "desc"]]
    });

    $('#project-table').DataTable({
        "paging": true,
        "searching": true,
        "info": false,
        "lengthChange": false,
        "pageLength": 5,
        "order": [[0, "desc"]]
    });
});
</script>
@endsection