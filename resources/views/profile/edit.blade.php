@extends('layouts.app-imm')
@section('title', 'Edit Profil')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile/profiledit.css') }}">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
<style>
    body {
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
    width: 100%;
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
    border: 2px solid #6256CA;
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
</style>
@endsection

@section('content')

<form action="{{ route('profile.update', $user->id) }}" method="POST" id="profileForm" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="container d-flex flex-column">
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
                    <input type="text" id="nik" name="nik" class="custom-input" value="{{ $user->nik }}">
                </div>
                <div class="input-form" class="sub-heading-1">
                    <label for="email" class="sub-heading-1">Email</label>
                    <input type="email" id="email" name="email" class="custom-input" value="{{ $user->email }}" readonly>
                </div>
                @if ($user->role == 'INVESTOR')
                    <div class="input-form">
                        <label for="org_name" class="sub-heading-1">Nama Organisasi</label>
                        <select id="org_name" name="org_name" class="form-control select2-search" required>
                            <option value="">Tidak Ada Organisasi</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('org_name', $investor->org_name) == $company->nama ? 'selected' : '' }}>
                                    {{ $company->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-form">
                        <label for="investment_stage" class="sub-heading-1">Tahap Investasi</label>
                        <select id="investment_stage" name="investment_stage" class="form-control custom-input" style="height: 100%" required>
                            <option value="">Pilih Tahap Investasi</option>
                            <option value="Pre Seed" {{ $investor->investment_stage == 'Pre Seed' ? 'selected' : '' }}>Pre-Seed</option>
                            <option value="seed" {{ $investor->investment_stage == 'seed' ? 'selected' : '' }}>Seed</option>
                            <option value="Series A" {{ $investor->investment_stage == 'Series A' ? 'selected' : '' }}>Series A</option>
                            <option value="Series B" {{ $investor->investment_stage == 'Series B' ? 'selected' : '' }}>Series B</option>
                            <option value="Series C" {{ $investor->investment_stage == 'Series C' ? 'selected' : '' }}>Series C</option>
                            <option value="Series D" {{ $investor->investment_stage == 'Series D' ? 'selected' : '' }}>Series D</option>
                            <option value="Series E" {{ $investor->investment_stage == 'Series E' ? 'selected' : '' }}>Series E</option>
                            <option value="Series F" {{ $investor->investment_stage == 'Series F' ? 'selected' : '' }}>Series F</option>
                            <option value="Series G" {{ $investor->investment_stage == 'Series G' ? 'selected' : '' }}>Series G</option>
                            <option value="Series H" {{ $investor->investment_stage == 'Series H' ? 'selected' : '' }}>Series H</option>
                            <option value="Series I" {{ $investor->investment_stage == 'Series I' ? 'selected' : '' }}>Series I</option>
                            <option value="Series J" {{ $investor->investment_stage == 'Series J' ? 'selected' : '' }}>Series J</option>
                            <option value="venture_series_unknown" {{ $investor->investment_stage == 'venture_series_unknown' ? 'selected' : '' }}>Venture - Series Unknown</option>
                            <option value="angel" {{ $investor->investment_stage == 'angel' ? 'selected' : '' }}>Angel</option>
                            <option value="private_equity" {{ $investor->investment_stage == 'private_equity' ? 'selected' : '' }}>Private Equity</option>
                            <option value="debt_financing" {{ $investor->investment_stage == 'debt_financing' ? 'selected' : '' }}>Debt Financing</option>
                            <option value="convertible_note" {{ $investor->investment_stage == 'convertible_note' ? 'selected' : '' }}>Convertible Note</option>
                            <option value="grant" {{ $investor->investment_stage == 'grant' ? 'selected' : '' }}>Grant</option>
                            <option value="corporate_round" {{ $investor->investment_stage == 'corporate_round' ? 'selected' : '' }}>Corporate Round</option>
                            <option value="equity_crowdfunding" {{ $investor->investment_stage == 'equity_crowdfunding' ? 'selected' : '' }}>Equity Crowdfunding</option>
                            <option value="product_crowdfunding" {{ $investor->investment_stage == 'product_crowdfunding' ? 'selected' : '' }}>Product Crowdfunding</option>
                            <option value="secondary_market" {{ $investor->investment_stage == 'secondary_market' ? 'selected' : '' }}>Secondary Market</option>
                            <option value="post_ipo_equity" {{ $investor->investment_stage == 'post_ipo_equity' ? 'selected' : '' }}>Post-IPO Equity</option>
                            <option value="post_ipo_debt" {{ $investor->investment_stage == 'post_ipo_debt' ? 'selected' : '' }}>Post-IPO Debt</option>
                            <option value="post_ipo_secondary" {{ $investor->investment_stage == 'post_ipo_secondary' ? 'selected' : '' }}>Post-IPO Secondary</option>
                            <option value="non_equity_assistance" {{ $investor->investment_stage == 'non_equity_assistance' ? 'selected' : '' }}>Non-equity Assistance</option>
                            <option value="initial_coin_offering" {{ $investor->investment_stage == 'initial_coin_offering' ? 'selected' : '' }}>Initial Coin Offering</option>
                            <option value="undisclosed" {{ $investor->investment_stage == 'undisclosed' ? 'selected' : '' }}>Undisclosed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="sub-heading-1">Deskripsi</label>
                        <textarea id="description" name="description" placeholder="Masukkan deskripsi" rows="3" style="padding-left: 10px; width: 100%;" class="custom-input" required>{{$investor->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="impactTags">Tag untuk Departemen</label>
                        <button type="button" class="tag-button" id="editTagsButton" data-toggle="modal" data-target="#tagModal">
                            Pilih Departemen Anda
                        </button>
                        <div id="selectedTags" class="mt-2">
                            @if($selectedDepartments->isNotEmpty())
                                @foreach ($selectedDepartments as $department)
                                    <span class="selected-tag">{{ $department->name }}</span>
                                @endforeach
                            @else
                                <span class="text-muted">Belum ada departemen yang dipilih.</span>
                            @endif
                        </div>
                    </div>


                     <!-- Modal -->
                     <div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tagModalLabel">Pilih Departemen Perusahaan Anda</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="search-container sticky-top bg-white">
                                        <div class="position-relative mb-0" style="width: 100%; background-color: transparent;">
                                            <input type="text" class="search-bar" id="searchInput" placeholder="Cari departemen" aria-label="Cari departemen" style="width: 95%;">
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
                                                    id="tag{{ $tag->id }}" name="tag_ids[]"
                                                    @if(in_array($tag->id, $selectedDepartments->pluck('id')->toArray())) checked @endif
                                                    style="display: none;">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-6">
                <div class="input-form" class="sub-heading-1">
                    <label for="negara" class="sub-heading-1">Negara</label>
                    <input type="text" id="negara" name="negara" class="custom-input" value="{{ $user->negara }}" required>
                </div>
                <div class="input-form" class="sub-heading-1">
                    <label for="provinsi">Provinsi</label>
                    <select name="provinsi" id="provinsi" class="custom-input" required>
                        {{-- isi secara dinamis akan dimasukkan di sini --}}
                    </select>
                </div>
                <div class="input-form" class="sub-heading-1">
                    <label for="alamat" class="sub-heading-1">Alamat Lengkap</label>
                    <input type="text" id="alamat" name="alamat" class="custom-input" value="{{ $user->alamat }}" required>
                </div>
                <div class="input-form" class="sub-heading-1">
                    <label for="telepon" class="sub-heading-1">Nomor Handphone</label>
                    <input type="number" id="telepon" name="telepon" class="custom-input" value="{{ $user->telepon }}" required>
                </div>
                @if ($user->role == 'INVESTOR')
                    <div class="input-form">
                        <label for="investment_stage" class="sub-heading-1">Tipe Investor</label>
                        <select id="investor_type" name="investor_type" class="form-control custom-input" style="height: 50px;" required>
                            <option value="">Pilih Tipe Investor</option>
                            <option value="venture_capital" {{ $investor->investor_type == 'venture_capital' ? 'selected' : '' }}>Venture Capital</option>
                            <option value="individual_angel" {{ $investor->investor_type == 'individual_angel' ? 'selected' : '' }}>Individual Angel</option>
                            <option value="private_equity_firm" {{ $investor->investor_type == 'private_equity_firm' ? 'selected' : '' }}>Private Equity Firm</option>
                            <option value="accelerator" {{ $investor->investor_type == 'accelerator' ? 'selected' : '' }}>Accelerator</option>
                            <option value="investment_partner" {{ $investor->investor_type == 'investment_partner' ? 'selected' : '' }}>Investment Partner</option>
                            <option value="corporate_venture_capital" {{ $investor->investor_type == 'corporate_venture_capital' ? 'selected' : '' }}>Corporate Venture Capital</option>
                            <option value="micro_vc" {{ $investor->investor_type == 'micro_vc' ? 'selected' : '' }}>Micro VC</option>
                            <option value="angel_group" {{ $investor->investor_type == 'angel_group' ? 'selected' : '' }}>Angel Group</option>
                            <option value="incubator" {{ $investor->investor_type == 'incubator' ? 'selected' : '' }}>Incubator</option>
                            <option value="investment_bank" {{ $investor->investor_type == 'investment_bank' ? 'selected' : '' }}>Investment Bank</option>
                            <option value="family_investment_office" {{ $investor->investor_type == 'family_investment_office' ? 'selected' : '' }}>Family Investment Office</option>
                            <option value="venture_debt" {{ $investor->investor_type == 'venture_debt' ? 'selected' : '' }}>Venture Debt</option>
                            <option value="co_working_space" {{ $investor->investor_type == 'co_working_space' ? 'selected' : '' }}>Co-Working Space</option>
                            <option value="fund_of_funds" {{ $investor->investor_type == 'fund_of_funds' ? 'selected' : '' }}>Fund of Funds</option>
                            <option value="hedge_fund" {{ $investor->investor_type == 'hedge_fund' ? 'selected' : '' }}>Hedge Fund</option>
                            <option value="government_office" {{ $investor->investor_type == 'government_office' ? 'selected' : '' }}>Government Office</option>
                            <option value="university_program" {{ $investor->investor_type == 'university_program' ? 'selected' : '' }}>University Program</option>
                            <option value="entrepreneurship_program" {{ $investor->investor_type == 'entrepreneurship_program' ? 'selected' : '' }}>Entrepreneurship Program</option>
                            <option value="secondary_purchaser" {{ $investor->investor_type == 'secondary_purchaser' ? 'selected' : '' }}>Secondary Purchaser</option>
                            <option value="startup_competition" {{ $investor->investor_type == 'startup_competition' ? 'selected' : '' }}>Startup Competition</option>
                            <option value="syndicate" {{ $investor->investor_type == 'syndicate' ? 'selected' : '' }}>Syndicate</option>
                            <option value="pension_funds" {{ $investor->investor_type == 'pension_funds' ? 'selected' : '' }}>Pension Funds</option>
                        </select>
                    </div>
                    <div class="input-form">
                        <label for="number_of_contacts" class="sub-heading-1">Nomor Kontak</label>
                        <input type="number" id="number_of_contacts" name="number_of_contacts" placeholder="Masukkan nomor kontak" value="{{ $investor->number_of_contacts }}" class="custom-input"/>
                    </div>
                @endif
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
        // Initialize Select2 for the organization dropdown with custom search and display options
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

{{-- Bagian tempat untuk api wilayah bagian startup founder --}}
<script>
    const provinsi = document.getElementById('provinsi');
    // URL untuk API provinsi
    const provinceApiUrl = 'https://xenodrom31.github.io/api-wilayah-indonesia/api/provinces.json';
    // Ambil nilai provinsi sebelumnya
    const oldValue = '{{ $user->provinsi }}'; // Pastikan ini adalah nilai yang benar

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
                    option.value = province.name; // Menyimpan ID provinsi
                    option.textContent = province.name; // Menampilkan nama provinsi

                    // Periksa apakah ini adalah nilai yang sudah ada
                    if (province.name === oldValue) {
                        option.selected = true; // Tandai sebagai terpilih jika sesuai
                    }

                    provinceSelect.appendChild(option);
                });
                provinceSelect.onchange = fetchCitiesByProvince; // Panggil fungsi untuk mengambil kota saat provinsi dipilih
            })
            .catch(error => console.error('Error fetching provinces:', error));
    }
    // Panggil fungsi untuk mengambil provinsi saat halaman dimuat
    document.addEventListener('DOMContentLoaded', fetchProvinces);
