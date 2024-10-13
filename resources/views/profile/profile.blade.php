@extends('layouts.app-imm')
@section('title', 'Profil')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/profile/profile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .biodata {
        word-wrap: break-word;
        overflow-wrap: break-word;
        width: 100%;
    }

    .section {
        margin-top: 80px;
        margin-bottom: 120px;
        display: flex;
        align-items: center;
        justify-content: start;
        background-color: #E6E3F1;
        padding: 20px 0;
        border-radius: 10px;
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

    .profile-section:hover {
        transform: scale(1.1);
    }

    th, td {
        text-align: center;
        vertical-align: middle;
    }

    /* Add background color to the table header */
    .table-responsive thead th {
        background-color: #6f42c1 !important; /* Forcing the background color */
        color: white !important; /* Forcing the text color */
    }


    td {
        vertical-align: middle; /* Ensures cell content is vertically centered */
    }

    td div {
        display: flex;
        align-items: center; /* Vertically center for image and text */
    }

    td img {
        margin-right: 10px; /* Space between image and company name */
    }

    td span {
        white-space: nowrap; /* Prevents company name from wrapping */
        overflow: hidden; /* Ensures no overflow */
        text-overflow: ellipsis; /* Adds '...' for truncated text */
    }

    /* Custom width for columns */
    th:nth-child(1),
    td:nth-child(1) {
        width: 5%; /* Checkbox column */
    }

    th:nth-child(2),
    td:nth-child(2) {
        width: 20%; /* Organization Name */
    }

    th:nth-child(3),
    td:nth-child(3) {
        width: 15%; /* Founded Date */
    }

    th:nth-child(4),
    td:nth-child(4) {
        width: 15%; /* Last Funding Date */
    }

    th:nth-child(5),
    td:nth-child(5) {
        width: 15%; /* Last Funding Type */
    }

    th:nth-child(6),
    td:nth-child(6) {
        width: 15%; /* Employee */
    }

    th:nth-child(7),
    td:nth-child(7) {
        width: 10%; /* Industries */
    }

    th:nth-child(8),
    td:nth-child(8) {
        width: 15%; /* Description */
    }

    th:nth-child(9),
    td:nth-child(9) {
        width: 15%; /* Job Departments */
    }

    /* Align text to the start (left-aligned) for specific columns */
    td:nth-child(7), /* Industries */
    td:nth-child(8), /* Description */
    td:nth-child(9)  /* Job Departments */ {
        text-align: start;
        vertical-align: middle;
    }

    .btn-primary-red {
        background-color: #be184a;
        color: white;
        font-size: 20px;
        font-weight: 500;
        border-radius: 9px;
    }

    .btn-primary-red:hover {
        background-color: #e6084b;
        color: white;
        font-size: 20px;
        font-weight: 500;
        border-radius: 9px;

    }

    .pagination {
        display: flex;
        justify-content: center;
        padding: 10px 0;
    }

    .pagination .page-item {
        position: relative;
    }

    .pagination .page-link {
        color: #6256CA; /* Warna teks pagination */
        padding: 10px 15px; /* Padding biasa (tinggi sedikit ditambah) */
        border-top: 1px solid black; /* Border atas hitam */
        border-bottom: 1px solid black; /* Border bawah hitam */
        border-left: none; /* Hilangkan border kiri */
        border-right: none; /* Hilangkan border kanan */
        height: auto; /* Mengatur tinggi secara otomatis */
        line-height: 1; /* Menjaga elemen tidak terlalu tinggi */
        border-radius: 0; /* Border tanpa radius (kotak) */
        background-color: transparent; /* Latar belakang default */
    }

    .pagination .page-item:not(:last-child)::after {
        content: '|'; /* Tambahkan simbol garis pemisah */
        position: absolute; /* Posisi absolut */
        right: 2px; /* Tempatkan di sisi kanan elemen */
        top: 50%; /* Jarak dari atas (posisi vertikal disesuaikan) */
        transform: translateY(-50%); /* Pusatkan secara vertikal */
        color: #000000; /* Warna garis pemisah */
        height: 60%; /* Sesuaikan tinggi agar tidak menyentuh border atas dan bawah */
        width: 0px; /* Lebar garis vertikal */
        background-color: #000000; /* Warna garis pemisah */
        z-index: 2; /* Pastikan garis berada di atas border elemen */
    }

    .pagination .page-item.active .page-link {
        color: white; /* Warna teks untuk elemen aktif */
    }

    .pagination .page-item.active .page-link::before {
        content: ''; /* Pseudo-element kosong untuk background */
        position: absolute; /* Posisi absolut */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%); /* Pusatkan di tengah */
        width: 70%; /* Ukuran penuh */
        height: 70%;
        background-color: #6256CA; /* Warna background aktif */
        border-radius: 100%; /* Membuat background berbentuk lingkaran */
        z-index: -1; /* Pseudo-element di belakang teks */
    }

    .pagination .page-item.disabled .page-link {
        color: #aaa; /* Warna untuk item disabled */
        pointer-events: none; /* Nonaktifkan klik pada item disabled */
    }

    .pagination .page-item:first-child .page-link {
        padding: 10px 20px; /* Sesuaikan padding untuk Previous */
        border-top-left-radius: 5px; /* Radius sudut kiri atas */
        border-bottom-left-radius: 5px; /* Radius sudut kiri bawah */
        border-right: none; /* Hilangkan border kanan */
        border-left: solid 1px #2b2b2c; /* Tambahkan border kiri */
    }

    .pagination .page-item:last-child .page-link {
        padding: 10px 20px; /* Sesuaikan padding untuk Next */
        border-top-right-radius: 5px; /* Radius sudut kanan atas */
        border-bottom-right-radius: 5px; /* Radius sudut kanan bawah */
        border-left: none; /* Hilangkan border kiri */
        border-right: solid 1px #2b2b2c; /* Tambahkan border kanan */
    }


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

        .biodata {
            display: flex;
            flex-direction: column;
            align-content: center;
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
<div class="container pt-2 row-gap-2">
    <div class="row section" style="margin-bottom: 30px;">
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
    <div class="container pt-2 row-gap-2">
        <div class="row section" style="padding-left: 20px; padding-right: 20px;">
            <h2>Your Wishlist</h2>
            <div class="table-responsive">
                <table class="table table-hover table-striped" style="margin-bottom:0px;">
                    <thead>
                        <tr>
                            <th scope="col" style="border-top-left-radius: 20px;"><input type="checkbox" value="all_check" id="select_all"></th>
                            <th scope="col">Organization <br> Name</th>
                            <th scope="col">Founded <br> Date</th>
                            <th scope="col">Last Funding <br> Date</th>
                            <th scope="col">Last Funding <br> Type</th>
                            <th scope="col">Number of <br> Employees</th>
                            <th scope="col">Industries</th>
                            <th scope="col">Description</th>
                            <th scope="col" style="border-top-right-radius: 20px; text-align: start; vertical-align: middle;">Job <br> Departments</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companiesWithWishlist as $company)
                        <tr data-href="{{ route('companies.show' , $company->id) }}">
                            <th scope="row">
                                <input type="checkbox" class="select_company" data-id="{{ $company->id }}">
                            </th>
                            <td>
                                <div style="display: flex; align-items: center;">
                                    <img src="{{ !empty($company->image) ? asset($company->image) : asset('images/logo-maxy.png') }}" alt="" width="50" height="50" style="border-radius: 8px; object-fit:cover; margin-right: 20px;">
                                    <span style="white-space: nowrap;">{{ $company->nama }}</span>
                                </div>
                            </td>
                            <td>
                                <i class="fas fa-search" style="color: #aee1b7; margin-right: 10px;"></i>
                                {{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('j M, Y') : 'N/A' }}
                            </td>
                            <td>
                                {{ $company->latest_income_date ? \Carbon\Carbon::parse($company->latest_income_date)->format('j M, Y') : 'N/A' }}
                            </td>
                            <td>
                                @if ($company->latest_funding_type)
                                    {{ $company->latest_funding_type }}
                                @else
                                    No funding data available
                                @endif
                            </td>
                            <td>
                                {{ $company->jumlah_karyawan }}
                            </td>
                            <td>{{ $company->tipe }}</td>
                            <td>{{ Str::limit($company->startup_summary, 25 , '...') }}</td>
                            <td>{{ $company->posisi_pic }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Footer sebagai bagian dari tabel -->
                <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff;  border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; margin-top:0px; height:100px;">
                    <form method="GET" action="{{ route('profile') }}" class="mb-0">
                        <div class="d-flex align-items-center">
                            <label for="rowsPerPage" class="me-2">Rows per page:</label>
                            <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()" style="width: 75px;">
                                <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                                <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            <div>
                                <span>Total {{ $companiesWithWishlist->firstItem() }} - {{ $companiesWithWishlist->lastItem() }} of {{ $companiesWithWishlist->total() }}</span>
                            </div>
                        </div>
                    </form>
                    <div>
                        {{ $companiesWithWishlist->links('pagination::bootstrap-4') }} <!-- Gunakan link pagination default -->
                    </div>
                </div>
                <div class="align-self-center ">
                    <form action="{{ route('wishlist.remove') }}" method="POST" id="wishlistForm">
                        @csrf
                        @method('DELETE') <!-- This line is crucial to simulate the DELETE method -->
                        <input type="hidden" name="company_ids" id="company_ids" value="">
                        <button type="submit" class="btn btn-primary-red wishlist-button" style="display: none;">Remove from Wishlist</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelectorAll('tr[data-href]').forEach(tr => {
            tr.addEventListener('click', function(e) {
                // Check if the click was on the checkbox, if so, do nothing
                if (e.target.type !== 'checkbox') {
                    window.location.href = this.dataset.href;
                }
            });
        });

    document.getElementById('select_all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.select_company');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    document.querySelector('.wishlist-button').style.display = 'flex';
                } else {
                    document.querySelector('.wishlist-button').style.display = 'none';
                    checkbox.checked = false;
                }
            });

            if (this.checked) {
                document.querySelector('.wishlist-button').style.display = 'flex';
            } else {
                document.querySelector('.wishlist-button').style.display = 'none';
            }
        });
    });// Select all checkbox event listener
