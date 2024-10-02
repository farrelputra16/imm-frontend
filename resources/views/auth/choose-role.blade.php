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
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 150px; /* Tentukan ketinggian yang tetap */
            position: relative;
            overflow: visible; /* Allow icon to exceed the box */
        }
        .role-card:hover {
            color: white;
            transform: translateY(-5px);
        }
        .role-card img.main-icon {
            width: 190px; /* Icon besar */
            height: 180px;
            position: absolute;
            left: 160px; /* Menonjol keluar dari kotak */
        }
        .role-card img.small-icon {
            width: 40px;
            height: 40px;
            position: absolute;
        }
        .icon-left {
            left: 170px;
            top: 50px;
        }
        .icon-right {
            right: -40px;
            top: 50px;
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
        .col-md-5 {
            margin-left: 20px; /* Menambahkan jarak antar kotak */
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
    </style>
</head>
<body>
    <div class="container text-center">
        <p>Welcome to IMM Impact Mate</p>
        <h2><b>Choose Your Role:</b></h2>
        <div class="row justify-content-center">
            <!-- Investor Role -->
            <div class="col-md-5">
                <a href="/login" class="role-card">
                    <div class="role-info">
                        <h3 class="role-title"><b>Investor</b></h3>
                    </div>
                    <img src="images/register/investor.png" class="main-icon" alt="Investor Icon">
                    <img src="images/register/mini-investor.png" class="small-icon icon-left" alt="Small Left Icon">
                    <img src="images/register/mini-investor2.png" class="small-icon icon-right" alt="Small Right Icon">
                    <span class="choose-role-btn">CHOOSE ROLE</span> <!-- Tombol muncul saat hover -->
                </a>
            </div>

            <!-- StartUp Founder Role -->
            <div class="col-md-5">
                <a href="/login" class="role-card">
                    <div class="role-info">
                        <h3 class="role-title"><b>StartUp<br>Founder</b></h3> <!-- Teks menjadi dua baris -->
                    </div>
                    <img src="images/register/startup-founder.png" class="main-icon" alt="Founder Icon">
                    <img src="images/register/startup-founder-left.png" class="small-icon icon-left" alt="Small Left Icon">
                    <img src="images/register/startup-founder-right.png" class="small-icon icon-right" alt="Small Right Icon">
                    <span class="choose-role-btn">CHOOSE ROLE</span>
                </a>
            </div>

            <!-- Mentor Role -->
            <div class="col-md-5">
                <a href="/login" class="role-card">
                    <div class="role-info">
                        <h3 class="role-title"><b>Peoples</b></h3>
                    </div>
                    <img src="images/register/people.png" class="main-icon" alt="Mentor Icon">
                    <img src="images/register/mentor-left.png" class="small-icon icon-left" alt="Small Left Icon">
                    <img src="images/register/mentor-right.png" class="small-icon icon-right" alt="Small Right Icon">
                    <span class="choose-role-btn">CHOOSE ROLE</span>
                </a>
            </div>

            <!-- Event Organizer Role -->
            <div class="col-md-5">
                <a href="/login" class="role-card">
                    <div class="role-info">
                        <h3 class="role-title"><b>Event<br>Organizer</b></h3> <!-- Teks menjadi dua baris -->
                    </div>
                    <img src="images/register/event-organizer.png" class="main-icon" alt="Event Organizer Icon">
                    <img src="images/register/event-left.png" class="small-icon icon-left" alt="Small Left Icon">
                    <img src="images/register/event-right.png" class="small-icon icon-right" alt="Small Right Icon">
                    <span class="choose-role-btn">CHOOSE ROLE</span>
                </a>
            </div>
        </div>
        <p class="sign-up">Don't have an account? <a href="register">Sign Up</a></p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
