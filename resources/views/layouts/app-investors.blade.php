<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    /* Header styling */
    .header {
        background-color: #5940CB; /* Using existing palette */
        color: white;
        padding: 10px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header .logo img {
        height: 50px;
    }

    .header .tagline h5 {
        font-weight: bold;
        font-size: 18px;
        background: linear-gradient(90deg, #d9fa07, black); /* Gradient from palette */
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-fill-color: transparent;
    }

    /* Form container styling */
    .form-container {
        background-color: white;
        padding: 40px;
        margin: 50px auto;
        width: 80%;
        max-width: 800px;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Form input styling */
    .form-control {
        border-radius: 30px;
        padding: 15px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease-in-out;
    }

    .form-control:focus {
        border-color: #5940CB; /* Using palette */
        box-shadow: 0 0 5px rgba(89, 64, 203, 0.5);
    }

    label.form-label {
        color: #333;
        font-weight: bold;
    }

    /* Button styling */
    .btn-primary {
        background-color: #ff9f0a; /* Using palette */
        border: none;
        border-radius: 30px;
        padding: 15px 30px;
        font-size: 1.1rem;
        font-weight: bold;
        width: 100%;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #ff7a00; /* Lighter shade on hover */
    }

</style>
<body>

    <!-- Header -->
    <div class="header">
        <div class="logo">
            <!-- Logo Link to Home Page -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('images/imm.png') }}" alt="IMM LOGO">
            </a>
        </div>
        <div class="tagline">
            <h5>Empowering Innovation, Measuring Impact</h5>
        </div>
    </div>

    <!-- Content Section -->
    <div class="container mt-4">
        @yield('content') <!-- Dynamic content goes here -->
    </div>

    <!-- Include Bootstrap JS for better interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
