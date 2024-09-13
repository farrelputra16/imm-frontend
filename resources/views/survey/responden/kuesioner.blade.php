<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responden</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/responden/responden-esay.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap");

        body {
            font-family: "Roboto", sans-serif;
            /* Add padding to avoid content being hidden behind fixed navbar */
            background-color: #ffffff;
            font-family: "Quicksand", sans-serif;
        }

        .content {
            background-color: #f7f6fb;
            height: 362px;
            width: 1220px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            padding: 0 50px;
            text-align: justify;
        }

        label {
            font-size: 16px;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
        }

        .form-control {
            height: 47px;
            width: 702px;
            border: 2px solid #5940cb;
        }

        .content2 {
            background-color: #f7f6fb;
            width: 1220px;
            border-radius: 20px;
            display: flex;
            padding: 50px 50px;
            text-align: justify;
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

        img {
            width: 100%;
            height: auto;
            background-size: cover;
        }

        .angka {
            height: 54px;
            width: 35px;
            background-color: #5940cb;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            color: white;
        }

        .btn-kembali {
            width: 399px;
            height: 49px;
            background-color: white;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: #5940cb;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: bold;
        }

        .btn-selanjutnya {
            width: 399px;
            height: 49px;
            background-color: #5940cb;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: white;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container content mt-5">
        <div class="container">
            <div class="sub-content  d-flex justify-content-center align-items-center">
                    <img src="{{ asset('images/default_project.png') }}" alt="img" style="width: 100%; height: 150%;">
                </div>

            <p style="font-size: 40px;font-weight: bold;"> {{ $survey->name }} </p>

        </div>
    </div>

    <form action="{{ route('surveys.submit', ['survey' => $survey->id, 'user' => $user->id]) }}" method="POST">
        @csrf
        <div class="container content2 mt-5">
            <div class="container">
                <div class="form-esay">
                    @foreach ($survey->sections as $section)
                        <h3 class="px-4 py-3 mb-5 mt-5"
                            style="background:#5940cb; color:white; border-top:solid 1px #dadada">
                            {{ $section->name }}</h3>
                        @foreach ($section->questions as $question)
                            <div class="row d-flex align-items-start">
                                <span class="angka d-flex justify-content-center align-items-center">
                                    {{ $loop->parent->iteration }}.{{ $loop->iteration }}
                                </span>
                                @include('survey::questions.single', [
                                    'question' => $question,
                                    'lastEntry' => $lastEntry,
                                ])
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row gap d-flex justify-content-center">
                {{-- <a href="{{ route('survey.responden.responden') }}"><button class="btn-kembali" type="button">Kembali</button></a> --}}
                <button type="submit" class="btn-selanjutnya">Submit</button>
            </div>
        </div>
    </form>

    <footer>
        <div class="container mb-5 mt-5 d-flex justify-content-center align-items-center  ">
            <h5 style="color: #5940cb; font-weight:bold">Konten di dalam survey ini tidak dibuat oleh Impact Mate</h5>

        </div>
    </footer>

    {{-- <div class="container mt-5">
        <div class="row gap d-flex justify-content-center">
           <a href="/responden-data-diri"><button class="btn-kembali">Kembali</button></a>
           <a href="/responden-pilihan-ganda"> <button class="btn-selanjutnya">Lanjutkan</button></a>
        </div>
    </div> --}}


    <script src="{{ asset('js/imm/metrix.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>