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
        width: 250px;
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
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
        position: absolute; /* Pastikan hasil pencarian terletak di atas elemen lainnya */
        width: 100%;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000; /* Menempatkan hasil di atas elemen lainnya */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); /* Bayangan lebih kuat untuk efek kedalaman */
    }

    .person {
        display: flex;
        align-items: center;
        padding: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .person:hover {
        background-color: #f0f0f0; /* Efek hover */
    }

    .profile-pic {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
        object-fit: cover; /* Memastikan gambar tidak terdistorsi */
    }

    .person-info h5 {
        margin: 0;
        font-size: 1.1em;
    }

    .person-info p {
        margin: 0;
        color: #666;
        font-size: 0.9em; /* Ukuran font lebih kecil untuk email */
    }

    /* 
        Styling untuk bagian company project
    */
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
        width: 100%; /* Mengisi lebar kotak */
        height: 300px; /* Tinggi tetap */
        object-fit: cover; /* Menjaga rasio aspek */
        border-radius: 0; /* Menghilangkan sudut bulat */
        margin-bottom: 1rem;
    }
    .btn-add-project{
        background-color: #5940cb;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-top: 30px;
    }
    .project-price{
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
</style>
@endsection

@section('content')
<div class="container propil">
    <div class="container">
        <form method="POST" action="{{ route('profile-company.update', ['id' => $company->id]) }}" id="companyForm">
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

            {{-- Ini merupakan bagian untuk anggota team dari suatu company tersebut --}}
            <section>
                <div class="container team-section">
                    <h2 class="team-title">Our Team</h2>
                    <div class="team-container">
                        @if (!$team->isEmpty())
                            @foreach ($team as $person)
                                <div class="team-card">
                                    <img src="{{ isset($person->image) ? asset('images/' . $person->image) : asset('images/1720765715.webp') }}" alt="{{ $person->name }}" class="rounded-circle mb-3" width="100" height="100">
                                    <div class="team-name">{{ $person->name }}</div>
                                    <div class="team-role">{{ $person->pivot->position }}</div>
                                    <div class="action-buttons">
                                        <button class="btn-edit" data-id="{{ $person->id }}" data-name="{{ $person->name }}" data-role="{{ $person->pivot->position }}" data-photo="{{ isset($person->image) ? asset('images/' . $person->image) : asset('images/1720765715.web') }}" data-toggle="modal" data-target="#editTeamModal">Edit</button>
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

                <!-- Add Team Member Modal -->
                <div class="modal fade" id="addTeamModal" tabindex="-1" aria-labelledby="addTeamModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="height: 500px;">
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
                                        <!-- Menampilkan hasil pencarian -->
                                        <div id="peopleResults" class="people-results"></div>
                                        <!-- Hidden input untuk menyimpan ID orang -->
                                        <input type="hidden" id="selectedPersonId">
                                    </div>
                                    <div class="form-group">
                                        <label for="companyId">Company ID</label>
                                        <input type="text" class="form-control" id="companyId" value="{{ $company->id }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text" class="form-control" id="position" placeholder="Position">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="saveTeamMember">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Team Member Modal -->
                <div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="editTeamModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTeamModalLabel">Edit Team Member Position</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editTeamForm">
                                    <input type="hidden" id="editTeamId"> <!-- Hidden input untuk ID anggota tim -->
                                    <div class="form-group">
                                        <label for="editPosition">Position</label>
                                        <input type="text" class="form-control" id="editPosition" placeholder="Position">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="updateTeamMember">Update</button>
                            </div>
                        </div>
                    </div>
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
    <!-- JavaScript for handling AJAX requests -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>

    {{-- ! Javascript untuk menangani handle terkait team baik untuk menambahkan menghapus dan mencari orang --}}
    <script>
      $(document).ready(function() {
        // Menangani input pencarian orang
        $('#searchPeople').on('input', function() {
                var query = $(this).val();
                if (query.length > 2) {
                    $.ajax({
                        url: '/search-people',
                        method: 'GET',
                        data: { query: query },
                        success: function(response) {
                            var peopleList = '';
                            console.log(response); // Lihat respons dari backend
                            response.forEach(function(person) {
                                peopleList += `
                                    <div class="person" data-id="${person.id}">
                                        <img src="${person.photo_url || 'images/1720765715.webp'}" alt="${person.name}" class="profile-pic">
                                        <div class="person-info">
                                            <h5>${person.name}</h5>
                                            <p>${person.gmail}</p>
                                        </div>
                                    </div>
                                `;
                            });
                            $('#peopleResults').html(peopleList).show();
                            console.log($('#peopleResults').html()); // Lihat apakah konten sudah terisi

                        },
                        error: function(xhr) {
                            console.error('AJAX error: ', xhr);
                        }
                    });
                } else {
                    $('#peopleResults').html('').hide();
                }
         });

        // Menambahkan event click pada setiap item orang
        $('#peopleResults').on('click', '.person', function() {
            var personId = $(this).data('id');
            $('#selectedPersonId').val(personId);
        });

        //Menyimpan ID orang yang dipilih 
        $('#peopleResults').on('click', '.person', function() {
            var personId = $(this).data('id');
            $('#selectedPersonId').val(personId);
        });

        // Menyimpan ID orang yang dipilih
        $('#peopleResults').on('click', '.person', function() {
            var selectedId = $(this).data('id');
            console.log(selectedId);
            $('#selectedPersonId').val(selectedId); // Menyimpan ID orang terpilih
            $('#searchPeople').val($(this).find('h5').text()); // Mengganti input dengan nama orang yang dipilih (hanya nama)
            $('#peopleResults').html(''); // Menghapus hasil pencarian
        });

        // Menyimpan anggota tim ketika tombol "Save" diklik
        $('#saveTeamMember').on('click', function() {
            $('#confirmModal').modal('show');

            $('#confirmSaveButton').off('click').on('click', function(){
                var personId = $('#selectedPersonId').val();
                var companyId = $('#companyId').val();
                var position = $('#position').val();
    
                if (personId && position) {
                    // Kirim data ke backend
                    $.ajax({
                        url: '/team/store', // Endpoint backend untuk menambah anggota tim
                        method: 'POST',
                        data: {
                            person_id: personId,
                            company_id: companyId,
                            position: position,
                            _token: "{{ csrf_token() }}" // tambahkan CSRF token untuk keamanan
                        },
                        success: function(response) {
                            alert('Team member added successfully!');
                            // Tutup modal setelah berhasil disimpan
                            $('#addTeamModal').modal('hide');
                            location.reload(); // Reload halaman untuk memperbarui daftar tim
                        },
                        error: function(xhr) {
                            // Menangani kesalahan server (500) dan kesalahan validasi (422)
                            if (xhr.status === 422) {
                                // Kesalahan validasi
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = [];
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessages.push(errors[key].join(', ')); // Menggabungkan pesan kesalahan
                                    }
                                }
                                alert('Validation Error: \n' + errorMessages.join('\n'));
                            } else if (xhr.status === 500) {
                                // Kesalahan server
                                alert('Server Error: Please try again later.');
                            } else {
                                // Kesalahan lain
                                alert('Error adding team member: ' + xhr.responseText);
                            }
                        }
                    });
                } else {
                    alert('Please select a person and enter a position.');
                }
            })
        });

        // Menangani klik pada tombol edit
        $('.btn-edit').on('click', function(event) {
            event.preventDefault(); // Mencegah refresh

            var teamId = $(this).data('id'); // Ambil ID anggota tim dari data attribute
            $('#editTeamId').val(teamId); // Set ID ke input hidden

            // Ambil data anggota tim
            $.ajax({
                url: '/team/' + teamId + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editPosition').val(data.position); // Set nilai posisi ke input
                    $('#editTeamModal').modal('show'); // Tampilkan modal
                },
                error: function(xhr) {
                    alert('Error fetching team member data.');
                }
            });
        });

        // Update team member position
        $('#updateTeamMember').on('click', function(event) {
            event.preventDefault(); // Mencegah default behavior form
            $('#confirmModal').modal('show'); // Tampilkan modal konfirmasi

            $('#confirmSaveButton').off('click').on('click', function() {
                var teamId = $('#editTeamId').val();
                var position = $('#editPosition').val();

                $.ajax({
                    url: '/team/' + teamId,
                    method: 'PUT',
                    data: {
                        position: position,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert('Team member position updated successfully!');
                        $('#editTeamModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = [];
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    errorMessages.push(errors[key].join(', '));
                                }
                            }
                            alert('Validation Error: \n' + errorMessages.join('\n'));
                        } else {
                            alert('Error updating team member.');
                        }
                    }
                });
            });
        });


        // Menangani klik pada tombol delete
        $('.btn-delete').on('click', function(event) {
            event.preventDefault(); // Mencegah refresh
            var teamId = $(this).data('id');
            var companyId = $(this).data('company-id');

            $('#confirmModal').modal('show'); // Tampilkan modal konfirmasi

            $('#confirmSaveButton').off('click').on('click', function() {
                $.ajax({
                    url: '/team/' + teamId + '/' + companyId + '/delete',
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        alert(data.message);
                        $('#team-member-' + teamId).remove();
                    },
                    error: function(xhr) {
                        alert('Error deleting team member: ' + xhr.responseJSON.error || 'Unknown error');
                    }
                });
            });
        });
    });
    </script>  
</div>
@endsection
