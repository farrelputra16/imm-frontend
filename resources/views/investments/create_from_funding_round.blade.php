@extends('layouts.app-investments')

@section('content')
<div class="container">
    <h1>Invest in Funding Round: {{ $fundingRound->name }}</h1>

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

        <!-- Investment amount -->
        <div class="form-group">
            <label for="amount">Investment Amount</label>
            <input type="text" name="formatted_amount" id="formatted_amount" class="form-control" required>
            <!-- Hidden field to store the unformatted value -->
            <input type="hidden" name="amount" id="amount" value="">
        </div>

        <!-- Investment date -->
        <div class="form-group">
            <label for="investment_date">Investment Date</label>
            <input type="date" name="investment_date" id="investment_date" class="form-control" required>
        </div>

        <!-- Funding Type (fetched from related company) -->
        <div class="form-group">
            <label for="funding_type">Funding Type</label>
            <input type="text" name="funding_type" id="funding_type" class="form-control" value="{{ $fundingRound->company->funding_stage }}" readonly>
        </div>

        <!-- Investment Type -->
        <div class="form-group">
            <label for="tipe_investasi">Investment Type</label>
            <select name="tipe_investasi" id="tipe_investasi" class="form-control">
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

        <!-- Pengirim (Sender) -->
        <div class="form-group">
            <label for="pengirim">Sender (Pengirim)</label>
            <input type="text" name="pengirim" id="pengirim" class="form-control" value="{{ $firstName }}" required>
        </div>

        <!-- Bank Asal (Originating Bank) -->
        <div class="form-group">
            <label for="bank_asal">Originating Bank (Bank Asal)</label>
            <input type="text" name="bank_asal" id="bank_asal" class="form-control" required>
        </div>

        <!-- Bank Tujuan (Destination Bank) -->
        <div class="form-group">
            <label for="bank_tujuan">Destination Bank (Bank Tujuan)</label>
            <input type="text" name="bank_tujuan" id="bank_tujuan" class="form-control" required>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Submit Investment</button>
    </form>
</div>

<!-- Script for formatting amount and keeping the original value -->
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
@endsection
