@extends('layouts.app-imm')

@section('content')
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
<style>

</style>

<div class="container">
    <!-- Breadcrumb Navigation -->
    <nav aria-label="breadcrumb" class="mb-5">
        <ol class="breadcrumb">
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="{{ url()->previous() }}" style="text-decoration: none; color: #212B36;">Funding Rounds</a>
            </li>
            <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                <a href="#" style="text-decoration: none; color: #212B36;">Create New Funding</a>
            </li>
        </ol>
    </nav>

    <!-- Page Title -->
    <h2>Edit Funding Round: {{ $fundingRound->name }}</h2>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form for Editing Funding Round -->
    <form action="{{ route('company.funding_rounds.update', $fundingRound->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label" style="font-weight: bold;">Funding Round Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $fundingRound->name }}" required style="border: 1px solid #6256CA;">
        </div>

        <div class="mb-3">
            <label for="target" class="form-label" style="font-weight: bold;">Target Amount</label>
            <input type="number" class="form-control" id="target" name="target" value="{{ $fundingRound->target }}" style="border: 1px solid #6256CA;">
        </div>

        <div class="mb-3">
            <label for="announced_date" class="form-label" style="font-weight: bold;">Announced Date</label>
            <input type="date" class="form-control" id="announced_date" name="announced_date" value="{{ $fundingRound->announced_date }}" style="border: 1px solid #6256CA;">
        </div>

        <!-- Lead Investor Dropdown -->
        <div class="mb-3">
            <label for="lead_investor_id" class="form-label" style="font-weight: bold;">Select Lead Investor</label>
            <select class="form-control" id="lead_investor_id" name="lead_investor_id" style="border: 1px solid #6256CA;">
                <option value="">Select Lead Investor</option>
                @foreach($investors as $investor)
                    <option value="{{ $investor->id }}" {{ $fundingRound->lead_investor_id == $investor->id ? 'selected' : '' }}>
                        {{ $investor->org_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-4" style="margin-bottom: 70px;">
            <button type="submit" class="btn btn-primary" style="background-color: #6256CA; border-color: #6256CA;">Save Changes</button>
            <a href="{{ route('company.funding_rounds.list') }}" class="btn btn-secondary">Back to Funding Rounds</a>
        </div>
    </form>
</div>

@endsection
