<nav class="navbar-landingpage">
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo Section -->
            <div class="col-md-auto logo">
                <a href="/">
                    <img src="{{ asset('images/imm.png') }}" alt="IMM Logo">
                </a>
            </div>

            <!-- Navbar Links Section (di sebelah kanan logo) -->
            <div class="col-md d-flex align-items-center">
                <div class="navbar">
                    <a href="{{ route('homepage') }}">Homepage</a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Project</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('myproject.myproject') }}" class="dropdown-item">Projects</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Company</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('profile-company') }}" class="dropdown-item">Profile Company</a>
                            <a href="{{ route('investments.approvals') }}" class="dropdown-item">Investor List</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opportunities</a>
                        <div class="dropdown-menu">
                            <!-- Link ke halaman Find Investor -->
                            <a href="{{ route('investors.index') }}" class="dropdown-item">Find Investor</a>
                            
                            <!-- Link ke halaman Funding Rounds -->
                            <a href="{{ route('company.funding_rounds.list') }}" class="dropdown-item">Funding Rounds</a>
                        
                            <!-- Link ke halaman Collaboration Index -->
                            <a href="{{ route('collaboration.index') }}" class="dropdown-item">Collaboration</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Events & Innovation</a>
                        <div class="dropdown-menu">
                            <a href="{{ route('hubs.create.hubsubmission') }}" class="dropdown-item">Hubs</a>
                            <a href="{{ route('events.index') }}" class="dropdown-item">Events</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notification and Auth Section -->
            <div class="col-md-auto d-flex justify-content-end align-items-center">
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

                @guest
                    <a href="{{ route('auth.choose-role') }}" class="login-btn ml-2">Log In</a>
                    <a href="{{ route('register') }}" class="register-btn">Register</a>
                @endguest

                @auth
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->img ? asset('/images/' . Auth::user()->img) : asset('/images/default_user.webp') }}" alt="Profile Picture" class="profile-img">
                            <span class="ml-2 text-uppercase">{{ Auth::user()->nama_depan }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right ```blade
                        " aria-labelledby="navbarDropdownMenuLink">
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
</nav>
