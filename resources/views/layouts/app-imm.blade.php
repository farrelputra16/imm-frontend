<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | @yield('title')</title>
    <link rel="icon" href="/images/imm.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/Settings/navbar.css') }}">
    <style>
        /* Layout Flexbox untuk Footer Sticky */
        html, body {
            height: 100%; /* Pastikan html dan body memiliki tinggi penuh */
            margin: 0; /* Menghapus margin default */
        }

        body {
            display: flex;
            flex-direction: column; /* Mengatur arah kolom */
        }

        .container {
            flex: 1; /* Membuat kontainer mengambil ruang yang tersedia */
            max-width: 1400px;
            margin: 0 auto;
        }

        .wrapper {
            flex: 1; /* Memastikan konten utama mengisi ruang di atas footer */
            padding-top: 20px;
            margin-bottom: 50px;
        }

        .footer {
            background-color: #0F1F3E;
            color: white;
            text-align: left;
            padding: 20px 0; /* Adjust padding for better spacing */
            border-radius: 20px 20px 0 0;
            font-size: 0.9rem; /* Smaller font size */
            bottom: 0;
            width: 100%;
            font-family: 'Poppins', sans-serif; /* Set font to Poppins */
        }

        .footer-text {
            font-size: 0.9rem; /* Smaller font size */
            margin: 0;
            font-family: 'Poppins', sans-serif; /* Set font to Poppins */
        }

        /* Tambahkan CSS untuk footer */
        .logo-footer {
            height: 50px;
        }
        .footer h1 {
            font-size: 1.5rem;
            font-weight: bold;
            font-family: 'Poppins', sans-serif; /* Set font to Poppins */
        }
        .footer p {
            font-size: 0.9375rem; /* 15px in rem */
            margin: 0;
            font-family: 'Poppins', sans-serif; /* Set font to Poppins */
        }

        .footer span {
            font-size: 1rem; /* 16px in rem */
            font-weight: bold;
            font-family: 'Poppins', sans-serif; /* Set font to Poppins */
            margin-right: 27px;
        }

        .social-media {
            margin-top: 10px;
        }
        .social-media i {
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .social-icon {
            color: white;
            font-size: 1.8rem; /* Reduce icon size */
            text-decoration: none;
        }

        .social-icon:hover {
            color: inherit; /* Remove hover effect */
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .footer-logo,
            .footer-text,
            .footer-social {
                text-align: center; /* Center-align on smaller screens */
            }

            .footer-social {
                padding-top: 15px; /* Adjust padding for smaller screens */
            }
        }
    </style>
    @yield('css')
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar-imm')

    <!-- Main Wrapper -->
    <div class="wrapper">
        <div class="container">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            @include('layouts.footer-landingpage')
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('js')
</body>
</html>
