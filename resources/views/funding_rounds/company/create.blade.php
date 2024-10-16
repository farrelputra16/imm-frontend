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

        <button type="submit" class="btn btn-success">Create Funding Round</button>
    </form>

    <!-- Tombol untuk kembali ke halaman list funding round -->
    <div class="mt-4">
        <a href="{{ route('company.funding_rounds.list') }}" class="btn btn-secondary">Back to Funding Rounds</a>
    </div>
</div>

@endsection
