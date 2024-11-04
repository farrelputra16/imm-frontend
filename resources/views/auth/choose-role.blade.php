<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM Impact Mate</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
        }
        p {
            margin-top: 100px;
            font-size: 28px;
            color: #848484;
            font-family: sans-serif;
        }
        h2 {
            margin-top: 5px;
            font-size: 48px;
            color: #6256CA;
            font-family: sans-serif;
        }
        h3 {
            font-size: 32px;
            color: inherit; /* Menjaga warna default */
            text-decoration: none; /* Menghapus underline */
        }

        /* Menghapus efek hover pada h3 */
        a.role-card h3:hover {
            color: inherit; /* Tidak mengubah warna */
            text-decoration: none; /* Tetap tanpa underline */
        }

        /* Menghapus underline pada link dan menghapus perubahan warna saat hover */
        a {
            text-decoration: none;
            color: inherit; /* Warna default, tidak berubah saat hover */
        }

        /* Nonaktifkan perubahan warna saat hover pada tautan */
        a:hover {
            color: inherit; /* Tidak berubah warna */
        }

        .role-card {
            background-color: #6256CA;
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            margin-left: 0px;
            margin-right: 0px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 183px; /* Tentukan ketinggian yang tetap */
            position: relative;
            overflow: visible; /* Allow icon to exceed the box */
            width: 306px; /* Lebar tetap untuk setiap card */
        }
        .role-card:hover {
            color: white;
            transform: translateY(-5px);
        }
        .role-card img.main-icon {
            width: 220px; /* Icon besar */
            height: 210px;
            position: absolute;
            left: 150px; /* Menonjol keluar dari kotak */
            top: -28px; /* Menonjol keluar dari kotak */
        }

        .small-icon-extra-roket{
            width: 47px;
            height: 77px;
            position: absolute;
            top: 30px;
            left: 170px;
        }
        .small-icon-extra-statistik{
            right: -50px;
            top: 40px;
            position: absolute;
            width: 54px;
            height: 54px;
        }
        .small-icon-extra-money{
            width: 56px;
            height: 47px;
            position: absolute;
            top: 65px;
            left: 165px;
        }
        .small-icon-extra-thunder{
            width: 44px;
            height: 47px;
            position: absolute;
            top: 53px;
            right: -25px;
        }
        .small-icon-extra-toa{
            width: 81px;
            height: 81px;
            position: absolute;
            top: 60px;
            left: 145px;
            transform: scaleX(-1);
        }
        .small-icon-extra-book{
            width: 58px;
            height: 52px;
            position: absolute;
            top: 70px;
            right: -52px;
        }
        .small-icon-extra-folder{
            width: 66px;
            height: 58px;
            position: absolute;
            top: 65px;
            left: 160px;
        }
        .small-icon-extra-calender{
            width: 76px;
            height: 71px;
            position: absolute;
            top: 55px;
            right: -60px;
        }

        .role-title {
            font-size: 1.5rem;
        }
        .sign-up {
            margin-top: 70px;
            font-size: 0.9rem;
        }
        .sign-up a {
            text-decoration: none;
            color: #512da8;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 0px; /* Jarak antar card, diubah menjadi lebih kecil */
        }

        /* Tombol Choose Role akan muncul saat hover */
        .choose-role-btn {
            background-color: #86D293;
            color: #3F3F46;
            font-size: 1rem;
            padding: 5px 5px;
            border-radius: 5px;
            display: none; /* Tersembunyi secara default */
            position: absolute;
            bottom: 10px;
            left: 20px;
        }

        /* Tampilkan tombol saat pointer hover di atas role-card */
        .role-card:hover .choose-role-btn {
            display: block;
        }

        /* Tambahkan keyframes untuk animasi melayang */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        @keyframes floatReverse {
            0% {
                transform: translateY(0px) scaleX(-1);
            }
            50% {
                transform: translateY(-10px) scaleX(-1);
            }
            100% {
                transform: translateY(0px) scaleX(-1);
            }
        }

        /* Terapkan animasi ke masing-masing icon */
        .small-icon-extra-roket {
            animation: float 3s ease-in-out infinite;
        }

        .small-icon-extra-statistik {
            animation: float 3.5s ease-in-out infinite;
        }

        .small-icon-extra-money {
            animation: float 4s ease-in-out infinite;
        }

        .small-icon-extra-thunder {
            animation: float 3.2s ease-in-out infinite;
        }

        .small-icon-extra-toa {
            animation: floatReverse 3.8s ease-in-out infinite;
        }

        .small-icon-extra-book {
            animation: float 3.3s ease-in-out infinite;
        }

        .small-icon-extra-folder {
            animation: float 3.6s ease-in-out infinite;
        }

        .small-icon-extra-calender {
            animation: float 4.2s ease-in-out infinite;
        }

        @media (max-width: 768px) {
            .col-md-6.d-flex.flex-column {
                align-items: center !important;
                padding-right: 0 !important;
                padding-left: 0 !important;
            }

            .row.justify-content-center {
                margin-right: 0;
                margin-left: 0;
            }

            .role-card {
                width: 90%; /* Mengatur lebar card menjadi 90% dari lebar container */
                max-width: 306px; /* Memastikan lebar maksimum tetap 306px */
                margin-left: auto;
                margin-right: auto;
            }

            .role-card img.main-icon {
                left: auto;
                right: -30px; /* Menyesuaikan posisi icon utama */
            }

            /* Menyesuaikan posisi icon-icon kecil */
            .small-icon-extra-roket,
            .small-icon-extra-money,
            .small-icon-extra-toa,
            .small-icon-extra-folder {
                left: auto;
                right: 120px;
            }

            .small-icon-extra-statistik,
            .small-icon-extra-thunder,
            .small-icon-extra-book,
            .small-icon-extra-calender {
                right: -30px;
            }
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <p>Welcome to IMM Impact Mate</p>
        <h2><b>Choose Your Role:</b></h2>
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex flex-column align-items-end" style="padding-right: 30px;">
                <!-- Investor Role -->
                <a href="/login" class="role-card">
                    <div class="role-info">
                        <h3 class="role-title"><b>Investor</b></h3>
                    </div>
                    <img src="images/register/investor.png" class="main-icon main-icon-extra" alt="Investor Icon">
                    <img src="images/register/mini-investor.png" class="small-icon-extra-money" alt="Small Left Icon">
                    <img src="images/register/mini-investor2.png" class="small-icon-extra-thunder" alt="Small Right Icon">
                    <span class="choose-role-btn">CHOOSE ROLE</span> <!-- Tombol muncul saat hover -->
                </a>
                <a href="/login" class="role-card">
                    <div class="role-info">
                        <h3 class="role-title"><b>Peoples</b></h3>
                    </div>
                    <img src="images/register/people.png" class="main-icon" alt="Mentor Icon">
                    <img src="images/register/mentor-left.png" class="small-icon-extra-toa" alt="Small Left Icon">
                    <img src="images/register/mentor-right.png" class="small-icon-extra-book" alt="Small Right Icon">
                    <span class="choose-role-btn">CHOOSE ROLE</span>
                </a>
            </div>

            <div class="col-md-6 d-flex flex-column align-items-start" style="padding-left: 30px;">
                <a href="/login" class="role-card">
                    <div class="role-info">
                        <h3 class="role-title"><b>StartUp<br>Founder</b></h3> <!-- Teks menjadi dua baris -->
                    </div>
                    <img src="images/register/startup-founder.png" class="main-icon" alt="Founder Icon">
                    <img src="images/register/startup-founder-left.svg" class="small-icon-extra-roket" alt="Small Left Icon">
                    <img src="images/register/startup-founder-right.png" class="small-icon-extra-statistik" alt="Small Right Icon">
                    <span class="choose-role-btn">CHOOSE ROLE</span>
                </a>

                <a href="/login" class="role-card">
                    <div class="role-info">
                        <h3 class="role-title"><b>Event<br>Organizer</b></h3> <!-- Teks menjadi dua baris -->
                    </div>
                    <img src="images/register/event-organizer.png" class="main-icon" alt="Event Organizer Icon">
                    <img src="images/register/event-left.png" class="small-icon-extra-folder" alt="Small Left Icon">
                    <img src="images/register/event-right.png" class="small-icon-extra-calender" alt="Small Right Icon">
                    <span class="choose-role-btn">CHOOSE ROLE</span>
                </a>
            </div>

            <!-- StartUp Founder Role -->
            <div class="col-md-5">

            </div>

            <!-- Mentor Role -->
            <div class="col-md-5">

            </div>

            <!-- Event Organizer Role -->
            <div class="col-md-5">

            </div>
        </div>
        <p class="sign-up">Don't have an account? <a href="register">Sign Up</a></p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
