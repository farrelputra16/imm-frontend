@extends('layouts.app-imm')

@section('title', 'Register New Collaboration')

@section('content')
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
            <div class="positions-container">
                <label for="positions" class="form-label">Positions</label>
                <div id="positions-wrapper">
                    @php
                        // Pisahkan string menjadi array
                        $positions = explode(',', $collaboration->position);
                    @endphp

                    @foreach ($positions as $position)
                        <div class="position-field">
                            <div class="input-group mb-2">
                                <input type="text" name="position[]" class="form-control" value="{{ trim($position) }}" placeholder="Position Name" required>
                                <button type="button" class="btn btn-danger remove-position">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-position" class="btn btn-primary" style="margin-bottom: 10px;">+ Add Position</button>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        document.getElementById('add-position').addEventListener('click', function() {
            let positionsWrapper = document.getElementById('positions-wrapper');
            let newPositionField = document.createElement('div');
            newPositionField.classList.add('position-field');
            newPositionField.innerHTML = `
                <div class="input-group mb-2">
                    <input type="text" name="position[]" class="form-control" placeholder="Position Name" required>
                    <button type="button" class="btn btn-danger remove-position">Remove</button>
                </div>
            `;
            positionsWrapper.appendChild(newPositionField);

            // Tambahkan event listener untuk tombol remove
            newPositionField.querySelector('.remove-position').addEventListener('click', function() {
                positionsWrapper.removeChild(newPositionField);
            });
        });

        // Tambahkan event listener untuk tombol remove pada posisi yang sudah ada
        document.querySelectorAll('.remove-position').forEach(function(button) {
            button.addEventListener('click', function() {
                let positionField = button.closest('.position-field');
                positionField.parentNode.removeChild(positionField);
            });
        });
    </script>
@endsection
