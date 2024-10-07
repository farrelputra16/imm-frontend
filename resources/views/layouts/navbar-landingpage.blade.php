<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap'); /* Using Montserrat font */

    /* Scoped styles for the landing page navbar */
    .navbar-landingpage {
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

    .navbar-landingpage .logo img {
        height: 40px;
        margin-left: 20px;
        transition: transform 0.5s ease-in-out, filter 0.5s ease-in-out;
    }

    .navbar-landingpage .logo img:hover {
        transform: scale(1.1) rotate(360deg);
        filter: drop-shadow(0 0 10px #5940CB);
    }

    .navbar-landingpage .navbar {
        display: flex;
        gap: 30px;
        align-items: center;
        font-weight: 500;
        font-size: 1rem;
        color: #333;
        margin: 0 auto;
    }

    .navbar-landingpage .navbar a {
        color: #333;
        text-decoration: none;
        padding: 10px 15px;
        position: relative;
        transition: color 0.3s ease;
    }

    .navbar-landingpage .navbar a::after {
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

    .navbar-landingpage .navbar a:hover::after {
        width: 100%;
    }

    .navbar-landingpage .navbar a:hover {
        color: #5940CB;
    }

    .navbar-landingpage .notification-icon {
        font-size: 1.5rem;
        color: orange;
        margin-right: 20px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .navbar-landingpage .notification-icon:active {
        transform: scale(1.2);
    }

    .navbar-landingpage .login-btn, .navbar-landingpage .register-btn {
        background-color: transparent;
        color: #5940CB;
        border: 2px solid #5940CB;
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 1rem;
        font-family: 'Montserrat', sans-serif;
        cursor: pointer;
        text-decoration: none;
        transition: transform 0.3s ease, background-color 0.3s ease;
        display: flex;
        align-items: center;
    }

    .navbar-landingpage .login-btn:hover {
        background-color: #f5f5f5;
        color: #5940CB;
        transform: scale(1.05);
    }

    .navbar-landingpage .register-btn {
        background-color: #5940CB;
        color: white;
        margin-left: 10px;
    }

    .navbar-landingpage .register-btn:hover {
        background-color: #4829a0;
        transform: scale(1.05);
    }

    .navbar-landingpage .dropdown-menu-notifications {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        width: 250px;
    }

    .navbar-landingpage .dropdown-menu-notifications a {
        display: flex;
        padding: 10px;
        font-size: 0.9rem;
        border-bottom: 1px solid #f0f0f0;
        color: #333;
        text-decoration: none;
    }

    .navbar-landingpage .dropdown-menu-notifications a:hover {
        background-color: #f5f5f5;
    }

    .navbar-landingpage .dropdown-menu-notifications a:last-child {
        border-bottom: none;
    }

    .navbar-landingpage .notification-content {
        display: flex;
        flex-direction: column;
    }

    .navbar-landingpage .notification-time {
        font-size: 0.8rem;
        color: #999;
    }

    .navbar-landingpage .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .navbar-landingpage .ml-2 {
        color: black;
        margin-left: 10px;
    }

    .navbar-landingpage .navbar .dropdown-menu {
        background-color: #5940CB;
        border: none;
    }

    .navbar-landingpage .navbar .dropdown-menu .dropdown-item {
        color: #fff;
    }

    .navbar-landingpage .navbar .dropdown-menu .dropdown-item:hover {
        background-color: #4b0082;
    }
</style>

<div class="navbar-landingpage">
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

        <!-- Auth Section -->
        @guest
        <!-- Log In and Register Buttons -->
        <a href="{{ route('auth.choose-role') }}" class="login-btn ml-2">
            Log In
        </a>
        <a href="{{ route('register') }}" class="register-btn">Register</a>
        @endguest

        @auth
        <!-- User Profile Dropdown -->
        <div class="buton d-flex justify-content-center align-items-center">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- Profile Image -->
                        <img src="{{ Auth::user()->img ? asset('/images/' . Auth::user()->img) : asset('/images/default_user.webp') }}" alt="Profile Picture" class="profile-img">
                        <!-- User Name -->
                        <span class="ml-2">{{ Auth::user()->nama_depan }}</span>
                    </a>
                    <!-- Dropdown Menu -->
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('profile') }}">Profil Saya</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt"></i> Log Out
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
        @endauth
    </div>
</div>

<!-- Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

