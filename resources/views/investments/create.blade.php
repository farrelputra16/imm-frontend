@extends('layouts.app-investments')

@section('content')
<div class="container">
    <h1>Invest in {{ $fundingRound->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('investments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="funding_round_id" value="{{ $fundingRound->id }}">

        <!-- Investment amount -->
        <div class="form-group">
            <label for="amount">Investment Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required min="1">
        </div>

        <!-- Investment date -->
        <div class="form-group">
            <label for="investment_date">Investment Date</label>
            <input type="date" name="investment_date" id="investment_date" class="form-control" required>
        </div>

        <!-- Funding Type -->
        <div class="form-group">
            <label for="funding_type">Funding Type</label>
            <input type="text" name="funding_type" id="funding_type" class="form-control" required>
        </div>

        <!-- Pengirim (Sender) -->
        <div class="form-group">
            <label for="pengirim">Sender (Pengirim)</label>
            <input type="text" name="pengirim" id="pengirim" class="form-control" value="{{ $investor->user->nama_depan }}" required>
        </div>

        <!-- Bank Asal -->
        <div class="form-group">
            <label for="bank_asal">Originating Bank</label>
            <input type="text" name="bank_asal" id="bank_asal" class="form-control" required>
        </div>

        <!-- Bank Tujuan -->
        <div class="form-group">
            <label for="bank_tujuan">Destination Bank</label>
            <input type="text" name="bank_tujuan" id="bank_tujuan" class="form-control" required>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Submit Investment</button>
    </form>
</div>
@endsection
