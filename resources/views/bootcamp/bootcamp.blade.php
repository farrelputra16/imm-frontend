@extends('layouts.app-imm')
@section('title', 'Bootcamp')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/bootcamp/bootcamp.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
@section('css')
@endsection
@section('content')

    <section class="banner">
        <div class="container position-absolute d-flex flex-column align-items-start " style="margin-left: 200px">

            <h2 class="" style="max-width: 551px; font-weight:bold ">Sociopreneurship! Belajar Dari Bootcamp Yang
                Menyenangkan.</h2>
            <p class="mt-4 " style="max-width:551px; font-size:16px">Selamat datang di Impact Measurement and
                Management (IMM)!
                Kembangkan Bisnismu dengan Dampak Positif dan Ikuti IMM, Program Kolaborasi Sociopreneurship dari TBN
                Indonesia dan Maxy Academy.</p>
        </div>
        <img src="images/banner-bootcamp.png" alt="">
    </section>

    <div class="container mb-5">
        <div class="content-card">
            <div class="search-container mt-4">
                <button onclick="searchBlog()"><i class="fas fa-search"></i></button>
                <input type="text" class="" placeholder="cari disini" id="searchInput">

            </div>
            <div class="class mb-5">
                <div class="subclas">
                    <div class="row d-flex flex-column align-items-center justify-content-center">
                        <div class="col mb-3">
                            <h3 class="text-center text-white">Kelas Yang Diikuti</h3>
                        </div>
                        <div class="col">
                            <div class="row" style="gap: 30px;">
                                <div class="col">
                                    <div class="card" style="width: 293px; height: 377px;">
                                        <img src="images/kelas1.png" class="card-img-top p-3" alt="...">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h5 class="card-title">JUDUL COURSE</h5>
                                            <p class="card-text" style="margin-top: -90px;">INFORMASI COURSE</p>
                                            <a href="#" class="">Materi Course</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card" style="width: 293px; height: 377px;">
                                        <img src="images/kelas1.png" class="card-img-top p-3" alt="...">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h5 class="card-title">JUDUL COURSE</h5>
                                            <p class="card-text" style="margin-top: -90px;">INFORMASI COURSE</p>
                                            <a href="#" class="">Materi Course</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="card" style="width: 293px; height: 377px;">
                                        <img src="images/kelas1.png" class="card-img-top p-3" alt="...">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h5 class="card-title">JUDUL COURSE</h5>
                                            <p class="card-text" style="margin-top: -90px;">INFORMASI COURSE</p>
                                            <a href="#" class="">Materi Course</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col mt-5">
                            <a href=" " class="">
                                <p class="text-right text-white">Lihat Kelas Yang Diikuti</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content-2">
                <div class="row d-flex flex-column">
                    <p class="" style="font-size:32px">Pillihan <strong>Bootcamp</strong></p>
                    <p class="" style="font-size: 16px; font-weight:100; margin-top:-15px">Ayo bangun Bisnismu,
                        mulai dari sini!</p>
                </div>
                <div class="row ">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <div class="col  mt-4">
                            <div class="card " style="width: 277px; height:397px">
                                <img src="images/card1.png" class="card-img-top" alt="...">
                                <div class="card-body p-2 text-center"
                                    style="background-color: rgba(156, 138, 240, 0.15)">
                                    <h5 class="card-title mt-3">UI/UX Bootcamp</h5>
                                    <p class="card-text">desain UI/UX, membekali dengan pengetahuan dan keterampilan.
                                    </p>
                                    <div class="row d-flex mx-1 justify-content-between">
                                        <div class="col d-flex flex-column align-items-start">
                                            <p>Rp 150.000</p>
                                            <div class="d-flex justify-content-center">
                                                <span class="star" data-value="1"></span>
                                                <span class="star" data-value="2"></span>
                                                <span class="star" data-value="3"></span>
                                                <span class="star" data-value="4"></span>
                                                <span class="star" data-value="5"></span>

                                            </div>
                                            <p class="mt-3" id="ratingText"> <span id="ratingValue"></span></p>
                                        </div>

                                        <div class="col"> <a href="detail-kelas" class="btn text-white"
                                                style="background-color: #5940CB; ">Buy Now</a></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col  mt-4">
                            <div class="card " style="width: 277px; height:397px">
                                <img src="images/card1.png" class="card-img-top" alt="...">
                                <div class="card-body p-2 text-center"
                                    style="background-color: rgba(156, 138, 240, 0.15)">
                                    <h5 class="card-title mt-3">UI/UX Bootcamp</h5>
                                    <p class="card-text">desain UI/UX, membekali dengan pengetahuan dan keterampilan.
                                    </p>
                                    <div class="row d-flex mx-1 justify-content-between">
                                        <div class="col d-flex flex-column align-items-start">
                                            <p>Rp 150.000</p>
                                            <div class="d-flex justify-content-center">
                                                <span class="star" data-value="1"></span>
                                                <span class="star" data-value="2"></span>
                                                <span class="star" data-value="3"></span>
                                                <span class="star" data-value="4"></span>
                                                <span class="star" data-value="5"></span>

                                            </div>
                                            <p class="mt-3" id="ratingText"> <span id="ratingValue"></span></p>
                                        </div>

                                        <div class="col"> <a href="#" class="btn text-white"
                                                style="background-color: #5940CB; ">Buy Now</a></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col  mt-4">
                            <div class="card " style="width: 277px; height:397px">
                                <img src="images/card1.png" class="card-img-top" alt="...">
                                <div class="card-body p-2 text-center"
                                    style="background-color: rgba(156, 138, 240, 0.15)">
                                    <h5 class="card-title mt-3">UI/UX Bootcamp</h5>
                                    <p class="card-text">desain UI/UX, membekali dengan pengetahuan dan keterampilan.
                                    </p>
                                    <div class="row d-flex mx-1 justify-content-between">
                                        <div class="col d-flex flex-column align-items-start">
                                            <p>Rp 150.000</p>
                                            <div class="d-flex justify-content-center">
                                                <span class="star" data-value="1"></span>
                                                <span class="star" data-value="2"></span>
                                                <span class="star" data-value="3"></span>
                                                <span class="star" data-value="4"></span>
                                                <span class="star" data-value="5"></span>

                                            </div>
                                            <p class="mt-3" id="ratingText"> <span id="ratingValue"></span></p>
                                        </div>

                                        <div class="col"> <a href="#" class="btn text-white"
                                                style="background-color: #5940CB; ">Buy Now</a></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col  mt-4">
                            <div class="card " style="width: 277px; height:397px">
                                <img src="images/card1.png" class="card-img-top" alt="...">
                                <div class="card-body p-2 text-center"
                                    style="background-color: rgba(156, 138, 240, 0.15)">
                                    <h5 class="card-title mt-3">UI/UX Bootcamp</h5>
                                    <p class="card-text">desain UI/UX, membekali dengan pengetahuan dan keterampilan.
                                    </p>
                                    <div class="row d-flex mx-1 justify-content-between">
                                        <div class="col d-flex flex-column align-items-start">
                                            <p>Rp 150.000</p>
                                            <div class="d-flex justify-content-center">
                                                <span class="star" data-value="1"></span>
                                                <span class="star" data-value="2"></span>
                                                <span class="star" data-value="3"></span>
                                                <span class="star" data-value="4"></span>
                                                <span class="star" data-value="5"></span>

                                            </div>
                                            <p class="mt-3" id="ratingText"> <span id="ratingValue"></span></p>
                                        </div>

                                        <div class="col"> <a href="#" class="btn text-white"
                                                style="background-color: #5940CB; ">Buy Now</a></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col  mt-4">
                            <div class="card " style="width: 277px; height:397px">
                                <img src="images/card1.png" class="card-img-top" alt="...">
                                <div class="card-body p-2 text-center"
                                    style="background-color: rgba(156, 138, 240, 0.15)">
                                    <h5 class="card-title mt-3">UI/UX Bootcamp</h5>
                                    <p class="card-text">desain UI/UX, membekali dengan pengetahuan dan keterampilan.
                                    </p>
                                    <div class="row d-flex mx-1 justify-content-between">
                                        <div class="col d-flex flex-column align-items-start">
                                            <p>Rp 150.000</p>
                                            <div class="d-flex justify-content-center">
                                                <span class="star" data-value="1"></span>
                                                <span class="star" data-value="2"></span>
                                                <span class="star" data-value="3"></span>
                                                <span class="star" data-value="4"></span>
                                                <span class="star" data-value="5"></span>

                                            </div>
                                            <p class="mt-3" id="ratingText"> <span id="ratingValue"></span></p>
                                        </div>

                                        <div class="col"> <a href="#" class="btn text-white"
                                                style="background-color: #5940CB; ">Buy Now</a></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col  mt-4">
                            <div class="card " style="width: 277px; height:397px">
                                <img src="images/card1.png" class="card-img-top" alt="...">
                                <div class="card-body p-2 text-center"
                                    style="background-color: rgba(156, 138, 240, 0.15)">
                                    <h5 class="card-title mt-3">UI/UX Bootcamp</h5>
                                    <p class="card-text">desain UI/UX, membekali dengan pengetahuan dan keterampilan.
                                    </p>
                                    <div class="row d-flex mx-1 justify-content-between">
                                        <div class="col d-flex flex-column align-items-start">
                                            <p>Rp 150.000</p>
                                            <div class="d-flex justify-content-center">
                                                <span class="star" data-value="1"></span>
                                                <span class="star" data-value="2"></span>
                                                <span class="star" data-value="3"></span>
                                                <span class="star" data-value="4"></span>
                                                <span class="star" data-value="5"></span>

                                            </div>
                                            <p class="mt-3" id="ratingText"> <span id="ratingValue"></span></p>
                                        </div>

                                        <div class="col"> <a href="#" class="btn text-white"
                                                style="background-color: #5940CB; ">Buy Now</a></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col  mt-4">
                            <div class="card " style="width: 277px; height:397px">
                                <img src="images/card1.png" class="card-img-top" alt="...">
                                <div class="card-body p-2 text-center"
                                    style="background-color: rgba(156, 138, 240, 0.15)">
                                    <h5 class="card-title mt-3">UI/UX Bootcamp</h5>
                                    <p class="card-text">desain UI/UX, membekali dengan pengetahuan dan keterampilan.
                                    </p>
                                    <div class="row d-flex mx-1 justify-content-between">
                                        <div class="col d-flex flex-column align-items-start">
                                            <p>Rp 150.000</p>
                                            <div class="d-flex justify-content-center">
                                                <span class="star" data-value="1"></span>
                                                <span class="star" data-value="2"></span>
                                                <span class="star" data-value="3"></span>
                                                <span class="star" data-value="4"></span>
                                                <span class="star" data-value="5"></span>

                                            </div>
                                            <p class="mt-3" id="ratingText"> <span id="ratingValue"></span></p>
                                        </div>

                                        <div class="col"> <a href="#" class="btn text-white"
                                                style="background-color: #5940CB; ">Buy Now</a></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col  mt-4">
                            <div class="card " style="width: 277px; height:397px">
                                <img src="images/card1.png" class="card-img-top" alt="...">
                                <div class="card-body p-2 text-center"
                                    style="background-color: rgba(156, 138, 240, 0.15)">
                                    <h5 class="card-title mt-3">UI/UX Bootcamp</h5>
                                    <p class="card-text">desain UI/UX, membekali dengan pengetahuan dan keterampilan.
                                    </p>
                                    <div class="row d-flex mx-1 justify-content-between">
                                        <div class="col d-flex flex-column align-items-start">
                                            <p>Rp 150.000</p>
                                            <div class="d-flex justify-content-center">
                                                <span class="star" data-value="1"></span>
                                                <span class="star" data-value="2"></span>
                                                <span class="star" data-value="3"></span>
                                                <span class="star" data-value="4"></span>
                                                <span class="star" data-value="5"></span>

                                            </div>
                                            <p class="mt-3" id="ratingText"> <span id="ratingValue"></span></p>
                                        </div>

                                        <div class="col"> <a href="#" class="btn text-white"
                                                style="background-color: #5940CB; ">Buy Now</a></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="content-4  mt-5">
                    <div class="row  d-flex flex-column">
                        <p class="" style="font-size:32px">Rekomendasi Kelas</p>
                        <p class="" style="font-size: 16px; font-weight:100; margin-top:-15px">Rekomendasi Kelas
                            Terbaik, Ayo dipilih!</p>
                    </div>
                    <div class="row  d-flex justify-content-center ">
                        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-between">
                            <div class="col mt-4">
                                <button type="" class=" btn-rkelas">UI/UX Bootcamp</button>
                            </div>
                            <div class="col mt-4">
                                <button type="" class=" btn-rkelas">Backend Bootcamp</button>
                            </div>
                            <div class="col mt-4">
                                <button type="" class=" btn-rkelas">Digital Marketing Bootcamp</button>
                            </div>
                            <div class="col mt-4">
                                <button type="" class="bn btn-rkelas">Frontend Bootcamp</button>
                            </div>
                            <div class="col mt-4">
                                <button type="" class=" btn-rkelas">UI/UX Bootcamp</button>
                            </div>
                            <div class="col mt-4">
                                <button type="" class=" btn-rkelas">Backend Bootcamp</button>
                            </div>
                            <div class="col mt-4">
                                <button type="" class=" btn-rkelas">Digital Marketing Bootcamp</button>
                            </div>
                            <div class="col mt-4">
                                <button type="" class="bn btn-rkelas">Frontend Bootcamp</button>
                            </div>
                        </div>

                    </div>
                </div>


                <div class="content-3  mt-5">
                    <div class="row  d-flex flex-column">
                        <p class="" style="font-size:32px">Perpustakaan</p>
                        <p class="" style="font-size: 16px; font-weight:100; margin-top:-15px">Buku dan catatan
                            digital, Cari Di sini!</p>
                    </div>
                    <div class="row  d-flex justify-content-center ">
                        <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-between">
                            <div class="col mt-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="images/book.png" class="card-img-top" alt="...">
                                    <div class="card-body d-flex justify-content-between">

                                        <span class="card-text">Chemistry </span>
                                        <a href="#" class=""><img src="images/icon-unduh.png" style="width: 25px; height:19px" alt=""></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="images/book.png" class="card-img-top" alt="...">
                                    <div class="card-body d-flex justify-content-between">

                                        <span class="card-text">Chemistry </span>
                                        <a href="#" class=""><img src="images/icon-unduh.png" style="width: 25px; height:19px" alt=""></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="images/book.png" class="card-img-top" alt="...">
                                    <div class="card-body d-flex justify-content-between">

                                        <span class="card-text">Chemistry </span>
                                        <a href="#" class=""><img src="images/icon-unduh.png" style="width: 25px; height:19px" alt=""></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="images/book.png" class="card-img-top" alt="...">
                                    <div class="card-body d-flex justify-content-between">

                                        <span class="card-text">Chemistry </span>
                                        <a href="#" class=""><img src="images/icon-unduh.png" style="width: 25px; height:19px" alt=""></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="images/book.png" class="card-img-top" alt="...">
                                    <div class="card-body d-flex justify-content-between">

                                        <span class="card-text">Chemistry </span>
                                        <a href="#" class=""><img src="images/icon-unduh.png" style="width: 25px; height:19px" alt=""></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="images/book.png" class="card-img-top" alt="...">
                                    <div class="card-body d-flex justify-content-between">

                                        <span class="card-text">Chemistry </span>
                                        <a href="#" class=""><img src="images/icon-unduh.png" style="width: 25px; height:19px" alt=""></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="images/book.png" class="card-img-top" alt="...">
                                    <div class="card-body d-flex justify-content-between">

                                        <span class="card-text">Chemistry </span>
                                        <a href="#" class=""><img src="images/icon-unduh.png" style="width: 25px; height:19px" alt=""></a>
                                    </div>

                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="images/book.png" class="card-img-top" alt="...">
                                    <div class="card-body d-flex justify-content-between">

                                        <span class="card-text">Chemistry </span>
                                        <a href="#" class=""><img src="images/icon-unduh.png" style="width: 25px; height:19px" alt=""></a>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <span class=" d-flex justify-content-center mt-5">
                <button class="btn-rkelas">Cari Buku</button>
            </span>
            </div>
        </div>
    </div>








    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/welcome/script.js') }}"></script>
    <script>
        // Ambil semua elemen bintang
        const stars = document.querySelectorAll('.star');

        // Fungsi untuk menangani klik pada bintang
        function handleStarClick(event) {
            const clickedValue = parseInt(event.target.getAttribute('data-value'));
            // document.getElementById('ratingValue').innerText = clickedValue;
            // Berikan warna pada bintang sesuai peringkat yang diberikan
            stars.forEach(star => {
                const starValue = parseInt(star.getAttribute('data-value'));
                if (starValue <= clickedValue) {
                    star.style.color = '#9C8AF0'; // Warna bintang terisi
                } else {
                    star.style.color = 'rgba(156, 138, 240, 0.15)'; // Warna bintang kosong
                }
            });
        }

        // Tambahkan event listener untuk setiap bintang
        stars.forEach(star => {
            star.addEventListener('click', handleStarClick);
        });
    </script>
</body>


@endsection