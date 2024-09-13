@extends('layouts.app-imm')
@section('title', 'Profil')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/profile/profile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: "Roboto", sans-serif;
        text-decoration: none;
        list-style-type: none;
        /* Add padding to avoid content being hidden behind fixed navbar */
        background-color: #f8f9fa;
    }

    /* Menambahkan transisi pada navbar */
    /* Profile Section */
    .biodata {
        word-wrap: break-word;
        /* Membuat teks wrap otomatis */
        overflow-wrap: break-word;
        /* Alternatif lain untuk memastikan teks wrap */
        width: 100%;
        /* Menentukan lebar kontainer */
    }

    .section {
        margin-top: 80px;
        margin-bottom: 120px;
        display: flex;
        align-items: center;
        justify-content: start;
        background-color: #E6E3F1;
        padding: 20px 0;
        border-radius: 10px
    }

    .profile-section {
        max-width: 150px;
        border: 3px solid #6f42c1;
        padding: 5px;
        border-radius: 50%;
        transition: transform 0.3s;
    }

    .img-fluid {
        width: 200px;
        height: 200px;
    }

    .profile-section :hover {
        transform: scale(1.1);
    }

    .profile-section h2,
    .profile-section h3 {
        font-weight: bold;
    }

    .profile-section p {
        margin: 5px 10px;
    }

    .profile-section .btn {
        margin-top: 199px;
        transition: background-color 0.3s, color 0.3s;
    }

    .profile-section .btn:hover {
        background-color: #6f42c1;
        color: #ffffff;
    }




    .btn-primary {
        background-color: #6f42c1;
        border: none;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-primary:hover {
        background-color: #563d7c;
        color: #ffffff;
    }

    /* Media Queries for Responsive Design */
    @media (max-width: 768px) {
        .section {
            flex-direction: column;
            align-items: center;
            justify-content: center;
            display: flex;
            text-align: center;
        }

        .profile-section {
            margin-bottom: 20px;
        }
.bio{
    
}
        .biodata {
       display: flex;
       flex-direction: column; align-content: center
            text-align: center;
            width: 70%;
            margin-left: 55px;
            margin-top: 10px;
            padding: 20px 0;
        }
        .img-fluid {
        width: 100px;
        height: 100px;
    }
    }
</style>
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <div class="row section">
        <div class="col-md-4 text-center">
            <img src="{{ $user->img ? asset('images/' . $user->img) : asset('images/default_user.webp') }}" class="rounded-circle img-fluid" alt="Profile Picture">
        </div>
        <div class="col-md-4 bio">
            <div class="biodata">
                <h2 class="mb-3"> {{$user->nama_depan}} </h2>
                <p><i class="fas fa-phone"> {{$user->telepon}}</i></p>
                <p><i class="fas fa-envelope"></i> {{$user->email}}</p>
                <span><i class="fas fa-map-marker-alt"></i> {{$user->alamat}} </span> <br>
                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary mt-3">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>


@endsection
