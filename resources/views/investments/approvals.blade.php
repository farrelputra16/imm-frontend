@extends('layouts.app-investments')

@section('content')
<div class="container">
    <h1>Approve or Reject Investments</h1>

    <div class="mb-3">
        <label for="filter-status">Filter by Status:</label>
        <select id="filter-status" class="form-control" onchange="filterInvestments(this.value)">
            <option value="">All</option>
            <option value="pending">Pending</option>
            <option value="approved">Approved</option>
            <option value="rejected">Rejected</option>
        </select>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($investments->isEmpty())
        <p>No investments found.</p>
    @else
        <table class="table" id="investmentTable"> <!-- Tambahkan ID untuk tabel -->
            <thead>
                <tr>
                    <th>Investor</th>
                    <th>Project</th>
                    <th>Amount</th>
                    <th>Investment Date</th>
                    <th>Funding Type</th> <!-- Kolom baru untuk Funding Type -->
                    <th>Investment Type</th> <!-- Kolom baru untuk Investment Type -->
                    <th>Sender</th> <!-- Kolom baru untuk Pengirim -->
                    <th>Origin Bank</th> <!-- Kolom baru untuk Bank Asal -->
                    <th>Destination Bank</th> <!-- Kolom baru untuk Bank Tujuan -->
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                    <tr data-status="{{ $investment->status }}"> <!-- Tambahkan data-status untuk filter -->
                        <td>{{ $investment->investor->org_name }}</td>
                        <td>{{ number_format($investment->amount, 0, ',', '.') }} IDR</td>
                        <td>{{ \Carbon\Carbon::parse($investment->investment_date)->format('j M, Y') }}</td>
                        <td>{{ $investment->funding_type }}</td> <!-- Menampilkan Funding Type -->
                        <td>{{ ucfirst(str_replace('_', ' ', $investment->tipe_investasi)) }}</td> <!-- Menampilkan Investment Type -->
                        <td>{{ $investment->pengirim }}</td> <!-- Menampilkan Pengirim -->
                        <td>{{ $investment->bank_asal }}</td> <!-- Menampilkan Bank Asal -->
                        <td>{{ $investment->bank_tujuan }}</td> <!-- Menampilkan Bank Tujuan -->
                        <td>{{ ucfirst($investment->status) }}</td>
                        <td>
                            @if ($investment->status == 'pending')
                                <!-- Form approval/rejection hanya tampil jika status pending -->
                                <form action="{{ route('investments.updateStatus', $investment->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-control">
                                        <option value="approved">Approve</option>
                                        <option value="rejected">Reject</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                </form>
                            @else
                                <span>{{ ucfirst($investment->status) }}</span> <!-- Menampilkan status approved/rejected -->
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
<script>
    function filterInvestments(status) {
        const rows = document.querySelectorAll('#investmentTable tbody tr');
        rows.forEach(row => {
            if (status === '' || row.dataset.status === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endsection
