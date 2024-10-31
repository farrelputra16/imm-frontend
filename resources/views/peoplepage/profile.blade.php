<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .profile-header {
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
        }

        .profile-header img {
            border: 3px solid white;
            margin-right: 850px;
            border-radius: 50%;
            width: 245px;
            height: 245px;
            object-fit: cover;
            margin-top: -220px;
        }

        .profile-info {
            margin-top: 50px;
            margin-right: 800px;
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

        .profile-section {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin: 20px 0;
            padding: 20px;
            position: relative;
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

        input:disabled, select:disabled, textarea:disabled {
            background-color: #e9ecef;
            color: #6c757d;
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

        .save-btn:hover {
            background-color: #218838;
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
    <script>
        function toggleEdit(sectionId) {
            const section = document.getElementById(sectionId);
            const formFields = section.querySelectorAll("input, select, textarea");
            const saveButton = section.querySelector(".save-btn");

            formFields.forEach(field => {
                field.disabled = !field.disabled;
            });

            saveButton.style.display = saveButton.style.display === "none" ? "inline-block" : "none";
        }
    </script>
</head>
<body>

<div class="container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-header-top"></div>
        <div class="profile-header-bottom">
            <img src="https://storage.googleapis.com/a1aa/image/TxW2evqYS0S6diF7YRBzLKxmUrnnoWjf1WpI2fQvZsdazVYnA.jpg" alt="Profile picture of Agraditya Putra" />
            <div class="profile-info">
                <h1>{{ $people->name }}</h1>
                <h2>{{ $people->primary_job_title ?? 'Your Title Here' }}</h2>
                <p>{{ $people->location ?? 'Your Location Here' }}</p>
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

        <!-- Personal Information Section -->
        <div class="profile-section" id="personal-info-section">
            <h3>Personal Information</h3>
            <button type="button" class="edit-btn" onclick="toggleEdit('personal-info-section')">
                <i class="fas fa-pencil-alt"></i> Edit
            </button>
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" value="{{ $people->name }}" required disabled>

                <label for="role">Role:</label>
                <select id="role" name="role" required disabled>
                    <option value="Mentor" @if($people->role === 'Mentor') selected @endif>Mentor</option>
                    <option value="Pekerja" @if($people->role === 'Pekerja') selected @endif>Pekerja</option>
                    <option value="Konsultan" @if($people->role === 'Konsultan') selected @endif>Konsultan</option>
                </select>

                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required disabled>
                    <option value="Laki-laki" @if($people->gender === 'Laki-laki') selected @endif>Laki-laki</option>
                    <option value="Perempuan" @if($people->gender === 'Perempuan') selected @endif>Perempuan</option>
                </select>

                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ $people->phone_number }}" required disabled>

                <label for="gmail">Gmail:</label>
                <input type="email" id="gmail" name="gmail" value="{{ $people->gmail }}" required disabled>
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

        <!-- Social & Additional Information Section -->
        <div class="profile-section" id="additional-info-section">
            <h3>Additional Information</h3>
            <button type="button" class="edit-btn" onclick="toggleEdit('additional-info-section')">
                <i class="fas fa-pencil-alt"></i> Edit
            </button>
            <div class="form-group">
                <label for="linkedin_link">LinkedIn Link (Optional):</label>
                <input type="url" id="linkedin_link" name="linkedin_link" value="{{ $people->linkedin_link }}" disabled>

                <label for="description">Description (Optional):</label>
                <textarea id="description" name="description" rows="3" disabled>{{ $people->description }}</textarea>
            </div>
            <button type="submit" class="save-btn">Save</button>
        </div>
    </form>
</div>

</body>
</html>
