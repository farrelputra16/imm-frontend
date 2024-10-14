@extends('layouts.app-investors')
@section('title', 'Halaman IMM')

@section('css')
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<style>
 body {
          font-family: Arial, sans-serif;
      }
      .profile-card {
          margin-top: 150px;
          background-color: #e0e7ff;
          border-radius: 15px;
          padding: 70px;
          display: flex;
          align-items: center;
          margin-bottom: 20px;
          position: relative; /* Menggunakan posisi relative untuk memastikan gambar dapat diposisikan absolut di dalamnya */
      }
      .profile-card img {
          border-radius: 50%;
          width: 120px;
          height: 120px;
          margin-right: 20px;
      }
      .profile-card .name {
          font-size: 24px;
          font-weight: bold;
          color: #6256CA;
      }
      .profile-card .role {
          font-size: 16px;
          color: #6256CA;
      }
      .profile-card .right-image {
          position: absolute;
          right: -18px;
          top: 0;
          height: 100%;
          border-radius: 0 15px 15px 0; /* Mengikuti bentuk dari card */
          overflow: hidden; /* Pastikan gambar tidak keluar dari batas card */
      }
      .profile-card .right-image img {
          height: 100%; /* Mengatur tinggi gambar sesuai dengan card */
          width: auto; /* Biarkan lebar gambar menyesuaikan secara proporsional */
          object-fit: cover; /* Agar gambar memenuhi area */
          border-radius: 0 15px 15px 0; /* Mengikuti border dari card */
      }
      .stats-card {
          background-color: #6c63ff;
          color: white;
          border-radius: 10px;
          padding: 20px;
          text-align: center;
          margin-bottom: 20px;
      }
      .stats-card h3 {
          font-size: 24px;
          margin-bottom: 10px;
      }
      .stats-card p {
          font-size: 16px;
      }
      .chart-card {
          background-color: #2d2d6d;
          border-radius: 10px;
          padding: 20px;
          text-align: center;
          color: white;
          margin-bottom: 20px;
      }
      .chart-card img {
          width: 100%;
          border-radius: 10px;
      }
      .table-card {
          background-color: white;
          border-radius: 10px;
          padding: 20px;
          margin-bottom: 20px;
      }
      .table-card table {
          width: 100%;
      }
      .table-card table th, .table-card table td {
          padding: 10px;
          text-align: left;
      }
      .table-card table th {
          background-color: #f8f8f8;
      }
      .table-card .show-all {
          text-align: center;
          margin-top: 10px;
      }
      .table-card .show-all a {
          color: #6c63ff;
          text-decoration: none;
      }
