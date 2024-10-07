@extends('layouts.app-investments')

@section('content')
<div class="container">
    <h1>Invest in ( {{ $company->nama }} )</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('investments.store', $company->id) }}" method="POST">
        @csrf
        <!-- Project selection -->
        <div class="form-group">
            <label for="project_id">Choose Project</label>
            <select name="project_id" id="project_id" class="form-control" required>
                @foreach($projectsWithFunding as $project)
                    <option value="{{ $project->id }}">{{ $project->nama }}</option>
                @endforeach
            </select>
        </div>

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

        <!-- Funding Type (ambil dari external funding) -->
        <div class="form-group">
            <label for="funding_type">Funding Type</label>
            <select name="funding_type" id="funding_type" class="form-control" required>
                @foreach($projectsWithFunding as $project)
                    @foreach($project->externalFunding as $dana)
                        <option value="{{ $dana->jenis_dana }}" {{ old('funding_type') == $dana->jenis_dana ? 'selected' : '' }}>
                            {{ $dana->jenis_dana }} (Project: {{ $project->nama }})
                        </option>
                    @endforeach
                @endforeach
            </select>
        </div>

        <!-- Investment Type (static choices) -->
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

        <!-- Pengirim (Sender) -->
        <div class="form-group">
            <label for="pengirim">Sender (Pengirim)</label>
            <input type="text" name="pengirim" id="pengirim" class="form-control" value="{{ old('pengirim', $firstName) }}" required>
        </div>


        <!-- Bank Asal (Originating Bank) -->
        <div class="form-group">
            <label for="bank_asal">Originating Bank (Bank Asal)</label>
            <input type="text" name="bank_asal" id="bank_asal" class="form-control" value="{{ old('bank_asal') }}" required>
        </div>

        <!-- Bank Tujuan (Destination Bank) -->
        <div class="form-group">
            <label for="bank_tujuan">Destination Bank (Bank Tujuan)</label>
            <input type="text" name="bank_tujuan" id="bank_tujuan" class="form-control" value="{{ old('bank_tujuan') }}" required>
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary">Submit Investment</button>
    </form>
</div>
@endsection
