<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | @yield('title')</title>
    <link rel="icon" href="/images/imm.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/Settings/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Settings/navbar.css') }}">
    <style>
        /* Layout Flexbox untuk Footer Sticky */
        body, html {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        .wrapper {
            flex: 1; /* Memastikan konten utama mengisi ruang di atas footer */
            padding-top: 20px;
            margin-bottom: 50px;
        }
        footer {
            /* Optional: memberi warna background atau padding di footer */
            background-color: #f8f9fa;
            margin-top: auto; /* Letakkan footer di bagian bawah layar */
            margin-bottom: 0;
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
