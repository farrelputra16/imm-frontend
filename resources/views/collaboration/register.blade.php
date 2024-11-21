@extends('layouts.app-imm')

@section('title', 'Register New Collaboration')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
    <style>
        body { font-family: Arial, sans-serif; }
        .header { font-size: 2.5rem; font-weight: bold; color: #6256CA; margin: 20px 0; }
        .breadcrumb {
            background-color: white;
            padding: 0;
        }
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            margin-right: 14px;
            color: #9CA3AF;
        }
        .btn-primary {
            background-color: #6256CA;
            border-color: #6256CA;
        }
        .form-label {
            font-weight: bold;
        }
        .positions-container {
            margin-bottom: 15px;
        }
        .position-field {
            margin-bottom: 10px;
        }
    </style>

    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('collaboration.index') }}" style="text-decoration: none; color: #212B36;">Collaboration</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    Register
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="header">Register New Collaboration</div>

        <!-- Form -->
        <form action="{{ route('collaboration.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Input title of the collaboration opportunity">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description" rows="4" placeholder="Input the description of your project"></textarea>
            </div>

            <!-- Positions (Dynamic Fields) -->
            <div class="positions-container">
                <label for="positions" class="form-label">Positions</label>
                <div id="positions-wrapper">
                    <div class="position-field">
                        <input type="text" name="positions[]" class="form-control" placeholder="Position Name">
                    </div>
                </div>
                <button type="button" id="add-position" class="btn btn-primary">+ Add Position</button>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById('add-position').addEventListener('click', function() {
            let positionsWrapper = document.getElementById('positions-wrapper');
            let newPositionField = document.createElement('div');
            newPositionField.classList.add('position-field');
            newPositionField.innerHTML = '<input type="text" name="positions[]" class="form-control" placeholder="Position Name">';
            positionsWrapper.appendChild(newPositionField);
        });
    </script>
@endsection