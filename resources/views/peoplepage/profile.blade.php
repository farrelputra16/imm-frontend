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
        .profile-info {
            margin-right: 700px;
            margin-top: 50px;
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
        .profile-section {
            background-color: white;
            border-radius: 8px;
            margin: 20px 0;
            padding: 20px;
        }
        .profile-section h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            display: inline-block;
        }
        .edit-btn {
            color: #007bff;
            font-size: 1rem;
            cursor: pointer;
            float: right;
            background: none;
            border: none;
        }
        .save-btn {
            display: none;
            margin-top: 15px;
            background-color: #28a745;
            border: none;
            padding: 8px 16px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .alert {
            padding: 10px;
            color: white;
            background-color: green;
            margin-bottom: 15px;
            border-radius: 4px;
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

    <!-- Profile Update Form -->
    <form action="{{ route('people.updateProfile') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- About Section -->
        <div class="profile-section" id="additional-info-section">
            <h3>About</h3>
            <button type="button" class="edit-btn" onclick="toggleEdit('additional-info-section')">
                <i class="fas fa-pencil-alt"></i> Edit
            </button>
            <div class="form-group">
                <label for="description">Description (Optional):</label>
                <textarea id="description" name="description" rows="3" disabled>{{ $people->description }}</textarea>
            </div>
            <button type="submit" class="save-btn">Save</button>
        </div>

        <!-- Job Information Section -->
        <div class="profile-section" id="job-info-section">
            <h3>Job Information</h3>
            <button type="button" class="edit-btn" onclick="toggleEdit('job-info-section')">
                <i class="fas fa-pencil-alt"></i> Edit
            </button>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role" required disabled>
                    <option value="Mentor" @if($people->role === 'Mentor') selected @endif>Mentor</option>
                    <option value="Pekerja" @if($people->role === 'Pekerja') selected @endif>Pekerja</option>
                    <option value="Konsultan" @if($people->role === 'Konsultan') selected @endif>Konsultan</option>
                </select>
                <label for="primary_job_title">Primary Job Title (Optional):</label>
                <input type="text" id="primary_job_title" name="primary_job_title" value="{{ $people->primary_job_title }}" disabled>

                <label for="primary_organization">Primary Organization (Optional):</label>
                <select id="primary_organization" name="primary_organization" disabled>
                    <option value="">-- Select a Company --</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}" @if($people->primary_organization == $company->id) selected @endif>{{ $company->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="save-btn">Save</button>
        </div>

        <!-- Location Information Section -->
        <div class="profile-section" id="location-info-section">
            <h3>Location</h3>
            <button type="button" class="edit-btn" onclick="toggleEdit('location-info-section')">
                <i class="fas fa-pencil-alt"></i> Edit
            </button>
            <div class="form-group">
                <label for="location">Location (Optional):</label>
                <input type="text" id="location" name="location" value="{{ $people->location }}" disabled>

                <label for="regions">Regions (Optional):</label>
                <input type="text" id="regions" name="regions" value="{{ $people->regions }}" disabled>
            </div>
            <button type="submit" class="save-btn">Save</button>
        </div>

        <!-- LinkedIn Section -->
        <div class="profile-section" id="linkedin-info-section">
            <h3>LinkedIn Profile</h3>
            <button type="button" class="edit-btn" onclick="toggleEdit('linkedin-info-section')">
                <i class="fas fa-pencil-alt"></i> Edit
            </button>
            <div class="form-group">
                <label for="linkedin_link">LinkedIn Link:</label>
                <input type="url" id="linkedin_link" name="linkedin_link" value="{{ $people->linkedin_link }}" disabled>
            </div>
            <button type="submit" class="save-btn">Save</button>
        </div>

    </form>
</div>
@endsection

@section('js')
<script>
    function toggleEdit(sectionId) {
        const section = document.getElementById(sectionId);
        const editElements = section.querySelectorAll('input, select, textarea');
        const saveButton = section.querySelector(".save-btn");
        const editButton = section.querySelector(".edit-btn");

        // Toggle disabled state of input fields
        editElements.forEach(editEl => {
            editEl.disabled = !editEl.disabled;
        });

        // Toggle visibility of save and edit buttons
        if (saveButton.style.display === "none") {
            saveButton.style.display = "inline-block";
            editButton.style.display = "none";
        } else {
            saveButton.style.display = "none";
            editButton.style.display = "inline-block";
        }
    }

    // Enable all fields in the form before submitting
    document.querySelectorAll('.save-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default submission to enable fields first

            // Enable all form fields before submitting the form
            document.querySelectorAll('input, select, textarea').forEach(editEl => {
                editEl.disabled = false;
            });

            // Submit the form after enabling fields
            button.closest('form').submit();
        });
    });
</script>


@endsection
