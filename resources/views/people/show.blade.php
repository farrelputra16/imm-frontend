@extends('layouts.app-landingpage')

<!-- Styles -->
<style>
    /* Desain sesuai dengan yang Anda minta */
    body {
        font-family: Arial, sans-serif;
    }

    .breadcrumb {
        background-color: white;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }

    .mentor-profile-title {
        color: #6c63ff;
        font-size: 2rem;
        font-weight: bold;
    }

    .profile-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    .profile-card img {
        border-radius: 10px;
    }

    .profile-card .name {
        font-size: 2rem;
        font-weight: bold;
    }

    .profile-card .designation {
        color: #8bc34a;
        font-size: 1.2rem;
    }

    .profile-card .rating {
        color: #ff9800;
    }

    .profile-card .tags span {
        background-color: #e0e0e0;
        border-radius: 5px;
        padding: 5px 10px;
        margin-right: 5px;
        font-size: 0.9rem;
    }

    .document-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
    }

    .document-card i {
        font-size: 3rem;
        margin-bottom: 10px;
    }

    .document-card .title {
        font-size: 1.2rem;
        font-weight: bold;
    }

</style>

@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">
                    Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('people.index') }}">
                    Find Mentor
                </a>
            </li>
            <li aria-current="page" class="breadcrumb-item active">
                Mentor Profile
            </li>
        </ol>
    </nav>

    <h1 class="mentor-profile-title">
        Mentor Profile
    </h1>

    <div class="profile-card p-4 bg-white">
        <div class="row">
            <div class="col-md-2">
                <img alt="Lion Bird Logo" class="img-profile" height="100" src="https://storage.googleapis.com/a1aa/image/fyw9SmXxl0xeDEL8arxfQGnTTeSkf2JUwLRrYRLWQ7lVXPicC.jpg" width="100"/>
            </div>
            <div class="col-md-10">
                <div class="name">
                    {{ $people->name }}
                </div>
                <div class="designation">
                    {{ $people->role }}
                </div>
                <div class="rating">
                    4.5
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                    (120 Reviews)
                </div>
                <div class="tags mt-2">
                    <span>Utilities</span>
                    <span>Health Care</span>
                    <span>IT</span>
                    <span>Manufacturing</span>
                    <span>Education</span>
                    <span>Finance</span>
                </div>
                <p class="mt-3">
                    {{ $people->description }}
                </p>
                <div class="contact-info mt-3">
                    <p>
                        <i class="fas fa-phone-alt"></i>
                        {{ $people->phone_number }}
                    </p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $people->location }}
                    </p>
                    <p>
                        @if($people->linkedin_link)
                            <a href="{{ $people->linkedin_link }}" target="_blank">
                                <i class="fab fa-linkedin"></i>  LinkedIn <!-- Ikon LinkedIn di sebelah kiri teks -->
                            </a>
                        @else
                            N/A
                        @endif
                    </p>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="document-card bg-white">
                <i class="fas fa-file-alt text-primary"></i>
                <div class="title">
                    Curiculum Vitae
                </div>
                <p>Cv Jane Cooper.pdf</p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="document-card bg-white">
                <i class="fas fa-file-alt text-danger"></i>
                <div class="title">
                    Portfolio
                </div>
                <p>Portfolio Jane Cooper.pdf</p>
            </div>
        </div>
    </div>
</div>
@endsection