</style>
</head>
<body>
<div class="container mt-4">
 <div class="profile-card d-flex">
  <img alt="Profile picture of Zayne Carter" height="80" src="https://storage.googleapis.com/a1aa/image/uubHGgBRAe0OU6bOwtK2IDIa4Eh6nIfeLj7bD3S2ogfQPVaOB.jpg" width="80"/>
  <div>
   <div class="name">
    Zayne Carter
   </div>
   <div class="role">
    Investor
   </div>
  </div>
  <!-- Gambar di sebelah kanan -->
  <div class="right-image">
      <img src="images/landingpage/investorpage.jpeg" alt="Gambar profil background">
  </div>
 </div>
 <div class="row">
  <div class="col-md-4">
   <div class="stats-card">
    <h3>
     312
    </h3>
    <p>
     Projects Funded
    </p>
   </div>
  </div>
  <div class="col-md-4">
   <div class="stats-card">
    <h3>
     50
    </h3>
    <p>
     Companies Backed
    </p>
   </div>
  </div>
  <div class="col-md-4">
   <div class="stats-card">
    <h3>
     $20M+
    </h3>
    <p>
     Total Invested
    </p>
   </div>
  </div>
 </div>
 <div class="row">
  <div class="col-md-6">
   <div class="chart-card">
    <img alt="Chart showing investment data from 2015 to 2024" height="300" src="https://storage.googleapis.com/a1aa/image/4zKinixufGy3T6VFoojIBtPHQJ7AVoncd0hj6gxof4TyTlmTA.jpg" width="500"/>
   </div>
  </div>
  <div class="col-md-6">
   <div class="chart-card">
    <img alt="Chart showing investment data from 2015 to 2024" height="300" src="https://storage.googleapis.com/a1aa/image/4zKinixufGy3T6VFoojIBtPHQJ7AVoncd0hj6gxof4TyTlmTA.jpg" width="500"/>
   </div>
  </div>
 </div>
 <div class="row">
  <div class="col-md-6">
   <div class="table-card">
    <h5>
     Recent Transaction
    </h5>
    <table class="table">
     <thead>
      <tr>
       <th>
        Date
       </th>
       <th>
        Company Name
       </th>
       <th>
        Amount
       </th>
      </tr>
     </thead>
     <tbody>
      <tr>
       <td>
        11/10/2024
       </td>
       <td>
        Globex Corporation INV-24389
       </td>
       <td>
        $25,000
       </td>
      </tr>
      <tr>
       <td>
        11/10/2024
       </td>
       <td>
        Initech INV-24732
       </td>
       <td>
        $125,000
       </td>
      </tr>
      <tr>
       <td>
        11/10/2024
       </td>
       <td>
        Bluth Company INV-84732
       </td>
       <td>
        $245,000
       </td>
      </tr>
      <tr>
       <td>
        11/10/2024
       </td>
       <td>
        Hooli INV-79820
       </td>
       <td>
        $2,125,000
       </td>
      </tr>
      <tr>
       <td>
        11/10/2024
       </td>
       <td>
        Vehement Capital Partners
       </td>
       <td>
        $200,000
       </td>
      </tr>
      <tr>
       <td>
        11/10/2024
       </td>
       <td>
        Massive Dynamic INV-90874
       </td>
       <td>
        $1,345,678
       </td>
      </tr>
      <tr>
       <td>
        11/10/2024
       </td>
       <td>
        Salaries
       </td>
       <td>
        $1,345,678
       </td>
      </tr>
      <tr>
       <td>
        11/10/2024
       </td>
       <td>
        DOGE Yearly Return Invest.
       </td>
       <td>
        $3,000,000
       </td>
      </tr>
     </tbody>
    </table>
    <div class="show-all">
     <a href="#">
      SHOW ALL FUNDING ROUNDS &gt;
     </a>
    </div>
   </div>
  </div>
  <div class="col-md-6">
   <div class="table-card">
    <h5>
     Invested Company List
    </h5>
    <table class="table">
     <thead>
      <tr>
       <th>
        Company Name
       </th>
       <th>
        Current Status
       </th>
       <th>
        Project Reports
       </th>
      </tr>
     </thead>
     <tbody>
      <tr>
       <td>
        Tesla Motors
       </td>
       <td>
        Growth
       </td>
       <td>
        <a href="#">
         View Details
        </a>
       </td>
      </tr>
      <tr>
       <td>
        Adidas
       </td>
       <td>
        Stable
       </td>
       <td>
        <a href="#">
         View Details
        </a>
       </td>
      </tr>
      <tr>
       <td>
        Tesla Motors
       </td>
       <td>
        Stable
       </td>
       <td>
        <a href="#">
         View Details
        </a>
       </td>
      </tr>
      <tr>
       <td>
        Apple Inc.
       </td>
       <td>
        Stable
       </td>
       <td>
        <a href="#">
         View Details
        </a>
       </td>
      </tr>
      <tr>
       <td>
        Sberbank Russia
       </td>
       <td>
        Decline
       </td>
       <td>
        <a href="#">
         View Details
        </a>
       </td>
      </tr>
      <tr>
       <td>
        Microsoft
       </td>
       <td>
        Growth
       </td>
       <td>
        <a href="#">
         View Details
        </a>
       </td>
      </tr>
      <tr>
       <td>
        Sberbank Russia
       </td>
       <td>
        Decline
       </td>
       <td>
        <a href="#">
         View Details
        </a>
       </td>
      </tr>
      <tr>
       <td>
        Apple Inc.
       </td>
       <td>
        Decline
       </td>
       <td>
        <a href="#">
         View Details
        </a>
       </td>
      </tr>
     </tbody>
    </table>
    <div class="show-all">
     <a href="#">
      SHOW ALL FUNDING ROUNDS &gt;
     </a>
    </div>
   </div>
  </div>
 </div>
</div>
</body>
@endsection
