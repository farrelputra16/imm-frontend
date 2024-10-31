@extends('layouts.app-people')
@section('title', 'Halaman IMM')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* CSS Umum */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .service-offers {
            margin-top: 80px;
            background-color: #e0e7ff;
            padding: 50px 0;
            text-align: center;
        }
        .service-offers h1 {
            margin-right:600px;
            color: #6C63FF;
            font-size: 2.5rem;
            font-weight: bold;
        }
        .service-offers h2 {
            color: #4a4a4a;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .service-offers p {
            color: #4a4a4a;
            font-size: 1rem;
        }
        .service-offers .btn-primary {
            background-color: #6c63ff;
            border: none;
        }
        .job-opportunities {
            padding: 50px 0;
            text-align: center;
        }
        .job-opportunities h2 {
            color: #4a4a4a;
            font-size: 2rem;
            font-weight: bold;
        }
        .job-card {
            border: 1px solid #e0e7ff;
            border-radius: 5px;
            padding: 20px;
            margin: 10px 0;
        }
        .job-card h5 {
            color: #4a4a4a;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .job-card p {
            color: #4a4a4a;
            font-size: 1rem;
        }
        .job-card a {
            color: #6c63ff;
            font-size: 1rem;
        }
        .collaboration {
            padding: 50px 0;
            text-align: center;
        }
        .collaboration h2 {
            color: #4a4a4a;
            font-size: 2rem;
            font-weight: bold;
        }
        .collaboration-card {
            border: 1px solid #e0e7ff;
            border-radius: 5px;
            padding: 20px;
            margin: 10px 0;
        }
        .collaboration-card h5 {
            color: #4a4a4a;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .collaboration-card p {
            color: #4a4a4a;
            font-size: 1rem;
        }
        .collaboration-card .btn-primary {
            background-color: #6c63ff;
            border: none;
        }body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .service-offers {
            background-color: #e0e7ff;
            padding: 50px 0;
            text-align: center;
        }
        .service-offers h1 {
            color: #4a4a4a;
            font-size: 2.5rem;
            font-weight: bold;
        }
        .service-offers h2 {
            color: #4a4a4a;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .service-offers p {
            color: #4a4a4a;
            font-size: 1rem;
        }
        .service-offers .btn-primary {
            background-color: #6c63ff;
            border: none;
        }
        .job-opportunities {
            padding: 50px 0;
            text-align: center;
        }
        .job-opportunities h2 {
            color: #4a4a4a;
            font-size: 2rem;
            font-weight: bold;
        }
        .job-card {
            border: 1px solid #e0e7ff;
            border-radius: 5px;
            padding: 20px;
            margin: 10px 0;
        }
        .job-card h5 {
            color: #4a4a4a;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .job-card p {
            color: #4a4a4a;
            font-size: 1rem;
        }
        .job-card a {
            color: #6c63ff;
            font-size: 1rem;
        }
        .collaboration {
            padding: 50px 0;
            text-align: center;
        }
        .collaboration h2 {
            color: #4a4a4a;
            font-size: 2rem;
            font-weight: bold;
        }
        .collaboration-card {
            border: 1px solid #e0e7ff;
            border-radius: 5px;
            padding: 20px;
            margin: 10px 0;
        }
        .collaboration-card h5 {
            color: #4a4a4a;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .collaboration-card p {
            color: #4a4a4a;
            font-size: 1rem;
        }
        .collaboration-card .btn-primary {
            background-color: #6c63ff;
            border: none;
        }
    </style>