</script>

<script>

    document.getElementById('profile.update').addEventListener('submit', validateForm);

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

  <!-- Your custom scripts -->
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

        // Function to populate dropdown with selected tags
        function updatePositionDepartment() {
            var $positionSelect = $('#position');
            $positionSelect.empty().append('<option value="">Pilih Departemen</option>');

            $('#tagCloud .tag-button.selected').each(function () {
                var tagId = $(this).data('tag-id');
                var tagName = $(this).text();
                $positionSelect.append(`<option value="${tagId}">${tagName}</option>`);
            });

            $positionSelect.prop('disabled', $positionSelect.find('option').length <= 1);
        }

        // Function to initialize the dropdown in edit mode, preserving previous selection
        function updatePositionDepartementEdit() {
            var $positionSelect = $('#editPosition');
            var previousSelectedPosition = $positionSelect.val();
            $positionSelect.empty().append('<option value="">Pilih Departemen</option>');

            $('#tagCloud .tag-button.selected').each(function () {
                var tagId = $(this).data('tag-id');
                var tagName = $(this).text();
                $positionSelect.append(`<option value="${tagId}">${tagName}</option>`);
            });

            $positionSelect.prop('disabled', $positionSelect.find('option').length <= 1);

            // Restore the previously selected option if available
            if (previousSelectedPosition) {
                $positionSelect.val(previousSelectedPosition);
            }
        }

        // Initial calls to update selected tags and dropdown options
        updateSelectedTags();
        updatePositionDepartment();
        updatePositionDepartementEdit();
    });
    </script>
@endsection
