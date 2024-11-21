@extends('layouts.app-people')

@section('title', 'Profile Page')

    <!-- External styles and custom fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
    <style>
        /* Custom styling for the Profile page */
        .profile-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px; /* Konsisten dengan Bootstrap */
        }
        body {
            background-color: #f8f9fa;
        }
        .profile-header {
            margin-top: 50px;
            display: flex;
            flex-direction: column;
            height: 550px;
            border-radius: 8px;
            overflow: hidden;
        }
        .profile-header-top {
            background-color: #6256CA;
            color: white;
            flex: 4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-top: 20px;
        }
        .profile-header-bottom {
            background-color: white;
            flex: 6;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 10px;
            color: #333;
            position: relative;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Added shadow */
        }
        .profile-header img {
            margin-right:1000px;
            border: 3px solid white;
            border-radius: 50%;
            width: 245px;
            height: 245px;
            object-fit: cover;
            margin-top: -210px;
        }

        .experience-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .experience-header h2 {
            font-weight: bold;
        }
        .experience-header .btn {
            border: 1px solid #ced4da;
            background-color: #fff;
            color: #000;
        }
        .experience-item {
            display: flex;
            margin-top: 20px;
        }
        .experience-item img {
            width: 50px;
            height: 50px;
            margin-right: 15px;
        }
        .experience-details {
            flex-grow: 1;
        }
        .experience-details h5 {
            font-weight: bold;
        }
        .timeline {
            position: relative;
            padding-left: 20px;
            margin-top: 10px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background-color: #000;
        }
        .timeline-item {
            position: relative;
            padding-left: 20px;
            margin-bottom: 20px;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -24px;
            top: 0px;
            width: 10px;
            height: 10px;
            background-color: #000;
            border-radius: 50%;
        }
        .profile-info {
            text-align: left; /* Mengatur rata kiri */
            width: 94%; /* Lebar penuh */
            margin-top: 50px;
        }
        .about-section, .education-section, .skills-section, .experience-section{
            background-color: #fff;
            border-radius: 10px;
            padding: 30px 40px; /* Espaçamento interno maior */
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .about-section p {
            margin-top:20px;
        }
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .section-header h2 {
            font-weight: bold;
        }
        .section-header .btn {
            border: 1px solid #ced4da;
            background-color: #fff;
            color: #000;
        }
        .profile-info h1 {
            color: #6256CA;
            font-size: 64px;
            font-weight: bold;
            font-family: 'Work Sans', sans-serif;
            margin-bottom: 10px;
        }
        .profile-info h2 {
            color: black;
            font-weight: 300;
            font-size: 32px;
            font-family: 'Work Sans', sans-serif;
        }
        .profile-info p {
            color: gray;
        }
        .linkedin-icon {
            margin-top: 10px;
        }
        .edit-icon {
            position: absolute;
            bottom: 270px;
            right: 20px;
            border-radius:5px;
            border: 1px solid #ced4da;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-edit-profile i {
            font-size: 18px;
        }

        .linkedin-icon a {
            color: #0077B5;
            font-size: 24px; /* Smaller LinkedIn icon */
        }

        .upload-box-custom {
            border: 2px solid #9b59b6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
            cursor: pointer;
            background-color: none;
        }

        .upload-box-custom img {
            width: 40px;
            height: 40px;
            color: #9b59b6;
        }

        .upload-box-custom p {
            margin-top: 10px;
            color: #666;
        }

        .upload-box-custom input[type="file"] {
            display: none;
            background-color: none;
        }

        .upload-box-custom.dragover {
            border-color: #007bff; /* Warna border saat dragover */
            background-color: #f0f8ff; /* Warna latar belakang saat dragover */
        }
        .edit-btn {
            margin-top: 10px;
            color: #007bff; /* Warna tombol edit */
            text-decoration: none; /* Menghilangkan garis bawah */
            cursor: pointer; /* Menunjukkan bahwa ini dapat diklik */
        }

        .upload-card {
            border: 2px solid #9b59b6;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }
        #submit-btn {
            display: none; /* Sembunyikan tombol submit secara default */
        }
    </style>
@section('content')
<div class="container">
    <!-- Profile Header Section -->
    <div class="profile-header">
        <div class="profile-header-top"></div>
        <div class="profile-header-bottom">
            <img src="{{ $user->img ? asset('images/' . $user->img) : asset('images/default_user.webp') }}" alt="Profile picture of Agraditya Putra" />
            <div class="profile-info">
                <h1>{{ $people->name }}</h1>
                <h2>{{ $people->primary_job_title ?? 'Your Title Here' }}</h2>
                <p>{{ $people->location ?? 'Your Location Here' }}</p>

                <!-- LinkedIn Icon -->
                <div class="linkedin-icon">
                    <a href="{{ $people->linkedin_link }}" target="_blank" aria-label="LinkedIn Profile">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>

            <!-- Tombol Edit -->
            <div class="edit-icon">
                <button class="btn btn-edit-profile" data-bs-toggle="modal" data-bs-target="#editProfileModal" aria-label="Edit Profile">
                    <i class="fas fa-edit"></i> Edit Profile
                </button>
            </div>
        </div>
    </div>
<!-- Modal Pop-up untuk Mengedit Profil -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1305px; height: 823px;">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('people.updateProfile') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $people->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="primary_job_title" class="form-label">Job Title</label>
                        <input type="text" name="primary_job_title" class="form-control" value="{{ $people->primary_job_title }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" value="{{ $people->location }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="linkedin_link" class="form-label">LinkedIn Link</label>
                        <input type="url" name="linkedin_link" class="form-control" value="{{ $people->linkedin_link }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn" style="background-color: #6256CA; color: white;">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Alert for Successful Update -->
    @if (session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="about-section">
        <div class="section-header">
            <h2>About</h2>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#editDescriptionModal">
                <i class="fas fa-plus"></i>
                <i class="fas fa-edit"></i> Edit
            </button>
        </div>
        <p id="description-text">{{ $people->description ?? 'No description available.' }}</p>
    </div>

    <!-- Modal Pop-up untuk Mengedit Deskripsi -->
    <div class="modal fade" id="editDescriptionModal" tabindex="-1" aria-labelledby="editDescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editDescriptionModalLabel">Edit Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('people.updateDescription') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <textarea name="description" class="form-control" rows="4">{{ $people->description }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #6256CA; color: white;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="experience-section">
        <div class="section-header">
            <h2>Experience</h2>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#addExperienceModal">
                <i class="fas fa-plus"></i>
                <i class="fas fa-edit"></i> Edit
            </button>
        </div>

        <!-- Mengelompokkan pengalaman berdasarkan company_id -->
        @foreach($people->experiences->groupBy('company_id') as $companyId => $experiences)
            @php $company = $experiences->first()->company; @endphp
            <div class="experience-item">
                <img src="https://storage.googleapis.com/a1aa/image/84lGNggfUYxSKKeiju2mI1OddjadfAGNi8XKmyNESNZlre1OB.jpg" alt="Company logo" width="50" height="50"/>
                <div class="experience-details">
                    <h5>{{ $company->nama }}</h5>

                    <!-- Timeline untuk setiap pengalaman dalam perusahaan yang sama -->
                    <div class="timeline">
                        @foreach($experiences as $experience)
                            <div class="timeline-item">
                                <h6>{{ $experience->position }}</h6>
                                <p>{{ $experience->type_of_work }}</p>
                                <p>{{ $experience->start_date }} - {{ $experience->end_date ?? 'Present' }}</p>
                                <p>{{ $experience->description }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Modal Pop-up untuk Menambahkan Experience -->
    <div class="modal fade" id="addExperienceModal" tabindex="-1" aria-labelledby="addExperienceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExperienceModalLabel">Add Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('people.addExperience') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="company_id" class="form-label">Company</label>
                            <select name="company_id" class="form-control" required>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="text" name="position" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="type_of_work" class="form-label">Type of Work</label>
                            <input type="text" name="type_of_work" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #6256CA; color: white;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="education-section">
        <div class="section-header">
            <h2>Education</h2>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                <i class="fas fa-plus"></i>
                <i class="fas fa-edit"></i> Edit
            </button>
        </div>
        <ul>
            <!-- Tampilkan data pendidikan -->
            @foreach($people->education as $education)
                <li class="education-item d-flex align-items-start mt-3" style="gap: 15px;">
                    <i class="fas fa-graduation-cap text-primary" style="font-size: 40px; margin-top: 8px;"></i>
                    <div style="margin-left: 10px;"> <!-- Jarak antara ikon dan teks -->
                        <h5 class="mb-1">{{ $education->university }}</h5>
                        <p class="mb-0 text-muted">{{ $education->title }} in {{ $education->field_of_study }}</p>
                        <p class="mb-0 text-muted">{{ $education->start_date }} - {{ $education->end_date ?? 'Present' }}</p>
                        <p class="mb-0">{{ $education->description }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>




    <!-- Modal Pop-up untuk Menambahkan Education -->
    <div class="modal fade" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEducationModalLabel">Add Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('people.addEducation') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="university" class="form-label">University</label>
                            <input type="text" name="university" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Degree Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="field_of_study" class="form-label">Field of Study</label>
                            <input type="text" name="field_of_study" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" name="location" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="grade" class="form-label">Grade</label>
                            <input type="text" name="grade" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="activities" class="form-label">Activities</label>
                            <textarea name="activities" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #6256CA; color: white;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="skills-section" style="margin-bottom:50px;">
        <div class="section-header">
            <h2>Skills</h2>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#addSkillsModal">
                <i class="fas fa-plus"></i>
                <i class="fas fa-edit"></i> Edit
            </button>
        </div>

        <!-- Menampilkan Skills sebagai Daftar dengan Garis Pemisah -->
        <div class="skills-list mt-3">
            @foreach(explode(',', $people->skills ?? '') as $index => $skill)
                <div class="skill-item">
                    <p>&#8226; {{ $skill }}</p>
                    @if(!$loop->last)
                        <hr> <!-- Garis pemisah antara setiap skill -->
                    @endif
                </div>
            @endforeach
        </div>
    </div>


    <!-- Modal Pop-up untuk Menambahkan Skills -->
    <div class="modal fade" id="addSkillsModal" tabindex="-1" aria-labelledby="addSkillsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSkillsModalLabel">Add Skills</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('people.addSkills') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div id="skillsContainer">
                            <div class="mb-3">
                                <label for="skills[]" class="form-label">Skill</label>
                                <input type="text" name="skills[]" class="form-control" required>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="addSkillField()">Add Skill</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn" style="background-color: #6256CA; color: white;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <form id="upload-form" action="{{ route('upload.document') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="upload-card">
                    <div class="upload-box-custom" id="cv-dropzone">
                        <img src="{{ asset('images/upload.svg') }}" alt="Upload icon">
                        <p>Upload your CV in PDF format.</p>
                        <input type="file" id="cv-upload" name="cv" accept=".pdf" style="display:none;">
                    </div>
                    <div id="cv-preview">
                        @if(isset($people->cv_path))
                            <embed src="{{ asset($people->cv_path) }}" width="100%" height="500px" />
                            <p>File name: {{ basename($people->cv_path) }}</p>
                        @endif
                    </div>
                    <button class="btn btn-link edit-btn" type="button" onclick="toggleUpload('cv')">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
            </div>

            <div class="col-md-6">
                <div class="upload-card">
                    <div class="upload-box-custom" id="portfolio-dropzone">
                        <img src="{{ asset('images/upload.svg') }}" alt="Upload icon">
                        <p>Upload your Portfolio in PDF format.</p>
                        <input type="file" id="portfolio-upload" name="portfolio" accept=".pdf" style="display:none;">
                    </div>
                    <div id="portfolio-preview">
                        @if(isset($people->portfolio_path))
                            <embed src="{{ asset($people->portfolio_path) }}" width="100%" height="500px" />
                            <p>File name: {{ basename($people->portfolio_path) }}</p>
                        @endif
                    </div>
                    <button class="btn btn-link edit-btn" type="button" onclick="toggleUpload('portfolio')">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </div>
            </div>
        </div>
        <button id="submit-btn" type="submit" class="btn btn-primary mt-3" style="display:none; width: 100%;">Submit</button>
    </form>
@endsection

@section('js')
<script>
    function addSkillField() {
        const container = document.getElementById('skillsContainer');
        const newSkillDiv = document.createElement('div');
        newSkillDiv.classList.add('mb-3');

        newSkillDiv.innerHTML = `
            <label for="skills[]" class="form-label">Skill</label>
            <input type="text" name="skills[]" class="form-control" required>
        `;

        container.appendChild(newSkillDiv);
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function handleFileUpload(input, previewContainer) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var pdfPreview = document.createElement('embed');
                    pdfPreview.src = e.target.result;
                    pdfPreview.width = '100%';
                    pdfPreview.height = '500px';
                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(pdfPreview);
                    previewContainer.innerHTML += `<p>File name: ${file.name}</p>`;
                };
                reader.readAsDataURL(file);
            }
        }

        function setupFileInput(dropzoneId, inputId, previewContainerId) {
            var dropzone = document.getElementById(dropzoneId);
            var input = document.getElementById(inputId);
            var previewContainer = document.getElementById(previewContainerId);

            // Fungsi untuk menangani klik pada dropzone
            dropzone.addEventListener('click', function() {
                input.click();
            });

            // Event listener untuk input file
            input.addEventListener('change', function() {
                handleFileUpload(input, previewContainer);
                document.getElementById('submit-btn').style.display = 'block'; // Tampilkan tombol submit setelah file dipilih
            });

            // Event listener untuk drag-and-drop
            dropzone.addEventListener('dragover', function(e) {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });

            dropzone.addEventListener('dragleave', function() {
                dropzone.classList.remove('dragover');
            });

            dropzone.addEventListener('drop', function(e) {
                e.preventDefault();
                dropzone.classList.remove('dragover');
                var files = e.dataTransfer.files;
                if (files.length > 0) {
                    input.files = files;
                    handleFileUpload(input, previewContainer);
                    document.getElementById('submit-btn').style.display = 'block'; // Tampilkan tombol submit setelah file dipilih
                }
            });
        }

        // Setup untuk setiap dropzone
        setupFileInput('cv-dropzone', 'cv-upload', 'cv-preview');
        setupFileInput('portfolio-dropzone', 'portfolio-upload', 'portfolio-preview');
    });

    function toggleUpload(type) {
        const uploadBox = document.getElementById(type === 'cv' ? 'cv-dropzone' : 'portfolio-dropzone');
        const inputFile = document.getElementById(type === 'cv' ? 'cv-upload' : 'portfolio-upload');

        // Jika upload box terlihat, sembunyikan
        if (uploadBox.style.display === "none" || uploadBox.style.display === "") {
            uploadBox.style.display = "block"; // Tampilkan upload box
            inputFile.click(); // Buka dialog file
        } else {
            uploadBox.style.display = "none"; // Sembunyikan upload box
        }
    }

    // Menyembunyikan upload box saat awal
    document.getElementById('cv-dropzone').style.display = "none";
    document.getElementById('portfolio-dropzone').style.display = "none";
</script>
@endsection
