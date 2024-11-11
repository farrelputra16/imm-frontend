@extends('layouts.app-landingpage')

@section('content')
<!-- Custom Font from Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
            <div class="filter-header">
                <h4><b>FILTER</b></h4>
                <img src="{{ asset('images/filter.svg') }}" alt="Filter Icon" style="width: 20px; height: 20px; margin-left: 10px;">
            </div>
            <div class="filter-section">
                <form method="GET" action="{{ route('people.index') }}" id="peopleFilterForm">
                    @csrf

                    {{-- Bagian buat filter skill --}}
                    <div class="mb-3">
                        <h6>Skill</h6>

                        <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Frontend Developer" onchange="autoFilter()"> Frontend Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Backend Developer" onchange="autoFilter()"> Backend Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Full Stack Developer" onchange="autoFilter()"> Full Stack Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Mobile App Developer" onchange="autoFilter()"> Mobile App Developer</label>

                        <div style="display: none;" id="extra-Skill">
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Public Relations" onchange="autoFilter()"> Public Relations</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Influencer Marketing" onchange="autoFilter()"> Influencer Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="E-commerce" onchange="autoFilter()"> E-commerce</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Data Analysis" onchange="autoFilter()"> Data Analysis</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Machine Learning" onchange="autoFilter()"> Machine Learning</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Cloud Computing" onchange="autoFilter()"> Cloud Computing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="UI/UX Design" onchange="autoFilter()"> UI/UX Design</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Digital Marketing" onchange="autoFilter()"> Digital Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="SEO" onchange="autoFilter()"> SEO</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Content Writing" onchange="autoFilter()"> Content Writing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Graphic Design" onchange="autoFilter()"> Graphic Design</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Accounting" onchange="autoFilter()"> Accounting</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Project Management" onchange="autoFilter()"> Project Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Sales" onchange="autoFilter()"> Sales</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Customer Service" onchange="autoFilter()"> Customer Service</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Public Speaking" onchange="autoFilter()"> Public Speaking</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Negotiation" onchange="autoFilter()"> Negotiation</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Social Media Management" onchange="autoFilter()"> Social Media Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Video Editing" onchange="autoFilter()"> Video Editing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Web Analytics" onchange="autoFilter()"> Web Analytics</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Cybersecurity" onchange="autoFilter()"> Cybersecurity</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Blockchain Technology" onchange="autoFilter()"> Blockchain Technology</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="DevOps" onchange="autoFilter()"> DevOps</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Artificial Intelligence" onchange="autoFilter()"> Artificial Intelligence</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Game Developer" onchange="autoFilter()"> Game Developer</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="3D Modeling" onchange="autoFilter()"> 3D Modeling</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Animation" onchange="autoFilter()"> Animation</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Copywriting" onchange="autoFilter()"> Copywriting</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Email Marketing" onchange="autoFilter()"> Email Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Market Research" onchange="autoFilter()"> Market Research</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Event Planning" onchange="autoFilter()"> Event Planning</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Human Resources" onchange="autoFilter()"> Human Resources</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Legal Compliance" onchange="autoFilter()"> Legal Compliance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Risk Management" onchange="autoFilter()"> Risk Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Supply Chain Management" onchange="autoFilter()"> Supply Chain Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Data Visualization" onchange="autoFilter()"> Data Visualization</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Financial Analysis" onchange="autoFilter()"> Financial Analysis</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Strategic Planning" onchange="autoFilter()"> Strategic Planning</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Coaching" onchange="autoFilter()"> Coaching</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Mentoring" onchange="autoFilter()"> Mentoring</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Team Leadership" onchange="autoFilter()"> Team Leadership</label>
                            <label><input type="checkbox" class="filter-checkbox" name="Skills[]" value="Crisis Management" onchange="autoFilter()"> Crisis Management</label>
                        </div>

                        <label class="others-label" onclick="toggleSkills()">Others <i class="fas fa-chevron-down"></i></label>
                    </div>

                    <div class="mb-3">
                        <h6>Experience</h6>

                        <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Frontend Developer" onchange="autoFilter()"> Frontend Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Backend Developer" onchange="autoFilter()"> Backend Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Full Stack Developer" onchange="autoFilter()"> Full Stack Developer</label>
                        <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Mobile App Developer" onchange="autoFilter()"> Mobile App Developer</label>

                        <div style="display: none;" id="extra-Experience">
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Public Relations" onchange="autoFilter()"> Public Relations</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Industrial and Warehousing" onchange="autoFilter()"> Industrial and Warehousing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Retail" onchange="autoFilter()"> Retail</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Hospitality" onchange="autoFilter()"> Hospitality</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Entertainment and Recreation" onchange="autoFilter()"> Entertainment and Recreation</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Healthcare" onchange="autoFilter()"> Healthcare</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Education" onchange="autoFilter()"> Education</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Finance" onchange="autoFilter()"> Finance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Marketing" onchange="autoFilter()"> Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Sales" onchange="autoFilter()"> Sales</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Customer Service" onchange="autoFilter()"> Customer Service</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Project Management" onchange="autoFilter()"> Project Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Data Analysis" onchange="autoFilter()"> Data Analysis</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Graphic Design" onchange="autoFilter()"> Graphic Design</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Social Media Management" onchange="autoFilter()"> Social Media Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Content Writing" onchange="autoFilter()"> Content Writing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Human Resources" onchange="autoFilter()"> Human Resources</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Supply Chain Management" onchange="autoFilter()"> Supply Chain Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Legal Services" onchange="autoFilter()"> Legal Services</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="IT Support" onchange="autoFilter()"> IT Support</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Research and Development" onchange="autoFilter()"> Research and Development</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Quality Assurance" onchange="autoFilter()"> Quality Assurance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Event Planning" onchange="autoFilter()"> Event Planning</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Digital Marketing" onchange="autoFilter()"> Digital Marketing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Business Development" onchange="autoFilter()"> Business Development</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Technical Support" onchange="autoFilter()"> Technical Support</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Network Administration" onchange="autoFilter()"> Network Administration</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Content Management" onchange="autoFilter()"> Content Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="E-commerce Management" onchange="autoFilter()"> E-commerce Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="SEO Specialist" onchange="autoFilter()"> SEO Specialist</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Data Entry" onchange="autoFilter()"> Data Entry</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Product Management" onchange="autoFilter()"> Product Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Risk Management" onchange="autoFilter()"> Risk Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Compliance" onchange="autoFilter()"> Compliance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Training and Development" onchange="autoFilter()"> Training and Development</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Corporate Strategy" onchange="autoFilter()"> Corporate Strategy</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Public Policy" onchange="autoFilter()"> Public Policy</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Environmental Services" onchange="autoFilter()"> Environmental Services</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Non-Profit Management" onchange="autoFilter()"> Non-Profit Management</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Telecommunications" onchange="autoFilter()"> Telecommunications</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Insurance" onchange="autoFilter()"> Insurance</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Real Estate" onchange="autoFilter()"> Real Estate</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Logistics" onchange="autoFilter()"> Logistics</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Manufacturing" onchange="autoFilter()"> Manufacturing</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Agriculture" onchange="autoFilter()"> Agriculture</label>
                            <label><input type="checkbox" class="filter-checkbox" name="experience[]" value="Construction" onchange="autoFilter()"> Construction</label>
                        </div>

                        <label class="others-Experience" onclick="toggleExperience()" style="justify-content: space-between"><div>Others</div> <i class="fas fa-chevron-down"></i></label>
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
            <form method="GET" action="{{ route('people.index') }}"  id="investorSearchForm">
                @csrf
                <div class="search-container">
                    <i class="fas fa-search" style="margin-left: 10px;"></i>
                    <input class="form-control" placeholder="Search Investors" type="text" name="search" value="{{ request('search') }}" />
                    <button class="btn" type="submit">Search</button>
                </div>
            </form>

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

            <div class="table-responsive">
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
                                        <span class="body-2">{{ $person->name }}</span>
                                    </div>
                                    <div style="margin-left: 0px; margin-right: 0px;">
                                        <i class="fas fa-search" style="color: #aee1b7;"></i>
                                    </div>
                                </div>
                            </td>
                            <td style="vertical-align: middle; text-align: center;" class="body-2">{{ $person->primary_job_title }}</td>
                            <td style="vertical-align: middle; text-align: start;" class="body-2 skilss">{{ $person->skills }}</td>
                            <td style="vertical-align: middle; text-align: start;" class="body-2">{{ ucfirst($person->role) }}</td>
                            <td style="vertical-align: middle; text-align: start;" class="body-2">{{ $person->pengalaman }}</td>
                            <td style="vertical-align: middle; text-align: center;" class="body-2">
                                @if($person->linkedin_link)
                                    <a href="{{ $person->linkedin_link }}" target="_blank" class ="linkedin-link">Link</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td style="vertical-align: middle; text-align: start; border-right: 1px solid #ddd;" class="body-2">{{ $person->phone_number }}</td>
                        </tr>
                        @endforeach
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
               height: 60px;">
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
                window.Skills.href = this.dataset.href;
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

        // Cek apakah extraSkill ada
        if (extraSkill) {
            if (extraSkill.style.display === "none" || extraSkill.style.display === "") {
                othersLabel.innerHTML = 'Others <i class="fas fa-chevron-up"></i>';
                extraSkill.style.display = "block";
            } else {
                othersLabel.innerHTML = 'Others <i class="fas fa-chevron-down"></i>';
                extraSkill.style.display = "none";
            }
        } else {
            console.error('Element with class "extra-Skill" not found.');
        }
    }

    function toggleExperience() {
        const extraExperience = document.getElementById('extra-Experience');
        const othersExperience = document.querySelector('.others-Experience');

        if (extraExperience.style.display === "none" || extraExperience.style.display === "") {
            extraExperience.style.display = "block";
            othersExperience.innerHTML = 'Others <i class="fas fa-chevron-up"></i>';
        } else {
            extraExperience.style.display = "none";
            othersExperience.innerHTML = 'Others <i class="fas fa-chevron-down"></i>';
        }
    }
