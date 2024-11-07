<style>
    .footer {
        background-color: #5940cb;
        color: #ffffff;
        text-align: center;
        border-top-left-radius: 40px;
        border-top-right-radius: 40px;
        width: 100%;
        height: 167px;
    }

    .footer ul {
        list-style-type: none;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 15px;
        margin-top: 30px;
    }

    .footer ul li {
        color: #fff;
        font-size: 12px;
    }

    .span-footer {
        font-size: 15px;
        font-weight: bold;
        color: #fff;
    }

    .sosmed {
        gap: 15px;
    }

    .sosmed a {
        color: #fff;
    }
</style>

<footer class="footer mt-5 d-flex justify-content-center align-items-center">
    <div class="container d-flex justify-content-between">
        <div class="col-4 d-flex flex-column" style="gap: 20px">
            <a href="/home" class="d-flex justify-content-start">
                <img src="/images/imm.png" width="100" height="55" alt="IMM Logo">
            </a>
            <span class="span-footer text-left">Impact Measurement and Management <br>(TBN INDONESIA X MAXY ACADEMY)</span>
        </div>
        <div class="col-6 d-flex justify-content-center align-items-center">
            <ul class="d-flex">
                @if (Auth::check() && Auth::user()->companies)
                    <li><a class="text-white" href="{{ route('homepage') }}">Beranda</a></li>
                    <li><a class="text-white" href="{{ route('myproject.myproject') }}">Proyek Saya</a></li>
                    <li><a class="text-white" href="/event">Event</a></li>
                    <li><a class="text-white" href="/blog">Artikel</a></li>
                    <li><a class="text-white" href="{{ route('profile-company') }}">Perusahaan Saya</a></li>
                @else
                    <li><a class="text-white" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="text-white" href="{{ route('homepage') }}">Proyek Saya</a></li>
                    <li><a class="text-white" href="/event">Event</a></li>
                    <li><a class="text-white" href="/blog">Artikel</a></li>
                    <li><a class="text-white" href="{{ route('profile-company') }}">Perusahaan Saya</a></li>
                @endif
            </ul>
        </div>
        <div class="col-2 d-flex flex-column justify-content-center">
            <span class="span-footer text-center">Sosial Media</span>
            <div class="sosmed d-flex justify-content-center">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/imm.bootcamp"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</footer>
