@extends('layouts.app-2fa')
@section('title', 'Pendaftaran Perusahaan')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/imm/pendaftaranperusahaan.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('js/imm/pendaftaran.js') }}"></script>
<Style>
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
</Style>
@endsection
@section('content')
<body>
    <div class="register-container">
        <h2>Daftarkan Perusahaan Anda</h2>
        <form action="{{ route('companies.store') }}" method="POST" >
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
                        <label for="founded_date">Perusahaan didirikan</label>
                        <input type="date" class="form-control" id="founded_date" name="founded_date" required>
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
                    <div class="form-group">
                        <label for="funding_stage">Funding Stage</label>
                        <select name="funding_stage" id="funding_stage" class="form-control" required>
                            <option value="" disabled selected>Pilih Funding Stage</option>
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
                        <div class="invalid-feedback">
                            Please select a funding type.
                        </div>
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
                        <label for="business_model">Business Model Perusahaan</label>
                        <select class="form-control" id="business_model" name="business_model" required>
                            <option value="" disabled selected>Pilih business_model Perusahaan</option>
                            <option value="B2B">B2B</option>
                            <option value="B2C">B2C</option>
                            <option value="B2B2C">B2B2C</option>
                            <option value="C2C">C2C</option>
                            <option value="D2C">D2C</option>
                            <option value="P2P">P2P</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a company type.
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="impactTags">Tag untuk department apa saja yang ada di perusahaan anda</label>
                        <button class="tag-button" data-toggle="modal" data-target="#tagModal">
                            Pilih Department Perusahaan Anda
                        </button>
                        <!-- Container for displaying selected tags -->
                        <div id="selectedTags" class="mt-2">
                            <!-- Selected tags will be displayed here -->
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
                                        <div class="form-group position-relative mb-0">
                                            <input type="text" class="form-control search-bar" id="searchInput" placeholder="Cari departemen" aria-label="Cari departemen">
                                            <i class="fas fa-search search-icon"></i>
                                        </div>
                                    </div>
                                    <div class="tag-cloud-container modal-body-scrollable">
                                        <div class="tag-cloud" id="tagCloud">
                                            @foreach ($departments as $tag)
                                                <button class="tag-button
                                                    @if(in_array($tag->id, $company->tag_ids ?? [])) selected @endif"
                                                    data-tag-id="{{ $tag->id }}" type="button">
                                                    {{ $tag->name }}
                                                </button>
                                                <input type="checkbox" value="{{ $tag->id }}"
                                                    id="tag{{ $tag->id }}" name="tag_ids[]"
                                                    @if(in_array($tag->id, $company->tag_ids ?? [])) checked @endif
                                                    style="display: none;">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="startup_summary">Deskripsi Perusahaan</label>
                        <textarea id="startup_summary" name="startup_summary" class="form-control" rows="5" required></textarea>
                        <small class="form-text text-muted">
                            Deskripsikan perusahaan Anda dengan jelas, termasuk segmentasi operasional, layanan dan produk utama, komitmen terhadap tanggung jawab sosial, dan ringkasan misi serta nilai-nilai perusahaan.
                        </small>
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
  <!-- Inline scripts that depend on jQuery -->
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
        $('.form-check-input').each(function() {
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
    });
    </script>
</body>
@endsection
