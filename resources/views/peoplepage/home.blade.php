@extends('layouts.app-people')
@section('title', 'Halaman IMM')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f3ff;
            font-family: 'Arial', sans-serif;
        }
        .service-offers {
            margin-top:80px;
            background-color: #eae6ff;
            padding: 50px 0;
        }
        .service-offers-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-align: left;
        }
        .service-offers-text {
            color: #333;
            max-width: 50%;
        }
        .service-offers h1 {
            color: #5a4fcf;
            font-size: 2.5rem;
            font-weight: bold;
        }
        .service-offers h2 {
            color: #333;
            font-size: 3rem;
            font-weight: bold;
        }
        .service-offers p {
            color: #666;
            font-size: 1rem;
        }
        .service-offers .btn {
            background-color: #5a4fcf;
            color: #fff;
            border-radius: 25px;
            padding: 10px 20px;
        }
        .service-offers img {
            max-width: 100%;
            border-radius: 10px;
        }
        .collaboration, .upcoming-events {
            padding: 50px 0;
        }
        .collaboration h2, .upcoming-events h2 {
            color: #5a4fcf;
            font-size: 2rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-body h5 {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-body p {
            color: #666;
        }
        .card-body .btn {
            background-color: #5a4fcf;
            color: #fff;
            border-radius: 25px;
            padding: 5px 15px;
        }
        .upcoming-events .event-card {
            display: flex;
            margin-bottom: 20px;
        }
        .upcoming-events .event-card img {
            border-radius: 10px;
            width: 100%;
            height: auto;
        }
        .upcoming-events .event-card .event-details {
            padding: 20px;
        }
        .upcoming-events .event-card .event-details h5 {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .upcoming-events .event-card .event-details p {
            color: #666;
        }
    </style>
@endsection

@section('content')
<div class="service-offers">
    <div class="container">
        <div class="row service-offers-content">
            <div class="col-md-6 service-offers-text">
                <h1>Service Offers</h1>
                <h2>Web Development</h2>
                <p>Building custom websites with high performance and responsive designs that captivate your audience.</p>
                <button class="btn">View Details</button>
            </div>
            <div class="col-md-6">
                <img src="images/peoplepage/gambar1.png" alt="Service Offer Image">
            </div>
        </div>
    </div>
</div>

<div class="collaboration">
    <h2>Collaboration</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://storage.googleapis.com/a1aa/image/z8SOjsZDPsYCCBfPdLgied87uQbsRBCIxsDcnik3yrTw4fanA.jpg" class="card-img-top" alt="Tech Startup Partnership" height="400" width="600">
                    <div class="card-body">
                        <h5 class="card-title">Tech Startup Partnership</h5>
                        <p class="card-text">Looking for a technology partner to co-develop an AI-powered analytics tool for e-commerce businesses.</p>
                        <button class="btn">Collaborate</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://storage.googleapis.com/a1aa/image/P4RPhsOwqYoiKVyZGSiVWMaD82XgsagcpoPfWrMmWWkV8v2JA.jpg" class="card-img-top" alt="Marketing Agency Collaboration" height="400" width="600">
                    <div class="card-body">
                        <h5 class="card-title">Marketing Agency Collaboration</h5>
                        <p class="card-text">Partnering to create comprehensive marketing solutions for tech startups.</p>
                        <button class="btn">Collaborate</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://storage.googleapis.com/a1aa/image/bgDMkcIRMp6nBhfWqj8ot1f2eW3oFukpKrHpdush0Wmdxf1OB.jpg" class="card-img-top" alt="App Development Collaboration" height="400" width="600">
                    <div class="card-body">
                        <h5 class="card-title">App Development Collaboration</h5>
                        <p class="card-text">Co-developing innovative mobile applications for various business needs.</p>
                        <button class="btn">Collaborate</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="upcoming-events">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Upcoming Events</h2>
            <button class="btn">See All</button>
        </div>
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card event-card">
                    <img src="https://storage.googleapis.com/a1aa/image/fbT2Y7EkJt1DSao2pD7fsrUMWeM92zc1D41kNzOv8MrSxf1OB.jpg" alt="Eventchamps Conference" height="400" width="600">
                    <div class="event-details">
                        <h5>Eventchamps Conference</h5>
                        <p><i class="fas fa-calendar-alt"></i> 04 September 2024 <i class="fas fa-map-marker-alt"></i> Jakarta Selatan</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <button class="btn">View Details</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card event-card mb-4">
                    <img src="https://storage.googleapis.com/a1aa/image/9umlmk6uZWqDIxb1Nel9qo72lLGJV52QHe8ySycStyZy4fanA.jpg" alt="Towards a Sustainable Future" height="400" width="600">
                    <div class="event-details">
                        <h5>Towards a Sustainable Future</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="card event-card mb-4">
                    <img src="https://storage.googleapis.com/a1aa/image/9umlmk6uZWqDIxb1Nel9qo72lLGJV52QHe8ySycStyZy4fanA.jpg" alt="Towards a Sustainable Future" height="400" width="600">
                    <div class="event-details">
                        <h5>Towards a Sustainable Future</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <div class="card event-card mb-4">
                    <img src="https://storage.googleapis.com/a1aa/image/9umlmk6uZWqDIxb1Nel9qo72lLGJV52QHe8ySycStyZy4fanA.jpg" alt="Towards a Sustainable Future" height="400" width="600">
                    <div class="event-details">
                        <h5>Towards a Sustainable Future</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection
