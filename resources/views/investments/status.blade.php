@extends('layouts.app-investments')

@section('content')
<!-- Embedded CSS -->
<style>
    .status-bar-container {
        margin-top: 30px;
    }

    .status-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        width: 100%;
        height: 20px;
        border-radius: 10px;
        overflow: hidden;
    }

    /* The background will change dynamically based on the status */
    .status-bar.submitted {
        background: linear-gradient(to right, #7b61ff 0%, #7b61ff 33.33%, #e0e0e0 33.33%, #e0e0e0 100%);
    }

    .status-bar.processed {
        background: linear-gradient(to right, #7b61ff 0%, #7b61ff 50%, #e0e0e0 50%, #e0e0e0 100%);
    }

    .status-bar.approved {
        background: linear-gradient(to right, #7b61ff 0%, #7b61ff 100%);
    }

    .status-bar .bar-section {
        width: 33.33%;
        height: 100%;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .status-bar .bar-section::before {
        content: '';
        width: 20px;
        height: 20px;
        background-color: #a5d6a7; /* Light green for inactive circles */
        border-radius: 50%;
        position: absolute;
        top: -1px;
        left: calc(50% - 10px);
        z-index: 1;
    }

    .status-bar .bar-section.active::before {
        background-color: #4caf50; /* Active green for circles */
    }

    .status-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .status-labels div {
        width: 33.33%;
        font-weight: bold;
    }

    .status-text {
        color: #7b61ff;
        font-weight: bold;
        margin-top: 20px;
    }

    .status-description {
        color: #666;
        margin-top: 10px;
    }

    .illustration {
        margin-top: 30px;
    }
</style>

<div class="container text-center">
    <h2 class="status-text">Investment Status</h2>

    <!-- Status Bar -->
    <div class="status-bar-container">
        <div class="status-bar
            @if ($investment->status === 'submitted') submitted
            @elseif ($investment->status === 'pending') processed
            @elseif ($investment->status === 'approved') approved
            @endif">
            <div class="bar-section {{ $investment->status === 'submitted' || $investment->status === 'pending' || $investment->status === 'approved' ? 'active' : '' }}"></div>
            <div class="bar-section {{ $investment->status === 'pending' || $investment->status === 'approved' ? 'active' : '' }}"></div>
            <div class="bar-section {{ $investment->status === 'approved' ? 'active' : '' }}"></div>
        </div>

        <!-- Status Labels -->
        <div class="status-labels">
            <div>Submitted</div>
            <div>Processed</div>
            <div>Approved</div>
        </div>
    </div>

    <!-- Illustration -->
    <div class="illustration">
        <img src="{{ asset('images/status/pic.png') }}" alt="Illustration of two people discussing a document in an office setting" width="400" height="300">
    </div>

    <!-- Status Text -->
    <h3 class="status-text">
        @if ($investment->status === 'pending')
            Processed
        @elseif ($investment->status === 'approved')
            Approved
        @else
            Submitted
        @endif
    </h3>

    <!-- Status Description -->
    <p class="status-description">
        @if ($investment->status === 'pending')
            The investment is currently being handled by the processing team. This means that all necessary checks and evaluations are being conducted to ensure the investment meets the required criteria.
        @elseif ($investment->status === 'approved')
            Your investment has been approved. Congratulations! Your funds will be utilized accordingly and you will receive periodic updates on the progress.
        @else
            Your investment has been submitted and is awaiting processing. Once it's processed, you will receive an update on the status.
        @endif
    </p>
</div>
@endsection
