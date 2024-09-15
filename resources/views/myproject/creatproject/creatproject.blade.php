@extends('layouts.app-imm-create')
@section('title', 'Membuat Proyek')

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/myproject/creatproject/indicator.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myproject/creatproject/creatproject.css') }}">
    <link rel="stylesheet" href="{{ asset('css/myproject/creatproject/pemilihansdgs.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .popup-notification {
            position: fixed; /* Relative untuk posisi tombol "X" */
            background-color: white;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            z-index: 1000;
            animation: pop-up 1s ease-out;
        }

        /* Tombol "X" di pojok kanan atas */
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #c72828;
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Overlay untuk membuat layar menjadi gelap di belakang pop-up */
        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 999;
        }
    </style>
@endsection
@section('content')

    <body>
        {{-- Membuat notifikasi bila terjadi input yang belum di isi di dalam form required --}}
        <div class="popup-overlay" id="popup-overlay"></div>
        <div class="popup-notification" id="form-notification" style="display: none">
            <button class="close-button" id="close-notification">X</button>
            <div style="display: flex; flex-direction: column; gap: 20px; align-items: center;">
                <img src="images/Warning_icon.svg" alt="Warning!" style="width: 100px;">
                <b>Harap Isi Semua Data Yang Diperlukan</b>
            </div>
        </div>
        {{-- Akhir dari notifikasi --}}        
        <div class="container mt-5">
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                <h1 class="mb-5" id="buatproject">Buat Projek Baru</h1>
                <div id="form-section">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="project-title">Tentang Proyek Anda</h2>
                            @csrf
                            <div class="form-group">
                                <input type="file" class="form-control-file" id="img" name="img" hidden>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Proyek</label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Proyek</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tujuan">Tujuan Proyek</label>
                                <textarea class="form-control" name="tujuan" id="tujuan" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai Proyek</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" required>
                            </div>
                            <div class="form-group">
                                <label for="end_date">Tanggal Berakhir Proyek</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="provinsi">Provinsi</label>
                                <select class="form-control" name="provinsi" id="provinsi" required>
                                    <!-- Placeholder option -->
                                    <option value="" disabled selected>Pilih Provinsi</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="kota">Kota/Kabupaten</label>
                                <select class="form-control" name="kota" id="kota" required>
                                    <!-- Placeholder option -->
                                    <option value="" disabled selected>Pilih Kota/Kabupaten</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gmaps">Google Maps URL:</label>
                                <input type="text" class="form-control" id="gmaps" name="gmaps" required>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <h2 class="project-title">Spesisifikasi Pendanaan</h2>
                            <div class="form-group">
                                <div class="form-group mt-3">
                                    <label for="jumlah_pendanaan">Jumlah Dana Keseluruhan</label>
                                    <input type="number" class="form-control" name="jumlah_pendanaan"
                                        id="jumlah_pendanaan" required>
                                </div>
                                <label for="otherFunds">Pendanaan Lainnya</label>

                                <button type="button" class="btn btn-primary btn-add-dana ml-2 mb-2"><i
                                        class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
                                <div class="spesifikasi-pendanaan">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Jenis Dana</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <select class="form-control" name="dana[0][jenis_dana]" required>
                                                        <option value="Hibah">Hibah</option>
                                                        <option value="Investasi">Investasi</option>
                                                        <option value="Pinjaman">Pinjaman</option>
                                                        <option value="Lainnya">Lainnya</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="dana[0][nominal]"
                                                        required>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="form-group">

                                @if (auth()->check() && auth()->user()->companies)
                                    <input type="hidden" name="company_id" value="{{ auth()->user()->companies->id }}"
                                        id="company_id">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="impactTags">Tag Tema Dampak Yang Selaras dengan Prioritas Dampak Anda</label>
                                <div class="tags-container" style="height: 200px; overflow-y: auto;">
                                    @foreach ($tags as $tag)
                                        <div class="form-check ">
                                            <button class="tag-button" data-tag-id="{{ $tag->id }}" type="button">
                                                {{ $tag->nama }}
                                            </button>
                                            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}"
                                                id="tag{{ $tag->id }}" name="tag_ids[]" style="display: none;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="targetCustomers">Target Pelanggan</label>
                                <button type="button" class="btn btn-primary btn-add-pelanggan ml-2 mb-2"><i
                                        class="fa-solid fa-plus" style="color: #ffffff;"></i></button>
                                <div class="target-pelanggan">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Status Pekerjaan</th>
                                                <th>Rentang Usia</th>
                                                <th>Deskripsi Pelanggan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="target_pelanggans[0][status]" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control"
                                                        name="target_pelanggans[0][rentang_usia]" required>
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="target_pelanggans[0][deskripsi_pelanggan]" required></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="section-img">
                                    <h5>Unggah Foto Sampul Proyek</h5>
                                    <p>Gunakan foto Default</p>
                                    <label for="imageInput" class="choose-file-label">
                                        <div class="unggah-image">
                                            <img id="previewImage" src=""
                                                alt="Unggah foto sampul 1920x1080
