<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | @yield('title')</title>
    <link rel="icon" href="/images/imm.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    @yield('css')
</head>
<style>

    .footer {
    background-color: #0F1F3E;
    color: white;
    padding: 20px 0;
    border-radius: 50px 50px 0 0;
    font-size: 0.9rem;
    /* Align items to center */
    display: flex;
    justify-content: center;
}

.footer-logo img {
    height: 50px;
    margin-bottom: 10px;
}

.footer-text {
    font-size: 0.9rem;
    line-height: 1.4;
    margin-top: 10px;
}

.footer-social {
    padding-top: 10px;
}

.social-icon {
    color: white;
    font-size: 1.8rem;
    margin: 0 10px;
    text-decoration: none;
    transition: color 0.3s ease;
}

.social-icon:hover {
    color: #d9fa07;
}

@media (max-width: 768px) {
    .footer-logo,
    .footer-text,
    .footer-social {
        text-align: center;
    }

    .footer-social {
        padding-top: 15px;
    }
}
</style>
<body>
    @include('layouts.navbar-imm') <!-- Include Navbar -->

    <div class="wrapper" style="padding-top: 20px;"> <!-- Add padding to avoid overlap -->
        <div style="padding: 20px;">
            @yield('content')
        </div>
    </div>

    <footer>
        <div class="container">
            @include('layouts.footer-landingpage')
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
