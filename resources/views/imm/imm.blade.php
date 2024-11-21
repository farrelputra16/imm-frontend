@extends('layouts.app-2fa')
@section('title', 'IMM')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/imm/imm.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Arial', sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #ffffff;
}
.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 80%;
}
.text-container {
    text-align: left;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    width: 50%;
}
.highlight {
    color: #6c63ff;
    font-weight: bold;
    font-style: italic;
}
.btn-custom {
    background-color: #6256CA;
    color: white;
    width: 199px;
    height:57px;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 24px;
    margin-top: 20px;
    align-self: center;
}
.btn-custom:hover {
    background-color: #5a54d6;
}
.rocket-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    width: 50%;
    position: relative; /* Set position relative for absolute positioning of the rocket */
    overflow: hidden; /* Hide overflow to keep the animation contained */
}

.rocket-image {
    max-width: 100%;
    height: auto;
    position: relative; /* Position relative for animation */
    animation: float 3s ease-in-out infinite; /* Apply animation */
}

@keyframes float {
    0% {
        transform: translateY(0) translateX(0); /* Start position */
    }
    25% {
        transform: translateY(-20px) translateX(-10px); /* Move up and left */
    }
    50% {
        transform: translateY(0) translateX(10px); /* Move back to center and right */
    }
    75% {
        transform: translateY(-10px) translateX(-5px); /* Move up and left again */
    }
    100% {
        transform: translateY(0) translateX(0); /* Return to start position */
    }
}
</style>
<body>
    {{-- <div class="container-fluid d-flex justify-content-between" style="height: 100vh">
        <div class=" d-flex justify-content-start align-items-center">
            <img src="images/6.png" style="height: 100vh" alt="Your Image" />
        </div>
        <div class="col-6 d-flex justify-content-start align-items-center">
            <div class="content-text " style="max-width: 70%;" >
                <h1 class=" font-weight-bold">Mulai ukur dampak anda dengan percaya Diri</h1>
                <!-- <p>IMM (Impact Mate) adalah platform yang...</p> -->
                <a href="pendaftaranperusahaan" class=" btn-mulai">Mulai Sekarang</a>
            </div>
        </div>
    </div> --}}

    <div class="container">
        <div class="text-container">
            <h2>
                <span class="highlight">Start</span>
                <span style="color: #000000">measuring your</span> <br/>
                <span class="highlight">impact</span>
                <span style="color: #000000">with confidence</span>
            </h2>
            <p>
            Because every step towards success starts from understanding real results
            </p>
            <a href="pendaftaranperusahaan" class="btn btn-custom">
                Start Now
            </a>
        </div>
        <div class="rocket-container">
    <img alt="Illustration of a person riding a rocket" class="rocket-image" height="582" src="{{ asset('images/Business startup.svg') }}" width="582"/>
    <div class="flame-container">
        <div class="flame"></div>
        <div class="flame"></div>
        <div class="flame"></div>
    </div>
</div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('js/imm/imm.js') }}"></script>

</body>
@endsection
