@extends('layouts.app-people')

@section('title', 'Profile Page')

@section('css')
    <!-- External styles and custom fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;700&display=swap">
    <style>
        /* Custom styling for the Profile page */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .profile-header {
            margin-top: 70px;
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
            margin-right:800px;
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
            margin-right: 700px;
            margin-top: 50px;
        }
        .about-section, .education-section, .skills-section, .experience-section{
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
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
            position: absolute;
            bottom: 100px;
            right: 60px;
        }
        .linkedin-icon a {
            color: #0077B5;
            font-size: 50px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <!-- Profile Header Section -->
    <div class="profile-header">
        <div class="profile-header-top"></div>
        <div class="profile-header-bottom">
            <img src="https://storage.googleapis.com/a1aa/image/TxW2evqYS0S6diF7YRBzLKxmUrnnoWjf1WpI2fQvZsdazVYnA.jpg" alt="Profile picture of Agraditya Putra" />
            <div class="profile-info">
                <h1>{{ $people->name }}</h1>
                <h2>{{ $people->primary_job_title ?? 'Your Title Here' }}</h2>
                <p>{{ $people->location ?? 'Your Location Here' }}</p>
            </div>
            <div class="linkedin-icon">
                <a href="{{ $people->linkedin_link }}" target="_blank" aria-label="LinkedIn Profile">
                    <i class="fab fa-linkedin"></i>
                </a>
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
                <i class="fas fa-plus"></i> Add Education
            </button>
        </div>
        <ul>
            <!-- Tampilkan data pendidikan -->
            @foreach($people->education as $education)
                <li class="education-item d-flex align-items-start mt-3">
                    <i class="fas fa-graduation-cap fa-lg me-3 text-primary"></i>
                    <div>
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


    <div class="skills-section">
        <div class="section-header">
            <h2>Skills</h2>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#addSkillsModal">
                <i class="fas fa-plus"></i> Add Skills
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
@endsection

