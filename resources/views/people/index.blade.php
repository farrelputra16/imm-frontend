@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/listtable/table_and_filter.css') }}">
<style>
     .breadcrumb {
        background-color: white;
        padding: 0;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
        margin-right: 14px;
        color: #9CA3AF;
    }
</style>

<div class="container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" style="margin-bottom: 32px;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #212B36;">Find Mentor</a>
            </li>
        </ol>
    </nav>

    <h2 style="margin-bottom: 32px; color: #6256CA;">People</h2>

    <div class="row">
        <!-- Sidebar Filter Section -->
        <div class="col-md-3">
            <div class="filter-header" style="vertical-align: center;  justify-content: flex-start;">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Search Icon" style="width: 20px; height: 20px; margin-left: 120px;">
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('people.index') }}" id="peopleFilterForm">
                    @csrf
                    {{-- Bagian untuk filter skill --}}
                    <div class="mb-3">
                        <h6>Skill</h6>

                        {{-- Checkbox untuk skill utama --}}
                        <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Frontend"> Frontend Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Backend"> Backend Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Full Stack"> Full Stack Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Mobile App"> Mobile App Developer</label>

                        {{-- Checkbox tambahan untuk skill lainnya --}}
                        <div style="display: none;" id="extra-Skill">
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Public Relations"> Public Relations</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Influencer"> Influencer Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="E-commerce"> E-commerce</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Data"> Data Analysis</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Machine Learning"> Machine Learning</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Cloud"> Cloud Computing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="UI/UX"> UI/UX Design</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Digital Marketing"> Digital Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="SEO"> SEO</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Content"> Content Writing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Graphic"> Graphic Design</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Accounting"> Accounting</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Project"> Project Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Sales"> Sales</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Customer"> Customer Service</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Public Speaking"> Public Speaking</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Negotiation"> Negotiation</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Social Media"> Social Media Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Video"> Video Editing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Web"> Web Analytics</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Cybersecurity"> Cybersecurity</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Blockchain"> Blockchain Technology</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="DevOps"> DevOps</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="AI"> Artificial Intelligence</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Game"> Game Developer</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="3D"> 3D Modeling</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Animation"> Animation</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Copywriting"> Copywriting</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Email"> Email Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Market"> Market Research</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Event"> Event Planning</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="HR"> Human Resources</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Legal"> Legal Compliance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Risk"> Risk Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Supply Chain"> Supply Chain Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Data Visualization"> Data Visualization</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Financial"> Financial Analysis</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Strategic"> Strategic Planning</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Coaching"> Coaching</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Mentoring"> Mentoring</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Team Leadership"> Team Leadership</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" data-category="Skills" value="Crisis"> Crisis Management</label>
                        </div>

                        {{-- Tombol untuk menampilkan skill tambahan --}}
                        <label class="others-label" onclick="toggleSkills()">Others <i class="fas fa-chevron-down"></i></label>
                    </div>

                    <!-- Experience Filter Section -->
                    <div class="mb-3">
                        <h6>Experience</h6>

                        <!-- Primary Experience Options -->
                        <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Frontend Developer"> Frontend Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Backend Developer"> Backend Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Full Stack Developer"> Full Stack Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Mobile App Developer"> Mobile App Developer</label>

                        <!-- Additional Experience Options -->
                        <div style="display: none;" id="extra-Experience">
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Public Relations"> Public Relations</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Industrial and Warehousing"> Industrial and Warehousing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Retail"> Retail</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Hospitality"> Hospitality</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Entertainment and Recreation"> Entertainment and Recreation</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Healthcare"> Healthcare</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Education"> Education</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Finance"> Finance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Marketing"> Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Sales"> Sales</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Customer Service"> Customer Service</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Project Management"> Project Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Data Analysis"> Data Analysis</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Graphic Design"> Graphic Design</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Social Media Management"> Social Media Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Content Writing"> Content Writing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Human Resources"> Human Resources</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Supply Chain Management"> Supply Chain Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Legal Services"> Legal Services</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="IT Support"> IT Support</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Research and Development"> Research and Development</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Quality Assurance"> Quality Assurance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Event Planning"> Event Planning</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Digital Marketing"> Digital Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Business Development"> Business Development</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Technical Support"> Technical Support</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Network Administration"> Network Administration</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Content Management"> Content Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="E-commerce Management"> E-commerce Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="SEO Specialist"> SEO Specialist</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Data Entry"> Data Entry</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Product Management"> Product Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Risk Management"> Risk Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Compliance"> Compliance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Training and Development"> Training and Development</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Corporate Strategy"> Corporate Strategy</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Public Policy"> Public Policy</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Environmental Services"> Environmental Services</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Non-Profit Management"> Non-Profit Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Telecommunications"> Telecommunications</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Insurance"> Insurance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Real Estate"> Real Estate</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Logistics"> Logistics</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Manufacturing"> Manufacturing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Agriculture"> Agriculture</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" data-category="Experience" value="Construction"> Construction</label>
                        </div>

                        <!-- Toggle Button for Additional Experience Options -->
                        <label class="others-Experience" onclick="toggleExperience()" style="justify-content: space-between">
                            <div>Others</div>
                            <i class="fas fa-chevron-down"></i>
                        </label>
                    </div>


                    <!-- Role Dropdown -->
                    <div class="mb-3">
                        <h6>Role</h6>
                        <select name="role" class="form-control" onchange="handleRoleChange(this)">
                            <option value="">Select Role</option>
                            <option value="mentor" {{ request()->role == 'mentor' ? 'selected' : '' }}>Mentor</option>
                            <option value="pekerja" {{ request()->role == 'pekerja' ? 'selected' : '' }}>Pekerja</option>
                            <option value="konsultan" {{ request()->role == 'konsultan' ? 'selected' : '' }}>Konsultan</option>
                        </select>
                    </div>

                    <!-- Clear Filters Button -->
                    <button type="button" onclick="clearFilters()" style="margin-top: 10px;"  class="btn btn-primary w-100">Clear Filters</button>

                    <!-- Form untuk filter -->

                    <!-- Hidden inputs container -->
                    <div id="hidden-inputs"></div>
                </form>
            </div>
        </div>

        <!-- Main Content Section -->
        <div class="col-md-9 table-section">
            <form method="GET" action="{{ route('people.index') }}"  id="peopleSearchForm">
                @csrf
                <div class="search-container"  style="max-width: 100%;">
                    <i class="fas fa-search" style="margin-left: 10px;"></i>
                    <input class="form-control" placeholder="Search People" type="text" name="search" value="{{ request('search') }}" />
                    <button class="btn" type="submit">Search</button>
                </div>
            </form>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div style="margin: 0px; padding: 0px;">
                <div id="wishlist-info" style="margin-bottom: 10px;"></div>
                <div style="display: flex; justify-content: flex-end;">
                    <button class="wishlist-button" style="display: none; position: relative;">
                        <img alt="Icon representing a list" height="20" src="{{ asset('images/WishlistIcon.svg') }}" width="20"/>
                        Add to Wishlist
                        <span id="wishlist-counter" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">
                            0
                        </span>
                    </button>
                </div>
            </div>

            <form id="wishlist-form" method="POST" action="{{ route('wishlist.add') }}">
                @csrf
                <input type="hidden" name="people_ids" id="people_ids" value="">
            </form>

            <div class="table-responsive" style="max-width: 100%;">
                <table class="table table-hover table-strip" style="border-top-left-radius: 20px; border-top-right-radius: 20px; overflow: hidden;">
                    <thead class="sub-heading-2">
                        <tr>
                            <th scope="col" style="border-top-left-radius: 20px; vertical-align: middle; border-bottom: none;">
                                <input type="checkbox" value="all_check" id="select_all" class="select_people">
                            </th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Name</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Primary Job Title</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Skills</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Role</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Last Experience</th>
                            <th scope="col" class="sub-heading-2" style="vertical-align: top; text-align: left; border-bottom: none;">Linkedin</th>
                            <th scope="col" class="sub-heading-2" style="border-top-right-radius: 20px; vertical-align: top; text-align: left; border-bottom: none;">Number of Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($people->isEmpty())
                            <tr>
                                <td colspan="8" style="text-align: center; vertical-align: middle; border-left: 1px solid #ddd; border-right: 1px solid #ddd;">
                                    <strong>Tidak ada data yang tersedia.</strong>
                                </td>
                            </tr>
                        @else
                            @foreach($people as $person)
                                <tr data-href="{{ route('people.show', $person->id) }}" class="clickable-row">
                                    <td style="vertical-align: middle; border-left: 1px solid #ddd;">
                                        <input type="checkbox" class="select_people" data-id="{{ $person->id }}">
                                    </td>
                                    <td style="vertical-align: middle;">
                                        <div style="display: flex; align-items: center;">
                                            <div style="margin-right: 2px;">
                                                <img src="{{ !empty($person->image) ? asset($person->image) : asset('images/logo-maxy.png') }}" alt="" width="30" height="30" style="border-radius: 8px; object-fit:cover;">
                                            </div>
                                            <div style="flex-grow: 1; margin-left: 0px; margin-right: 10px; width: 100px; word-wrap: break-word; word-break: break-word; white-space: normal;"
                                                @if (strlen($person->name) > 10)
                                                    title="{{ $person->name }}"
                                                    style="cursor: pointer;"
                                                @endif
                                            >
                                                <span class="body-2">{{ $person->name ?: 'N/A' }}</span>
                                            </div>
                                            <div style="margin-left: 0px; margin-right: 0px;">
                                                <i class="fas fa-search" style="color: #aee1b7;"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $person->primary_job_title ?: 'N/A' }}</td>
                                    <td style="vertical-align: middle; text-align: start;" class="body-2 skilss">{{ $person->skills ?: 'N/A' }}</td>
                                    <td style="vertical-align: middle; text-align: start;" class="body-2">{{ ucfirst($person->role) ?: 'N/A' }}</td>
                                    <td style="vertical-align: middle; text-align: start;" class="body-2">{{ $person->pengalaman ?: 'N/A' }}</td>
                                    <td style="vertical-align: middle; text-align: center;" class="body-2">
                                        @if($person->linkedin_link)
                                            <a href ="{{ $person->linkedin_link }}" target="_blank" class="linkedin-link">Link</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td style="vertical-align: middle; text-align: start; border-right: 1px solid #ddd;" class="body-2">{{ $person->phone_number ?: 'N/A' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

           <!-- Footer sebagai bagian dari tabel -->
           <div class="d-flex justify-content-between align-items-center mb-3 align-self-center"
           style="padding: 20px;
               background-color: #ffffff;
               border-bottom: 1px solid #ddd;
               border-left: 1px solid #ddd;
               border-right: 1px solid #ddd;
               border-top: 1px solid #ddd;
               margin-top:0px;
               border-end-end-radius: 20px;
               border-end-start-radius: 20px;
               height: 60px;
               max-width: 100%;
              ">
               <form method="GET" action="{{ route('people.index') }}" class="mb-0">
                   <div class="d-flex align-items-center">
                       <label for="rowsPerPage" class="me-2">Rows per page:</label>
                       <select name="rows"
                               id="rowsPerPage"
                               class="form-select me-2"
                               onchange="this.form.submit()"
                               style="width: 50%px; margin-left: 5px; margin-right: 5px;">
                           <option value="10" {{ request('rows') == 10 ? 'selected' : '' }}>10</option>
                           <option value="50" {{ request('rows') == 50 ? 'selected' : '' }}>50</option>
                           <option value="100" {{ request('rows') == 100 ? 'selected' : '' }}>100</option>
                       </select>
                       <div>
                           <span>Total {{ $people->firstItem() }} - {{ $people->lastItem() }} of {{ $people->total() }}</span>
                       </div>
                   </div>
               </form>
               <div style="margin-top: 10px;">
                   {{ $people->appends(request()->query())->links('pagination::bootstrap-4') }}
               </div>
           </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.linkedin-link').forEach(link => {
        link.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent the click from bubbling up to the row
        });
    });