// Select all checkbox event listener
    document.getElementById('select_all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.select_company');
        let selectAll = this;

        // Loop through all checkboxes and set them to the same state as "select all"
        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAll.checked;
        });

        // Toggle wishlist button visibility based on select all checkbox
        toggleWishlistButton();

        // Add event listeners to individual checkboxes to handle changes after "Select All" is clicked
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                // If any checkbox is unchecked, uncheck the "Select All" box
                if (!checkbox.checked) {
                    selectAll.checked = false;
                }
                // If all checkboxes are checked, check the "Select All" box
                if (document.querySelectorAll('.select_company:checked').length === checkboxes.length) {
                    selectAll.checked = true;
                }

                // Toggle wishlist button visibility based on individual checkbox changes
                toggleWishlistButton();
            });
        });
    });

    // Function to show/hide the wishlist button
    function toggleWishlistButton() {
        let checkedCheckboxes = document.querySelectorAll('.select_company:checked');
        let wishlistButton = document.querySelector('.wishlist-button');
        if (checkedCheckboxes.length > 0) {
            wishlistButton.style.display = 'flex';
        } else {
            wishlistButton.style.display = 'none';
        }
    }

    let checkboxes = document.querySelectorAll('.select_company');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let checkedCheckboxes = document.querySelectorAll('.select_company:checked');
            let wishlistButton = document.querySelector('.wishlist-button');
            let companyIds = Array.from(checkedCheckboxes).map(checkbox => checkbox.dataset.id).join(',');
            document.getElementById('company_ids').value = companyIds;

            if (checkedCheckboxes.length > 0) {
                wishlistButton.style.display = 'flex';
            } else {
                wishlistButton.style.display = 'none';
            }
        });
    });

</script>
@endsection
