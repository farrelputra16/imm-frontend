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
                <th>Funding Type</th>
                <th>Investment Type</th>
                <th>Sender</th>
                <th>Origin Bank</th>
                <th>Destination Bank</th>
                <th>Status</th>
                <th>Report Financial</th>
                <th>Report Project</th>
            </tr>
        </thead>
        <tbody>
            @foreach($investments as $investment)
                <tr>
                    <td>{{ $investment->company->nama }}</td>
                    <td>{{ $investment->project->nama }}</td>
                    <td>Rp{{ number_format($investment->amount, 0, ',', '.') }}</td>
                    <td>{{ $investment->investment_date ? \Carbon\Carbon::parse($investment->investment_date)->format('j M, Y') : 'N/A' }}</td>
                    <td>{{ $investment->funding_type }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $investment->tipe_investasi)) }}</td>
                    <td>{{ $investment->pengirim }}</td>
                    <td>{{ $investment->bank_asal }}</td>
                    <td>{{ $investment->bank_tujuan }}</td>
                    <td>{{ ucfirst($investment->status) }}</td>
                    <!-- Bagian untuk Report Project -->
                    <td>
                        @if($investment->status == 'approved')
                            <!-- Link ke detail laporan keuangan proyek -->
                            <a href="{{ route('homepageimm.detailbiaya', ['project_id' => $investment->project->id]) }}" class="btn btn-info">View Financial Report</a>
                        @else
                            <!-- Jika belum approved -->
                            <span class="badge badge-secondary">Pending</span>
                        @endif
                    </td>
                    <!-- Report Company (biarkan logika ini tetap sesuai kebutuhan Anda) -->
                    <td>
                        @if($investment->status == 'approved')
                            <a href="{{ route('companies-project.show', $investment->project->id) }}" class="btn btn-info">View Company Report</a>
                        @else
                            <span class="badge badge-secondary">Pending</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
