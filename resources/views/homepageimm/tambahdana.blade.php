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
            <label for="project_id">Proyek</label>
            <select name="project_id" id="project_id" class="form-control" required>
                <option value="">Pilih Proyek</option>
                @foreach($company->projects as $project)
                    <option value="{{ $project->id }}">{{ $project->nama }}</option>
                @endforeach
            </select>
        </div>
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
                <option value="individual_angel" {{ old('tipe_investasi') === 'individual_angel' ? 'selected' : '' }}>Individual/Angel</option>
                <option value="private_equity_firm" {{ old('tipe_investasi') === 'private_equity_firm' ? 'selected' : '' }}>Private Equity Firm</option>
                <option value="accelerator" {{ old('tipe_investasi') === 'accelerator' ? 'selected' : '' }}>Accelerator</option>
                <option value="investment_partner" {{ old('tipe_investasi') === 'investment_partner' ? 'selected' : '' }}>Investment Partner</option>
                <option value="corporate_venture_capital" {{ old('tipe_investasi') === 'corporate_venture_capital' ? 'selected' : '' }}>Corporate Venture Capital</option>
                <option value="micro_vc" {{ old('tipe_investasi') === 'micro_vc' ? 'selected' : '' }}>Micro VC</option>
                <option value="angel_group" {{ old('tipe_investasi') === 'angel_group' ? 'selected' : '' }}>Angel Group</option>
                <option value="incubator" {{ old('tipe_investasi') === 'incubator' ? 'selected' : '' }}>Incubator</option>
                <option value="investment_bank" {{ old('tipe_investasi') === 'investment_bank' ? 'selected' : '' }}>Investment Bank</option>
                <option value="family_investment_office" {{ old('tipe_investasi') === 'family_investment_office' ? 'selected' : '' }}>Family Investment Office</option>
                <option value="venture_debt" {{ old('tipe_investasi') === 'venture_debt' ? 'selected' : '' }}>Venture Debt</option>
                <option value="co_working_space" {{ old('tipe_investasi') === 'co_working_space' ? 'selected' : '' }}>Co-Working Space</option>
                <option value="fund_of_funds" {{ old('tipe_investasi') === 'fund_of_funds' ? 'selected' : '' }}>Fund Of Funds</option>
                <option value="hedge_fund" {{ old('tipe_investasi') === 'hedge_fund' ? 'selected' : '' }}>Hedge Fund</option>
                <option value="government_office" {{ old('tipe_investasi') === 'government_office' ? 'selected' : '' }}>Government Office</option>
                <option value="university_program" {{ old('tipe_investasi') === 'university_program' ? 'selected' : '' }}>University Program</option>
                <option value="entrepreneurship_program" {{ old('tipe_investasi') === 'entrepreneurship_program' ? 'selected' : '' }}>Entrepreneurship Program</option>
                <option value="secondary_purchaser" {{ old('tipe_investasi') === 'secondary_purchaser' ? 'selected' : '' }}>Secondary Purchaser</option>
                <option value="startup_competition" {{ old('tipe_investasi') === 'startup_competition' ? 'selected' : '' }}>Startup Competition</option>
                <option value="syndicate" {{ old('tipe_investasi') === 'syndicate' ? 'selected' : '' }}>Syndicate</option>
                <option value="pension_funds" {{ old('tipe_investasi') === 'pension_funds' ? 'selected' : '' }}>Pension Funds</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Dana</button>
    </form>
</div>
@endsection
