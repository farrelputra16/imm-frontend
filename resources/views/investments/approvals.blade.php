@extends('layouts.app-hubsubmission')

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
        <table class="table">
            <thead>
                <tr>
                    <th>Investor</th>
                    <th>Project</th>
                    <th>Amount</th>
                    <th>Investment Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($investments as $investment)
                    <tr>
                        <td>{{ $investment->investor->org_name }}</td>
                        <td>{{ $investment->project->nama }}</td>
                        <td>{{ $investment->amount }}</td>
                        <td>{{ $investment->investment_date }}</td>
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
