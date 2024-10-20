<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
    @yield('css')
    <style>
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
        }

        .footer {
            background-color: #0F1F3E;
            color: white;
            padding: 20px 0; /* Adjust padding for better spacing */
            border-radius: 50px 50px 0 0;
            font-size: 0.9rem; /* Smaller font size */
        }

        /* Tambahkan CSS untuk footer */
        footer {
            margin-top: auto; /* Memastikan footer berada di bawah */
        }

        .footer-logo img {
            height: 50px; /* Adjust logo size */
        }

        .footer-text {
            font-size: 0.9rem; /* Reduce text size */
            line-height: 1.4;
            margin-top: 10px;
        }

        .footer-social {
            text-align: center;
            padding-top: 10px; /* Adjust padding */
        }

        .social-icon {
            color: white;
            font-size: 1.8rem; /* Reduce icon size */
            margin: 0 10px; /* Equal spacing between icons */
            text-decoration: none;
        }

        .social-icon:hover {
            color: #d9fa07; /* Hover effect */
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
</head>
<body>
    @include('layouts.navbar-landingpage')

    <div class="container mt-4 mb-5">
        @yield('content')
    </div>

    <footer>
        <div class="container">
            @include('layouts.footer-landingpage')
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
