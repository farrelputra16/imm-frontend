@extends('layouts.app-imm')
@section('title', 'Profil')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile/profile.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
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
{{-- <div class="container pt-2 gap-2" style="max-width: 1200px; padding: 15px; margin: auto;"> --}}
<div class="container pt-2 gap-2">
    <div class="row section" style="margin-bottom: 30px;">
        <div class="col-md-4 text-center">
            <img src="{{ $user->img ? asset('images/' . $user->img) : asset('images/default_user.webp') }}" class="rounded-circle img-fluid" alt="Profile Picture">
        </div>
        <div class="col-md-4 bio">
            <div class="biodata">
                @if ($userRole === 'INVESTOR')
                    <h2 class="mb-3"> {{$user->nama_depan}} {{ $user->nama_belakang }}</h2>
                    <p><i class="fas fa-phone" style="color: black"></i> {{$investor->investor_type}}</p>
                    <p><i class="fas fa-envelope" style="color: black"></i> {{$user->email}}</p>
                    <span><i class="fas fa-map-marker-alt" style="color: black"></i> {{$investor->location}} </span> <br>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary mt-3">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                @else
                    <h2 class="mb-3"> {{$user->nama_depan}} {{ $user->nama_belakang }}</h2>
                    <p><i class="fas fa-phone" style="color: black; margin-right: 10px;"></i> {{$user->telepon}}</p>
                    <p><i class="fas fa-envelope" style="color: black; margin-right: 10px;"></i> {{$user->email}}</p>
                    <span><i class="fas fa-map-marker-alt" style="color: black; margin-right: 10px;"></i>{{ $user->provinsi }} {{$user->alamat}}</span> <br>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary mt-3">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                @endif
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <!-- Table Section -->
    <h2>Your Wishlist</h2>
    @if ($userRole === 'INVESTOR')
        <div class="table-responsive">
            <table class="table table-hover table-strip" style="margin-bottom: 0px;">
                <thead>
                    <tr>
                        <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle;">
                            <input type="checkbox" value="all_check" id="select_all" class="select_company">
                        </th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left;">Organization <br> Name</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top;">Founded <br> Date</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top;">Last Funding <br> Date</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top;">Last Funding <br> Type</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top;">Number of <br> Employees</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top;">Business Model</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top;">Description</th>
                        <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top;">Job Departments</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                        <tr data-href="{{ route('companies.show', $company->id) }}">
                            <td style="vertical-align: middle;">
                                <input type="checkbox" class="select_company" data-id="{{ $company->id }}">
                            </td>
                            <td style="vertical-align: middle;">
                                <div style="display: flex; align-items: center;">
                                    <div style="margin-right: 2px;">
                                        <img src="{{ !empty($company->image) ? env('APP_URL') . $company->image : asset('images/logo-maxy.png') }}" alt="" width="30" height="30"
                                        style="border-radius: 8px; object-fit:cover;">
                                    </div>
                                    <div style="flex-grow: 1; margin-left: 0px; margin-right: 0px; width: 100px; word-wrap: break-word; word-break: break-word; white-space: normal;"
                                        @if (strlen($company->nama) > 10)
                                            title="{{ $company->nama }}"
                                            style="cursor: pointer;"
                                        @endif
                                    >
                                        <span class="body-2">{{ $company->nama }}</span>
                                    </div>
                                    <div style="margin-left: 0px; margin-right: 0px;">
                                        <i class="fas fa-search" style="color: #aee1b7;"></i>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle;" class="body-2">{{ $company->founded_date ? \Carbon\Carbon::parse($company->founded_date)->format('j M, Y') : 'N/A' }}</td>
                            <td style="vertical-align: middle;" class="body-2">{{ $company->latest_funding_date ? \Carbon\Carbon::parse($company->latest_funding_date)->format('j M, Y') : 'N/A' }}</td>
                            <td style="vertical-align: middle;" class="body-2">
                                <div style="display: flex; align-items: center; justify-content: center; height: 100%;">
                                    @if ($company->funding_stage)
                                        <div class="funding-stage">{{ $company->funding_stage }}</div>
                                    @else
                                        <div>No funding data available</div>
                                    @endif
                                </div>
                            </td>
                            <td style="vertical-align: middle;" class="body-2">{{ $company->jumlah_karyawan }}</td>
                            <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $company->business_model }}</td>
                            <td style="vertical-align: middle;" class="body-2">{{ Str::limit($company->startup_summary, 20, '...') }}</td>
                            <td style="vertical-align: middle; cursor: pointer;" title={{ $company->all_departments }} class="body-2">
                                {{ $company->departments->join(', ') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif ($userRole === 'USER')
        <div class="table-responsive">
            <table class="table table-hover table-strip" style="margin-bottom: 0px;">
                <thead class="sub-heading-2">
                    <tr>
                        <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle; border-bottom: none;"><input type="checkbox" value="all_check" id="select_all_investor" class="select_investor"></th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Organization Name</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Number of Contacts</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Number of Investments</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Invesment Stage</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Investor Type</th>
                        <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Location</th>
                        <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top; text-align: left; border-bottom: none;">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($investors as $investor)
                    <tr data-href="{{ route('investors.show', $investor->id) }}">
                        <td style="vertical-align: middle; border-left: 1px solid #ddd;"><input type="checkbox" class="select_investor" data-id="{{ $investor->id }}"></td>
                        <td style="vertical-align: middle;">
                            <div style="display: flex; align-items: center;">
                                <div style="margin-right: 2px;">
                                    <img src="{{ !empty($investor->image) ? asset($investor->image) : asset('images/logo-maxy.png') }}" alt="" width="30" height="30" style="border-radius: 8px; object-fit:cover;">
                                </div>
                                <div style="flex-grow: 1; margin-left: 0px; margin-right: 10px; width: 100px; word-wrap: break-word; word-break: break-word; white-space: normal;"
                                    @if (strlen($investor->org_name) > 10)
                                        title="{{ $investor->org_name }}"
                                        style="cursor: pointer;"
                                    @endif
                                >
                                    <span class="body-2">{{ $investor->org_name }}</span>
                                </div>
                                <div style="margin-left: 0px; margin-right: 0px;">
                                    <i class="fas fa-search" style="color: #aee1b7;"></i>
                                </div>
                            </div>
                        </td>
                        <td  style="vertical-align: middle; text-align: center;" class="body-2">{{ $investor->number_of_contacts }}</td>
                        <td  style="vertical-align: middle; text-align: center;" class="body-2">{{ $investor->number_of_investments }}</td>
                        <td  style="vertical-align: middle; text-align: center;" class="body-2 investment-stage">{{ $investor->investment_stage }}</td>
                        <td  style="vertical-align: middle; text-align: center;" class="body-2">{{ $investor->investor_type }}</td>
                        <td  style="vertical-align: middle; text-align: start;" class="body-2">{{ $investor->location }}</td>
                        <td style="vertical-align: middle; text-align: start; border-right: 1px solid #ddd;" class="body-2">{{ Str::limit($investor->description, 20, '...') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <!-- Footer sebagai bagian dari tabel -->
    <div class="d-flex justify-content-between align-items-center mb-3 align-self-center" style="padding: 20px; background-color: #ffffff; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-top: 0px solid #ffffff; margin-top:0px; height:100px; border-end-end-radius: 20px; border-end-start-radius: 20px; height: 60px;">
        <form method="GET" action="{{ route('profile') }}" class="mb-0">
            <div class="d-flex align-items-center">
                <label for="rowsPerPage" class="me-2">Rows per page:</label>
                <select name="rows" id="rowsPerPage" class="form-select me-2" onchange="this.form.submit()" style="width: 50%px; margin-left: 5px; margin-right: 5px;">
                    <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                    <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                </select>
                <div>
                    @if ($userRole === 'INVESTOR')
                        @if ($companies->total() > 0)
                            <span>Total {{ $companies->firstItem() }} - {{ $companies->lastItem() }} of {{ $companies->total() }}</span>
                        @else
                            <span>No companies found</span>
                        @endif

                    @elseif ($userRole === 'USER')
                        @if ($investors->total() > 0)
                            <span>Total {{ $investors->firstItem() }} - {{ $investors->lastItem() }} of {{ $investors->total() }}</span>
                        @else
                            <span>No investors found</span>
                        @endif

                    @endif
                </div>
            </div>
        </form>
        <div style="margin-top: 10px;">
            @if ($userRole === 'INVESTOR')
                @if ($companies->total() > 0)
                    {{ $companies->appends(request()->query())->links('pagination::bootstrap-4') }}
                @else
                    <div class="d-flex justify-content-center">
                        <span>No companies found</span>
                    </div>
                @endif
            @elseif ($userRole === 'USER')
                @if ($investors->total() > 0)
                    {{ $investors->appends(request()->query())->links('pagination::bootstrap-4') }}
                @else
                    <div class="d-flex justify-content-center">
                        <span>No investors found</span>
                    </div>
                @endif
            @endif
        </div>
    </div>

    <div class="align-self-center">
        @if ($userRole === 'INVESTOR')
            <form action="{{ route('wishlist.remove') }}" method="POST" id="wishlistForm">
                @csrf
                @method('DELETE') <!-- Ini penting untuk mensimulasikan metode DELETE -->
                <input type="hidden" name="company_ids" id="company_ids" value="">
                <button type="submit" id="remove_wishlist_button" class="btn btn-primary-red wishlist-button" style="display: none;">Remove from Wishlist</button>
            </form>
        @elseif ($userRole === 'USER')
            <form action="{{ route('wishlist.remove') }}" method="POST" id="wishlistFormUser ">
                @csrf
                @method('DELETE')
                <input type="hidden" name="investor_ids" id="investor_ids" value="">
                <button type="submit" id="remove_wishlist_button_user" class="btn btn-primary-red wishlist-button" style="display: none;">Remove from Wishlist</button>
            </form>
        @endif
    </div>
</div>
<script>
    // Asumsikan kita memiliki variabel global untuk menyimpan role pengguna
    const userRole = "{{ $userRole }}"; // Ambil role pengguna dari server-side

    document.addEventListener('DOMContentLoaded', function() {
        // Event listener untuk baris tabel yang dapat diklik
        document.querySelectorAll('tr[data-href]').forEach(tr => {
            tr.addEventListener('click', function(e) {
                if (e.target.type !== 'checkbox') {
                    window.location.href = this.dataset.href;
                }
            });
        });

        // Event listener untuk select_all (company)
        document.getElementById('select_all')?.addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.select_company');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleWishlistButton();
        });

        // Event listener untuk select_all (investor)
        document.getElementById('select_all_investor')?.addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('.select_investor');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleWishlistButton();
        });

        // Function to show/hide the wishlist button
        function toggleWishlistButton() {
            let checkedInvestorCheckboxes = document.querySelectorAll('.select_investor:checked');
            let checkedCompanyCheckboxes = document.querySelectorAll('.select_company:checked');

            let wishlistButtonInvestor = document.getElementById('remove_wishlist_button_user');
            let wishlistButtonCompany = document.getElementById('remove_wishlist_button');

            // Tambahkan pengecekan sebelum mengakses style
            if (wishlistButtonCompany) {
                wishlistButtonCompany.style.display = checkedCompanyCheckboxes.length > 0 ? 'block' : 'none';
            }

            if (wishlistButtonInvestor) {
                wishlistButtonInvestor.style.display = checkedInvestorCheckboxes.length > 0 ? 'block' : 'none';
            }

            // Perbarui nilai input tersembunyi jika ada
            let companyIds = Array.from(checkedCompanyCheckboxes).map(checkbox => checkbox.dataset.id).join(',');
            let investorIds = Array.from(checkedInvestorCheckboxes).map(checkbox => checkbox.dataset.id).join(',');

            if (userRole === 'INVESTOR') {
                let companyIdsInput = document.getElementById('company_ids');
                if (companyIdsInput) {
                    companyIdsInput.value = companyIds;
                }
            } else if (userRole === 'USER') {
                let investorIdsInput = document.getElementById('investor_ids');
                if (investorIdsInput) {
                    investorIdsInput.value = investorIds;
                }
            }
        }

        // Event listeners untuk setiap checkbox
        document.querySelectorAll('.select_company, .select_investor').forEach(checkbox => {
            checkbox.addEventListener('change', toggleWishlistButton);
        });

        // Event listener for company wishlist removal
        document.getElementById('remove_wishlist_button')?.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form dari submit otomatis
            let checkedCheckboxes = document.querySelectorAll('.select_company:checked');
            let idsToRemove = Array.from(checkedCheckboxes).map(checkbox => checkbox.dataset.id).join(',');
            if (idsToRemove) {
                document.getElementById('company_ids').value = idsToRemove; // Set nilai input tersembunyi
                document.getElementById('wishlistForm').submit(); // Submit form
            } else {
                alert('Please select at least one company to remove.');
            }
        });

        // Event listener for investor wishlist removal
        document.getElementById('remove_wishlist_button_user')?.addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah form dari submit otomatis
            let checkedCheckboxes = document.querySelectorAll('.select_investor:checked');
            let idsToRemove = Array.from(checkedCheckboxes).map(checkbox => checkbox.dataset.id).join(',');
            if (idsToRemove) {
                document.getElementById('investor_ids').value = idsToRemove; // Set nilai input tersembunyi
                document.getElementById('wishlistFormUser ').submit(); // Submit form
            } else {
                alert('Please select at least one investor to remove.');
            }
        });
    });
</script>
@endsection
