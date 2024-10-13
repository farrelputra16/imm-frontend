<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IMM | Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN for social media icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @stack('styles')

    <style>
        /* Ensure the body takes up the full height */
        html, body {
            height: 100%;
            margin: 0;
        }

        /* Flexbox container to keep footer at the bottom */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Add margin-top to content to create space between navbar and content */
        .container {
            flex: 1;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px;
            padding-bottom: 0px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbar-landingpage')

    <!-- Main content wrapper with Bootstrap grid system and margin-top -->
    <div class="container mt-4 flex-grow-1">
        <div class="row">
            <div class="col-12">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-4">
        <div class="container">
            @include('layouts.footer-landingpage')
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
