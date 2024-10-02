<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
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
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .alert {
            padding: 10px;
            color: white;
            background-color: green;
            margin-bottom: 15px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Your Profile</h1>

    @if (session('success'))
    <div class="alert">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('people.updateProfile') }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Menampilkan detail data people -->
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" value="{{ $people->name }}" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="Mentor" @if($people->role === 'Mentor') selected @endif>Mentor</option>
                <option value="Pekerja" @if($people->role === 'Pekerja') selected @endif>Pekerja</option>
                <option value="Konsultan" @if($people->role === 'Konsultan') selected @endif>Konsultan</option>
            </select>

            <label for="primary_job_title">Primary Job Title (Optional):</label>
            <input type="text" id="primary_job_title" name="primary_job_title" value="{{ $people->primary_job_title }}">

            <label for="primary_organization">Primary Organization (Optional):</label>
            <select id="primary_organization" name="primary_organization">
                <option value="">-- Select a Company --</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" @if($people->primary_organization == $company->id) selected @endif>{{ $company->nama}}</option>
                @endforeach
            </select>

            <label for="location">Location (Optional):</label>
            <input type="text" id="location" name="location" value="{{ $people->location }}">

            <label for="regions">Regions (Optional):</label>
            <input type="text" id="regions" name="regions" value="{{ $people->regions }}">

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="Laki-laki" @if($people->gender === 'Laki-laki') selected @endif>Laki-laki</option>
                <option value="Perempuan" @if($people->gender === 'Perempuan') selected @endif>Perempuan</option>
            </select>

            <label for="linkedin_link">LinkedIn Link (Optional):</label>
            <input type="url" id="linkedin_link" name="linkedin_link" value="{{ $people->linkedin_link }}">

            <label for="description">Description (Optional):</label>
            <textarea id="description" name="description" rows="3">{{ $people->description }}</textarea>

            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ $people->phone_number }}" required>

            <label for="gmail">Gmail:</label>
            <input type="email" id="gmail" name="gmail" value="{{ $people->gmail }}" required>
        </div>

        <button type="submit">Update Profile</button>
    </form>
</div>

</body>
</html>
