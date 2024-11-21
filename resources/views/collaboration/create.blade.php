<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collaboration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: Arial, sans-serif;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            text-align: center;
        }
        .form-title {
            font-size: 36px;
            font-weight: bold;
            color: #6c4ecb;
            margin-bottom: 30px;
        }
        .form-label {
            text-align: left;
            font-weight: bold;
            margin-top: 20px;
        }
        .form-control {
            border: 2px solid #6c4ecb;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }
        .upload-area {
            border: 2px dashed #6c4ecb;
            border-radius: 5px;
            background-color: #f5f3ff;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
            color: #6c4ecb;
        }
        .upload-button {
            background-color: #4a4a4a;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .submit-button {
            background-color: #6c4ecb;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form-title">Collaboration Form</div>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('collaboration.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="collaboration_id" class="form-label">Collaboration</label>
                <select name="collaboration_id" id="collaboration_id" class="form-control">
                    @foreach($collaborations as $collaboration)
                        <option value="{{ $collaboration->id }}">{{ $collaboration->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <input type="text" class="form-control" id="position" name="position" value="{{ old('position') }}" placeholder="Enter your position">
            </div>
            <div class="mb-3">
                <label for="resume" class="form-label">Upload Resume</label>
                <div class="upload-area">
                    <input type="file" name="resume" id="resume" class="form-control" />
                </div>
            </div>
            <button type="submit" class="submit-button">Send</button>
        </form>
    </div>
</body>
</html>