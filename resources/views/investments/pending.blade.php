@extends('layouts.app-investments')

@section('content')
<div class="container">
    <h1>Your Pending Investments</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Company</th>
                <th>Project</th>
                <th>Amount</th>
                <th>Investment Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($investments as $investment)
                <tr>
                    <td>{{ $investment->company->nama }}</td>
                    <td>{{ $investment->project->nama }}</td>
                    <td>{{ $investment->amount }}</td>
                    <td>{{ $investment->investment_date }}</td>
                    <td>{{ $investment->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
