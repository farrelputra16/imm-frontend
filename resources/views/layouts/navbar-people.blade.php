<!-- Navbar with Updated Design -->
<style>
    .navbar-landingpage {
        background-color: #ffffff;
        padding: 10px 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        font-family: 'Montserrat', sans-serif;
        border-bottom: 1px solid #6256CA;
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1000;
    }

    .navbar-landingpage .navbar-brand {
        font-size: 20px;
        font-weight: bold;
        margin-right: 20px;
    }

    .navbar-landingpage .navbar {
        display: flex;
        gap: 20px;
        align-items: center;
        font-weight: 500;
        font-size: 1rem;
        color: #333;
    }

    .navbar-landingpage .logo img {
        height: 40px;
        transition: transform 0.5s ease-in-out, filter 0.5s ease-in-out;
    }

    .navbar-landingpage .logo img:hover {
        transform: scale(1.1) rotate(360deg);
        filter: drop-shadow(0 0 10px #6256CA);
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
        background: #6256CA;
        transition: width 0.3s ease;
        position: absolute;
        left: 0;
        bottom: -5px;
    }

    .navbar-landingpage .navbar a:hover::after {
        width: 100%;
    }

    .navbar-landingpage .navbar a:hover {
        color: #6256CA;
    }

    .navbar-landingpage .dropdown-menu {
        background-color: #fff;
        border-radius: 5px;
        border: none;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    .navbar-landingpage .dropdown-menu a:hover {
        background-color: #f0f0f0;
    }

    .navbar-landingpage .login-btn,
    .navbar-landingpage .register-btn {
        background-color: transparent;
        color: #6256CA;
        border: 2px solid #6256CA;
        padding: 8px 20px;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .navbar-landingpage .register-btn {
        background-color: #6256CA;
        color: white;
    }

    .navbar-landingpage .login-btn:hover {
        background-color: #f5f5f5;
    }

    .navbar-landingpage .register-btn:hover {
        background-color: #6256CA;
    }

    .navbar-landingpage .profile-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    /* Notification Icon Styling */
    .notification-icon {
        font-size: 1.5rem;
        color: #FFD700; /* Yellow color for notification icon */
        cursor: pointer;
        margin-right: 20px;
    }

    /* Gray color for Profile Name */
    .ml-2 {
        color: gray;
    }
</style>

<div class="navbar-landingpage">
    <div class="container">
        <div class="d-flex align-items-center">
            <!-- Logo and Navbar Links Section -->
            <a class="navbar-brand logo" href="/">
                <img src="/images/imm.png" alt="IMM Logo">
            </a>

            <!-- Navbar Links (aligned to the right of logo) -->
            <div class="navbar d-flex align-items-center">
                <a href="{{ route('people.profile') }}" class="{{ Request::is('people.profile') ? 'active' : '' }}">Homepage</a>
                <a href="{{ route('people.home') }}" class="{{ Request::is('people.home') ? 'active' : '' }}">Job</a>
                <a href="{{ route('hubs.create.hubsubmission') }}" class="{{ Request::is('hubs.create.hubsubmission') ? 'active' : '' }}">Daftarkan Hubs</a>
            </div>

            <!-- Auth and Notification Section -->
            <div class="d-flex align-items-center ml-auto">
                <!-- Notifications Icon -->
                <div class="dropdown notification-dropdown">
                    <i class="fas fa-bell notification-icon" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <strong>New Message</strong><br><span class="notification-time">2 minutes ago</span>
                        </a>
                        <a href="#" class="dropdown-item">
                            <strong>New Event Added</strong><br><span class="notification-time">1 hour ago</span>
                        </a>
                    </div>
                </div>

                @guest
                    <a href="{{ route('login') }}" class="login-btn ml-2">Masuk</a>
                    <a href="{{ route('register') }}" class="register-btn ml-3">Daftar</a>
                @else
                    <!-- User Dropdown -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->img ? asset('/images/' . Auth::user()->img) : asset('/images/default_user.webp') }}" alt="Profile Picture" class="profile-img">
                            <span class="ml-2 text-uppercase">{{ Auth::user()->nama_depan }} {{ Auth::user()->nama_belakang }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('people.profile') }}">Profil Saya</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</div>
