@extends('layouts.app-2fa')
@section('title', 'IMM')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/imm/imm.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<style>
    *{
        overflow: hidden;    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-decoration: none;
    }
    body {
    font-family: "Roboto", sans-serif;
}
.container{
    margin: 0;
    padding: 0;
}
.btn-mulai{
    width: 390px;
    height: 50px;
    background-color:#5940cb;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 18px;
}
a:hover{
    color: white;
}

.container-fluid {
    margin: 0;
    padding: 0;
    display: flex;
    height: 100vh;
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

    </style>
@section('css')

@endsection
@section('content')


<body>

    <div class="container-fluid d-flex justify-content-between" style="height: 100vh">
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
    </div>



<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('js/imm/imm.js') }}"></script>

</body>
@endsection
