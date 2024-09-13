<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | Responden</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/responden/responden.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap");
        body {
            font-family: "Roboto", sans-serif;
            background-color: #ffffff;
            font-family: "Quicksand", sans-serif;
        }

        .content {
            background-color: #f7f6fb;
            height: 602px;
            width: 100%;
            border-radius: 20px;
            display: flex;
            align-items: center;
            padding: 0 50px;
            text-align: justify;
            flex-direction: column;
        }


        img {
            width: 100%;
            height: auto;
            background-size: cover;
        }

        .btn {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        button {
            width: 399px;
            height: 49px;
            background-color: #5940cb;
            border: none;
            border-radius: 6px;
            color: white;
        }

        .text-primary {
            color: #5940cb !important;
        }

        .main-title {
            font-size: 40px;
            font-weight: bold;
        }

        .subtitle {
            font-weight: bold;
            font-size: 20px;
        }
        .sub-content {
            background-color: #e5e2f2;
            width: 100%;
            height: 182px;
            margin-top: 50px;
            justify-content: center;
            display: flex;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .content-text {
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .content {
                padding: 20px;
                height: auto;
            }

            .sub-content {
                margin-top: 20px;
                margin-bottom: 20px;
                height: 100px;
            }

            .main-title {
                font-size: 24px;
            }

            .subtitle,
            .content-text {
                font-size:12px;
            }

            .btn {
                justify-content: center;
                margin-top: 20px;
            }

            button {
                width: 100%;
                height: auto;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container content mt-5">
        <div class="container">
            <div class="sub-content d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/default_project.png') }}" alt="img" style="width: 100%; height: 150%;">
            </div>
            <p class="main-title">{{ $survey->name }}</p>
            <p class="subtitle">Komitmen dalam menjaga privasi anda</p>
            <p class="content-text">Saya sangat berkomitmen untuk menjalankan survei dengan hati-hati dan jujur serta
                menjaga kerahasiaan data yang dikumpulkan. Saya selalu menghormati privasi dan kepentingan peserta
                survei, serta memastikan bahwa hasil survei saya digunakan dengan bertanggung jawab demi kebaikan semua
                orang yang terlibat. </p>
            <div class="btn">
                  @if (!$lastEntry)
                    <!-- Check if $lastEntry is null -->
                    <a href="/responden-data-diri/{{ $survey->id }}"><button type="">Mulai Survey</button></a>
                @else
                    <!-- Disable the button -->
                    <button type="" disabled>Anda sudah mengisi survey</button>
                @endif
            </div>
        </div>
    </div>
    <footer>
        <div class="container mb-5 mt-5 d-flex justify-content-center align-items-center  ">
            <h5 style="color: #5940cb; font-weight:bold">Konten di dalam survey ini tidak dibuat oleh Impact Mate</h5>

     </div>
    </footer>

    <script src="{{ asset('js/imm/metrix.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>