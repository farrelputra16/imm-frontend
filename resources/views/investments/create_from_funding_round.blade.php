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
                <option value="angel_investment">Angel Investment</option>
                <option value="crowdfunding">Crowdfunding</option>
                <option value="government_grant">Government Grant</option>
                <option value="foundation_grant">Foundation Grant</option>
                <option value="buyout">Buyout</option>
                <option value="growth_capital">Growth Capital</option>
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
