@extends('layouts.app-2fa')
@section('title', 'Pendaftaran Perusahaan')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/imm/pendaftaranperusahaan.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
@endsection
@section('content')

<body>

   


    <div class="register-container">
        <h2>Daftarkan Perusahaan Anda</h2>
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="register-form row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Perusahaan" required>
                    </div>
                    <div class="form-group">
                        <label for="profile">Profil Perusahaan</label>
                        <input type="text" class="form-control" id="profile" name="profile" placeholder="Masukkan link disini" required>
                        <small class="form-text text-muted">Dalam bentuk website, media sosial, atau lainnya</small>
                    </div>
                    <div class="form-group">
                        <label for="nama_pic">Nama PIC</label>
                        <input type="text" class="form-control" id="nama_pic" name="nama_pic" placeholder="Masukkan Nama PIC" required>
                    </div>
                    <div class="form-group">
                        <label for="posisi_pic">Posisi PIC</label>
                        <input type="text" class="form-control" id="posisi_pic" name="posisi_pic" placeholder="Masukkan Posisi PIC" required>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput5" class=" font-weight-bold">Nomor Telepon</label>
                        <input type="number" name="telepon" class="form-control" id="formGroupExampleInput5" placeholder="Masukkan Nomor Telepon" value="" pattern="[0-9]*" inputmode="numeric">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="negara">Negara</label>
                        <input type="text" class="form-control" id="negara" name="negara" placeholder="Masukkan negara anda" required>
                    </div>
                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Masukkan provinsi anda" required>
                    </div>
                    <div class="form-group">
                        <label for="kabupaten">Kota/Kabupaten</label>
                        <input type="text" class="form-control" id="kabupaten" name="kabupaten" placeholder="Masukkan kota/kabupaten anda" required>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput6" class=" font-weight-bold">Jumlah Pekerja</label>
                        <input type="text" name="jumlah_karyawan" class="form-control" id="formGroupExampleInput6" placeholder="Masukkan Jumlah Pekerja" value=""  pattern="[0-9]*" inputmode="numeric">
                    </div>
                    <div class="form-group">
                        <label for="tipe">Tipe Perusahaan</label>
                        <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Masukkan Tipe Perusahaan" required>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-primary" type="submit" id="simpanBtn">Simpan Data</button>
                </div>
            </div>
        </form>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const teleponInput = document.getElementById('formGroupExampleInput5');
            const jumlahKaryawanInput = document.getElementById('formGroupExampleInput6');
    
            teleponInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
    
            jumlahKaryawanInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('js/imm/pendaftaran.js') }}"></script>

</body>
@endsection