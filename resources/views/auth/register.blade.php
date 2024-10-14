@extends('layouts.app-2fa')
@section('title', 'Create your account')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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
                    <div class="form-row">
                        <div class="form-group">
                            <label for="nama_depan">Nama Depan</label>
                            <input type="text" id="nama_depan" name="nama_depan" placeholder="Masukkan nama depan anda" value="{{ old('nama_depan') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="nama_belakang">Nama Belakang</label>
                            <input type="text" id="nama_belakang" name="nama_belakang" placeholder="Masukkan nama belakang anda" value="{{ old('nama_belakang') }}" required />
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
                                <input type="text" id="provinsi" name="provinsi" placeholder="Masukkan provinsi anda" value="{{ old('provinsi') }}" required />
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
                <option value="Pre-Seed" {{ old('investment_stage') == 'Pre-Seed' ? 'selected' : '' }}>Pre-Seed</option>
                <option value="Seed" {{ old('investment_stage') == 'Seed' ? 'selected' : '' }}>Seed</option>
                <option value="Series A" {{ old('investment_stage') == 'Series A' ? 'selected' : '' }}>Series A</option>
                <option value="Series B" {{ old('investment_stage') == 'Series B' ? 'selected' : '' }}>Series B</option>
                <option value="Series C" {{ old('investment_stage') == 'Series C' ? 'selected' : '' }}>Series C</option>
                <option value="Series D" {{ old('investment_stage') == 'Series D' ? 'selected' : '' }}>Series D</option>
                <option value="IPO" {{ old('investment_stage') == 'IPO' ? 'selected' : '' }}>IPO</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" placeholder="Masukkan deskripsi" rows="3" required>{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
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
                            <label for="people_gmail">Gmail</label>
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

                    {{-- Field Umum untuk Semua Role --}}
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukkan email anda" value="{{ old('email') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi anda" required minlength="8" />
                        </div>
                    </div>
                    <div class="form-row">
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

            function removeRequiredAttributes(section) {
                const inputs = section.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.removeAttribute('required');
                });
            }

            function addRequiredAttributes(section) {
                const inputs = section.querySelectorAll('input, select, textarea');
                inputs.forEach(input => {
                    input.setAttribute('required', 'required');
                });
            }

            function toggleFields() {
                const selectedRole = roleSelect.value;
                userFields.style.display = 'none';
                investorFields.style.display = 'none';
                peopleFields.style.display = 'none';

                removeRequiredAttributes(userFields);
                removeRequiredAttributes(investorFields);
                removeRequiredAttributes(peopleFields);

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

            toggleFields();

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
</body>
@endsection
