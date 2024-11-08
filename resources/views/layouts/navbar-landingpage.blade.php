<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <style>

.navbar-landingpage .navbar {
    display: flex;
    gap: 20px; /* Tambahkan jarak antar link navbar */
    align-items: center;
    font-weight: 500;
    font-size: 1rem;
    color: #333;
}

        .navbar-landingpage {
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-family: 'Montserrat', sans-serif;
            border-bottom: 1px solid #5940CB;
        }

        .navbar-landingpage .logo img {
            height: 40px;
            transition: transform 0.5s ease-in-out, filter 0.5s ease-in-out;
        }

        .navbar-landingpage .logo img:hover {
            transform: scale(1.1) rotate(360deg);
            filter: drop-shadow(0 0 10px #5940CB);
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
            color: #5940CB;
            border: 2px solid #5940CB;
            padding: 8px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .navbar-landingpage .register-btn {
            background-color: #5940CB;
            color: white;
        }

        .navbar-landingpage .login-btn:hover {
            background-color: #f5f5f5;
        }

        .navbar-landingpage .register-btn:hover {
            background-color: #4829a0;
        }

        .navbar-landingpage .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        /* Warna kuning untuk ikon notifikasi */
        .notification-icon {
            font-size: 1.5rem;
            color: #FFD700;
            cursor: pointer;
            margin-right: 20px;
        }

        .ml-2 {
            color: gray;
        }
    </style>
</head>
<body>
<div class="navbar-landingpage">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo Section -->
            <div class="col-md-auto logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/imm.png') }}" alt="IMM Logo">
                </a>
            </div>

            <!-- Navbar Links Section (di sebelah kanan logo) -->
            <div class="col-md d-flex align-items-center">
                <div class="navbar">
                    <a href="/">Homepage</a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opportunities</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('investors.index') }}" class="dropdown-item">Find Investor</a>
                            <a href="{{ route('companies.list') }}" class="dropdown-item">Find Company</a>
                            <a href="{{ route('funding_rounds.index') }}" class="dropdown-item">Funding Rounds</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Performance</a>
                        <div class="dropdown-menu">
                            @if(Auth::check())
                                @php $role = Auth::user()->role; @endphp
                                <a href="{{ route($role == 'USER' ? 'home' : strtolower($role) . '.home') }}" class="dropdown-item">IMM</a>
                            @else
                                <a href="{{ route('home') }}" class="dropdown-item">IMM</a>
                            @endif
                            <a href="#" class="dropdown-item">Benchmarking</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Networks</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('people.index') }}" class="dropdown-item">Find Mentor</a>
                            <a href="{{ route('hubs.index') }}" class="dropdown-item">Innovation Hub</a>
                            <a href="{{ route('events.index') }}" class="dropdown-item">Events</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification and Auth Section -->
            <div class="col-md-auto d-flex justify-content-end align-items-center">
                <!-- Notification Dropdown dengan ikon kuning -->
                <div class="dropdown notification-dropdown">
                    <i class="fas fa-bell notification-icon" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <div class="notification-content">
                                <strong>New Message</strong>
                                <span class="notification-time">2 minutes ago</span>
                            </div>
                        </a>
                        <a href="#" class="dropdown-item">
                            <div class="notification-content">
                                <strong>New Event Added</strong>
                                <span class="notification-time">1 hour ago</span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Authentication Links -->
                @guest
                <a href="{{ route('auth.choose-role') }}" class="login-btn ml-2">Log In</a>
                <a href="{{ route('register') }}" class="register-btn ml-3">Register</a>

                @endguest

                @auth
                    <!-- User Profile Dropdown -->
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->img ? asset('/images/' . Auth::user()->img) : asset('/images/default_user.webp') }}" alt="Profile Picture" class="profile-img">
                            <span class="ml-2 text-uppercase">{{ Auth::user()->nama_depan }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('profile') }}">Profil Saya</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>
</body>
</html>