</script>

{{-- Script untuk checkbox filter --}}
<script>
    // Fungsi untuk menyimpan status checkbox filter
    function saveCheckboxState() {
        const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
        filterCheckboxes.forEach(checkbox => {
            localStorage.setItem(checkbox.value, checkbox.checked);
        });
    }

    // Fungsi untuk memuat status checkbox filter
    function loadCheckboxState() {
        const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
        filterCheckboxes.forEach(checkbox => {
            const checked = localStorage.getItem(checkbox.value) === 'true';
            checkbox.checked = checked;
        });
    }

    // Fungsi untuk memeriksa duplikat dan mengatur checkbox
    function checkForDuplicates(event) {
        const checkboxes = document.querySelectorAll('.filter-checkbox');
        const currentValue = event.target.value;

        checkboxes.forEach(checkbox => {
            if (checkbox !== event.target && checkbox.checked && checkbox.value === currentValue) {
                checkbox.checked = false; // Uncheck the duplicate checkbox
            }
        });
    }

    // Fungsi untuk mengirimkan form ketika checkbox filter berubah
    function autoFilterCheckbox(event) {
        // Pastikan ini bukan checkbox wishlist
        if (event.target.classList.contains('filter-checkbox')) {
            saveCheckboxState();
            document.getElementById('peopleFilterForm').submit();
        }
    }

    // Initialize checkbox filter functionality
    document.addEventListener('DOMContentLoaded', () => {
        loadCheckboxState();

        // Setup checkbox change listeners khusus untuk filter
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', (event) => {
                checkForDuplicates(event); // Check for duplicates on change
                autoFilterCheckbox(event); // Trigger the filter
            });
        });
    });
</script>

<script>
    // Fungsi untuk membersihkan semua filter
    function clearFilters() {
        // Clear filter checkboxes only
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
            checkbox.checked = false;
            localStorage.removeItem(checkbox.value);
        });

        // Clear hidden inputs dan search input
        document.getElementById('hidden-inputs').innerHTML = '';
        document.querySelector('input[name="search"]').value = '';
        document.querySelector('select[name="role"]').value = '';

        // Clear localStorage
        localStorage.removeItem('selectedTags');
        localStorage.removeItem('companySearch');
        localStorage.removeItem('selectedRole');

        // Submit form
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
@endsection
