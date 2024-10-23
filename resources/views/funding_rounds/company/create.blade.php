@extends('layouts.app-landingpage')

@section('content')

<div class="container">
    <h1 class="my-4">Create New Funding Round</h1>

    <!-- Menampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form untuk membuat funding round baru -->
    <form method="POST" action="{{ route('company.funding_rounds.store') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Funding Round Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="target" class="form-label">Target Amount</label>
            <input type="number" class="form-control" id="target" name="target" value="{{ old('target') }}">
        </div>

        <div class="mb-3">
            <label for="announced_date" class="form-label">Announced Date</label>
            <input type="date" class="form-control" id="announced_date" name="announced_date" value="{{ old('announced_date') }}">
        </div>

        <!-- Tambahkan field funding_stage -->
        <div class="mb-3">
            <label for="funding_stage" class="form-label">Funding Stage</label>
            <select class="form-control" id="funding_stage" name="funding_stage">
                <option value="">Select Stage</option>
                <option value="bootstrapping" {{ old('funding_stage') == 'bootstrapping' ? 'selected' : '' }}>Bootstrapping</option>
                <option value="pre_seed" {{ old('funding_stage') == 'pre_seed' ? 'selected' : '' }}>Pre-Seed</option>
                <option value="seed" {{ old('funding_stage') == 'seed' ? 'selected' : '' }}>Seed</option>
                <option value="series_a" {{ old('funding_stage') == 'series_a' ? 'selected' : '' }}>Series A</option>
                <option value="series_b" {{ old('funding_stage') == 'series_b' ? 'selected' : '' }}>Series B</option>
                <option value="series_c" {{ old('funding_stage') == 'series_c' ? 'selected' : '' }}>Series C</option>
                <option value="series_d" {{ old('funding_stage') == 'series_d' ? 'selected' : '' }}>Series D</option>
                <option value="series_e" {{ old('funding_stage') == 'series_e' ? 'selected' : '' }}>Series E</option>
                <option value="mezzanine" {{ old('funding_stage') == 'mezzanine' ? 'selected' : '' }}>Mezzanine</option>
                <option value="ipo" {{ old('funding_stage') == 'ipo' ? 'selected' : '' }}>IPO</option>
                <option value="post_ipo" {{ old('funding_stage') == 'post_ipo' ? 'selected' : '' }}>Post-IPO</option>
                <option value="venture_series_unknown" {{ old('funding_stage') == 'venture_series_unknown' ? 'selected' : '' }}>Venture - Series Unknown</option>
                <option value="angel" {{ old('funding_stage') == 'angel' ? 'selected' : '' }}>Angel</option>
                <option value="private_equity" {{ old('funding_stage') == 'private_equity' ? 'selected' : '' }}>Private Equity</option>
                <option value="debt_financing" {{ old('funding_stage') == 'debt_financing' ? 'selected' : '' }}>Debt Financing</option>
                <option value="convertible_note" {{ old('funding_stage') == 'convertible_note' ? 'selected' : '' }}>Convertible Note</option>
                <option value="grant" {{ old('funding_stage') == 'grant' ? 'selected' : '' }}>Grant</option>
                <option value="corporate_round" {{ old('funding_stage') == 'corporate_round' ? 'selected' : '' }}>Corporate Round</option>
                <option value="equity_crowdfunding" {{ old('funding_stage') == 'equity_crowdfunding' ? 'selected' : '' }}>Equity Crowdfunding</option>
                <option value="product_crowdfunding" {{ old('funding_stage') == 'product_crowdfunding' ? 'selected' : '' }}>Product Crowdfunding</option>
                <option value="secondary_market" {{ old('funding_stage') == 'secondary_market' ? 'selected' : '' }}>Secondary Market</option>
                <option value="post_ipo_equity" {{ old('funding_stage') == 'post_ipo_equity' ? 'selected' : '' }}>Post-IPO Equity</option>
                <option value="post_ipo_debt" {{ old('funding_stage') == 'post_ipo_debt' ? 'selected' : '' }}>Post-IPO Debt</option>
                <option value="post_ipo_secondary" {{ old('funding_stage') == 'post_ipo_secondary' ? 'selected' : '' }}>Post-IPO Secondary</option>
                <option value="non_equity_assistance" {{ old('funding_stage') == 'non_equity_assistance' ? 'selected' : '' }}>Non-equity Assistance</option>
                <option value="initial_coin_offering" {{ old('funding_stage') == 'initial_coin_offering' ? 'selected' : '' }}>Initial Coin Offering</option>
                <option value="undisclosed" {{ old('funding_stage') == 'undisclosed' ? 'selected' : '' }}>Undisclosed</option>
            </select>
        </div>

        <!-- Tambahkan field description -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Create Funding Round</button>
    </form>

    <!-- Tombol untuk kembali ke halaman list funding round -->
    <div class="mt-4">
        <a href="{{ route('company.funding_rounds.list') }}" class="btn btn-secondary">Back to Funding Rounds</a>
    </div>
</div>

@endsection
