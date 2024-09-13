<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | Detail Kelas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/kelas/detail-kelas.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">IMM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bootcamp">Bootcamp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="comunity">Community</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="imm">IMM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile">Profile</a>
                    </li>
                </ul>
                <div class="navbar-actions">
                    <a href="login" class="btn btn-primary">Login</a>
                    <a href="register" class="btn btn-outline-primary">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container  mb-5">
        <div class="content" style="width: 100%">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col">
                    <h1>Full Stack Web</h1>
                </div>
                <div class="col text-right">
                    <h3>Rp 250.000</h3>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center align-items-center" >
                <div class="col d-flex align-items-center">
                    <p class="mr-2">Rp 150.000</p>
                    <div class="d-flex align-items-center mt-1">
                        <span class="star" data-value="1"></span>
                        <span class="star" data-value="2"></span>
                        <span class="star" data-value="3"></span>
                        <span class="star" data-value="4"></span>
                        <span class="star" data-value="5"></span>
                    </div>
                    <p class="ml-2">(132 reviews)</p>
                </div>

                <div class="col d-flex justify-content-end ml-1">
                    <button class="btn-beli text-white">Beli Sekarang</button>
                </div>
            </div>

        </div>
    </div>

    <div class="container mt-5 mb-5">
        <img src="images/banner-detailkelas.png" alt="">
    </div>


    <div class="container">
        <div class="d-flex flex-column" style="width: 100%">
            <h3>Deskription</h3>
            <span class="">
                (Data Dari CMS)
            </span>
            <a href="" class="">Open in Google Maps</a>
        </div>
    </div>


    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-6 d-flex flex-column justify-content-start align-items-start">
                <p class="customer-review-title">Customer Review</p>
                <span class="rating-summary d-flex align-items-center">
                    <h1 class="average-rating">4,30</h1>
                    <span class="total-reviews ml-2">132 Reviews</span>
                </span>
                <div class="star-ratings d-flex align-items-center mt-3">
                    <span class="star1" data-value="1"></span>
                    <span class="star1" data-value="2"></span>
                    <span class="star1" data-value="3"></span>
                    <span class="star1" data-value="4"></span>
                    <span class="star1" data-value="5"></span>
                </div>
            </div>

<div class="col-6 d-flex flex-column justify-content-end">
    
    <div class="rating-item" data-rating="4.8">
        <span class="label">Guide</span>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
        <span class="rating-value  text-right">4.8</span>
    </div>
    <div class="rating-item" data-rating="4.8">
        <span class="label">Trans</span>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
        <span class="rating-value  text-right">4.8</span>
    </div>
    <div class="rating-item" data-rating="4.5">
        <span class="label">Value for money</span>
        <div class="progress-bar justify-content-end">
            <div class="progress  text-right"></div>
        </div>
        <span class="rating-value  text-right">4.5</span>
    </div>
    <div class="rating-item" data-rating="4.0">
        <span class="label">Safety</span>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
        <span class="rating-value  text-right">4.0</span>
    </div>