(.png, .jpg, .jpeg) Maximal 5 MB">
                                        </div>
                                    </label>
                                    <input type="file" id="imageInput" name="img" style="display: none;">

                                </div>
                                <div class="d-flex justify-content-start mt-4">
                                    <button type="button" class="btn btn-primary" id="next-to-sdg-section">Simpan dan
                                        Lanjutkan</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="container mt-5">
                    <div class="form-group">
                        <div id="sdg-section" style="display: none;">
                            <h2>Pilih SDGs yang Relevan dengan Proyek Anda</h2>
                            @foreach ($sdgs as $sdg)
                                <div class="sdg-item" data-sdg="{{ $sdg->id }} ">
                                    <img src="{{ env('APP_BACKEND_URL') . '/images/' . $sdg->img }}"
                                        alt="SDG {{ $sdg->order }}">
                                    <h5 class="sdg-name">{{ $sdg->order }}. {{ $sdg->name }}</h5>
                                    <i class="fas fa-chevron-down sdg-toggle"></i>
                                    <input type="checkbox" class="sdg-checkbox" name="sdg_ids[]"
                                        value="{{ $sdg->id }}">
                                </div>
                                <div class="sdg-description">
                                    <p>{{ $sdg->description ?? 'Tidak ada deskripsi' }}</p>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-between mt-3">
                                <button type="button" class="btn btn-secondary"
                                    id="back-to-form-section">Kembali</button>
                                <button type="button" class="btn btn-primary" id="next-to-indicator-section">Simpan dan
                                    Lanjutkan</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Indikator --}}
                <div id="indicator-section" style="display: none">
                    <div class="container mt-5">
                        <h1 class="text-center" id="project-title"></h1>
                        <p class="text-center">Goals SDGs project anda</p>
                        <div class="d-flex justify-content-center mb-4" id="sdg-images-container"></div>
                        <div class="text-center bg-light p-3 mb-4" id="project-long-description"></div>
                        <h5 class="text-center mb-4">Tentukan indikator SDGs sebagai target project anda! Anda dapat
                            memilih
                            lebih dari satu indikator</h5>

                        @foreach ($sdgs as $sdg)
                            <div class="goal-description mb-4 p-3 bg-white shadow-sm rounded"
                                id="goal{{ $sdg->id }}-description">
                                <div class="d-flex align-items-center">
                                    <img src="{{ env('APP_BACKEND_URL') . '/images/' . $sdg->img }}"
                                        alt="SDG {{ $sdg->id }}" class="mr-3" width="50">
                                    <div>
                                        <h5 class="mb-0">SDGs Goals {{ $sdg->id }}</h5>
                                        <p class="mb-0">{{ $sdg->name }}</p>
                                    </div>
                                </div>

                                @foreach ($sdg->indicators as $indicator)
                                    @if ($indicator->level == 1)
                                        <div class="mt-3 d-flex align-items-center level-1-indicator" style="gap: 15px">
                                            <label for="indicator-{{ $indicator->id }}">
                                                <input type="checkbox" class="indicator-checkbox"
                                                    id="indicator-{{ $indicator->id }}" name="indicator_ids[]"
                                                    value="{{ $indicator->id }}"
                                                    data-target="sub-container-{{ $indicator->id }}">
                                                <span class="ml-2">{{ $indicator->order }} </span><span class="ml-2">{{ $indicator->name }}</span>
                                            </label>
                                        </div>
                                    @endif

                                    {{-- Sub-container untuk indikator level 2 --}}
                                    @if ($indicator->level == 1)
                                        <div class="sub-container" id="sub-container-{{ $indicator->id }}"
                                            style="display: none; margin-top: 10px;">
                                            <div class="d-flex flex-column" style="gap: 15px; margin-left:45px;">
                                                @foreach ($indicator->childIndicators as $childIndicator)
                                                    <div class=" d-flex">
                                                        <span>{{ $childIndicator->order }}
                                                        </span><span class="ml-2">{{ $childIndicator->name }}</span><br>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach


                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary" id="back-to-sdg-section">Kembali</button>
                            <button type="button" class="btn btn-primary" id="next-to-metric-section">Simpan dan
                                Lanjutkan</button>
                        </div>
                    </div>

                </div>


                <div id="metric-section" style="display: none;">
                    <div class="container mt-5">
                        <h1 class="text-center">Pilih Metrik Berdasarkan Indikator yang Anda Pilih</h1>
                        <div id="metrics" class="mb-4 p-3 bg-white shadow-sm rounded"></div>
                        <div class="pagination mt-4">
                            <ul id="pagination-links" class="pagination justify-content-center">
                                <div class="pagination mt-4 d-flex justify-content-center">
                                    <ul id="pagination-links" class="pagination">
                                        <li class="page-item" id="previous-page-li">
                                            <button type="button" class="btn btn-secondary page-link"
                                                id="previous-page">Sebelumnya</button>
                                        </li>
                                        <!-- Page numbers will be dynamically inserted here -->
                                        <li class="page-item" id="next-page-li">
                                            <button type="button" class="btn btn-primary page-link"
                                                id="next-page">Berikutnya</button>
                                        </li>
                                    </ul>
                                </div>
                            </ul>
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <button type="button" class="btn btn-secondary"
                                id="back-to-indicator-section">Kembali</button>
                            <button type="button" class="btn btn-primary" id="next-to-review-section">Simpan dan
                                Lanjutkan</button>
                        </div>
                    </div>
                </div>


                <div id="review-section" style="display: none;">

                    <div class="container mt-5 pt-5">
                        <h1 class="text-center">Detail Review: SDGs Goals, Indicators, dan Metrix</h1>
                        <p class="text-center">Goals SDGs project anda</p>
                        <div class="d-flex justify-content-center mb-4" id="review-sdg-images-container"></div>
                        <div class="goals-text mt-4">
                            <span class="goal-description" id="selected-sdgs-container"></span>
                        </div>
                    </div>
                    <!-- Bagian Indicators -->
                    <div class="indicators mt-5">
                        <h2 class="text-center">Indicators</h2>
                        <div id="selected-indicators-container"></div>
                    </div>
                    <!-- Bagian Metrics -->
                    <div class="indicators mt-5">
                        <h2 class="text-center">Metrics</h2>
                        <div id="review-selected-metrics"></div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-secondary" id="back-to-metric-section">Kembali</button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>


            </form>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            function validationSection(sectionId){
                let section = document.getElementById(sectionId);
                let inputs = section.querySelectorAll('input[required], select[required], textarea[required]');
                let isValid = true;
                inputs.forEach(function(input){
                    if(input.value === ''){
                        isValid = false;
                        input.classList.add('is-invalid');
                    }else{
                        input.classList.remove('is-invalid');
                    }
                });
                return isValid;
            }
        </script>
        
        <script>
            // Ambil elemen select untuk provinsi dan kota/kabupaten
            const provinsiSelect = document.getElementById('provinsi');
            const kotaSelect = document.getElementById('kota');
            let provincesData = []; // Simpan data provinsi yang di-fetch

            // Fetch data provinsi saat halaman dimuat
            fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json')
                .then(response => response.json())
                .then(provinces => {
                    provincesData = provinces; // Simpan data provinsi
                    // Iterasi setiap provinsi dan tambahkan sebagai option ke select provinsi
                    provinces.forEach(provinsi => {
                        const option = document.createElement('option');
                        option.value = provinsi.name; // Menggunakan nama sebagai nilai
                        option.textContent = provinsi.name;
                        option.dataset.id = provinsi.id; // Simpan ID provinsi di dataset
                        provinsiSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching provinces:', error));

            // Fungsi untuk memanggil API kota/kabupaten berdasarkan ID provinsi
            function populateCities() {
                const selectedProvinsiName = provinsiSelect.value;
                const selectedProvinsiId = getProvinsiIdByName(selectedProvinsiName);
                const regenciesUrl = `https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${selectedProvinsiId}.json`;

                // Kosongkan dropdown kota/kabupaten saat memilih provinsi baru
                kotaSelect.innerHTML = '<option value="" disabled selected>Pilih Kota/Kabupaten</option>';

                // Fetch data kota/kabupaten berdasarkan ID provinsi yang dipilih
                fetch(regenciesUrl)
                    .then(response => response.json())
                    .then(regencies => {
                        // Iterasi setiap kota/kabupaten dan tambahkan sebagai option ke select kota/kabupaten
                        regencies.forEach(regency => {
                            const option = document.createElement('option');
                            option.value = regency.name; // Menggunakan nama sebagai nilai
                            option.textContent = regency.name;
                            kotaSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error(`Error fetching regencies for provinsi ${selectedProvinsiId}:`, error));
            }


            // Fungsi untuk mendapatkan ID provinsi berdasarkan nama
            function getProvinsiIdByName(name) {
                const provinsi = provincesData.find(provinsi => provinsi.name === name);
                return provinsi ? provinsi.id : null;
            }

            // Tambahkan event listener untuk dropdown provinsi
            provinsiSelect.addEventListener('change', populateCities);
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var imageInput = document.getElementById('imageInput');
                var previewImage = document.getElementById('previewImage');

                imageInput.addEventListener('change', function() {
                    var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        previewImage.src = "";
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.sdg-item').on('click', function(e) {
                    if (!$(e.target).is('.sdg-checkbox')) {
                        var checkbox = $(this).find('.sdg-checkbox');
                        checkbox.prop('checked', !checkbox.prop('checked'));
                    }

                    var description = $(this).next('.sdg-description');
                    description.slideToggle();

                    // Toggle the rotation class on the arrow icon
                    $(this).find('.sdg-toggle').toggleClass('rotate-180');
                });

                $('.sdg-checkbox').on('click', function(e) {
                    e.stopPropagation(); // Prevent the event from bubbling up to the parent div
                });

                $('#next-to-indicator-section').on('click', function() {
                    // Hide all goal descriptions first
                    $('.goal-description').hide();


                    // Get all selected SDG checkboxes
                    var selectedSdgs = $('.sdg-checkbox:checked');

                    // Show goal descriptions only for selected SDGs
                    selectedSdgs.each(function() {
                        var sdgId = $(this).val();
                        $('#goal' + sdgId + '-description').show();
                    });

                    // Move to the indicator section
                    $('#sdg-section').hide();
                    $('#indicator-section').show();
                });

                $('#back-to-sdg-section').on('click', function() {
                    $('#indicator-section').hide();
                    $('#sdg-section').show();
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('.tag-button').click(function() {
                    var $button = $(this);
                    var tagId = $button.data('tag-id');
                    var $checkbox = $('#tag' + tagId);

                    // Toggle the selected state
                    $button.toggleClass('selected');

                    // Sync the checkbox with the button state
                    $checkbox.prop('checked', $button.hasClass('selected'));
                });

                // Initialize button states based on checkboxes
                $('.form-check-input').each(function() {
                    var $checkbox = $(this);
                    var tagId = $checkbox.val();
                    var $button = $('button[data-tag-id="' + tagId + '"]');

                    if ($checkbox.prop('checked')) {
                        $button.addClass('selected');
                    }
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var checkboxes = document.querySelectorAll(".indicator-checkbox");

                checkboxes.forEach(function(checkbox) {
                    checkbox.addEventListener("change", function() {
                        var subContainerId = this.getAttribute("data-target");
                        var subContainer = document.getElementById(subContainerId);

                        if (this.checked) {
                            subContainer.style.display = "block"; // Menampilkan sub-container
                        } else {
                            subContainer.style.display = "none"; // Menyembunyikan sub-container
                        }
                    });
                });
            });
            $(document).ready(function() {
                var index = 1;
                $(".btn-add-pelanggan").click(function() {
                    var newRow = '<tr>' +
                        '<td><input type="text" class="form-control" name="target_pelanggans[' + index +
                        '][status]" required></td>' +
                        '<td><input type="text" class="form-control" name="target_pelanggans[' + index +
                        '][rentang_usia]" required></td>' +
                        '<td><textarea class="form-control" name="target_pelanggans[' + index +
                        '][deskripsi_pelanggan]" required></textarea></td>' +
                        '<td><button type="button" class="btn btn-danger btn-remove-pelanggan"><i class="fa-solid fa-minus" style="color: #ffffff;"></i></button></td>' +
                        '</tr>';
                    $('.target-pelanggan tbody').append(newRow);
                    index++;
                });

                $(document).on('click', '.btn-remove-pelanggan', function() {
                    $(this).closest('tr').remove();
                });

                var indexDana = 1;
                $(".btn-add-dana").click(function() {
                    var selectedOptions = $('.spesifikasi-pendanaan select').map(function() {
                        return $(this).val();
                    }).get();
                    var options = ['Hibah', 'Investasi', 'Pinjaman', 'Lainnya'];
                    var availableOptions = options.filter(function(option) {
                        return !selectedOptions.includes(option);
                    });
                    var optionsHtml = availableOptions.map(function(option) {
                        return '<option value="' + option + '">' + option + '</option>';
                    }).join('');
                    var newRow = '<tr>' +
                        '<td><select class="form-control" name="dana[' + indexDana +
                        '][jenis_dana]" required>' +
                        optionsHtml +
                        '</select></td>' +
                        '<td><input type="number" class="form-control" name="dana[' + indexDana +
                        '][nominal]" required></td>' +
                        '<td><button type="button" class="btn btn-danger btn-remove-dana"><i class="fa-solid fa-minus" style="color: #ffffff;"></i></button></td>' +
                        '</tr>';
                    $('.spesifikasi-pendanaan tbody').append(newRow);
                    indexDana++;

                    if (availableOptions.length === 1) {
                        $(".btn-add-dana").prop('disabled', true);
                    }
                });

                $(document).on('click', '.btn-remove-dana', function() {
                    $(this).closest('tr').remove();
                    $(".btn-add-dana").prop('disabled', false);
                });

                // Tombol Next ke SDG section ditambahkan check input required
                $('#next-to-sdg-section').on('click', function() {
                    // Validasi section form-section sebelum pindah
                    if (validationSection('form-section')) {
                        $('#form-section').hide();
                        $('#buatproject').hide();
                        $('#sdg-section').show();
                    } else {
                        console.log('Ada field yang kosong');
                        // Tampilkan notifikasi kalau ada field yang kosong
                        document.getElementById('form-notification').style.display = 'block';
                        document.getElementById('popup-overlay').style.display = 'block';
                        document.getElementById('close-notification').addEventListener('click', function() {
                            document.getElementById('form-notification').style.display = 'none';
                            document.getElementById('popup-overlay').style.display = 'none';
                        });
                        window.scrollTo(0, 0); // Scroll ke atas untuk menampilkan notifikasi
                    }
                });

                $('#next-to-metric-section').on('click', function() {
                    $('#indicator-section').hide();
                    $('#metric-section').show();
                });


                $('#next-to-review-section').on('click', function() {
                    $('#metric-section').hide();
                    $('#review-section').show();
                });


                $('#back-to-metric-section').on('click', function() {
                    $('#review-section').hide();
                    $('#metric-section').show();
                });

                $('#back-to-form-section').on('click', function() {
                    $('#sdg-section').hide();
                    $('#form-section').show();
                    $('#buatproject').show();
                });

                // Melakukan penambahan logic untuk mengatur indicator sdg yang dipilih
                // Menyimpan SDG yang dipilih sebelumnya
                var previousSdgs = [];

                // Fungsi untuk mendapatkan SDG yang dipilih
                function getSelectedSdgs() {
                    return $('.sdg-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();
                }

                // Fungsi untuk mengecek apakah ada perubahan pada SDG hanya jika SDG berkurang
                function hasSdgDecreased() {
                    var currentSdgs = getSelectedSdgs();
                    if (currentSdgs.length ===  previousSdgs.length) {
                        return JSON.stringify(currentSdgs) !== JSON.stringify(previousSdgs); // Mengecek apakah SDG saat ini berubah
                    }
                    return currentSdgs.length < previousSdgs.length; // Mengecek apakah SDG saat ini berkurang
                }

                $('#next-to-indicator-section').on('click', function() {
                    const projectName = $('#nama').val();
                    const projectDescription = $('#deskripsi').val();
                    
                    // Mendapatkan gambar SDG yang dipilih
                    const selectedSdgImages = $('.sdg-checkbox:checked').map(function() {
                        return $(this).closest('.sdg-item').find('img').attr('src');
                    }).get();

                    // Mengisi judul dan deskripsi proyek
                    $('#project-title').text(projectName);
                    $('#project-long-description').text(projectDescription);

                    // Menampilkan gambar SDG yang dipilih
                    $('#sdg-images-container').html('');
                    selectedSdgImages.forEach(function(src) {
                        $('#sdg-images-container').append('<img src="' + src +
                            '" alt="SDG" class="img-fluid mx-2 sdg-goal" data-target="#goal15-description">'
                        );
                    });

                    // Mengecek apakah ada perubahan pada SDG
                    if (hasSdgDecreased()) {
                        // Jika SDG berubah, kosongkan checklist indikator
                        $('.indicator-checkbox').prop('checked', false);
                    } 

                    // Menyimpan SDG yang dipilih ke dalam previousSdgs setelah perpindahan halaman
                    previousSdgs = getSelectedSdgs();

                    // Menyembunyikan SDG Section dan menampilkan Indicator Section
                    $('#sdg-section').hide();
                    $('#indicator-section').show();
                });


                $('#back-to-sdg-section').on('click', function() {
                    $('#indicator-section').hide();
                    $('#sdg-section').show();
                });

                // Menambahkan untuk menghilangkan checklist indikator yang terkait bila sdg nya tidak dicentang
                $('.sdg-checkbox').on('change', function() {
                    var sdgId = $(this).val();
                    $('.goal-description').hide();
                    $('#goal' + sdgId + '-description').show();
                    $('#goal' + sdgId + '-description .sub-container').hide();
                    $('#goal' + sdgId + '-description .sub-container[data-level="2"]').show();

                    // Jika SDG tidak dicentang, hilangkan checklist indikator yang terkait
                    if (!$(this).is(':checked')) {
                        // Temukan semua indikator yang terkait dengan SDG ini
                        var relatedIndicators = $('.indicator-checkbox[data-sdg="' + sdgId + '"]');
                        // Uncheck indikator terkait dan sembunyikan sub-container
                        relatedIndicators.prop('checked', false).closest('.sub-container').hide();
                    }
                });

                $(document).on('change', '.indicator-checkbox', function() {
                    var indicatorId = $(this).val();
                    var subContainer = $('#sub-container-' + indicatorId);
                    if ($(this).is(':checked')) {
                        subContainer.insertAfter($(this).closest('.level-1-indicator')).show();
                    } else {
                        subContainer.hide();
                        subContainer.find('input[type="checkbox"]').prop('checked', false);
                    }
                });

                var checkbox = document.getElementById("subscribe");
                var subContainer = document.getElementById("sub-container");

                checkbox.addEventListener("change", function() {
                    if (checkbox.checked) {
                        subContainer.style.display = "block";
                    } else {
                        subContainer.style.display = "none"; // Corrected to hide when not checked
                    }
                });


                var sdgGoals = document.querySelectorAll(".sdg-goal");

                sdgGoals.forEach(function(goal) {
                    goal.addEventListener("click", function() {
                        var target = document.querySelector(goal.getAttribute("data-target"));
                        var descriptionVisible = target.classList.contains("show");

                        if (!descriptionVisible) {
                            target.classList.remove("hide");
                            target.classList.add("show");
                        } else {
                            target.classList.remove("show");
                            target.classList.add("hide");
                        }
                    });
                });

                setTimeout(function() {
                    var loading = document.getElementById("loading");
                    loading.style.display = "none";
                }, 1000);
            });
            document.addEventListener("DOMContentLoaded", function() {
                var checkbox = document.getElementById("subscribe");
                var subContainer = document.getElementById("sub-container");

                checkbox.addEventListener("change", function() {
                    if (checkbox.checked) {
                        subContainer.style.display = "block"; // Show sub-container when checkbox is checked
                    } else {
                        subContainer.style.display = "none"; // Hide sub-container when checkbox is unchecked
                    }
                });
            });
            // namabah baru
            $(document).ready(function() {
                var metricsPerPage = 15; // Jumlah metrik per halaman
                var currentPage = 1; // Halaman saat ini
                var metricsData = []; // Array untuk menyimpan data metrik dari response

                // Fungsi untuk menampilkan metrik pada halaman tertentu
                function displayMetrics(page) {
                    var startIndex = (page - 1) * metricsPerPage;
                    var endIndex = startIndex + metricsPerPage;
                    var metricsSlice = metricsData.slice(startIndex, endIndex);

                    $('#metrics').empty(); // Kosongkan container metrik terlebih dahulu
                    $.each(metricsSlice, function(index, metric) {
                        var metricHtml = `
                            <div class="d-flex align-items-center justify-content-between p-3 my-3 border">
                                <div class="metric-text">
                                    <h5 style="color:#5940CB">(${metric.code}) ${metric.name}</h5>
                                    <p class="mb-0 sdg-name-metric">${metric.definition}</p>
                                </div>
                                <input type="checkbox" class="metric-checkbox" name="metric_ids[]" value="${metric.id}">
                            </div>
                        `;
                        $('#metrics').append(metricHtml);
                    });

                    // Update pagination links
                    updatePagination();
                }

                // Fungsi untuk membuat dan mengatur tombol-tombol pagination
                function updatePagination() {
                    var totalPages = Math.ceil(metricsData.length / metricsPerPage);
                    var paginationLinks = $('#pagination-links');
                    paginationLinks.empty(); // Kosongkan tombol-tombol pagination terlebih dahulu

                    for (var i = 1; i <= totalPages; i++) {
                        var activeClass = (i === currentPage) ? 'active' : '';
                        var paginationBtn = $('<li class="page-item ' + activeClass +
                            '"><a class="page-link" href="#">' + i + '</a></li>');

                        paginationBtn.on('click', function() {
                            currentPage = parseInt($(this).text()); // Perbarui halaman saat ini
                            displayMetrics(currentPage); // Tampilkan metrik untuk halaman yang diklik
                        });

                        paginationLinks.append(paginationBtn);
                    }
                }

                // Event listener untuk tombol Kembali ke Bagian Indikator
                $('#back-to-indicator-section').on('click', function() {
                    $('#metric-section').hide();
                    $('#indicator-section').show();
                });

                // Event listener untuk tombol Simpan dan Lanjutkan ke Bagian Review
                $('#next-to-review-section').on('click', function() {
                    $('#metric-section').hide();
                    $('#review-section').show();
                });

                // Contoh penggunaan AJAX untuk mendapatkan data metrik dari server
                $.ajax({
                    url: '{{ route('projects.filterMetrics') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        tag_ids: selectedTags,
                        indicator_ids: selectedIndicators
                    },
                    success: function(response) {
                        metricsData = response; // Simpan data metrik dari response
                        displayMetrics(currentPage); // Tampilkan metrik untuk halaman pertama
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching metrics:', error);
                        // Handle error case if needed
                    }
                });
            });

            // Menambahkan logika untuk menyesuaikan matriks dengan indikator yang dipilih
            $('#next-to-metric-section').on('click', function() {
                var selectedTags = $('input[name="tag_ids[]"]:checked').map(function() {
                    return $(this).val();
                }).get();
                var selectedIndicators = $('.indicator-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                $(document).ready(function() {
                    var currentPage = 1; // Initial page
                    var totalPages = 1; // Total pages, will be updated after receiving response from server
                    var selectedMetricsIds = {}; // Object to store selected metric IDs
                    var allMetrics = {}; // Object to store all fetched metrics
                    var isFirstLoad = true; // Flag untuk check apakah ini load pertama kali

                    // Fungsi untuk mereset metrik
                    function resetMetrics() {
                        $('#metrics').empty(); // Clear metrics yang sebelumnya ditampilkan
                        selectedMetricsIds = {}; // Reset metrics yang dipilih
                    }

                    // Function to fetch metrics based on selected tags and indicators
                    function fetchMetrics() {
                        // Check jika ini load pertama kali
                        if (isFirstLoad) {
                            resetMetrics();
                            isFirstLoad = false;
                        }
                        $.ajax({
                            url: '{{ route('projects.filterMetrics') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                tag_ids: selectedTags,
                                indicator_ids: selectedIndicators,
                                page: currentPage // Send current page number to server
                            },
                            success: function(response) {
                                console.log("Metrics fetched successfully:", response); // Debugging log
                                if (response.data.length === 0) {
                                    console.log("No metrics found."); // Debugging log
                                }

                                // Iterate through metrics and append to #metrics container
                                $.each(response.data, function(index, metric) {
                                    // Check if this metric is selected
                                    var isChecked = selectedMetricsIds[metric.id] ? 'checked' : '';

                                    var metricHtml = `
                                        <div class="d-flex align-items-center justify-content-between p-3 my-3 border">
                                            <div class="metric-text">
                                                <h5 style="color:#5940CB">(${metric.code}) ${metric.name}</h5>
                                                <p class="mb-0 sdg-name-metric">${metric.definition}</p>
                                            </div>
                                            <input type="checkbox" class="metric-checkbox" name="metric_ids[]" value="${metric.id}" ${isChecked}>
                                        </div>
                                    `;
                                    $('#metrics').append(metricHtml);
                                });

                                // Update total pages based on response
                                totalPages = response.last_page;

                                // Update pagination links
                                updatePagination();

                                // Initialize event handlers for newly added checkboxes
                                initializeCheckboxEventHandlers();
                            },
                            error: function(xhr, status, error) {
                                console.error('Error fetching metrics:', error);
                            }
                        });
                    }

                    function updatePagination() {
                        console.log("Updating pagination..."); // Debugging log
                        $('#pagination-links').empty(); // Clear existing pagination links

                        var startPage = Math.max(currentPage - 5, 1);
                        var endPage = Math.min(currentPage + 5, totalPages);

                        // Add first page button if startPage is greater than 1
                        if (startPage > 1) {
                            $('#pagination-links').append(`
                                <li class="page-item">
                                    <button type="button" class="btn btn-link page-link page-number">1</button>
                                </li>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            `);
                        }

                        // Add next button
                        $('#pagination-links').append(`
                            <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}" id="next-page-li">
                                <button type="button" class="btn btn-primary page-link" id="next-page">Berikutnya</button>
                            </li>
                        `);

                        $('#next-page').on('click', function() {
                            if (currentPage < totalPages) {
                                currentPage++;
                                fetchMetrics(); // Fetch metrics for the next page
                            }
                        });
                    }

                    // Function to initialize event handlers for checkboxes
                    function initializeCheckboxEventHandlers() {
                        console.log("Initializing checkbox event handlers..."); // Debugging log
                        $('.metric-checkbox').on('change', function() {
                            var metricId = $(this).val();
                            if ($(this).prop('checked')) {
                                selectedMetricsIds[metricId] = true; // Store the ID in selectedMetricsIds
                            } else {
                                delete selectedMetricsIds[metricId]; // Remove the ID from selectedMetricsIds
                            }
                        });
                        // Make the metric-text div clickable to toggle the checkbox
                        $('.metric-text').on('click', function() {
                            var checkbox = $(this).siblings('.metric-checkbox');
                            checkbox.prop('checked', !checkbox.prop('checked'));
                            checkbox.trigger('change'); // Trigger the change event
                        });
                    }

                    // Event handler untuk "Kembali" button untuk reset isFirstLoad
                    $('#back-to-indicator-section').on('click', function() {
                        $('#metric-section').hide();
                        $('#indicator-section').show();
                        isFirstLoad = true; // Reset flag ke true ketika "Kembali" button ditekan
                    });

                    // Initial fetch for metrics
                    fetchMetrics();
                });
            });

            $('#back-to-indicator-section').on('click', function() {
                $('#metric-section').hide();
                $('#indicator-section').show();
            });

            $(document).ready(function() {
                // Function to update review section with selected project details
                function updateReviewSection() {
                    // Project Name
                    var projectName = $('#nama').val();
                    $('#project-title').text(projectName);

                    // Selected SDG Images
                    var selectedSdgImages = $('.sdg-checkbox:checked').map(function() {
                        return $(this).closest('.sdg-item').find('img').attr('src');
                    }).get();
                    $('#sdg-images-container').html('');
                    selectedSdgImages.forEach(function(src) {
                        $('#sdg-images-container').append('<img src="' + src +
                            '" alt="SDG" class="img-fluid mx-2 sdg-goal">');
                    });

                    // Project Description
                    var projectDescription = $('#deskripsi').val();
                    $('#project-long-description').text(projectDescription);

                    // Selected SDGs and Indicators
                    var selectedSdgs = $('.sdg-checkbox:checked').map(function() {
                        var sdgId = $(this).val();
                        var sdgName = $(this).closest('.sdg-item').find('.sdg-name').text().trim();
                        var sdgImage = $(this).closest('.sdg-item').find('img').attr('src');
                        var selectedIndicators = $('#sub-container-' + sdgId + ' input:checked').map(
                            function() {
                                var indicatorId = $(this).val();
                                var indicatorName = $(this).next().text().trim();
                                return {
                                    name: indicatorName
                                };
                            }).get();
                        return {
                            name: sdgName,
                            image: sdgImage,
                            indicators: selectedIndicators
                        };
                    }).get();

                    var sdgsHtml = '';
                    selectedSdgs.forEach(function(sdg) {
                        sdgsHtml += '<div class="mb-4">';
                        sdgsHtml += '<h3>' + sdg.name + '</h3>';
                        sdgsHtml += '<img src="' + sdg.image + '" alt="' + sdg.name +
                            '" class="img-fluid mx-2 sdg-goal">';
                        sdgsHtml += '<div class="ml-4 mt-2">';
                        sdg.indicators.forEach(function(indicator) {
                            sdgsHtml += '<h5>' + indicator.name + '</h5>';
                        });
                        sdgsHtml += '</div></div>';
                    });
                    $('#selected-sdgs-container').html(sdgsHtml);

                    // Selected Metrics
                    var selectedMetrics = $('.metric-checkbox:checked').map(function() {
                        return $(this).closest('.d-flex').find('h5').text().trim();
                    }).get();
                    var metricsHtml = '<div style=" m-3 border">';
                    selectedMetrics.forEach(function(metric) {
                        metricsHtml += '<h5 class="text-primary">' + metric + '</h5>';
                    });
                    metricsHtml += '</div>';
                    $('#review-selected-metrics').html(metricsHtml);
                }

                // Update review section when the Next or Back buttons are clicked
                $('#next-to-review-section, #back-to-metric-section').on('click', function() {
                    updateReviewSection();
                });

                // Submit form action
                $('#submit-project').on('click', function() {
                    // Perform form submission or AJAX request here
                    $('form').submit(); // Assuming your form has an action attribute defined
                });
            });
            $(document).ready(function() {
                // Function to update review section with selected project details
                function updateReviewSection() {
                    // Project Name
                    var projectName = $('#nama').val();
                    $('#project-title').text(projectName);

                    // Project Description
                    var projectDescription = $('#deskripsi').val();
                    $('#project-long-description').text(projectDescription);

                    // Selected SDG Images
                    var selectedSdgImages = $('.sdg-checkbox:checked').map(function() {
                        return $(this).closest('.sdg-item').find('img').attr('src');
                    }).get();
                    $('#review-sdg-images-container').html('');
                    selectedSdgImages.forEach(function(src) {
                        $('#review-sdg-images-container').append('<img src="' + src +
                            '" alt="SDG" class="img-fluid mx-2 sdg-goal">');

                    });

                    // Selected SDGs
                    var selectedSdgs = $('.sdg-checkbox:checked').map(function() {
                        var sdgId = $(this).val();
                        var sdgOrder = $(this).closest('.sdg-item').find('h5').text().split('.')[0];
                        var sdgName = $(this).closest('.sdg-item').find('h5').text().split('. ')[1];
                        return {
                            id: sdgId,
                            order: sdgOrder,
                            name: sdgName
                        };
                    }).get();

                    // Populate selected SDGs container
                    var sdgsHtml = '';
                    selectedSdgs.forEach(function(sdg) {
                        sdgsHtml += '<div class="goal-description">SDGs ' + sdg.order + '. ' + sdg.name +
                            '</div>';
                    });
                    $('#selected-sdgs-container').html(sdgsHtml);

                    // Selected Indicators
                    var selectedIndicatorsHtml = '';
                    selectedSdgs.forEach(function(sdg) {
                        var sdgImage = $('#goal' + sdg.id + '-description').find('img').attr('src');
                        var selectedIndicators = $('#goal' + sdg.id +
                            '-description .indicator-checkbox:checked').map(function() {
                            var indicatorOrder = $(this).closest('label').find('span:first').text()
                                .trim();
                            var indicatorName = $(this).closest('label').find('span:last').text()
                                .trim();
                            var childIndicators = $('#sub-container-' + $(this).val() + ' .d-flex').map(
                                function() {
                                    var childOrder = $(this).find('span:first').text().trim();
                                    var childName = $(this).find('span:last').text().trim();
                                    return {
                                        order: childOrder,
                                        name: childName
                                    };
                                }).get();
                            return {
                                order: indicatorOrder,
                                name: indicatorName,
                                children: childIndicators
                            };
                        }).get();

                        if (selectedIndicators.length > 0) {
                            selectedIndicatorsHtml += '<div class="sdg-indicators">';
                            selectedIndicatorsHtml += '<div class="d-flex align-items-center">';
                            selectedIndicatorsHtml += '<img src="' + sdgImage + '" alt="SDG ' + sdg.order +
                                '" class="mr-3 rounded" width="100">';
                            selectedIndicatorsHtml += '<h5>SDGs ' + sdg.order + '. ' + sdg.name + '</h5>';
                            selectedIndicatorsHtml += '</div>';

                            selectedIndicators.forEach(function(indicator) {
                                selectedIndicatorsHtml += '<div class="indicator-item mt-4">';
                                selectedIndicatorsHtml += '<h5>' + indicator.order + '. ' + indicator
                                    .name + '</h5>';
                                if (indicator.children.length > 0) {
                                    selectedIndicatorsHtml += '<ul class="mt-2 ml-4">';
                                    indicator.children.forEach(function(child) {
                                        selectedIndicatorsHtml += '<li>' + child.order + ' ' +
                                            child.name + '</li>';
                                    });
                                    selectedIndicatorsHtml += '</ul>';
                                }
                                selectedIndicatorsHtml += '</div>';
                            });

                            selectedIndicatorsHtml += '</div>';
                        }
                    });
                    $('#selected-indicators-container').html(selectedIndicatorsHtml);

                    // Selected Metrics
                    var selectedMetrics = $('.metric-checkbox:checked').map(function() {
                        return {
                            title: $(this).closest('.d-flex').find('h5').text().trim(),
                            description: $(this).closest('.d-flex').find('p').text().trim()
                        };
                    }).get();
                    var metricsHtml = '<div>';
                    selectedMetrics.forEach(function(metric) {
                        metricsHtml +=
                            '<div class="d-flex justify-content-between align-items-center p-3 border my-3">';
                        metricsHtml += '<div><h5 class="indicator-title" style="color:#5940CB">' + metric
                            .title + '</h5>';
                        metricsHtml += '<p class="indicator-description">' + metric.description + '</p></div>';
                        metricsHtml += '</div>';
                    });
                    metricsHtml += '</div>';
                    $('#review-selected-metrics').html(metricsHtml);
                }

                // Update review section when the Next or Back buttons are clicked
                $('#next-to-review-section').on('click', function() {
                    updateReviewSection();
                    $('#metric-section').hide();
                    $('#review-section').show();
                });

                $('#back-to-metric-section').on('click', function() {
                    $('#review-section').hide();
                    $('#metric-section').show();
                });

                $('#submit-project').on('click', function() {
                    // Collect form data
                    var formData = new FormData();
                    formData.append('nama', $('#nama').val());
                    formData.append('deskripsi', $('#deskripsi').val());
                    formData.append('company_id', $('#company_id')
                        .val()); // Assuming $('#company_id').val() gives you the company_id integer

                    // Append sdg_ids
                    var sdgIds = $('.sdg-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();
                    formData.append('sdg_ids', JSON.stringify(sdgIds));

                    // Append indicator_ids
                    var indicatorIds = $('.indicator-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();
                    formData.append('indicator_ids', JSON.stringify(indicatorIds));

                    // Append metric_ids
                    var metricIds = $('.metric-checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();
                    formData.append('metric_ids', JSON.stringify(metricIds));

                    // Handle img file
                    var imgFile = $('#img').prop('files')[0];
                    formData.append('img', imgFile);

                    // Perform AJAX request
                    $.ajax({
                        url: "{{ route('projects.store') }}",
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Handle success response (redirect or show success message)
                            console.log(response);
                        },
                        error: function(xhr) {
                            // Handle error response (show error message if needed)
                            console.log(xhr.responseText);
                        }
                    });
                });

            });
        </script>
    </body>
@endsection