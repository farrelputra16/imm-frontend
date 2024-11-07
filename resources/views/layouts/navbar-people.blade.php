<style>
    .navbar {
        background-color: #ffffff;
        padding: 10px 0;
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1000;
        border-bottom: 1px solid #5940cb;
    }

    .navbar-brand {
        font-size: 20px;
        font-weight: bold;
    }

    .nav-item {
        margin-right: 10px;
    }

    .nav-link {
        color: gray;
        text-decoration: none;
        padding: 10px 15px;
        position: relative;
        transition: color 0.3s ease;
    }

    .nav-link::after {
        content: '';
        display: block;
        width: 0;
        height: 2px;
        background: #5940cb;
        transition: width 0.3s ease;
        position: absolute;
        left: 0;
        bottom: -5px;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .nav-link:hover {
        color: #5940cb;
    }

    .profile-img {
        width: 30px;
        height: 30px;
        border-radius: 50%;
    }

    .dropdown-menu {
        background-color: #5940cb;
        border: none;
    }

    .dropdown-menu .dropdown-item {
        color: #fff;
    }

    .dropdown-menu .dropdown-item:hover {
        background-color: #4b0082;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/images/imm.png" width="100" height="55" alt="IMM Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('people.profile') ? 'active' : '' }}" href="{{ route('people.profile') }}">Homepage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('people.home') ? 'active' : '' }}" href="{{ route('people.home') }}">Job</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('hubs.create.hubsubmission') ? 'active' : '' }}" href="{{ route('hubs.create.hubsubmission') }}">Daftarkan Hubs</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                @guest
                    <a class="btn btn-masukk" href="{{ route('login') }}">Masuk</a>
                    <a class="btn btn-daftarr" href="{{ route('register') }}">Daftar</a>
                @else
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                            role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ Auth::user()->img ? asset('/images/' . Auth::user()->img) : asset('/images/default_user.webp') }}"
                                 alt="Profile Picture" class="profile-img">
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
</nav>
