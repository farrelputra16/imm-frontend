@extends('layouts.app-imm')
@section('title', 'Edit Profil')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/profile/profiledit.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
    font-family: Arial, sans-serif;
    list-style-type: none;
    text-decoration: none;
}

.profile-container {
    background-color: white;
    padding: 17px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 100%;
    position: relative;
}

.profile-container h1 {
    margin-top: 0;
    font-size: 24px;
}

.profile-container p {
    color: #777;
}

.profile-picture-container {
    position: relative;
    display: inline-block;
    margin: 20px 0;
}

.profile-picture-container img {
    border-radius: 50%;
    border: 5px solid #ddd;
    width: 150px;
    height: 150px;
    border: 7px solid #5940cb;
    background-size: cover;
}

.edit-icon {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background-color: #fff;
    border-radius: 50%;
    padding: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

.edit-icon i {
    color: #5940cb;
}

#file-input {
    display: none;
}

form {
    text-align: left;
}

.form-group {
    margin-bottom: 15px;
    text-align: left;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-group input {
    width: calc(102% - 9px);
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

.phone-input {
    display: flex;
    align-items: center;
}

.phone-input img {
    width: 24px;
    margin-right: 5px;
}

.phone-input span {
    margin-right: 5px;
}

.form-buttons {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.btn-save,
.btn-back {
    width: 154px;
    height: 42px;
    background-color: #5940cb;
    color: white;
    border-radius: 5px;
    font-size: 20px;
    font-weight: 500;
    border: none;
}


/* Navbar */


/* Media query for responsiveness */

@media only screen and (max-width: 768px) {
    .brand-info,
    .footer-links,
    .social-media {
        flex-basis: 100%;
        /* Set width to 100% on small screens */
        text-align: center;
    }
    .footer {
        background-color: #5940cb;
        color: #ffffff;
        padding: 48px 0;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
        left: 0%;
        border-top-left-radius: 60px;
        border-top-right-radius: 60px;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        z-index: 1000;
    }
    .social-media {
        margin-right: auto;
        position: absolute;
        top: 29px;
        right: 23px;
    }
    .social-media a {
        color: #ffffff;
        text-decoration: none;
        font-size: 20px;
        margin-left: 10px;
    }
    .footer-nav ul {
        list-style-type: none;
        padding: 0px;
        margin: 0;
        position: absolute;
        top: 30px;
        right: 86px;
    }
}




/* Menambahkan transisi pada navbar */

.navbar {
    transition: background-color 0.3s ease;
}

.navbar:hover {
    background-color: #e3e3e3;
}

.navbar-button {
    background-color: #000000;
    color: #ffffff;
    padding: 10px 20px;
    border-radius: 10px;
    border: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
    text-decoration: none;
    /* Menghapus underline pada teks tautan */
    display: inline-block;
    /* Membuat tautan tampil sebagai blok inline */
}

.navbar-button:hover {
    background-color: #333333;
}
</style>
@endsection

@section('content')
<form action="{{ route('profile.update', $user->id) }}" method="POST" id="profileForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="container d-flex justify-content-center">
    <div class="profile-container" style="margin-top:130px">
        <div class="text-left">
            <h1>Profile</h1>
            <p>Kelola pengaturan profil Anda</p>
        </div>
        <div class="profile-picture-container">
            <img src="{{ $user->img ? asset('images/' . $user->img) : asset('images/default_user.webp') }}" alt="Profile Picture">
            <div class="edit-icon">
                <i class="fas fa-edit"></i>
            </div>
            <input type="file" id="file-input" name="img" accept="image/*" style="display: none;">
        </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nama_depan">Nama Lengkap</label>
                        <input type="text" id="nama_depan" name="nama_depan" class="form-control" value="{{ $user->nama_depan }}">
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik" class="form-control" value="{{ $user->nik }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="negara">Negara</label>
                        <input type="text" id="negara" name="negara" class="form-control" value="{{ $user->negara }}">
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" id="provinsi" name="provinsi" class="form-control" value="{{ $user->provinsi }}">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <input type="text" id="alamat" name="alamat" class="form-control" value="{{ $user->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="telepon">Nomor Handphone</label>
                        <div class="phone-input">
                            <img src="https://flagcdn.com/id.svg" alt="ID Flag">
                            <span>(+62)</span>
                            <input type="number" id="telepon" name="telepon" class="form-control" value="{{ $user->telepon }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-buttons">
                <a href="{{ route('profile') }}"> <button type="button" class="btn-back">Kembali</button></a>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('.edit-icon').addEventListener('click', function() {
        document.getElementById('file-input').click();
    });

    document.getElementById('file-input').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            var img = document.querySelector('.profile-picture-container img');
            img.src = URL.createObjectURL(this.files[0]);
        }
    });
</script>
@endsection
    