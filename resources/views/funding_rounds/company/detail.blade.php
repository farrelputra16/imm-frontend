@extends('layouts.app-landingpage')

@section('content')

<div class="container">
    <h1 class="my-4">Edit Funding Round: {{ $fundingRound->name }}</h1>

    <!-- Menampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form untuk Edit Funding Round -->
    <form action="{{ route('company.funding_rounds.update', $fundingRound->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Funding Round Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $fundingRound->name }}" required>
        </div>

        <div class="mb-3">
            <label for="target" class="form-label">Target Amount</label>
            <input type="number" class="form-control" id="target" name="target" value="{{ $fundingRound->target }}">
        </div>

        <div class="mb-3">
            <label for="announced_date" class="form-label">Announced Date</label>
            <input type="date" class="form-control" id="announced_date" name="announced_date" value="{{ $fundingRound->announced_date }}">
        </div>

        <!-- Dropdown untuk memilih Lead Investor -->
        <div class="mb-3">
            <label for="lead_investor_id" class="form-label">Select Lead Investor</label>
            <select class="form-control" id="lead_investor_id" name="lead_investor_id">
                <option value="">Select Lead Investor</option>
                @foreach($investors as $investor)
                    <option value="{{ $investor->id }}" {{ $fundingRound->lead_investor_id == $investor->id ? 'selected' : '' }}>
                        {{ $investor->org_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>

@endsection