</script>

<script>
    // Handle row click event and checkbox logic
    document.querySelectorAll('tr[data-href]').forEach(tr => {
        tr.addEventListener('click', function(e) {
            if (e.target.type !== 'checkbox' && !e.target.closest('.wishlist-button')) {
                window.location.href = this.dataset.href;
            }
        });
    });

    // Handle select all functionality
    document.getElementById('select_all').addEventListener('change', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.select_people').forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        updateWishlistButton();
        updateWishlistCounter();
        saveWishlistState();
    });

    // Handle checkboxes dynamically using event delegation
    document.querySelector('tbody').addEventListener('change', function(e) {
        if (e.target.classList.contains('select_people')) {
            e.preventDefault();
            updateWishlistButton();
            updateWishlistCounter();
            saveWishlistState();

            const allCheckboxes = document.querySelectorAll('.select_people');
            const checkedCheckboxes = document.querySelectorAll('.select_people:checked');
            document.getElementById('select_all').checked = allCheckboxes.length === checkedCheckboxes.length;
        }
    });

    // Fungsi untuk update counter wishlist
    function updateWishlistCounter() {
        const selectedCount = document.querySelectorAll('.select_people:checked').length;
        const totalCount = document.querySelectorAll('.select_people').length;

        // Update counter di navbar jika ada
        const wishlistCounter = document.getElementById('wishlist-counter');
        if (wishlistCounter) {
            wishlistCounter.textContent = selectedCount;
            wishlistCounter.style.display = selectedCount > 0 ? 'inline-block' : 'none';
        }

        // Update counter info di atas tabel
        const wishlistInfo = document.getElementById('wishlist-info');
        if (!wishlistInfo) {
            const infoDiv = document.createElement('div');
            infoDiv.id = 'wishlist-info';
            infoDiv.style.marginBottom = '10px';
            document.querySelector('.wishlist-button').parentElement.insertBefore(infoDiv, document.querySelector('.wishlist-button'));
        }
    }

    // Fungsi untuk update tampilan tombol wishlist
    function updateWishlistButton() {
        const selectedInvestors = Array.from(document.querySelectorAll('.select_people:checked')).map(cb => cb.dataset.id);
        const wishlistButton = document.querySelector('.wishlist-button');
        const searchContainer = document.querySelector('.search-container');

        if (selectedInvestors.length > 0) {
            wishlistButton.style.display = 'inline-block';
            document.getElementById('people_ids').value = selectedInvestors.join(',');
            searchContainer.style.marginBottom = '0px';

            wishlistButton.innerHTML = `
                <img alt="Icon representing a list" height="20" src="${wishlistButton.querySelector('img').src}" width="20"/>
                Add to Wishlist (${selectedInvestors.length})
            `;
        } else {
            wishlistButton.style.display = 'none';
            document.getElementById('people_ids').value = '';
            searchContainer.style.marginBottom = '20px';
        }
    }

    // Fungsi untuk menyimpan state wishlist ke localStorage
    function saveWishlistState() {
        const selectedInvestors = Array.from(document.querySelectorAll('.select_people:checked')).map(cb => cb.dataset.id);
        localStorage.setItem('investorWishlistSelection', JSON.stringify(selectedInvestors));
    }

    // Fungsi untuk memuat state wishlist dari localStorage
    function loadWishlistState() {
        const savedSelection = JSON.parse(localStorage.getItem('investorWishlistSelection')) || [];
        savedSelection.forEach(id => {
            const checkbox = document.querySelector(`.select_people[data-id="${id}"]`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
        updateWishlistButton();
        updateWishlistCounter();
    }

    // Handle wishlist button click
    const wishlistButton = document.querySelector('.wishlist-button');
    wishlistButton.addEventListener('click', function(e) {
        e.preventDefault();

        const selectedInvestors = document.querySelectorAll('.select_people:checked');
        if (selectedInvestors.length === 0) {
            alert('Please select at least one investor to add to wishlist');
            return;
        }

        updateWishlistButton();

        // Tambahkan animasi loading
        wishlistButton.innerHTML = `
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Adding to Wishlist...
        `;
        wishlistButton.disabled = true;

        // Submit form
        document.getElementById('wishlist-form').submit();
        localStorage.removeItem('investorWishlistSelection');
    });

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', () => {
        loadWishlistState();

        // Add initial counter display
        const counterDiv = document.createElement('div');
        counterDiv.id = 'wishlist-info';
        counterDiv.style.marginBottom = '10px';
        document.querySelector('.wishlist-button').parentElement.insertBefore(counterDiv, document.querySelector('.wishlist-button'));

        updateWishlistCounter();
    });
</script>

{{-- explode string , --}}
<script>
    function explodeString(str, delimiter) {
        var arr = str.split(delimiter);
        return arr;
    }

    var skillElements = document.querySelectorAll('.skilss');
    skillElements.forEach(function(element) {
        // Mengambil skill dari innerHTML dan mengexplode-nya
        var skillsArray = explodeString(element.innerHTML, ',');

        // Membatasi hanya mengambil 3 skill saja
        var limitedSkills = skillsArray.slice(0, 3);

        // Menggabungkan kembali menjadi string dengan <br> sebagai pemisah
        element.innerHTML = limitedSkills.join('<br>');

        // Menampilkan hasil di console
        console.log(limitedSkills);
    });
</script>

{{-- script untuk memunculkan lebih banyak pilihan --}}
<script>
    function toggleSkills() {
        const extraSkill = document.getElementById('extra-Skill');
        const othersLabel = document.querySelector('.others-label');

        if (extraSkill && othersLabel) { // Pastikan elemen ditemukan
            if (extraSkill.style.display === "none" || extraSkill.style.display === "") {
                othersLabel.innerHTML = 'Others <i class="fas fa-chevron-up"></i>';
                extraSkill.style.display = "block";
            } else {
                othersLabel.innerHTML = 'Others <i class="fas fa-chevron-down"></i>';
                extraSkill.style.display = "none";
            }
        } else {
            console.error('Element with id "extra-Skill" or class "others-label" not found.');
        }
    }

    function toggleExperience() {
        const extraExperience = document.getElementById('extra-Experience');
        const othersExperience = document.querySelector('.others-Experience');

        if (extraExperience && othersExperience) { // Pastikan elemen ditemukan
            if (extraExperience.style.display === "none" || extraExperience.style.display === "") {
                othersExperience.innerHTML = 'Others <i class="fas fa-chevron-up"></i>';
                extraExperience.style.display = "block";
            } else {
                othersExperience.innerHTML = 'Others <i class="fas fa-chevron-down"></i>';
                extraExperience.style.display = "none";
            }
        } else {
            console.error('Element with id "extra-Experience" or class "others-Experience" not found.');
        }
    }
</script>

<script>
    // Fungsi untuk menampilkan atau menyembunyikan skill tambahan
    function toggleSkills() {
        const extraSkillDiv = document.getElementById("extra-Skill");
        extraSkillDiv.style.display = extraSkillDiv.style.display === "none" ? "block" : "none";
    }

    // Fungsi untuk menampilkan atau menyembunyikan experience tambahan
    function toggleExperience() {
        const extraExperienceDiv = document.getElementById("extra-Experience");
        extraExperienceDiv.style.display = extraExperienceDiv.style.display === "none" ? "block" : "none";
    }

    // Fungsi untuk menyimpan status checkbox filter ke localStorage berdasarkan kategori
    function saveCheckboxState(category) {
        const filterCheckboxes = document.querySelectorAll(`.filter-checkbox[data-category="${category}"]`);
        filterCheckboxes.forEach(checkbox => {
            localStorage.setItem(`${category}-${checkbox.value}`, checkbox.checked);
        });
    }

    // Fungsi untuk memuat status checkbox filter dari localStorage
    function loadCheckboxState(category) {
        const filterCheckboxes = document.querySelectorAll(`.filter-checkbox[data-category="${category}"]`);
        filterCheckboxes.forEach(checkbox => {
            const checked = localStorage.getItem(`${category}-${checkbox.value}`) === 'true';
            checkbox.checked = checked;
        });
    }

    // Fungsi untuk mencegah duplikat checkbox yang terpilih
    function checkForDuplicates(event, category) {
        const checkboxes = document.querySelectorAll(`.filter-checkbox[data-category="${category}"]`);
        const currentValue = event.target.value;

        checkboxes.forEach(checkbox => {
            if (checkbox !== event.target && checkbox.checked && checkbox.value === currentValue) {
                checkbox.checked = false; // Uncheck duplicate checkbox
            }
        });
    }

    // Fungsi untuk mengirimkan form otomatis ketika checkbox berubah
    function autoFilterCheckbox(event) {
        if (event.target.classList.contains('filter-checkbox')) {
            const category = event.target.getAttribute('data-category');
            saveCheckboxState(category);
            document.getElementById('peopleFilterForm').submit(); // Autosubmit form
        }
    }

    // Inisialisasi pada saat halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', () => {
        // Muat status checkbox untuk setiap kategori
        loadCheckboxState('Skills');
        loadCheckboxState('Experience');

        // Pasang event listener perubahan checkbox berdasarkan kategori
        document.querySelectorAll('.filter-checkbox[data-category="Skills"]').forEach(checkbox => {
            checkbox.addEventListener('change', (event) => {
                checkForDuplicates(event, 'Skills');
                autoFilterCheckbox(event);
            });
        });

        document.querySelectorAll('.filter-checkbox[data-category="Experience"]').forEach(checkbox => {
            checkbox.addEventListener('change', (event) => {
                checkForDuplicates(event, 'Experience');
                autoFilterCheckbox(event);
            });
        });
    });
