<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | Responden Data Diri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/responden/responden-data-diri.css') }}">
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
            <div class="sub-content  d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/default_project.png') }}" alt="img" style="width: 100%; height: 150%;">
            </div>

            <p style="font-size: 40px;font-weight: bold;">{{$survey->name}}</p>

        </div>
    </div>

    <div class="container content2 mt-5">
        <div class="container">
            <div class="mt-5">
                <p style="font-size: 40px;font-weight: bold;">Isi data diri anda</p>
                <p style="font-size: 20px; margin-top:-10px;">Data diri anda terjamin kerahasiaannya</p>
                <div class="register-container">
                    <form method="POST" action="{{ route('surveys.register-user', $survey->id) }}">
                        @csrf
                        <div class="mb-4 mt-4">
                            <label for="nama_depan" class="form-label">Nama Depan</label>
                            <input type="text" name="nama_depan" id="nama_depan" class="form-control"  placeholder="Isi disini" required>
                          </div>
                        <div class="mb-4">
                            <label for="nama_belakang" class="form-label">Nama Belakang</label>
                            <input type="text" name="nama_belakang" id="nama_belakang" class="form-control"  placeholder="Isi disini" required>
                          </div>
                        <div class="mb-4">
                            <label for="no_telp" class="form-label">Nomor yang bisa dihubungi </label>
                            <input type="number" name="telepon" id="no_telp" class="form-control" placeholder="0812345678" required>
                          </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Email yang bisa dihubungi</label>
                            <input type="email" name="email" id="email" class="form-control"  placeholder="imm@gmail.com" required>
                          </div>
                        <div class="mb-4">
                            <label for="date" class="form-label">Tanggal Mengisi</label>
                            <input type="date" name="date" id="date" class="form-control"  placeholder="" required>
                          </div>

                </div>

            </div>



        </div>
    </div>
    <div class="container mt-5">
        <div class="row gap d-flex justify-content-center" style="gap: 24px">
           <a href="/responden/{{$survey->id}}"> <button class="btn-kembali">Kembali</button></a>
          <button type="submit" class="btn-selanjutnya">Lanjutkan</button>
        </div>
    </div>
                    </form>
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