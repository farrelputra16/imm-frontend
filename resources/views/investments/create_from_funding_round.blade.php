@extends('layouts.app-landingpage')
@section('css')
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>
      /* Mengatur font family untuk seluruh halaman */
      body {
        font-family: 'Poppins', sans-serif; /* Menggunakan Inter untuk isi/content */
    }

    /* Mengatur font family untuk heading */
    h1, h2, h3, h4 {
        font-family: 'Poppins', sans-serif; /* Menggunakan Work Sans untuk heading */
    }

    /* Mengatur font family untuk sub-heading dan body */
    .sub-heading-1, .sub-heading-2, .body-1, .body-2 {
        font-family: 'Poppins', sans-serif; /* Set font to Poppins */
    }
</style>
@endsection
@section('content')
<div class="container">
    <nav aria-label="breadcrumb" style="margin-bottom: 32px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{route('funding_rounds.index')}}" style="text-decoration: none; color: #212B36;">Funding Rounds</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #212B36;">Details</a>
            </li>
        </ol>
    </nav>

    <h2>Invest in {{ $fundingRound->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('investments.storeFromFundingRound', $fundingRound->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="formatted_amount" class="form-label">Investment Amount</label>
            <input type="text" name="formatted_amount" id="formatted_amount" class="form-control" required 
                   placeholder="Enter the amount you wish to invest" style="border: 1px solid #6256CA">
            <input type="hidden" name="amount" id="amount" value="">
        </div>

        <div class="mb-3">
            <label for="investment_date" class="form-label">Investment Date</label>
            <input type="date" name="investment_date" id="investment_date" class="form-control" required 
                   style="border: 1px solid #6256CA">
        </div>

        <div class="mb-3">
            <label for="funding_type" class="form-label">Funding Type</label>
            <input type="text" name="funding_type" id="funding_type" class="form-control" 
                   value="{{ $fundingRound->funding_stage }}" readonly style="border: 1px solid #6256CA">
        </div>

        <div class="mb-3">
            <label for="tipe_investasi" class="form-label">Investment Type</label>
            <select name="tipe_investasi" id="tipe_investasi" class="form-control" style="border: 1px solid #6256CA">
                <option value="venture_capital">Venture Capital</option>
                <option value="individual_angel">Individual/Angel</option>
                <option value="private_equity_firm">Private Equity Firm</option>
                <option value="accelerator">Accelerator</option>
                <option value="investment_partner">Investment Partner</option>
                <option value="corporate_venture_capital">Corporate Venture Capital</option>
                <option value="micro_vc">Micro VC</option>
                <option value="angel_group">Angel Group</option>
                <option value="incubator">Incubator</option>
                <option value="investment_bank">Investment Bank</option>
                <option value="family_investment_office">Family Investment Office</option>
                <option value="venture_debt">Venture Debt</option>
                <option value="co_working_space">Co-Working Space</option>
                <option value="fund_of_funds">Fund Of Funds</option>
                <option value="hedge_fund">Hedge Fund</option>
                <option value="government_office">Government Office</option>
                <option value="university_program">University Program</option>
                <option value="entrepreneurship_program">Entrepreneurship Program</option>
                <option value="secondary_purchaser">Secondary Purchaser</option>
                <option value="startup_competition">Startup Competition</option>
                <option value="syndicate">Syndicate</option>
                <option value="pension_funds">Pension Funds</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="pengirim" class="form-label">Sender (Pengirim)</label>
            <input type="text" name="pengirim" id="pengirim" class="form-control" 
                   value="{{ $firstName }}" required style="border: 1px solid #6256CA">
        </div>

        <div class="mb-3">
            <label for="bank_asal" class="form-label">Originating Bank (Bank Asal)</label>
            <input type="text" name="bank_asal" id="bank_asal" class="form-control" 
                   required style="border: 1px solid #6256CA">
        </div>

        <div class="mb-3">
            <label for="bank_tujuan" class="form-label">Destination Bank (Bank Tujuan)</label>
            <input type="text" name="bank_tujuan" id="bank_tujuan" class="form-control" 
                   required style="border: 1px solid #6256CA">
        </div>

        <div class="d-flex justify-content-between mt-4" style="margin-bottom:70px;">
            <button type="submit" class="btn btn-success" style="background-color: #6256CA; border-color: #6256CA;">Submit Investment</button>
            <button type="button" class="btn btn-secondary">Cancel</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('formatted_amount').addEventListener('input', function (e) {
        // Remove any non-digit characters
        let value = e.target.value.replace(/\D/g, '');

        // Format the value as a currency
        e.target.value = new Intl.NumberFormat('id-ID').format(value);

        // Set the hidden input value to the raw number (no formatting)
        document.getElementById('amount').value = value;
    });
</script>
@endpush