@endsection
@section('content')
<body>
    <div class="service-offers">
     <div class="container">
      <h1>
       Service Offers
      </h1>
      <div class="row align-items-center">
       <div class="col-md-6">
        <h2>
         Web Development
        </h2>
        <p>
         Building custom websites with high performance and responsive designs that captivate your audience.
        </p>
        <a class="btn btn-primary" href="#">
         View Details
        </a>
       </div>
       <div class="col-md-6">
        <img alt="Illustration of a person working on a computer" class="img-fluid" height="300" src="images/peoplepage/gambar1.png" width="500"/>
       </div>
      </div>
     </div>
    </div>
    <div class="job-opportunities">
     <div class="container">
      <h2>
       Job Opportunities
      </h2>
      <div class="row">
       <div class="col-md-4">
        <div class="job-card">
         <h5>
          Graphic Designer
         </h5>
         <p>
          Freelance
         </p>
         <p>
          Looking for a creative graphic designer to help design marketing materials and web graphics.
         </p>
         <a href="#">
          View Details
         </a>
         |
         <a href="#">
          Contact Us
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="job-card">
         <h5>
          Web Development
         </h5>
         <p>
          Freelance
         </p>
         <p>
          Looking for a creative graphic designer to help design marketing materials and web graphics.
         </p>
         <a href="#">
          View Details
         </a>
         |
         <a href="#">
          Contact Us
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="job-card">
         <h5>
          Content Writer
         </h5>
         <p>
          Part Time
         </p>
         <p>
          Looking for a creative graphic designer to help design marketing materials and web graphics.
         </p>
         <a href="#">
          View Details
         </a>
         |
         <a href="#">
          Contact Us
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="job-card">
         <h5>
          Marketing Specialist
         </h5>
         <p>
          Contract
         </p>
         <p>
          Looking for a creative graphic designer to help design marketing materials and web graphics.
         </p>
         <a href="#">
          View Details
         </a>
         |
         <a href="#">
          Contact Us
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="job-card">
         <h5>
          UX Researcher
         </h5>
         <p>
          Freelance
         </p>
         <p>
          Looking for a creative graphic designer to help design marketing materials and web graphics.
         </p>
         <a href="#">
          View Details
         </a>
         |
         <a href="#">
          Contact Us
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="job-card">
         <h5>
          Graphic Designer
         </h5>
         <p>
          Freelance
         </p>
         <p>
          Looking for a creative graphic designer to help design marketing materials and web graphics.
         </p>
         <a href="#">
          View Details
         </a>
         |
         <a href="#">
          Contact Us
         </a>
        </div>
       </div>
      </div>
     </div>
    </div>
    <div class="collaboration">
     <div class="container">
      <h2>
       Collaboration
      </h2>
      <div class="row">
       <div class="col-md-4">
        <div class="collaboration-card">
         <img alt="Tech Startup Partnership" class="img-fluid" height="300" src="https://storage.googleapis.com/a1aa/image/MksGOfa2XoxjDy91xmdf8ywADg6M1ND3O10yg7Frt3tm7LsTA.jpg" width="500"/>
         <h5>
          Tech Startup Partnership
         </h5>
         <p>
          Looking for a technology partner to co-develop an AI-powered analytics tool for e-commerce businesses.
         </p>
         <a class="btn btn-primary" href="#">
          Collaborate
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="collaboration-card">
         <img alt="Marketing Agency Collaboration" class="img-fluid" height="300" src="https://storage.googleapis.com/a1aa/image/5HYXpy8LKrbfZ6zNBYGl6ynZWWY081EL8mVT3GOuJeKh7LsTA.jpg" width="500"/>
         <h5>
          Marketing Agency Collaboration
         </h5>
         <p>
          Looking for a technology partner to co-develop an AI-powered analytics tool for e-commerce businesses.
         </p>
         <a class="btn btn-primary" href="#">
          Collaborate
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="collaboration-card">
         <img alt="App Development Collaboration" class="img-fluid" height="300" src="https://storage.googleapis.com/a1aa/image/9QQuzLsN3ewCRiYAdwzmHVgGFgzPnQ74glbbXSAjrYfl7LsTA.jpg" width="500"/>
         <h5>
          App Development Collaboration
         </h5>
         <p>
          Looking for a technology partner to co-develop an AI-powered analytics tool for e-commerce businesses.
         </p>
         <a class="btn btn-primary" href="#">
          Collaborate
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="collaboration-card">
         <img alt="Creative Design Collaboration" class="img-fluid" height="300" src="https://storage.googleapis.com/a1aa/image/IVylgQ6veoweJU5VnfE7HytYUpQkIdO7leP1BhvIfl6VcfC7E.jpg" width="500"/>
         <h5>
          Creative Design Collaboration
         </h5>
         <p>
          Looking for a technology partner to co-develop an AI-powered analytics tool for e-commerce businesses.
         </p>
         <a class="btn btn-primary" href="#">
          Collaborate
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="collaboration-card">
         <img alt="Blockchain Research Partnership" class="img-fluid" height="300" src="https://storage.googleapis.com/a1aa/image/q6qxKEfxFiRyOSXzvkXmBYy9c7vZgTeRVE1v36g5zCoj7LsTA.jpg" width="500"/>
         <h5>
          Blockchain Research Partnership
         </h5>
         <p>
          Looking for a technology partner to co-develop an AI-powered analytics tool for e-commerce businesses.
         </p>
         <a class="btn btn-primary" href="#">
          Collaborate
         </a>
        </div>
       </div>
       <div class="col-md-4">
        <div class="collaboration-card">
         <img alt="Tech Startup Partnership" class="img-fluid" height="300" src="https://storage.googleapis.com/a1aa/image/MksGOfa2XoxjDy91xmdf8ywADg6M1ND3O10yg7Frt3tm7LsTA.jpg" width="500"/>
         <h5>
          Tech Startup Partnership
         </h5>
         <p>
          Looking for a technology partner to co-develop an AI-powered analytics tool for e-commerce businesses.
         </p>
         <a class="btn btn-primary" href="#">
          Collaborate
         </a>
        </div>
       </div>
      </div>
     </div>
    </div>
</body>
@endsection

