@extends('layouts.app-2fa')
@section('title', 'Create your account')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">

<style>
    body {
        font-family: "Roboto", sans-serif;
        background-color: #f5f5f5;
    }

    .register-container {
        background-color: #fff;
        padding: 30px;
        width: 727px;
        margin: 0 auto;
        margin-top: 50px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .register-form {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    /* Header with bell icon and title */
    .register-header {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .register-header img {
        width: 100px; /* Ukuran bell icon */
        margin-right: 10px; /* Spasi antara bell dan teks */
        transform: rotate(-15deg); /* Miringkan bell icon */
    }

    .register-header h2 {
        font-size: 28px;
        color: #5940cb;
        font-weight: bold;
    }

    .register-description {
        font-size: 16px;
        color: black;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        width: 48%;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
        color: #000000;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #f8f9fa;
        font-size: 16px;
    }

    .btn-register {
        padding: 10px 20px;
        background-color: #5940cb;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        font-size: 16px;
        margin-top: 20px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-register:hover {
        background-color: #524eff;
        transform: scale(1.05);
    }

    .login-link {
        margin-top: 15px;
        font-size: 14px;
        color: #000000;
        text-align: center;
    }

    .login-link a {
        color: #6256CA;
        text-decoration: none;
        font-weight: bold;
    }

    .login-link a:hover {
        text-decoration: underline;
    }

    /* Role-specific sections */
    .role-section {
        display: none;
        width: 100%;
    }

    .search-container {
        padding: 10px 20px;
        border-bottom: 1px solid transparent;
        z-index: 1;
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

    /* Media query for responsiveness */
    @media (max-width: 768px) {
        .register-container {
            width: 90%;
            padding: 20px;
        }

        .form-row {
            flex-direction: column;
            width: 100%;
        }

        .form-group {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')

<body>
    <div class="container">
        <div class="register-container">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <div class="register-form">
                    <!-- Header with bell icon and title -->
                    <div class="register-header">
                        <img src="{{ asset('images/register/bell.png') }}" alt="Bell Icon">
                        <h2>Create your account</h2>
                    </div>
                    <p class="register-description">Fill in your details to get started with IMM Impact Mate and unlock access to all our features.</p>

                    {{-- Role Selection --}}
                    <div class="form-group" style="width: 100%;">
                        <label for="role">Select Role</label>
                        <select id="role" name="role" required>
                            <option value="">Select your role</option>
                            <option value="USER" {{ old('role') == 'USER' ? 'selected' : '' }}>Startup Founder</option>
                            <option value="INVESTOR" {{ old('role') == 'INVESTOR' ? 'selected' : '' }}>Investor</option>
                            <option value="PEOPLE" {{ old('role') == 'PEOPLE' ? 'selected' : '' }}>Mentor/Konsultan</option>
                        </select>
                    </div>

                    {{-- Field Umum --}}
                    <div class="form-row" style="display: none;" id="field-umum">
                        <div class="col-md-6" style="margin: 0; padding: 0;">
                            <div class="form-group" style="width: 100%; margin: 0; padding-right: 20px;">
                                <label for="nama_depan">Nama Depan</label>
                                <input type="text" id="nama_depan" name="nama_depan" class="form-control full-width" placeholder="Masukkan nama depan anda" value="{{ old('nama_depan') }}" required />
                            </div>
                        </div>
                        <div class="col-md-6" style="margin: 0;">
                            <div class="form-group" style="width: 100%; margin: 0;">
                                <label for="nama_belakang">Nama Belakang</label>
                                <input type="text" id="nama_belakang" name="nama_belakang" class="form-control full-width" placeholder="Masukkan nama belakang anda" value="{{ old('nama_belakang') }}" required />
                            </div>
                        </div>
                    </div>

                    {{-- USER Role Fields --}}
                    <div id="userFields" class="role-section">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" id="nik" name="nik" placeholder="Masukkan NIK anda" value="{{ old('nik') }}" required minlength="16" maxlength="16" />
                                <div id="error-message" class="error text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label for="negara">Negara</label>
                                <input type="text" id="negara" name="negara" placeholder="Masukkan negara anda" value="{{ old('negara') }}" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi" required>
                                    {{-- isi secara dinamis akan dimasukkan di sini --}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telepon">Nomor Telepon</label>
                                <input type="text" id="telepon" name="telepon" placeholder="Masukkan nomor telepon anda" value="{{ old('telepon') }}" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat anda" value="{{ old('alamat') }}" required />
                        </div>
                    </div>

                   {{-- INVESTOR Role Fields --}}
                <div id="investorFields" class="role-section">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="org_name">Nama Organisasi</label>
                            <select id="org_name" name="org_name" class="form-control">
                                <option value="">Tidak Ada Organisasi</option> <!-- Nilai kosong untuk tidak memilih -->
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('org_name') == $company->id ? 'selected' : '' }}>
                                        {{ $company->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="number_of_contacts">Nomor Kontak</label>
                            <input type="number" id="number_of_contacts" name="number_of_contacts" placeholder="Masukkan nomor kontak" value="{{ old('number_of_contacts') }}" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="location">Lokasi</label>
                            <input type="text" id="location" name="location" placeholder="Masukkan lokasi" value="{{ old('location') }}" required />
                        </div>

                        <div class="form-group">
                            <label for="investment_stage">Tahap Investasi</label>
                            <select id="investment_stage" name="investment_stage" class="form-control" required>
                                <option value="">Pilih Tahap Investasi</option>
                                <option value="Pre Seed">Pre-Seed</option>
                                <option value="seed">Seed</option>
                                <option value="Series A">Series A</option>
                                <option value="Series B">Series B</option>
                                <option value="Series C">Series C</option>
                                <option value="Series D">Series D</option>
                                <option value="Series E">Series E</option>
                                <option value="Series F">Series F</option>
                                <option value="Series G">Series G</option>
                                <option value="Series H">Series H</option>
                                <option value="Series I">Series I</option>
                                <option value="Series J">Series J</option>
                                <option value="venture_series_unknown">Venture - Series Unknown</option>
                                <option value="angel">Angel</option>
                                <option value="private_equity">Private Equity</option>
                                <option value="debt_financing">Debt Financing</option>
                                <option value="convertible_note">Convertible Note</option>
                                <option value="grant">Grant</option>
                                <option value="corporate_round">Corporate Round</option>
                                <option value="equity_crowdfunding">Equity Crowdfunding</option>
                                <option value="product_crowdfunding">Product Crowdfunding</option>
                                <option value="secondary_market">Secondary Market</option>
                                <option value="post_ipo_equity">Post-IPO Equity</option>
                                <option value="post_ipo_debt">Post-IPO Debt</option>
                                <option value="post_ipo_secondary">Post-IPO Secondary</option>
                                <option value="non_equity_assistance">Non-equity Assistance</option>
                                <option value="initial_coin_offering">Initial Coin Offering</option>
                                <option value="undisclosed">Undisclosed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <textarea id="description" name="description" placeholder="Masukkan deskripsi" rows="3" required>{{ old('description') }}</textarea>
                    </div>

                    {{-- <div class="form-group">
                        <label for="departments">Departemen</label>
                        <select id="departments" name="departments" class="form-control" required>
                            <option value="">Pilih Departemen</option>
                            <option value="Marketing" {{ old('departments') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
                            <option value="Finance" {{ old('departments') == 'Finance' ? 'selected' : '' }}>Finance</option>
                            <option value="Human Resources" {{ old('departments') == 'Human Resources' ? 'selected' : '' }}>Human Resources</option>
                            <option value="Engineering" {{ old('departments') == 'Engineering' ? 'selected' : '' }}>Engineering</option>
                            <option value="Sales" {{ old('departments') == 'Sales' ? 'selected' : '' }}>Sales</option>
                            <option value="Operations" {{ old('departments') == 'Operations' ? 'selected' : '' }}>Operations</option>
                            <option value="Product Development" {{ old('departments') == 'Product Development' ? 'selected' : '' }}>Product Development</option>
                            <option value="Customer Support" {{ old('departments') == 'Customer Support' ? 'selected' : '' }}>Customer Support</option>
                            <option value="IT" {{ old('departments') == 'IT' ? 'selected' : '' }}>IT</option>
                            <option value="Legal" {{ old('departments') == 'Legal' ? 'selected' : '' }}>Legal</option>
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label for="impactTags">Tag untuk department</label>
                        <button type="button" class="tag-button" data-toggle="modal" data-target="#tagModal">
                            Pilih Department Anda
                        </button>
                        <div id="selectedTags" class="mt-2">
                        </div>
                    </div>

                    <!-- Modal -->
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
                                        <div class="form-group position-relative mb-0" style="padding: 10px 20px; border-bottom: 1px solid transparent; z-index: 1;">
                                            <input type="text" style="background-color: #6256ca; border: none; color: #ffffff; padding: 15px; border-radius: 10px; width: 700px; padding-right: 50px; position: relative;" placeholder="Search..."  class="form-control search-bar" id="searchInput"/>
                                            <span style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); color: #ffffff; pointer-events: none;"></span>
                                        </div>
                                    </div>
                                    <div class="tag-cloud-container modal-body-scrollable">
                                        <div class="tag-cloud" id="tagCloud">
                                            @foreach ($departments as $tag)
                                                <!-- Tambahkan type="button" pada button -->
                                                <button class="tag-button
                                                    @if(in_array($tag->id, $investor->tag_ids ?? [])) selected @endif"
                                                    data-tag-id="{{ $tag->id }}"
                                                    type="button">
                                                    {{ $tag->name }}
                                                </button>
                                                <input type="checkbox"
                                                       value="{{ $tag->id }}"
                                                       id="tag{{ $tag->id }}"
                                                       name="tag_ids[]"
                                                       @if(in_array($tag->id, $investor->tag_ids ?? [])) checked @endif
                                                       style="display: none;">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                    {{-- PEOPLE Role Fields --}}
                    <div id="peopleFields" class="role-section">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Nama Lengkap</label>
                                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="people_role">Sub-Role</label>
                                <select id="people_role" name="people_role" required>
                                    <option value="">-- Pilih Sub-Role --</option>
                                    <option value="Mentor" {{ old('people_role') == 'Mentor' ? 'selected' : '' }}>Mentor</option>
                                    <option value="Pekerja" {{ old('people_role') == 'Pekerja' ? 'selected' : '' }}>Pekerja</option>
                                    <option value="Konsultan" {{ old('people_role') == 'Konsultan' ? 'selected' : '' }}>Konsultan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="people_phone">Nomor Telepon</label>
                                <input type="text" id="people_phone" name="people_phone" placeholder="Masukkan nomor telepon" value="{{ old('people_phone') }}" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="people_gmail">Email</label>
                            <input type="email" id="people_gmail" name="people_gmail" placeholder="Masukkan Gmail" value="{{ old('people_gmail') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select id="gender" name="gender" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    {{-- Field Umum untuk Email dan Password --}}
                    <div class="form-row" style="display: none width: 100%;" id="field-umum-email">
                        <div class="col-md-6">
                            <div class="form-group" style="width: 100%; padding-right: 10px;">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control full-width" placeholder="Masukkan email anda" value="{{ old('email') }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="width: 100%;">
                                <label for="password">Kata Sandi</label>
                                <input type="password" id="password" name="password" class="form-control full-width" placeholder="Masukkan kata sandi anda" required minlength="8" />
                            </div>
                        </div>
                    </div>
                    <div class="form-row" style="display: hidden;" id="field-validasi-password">
                        <div class="form-group">
                            <label for="confirmPassword">Konfirmasi Kata Sandi</label>
                            <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Konfirmasi kata sandi anda" required />
                        </div>
                    </div>

                    <button class="btn-register" type="submit" id="simpanBtn">Simpan Data</button>
                    <div class="login-link">Already have an account? <a href="{{ route('login') }}">Sign In</a></div>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const userFields = document.getElementById('userFields');
            const investorFields = document.getElementById('investorFields');
            const peopleFields = document.getElementById('peopleFields');
            const fieldUmum = document.getElementById('field-umum');
            const fieldUmumEmail = document.getElementById('field-umum-email');
            const fieldValidasiPassword = document.getElementById('field-validasi-password');

            function removeRequiredAttributes(section) {
                const inputs = section.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.removeAttribute('required');
                });
            }

            function addRequiredAttributes(section) {
                const inputs = section.querySelectorAll('input, select, textarea');
                const search_input = document.getElementById('searchInput');
                inputs.forEach(input => {
                    // Mengecualikan checkbox dari penambahan atribut required
                    if (input.type !== 'checkbox') {
                        input.setAttribute('required', 'required');
                    }
                });
                search_input.removeAttribute('required');
            }

            function toggleFields() {
                const selectedRole = roleSelect.value;

                // Sembunyikan semua field spesifik role
                userFields.style.display = 'none';
                investorFields.style.display = 'none';
                peopleFields.style.display = 'none';

                // Hapus required attributes dari semua field
                removeRequiredAttributes(userFields);
                removeRequiredAttributes(investorFields);
                removeRequiredAttributes(peopleFields);
                removeRequiredAttributes(fieldUmum);
                removeRequiredAttributes(fieldUmumEmail);

                // Jika role belum dipilih, kembalikan ke tampilan default
                if (!selectedRole) {
                    fieldUmum.style.display = 'none';
                    fieldUmumEmail.style.display = 'none';
                    fieldValidasiPassword.style.display = 'none';
                    return;
                }

                // Tampilkan field umum dan tambahkan required attributes
                fieldUmum.style.display = 'flex';
                fieldUmumEmail.style.display = 'flex';
                fieldValidasiPassword.style.display = 'flex';
                addRequiredAttributes(fieldUmum);
                addRequiredAttributes(fieldUmumEmail);
                addRequiredAttributes(fieldValidasiPassword);

                // Tampilkan field sesuai role yang dipilih
                if (selectedRole === 'USER') {
                    userFields.style.display = 'block';
                    addRequiredAttributes(userFields);
                } else if (selectedRole === 'INVESTOR') {
                    investorFields.style.display = 'block';
                    addRequiredAttributes(investorFields);
                } else if (selectedRole === 'PEOPLE') {
                    peopleFields.style.display = 'block';
                    addRequiredAttributes(peopleFields);
                }
            }
            // Jalankan toggleFields saat halaman dimuat
            toggleFields();

            // Tambahkan event listener untuk perubahan role
            roleSelect.addEventListener('change', toggleFields);
        });

        function validateForm(event) {
            event.preventDefault();

            const role = document.getElementById('role').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password.length < 8) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password minimal 8 karakter.',
                });
                return;
            }

            if (password !== confirmPassword) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Password dan konfirmasi password tidak sama.',
                });
                return;
            }

            if (role === 'USER') {
                const nik = document.getElementById('nik').value;
                if (nik.length !== 16) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'NIK harus 16 digit.',
                    });
                    return;
                }
            }

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Pastikan semua data sudah benar karena tidak bisa di edit nantinya.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('registerForm').submit();
                    return false;
                }
            });
        }

        document.getElementById('registerForm').addEventListener('submit', validateForm);

        document.addEventListener('DOMContentLoaded', function () {
            const nikInput = document.getElementById('nik');
            const teleponInput = document.getElementById('telepon');
            const peoplePhoneInput = document.getElementById('people_phone');

            function restrictToNumbers(event) {
                const char = String.fromCharCode(event.which);
                if (!/[0-9]/.test(char)) {
                    event.preventDefault();
                }
            }

            function enforceLength(input, min, max) {
                input.addEventListener('blur', function () {
                    const errorMessage = document.getElementById('error-message');
                    if (this.value.length < min || this.value.length > max) {
                        errorMessage.textContent = `Input harus antara ${min} dan ${max} digit.`;
                    } else {
                        errorMessage.textContent = '';
                    }
                });
            }

            if (nikInput) {
                nikInput.addEventListener('keypress', restrictToNumbers);
                enforceLength(nikInput, 16, 16);
            }
            if (teleponInput) {
                teleponInput.addEventListener('keypress', restrictToNumbers);
            }
            if (peoplePhoneInput) {
                peoplePhoneInput.addEventListener('keypress', restrictToNumbers);
            }
        });

        @if ($errors->any())
            let errorMessage = '';
            @foreach ($errors->all() as $error)
                errorMessage += '{{ $error }}\n';
            @endforeach
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: errorMessage,
            });
        @endif
    </script>

    {{-- Bagian tempat untuk api wilayah bagian startup founder --}}
    <script>
        const provinsi = document.getElementById('provinsi');
        // URL untuk API provinsi
        const provinceApiUrl = 'https://xenodrom31.github.io/api-wilayah-indonesia/api/provinces.json';
        // Fungsi untuk mengambil dan menampilkan daftar provinsi
        function fetchProvinces() {
            fetch(provinceApiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const provinceSelect = provinsi;
                    provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>'; // Clear dan isi ulang
                    data.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.id; // Menyimpan ID provinsi
                        option.textContent = province.name; // Menampilkan nama provinsi
                        provinceSelect.appendChild(option);
                    });
                    provinceSelect.onchange = fetchCitiesByProvince; // Panggil fungsi untuk mengambil kota saat provinsi dipilih
                })
                .catch(error => console.error('Error fetching provinces:', error));
        }
        // Panggil fungsi untuk mengambil provinsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', fetchProvinces);
    </script>

     <!-- Your custom scripts -->
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
            $('input[name="tag_ids[]"]').each(function() {
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

            // Initial update of selected tags
            updateSelectedTags();

            // Form submission handler
            $('#registerForm').on('submit', function(e) {
                // Check if the role is INVESTOR and no tags are selected
                if ($('#role').val() === 'INVESTOR' && $('input[name="tag_ids[]"]:checked').length === 0) {
                    e.preventDefault();
                    alert('Pilih minimal satu department untuk Investor');
                    return false;
                }
            });

            // Role change handler
            $('#role').on('change', function() {
                if ($(this).val() === 'INVESTOR') {
                    $('#investorFields').show();
                } else {
                    $('#investorFields').hide();
                    // Uncheck all tags when role is not INVESTOR
                    $('input[name="tag_ids[]"]').prop('checked', false);
                    $('.tag-button').removeClass('selected');
                    updateSelectedTags();
                }
            });
        });
    </script>
</body>
@endsection
