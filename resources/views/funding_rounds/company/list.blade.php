@extends('layouts.app-imm')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<style>
/* Custom width for columns */
th:nth-child(1),
td:nth-child(1) {
    width: 20%; /* Checkbox column */
}

th:nth-child(2),
td:nth-child(2) {
    width: 10%; /* Organization Name */
}

th:nth-child(3),
td:nth-child(3) {
    width: 15%; /* Founded Date */
}

th:nth-child(4),
td:nth-child(4) {
    width: 15%; /* Last Funding Date */
}

th:nth-child(5),
td:nth-child(5) {
    width: 10%; /* Last Funding Type */
}

th:nth-child(6),
td:nth-child(6) {
    width: 10%; /* Employee */
}

th:nth-child(7),
td:nth-child(7) {
    width: 10%; /* Industries */
}

th:nth-child(8),
td:nth-child(8) {
    width: 15%; /* Description */
}

th:nth-child(9),
td:nth-child(9) {
    text-align: start;
    width: 10%; /* Job Departments */
}
</style>
<div class="container">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Funding Rounds</a>
            </li>
        </ol>
    </nav>

    <!-- Page Title -->
    <h2>Funding Rounds for {{ $company->nama }}</h2>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Container for Styling -->
    <div class="table-responsive" style="background-color: white; margin-top: 30px; max-width: 100%; width: 100%;">
        <table class="table table-hover table-strip investment-page-table">
            <thead class="sub-heading-2">
                <tr>
                    <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle; border-bottom: none;">Name</th>
                    <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Target</th>
                    <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Announced Date</th>
                    <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Money Raised</th>
                    <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: center; border-bottom: none;">Lead Investor</th>
                    <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top; text-align: center; border-bottom: none;">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($fundingRounds->isEmpty())
                    <tr>
                        <td colspan="6" style="text-align: center; vertical-align: middle; border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                            <strong>Tidak ada data yang tersedia.</strong>
                        </td>
                    </tr>
                @else
                    @foreach($fundingRounds as $round)
                        <tr>
                            <td style="vertical-align: middle; border-left: 1px solid #ddd;">{{ $round->name }}</td>
                            <td style="vertical-align: middle;">Rp {{ number_format($round->target, 0, ',', '.') }}</td>
                            <td style="vertical-align: middle;">{{ $round->announced_date ? \Carbon\Carbon::parse($round->announced_date)->format('j M, Y') : 'N/A' }}</td>
                            <td style="vertical-align: middle;">Rp {{ number_format($round->money_raised, 0, ',', '.') }}</td>
                            <td style="vertical-align: middle;">{{ $round->leadInvestor->org_name ?? 'Not selected' }}</td>
                            <td style="vertical-align: middle; border-right: 1px solid #ddd;">
                                <a href="{{ route('company.funding_rounds.detail', $round->id) }}" class="btn btn-primary">View & Edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
     <!-- Footer sebagai bagian dari tabel -->
     <div class="d-flex justify-content-between align-items-center mb-3 align-self-center"
     style="padding: 20px;
         background-color: #ffffff;
         border-bottom: 1px solid #ddd;
         border-left: 1px solid #ddd;
         border-right: 1px solid #ddd;
         border-top: 1px solid #ddd;
         margin-top:0px;
         border-end-end-radius: 20px;
         border-end-start-radius: 20px;
         height: 60px;
         max-width: 100%;
         ">
         <form method="GET" action="{{ route('company.funding_rounds.list') }}" class="mb-0">
             <div class="d-flex align-items-center">
                 <label for="rowsPerPage" class="me-2">Rows per page:</label>
                 <select name="rows"
                         id="rowsPerPage"
                         class="form-select me-2"
                         onchange="this.form.submit()"
                         style="width: 50%px; margin-left: 5px; margin-right: 5px;">
                     <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                     <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                     <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                 </select>
                 <div>
                     <span>Total {{ $fundingRounds->firstItem() }} - {{ $fundingRounds->lastItem() }} of {{ $fundingRounds->total() }}</span>
                 </div>
             </div>
         </form>
         <div style="margin-top: 10px;">
             {{ $fundingRounds->appends(request()->query())->links('pagination::bootstrap-4') }}
         </div>
     </div>

    <!-- Button for New Funding Round -->
    <div class="mt-4">
        <a href="{{ route('company.funding_rounds.create') }}" class="btn btn-primary">Create New Funding Round</a>
    </div>
</div>
@endsection
