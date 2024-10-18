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
        <option value="pre-seed" {{ old('funding_stage') == 'pre-seed' ? 'selected' : '' }}>Pre-seed</option>
        <option value="seed" {{ old('funding_stage') == 'seed' ? 'selected' : '' }}>Seed</option>
        <option value="series-a" {{ old('funding_stage') == 'series-a' ? 'selected' : '' }}>Series A</option>
        <option value="series-b" {{ old('funding_stage') == 'series-b' ? 'selected' : '' }}>Series B</option>
        <option value="series-c" {{ old('funding_stage') == 'series-c' ? 'selected' : '' }}>Series C</option>
        <option value="series-d" {{ old('funding_stage') == 'series-d' ? 'selected' : '' }}>Series D</option>
        <option value="series-e" {{ old('funding_stage') == 'series-e' ? 'selected' : '' }}>Series E</option>
        <option value="mezzanine" {{ old('funding_stage') == 'mezzanine' ? 'selected' : '' }}>Mezzanine</option>
        <option value="ipo" {{ old('funding_stage') == 'ipo' ? 'selected' : '' }}>IPO</option>
        <option value="post-ipo" {{ old('funding_stage') == 'post-ipo' ? 'selected' : '' }}>Post-IPO</option>
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
