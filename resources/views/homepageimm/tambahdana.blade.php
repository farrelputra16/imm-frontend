@extends('layouts.app-imm')
@section('title', 'Tambah Penggunaan Dana')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
/* Styling tetap sama */
h4 {
    color: #5940CB;
    font-weight: bold;
    margin-bottom: 20px;
}

.form-group label {
    color: #5940CB;
    font-weight: bold;
}

.form-control {
    border: 1px solid #5940CB;
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
<div class="container" style="margin-top:100px;">
    <h4>Tambah Penggunaan Dana</h4>
    <form action="{{ route('companyIncome.store') }}" method="POST">
        @csrf
        <input type="hidden" name="company_id" value="{{ $company->id }}">
        <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="pengirim">Pengirim</label>
            <input type="text" class="form-control" id="pengirim" name="pengirim" required>
        </div>
        <div class="form-group">
            <label for="bank_asal">Bank Asal</label>
            <input type="text" class="form-control" id="bank_asal" name="bank_asal" required>
        </div>
        <div class="form-group">
            <label for="bank_tujuan">Bank Tujuan</label>
            <input type="text" class="form-control" id="bank_tujuan" name="bank_tujuan" required>
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah (Rp)</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="form-group">
            <label for="funding_type">Funding Type</label>
            <select class="form-control" id="funding_type" name="funding_type" required>
                <option value="Hibah">Hibah</option>
                <option value="Investasi">Investasi</option>
                <option value="Pinjaman">Pinjaman</option>
                <option value="Pre-seed Funding">Pre-seed Funding</option>
                <option value="Seed Funding">Seed Funding</option>
                <option value="Series A Funding">Series A Funding</option>
                <option value="Series B Funding">Series B Funding</option>
                <option value="Series C Funding">Series C Funding</option>
                <option value="Series D Funding">Series D Funding</option>
                <option value="Series E Funding">Series E Funding</option>
                <option value="Debt Funding">Debt Funding</option>
                <option value="Equity Funding">Equity Funding</option>
                <option value="Convertible Debt">Convertible Debt</option >
                <option value="Grants">Grants</option>
                <option value="Revenue-Based Financing">Revenue-Based Financing</option>
                <option value="Private Equity">Private Equity</option>
                <option value="IPO">IPO</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tipe_investasi">Investment Type</label>
            <select name="tipe_investasi" id="tipe_investasi" class="form-control">
                <option value="" {{ old('tipe_investasi') === '' ? 'selected' : '' }}>Tidak ada</option>
                <option value="venture_capital" {{ old('tipe_investasi') === 'venture_capital' ? 'selected' : '' }}>Venture Capital</option>
                <option value="angel_investment" {{ old('tipe_investasi') === 'angel_investment' ? 'selected' : '' }}>Angel Investment</option>
                <option value="crowdfunding" {{ old('tipe_investasi') === 'crowdfunding' ? 'selected' : '' }}>Crowdfunding</option>
                <option value="government_grant" {{ old('tipe_investasi') === 'government_grant' ? 'selected' : '' }}>Government Grant</option>
                <option value="foundation_grant" {{ old('tipe_investasi') === 'foundation_grant' ? 'selected' : '' }}>Foundation Grant</option>
                <option value="buyout" {{ old('tipe_investasi') === 'buyout' ? 'selected' : '' }}>Buyout</option>
                <option value="growth_capital" {{ old('tipe_investasi') === 'growth_capital' ? 'selected' : '' }}>Growth Capital</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Dana</button>
    </form>
</div>
@endsection