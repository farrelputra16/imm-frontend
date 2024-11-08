<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | @yield('title')</title>
    <link rel="icon" href="/images/imm.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-xxxxx" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield('css')
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
eperti yang sudah ada di file original */
    </style>
</head>

<body>
    <!-- Include Navbar -->
    @include('layouts.navbar-people')

    <div class="wrapper" style="padding-top: 60px;">
        @yield('content')
    </div>

    <!-- Include Footer -->
    @include('layouts.footer-people')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    @yield('js')
</body>

</html>
