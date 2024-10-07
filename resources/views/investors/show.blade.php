@extends('layouts.app-landingpage')

@section('content')
<style>
    .profile-header {
        color: #6256CA;
        font-weight: bold;
        font-size: 2.5rem;
    }

    .custom-table-header {
        background-color: #6256CA;
        color: white;
    }

    .profile-header, h1 {
        color: #6256CA;
        font-weight: bold;
        font-size: 2.5rem;
        margin-bottom: 30px;
    }

    /* Thin line between Company and Previous Investment */
    .profile-details {
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    /* Thin line in the table container */
    .table-container {
        border-top: 1px solid #e0e0e0;
        padding-top: 20px;
        margin-top: 20px;
    }

</style>

<div class="container mt-4">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="#">Home</a>
         </li>
         <li class="breadcrumb-item">
            <a href="#">Find Investor</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">Investor Profile</li>
      </ol>
   </nav>

   <div class="profile-header"><h1>Investor Profile</h1></div>

   <div class="profile-info d-flex align-items-center">
      <img src="https://storage.googleapis.com/a1aa/image/SiUTxb2vjMqcJFeesuJx30fvexVSxi9zWCPvrVgxpYKceYicC.jpg" alt="Profile picture of the investor" width="100" height="100" class="rounded-circle me-3">
      <h2>{{ $investor->user->nama_depan }} {{ $investor->user->nama_belakang }}</h2>
   </div>

   <!-- Profile details with thin line separator -->
   <div class="profile-details mt-4 row">
      <div class="col-md-6">
         <div class="fw-bold">Company</div>
         <div>{{ $investor->org_name }}</div>
      </div>
      <div class="col-md-6">
         <div class="fw-bold">Previous Investment</div>
         <div>{{ $investor->number_of_investments }} Investments</div>
      </div>
   </div>

   <!-- Table container with thin line at the top -->
   <div class="table-container mt-5">
    <div class="profile-header">Previous Investment</div>
    <table class="table mt-3">
        <thead class="custom-table-header">
            <tr>
                <th>No</th>
                <th>Company</th>
                <th>Industry</th>
                <th>Investment Stage</th>
                <th>Investment Amount</th>
                <th>Year</th>
            </tr>
        </thead>
        
       <tbody>
          @foreach ($investor->investments as $investment)
          <tr>
             <td>{{ $loop->iteration }}</td>
             <td>{{ $investment->company->nama }}</td> <!-- Nama perusahaan -->
             <td>{{ $investment->company->tipe }}</td> <!-- Industri perusahaan -->
             <td>{{ $investment->investor->investment_stage }}</td> <!-- Tahap investasi -->
             <td>${{ number_format($investment->amount, 2) }}</td> <!-- Jumlah investasi -->
             <td>{{ $investment->investment_date->format('Y') }}</td> <!-- Tahun investasi -->
          </tr>
          @endforeach
       </tbody>
    </table>

      <div class="table-footer d-flex justify-content-between align-items-center">
         <div>
            Row per page
            <select>
               <option>10</option>
               <option>20</option>
               <option>30</option>
            </select>
         </div>
         <div>Total 1 - 10 of 200</div>
      </div>
   </div>
</div>
@endsection
