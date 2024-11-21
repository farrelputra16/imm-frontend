<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Collaboration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 600px; margin-top: 50px; }
        h1 { color: #6c63ff; font-weight: bold; }
        .btn-primary { background-color: #6c63ff; border-color: #6c63ff; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Collaboration</h1>
        <form action="{{ route('collaboration.update', $collaboration->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $collaboration->title) }}" placeholder="Input title of the collaboration opportunity">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image">
                @if ($collaboration->image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($collaboration->image) }}" width="100" height="auto" alt="Current Image">
                    </div>
                @endif
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" rows="4" placeholder="Input the description of your project">{{ old('description', $collaboration->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="positions" class="form-label">Positions</label>
                <textarea name="positions[]" class="form-control" id="positions" rows="4" placeholder="Input positions available (one per line)">{{ old('positions', implode("\n", $collaboration->positions)) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>