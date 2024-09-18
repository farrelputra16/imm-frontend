@extends('layouts.app-imm')
@section('title', 'Profil Perusahaan')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&family=Quicksand:wght@300..700&display=swap");
html,
body {
    margin: 0;
    font-family: "Poppins", sans-serif;
}

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

.btn-masuk {
    width: 183px;
    height: 35px;
    background-color: #5940cb;
    color: white;
    border: none;
    border-radius: 7px;
}

.btn-masukkk {
    width: 383px;
    height: 35px;
    background-color: #5940cb;
    color: white;
    border: none;
    border-radius: 7px;
}

.btn-masukkk:hover {
    background-color: #5e41de;
}

.modal-content {
    width: 699px;
    height: 253px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-body {
    gap: 20px;
    margin: 0 51px;
    height: 100%;
    display: flex;
    align-items: start;
    justify-content: center;
    flex-direction: column;
}

.btnn {
    display: flex;
    align-content: center;
    justify-content: space-around;
    width: 100%;
}


/* Navbar */

.propil {
    margin-top: 120px;
}


/* Footer */

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
</style>
@endsection

@section('content')
<div class="container propil">
    <div class="container">
        <form method="POST" action="{{ route('profile-commpany.update', ['id' => $company->id]) }}" id="companyForm">
            @csrf
            @method('PUT')
            <section>
                <div class="row mt-5 d-flex justify-content-center">
                    <div class="col-12 col-md-10">
                        <div class="row mb-3">
                            <div class="d-flex align-items-center">
                                <h5 class="mr-5">Edit Data Perusahaan</h5>
                                <img style="cursor: pointer" id="editButton" src="{{ asset('images/icon-edit.svg') }}" width="20" alt="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput1" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama" class="form-control" id="formGroupExampleInput1" placeholder="Nama Perusahaan" value="{{ $company->nama }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Profil Perusahaan</label>
                            <input type="text" name="profile" class="form-control" id="formGroupExampleInput2" placeholder="Profil Perusahaan" value="{{ $company->profile }}" readonly>
                        </div>
                        <!-- Tambahan untuk Founded Date -->
                        <div class="mb-3">
                            <label for="formGroupExampleInput11" class="form-label">Tanggal Berdiri</label>
                            <input type="date" name="founded_date" class="form-control" id="formGroupExampleInput11" placeholder="Tanggal Berdiri" value="{{ $company->founded_date }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput3" class="form-label">Nama PIC</label>
                            <input type="text" name="nama_pic" class="form-control" id="formGroupExampleInput3" placeholder="Nama PIC" value="{{ $company->nama_pic }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput4" class="form-label">Posisi PIC</label>
                            <input type="text" name="posisi_pic" class="form-control" id="formGroupExampleInput4" placeholder="Posisi PIC" value="{{ $company->posisi_pic }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput5" class="form-label">Nomor Telepon</label>
                            <input type="number" name="telepon" class="form-control" id="formGroupExampleInput5" placeholder="Nomor Telepon" value="{{ $company->telepon }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput8" class="form-label">Negara</label>
                            <input type="text" name="negara" class="form-control" id="formGroupExampleInput8" placeholder="Negara" value="{{ $company->negara }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput9" class="form-label">Provinsi</label>
                            <input type="text" name="provinsi" class="form-control" id="formGroupExampleInput9" placeholder="Provinsi" value="{{ $company->provinsi }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput10" class="form-label">Kota/Kabupaten</label>
                            <input type="text" name="kabupaten" class="form-control" id="formGroupExampleInput10" placeholder="Kabupaten" value="{{ $company->kabupaten }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput6" class="form-label">Jumlah Pekerja</label>
                            <input type="number" name="jumlah_karyawan" class="form-control" id="formGroupExampleInput6" placeholder="Jumlah Pekerja" value="{{ $company->jumlah_karyawan }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput7" class="form-label">Tipe Perusahaan</label>
                            <input type="text" name="tipe" class="form-control" id="formGroupExampleInput7" placeholder="Tipe Perusahaan" value="{{ $company->tipe }}" readonly>
                        </div>
                         
                        <!-- Tambahan untuk Startup Summary -->
                        <div class="mb-3">
                            <label for="formGroupExampleInput12" class="form-label">Ringkasan Startup</label>
                            <textarea name="startup_summary" class="form-control" id="formGroupExampleInput12" placeholder="Ringkasan Singkat Startup" rows="5" readonly>{{ $company->startup_summary }}</textarea>
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
        </form>
    </div>

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
            document.getElementById('saveButton').style.display = 'block';
            document.getElementById('editButton').style.display = 'none';
        });

        document.getElementById('confirmSaveButton').addEventListener('click', function() {
            document.getElementById('companyForm').submit();
        });
    </script>
</div>
@endsection
