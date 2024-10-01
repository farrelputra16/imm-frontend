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
        <div class="form-group">
            <label for="project_id">Choose Project</label>
            <select name="project_id" id="project_id" class="form-control">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Investment Amount</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="investment_date">Investment Date</label>
            <input type="date" name="investment_date" id="investment_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit Investment</button>
    </form>
</div>
@endsection
