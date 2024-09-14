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

    .header .logo img {
        height: 40px;
        margin-left: 20px;
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

    /* Minimal search icon on the right */
    .search-icon {
        color: #333;
        font-size: 1.2rem;
        cursor: pointer;
        margin-right: 20px;
    }

    /* Apple-like hover effect on the search icon */
    .search-icon:hover {
        color: #5940CB;
    }

    /* Centering logo and navbar items */
    .nav-wrapper {
        display: flex;
        justify-content: center;
        flex-grow: 1;
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
            <a href="#">Companies</a>
            <a href="#">Investors</a>
            <a href="#">Events</a>
            <a href="{{ route('home') }}">IMM</a>
        </div>
    </div>

    <!-- Search Icon -->
    <div class="search-icon">
        <i class="fas fa-search"></i>
    </div>
</div>

<!-- Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
