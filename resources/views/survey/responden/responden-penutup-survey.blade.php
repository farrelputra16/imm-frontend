<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | Penutup Survey</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/responden/responden-penutup-survey.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="homepage">IMM</a>

        </div>
    </nav>

    <div class="container content mt-5">
        <div class="container">
            {{-- <div class="sub-content  d-flex justify-content-center align-items-center">
                <img src="" alt="img">
            </div> --}}

            <p style="font-size: 40px;font-weight: bold;">{{ $survey->name }}</p>

        </div>
    </div>

    <div class="container content2 mt-5">
        <div class="container">
            @if ($alreadySubmitted)
                <p style="font-size: 20px; color: red;">Anda sudah pernah mengisi survei ini sebelumnya.</p>
            @endif

            <p style="font-size: 40px;font-weight: bold;">Terimakasih</p>
            <p style="font-size: 20px">Atas waktu dan partisipasi Anda dalam survei ini. Kami memastikan bahwa data yang
                Anda berikan akan dijaga dengan kerahasiaan yang tinggi sesuai dengan komitmen kami terhadap privasi
                Anda. Kontribusi Anda sangat berarti bagi kami dalam memahami topik ini dengan lebih baik</p>
        </div>
    </div>
    {{-- <div class="container mt-5">
        <div class="row gap d-flex justify-content-center">
            <button class="btn-kembali">Kembali</button>
            <button class="btn-selanjutnya">Lanjutkan</button>
        </div>
    </div> --}}    
    
    <footer>
        <div class="container mb-5 mt-5 d-flex justify-content-center align-items-center  ">
            <h5 style="color: #5940cb; font-weight:bold">Konten di dalam survey ini tidak dibuat oleh Impact Mate</h5>

     </div>
    </footer>
    <script src="{{ asset('js/imm/metrix.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>