@extends('layouts.app-imm')
@section('title', 'Tambah Penggunaan Dana')

@section('css')
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
/* Styling tetap sama */
h4 {
    color: #5940CB;
    font-weight: bold;
    margin-bottom: 20px;
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

.form-group label {
    color: #5940CB;
    font-weight: bold;
}

.form-control {
    border: 1px solid #808080;
    border-radius: 5px;
}

.btn-primary {
    background-color: #5940CB;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    font-weight: bold;
}

.btn-primary:hover {
    background-color: #3e2a9b;
}

.spesifikasi-pendanaan {
    margin-top: 20px;
}

.spesifikasi-pendanaan table {
    width: 100%;
    border-collapse: collapse;
}

.spesifikasi-pendanaan th, .spesifikasi-pendanaan td {
    border: 1px solid #ddd;
    padding: 8px;
}

.spesifikasi-pendanaan th {
    background-color: #5940CB;
    color: white;
}

.spesifikasi-pendanaan select, .spesifikasi-pendanaan input {
    width: 100%;
    padding: 8px;
    border: 1px solid #5940CB;
    border-radius: 5px;
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
                <a href="{{ route('company_finances.index', ['companyId' => $companyId]) }}" style="text-decoration: none; color: #212B36;">Financial Management</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #212B36;">Create Report Financial</a>
            </li>
        </ol>
    </nav>
    <h2 class="header-title" style="color: #6256CA; margin: 0px; margin-top: 32px; margin-bottom: 32px;">Tambah Penggunaan Dana</h2>
    <form action="{{ route('company_finances.store') }}" method="POST">
        @csrf
        <input type="hidden" name="company_id" value="{{ $companyId }}">

        {{-- Total Pendapatan --}}
        <div class="form-group">
            <label for="total_pendapatan" class="sub-heading-1" style="color: #3F3F46;">Total Pendapatan</label>
            <input type="text" class="form-control" id="total_pendapatan_display" required>
            <input type="hidden" class="form-control" id="total_pendapatan" name="total_pendapatan">
        </div>

        {{-- Laba Kotor --}}
        <div class="form-group">
            <label for="laba_kotor" class="sub-heading-1" style="color: #3F3F46;">Laba Kotor</label>
            <input type="text" class="form-control" id="laba_kotor_display" required>
            <input type="hidden" class="form-control" id="laba_kotor" name="laba_kotor">
        </div>

        {{-- Laba Usaha --}}
        <div class="form-group">
            <label for="laba_usaha" class="sub-heading-1" style="color: #3F3F46;">Laba Usaha</label>
            <input type="text" class="form-control" id="laba_usaha_display" required>
            <input type="hidden" class="form-control" id="laba_usaha" name="laba_usaha">
        </div>

        <div class="form-group">
            <label for="laba_sebelum_pajak" class="sub-heading-1" style="color: #3F3F46;">Laba Sebelum Pajak</label>
            <input type="text" class="form-control" id="laba_sebelum_pajak_display" required>
            <input type="hidden" class="form-control" id="laba_sebelum_pajak" name="laba_sebelum_pajak">
        </div>

        <div class="form-group">
            <label for="laba_bersih_tahun_berjalan" class="sub-heading-1" style="color: #3F3F46;">Laba Bersih Tahun Berjalan</label>
            <input type="text" class="form-control" id="laba_bersih_tahun_berjalan_display" required>
            <input type="hidden" class="form-control" id ="laba_bersih_tahun_berjalan" name="laba_bersih_tahun_berjalan">
        </div>

        <div class="form-group">
            <label for="status_quarter" class="sub-heading-1" style="color: #3F3F46;">Quarter</label>
            <input type="text" class="form-control" id="status_quarter" name="status_quarter" readonly>
        </div>

        <div class="form-group">
            <label for="tahun" class="sub-heading-1" style="color: #3F3F46;">Tahun</label>
            <input type="text" class="form-control" id="tahun" name="tahun" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Tambah Dana</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
    $(document).ready(function() {
        // Fungsi untuk menghapus format Rupiah
        function removeFormatRupiah(angka) {
            return angka.replace(/[^,\d]/g, '');
        }

        // Fungsi untuk memformat input menjadi Rupiah
        function formatRupiah(angka) {
            if (angka == '') {
                return '';
            }

            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp. ' + rupiah;
        }

        // Fungsi untuk mengupdate format rupiah pada input
        function updateRupiah(inputDisplay, inputHidden) {
            $(inputDisplay).on('input', function() {
                var nominal = $(this).val();
                var originalValue = removeFormatRupiah(nominal);
                $(this).val(formatRupiah(originalValue));
                $(inputHidden).val(originalValue);
            });
        }

        // Terapkan format rupiah pada semua input numerik
        updateRupiah("#total_pendapatan_display", "#total_pendapatan");
        updateRupiah("#laba_kotor_display", "#laba_kotor");
        updateRupiah("#laba_usaha_display", "#laba_usaha");
        updateRupiah("#laba_sebelum_pajak_display", "#laba_sebelum_pajak");
        updateRupiah("#laba_bersih_tahun_berjalan_display", "#laba_bersih_tahun_berjalan");
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mendapatkan tanggal saat ini
        var currentDate = new Date();

        // Mendapatkan tahun saat ini
        var currentYear = currentDate.getFullYear();

        // Mendapatkan bulan saat ini (0-11)
        var currentMonth = currentDate.getMonth(); // 0 = Januari, 1 = Februari, ..., 11 = Desember

        // Mendapatkan quarter saat ini
        var quarter;
        if (currentMonth >= 0 && currentMonth <= 2) {
            quarter = 'Q1'; // Januari - Maret
        } else if (currentMonth >= 3 && currentMonth <= 5) {
            quarter = 'Q2'; // April - Juni
        } else if (currentMonth >= 6 && currentMonth <= 8) {
            quarter = 'Q3'; // Juli - September
        } else {
            quarter = 'Q4'; // Oktober - Desember
        }

        // Mengisi nilai ke input
        document.getElementById('status_quarter').value = quarter;
        document.getElementById('tahun').value = currentYear;
    })
</script>
@endsection
