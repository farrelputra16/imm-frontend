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

    /* Notification Icon */
    .notification-icon {
        font-size: 1.5rem;
        color: orange; /* Set the notification icon color to orange */
        margin-right: 20px; /* Slight spacing to the left of the login button */
        cursor: pointer; /* Show pointer when hovering over the notification icon */
        transition: transform 0.2s ease; /* Smooth transform */
    }

    /* Notification Icon Click (slightly larger) */
    .notification-icon:active {
        transform: scale(1.2); /* Grow slightly on click */
    }

    /* Styles for the login and register buttons */
    .login-btn, .register-btn {
        background-color: transparent;
        color: #5940CB;
        border: 2px solid #5940CB;
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 1rem;
        font-family: 'Montserrat', sans-serif;
        cursor: pointer;
        text-decoration: none; /* Remove underline */
        transition: transform 0.3s ease, background-color 0.3s ease; /* Smooth transform on hover */
        display: flex;
        align-items: center;
    }

    .login-btn:hover {
        background-color: #f5f5f5;
        color: #5940CB;
        transform: scale(1.05);
    }

    .register-btn {
        background-color: #5940CB;
        color: white;
        margin-left: 10px;
    }

    .register-btn:hover {
        background-color: #4829a0;
        transform: scale(1.05);
    }

    /* Dropdown Menu for Notifications */
    .dropdown-menu-notifications {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        width: 250px;
    }

    .dropdown-menu-notifications a {
        display: flex;
        padding: 10px;
        font-size: 0.9rem;
        border-bottom: 1px solid #f0f0f0;
        color: #333;
        text-decoration: none;
    }

    .dropdown-menu-notifications a:hover {
        background-color: #f5f5f5;
    }

    .dropdown-menu-notifications a:last-child {
        border-bottom: none;
    }

    .notification-content {
        display: flex;
        flex-direction: column;
    }

    .notification-time {
        font-size: 0.8rem;
        color: #999;
    }

    /* Profile Image */
    .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .ml-2 {
        color: black;
        margin-left: 10px;
    }

    /* Profile Dropdown */
    .navbar .dropdown-menu {
        background-color: #5940CB;
        border: none;
    }

    .navbar .dropdown-menu .dropdown-item {
        color: #fff;
    }

    .navbar .dropdown-menu .dropdown-item:hover {
        background-color: #4b0082;
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
            <a href="{{ route('events.index') }}">Events</a>
            <a href="{{ route('home') }}">IMM</a>
        </div>
    </div>

    <!-- Notification and Auth Section -->
    <div class="d-flex align-items-center">
        <!-- Notification Dropdown -->
        <div class="dropdown">
            <i class="fas fa-bell notification-icon" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-notifications" aria-labelledby="notificationDropdown">
                <!-- Dummy Notification Items -->
                <a href="#">
                    <div class="notification-content">
                        <strong>New Message</strong>
                        <span class="notification-time">2 minutes ago</span>
                    </div>
                </a>
                <a href="#">
                    <div class="notification-content">
                        <strong>New Event Added</strong>
                        <span class="notification-time">1 hour ago</span>
                    </div>
                </a>
                <a href="#">
                    <div class="notification-content">
                        <strong>Investment Opportunity</strong>
                        <span class="notification-time">1 day ago</span>
                    </div>
                </a>
            </div>
        </div>

        <!-- Log In and Register Buttons -->
        <a href="{{ route('auth.choose-role') }}" class="login-btn ml-3">
            Log In
        </a>
        <a href="{{ route('register') }}" class="register-btn">Register</a>
    </div>
</div>

<!-- Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<!-- Full version of jQuery (not slim) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
