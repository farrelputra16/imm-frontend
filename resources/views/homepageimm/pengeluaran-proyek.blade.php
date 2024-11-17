@extends('layouts.app-imm')
@section('title', 'Tambah Penggunaan Dana')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
    * {
        text-decoration: none;
        list-style-type: none;
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

    .btnn {
        display: flex;
        align-content: center;
        justify-content: space-around;
        width: 100%;
    }

    /* Custom styles for the modal */
    .list-group {
        display: flex;
        justify-content: center;
        width: 400px;
    }

    .list-group-item {
        display: flex;
        justify-content: center;
        font-size: 14px;
    }
    .form-label {
            font-weight: bold;
        }
    .btn-purple {
        background-color: #5940CB;
        color: white;
    }
    /* breadcumb */
    .breadcrumb {
        background-color: white;
        padding: 0;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        margin-right: 14px;
        color: #9CA3AF;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('kelolapengeluaran', ['company_id' => $company_id]) }}" style="text-decoration: none; color: #212B36;">Financial Management</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ url()->previous() }}" style="text-decoration: none; color: #212B36;">Expense Details</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ url()->previous() }}" style="text-decoration: none; color: #212B36;">Add New Income Entry</a>
                </li>
            </ol>
        </nav>
    </div>

    <div class="container mt-5">
        <form id="addOutcomeForm" action="{{ route('companyOutcome.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="project_id" value="{{ $project->id }}">
            <input type="hidden" name="company_id"  value="{{ $project->company_id }}">


            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" style="width: 100%" required>
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" class="form-control" id="amount" name="jumlah_biaya" style="width: 100%" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name="pelaporan_dana" placeholder="cth. Pembelian karung beras bekas (5 lusin)" style="width: 100%" required></textarea>
            </div>
            <div class="mb-3">
                <label for="proof" class="form-label">Proof of Purchase</label>
                <div class="input-group">
                    <span class="input-group-text" onclick="document.getElementById('file-input').click()" type="button" style="background-color: white; border-right: none;">
                        <i class="fas fa-file-alt"  style="font-size: 18px; background-color: white;"></i>
                    </span>
                    <input type="file" class="form-control" id="file-input" name="bukti" onchange="updateFileName()" style="display: none;">
                    <input type="text" class="form-control file-name" style="background-color: white; border-left: none;" readonly>
                </div>
            </div>
            <button type="button" class="btn btn-purple" data-toggle="modal" data-target="#confirmationModal">Add Income</button>
        </form>
    </div>
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <h5 class="modal-title" id="confirmationModalLabel">Apakah data sudah benar?</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Catatan: Data yang anda tambahkan tidak bisa diubah kembali, pastikan semua input data sudah benar.</p>
                </div>
                <div class="modal-footer" style="justify-content: space-between;">
                    <button type="button" class="btn btn-keluar" data-dismiss="modal">Belum, cek kembali</button>
                    <button type="button" id="confirmUpdate" class="btn btn-masuk">Ya, sudah benar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateFileName() {
            var input = document.getElementById('file-input');
            var fileName = input.files.length > 0 ? input.files[0].name : 'Tidak ada file yang dipilih';
            document.querySelector('.file-name').value = fileName; // Ganti textContent dengan value
        }

        document.getElementById('confirmUpdate').addEventListener('click', function() {
            // Pastikan modal tidak mengganggu pengiriman form
            var fileName = document.getElementById('file-input').files.length > 0;
            if (!fileName) {
                alert('Silakan pilih file yang akan diunggah!');
                return;
            }
            document.getElementById('addOutcomeForm').submit();
        });
    </script>
@endsection