</div>
            {{-- <div class="col-6 d-flex flex-column justify-content-end align-items-end">
                <div class="rating-item" data-rating="4.8">
                    <span class="label">Guide</span>
                    <div class="progress-bar">
                        <div class="progress"></div>
                    </div>
                    <span class="rating-value">4.8</span>
                </div>
                <div class="rating-item" data-rating="4.8">
                    <span class="label">Transportation</span>
                    <div class="progress-bar">
                        <div class="progress"></div>
                    </div>
                    <span class="rating-value">4.8</span>
                </div>
                <div class="rating-item" data-rating="4.5">
                    <span class="label">Value for money</span>
                    <div class="progress-bar">
                        <div class="progress"></div>
                    </div>
                    <span class="rating-value">4.5</span>
                </div>
                <div class="rating-item" data-rating="4.0">
                    <span class="label">Safety</span>
                    <div class="progress-bar">
                        <div class="progress"></div>
                    </div>
                    <span class="rating-value">4.0</span>
                </div>
            </div> --}}
        </div>
    </div>
    <div class="container mt-5"
        style="width:1170px; height:80px; border-radius:3px; background-color: #F8FAFC; border-radius:3px; border:1px solid rgba(22, 82, 125, 0.08);">
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-auto d-flex justify-content-center align-items-center">
                    <img src="images/icon-filter.png" style="width: 20px; height:22px" alt="">
                    <span>Filtering:</span>
                </div>
                <div class="col-auto px-1">
                    <div class="dropdown">
                        <button class="btn d-flex justify-content-between align-items-center bg-white dropdown-toggle"
                            style="width: 200px; height:50px" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Recommended
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto px-1">
                    <div class="dropdown">
                        <button class="btn d-flex justify-content-between align-items-center bg-white dropdown-toggle"
                            style="width: 200px; height:50px" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Traveler type
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto px-1">
                    <div class="dropdown">
                        <button class="btn d-flex justify-content-between align-items-center bg-white dropdown-toggle"
                            style="width: 200px; height:50px" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Rating
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto px-1">
                    <form class="d-flex">
                        <input class="form-control me-2" style="width: 362px; height:50px" type="search"
                            placeholder="Search Here" aria-label="Search">

                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Customer Review --}}
    <div class="container mt-5 d-flex flex-column" style="margin-bottom:120px">




        <div class="row d-flex justify-content-center align-items-start ">
            <div class="col-3 d-flex justify-content-center align-items-start">
                <div class="image-container">
                    <img src="images/img4-event.png" alt="Example Image" class="circle-image">
                </div>
                <div class="col">
                    <div class="d-flex align-items-center mt-3">
                        <span class="star" data-value="1"></span>
                        <span class="star" data-value="2"></span>
                        <span class="star" data-value="3"></span>
                        <span class="star" data-value="4"></span>
                        <span class="star" data-value="5"></span>
                    </div>
                    <span class="" style="font-family: Mulish, sans-serif; font-size:15px; font-weight:bold;">
                        Arlene McCoy ✓✓</span>
                    <p style="font-family: Mulish, sans-serif; font-size:13px; font-weight:400;">2 October 2012</p>
                </div>
            </div>

            <div class="col-7">
                <span
                    style="font-family: Mulish, sans-serif; font-size:15px; font-weight:bold; text-align:justify">Good
                    tour, really well organised</span>
                <p class="mt-3" style="font-family: Mulish, sans-serif; font-size:14px; text-align:justify">The tour
                    was very well organised. One minus is that you get completely bombarded with information.
                    You also have to stand up for too long at the private entrance to the Tower of London, which leads
                    to a lack of time later. Lunch was the same, too stress, the quality was great but you couldn't
                    enjoy it. I'd like to ask the organisers: please</p>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <p class=" mx-3" style="font-family: Mulish, sans-serif; font-size:13px; font-weight:400;">Helpful?
                </p>
                <p class="" style="font-family: Mulish, sans-serif; font-size:13px; font-weight:bold;">Yes</p>
            </div>
            <div class="garis mb-3" style="width: 100%; height:1px; background-color:#E8EAEB"></div>
        </div>
        <div class="row d-flex justify-content-center align-items-start ">
            <div class="col-3 d-flex justify-content-center align-items-start">
                <div class="image-container">
                    <img src="images/img4-event.png" alt="Example Image" class="circle-image">
                </div>
                <div class="col">
                    <div class="d-flex align-items-center mt-3">
                        <span class="star" data-value="1"></span>
                        <span class="star" data-value="2"></span>
                        <span class="star" data-value="3"></span>
                        <span class="star" data-value="4"></span>
                        <span class="star" data-value="5"></span>
                    </div>
                    <span class="" style="font-family: Mulish, sans-serif; font-size:15px; font-weight:bold;">
                        Arlene McCoy ✓✓</span>
                    <p style="font-family: Mulish, sans-serif; font-size:13px; font-weight:400;">2 October 2012</p>
                </div>
            </div>

            <div class="col-7">
                <span
                    style="font-family: Mulish, sans-serif; font-size:15px; font-weight:bold; text-align:justify">Good
                    tour, really well organised</span>
                <p class="mt-3" style="font-family: Mulish, sans-serif; font-size:14px; text-align:justify">The tour
                    was very well organised. One minus is that you get completely bombarded with information.
                    You also have to stand up for too long at the private entrance to the Tower of London, which leads
                    to a lack of time later. Lunch was the same, too stress, the quality was great but you couldn't
                    enjoy it. I'd like to ask the organisers: please</p>
            </div>
            <div class="col-2 d-flex justify-content-end">
                <p class=" mx-3" style="font-family: Mulish, sans-serif; font-size:13px; font-weight:400;">Helpful?
                </p>
                <p class="" style="font-family: Mulish, sans-serif; font-size:13px; font-weight:bold;">Yes</p>
            </div>
            <div class="garis mb-3" style="width: 100%; height:1px; background-color:#E8EAEB"></div>
        </div>

        <div class="text-center">
            <a href="">View More Comments</a>
        </div>
    </div>
    {{-- End Customer Review --}}







    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="brand-info">
                    <h3>IMM</h3>
                    <p>(TBN INDONESIA X MAXY ACADEMY)</p>
                </div>
                <div class="footer-links">
                    <div class="footer-nav">
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="bootcamp">Bootcamp</a></li>
                            <li><a href="imm">IMM</a></li>
                            <li><a href="comunity">Community</a></li>
                            <li><a href="profile">Profile</a></li>
                        </ul>
                    </div>
                </div>
                <div class="social-media">
                    <p class="footer-social-media">Social Media</p>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </footer>

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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ratingItems = document.querySelectorAll(".rating-item");

            ratingItems.forEach(item => {
                const rating = item.getAttribute("data-rating");
                const progress = item.querySelector(".progress");

                // Assuming the maximum rating is 5 for a percentage calculation
                const maxRating = 5;
                const widthPercentage = (rating / maxRating) * 100;

                progress.style.width = widthPercentage + "%";
            });
        });
    </script>
</body>

</html>