</script>

<script>
    // Fungsi untuk membersihkan semua filter atau berdasarkan kategori
    function clearFilters(category = null) {
        // Jika kategori spesifik disediakan, hanya bersihkan checkbox dari kategori itu
        if (category) {
            // Clear hanya checkbox untuk kategori yang dipilih
            document.querySelectorAll(`.filter-checkbox[data-category="${category}"]`).forEach(checkbox => {
                checkbox.checked = false;
                localStorage.removeItem(`${category}-${checkbox.value}`);
            });
        } else {
            // Jika tidak ada kategori yang ditentukan, bersihkan semua kategori
            document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
                checkbox.checked = false;
                const checkboxCategory = checkbox.getAttribute('data-category');
                localStorage.removeItem(`${checkboxCategory}-${checkbox.value}`);
            });

            // Clear hidden inputs, search input, dan dropdown secara umum
            document.getElementById('hidden-inputs').innerHTML = '';
            document.querySelector('input[name="search"]').value = '';
            document.querySelector('select[name="role"]').value = '';
            document.getElementById('select_all').checked = false;
            document.querySelector('input[name="search"]').value = '';


            // Clear item umum di localStorage
            localStorage.removeItem('selectedTags');
            localStorage.removeItem('companySearch');
            localStorage.removeItem('selectedRole');
            localStorage.removeItem('peopleSearch');
        }

        // Submit form setelah pembersihan
        document.getElementById('peopleFilterForm').submit();
    }
