<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | @yield('title')</title>
    <link rel="icon" href="/images/imm.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @yield('css')
    <style>
        html, body {
    height: 100%;
    margin: 0;
    display: flex;
    flex-direction: column;
}

.wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
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
        }/* Styles seperti yang sudah ada di file original */
    </style>
</head>

<body>
    @include('layouts.navbar-investors') <!-- Panggil Navbar -->

    <div class="wrapper">
        <div style="padding: 20px;">
            @yield('content')
        </div>
    </div>

    <footer>
        <div class="container">
            @include('layouts.footer-landingpage')
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
