@extends('layouts.app-landingpage')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<style>
   /* Mengatur font family untuk seluruh halaman */
   body {
        font-family: 'Poppins', sans-serif; /* Menggunakan Inter untuk isi/content */
    }

    /* Mengatur font family untuk heading */
    h1, h2, h3, h4 {
        font-family: 'Poppins', sans-serif; /* Menggunakan Work Sans untuk heading */
    }

    /* Mengatur font family untuk sub-heading dan body */
    .sub-heading-1, .sub-heading-2, .body-1, .body-2 {
        font-family: 'Poppins', sans-serif; /* Set font to Poppins */
    }

    .profile-header {
        color: #3F3F46;
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
      display: flex; /* Menggunakan flexbox untuk layout */
      flex-direction: row; /* Menata item secara horizontal */
      align-items: flex-start; /* Mengatur alignment item ke atas */
      justify-content: flex-start; /* Mengatur semua item ke kiri */
      margin-top: 40px;
   }

   .separator {
      align-self: center; /* Menjaga pemisah di tengah vertikal */
      margin-left: 24px;
      margin-right: 24px;
      font-size: 24px; /* Mengatur ukuran font untuk pemisah */
      opacity: 0.2; /* Mengatur opasitas pemisah */
   }

   .align-items-start {
      align-items: flex-start; /* Mengatur alignment item ke atas */
   }

   .breadcrumb {
      background-color: white;
      padding: 0;
   }
   .breadcrumb-item + .breadcrumb-item::before {
      content: ">";
      margin-right: 14px;
      color: #9CA3AF;
   }

</style>

<div class="container">
   <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
          <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
              <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
          </li>
          <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
              <a href="{{ route('investors.index') }}" style="text-decoration: none; color: #212B36;">Find Investor</a>
          </li>
          <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px; color: #5A5A5A;">
            <a href="{{ route('investors.index') }}" style="text-decoration: none; color: #212B36;">Investor Profile</a>
          </li>
      </ol>
  </nav>

   <div class="profile-header"><h1>Investor Profile</h1></div>

   <div class="profile-info d-flex align-items-center">
      <img src="" alt="Profile picture of the investor" width="100" height="100" class="rounded-circle me-3">
      <h2>{{ $investor->user->nama_depan }} {{ $investor->user->nama_belakang }}</h2>
   <div class="profile-info d-flex align-items-center" style="gap:20px;">
      <img src="{{ !empty($investor->image) ? asset($investor->image) : asset('images/logo-maxy.png') }}" alt="Profile picture of the investor" width="100" height="100" class="rounded-circle me-3">
      <h3 style="color: #3F3F46">{{ $investor->user->nama_depan }} {{ $investor->user->nama_belakang }}</h3>
   </div>

   <!-- Profile details with thin line separator -->
   <div class="profile-details align-items-start">
      <div style="margin-bottom: 0; padding: 0;">
          <div class="body-1">Company</div>
          <div><h4>{{ $investor->org_name }}</h4></div>
      </div>
      <div class="separator">|</div>
      <div style="margin-bottom: 0; padding: 0;">
          <div class="body-1">Previous Investment</div>
          <div><h4>{{ $investor->number_of_investments }} Investments</h4></div>
      </div>
  </div>

   <div style="margin: 0px;">
      <hr style="margin-bottom: 32px; margin-top: 0px; border-top: 1px solid #000000; opacity: 0.2;">
  </div>
   <!-- Table container with thin line at the top -->

   <div class="profile-header">Previous Investment</div>
   <div class="table-responsive" style="max-width: 100%; width: 100%;">
      <table class="table table-hover table-strip mt-3" style="margin-bottom: 0px;">
          <thead class="sub-heading-2">
              <tr>
                  <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle; border-bottom: none;">No</th>
                  <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: middle; border-bottom: none;">Company</th>
                  <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: middle; border-bottom: none;">Bussines Model</th>
                  <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: middle; border-bottom: none;">Investment Stage</th>
                  <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: middle; border-bottom: none;">Investment Amount</th>
                  <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top; text-align: middle; border-bottom: none;">Year</th>
              </tr>
          </thead>
          <tbody>
               @if($investments->isEmpty())
                  <tr>
                     <td colspan="7" style="text-align: center; vertical-align: middle; border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                           <strong>Tidak ada data yang tersedia.</strong>
                     </td>
                  </tr>
               @else
                  @foreach ($investments as $investment)
                     <tr>
                           <td style="vertical-align: middle; border-left: 1px solid #ddd;">{{ $loop->iteration + ($investments->currentPage() - 1) * $investments->perPage() }}</td>
                           <td style="vertical-align: middle;">
                              <div style="display: flex; align-items: center;">
                                 <div style="margin-right: 2px;">
                                       <img src="{{ !empty($investment->company->image) ? asset($investment->company->image) : asset('images/logo-default.png') }}" alt="" width="30" height="30" style="border-radius: 8px; object-fit: cover;">
                                 </div>
                                 <div style="flex-grow: 1; margin-left: 0px; margin-right: 10px; width: 100px; word-wrap: break-word; word-break: break-word; white-space: normal;"
                                       @if (strlen($investment->company->nama) > 10)
                                          title="{{ $investment->company->nama }}"
                                          style="cursor: pointer;"
                                       @endif
                                 >
                                       <span class="body-2">{{ $investment->company->nama }}</span>
                                 </div>
                              </div>
                           </td>
                           <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $investment->company->business_model }}</td>
                           <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $investment->investor->investment_stage }}</td>
                           <td style="vertical-align: middle; text-align: center;" class="body-2">${{ number_format($investment->amount, 2) }}</td>
                           <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $investment->investment_date->format('Y') }}</td>
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
       <form method="GET" action="{{ route('investors.show', ['id' => $investor->id]) }}" class="mb-0">
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
                   <span>Total {{ $investments->firstItem() }} - {{ $investments->lastItem() }} of {{ $investments->total() }}</span>
               </div>
           </div>
       </form>
         <div style="margin-top: 10px;">
            {{ $investments->appends(request()->query())->links('pagination::bootstrap-4') }}
         </div>
   </div>
</div>
@endsection
