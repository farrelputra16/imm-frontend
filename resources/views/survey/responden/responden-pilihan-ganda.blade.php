<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | Responden Pilihan Ganda</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/responden/responden-pilihan-ganda.css') }}">
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
                <img src="" alt="img">
            </div>

            <input type="file" id="gambar" name="gambar" accept="image/*" style="display: none;">


            <p style="font-size: 40px;font-weight: bold;">Survey Dampak Bisnis Ternak Lele</p>

        </div>
    </div>

    <div class="container content2 mt-5">
        <div class="container">
            <div class="form-pilihan-ganda">

                <div class="row d-flex " style="gap: 45px">
                    <span class="angka d-flex justify-content-center align-items-center">
                        1
                    </span>
                    <div class="mb-4 d-flex flex-column">
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios1" value="option1" checked="">Lorem ipsum </label>
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios2" value="option2" checked="">Lorem ipsum </label>
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios3" value="option3" checked="">Lorem ipsum </label>
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios4" value="option4" checked="">Lorem ipsum </label>
                    </div>
                </div>
                <div class="row d-flex " style="gap: 45px">
                    <span class="angka d-flex justify-content-center align-items-center">
                2
                    </span>
                    <div class="mb-4 d-flex flex-column">
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios1" value="option1" checked="">Lorem ipsum </label>
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios2" value="option2" checked="">Lorem ipsum </label>
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios3" value="option3" checked="">Lorem ipsum </label>
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios4" value="option4" checked="">Lorem ipsum </label>
                    </div>
                </div>
                <div class="row d-flex " style="gap: 45px">
                    <span class="angka d-flex justify-content-center align-items-center">
                     3
                    </span>
                    <div class="mb-4 d-flex flex-column">
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios1" value="option1" checked="">Lorem ipsum </label>
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios2" value="option2" checked="">Lorem ipsum </label>
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios3" value="option3" checked="">Lorem ipsum </label>
                        <label>
                            <input type="radio" class="mb-3" name="optionsRadios" id="optionsRadios4" value="option4" checked="">Lorem ipsum </label>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row gap d-flex justify-content-center"style="gap: 24px">
         <a href="/responden-esay"> <button class="btn-kembali">Kembali</button></a> 
           <a href="/responden-skala"> <button class="btn-selanjutnya">Lanjutkan</button></a>
        </div>
    </div><footer>
    <div class="container footer mt-5 d-flex justify-content-center align-items-center  ">
        <div class="row d-flex  justify-content-center align-items-center">
            <div class="col-4 d-flex flex-column" style="gap: 20px">
                <h5 class=" text-white  text-left">IMM</h5>
                <span class="span-footer text-left">Impact Measurement and Management
                        <br> (TBN INDONESIA X MAXY ACADEMY)</span>
            </div>
            <div class="col-5 d-flex justify-content-center align-items-center">
                <ul class=" d-flex " style="gap: 30px">
                    <a href="/"><li>HomePage</li></a>
                    <a href="bootcamp"><li>Bootcamp</li></a>
                    <a href="imm"><li>IMM</li></a>
                    <a href="#"><li>Comunity</li></a>
                    <a href="profile"><li>Profile</li></a>
                </ul>
            </div>
            <div class="col-3 d-flex flex-column justify-content-center" style="gap: 30px">
                <span class="span-footer text-center">Sosial Media</span>
                <div class="sosmed d-flex justify-content-end  ">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

 </div>
</footer>
    <script src="{{ asset('js/imm/metrix.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>