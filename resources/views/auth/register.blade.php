{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.app-2fa')
@section('title', 'Daftar')

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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .register-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .brand-logo {
            width: 137px;
            margin-bottom: 20px;
        }

        .register-form h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #000000;
            font-weight: bold;
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
            color: #000000;
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
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container">
        <div class="register-container">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <div class="register-form">
                    <img src="{{ asset('images/imm.png') }}" alt="Brand Logo" class="brand-logo">
                    <h2>Daftarkan Akun</h2>

                    {{-- Role Selection --}}
                    <div class="form-group" style="width: 100%;">
                        <label for="role">Pilih Role</label>
                        <select id="role" name="role" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="USER" {{ old('role') == 'USER' ? 'selected' : '' }}>User</option>
                            <option value="INVESTOR" {{ old('role') == 'INVESTOR' ? 'selected' : '' }}>Investor</option>
                            <option value="PEOPLE" {{ old('role') == 'PEOPLE' ? 'selected' : '' }}>People</option>
                        </select>
                    </div>

                    {{-- USER Role Fields --}}
                    <div id="userFields" class="role-section">
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
                    </div>

                    <!-- INVESTOR Role Fields -->
<div id="investorFields" class="role-section">
    <div class="form-row">
        <!-- Nama Depan dan Nama Belakang (diperlukan oleh semua role) -->
        <div class="form-group">
            <label for="nama_depan">Nama Depan</label>
            <input type="text" id="nama_depan" name="nama_depan" placeholder="Masukkan nama depan anda" value="{{ old('nama_depan') }}" required />
        </div>
        <div class="form-group">
            <label for="nama_belakang">Nama Belakang</label>
            <input type="text" id="nama_belakang" name="nama_belakang" placeholder="Masukkan nama belakang anda" value="{{ old('nama_belakang') }}" required />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="org_name">Nama Organisasi</label>
            <input type="text" id="org_name" name="org_name" placeholder="Masukkan nama organisasi" value="{{ old('org_name') }}" required />
        </div>
        <div class="form-group">
            <label for="contact_number">Nomor Kontak</label>
            <input type="text" id="contact_number" name="contact_number" placeholder="Masukkan nomor kontak" value="{{ old('number_of_contacts') }}" required />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="number_of_investments">Jumlah Investasi</label>
            <input type="number" id="number_of_investments" name="number_of_investments" placeholder="Jumlah investasi" value="{{ old('number_of_investments') }}" min="0" required />
        </div>
        <div class="form-group">
            <label for="location">Lokasi</label>
            <input type="text" id="location" name="location" placeholder="Masukkan lokasi" value="{{ old('location') }}" required />
        </div>
    </div>
    <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea id="description" name="description" placeholder="Masukkan deskripsi" rows="3" required>{{ old('description') }}</textarea>
    </div>
    <div class="form-group">
        <label for="departments">Departemen</label>
        <input type="text" id="departments" name="departments" placeholder="Departemen" value="{{ old('departments') }}" required />
    </div>
</div>


                    {{-- PEOPLE Role Fields --}}
                    <div id="peopleFields" class="role-section">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="job_title">Jabatan Utama</label>
                                <input type="text" id="job_title" name="job_title" placeholder="Masukkan jabatan utama" value="{{ old('job_title') }}" />
                            </div>
                            <div class="form-group">
                                <label for="primary_organization">Organisasi Utama</label>
                                <input type="text" id="primary_organization" name="primary_organization" placeholder="Masukkan organisasi utama" value="{{ old('primary_organization') }}" />
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
                                <input type="text" id="people_phone" name="people_phone" placeholder="Masukkan nomor telepon" value="{{ old('people_phone') }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="people_gmail">Gmail</label>
                            <input type="email" id="people_gmail" name="people_gmail" placeholder="Masukkan Gmail" value="{{ old('people_gmail') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="people_location">Lokasi</label>
                            <input type="text" id="people_location" name="people_location" placeholder="Masukkan lokasi" value="{{ old('people_location') }}" />
                        </div>
                        <div class="form-group">
                            <label for="people_regions">Region</label>
                            <input type="text" id="people_regions" name="people_regions" placeholder="Masukkan region" value="{{ old('people_regions') }}" />
                        </div>
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select id="gender" name="gender" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="linkedin_link">LinkedIn</label>
                            <input type="url" id="linkedin_link" name="linkedin_link" placeholder="Masukkan link LinkedIn" value="{{ old('linkedin_link') }}" />
                        </div>
                        <div class="form-group">
                            <label for="people_description">Deskripsi</label>
                            <textarea id="people_description" name="people_description" placeholder="Masukkan deskripsi" rows="3">{{ old('people_description') }}</textarea>
                        </div>
                    </div>

                    {{-- Common Fields for All Roles --}}
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Masukkan email anda" value="{{ old('email') }}" required />
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi</label>
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi anda" value="{{ old('password') }}" required minlength="8" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="confirmPassword">Konfirmasi Kata Sandi</label>
                            <input type="password" id="confirmPassword" name="password_confirmation" placeholder="Konfirmasi kata sandi anda" required />
                        </div>
                    </div>

                    <button class="btn-register" type="submit" id="simpanBtn">Simpan Data</button>
                    <div class="login-link">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></div>
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

    // Function to remove 'required' attribute from fields within a section
    function removeRequiredAttributes(section) {
        const inputs = section.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.removeAttribute('required');
        });
    }

    // Function to add 'required' attribute to fields within a section
    function addRequiredAttributes(section) {
        const inputs = section.querySelectorAll('input, select');
        inputs.forEach(input => {
            input.setAttribute('required', 'required');
        });
    }

    function toggleFields() {
        const selectedRole = roleSelect.value;
        userFields.style.display = 'none';
        investorFields.style.display = 'none';
        peopleFields.style.display = 'none';

        // Remove 'required' from all fields initially
        removeRequiredAttributes(userFields);
        removeRequiredAttributes(investorFields);
        removeRequiredAttributes(peopleFields);

        if (selectedRole === 'USER') {
            userFields.style.display = 'block';
            addRequiredAttributes(userFields); // Add 'required' to the visible section
        } else if (selectedRole === 'INVESTOR') {
            investorFields.style.display = 'block';
            addRequiredAttributes(investorFields); // Add 'required' to the visible section
        } else if (selectedRole === 'PEOPLE') {
            peopleFields.style.display = 'block';
            addRequiredAttributes(peopleFields); // Add 'required' to the visible section
        }
    }

    // Initialize fields based on old input
    toggleFields();

    roleSelect.addEventListener('change', toggleFields);
});


        // Function to validate form and show SweetAlert2 popups
        function validateForm(event) {
            event.preventDefault(); // Prevent form submission initially

            const role = document.getElementById('role').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            // Basic Validation
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

            // Role-specific Validation
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

        // Input Restrictions
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

            nikInput.addEventListener('keypress', restrictToNumbers);
            teleponInput.addEventListener('keypress', restrictToNumbers);
            if (peoplePhoneInput) {
                peoplePhoneInput.addEventListener('keypress', restrictToNumbers);
            }

            enforceLength(nikInput, 16, 16);
        });

        // Attach form validation
        document.getElementById('registerForm').addEventListener('submit', validateForm);

        // Handle server-side validation errors
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
</html>
@endsection
