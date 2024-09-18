<!-- resources/views/layouts/navbar-landingpage.blade.php -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap'); /* Using Montserrat font */

    /* General header styles */
    .header {
        background-color: #fff;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 10;
        font-family: 'Montserrat', sans-serif;
        border-bottom: 1px solid #5940CB;
    }

    /* Animating the logo */
    .header .logo img {
        height: 40px;
        margin-left: 20px;
        transition: transform 0.5s ease-in-out, filter 0.5s ease-in-out; /* Smooth transition */
    }

    /* Logo hover effect with a slight bounce and glow */
    .header .logo img:hover {
        transform: scale(1.1) rotate(360deg); /* Slight scaling and rotation */
        filter: drop-shadow(0 0 10px #5940CB); /* Glow effect */
    }

    /* Navbar Menu */
    .navbar {
        display: flex;
        gap: 30px;
        align-items: center;
        font-weight: 500;
        font-size: 1rem;
        color: #333;
        margin: 0 auto;
    }

    .navbar a {
        color: #333;
        text-decoration: none;
        padding: 10px 15px;
        position: relative;
        transition: color 0.3s ease;
    }

    /* Hover effect with underline animation */
    .navbar a::after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        background: #5940CB;
        transition: width 0.3s ease;
        position: absolute;
        left: 0;
        bottom: -5px;
    }

    .navbar a:hover::after {
        width: 100%;
    }

    .navbar a:hover {
        color: #5940CB;
    }

    /* Add a subtle border on the right */
    .navbar a:not(:last-child) {
        border-right: 1px solid #eaeaea;
    }

    /* Search Icon */
    .search-icon {
        position: relative;
        margin-right: 20px;
    }

    /* Search Input Field */
    .search-icon input {
        width: 0;
        opacity: 0;
        border: none;
        border-radius: 20px;
        padding: 5px 10px;
        outline: none;
        transition: width 0.5s ease, opacity 0.5s ease;
    }

    .search-icon:hover input {
        width: 150px; /* Expand input field when hovered */
        opacity: 1;
        border: 1px solid #5940CB; /* Add border */
    }

    /* Search Icon Styles */
    .search-icon i {
        color: #333;
        font-size: 1.2rem;
        cursor: pointer;
        transition: transform 0.3s ease, color 0.3s ease; /* Smooth transition */
    }

    /* Search Icon hover effect with animation */
    .search-icon:hover i {
        color: #5940CB;
        transform: scale(1.2) rotate(15deg); /* Scale and rotate the icon */
    }

    /* Centering logo and navbar items */
    .nav-wrapper {
        display: flex;
        justify-content: center;
        flex-grow: 1;
    }

    /* Styles for the login button */
    .login-btn {
        background-color: #5940CB;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        font-size: 1rem;
        font-family: 'Montserrat', sans-serif;
        cursor: pointer;
        text-decoration: none; /* Remove underline */
        transition: transform 0.3s ease, background-color 0.3s ease; /* Smooth transform on hover */
    }

    .login-btn:hover {
        transform: scale(1.1); /* Grow on hover */
        background-color: #4829a0; /* Keep the same color */
        color: white; /* Keep text color the same */
    }

    .login-btn:focus,
    .login-btn:active {
        outline: none; /* Remove outline on click */
        background-color: #5940CB; /* Keep the same background color */
        color: white; /* Keep text color the same */
    }
</style>

<div class="header">
    <!-- Logo -->
    <div class="logo">
        <img src="images/imm.png" alt="IMM Logo">
    </div>

    <!-- Navbar Menu -->
    <div class="nav-wrapper">
        <div class="navbar">
            <a href="{{ route('companies.list') }}">Companies</a>
            <a href="{{ route('investors.index') }}">Investors</a>
            <a href="{{ route('people.index') }}">People</a>
            <a href="{{ route('hubs.index') }}">Hubs</a>
            <a href="{{ route('home') }}">IMM</a>
        </div>
    </div>

    <!-- Search Icon with expanding input field -->
    <div class="search-icon">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search...">
    </div>

    <!-- Log In Button -->
    <a href="{{ route('login') }}" class="login-btn">Log In</a>
</div>

<!-- Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
