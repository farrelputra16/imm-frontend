@extends('layouts.app-landingpage')

@section('css')
<style>
    /* Section Hero Styling */
    .section-hero {
        min-height: 100vh;
        display: flex;
        align-items: center;
        padding-top: 80px;
        margin-bottom: 100px; /* Space between hero and next section */
    }

    /* General container styling with margin for spacing */
    .container {
        margin-top: 40px; /* Add margin-top for spacing between sections */
    }

    /* Heading Text Styling */
    .section-hero h1 {
        font-size: 5.5rem;
        line-height: 1.2;
        font-weight: bold;
        color: #333;
    }

    /* Paragraph Text Styling */
    .section-hero p {
        font-size: 3.2rem;
        color: #6c757d;
        margin-bottom: 30px;
    }

    /* Button Styling */
    .section-hero .btn-success {
        background-color: #86D293;
        border: none;
        padding: 12px 30px;
        font-size: 3rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        color: black;
    }

    .section-hero .btn-success i {
        margin-right: 8px;
        color: #FFC107;
    }

    .section-hero .btn-success:hover {
        background-color: #74b583;
        transform: scale(1.05);
    }

    /* Chair Image Styling */
    .chair-image {
        max-height: 1500px;
        width: auto;
    }

    /* Responsive Design for Section Hero */
    @media (max-width: 768px) {
        .section-hero {
            flex-direction: column;
            text-align: center;
            padding-top: 50px;
        }

        .section-hero h1 {
            font-size: 2.5rem;
        }

        .chair-image {
            max-height: 800px;
            margin-top: 20px;
        }
    }

    @media (max-width: 576px) {
        .section-hero h1 {
            font-size: 2rem;
        }

        .section-hero p {
            font-size: 1rem;
        }

        .section-hero .btn-success {
            padding: 10px 20px;
            font-size: 0.9rem;
        }

        .chair-image {
            max-height: 600px;
        }
    }

    /* Card section styling */
    .section-cards {
        padding: 60px 0;
        text-align: center;
        margin-top: 40px; /* Add margin-top for spacing */
    }

    .card-outer {
        border: 2px solid #e0e0e0;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
        min-height: 400px;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.3s ease;
    }

    .card-outer:hover {
        transform: translateY(-10px);
    }

    .card-inner {
        border-radius: 10px;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        width: 80%;
    }

    .card-inner img {
        max-width: 100%;
        height: auto;
    }

    .card-info {
        color: #5940CB;
        font-size: 1rem;
        margin-top: 15px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .section-cards {
            padding: 30px 0;
        }

        .card-outer {
            min-height: 350px;
        }

        .card-info {
            font-size: 0.9rem;
        }
    }

    /* Section 3 Styling */
    .section-title {
        padding: 60px 0;
        display: flex;
        align-items: center;
        margin-top: 60px; /* Add margin-top for spacing */
    }

    /* Title Text Styling */
    .section-title h1 {
        font-size: 3rem;
        font-weight: bold;
        color: #333;
        position: relative;
        line-height: 1.2;
        margin-bottom: 0;
    }

    /* Highlight for CRUNCHBASE */
    .section-title h1.crunchbase-text {
        color: #A0A0A0 !important;
    }

    .section-title h1.insights-text {
        color: #5940CB !important;
    }

    .section-title h1::before,
    .section-title h1 span::before {
        content: '';
        display: block;
        width: 100px;
        height: 3px;
        background-color: #5940CB;
        position: absolute;
        bottom: -10px;
    }

    .section3-image {
        max-width: 70%;
        height: auto;
    }

    @media (max-width: 768px) {
        .section-title h1 {
            font-size: 2.5rem;
            text-align: center;
        }

        .section3-image {
            max-width: 50%;
            margin: 0 auto;
            display: block;
        }
    }

    @media (max-width: 576px) {
        .section-title h1 {
            font-size: 2rem;
        }

        .section3-image {
            max-width: 80%;
        }
    }
    body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            text-align: center;
            margin: 20px 0;
        }
        .header h1 {
            font-size: 2.5rem;
            color: #6c757d;
        }
        .header h1 span {
            color: #6c63ff;
        }
        .header img {
            width: 100px;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #fff;
            border-bottom: none;
            font-weight: bold;
            font-size: 1.25rem;
        }
        .card-body {
            background-color: #fff;
        }
        .news-item {
            display: flex;
            margin-bottom: 20px;
        }
        .news-item img {
            width: 80px;
            height: 80px;
            margin-right: 20px;
            border-radius: 10px;
        }
        .news-item .news-content {
            flex: 1;
        }
        .news-item .news-content h5 {
            font-size: 1rem;
            font-weight: bold;
        }
        .news-item .news-content p {
            font-size: 0.875rem;
            color: #6c757d;
        }
        .news-item .news-content .date {
            font-size: 0.75rem;
            color: #adb5bd;
        }
        .btn-link {
            color: #6c63ff;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
        .stats-card {
            text-align: center;
            padding: 20px;
        }
        .stats-card h3 {
            font-size: 2rem;
            margin-bottom: 0;
        }
        .stats-card p {
            font-size: 0.875rem;
            color: #6c757d;
        }
        .promo-card {
            background-color: #6c63ff;
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
        }
        .promo-card h4 {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }
        .promo-card .btn {
            background-color: #fff;
            color: #6c63ff;
            font-weight: bold;
        }
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .list-group-item .save-btn {
            color: #6c63ff;
            cursor: pointer;
        }
        .list-group-item .save-btn:hover {
            text-decoration: underline;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table th {
            font-weight: bold;
        }
        .table td {
            font-size: 0.875rem;
        }
</style>
@endsection

@section('content')
<!-- Section Hero -->
<div class="container">
    <div class="row section-hero">
        <!-- Left Side: Text Content -->
        <div class="col-md-6">
            <h1>Make Better <br> Decisions, faster.</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Exceptetur sint occaecat cupidatat.</p>
            <a href="#" class="btn btn-success">
                <i class="fas fa-bolt"></i> SEE PLANS
            </a>
        </div>

        <!-- Right Side: Chair Image -->
        <div class="col-md-6 text-center">
            <img src="images/landingpage/chair.png" class="img-fluid chair-image" alt="Chair with icons">
        </div>
    </div>
</div>

<!-- Section with Cards -->
<div class="container section-cards">
    <div class="row">
        <!-- First Card -->
        <div class="col-md-4 mb-4">
            <div class="card-outer">
                <div class="card-inner">
                    <img src="images/landingpage/cardfix1.png" class="card-img-top" alt="Filters Image">
                </div>
            </div>
            <p class="card-info">Discover companies with search and AI-powered recommendations</p>
        </div>

        <!-- Second Card -->
        <div class="col-md-4 mb-4">
            <div class="card-outer">
                <div class="card-inner">
                    <img src="images/landingpage/cardfix2.png" class="card-img-top" alt="Growth Outlook Image">
                </div>
            </div>
            <p class="card-info">Stay informed with intelligent insights and real-time alerts</p>
        </div>

        <!-- Third Card -->
        <div class="col-md-4 mb-4">
            <div class="card-outer">
                <div class="card-inner">
                    <img src="images/landingpage/cardfix3.png" class="card-img-top" alt="Galax Image">
                </div>
            </div>
            <p class="card-info">Take action at the right time with personalized workflow tools</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            <a href="#" class="btn btn-success">
                <i class="fas fa-bolt"></i> SEE PLANS
            </a>
        </div>
    </div>
</div>
<div class="container">
    <div class="header">
     <h1>
      CRUNCHBASE
      <span>
       INSIGHTS &amp; ANALYSIS
      </span>
     </h1>
     <img alt="Crunchbase Insights &amp; Analysis logo" src="images/landingpage/section3.png"/>
    </div>
    <div class="row">
     <div class="col-md-8">
      <div class="card">
       <div class="card-header">
        Latest Insights and Analysis
       </div>
       <div class="card-body">
        <div class="news-item">
         <img alt="Insight image 1" src="https://placehold.co/80x80"/>
         <div class="news-content">
          <div class="date">
           September 18, 2024
          </div>
          <h5>
           Lorem ipsum dolor sit amet
          </h5>
          <p>
           Jane Cooper
          </p>
          <p>
           As AI technology advances, it's putting ever-increasing strain on existing data centers and associated power sources. To keep up, we'll need to build a lot more infrastructure.
          </p>
         </div>
        </div>
        <div class="news-item">
         <img alt="Insight image 2" src="https://placehold.co/80x80"/>
         <div class="news-content">
          <div class="date">
           September 18, 2024
          </div>
          <h5>
           Lorem ipsum dolor sit amet
          </h5>
          <p>
           Jane Cooper
          </p>
          <p>
           As AI technology advances, it's putting ever-increasing strain on existing data centers and associated power sources. To keep up, we'll need to build a lot more infrastructure.
          </p>
         </div>
        </div>
        <div class="news-item">
         <img alt="Insight image 3" src="https://placehold.co/80x80"/>
         <div class="news-content">
          <div class="date">
           September 18, 2024
          </div>
          <h5>
           Lorem ipsum dolor sit amet
          </h5>
          <p>
           Jane Cooper
          </p>
          <p>
           As AI technology advances, it's putting ever-increasing strain on existing data centers and associated power sources. To keep up, we'll need to build a lot more infrastructure.
          </p>
         </div>
        </div>
        <div class="news-item">
         <img alt="Insight image 4" src="https://placehold.co/80x80"/>
         <div class="news-content">
          <div class="date">
           September 18, 2024
          </div>
          <h5>
           Lorem ipsum dolor sit amet
          </h5>
          <p>
           Jane Cooper
          </p>
          <p>
           As AI technology advances, it's putting ever-increasing strain on existing data centers and associated power sources. To keep up, we'll need to build a lot more infrastructure.
          </p>
         </div>
        </div>
        <a class="btn-link" href="#">
         MORE CRUNCHBASE NEWS
        </a>
       </div>
      </div>
      <div class="card">
       <div class="card-header">
        Featured Funding Rounds
       </div>
       <div class="card-body">
        <table class="table">
         <thead>
          <tr>
           <th>
            Organization name
           </th>
           <th>
            Transaction name
           </th>
           <th>
            Lead investors
           </th>
          </tr>
         </thead>
         <tbody>
          <tr>
           <td>
            <img alt="Tesla Motors logo" src="https://placehold.co/30x30"/>
            Tesla Motors
           </td>
           <td>
            Globex Corporation INV-24398
           </td>
           <td>
            IT Business Process
           </td>
          </tr>
          <tr>
           <td>
            <img alt="Adidas logo" src="https://placehold.co/30x30"/>
            Adidas
           </td>
           <td>
            Initech INV-24792
           </td>
           <td>
            Technical Documentation
           </td>
          </tr>
          <tr>
           <td>
            <img alt="Tesla Motors logo" src="https://placehold.co/30x30"/>
            Tesla Motors
           </td>
           <td>
            Bluth Company INV-84732
           </td>
           <td>
            Requirements Assessment
           </td>
          </tr>
          <tr>
           <td>
            <img alt="Apple Inc. logo" src="https://placehold.co/30x30"/>
            Apple Inc.
           </td>
           <td>
            Hooli INV-79820
           </td>
           <td>
            Requirements Gathering
           </td>
          </tr>
          <tr>
           <td>
            <img alt="Sberbank Russia logo" src="https://placehold.co/30x30"/>
            Sberbank Russia
           </td>
           <td>
            Vehement Capital Partners INV-72462
           </td>
           <td>
            Analytics
           </td>
          </tr>
          <tr>
           <td>
            <img alt="Microsoft logo" src="https://placehold.co/30x30"/>
            Microsoft
           </td>
           <td>
            Massive Dynamic INV-90874
           </td>
           <td>
            Project Planning
           </td>
          </tr>
          <tr>
           <td>
            <img alt="Sberbank Russia logo" src="https://placehold.co/30x30"/>
            Sberbank Russia
           </td>
           <td>
            Salaries
           </td>
           <td>
            Task management
           </td>
          </tr>
          <tr>
           <td>
            <img alt="Apple Inc. logo" src="https://placehold.co/30x30"/>
            Apple Inc.
           </td>
           <td>
            DOGE Yearly Return Invest.
           </td>
           <td>
            Team leadership
           </td>
          </tr>
          <tr>
           <td>
            <img alt="EUR/USD logo" src="https://placehold.co/30x30"/>
            EUR/USD
           </td>
           <td>
            Jack Collingwood Card reload
           </td>
           <td>
            Risk management
           </td>
          </tr>
          <tr>
           <td>
            <img alt="Bitcoin logo" src="https://placehold.co/30x30"/>
            Bitcoin
           </td>
           <td>
            Vehement Capital Partners INV-72462
           </td>
           <td>
            Procurement
           </td>
          </tr>
         </tbody>
        </table>
        <a class="btn-link" href="#">
         SHOW ALL FUNDING ROUNDS &gt;
        </a>
       </div>
      </div>
     </div>
     <div class="col-md-4">
      <div class="card stats-card">
       <div class="card-body">
        <h3>
         393
        </h3>
        <p>
         FUNDING ROUNDS
        </p>
        <h3>
         36.7B
        </h3>
        <p>
         TOTAL FUNDING
        </p>
        <h3>
         163
        </h3>
        <p>
         ACQUISITIONS RECORDED
        </p>
        <h3>
         28.2B
        </h3>
        <p>
         ACQUISITIONS AMOUNT
        </p>
       </div>
      </div>
      <div class="card promo-card">
       <div class="card-body">
        <h4>
         You're missing out
        </h4>
        <p>
         Upgrade to Crunchbase Pro to find and engage with key decision makers
        </p>
        <button class="btn">
         START FREE TRIAL
        </button>
       </div>
      </div>
      <div class="card">
       <div class="card-header">
        Featured Searches and Lists
       </div>
       <div class="card-body">
        <ul class="list-group">
         <li class="list-group-item">
          <span>
           Government Docs Submitted to UW
          </span>
          <span>
           50
          </span>
         </li>
         <li class="list-group-item">
          <span>
           Government Docs Signed by UW
          </span>
          <span>
           80
          </span>
         </li>
         <li class="list-group-item">
          <span>
           TPO Suspension Upload Rejected
          </span>
          <span>
           20
          </span>
         </li>
         <li class="list-group-item">
          <span>
           Additional Asset Review Non-AUS Jumbo
          </span>
          <span>
           120
          </span>
         </li>
        </ul>
        <a class="btn-link" href="#">
         ALL Featured Searches and Lists &gt;
        </a>
       </div>
      </div>
      <div class="card">
       <div class="card-header">
        Trending Profiles
       </div>
       <div class="card-body">
        <ul class="list-group">
         <li class="list-group-item">
          <span>
           01.
           <img alt="Tesla Motors logo" src="https://placehold.co/30x30"/>
           Tesla Motors
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
         <li class="list-group-item">
          <span>
           02.
           <img alt="Adidas logo" src="https://placehold.co/30x30"/>
           Adidas
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
         <li class="list-group-item">
          <span>
           03.
           <img alt="Tesla Motors logo" src="https://placehold.co/30x30"/>
           Tesla Motors
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
         <li class="list-group-item">
          <span>
           04.
           <img alt="Apple Inc. logo" src="https://placehold.co/30x30"/>
           Apple Inc.
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
         <li class="list-group-item">
          <span>
           05.
           <img alt="Sberbank Russia logo" src="https://placehold.co/30x30"/>
           Sberbank Russia
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
         <li class="list-group-item">
          <span>
           06.
           <img alt="Microsoft logo" src="https://placehold.co/30x30"/>
           Microsoft
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
         <li class="list-group-item">
          <span>
           07.
           <img alt="Sberbank Russia logo" src="https://placehold.co/30x30"/>
           Sberbank Russia
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
         <li class="list-group-item">
          <span>
           08.
           <img alt="Apple Inc. logo" src="https://placehold.co/30x30"/>
           Apple Inc.
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
         <li class="list-group-item">
          <span>
           09.
           <img alt="EUR/USD logo" src="https://placehold.co/30x30"/>
           EUR/USD
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
         <li class="list-group-item">
          <span>
           10.
           <img alt="Bitcoin logo" src="https://placehold.co/30x30"/>
           Bitcoin
          </span>
          <span class="save-btn">
           SAVE
          </span>
         </li>
        </ul>
       </div>
      </div>
      <div class="card">
       <div class="card-header">
        Upcoming Events
       </div>
       <div class="card-body">
        <table class="table">
         <thead>
          <tr>
           <th>
            Start Date
           </th>
           <th>
            Event Name
           </th>
           <th>
            Location
           </th>
          </tr>
         </thead>
         <tbody>
          <tr>
           <td>
            Jan 19, 2020
           </td>
           <td>
            <img alt="Globex Corporation logo" src="https://placehold.co/30x30"/>
            Globex Corporation INV-24398
           </td>
           <td>
            Lafayette, California
           </td>
          </tr>
          <tr>
           <td>
            Jan 20, 2020
           </td>
           <td>
            <img alt="Initech logo" src="https://placehold.co/30x30"/>
            Initech INV-24792
           </td>
           <td>
            Kent, Utah
           </td>
          </tr>
          <tr>
           <td>
            Jan 24, 2020
           </td>
           <td>
            <img alt="Bluth Company logo" src="https://placehold.co/30x30"/>
            Bluth Company INV-84732
           </td>
           <td>
            Lansing, Illinois
           </td>
          </tr>
          <tr>
           <td>
            Feb 1, 2020
           </td>
           <td>
            <img alt="Hooli logo" src="https://placehold.co/30x30"/>
            Hooli INV-79820
           </td>
           <td>
            Great Falls, Maryland
           </td>
          </tr>
          <tr>
           <td>
            Jan 19, 2020
           </td>
           <td>
            <img alt="Vehement Capital Partners logo" src="https://placehold.co/30x30"/>
            Vehement Capital Partners INV-72462
           </td>
           <td>
            Stockton, New Hampshire
           </td>
          </tr>
          <tr>
           <td>
            Jan 20, 2020
           </td>
           <td>
            <img alt="Massive Dynamic logo" src="https://placehold.co/30x30"/>
            Massive Dynamic INV-90874
           </td>
           <td>
            Pasadena, Oklahoma
           </td>
          </tr>
          <tr>
           <td>
            Jan 24, 2020
           </td>
           <td>
            <img alt="Salaries logo" src="https://placehold.co/30x30"/>
            Salaries
           </td>
           <td>
            Coppell, Virginia
           </td>
          </tr>
          <tr>
           <td>
            Feb 1, 2020
           </td>
           <td>
            <img alt="DOGE Yearly Return Invest. logo" src="https://placehold.co/30x30"/>
            DOGE Yearly Return Invest.
           </td>
           <td>
            Corona, Michigan
           </td>
          </tr>
          <tr>
           <td>
            Jan 19, 2020
           </td>
           <td>
            <img alt="Jack Collingwood Card reload logo" src="https://placehold.co/30x30"/>
            Jack Collingwood Card reload
           </td>
           <td>
            Syracuse, Connecticut
           </td>
          </tr>
          <tr>
           <td>
            Jan 20, 2020
           </td>
           <td>
            <img alt="Vehement Capital Partners logo" src="https://placehold.co/30x30"/>
            Vehement Capital Partners - 2462
           </td>
           <td>
            Portland, Illinois
           </td>
          </tr>
         </tbody>
        </table>
        <a class="btn-link" href="#">
         SHOW ALL EVENTS &gt;
        </a>
       </div>
      </div>
     </div>
    </div>
   </div>
@endsection