</script>

{{-- Handel Role --}}
<script>
    // Fungsi untuk menyimpan status role ke local storage
    function saveRoleState(selectedRole) {
        localStorage.setItem('selectedRole', selectedRole);
    }

    // Fungsi untuk memuat status role dari local storage
    function loadRoleState() {
        const savedRole = localStorage.getItem('selectedRole');
        if (savedRole) {
            const selectElement = document.querySelector('select[name="role"]');
            selectElement.value = savedRole; // Set the select to the saved role
        }
    }

    // Fungsi untuk menangani perubahan pada dropdown role
    function handleRoleChange(selectElement) {
        const selectedRole = selectElement.value;
        saveRoleState(selectedRole); // Save the selected role
        document.getElementById('peopleFilterForm').submit(); // Submit the form
    }

    // Initialize role filter functionality
    document.addEventListener('DOMContentLoaded', () => {
        loadRoleState(); // Load the previously saved role when the page loads
    });
</script>

{{-- Filter untuk search --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Menyimpan nilai pencarian ke localStorage saat form di-submit
        document.getElementById('peopleSearchForm').addEventListener('submit', function() {
            localStorage.setItem('peopleSearch', document.querySelector('input[name="search"]').value);
        });

        // Mengisi input pencarian dengan nilai dari localStorage saat halaman dimuat
        var savedSearch = localStorage.getItem('peopleSearch');
        if (savedSearch) {
            document.querySelector('input[name="search"]').value = savedSearch;
        }
    });
</script>
@endsection
