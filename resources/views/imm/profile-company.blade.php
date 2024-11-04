@extends('layouts.app-imm')
@section('title', 'Profil Perusahaan')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&display=swap");
    * {
        text-decoration: none;
        list-style-type: none;
    }

    .btn-keluar {
        width: 183px;
        height: 35px;
        background-color: white;
        border: 2px solid #5940cb;
        border-radius: 7px;
    }

    .btn-masuk, .btn-masukkk {
        height: 35px;
        color: white;
        border: none;
        border-radius: 7px;
    }

    .btn-masuk {
        width: 183px;
        background-color: #5940cb;
    }

    .btn-masukkk {
        width: 383px;
        background-color: #5940cb;
    }

    .btn-masukkk:hover {
        background-color: #5e41de;
    }

    .modal-content {
        width: 100%;
        max-width: 700px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
        background-color: #6f42c1;
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .modal-title {
        margin: 0 auto;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        border: 1px solid #6f42c1;
        border-radius: 5px;
    }

    .file-upload {
        border: 1px dashed #6f42c1;
        border-radius: 5px;
        padding: 20px;
        text-align: center;
        color: #6c757d;
    }

    .file-upload i {
        font-size: 24px;
        color: #6f42c1;
    }

    .file-upload button {
        background-color: #28a745;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        margin-top: 10px;
    }

    .btn-secondary {
        background-color: transparent;
        color: #6f42c1;
        border: 1px solid #6f42c1;
    }

    .btn-primary {
        background-color: #6f42c1;
        color: white;
        border: none;
    }

    .btnn {
        display: flex;
        align-content: center;
        justify-content: space-around;
        width: 100%;
    }

    .bahasa {
        background-color: #5940cb;
    }

    #preview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ccc;
    }

    #changeText {
        cursor: pointer;
        color: #5940cb;
    }

    /* Bagian team */

    .team-section {
        text-align: center;
        margin-top: 50px;
    }

    .team-title {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 40px;
    }

    .team-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .team-card {
        flex: 1 1 calc(33.33% - 20px); /* Mengatur lebar kolom menjadi maksimal 33.33% */
        box-sizing: border-box; /* Memastikan padding dan margin tidak mempengaruhi lebar */
        text-align: center; /* Menyusun konten di tengah */
        margin-bottom: 20px; /* Ruang di bawah setiap kartu */
        padding: 10px; /* Ruang di dalam kartu */
        border: 1px solid #ddd; /* Tambahkan border untuk memperjelas batas kartu */
        border-radius: 8px; /* Sudut yang lebih halus */
    }

    .team-photo {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .team-name {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .team-role {
        font-size: 14px;
        color: #888;
        margin-bottom: 10px;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .btn-edit, .btn-delete {
        background-color: #5940cb;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn-edit:hover, .btn-delete:hover {
        background-color: #5e41de;
    }

    .btn-add {
        background-color: #5940cb;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-top: 30px;
    }

    .btn-add:hover {
        background-color: #5e41de;
    }

    .people-results {
        position: absolute;
        width: 100%;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .person-result {
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .person-result:hover {
        background-color: #f0f0f0;
    }

    .modal-footer {
        justify-content: space-between;
    }

    .person {
        display: flex;
        align-items: center;
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .person:hover {
        background-color: #f0f0f0;
    }

    .profile-pic {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover;
    }

    .person-info h5 {
        margin: 0;
        font-size: 1.1em;
    }

    .person-info p {
        margin: 0;
        color: #666;
        font-size: 0.9em;
    }

    .project-section {
        text-align: center;
        margin-top: 50px;
    }

    .project-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
    }

    .project-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 400px;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
    }

    .project-card img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 0;
        margin-bottom: 1rem;
    }

    .btn-add-project {
        background-color: #5940cb;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-top: 30px;
    }

    .project-price {
        margin: 20px;
        border: none;
        background-color: #5940cb;
        padding: 10px;
        padding-left: 20px;
        padding-right: 20px;
        color: white;
        border-radius: 30px;
    }

    .btn-edit-project, .btn-delete-project {
        background-color: #5940cb;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn-edit-project:hover, .btn-delete-project:hover {
        background-color: #5e41de;
    }

    /* Tag Button Section */
    .search-container {
        padding: 10px 20px;
        border-bottom: 1px solid transparent;
        z-index: 1;
    }

    .search-bar {
        background-color: #6256ca;
        border: none;
        color: #ffffff;
        padding: 15px;
        border-radius: 10px;
        width: 100%;
        padding-right: 50px;
        position: relative;
    }

    .search-bar::placeholder {
        color: #ffffff;
    }

    .search-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #ffffff;
        pointer-events: none;
    }

    .modal-body-scrollable {
        max-height: 350px;
        overflow-y: auto;
        padding: 20px;
    }

    .tag-cloud {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .tag-button {
        display: inline-block;
        padding: 8px 15px;
        margin: 5px;
        font-size: 14px;
        border: 1px solid #6256ca;
        border-radius: 20px;
        background-color: #f8f9fa;
        color: #6256ca;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .tag-button:hover {
        background-color: #6256ca;
        color: #ffffff;
    }

    .tag-button.selected {
        background-color: #6256ca;
        color: #ffffff;
        transition: background-color 0.3s, color 0.3s;
    }

    /* Styles for selected tags */
    .selected-tag {
        display: inline-block;
        background-color: #6256ca; /* Use the theme color */
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 15px;
        margin-right: 5px;
        margin-bottom: 5px;
        font-size: 14px;
    }
    .breadcrumb {
        background-color: white;
        padding: 0;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        margin-right: 14px;
        color: #9CA3AF;
    }

    /* Bagin content kotak */
    .nav-tabs {
        border-bottom: none;
        justify-content: center;
    }

    .nav-tabs .nav-link {
        color: #6c757d;
        border: none;
        margin-right: 10px;
        font-size: 32px;
    }

    .active-nav{
        color: #6256ca;
        font-weight: bold;
        border-bottom: 3px solid #6256ca;
    }

    .nav-item-separator {
        font-size: 40px;
        color: #6c757d;
        margin: 1px 200px;
        line-height: 1.5;
        opacity: 0.2;
    }

    .btn-toggle {
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 10px 15px;
        font-size: 16px;
    }

    .profile-header {
        text-align: center;
        margin-top: 20px;
        margin-bottom:24px;
    }

    .profile-header img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-bottom: 8px;
    }

    .profile-header button {
        margin-top: 10px;
        border: 1px solid rgba(108, 117, 125, 0.1); /* Mengubah border menjadi RGBA dengan opasitas 10% */
        background-color: white;
        width: 170px;
        height: 43px;
        color: #6c757d;
        padding: 5px 10px;
        border-radius: 8px;
        cursor: pointer;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        border-radius: 6px;
        border: 1px solid #808080;
        width: 416px;
        height: 52px;
    }

    .save-button {
        background-color: #6256ca;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
    }

    .content-box {
        border: 1px solid #ddd;
        padding: 0px;
        padding-bottom: 20px;
        border-radius: 10px;
        margin-top: 20px;
    }

    .tab-content-box {
        border-bottom: 1px solid #ddd;
        padding-bottom: 0px;
        margin: 0px;
        margin-bottom: 80px;
        display: flex;
        justify-content: center;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="container" style="margin-top: 120px;">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" style="margin-bottom: 32px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('profile-company') }}" style="text-decoration: none; color: #212B36;">Profile Company</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('profile-company') }}" style="text-decoration: none; color: #212B36;">Profile</a>
            </li>
            <li class="breadcrumb-item active sub-heading-1" style="margin-right: 4px; display: none;" id="people-arrow"></li>
                <a href="{{ route('profile-company') }}" style="text-decoration: none; color: #212B36; display: none;" id="people-text">People</a>
            </li>
        </ol>
    </nav>
        <form method="POST" action="{{ route('profile-company.update', ['id' => $company->id]) }}" id="companyForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <section id="profile-section" class="toggle-section">
                <div class="content-box">
                    <div class="tab-content-box">
                        <ul class="nav nav-tabs">
                            <div>
                                <li class="nav-item">
                                    <button class="nav-link btn-toggle" data-target="#profile-section">
                                        <div class="active-nav">Profile</div>
                                    </button>
                                </li>
                            </div>
                            <span class="nav-item-separator">|</span>
                            <div>
                                <li class="nav-item">
                                    <button class="nav-link btn-toggle" data-target="#people-section">
                                        People
                                    </button>
                                </li>
                            </div>
                        </ul>
                    </div>
                    <div class="profile-header">
                        <img id="profileImage" alt="Profile picture" src="{{ $company->image ?? asset('images/logo-maxy.png') }}"/>
                        <h3>{{ $company->nama }}</h3>
                        <input type="file" id="photoUpload" accept="image/*" style="display: none;" name="image" />
                        <button id="button-img-add" style="visibility: hidden;"><em class="sub-heading-1">Upload Photo</em></button>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-10" style="margin-bottom: 10px;">
                            <div class="d-flex align-items-center">
                                <h5 class="mr-5 sub-heading-1">Edit Data Perusahaan</h5>
                                <img style="cursor: pointer" id="editButton" src="{{ asset('images/icon-edit.svg') }}" width="20" alt="">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="companyName" class="sub-heading-1">Company Name</label>
                                <input type="text" name="nama" class="form-control" id="formGroupExampleInput1" placeholder="Input your company name" value="{{ $company->nama }}" readonly/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="profile" class="sub-heading-1">Profil Perusahaan</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" name="profile" placeholder="Input company profile" value="{{ $company->profile }}" readonly/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="foundedDate" class="sub-heading-1">Tanggal Berdiri</label>
                                <input type="date" class="form-control" id="formGroupExampleInput11" name="founded_date" value="{{ $company->founded_date }}" readonly/>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="formGroupExampleInput3" class="form-label">Nama PIC</label>
                                <input type="text" name="nama_pic" class="form-control" id="formGroupExampleInput3" placeholder="Nama PIC" value="{{ $company->nama_pic }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="formGroupExampleInput4" class="form-label">Posisi PIC</label>
                                <input type="text" name="posisi_pic" class="form-control" id="formGroupExampleInput4" placeholder="Posisi PIC" value="{{ $company->posisi_pic }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="formGroupExampleInput5" class="form-label">Nomor Telepon</label>
                                <input type="number" name="telepon" class="form-control" id="formGroupExampleInput5" placeholder="Nomor Telepon" value="{{ $company->telepon }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="formGroupExampleInput8" class="form-label">Negara</label>
                                <input type="text" name="negara" class="form-control" id="formGroupExampleInput8" placeholder="Negara" value="{{ $company->negara }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="formGroupExampleInput9" class="form-label">Provinsi</label>
                                <input type="text" name="provinsi" class="form-control" id="formGroupExampleInput9" placeholder="Provinsi" value="{{ $company->provinsi }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="formGroupExampleInput10" class="form-label">Kota/Kabupaten</label>
                                <input type="text" name="kabupaten" class="form-control" id="formGroupExampleInput10" placeholder="Kabupaten" value="{{ $company->kabupaten }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="formGroupExampleInput6 " class="form-label">Jumlah Pekerja</label>
                                <input type="number" name="jumlah_karyawan" class="form-control" id="formGroupExampleInput6" placeholder="Jumlah Pekerja" value="{{ $company->jumlah_karyawan }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="funding_stage">Funding Stage Perusahaan</label>
                                <select name="funding_stage" id="funding_stage" class="form-control" required readonly>
                                    <option value="" disabled>Pilih Funding Stage Perusahaan</option>
                                    <option value="Pre Seed" @if($company->funding_stage == 'Pre Seed') selected @endif>Pre-Seed</option>
                                    <option value="seed" @if($company->funding_stage == 'seed') selected @endif>Seed</option>
                                    <option value="Series A" @if($company->funding_stage == 'Series A') selected @endif>Series A</option>
                                    <option value="Series B" @if($company->funding_stage == 'Series B') selected @endif>Series B</option>
                                    <option value="Series C" @if($company->funding_stage == 'Series C') selected @endif>Series C</option>
                                    <option value="Series D" @if($company->funding_stage == 'Series D') selected @endif>Series D</option>
                                    <option value="Series E" @if($company->funding_stage == 'Series E') selected @endif>Series E</option>
                                    <option value="Series F" @if($company->funding_stage == 'Series F') selected @endif>Series F</option>
                                    <option value="Series G" @if($company->funding_stage == 'Series G') selected @endif>Series G</option>
                                    <option value="Series H" @if($company->funding_stage == 'Series H') selected @endif>Series H</option>
                                    <option value="Series I" @if($company->funding_stage == 'Series I') selected @endif>Series I</option>
                                    <option value="Series J" @if($company->funding_stage == 'Series J') selected @endif>Series J</option>
                                    <option value="venture_series_unknown" @if($company->funding_stage == 'venture_series_unknown') selected @endif>Venture - Series Unknown</option>
                                    <option value="angel" @if($company->funding_stage == 'angel') selected @endif>Angel</option>
                                    <option value="private_equity" @if($company->funding_stage == 'private_equity') selected @endif>Private Equity</option>
                                    <option value="debt_financing" @if($company->funding_stage == 'debt_financing') selected @endif>Debt Financing</option>
                                    <option value="convertible_note" @if($company->funding_stage == 'convertible_note') selected @endif>Convertible Note</option>
                                    <option value="grant" @if($company->funding_stage == 'grant') selected @endif>Grant</option>
                                    <option value="corporate_round" @if($company->funding_stage == 'corporate_round') selected @endif>Corporate Round</option>
                                    <option value="equity_crowdfunding" @if($company->funding_stage == 'equity_crowdfunding') selected @endif>Equity Crowdfunding</option>
                                    <option value="product_crowdfunding" @if($company->funding_stage == 'product_crowdfunding') selected @endif>Product Crowdfunding</option>
                                    <option value="secondary_market" @if($company->funding_stage == 'secondary_market') selected @endif>Secondary Market</option>
                                    <option value="post_ipo_equity" @if($company->funding_stage == 'post_ipo_equity') selected @endif>Post-IPO Equity</option>
                                    <option value="post_ipo_debt" @if($company->funding_stage == 'post_ipo_debt') selected @endif>Post-IPO Debt</option>
                                    <option value="post_ipo_secondary" @if($company->funding_stage == 'post_ipo_secondary') selected @endif>Post-IPO Secondary</option>
                                    <option value="non_equity_assistance" @if($company->funding_stage == 'non_equity_assistance') selected @endif>Non-equity Assistance</option>
                                    <option value="initial_coin_offering" @if($company->funding_stage == 'initial_coin_offering') selected @endif>Initial Coin Offering</option>
                                    <option value="undisclosed" @if($company->funding_stage == 'undisclosed') selected @endif>Undisclosed</option>Offering (IPO)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="business_model">Business Model Perusahaan</label>
                                <select class="form-control" id="business_model" name="business_model" required readonly>
                                    <option value="" disabled selected>Pilih business_model Perusahaan</option>
                                    <option value="B2B" @if($company->business_model == 'B2B') selected @endif>B2B</option>
                                    <option value="B2C" @if($company->business_model == 'B2C') selected @endif>B2C</option>
                                    <option value="B2B2C" @if($company->business_model == 'B2B2C') selected @endif>B2B2C</option>
                                    <option value="C2C" @if($company->business_model == 'C2C') selected @endif>C2C</option>
                                    <option value="D2C" @if($company->business_model == 'D2C') selected @endif>D2C</option>
                                    <option value="P2P" @if($company->business_model == 'P2P') selected @endif>P2P</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="impactTags">Tag untuk department apa saja yang ada di perusahaan anda</label>
                                <button type="button" class="tag-button" id="editTagsButton" data-toggle="modal" data-target="#tagModal" style="display: none;">
                                    Pilih Department Perusahaan Anda
                                </button>
                                <!-- Container for displaying selected tags -->
                                <div id="selectedTags" class="mt-2">
                                    @foreach ($selectedDepartments as $department)
                                        <span class="selected-tag">{{ $department->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Modal for Tag Selection -->
                        <div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="tagModalLabel">Pilih Departemen Perusahaan Anda</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="search-container sticky-top bg-white">
                                            <div class="form-group position-relative mb-0">
                                                <input type="text" class="form-control search-bar" id="searchInput" placeholder="Cari departemen" aria-label="Cari departemen">
                                                <i class="fas fa-search search-icon"></i>
                                            </div>
                                        </div>
                                        <div class="tag-cloud-container modal-body-scrollable">
                                            <div class="tag-cloud" id="tagCloud">
                                                @foreach ($departments as $tag)
                                                    <button class="tag-button
                                                        @if(in_array($tag->id, $selectedDepartments->pluck('id')->toArray())) selected @endif"
                                                        data-tag-id="{{ $tag->id }}" type="button">
                                                        {{ $tag->name }}
                                                    </button>
                                                    <input type="checkbox" value="{{ $tag->id }}"
                                                        id="tag{{ $tag->id }}" name="department_ids[]"
                                                        @if(in_array($tag->id, $selectedDepartments->pluck('id')->toArray())) checked @endif
                                                        style="display: none;">
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5" style="margin-bottom: 20px;">
                            <div class="form-group">
                                <label for="formGroupExampleInput12" class="form-label">Ringkasan Startup</label>
                                <textarea name="startup_summary" class="form-control" id="formGroupExampleInput12" placeholder="Ringkasan Singkat Startup" rows="5" readonly>{{ $company->startup_summary }}</textarea>
                            </div>
                        </div>

                        <div class="col-md-10 text-center">
                            <div class="out d-flex justify-content-center align-items-center" style="gap: 10px">
                                <button type="button" id="saveButton" style="display: none;" data-toggle="modal" data-target="#confirmModal" class="save-button">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="row my-3 d-flex justify-content-center align-items-center">
                    <button type="button" id="saveButton" class="btn-masukkk" style="display: none;" data-toggle="modal" data-target="#confirmModal">
                        <div class="out d-flex justify-content-center align-items-center" style="gap: 10px">
                            <span>Simpan Perubahan Data Perusahaan</span>
                            <img src="{{ asset('images/icon-save.svg') }}" width="20" alt="">
                        </div>
                    </button>
                </div>
            </section>

            {{-- Ini merupakan bagian untuk anggota team dari suatu company tersebut --}}
            <section id="people-section" class="toggle-section" style="display: none;">
                <div class="container team-section">
                    <h2 class="team-title">Our Team</h2>
                    <div class="team-container">
                        @if (!$team->isEmpty())
                            @foreach ($team as $person)
                                <div class="team-card">
                                    <img src="{{ isset($person->image) ? asset('images/' . $person->image) : asset('images/1720765715.webp') }}" alt="{{ $person->name }}" class="rounded-circle mb-3" width="100" height="100">
                                    <div class="team-name">{{ $person->name }}</div>
                                    <span class="selected-tag">{{ $person->departmentName }}</span>
                                    <div class="action-buttons">
                                        <button class="btn-edit" data-id="{{ $person->id }}" data-name="{{ $person->name }}" data-role="{{ $person->pivot->position }}" data-photo="{{ isset($person->image) ? asset('images/' . $person->image) : asset('images/1720765715.webp') }}" data-toggle="modal" data-target="#editTeamModal">Edit</button>
                                        <button class="btn-delete" data-id="{{ $person->id }}" data-company-id="{{ $company->id }}" id="team-member-{{ $person->id }}">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No team members available. Please add new members.</p>
                        @endif
                    </div>
                    <button type="button" class="btn-add" data-toggle="modal" data-target="#addTeamModal">Add New Team Member</button>
                </div>
            </section>

            <!-- Add Team Member Modal -->
            <div class="modal fade" id="addTeamModal" tabindex="-1" aria-labelledby="addTeamModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addTeamModalLabel">Add Team Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="addTeamForm">
                                <div class="form-group">
                                    <label for="searchPeople">Search People</label>
                                    <input type="text" class="form-control" id="searchPeople" placeholder="Name or email">
                                    <div id="peopleResults" class="people-results"></div>
                                    <input type="hidden" id="selectedPersonId">
                                </div>
                                <div class="form-group">
                                    <label for="companyId">Company ID</label>
                                    <input type="text" class="form-control" id="companyId" value="{{ $company->id }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="position">Position Department</label>
                                    <select id="position" class="form-control">
                                        <option value="">Pilih Departemen</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="addTeamButton">Add Team Member</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Team Member Modal -->
            <div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="editTeamModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="height: 500px;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTeamModalLabel">Edit Team Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="editTeamForm">
                                <div class="form-group">
                                    <label for="editName">Name</label>
                                    <input type="text" class="form-control" id="editName" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="editPosition">Position</label>
                                    <select class="form-control" id="editPosition" disabled>
                                        <option value="">Pilih Departemen</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="editPhoto">Photo</label>
                                    <input type="file" class="form-control" id="editPhoto">
                                </div>
                                <!-- Hidden input untuk menyimpan ID orang -->
                                <input type="hidden" id="editPersonId">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="editTeamButton">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirm Delete Modal -->
            <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this team member?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger" id="deleteTeamButton">Delete</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Confirm Save Modal -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmModalLabel">Confirm Save</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to save changes to your company profile?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="saveChangesButton">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    <!-- Email Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-body">
                    <p class="text-muted">Silakan ubah email Anda di Email pengguna.</p>
                    <div class="btnn">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-masuk" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Password Modal -->
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow">
                <div class="modal-body">
                    <p class="text-muted">Silakan ubah password Anda di Password pengguna.</p>
                    <div class="btnn">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-masuk" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <h5 class="modal-title" id="confirmModalLabel">Apakah Anda yakin ingin menyimpan perubahan ini?</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-muted">Pastikan semua perubahan sudah sesuai sebelum disimpan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-keluar" data-dismiss="modal">Belum, cek kembali</button>
                    <button type="button" class="btn btn-masuk" data-dismiss="modal" id="confirmSaveButton">Ya, sudah benar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('editButton').addEventListener('click', function() {
            document.querySelectorAll('input').forEach(input => input.removeAttribute('readonly'));
            document.querySelectorAll('select').forEach(select => select.removeAttribute('readonly'));
            document.querySelectorAll('textarea').forEach(textarea => textarea.removeAttribute('readonly'));
            document.getElementById('saveButton').style.display = 'block';
            document.getElementById('editTagsButton').style.display = 'inline-block'; // Show the tag button
            document.getElementById('editButton').style.display = 'none';
            document.getElementById('button-img-add').style.visibility = 'visible';
        });

        // Menangani tombol simpan perubahan
        document.getElementById('saveChangesButton').addEventListener('click', function() {
            document.getElementById('companyForm').submit();
        });
        // Menangani tombol konfirmasi simpan perubahan
        document.getElementById('confirmSaveButton').addEventListener('click', function() {
            document.getElementById('companyForm').submit();
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>


    {{-- ! Bagian untuk melakukan handle pergantian tampilan --}}
    <script>
        document.querySelectorAll('.btn-toggle').forEach(button => {
            button.addEventListener('click', function() {
                event.preventDefault();
                // Ambil target section dari data-target
                const targetId = this.getAttribute('data-target');
                const targetSection = document.querySelector(targetId);
                const arrow = document.getElementById('people-arrow');
                const text = document.getElementById('people-text');

                // Sembunyikan semua section
                document.querySelectorAll('.toggle-section').forEach(section => {
                    section.style.display = 'none';
                });

                // Tampilkan section yang dipilih
                if (targetSection) {
                    targetSection.style.display = 'block';
                    if (targetId === '#people-section') {
                        arrow.style.display = 'block';
                        text.style.display = 'block';
                    }
                }
            });
        });
    </script>

    {{-- ! Bagian untuk upload foto --}}
    <script>
        document.getElementById('button-img-add').addEventListener('click', function() {
            event.preventDefault();
            document.getElementById('photoUpload').click();
        });

        document.getElementById('photoUpload').addEventListener('change', function(event) {
            event.preventDefault();
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result; // Update the image src with the uploaded file
                }
                reader.readAsDataURL(file);
            }
        });
    </script>

    {{-- ! Javascript untuk menangani handle terkait team baik untuk menambahkan menghapus dan mencari orang --}}
    <script>
      $(document).ready(function() {

            // Menyimpan token CSRF dalam variabel JavaScript
            var csrfToken = '{{ csrf_token() }}';

            // Menambahkan CSRF token ke dalam header Ajax
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Menangani input pencarian orang
            $('#searchPeople').on('input', function() {
                var query = $(this).val();
                if (query.length > 2) {
                    $.ajax({
                        url: '/search-people',
                        method: 'GET',
                        data: { query: query },
                        success: function(data) {
                            $('#peopleResults').html('');
                            $.each(data, function(index, person) {
                                $('#peopleResults').append('<div class="person-result" data-id="' + person.id + '">' + person.name + ' (' + person.gmail + ')</div>');
                            });
                        }
                    });
                } else {
                    $('#peopleResults').html('');
                }
            });

             // Handle click on search results
            $(document).on('click', '.person-result', function() {
                var personId = $(this).data('id');
                $('#selectedPersonId').val(personId);
                $('#searchPeople').val($(this).text());
                $('#peopleResults').html('');
            });

            // Handle add team member button click
            $(document).ready(function() {
                // Handle add team member button click
                $('#addTeamButton').on('click', function() {
                    var personId = $('#selectedPersonId').val();
                    var companyId = $('#companyId').val();
                    var position = $('#position').val();

                    if (position) {
                        $.ajax({
                            url: '/team/store',
                            method: 'POST',
                            data: { person_id: personId, company_id: companyId, position: position },
                            success: function(data) {
                                location.reload(); // Reload halaman setelah berhasil
                            },
                            error: function(xhr, status, error) {
                                console.error('Error adding team member:', error);
                            }
                        });
                    } else {
                        alert("Silakan pilih posisi departemen.");
                    }
                });
            });

            // Menangani tombol edit team member
            $(document).on('click', '.btn-edit', function() {
                var personId = $(this).data('id');

                $.ajax({
                    url: '/team/' + personId + '/edit',
                    method: 'GET',
                    success: function(data) {
                        // Pastikan data yang diterima valid
                        if (data) {
                            $('#editName').val(data.name);
                            $('#editPosition').val(data.position); // Pastikan posisi sudah ada di dropdown
                            $('#editPhoto').val(data.photo); // Jika Anda ingin menampilkan foto yang ada
                            $('#editPersonId').val(data.id);
                        } else {
                            alert("Data anggota tim tidak ditemukan.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching team member data:', error);
                        alert("Terjadi kesalahan saat mengambil data anggota tim.");
                    }
                });
            });

            // Menangani tombol simpan perubahan team member
            $('#editTeamButton').on('click', function() {
                var personId = $('#editPersonId').val();
                var name = $('#editName').val();
                var role = $('#editPosition').val();
                var photo = $('#editPhoto')[0].files[0]; // Ambil file foto

                if (role) {
                    var formData = new FormData();
                    formData.append('name', name);
                    formData.append('position', role);
                    if (photo) {
                        formData.append('photo', photo);
                    }

                    $.ajax({
                        url: '/team/' + personId,
                        method: 'PUT',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            location.reload(); // Reload halaman setelah berhasil
                        },
                        error: function(xhr, status, error) {
                            console.error('Error updating team member:', error);
                            alert("Terjadi kesalahan saat memperbarui anggota tim.");
                        }
                    });
                } else {
                    alert("Silakan pilih posisi departemen.");
                }
            });

            // Menangani tombol hapus team member
            $(document).on('click', '.btn-delete', function() {
                var personId = $(this).data('id');
                var companyId = $(this).data('company-id');
                $.ajax({
                    url: '/delete-team-member',
                    method: 'POST',
                    data: { person_id: personId, company_id: companyId },
                    success: function(data) {
                        location.reload();
                    }
                });
            });
        });
    </script>

    {{-- Bagian untuk fokus filter tag --}}
    <script>
        $(document).ready(function() {
            // Filter tags based on search input
            $('#searchInput').on('input', function() {
                var searchTerm = $(this).val().toLowerCase();
                $('#tagCloud .tag-button').each(function() {
                    var tagName = $(this).text().toLowerCase();
                    if (tagName.includes(searchTerm)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Toggle tag selection
            $('.tag-button').click(function() {
                var $button = $(this);
                var tagId = $button.data('tag-id');
                var $checkbox = $('#tag' + tagId);

                // Toggle the selected state
                $button.toggleClass('selected');

                // Sync the checkbox with the button state
                $checkbox.prop('checked', $button.hasClass('selected'));

                // Update the selected tags display
                updateSelectedTags();
            });

            // Initialize button states based on checkboxes
            $('input[type="checkbox"]').each(function() {
                var $checkbox = $(this);
                var tagId = $checkbox.val();
                var $button = $('button[data-tag-id="' + tagId + '"]');

                if ($checkbox.prop('checked')) {
                    $button.addClass('selected');
                }
            });

            // Function to update the display of selected tags
            function updateSelectedTags() {
                var selectedTags = [];
                $('#tagCloud .tag-button.selected').each(function() {
                    selectedTags.push($(this).text());
                });
                $('#selectedTags').html(selectedTags.map(tag => `<span class="selected-tag">${tag}</span>`).join(''));
            }

            function updatePositionDepartment() {
                var $positionSelect = $('#position');
                $positionSelect.empty().append('<option value="">Pilih Departemen</option>');

                $('#tagCloud .tag-button.selected').each(function () {
                    var $tagId = $(this).data('tag-id');
                    var $tagName = $(this).text();
                    $positionSelect.append(`<option value="${$tagId}">${$tagName}</option>`);
                })

                $positionSelect.prop('disabled', $positionSelect.find('option').length <= 1);
            }
            // Initial update of selected tags
            updateSelectedTags();
            updatePositionDepartment();
        });
    </script>
</div>
@endsection
