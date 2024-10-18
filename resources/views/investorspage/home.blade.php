@extends('layouts.app-investors')
@section('title', 'Halaman IMM')

@section('css')
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
<style>
    body {
        font-family: Arial, sans-serif;
    }
    /* Existing styles for the page */
    .profile-card {
        margin-top: 150px;
        background-color: #e0e7ff;
        border-radius: 15px;
        padding: 70px;
        display: flex;
        align-items: center;
        margin-bottom: 70px;
        position: relative;
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
        border-radius: 0 15px 15px 0;
        overflow: hidden;
    }
    .profile-card .right-image img {
        height: 100%;
        width: auto;
        object-fit: cover;
        border-radius: 0 15px 15px 0;
    }
    .stats-card {
        background-color: #2d2d6d;
        color: white;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        margin-bottom: 70px;
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
        margin-bottom: 90px;
    }
    .chart-card img {
        width: 100%;
        border-radius: 10px;
    }
    /* New styles for tables */
    .investor-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .investor-card-header {
        background-color: #fff;
        border-bottom: 5px;
        font-size: 1.3rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 8px;
    }
    .investor-table {
        margin-bottom: 0;
    }
    .investor-table th, .investor-table td {
        vertical-align: middle;
    }
    .investor-table th {
        border-top: none;
        font-weight: bold;
    }
    .investor-table td {
        border-top: none;
    }
    .investor-btn-link {
        color: #007bff;
        text-decoration: none;
    }
    .investor-btn-link:hover {
        text-decoration: underline;
    }
    .investor-show-all {
        text-align: center;
        padding: 10px 0;
        font-weight: bold;
    }
    .investor-show-all a {
        color: #007bff;
        text-decoration: none;
    }
    .investor-show-all a:hover {
        text-decoration: underline;
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
  <div class="right-image">
      <img src="images/landingpage/investorpage.jpeg" alt="Gambar profil background">
  </div>
 </div>

 <div class="row">
  <div class="col-md-4">
   <div class="stats-card">
    <h3>312</h3>
    <p>Projects Funded</p>
   </div>
  </div>
  <div class="col-md-4">
   <div class="stats-card">
    <h3>50</h3>
    <p>Companies Backed</p>
   </div>
  </div>
  <div class="col-md-4">
   <div class="stats-card">
    <h3>$20M+</h3>
    <p>Total Invested</p>
   </div>
  </div>
 </div>

 <div class="row">
    <div class="col-md-6">
        <div class="chart-card">
            <h3>Chart 1</h3>
            <div>{!! $chart1->container() !!}</div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            {!! $chart1->script() !!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="chart-card">
            <h3>Chart 2</h3>
            <div>{!! $chart2->container() !!}</div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            {!! $chart2->script() !!}
        </div>
    </div>
 </div>

 <div class="row">
    <div class="col-md-6">
     <div class="investor-card">
      <div class="investor-card-header">Recent Transaction</div>
      <div class="card-body">
       <table class="investor-table table">
        <thead>
         <tr>
          <th>Date</th>
          <th>Company Name</th>
          <th>Amount</th>
         </tr>
        </thead>
        <tbody>
            <tr>
                <td>11/10/2024</td>
                <td>
                    <img alt="Globex Corporation logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/65IqtnN0FfzhVKIzIOHbf7V2P3kVIskNz63qecUc4iTANwPnA.jpg" width="30"/>
                    Globex Corporation INV-24398
                </td>
                <td>$25,000</td>
            </tr>
            <tr>
                <td>11/10/2024</td>
                <td>
                    <img alt="Initech logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/JGqPlD573EKYHJvAiGFUQaKu7RKeu7pMsqzD0VL1dqevG4nTA.jpg" width="30"/>
                    Initech INV-24792
                </td>
                <td>$125,000</td>
            </tr>
            <tr>
                <td>11/10/2024</td>
                <td>
                    <img alt="Bluth Company logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/WqnKYKUxBM7CPpUxX5FI1VmMgeO66oZ8034aG1wpcgoYD8zJA.jpg" width="30"/>
                    Bluth Company INV-84732
                </td>
                <td>$245,000</td>
            </tr>
            <tr>
                <td>11/10/2024</td>
                <td>
                    <img alt="Hooli logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/DAUOmfHgg2TpEyjQof9frme9kPfmK6tzfYEH7zf3EX3sWD8zJA.jpg" width="30"/>
                    Hooli INV-79820
                </td>
                <td>$2,125,000</td>
            </tr>
            <tr>
                <td>11/10/2024</td>
                <td>
                    <img alt="Vehement Capital Partners logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/pE6Qx0TtpBoDEZyaY4AYup1feGWtsl29TZ9OgB9egSZGNwPnA.jpg" width="30"/>
                    Vehement Capital Partners
                </td>
                <td>$200,000</td>
            </tr>
            <tr>
                <td>11/10/2024</td>
                <td>
                    <img alt="Massive Dynamic logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/zd6T0Feq0DztFSfwL02ZJeeJHVWP6gIhKJOJKUKA107dagfcC.jpg" width="30"/>
                    Massive Dynamic INV-90874
                </td>
                <td>$1,345,678</td>
            </tr>
            <tr>
                <td>11/10/2024</td>
                <td>
                    <img alt="DOGE Yearly Return Invest. logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/SEcxfUWaQzVLYy47Wc1nZScV4naaX0aXb6667iUaoLDXD8zJA.jpg" width="30"/>
                    DOGE Yearly Return Invest.
                </td>
                <td>$3,000,000</td>
            </tr>
        </tbody>
       </table>
      </div>
      <div class="investor-show-all">
       <a href="#">SHOW ALL FUNDING ROUNDS &gt;</a>
      </div>
     </div>
    </div>

    <div class="col-md-6">
     <div class="investor-card">
      <div class="investor-card-header">Invested Company List</div>
      <div class="card-body">
       <table class="investor-table table">
        <thead>
         <tr>
          <th>Company Name</th>
          <th>Current Status</th>
          <th>Project Reports</th>
         </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <img alt="Tesla Motors logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/p8n1MWCT8lJEGRfrQl0wAWJ0DNM5wn97HDYfb4RKV4uhG4nTA.jpg" width="30"/>
                    Tesla Motors
                </td>
                <td>Growth</td>
                <td><a class="investor-btn-link" href="#">View Details</a></td>
            </tr>
            <tr>
                <td>
                    <img alt="Adidas logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/sOwJiEeM0fq0MUpZJAffJKdaSVYztVYeXDHCsPCbnMah0Af5E.jpg" width="30"/>
                    Adidas
                </td>
                <td>Stable</td>
                <td><a class="investor-btn-link" href="#">View Details</a></td>
            </tr>
            <tr>
                <td>
                    <img alt="Apple Inc. logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/qtjnbiicywJaINxKJMsue3Pd5EVqkS6H7gNHZCZ6A8EVD8zJA.jpg" width="30"/>
                    Apple Inc.
                </td>
                <td>Stable</td>
                <td><a class="investor-btn-link" href="#">View Details</a></td>
            </tr>
            <tr>
                <td>
                    <img alt="Sberbank Russia logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/QE5Nq58ScX7xMhHwdherq2gwSg6cp3nhbAySFVY1Z8kSD8zJA.jpg" width="30"/>
                    Sberbank Russia
                </td>
                <td>Decline</td>
                <td><a class="investor-btn-link" href="#">View Details</a></td>
            </tr>
            <tr>
                <td>
                    <img alt="Microsoft logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/YUzfhF2AVesk8EKQFROw6NVtn4oYUctGfIoIPDLJMnLWNwPnA.jpg" width="30"/>
                    Microsoft
                </td>
                <td>Growth</td>
                <td><a class="investor-btn-link" href="#">View Details</a></td>
            </tr>
            <tr>
                <td>
                    <img alt="Bluth Company logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/WqnKYKUxBM7CPpUxX5FI1VmMgeO66oZ8034aG1wpcgoYD8zJA.jpg" width="30"/>
                    Bluth Company
                </td>
                <td>Decline</td>
                <td><a class="investor-btn-link" href="#">View Details</a></td>
            </tr>
            <tr>
                <td>
                    <img alt="Vehement Capital Partners logo" class="me-2" height="30" src="https://storage.googleapis.com/a1aa/image/pE6Qx0TtpBoDEZyaY4AYup1feGWtsl29TZ9OgB9egSZGNwPnA.jpg" width="30"/>
                    Vehement Capital Partners
                </td>
                <td>Stable</td>
                <td><a class="investor-btn-link" href="#">View Details</a></td>
            </tr>
        </tbody>

       </table>
      </div>
      <div class="investor-show-all">
       <a href="#">SHOW ALL FUNDING ROUNDS &gt;</a>
      </div>
     </div>
    </div>
  </div>
</div>
</body>
@endsection
