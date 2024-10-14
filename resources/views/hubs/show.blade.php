@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body {
            font-family: Arial, sans-serif;
        }
        .breadcrumb {
            background-color: white;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: '>';
        }
        .header-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #6c757d;
            text-align:left;
        }
        .header-subtitle {
            font-size: 2.5rem;
            font-weight: bold;
            color: #6f42c1;
            text-align:left;
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #d4edda;
            font-weight: bold;
            text-align: center;
        }
        .btn-primary {
            background-color: #6f42c1;
            border: none;
        }
        .btn-primary:hover {
            background-color: #5a32a3;
        }
  </style>
 </head>
 <body>
  <div class="container mt-4">
   <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
     <li class="breadcrumb-item">
      <a href="#">
       Home
      </a>
     </li>
     <li class="breadcrumb-item">
      <a href="#">
       Innovation Hub
      </a>
     </li>
     <li aria-current="page" class="breadcrumb-item active">
      Innovation Hub Profile
     </li>
    </ol>
   </nav>
   <div class="text-center">
    <h1 class="header-title">
     Innovation
    </h1>
    <h1 class="header-subtitle">
     Hub Profile
    </h1>
   </div>
   <div class="card my-4">
    <div class="card-body d-flex align-items-center">
     <img alt="Logo of Lion Bird with text 'Lion Bird Strong Hold'" class="me-3" height="100" src="https://storage.googleapis.com/a1aa/image/svmMvNNpWA7kKFOeJrqN0f1qCFXmF6yZGA92DQARFr6eRoInA.jpg" width="100"/>
     <div>
      <h5 class="card-title">
       {{ $hub->name }}
      </h5>
      <p class="card-text">
       {{ $hub->description }}
      </p>
     </div>
    </div>
   </div>
   <div class="row text-center">
    <div class="col-md-4 mb-4">
     <div class="card">
      <div class="card-header">
       Our Facilities
      </div>
      <div class="card-body">
       <ul class="list-unstyled">
        <li>
         • Coworking Space
        </li>
        <li>
         • Private Offices
        </li>
        <li>
         • Meeting Rooms
        </li>
        <li>
         • Event Space
        </li>
        <li>
         • Maker Space
        </li>
        <li>
         • Lounge &amp; Networking Area
        </li>
        <li>
         • Cafeteria
        </li>
       </ul>
      </div>
     </div>
    </div>
    <div class="col-md-4 mb-4">
     <div class="card">
      <div class="card-header">
       Mentoring Programs
      </div>
      <div class="card-body">
       <ul class="list-unstyled">
        <li>
         • One-on-One Mentorship
        </li>
        <li>
         • Group Mentoring Sessions
        </li>
        <li>
         • Workshops &amp; Seminars
        </li>
        <li>
         • Office Hours with Experts
        </li>
        <li>
         • Access to Investor Networks
        </li>
       </ul>
      </div>
     </div>
    </div>
    <div class="col-md-4 mb-4">
     <div class="card">
      <div class="card-header">
       Alumni StartUps
      </div>
      <div class="card-body">
       <ul class="list-unstyled">
        <li>
         • TechNova
        </li>
        <li>
         • GreenFuture
        </li>
        <li>
         • EduLearn
        </li>
        <li>
         • FinTechID
        </li>
        <li>
         • AgroTech
        </li>
       </ul>
      </div>
     </div>
    </div>
   </div>
   <div class="text-center mb-4">
    <button class="btn btn-primary">
     Event submission
    </button>
   </div>
  </div>
 </body>
@endsection
