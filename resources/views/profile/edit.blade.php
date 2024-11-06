@extends('layouts.app-imm')
@section('title', 'Edit Profil')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/profile/profiledit.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<!-- Di bagian head -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
    body {
    font-family: Arial, sans-serif;
    list-style-type: none;
    text-decoration: none;
}
.profile-container-wrapper {
    display: flex;
    align-items: center;
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
    display: flex; /* Ubah dari inline-block menjadi flex */
    justify-content: flex-start; /* Pastikan konten berada di kiri */
    align-items: center; /* Menjaga agar gambar tetap di tengah secara vertikal */
    margin: 20px 0;
}

.profile-picture-container img {
    border-radius: 50%;
    width: 313px;
    height: 313px;
    background-size: cover;
}

.edit-icon {
    position: absolute;
    bottom: 10px;
    left: 240px;
    width: 63px;
    height: 63px;
    background-color: #fff;
    border-radius: 50%;
    padding: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

.edit-icon i {
    font-size: 45px;
    align-content: center;
    vertical-align: middle;
    margin-left: 4px;
    margin-top: 2px;
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

.btn-save{
    width: 144px;
    height: 40px;
    background-color: #5940cb;
    color: white;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    border: none;
    margin-left: 35px;
    margin-right: 12px;
}
.btn-back{
    width: 144px;
    height: 40px;
    background-color: #EFEEFA;
    color: black;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
    border: none;
}

.custom-input {
    border: 2px solid #6256CA;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
}

.input-form{
    margin-bottom: 23px;
}

 /* Select 2  styles */
 .select2-container--default .select2-selection--single {
    height: 45px;
    border: 1px solid #ced4da;
    border-radius: 6px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 36px;
    padding-left: 12px;
    padding-top: 5px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 45px;
    padding-top: 5px;
    padding-right: 10px;
}

.select2-container--default .select2-search--dropdown .select2-search__field {
    padding: 8px;
    border: 1px solid #ced4da;
}

.select2-selection__clear {
    height: 45px;
    padding-top: 12px;
    padding-right: 10px;
}

.select2-results__option {
    padding: 8px 12px;
}

.select2-results__option strong {
    background-color: #fff9ffcd;
    padding: 2px;
    color: black;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #6256ca;
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

    <div class="container d-flex flex-column" style="margin-top:120px;">
        <div class="profile-container-wrapper">
            <div class="profile-picture-container mb-4">
                <img src="{{ $user->img ? asset('images/' . $user->img) : asset('images/default_user.webp') }}" alt="Profile Picture" class="img-fluid">
                <div class="edit-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <input type="file" id="file-input" name="img" accept="image/*" style="display: none;">
            </div>
            <div class="buttons">
                <button type="button" class="btn-save">Upload New</button>
                <button type="button" class="btn-back">Delete avatar</button>
            </div>
        </div>

        <div class="row w-100"  style="margin-top: 67px;">

            <div class="col-md-6">
                <div class="input-form">
                    <label for="nama_depan" class="sub-heading-1">Nama Lengkap</label>
                    <input type="text" id="nama_depan" name="nama_depan" class="custom-input" value="{{ $user->nama_depan }}" required>
                </div>
                <div class="input-form">
                    <label for="nik" class="sub-heading-1">NIK</label>
                    <input type="text" id="nik" name="nik" class="custom-input" value="{{ $user->nik }}" readonly>
                </div>
                <div class="input-form" class="sub-heading-1">
                    <label for="email" class="sub-heading-1">Email</label>
                    <input type="email" id="email" name="email" class="custom-input" value="{{ $user->email }}" readonly>
                </div>
                @if ($user->role == 'INVESTOR')
                    <div class="form-group">
                        <label for="org_name">Nama Organisasi</label>
                        <select id="org_name" name="org_name" class="form-control select2-search custom-input" style="padding: 0px; padding-left: 5px;">
                            <option value="">Tidak Ada Organisasi</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('org_name') == $company->id ? 'selected' : '' }}>
                                    {{ $company->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>

            <div class="col-md-6">
                <div class="input-form" class="sub-heading-1">
                    <label for="negara" class="sub-heading-1">Negara</label>
                    <input type="text" id="negara" name="negara" class="custom-input" value="{{ $user->negara }}" required>
                </div>
                <div class="input-form" class="sub-heading-1">
                    <label for="provinsi" class="sub-heading-1">Provinsi</label>
                    <input type="text" id="provinsi" name="provinsi" class="custom-input" value="{{ $user->provinsi }}" required>
                </div>
                <div class="input-form" class="sub-heading-1">
                    <label for="alamat" class="sub-heading-1">Alamat Lengkap</label>
                    <input type="text" id="alamat" name="alamat" class="custom-input" value="{{ $user->alamat }}" required>
                </div>
                <div class="input-form" class="sub-heading-1">
                    <label for="telepon" class="sub-heading-1">Nomor Handphone</label>
                    <input type="number" id="telepon" name="telepon" class="custom-input" value="{{ $user->telepon }}" required>
                </div>
            </div>
        </div>

        <div class="form-buttons mt-4">
            <a href="{{ route('profile') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

{{-- Ngurusin upload dan hapus gambar --}}
<script>
    document.querySelector('.edit-icon').addEventListener('click', function() {
        document.getElementById('file-input').click();
    });

    document.querySelector('.btn-save').addEventListener('click', function() {
        document.getElementById('file-input').click();
    });

    document.querySelector('.btn-back').addEventListener('click', function() {
        var img = document.querySelector('.profile-picture-container img');
        img.src = '{{ asset('images/1720765715.webp') }}';
    });

    document.getElementById('file-input').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            var img = document.querySelector('.profile-picture-container img');
            img.src = URL.createObjectURL(this.files[0]);
        }
    });
</script>

{{-- Bagian untuk menambahkan search  --}}
<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2-search').select2({
            placeholder: 'Cari organisasi jika ada...',
            allowClear: true,
            width: '100%',
            language: {
                noResults: function() {
                    return "Tidak ada hasil yang ditemukan";
                }
            },
            // Kustomisasi pencarian
            matcher: function(params, data) {
                // Jika tidak ada term pencarian, tampilkan semua
                if ($.trim(params.term) === '') {
                    return data;
                }

                // Skip jika data kosong
                if (typeof data.text === 'undefined') {
                    return null;
                }

                // Konversi ke lowercase untuk pencarian case-insensitive
                var term = params.term.toLowerCase();
                var text = data.text.toLowerCase();

                // Cek apakah text mengandung term pencarian
                if (text.indexOf(term) > -1) {
                    return data;
                }

                // Jika tidak cocok, return null untuk skip
                return null;
            },
            // Kustomisasi tampilan dropdown
            templateResult: function(data) {
                if (!data.id) {
                    return data.text;
                }

                var $result = $('<span></span>');
                var searchTerm = $('.select2-search__field').val().toLowerCase();
                var text = data.text;

                if (searchTerm) {
                    var startIndex = text.toLowerCase().indexOf(searchTerm);
                    if (startIndex > -1) {
                        var endIndex = startIndex + searchTerm.length;
                        var highlightedText =
                            text.substring(0, startIndex) +
                            '<strong>' + text.substring(startIndex, endIndex) + '</strong>' +
                            text.substring(endIndex);
                        $result.html(highlightedText);
                    } else {
                        $result.text(text);
                    }
                } else {
                    $result.text(text);
                }

                return $result;
            }
        });

        // Optional: Tambahkan event handler untuk perubahan nilai
        $('#org_name').on('select2:select', function(e) {
            console.log('Selected value:', e.params.data.id);
            console.log('Selected text:', e.params.data.text);
        });
    });
</script>
@endsection
