@extends('layouts.app-landingpage')

@section('title', 'Ajukan Innovation Hub Baru')

    @section('css')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #4A4A4A;
            font-size: 24px;
        }
        .header h2 {
            color: #6256CA;
            font-size: 36px;
            margin: 0;
        }
        .header p {
            color: #6256CA;
            font-size: 16px;
            margin: 0;
        }
        .header .info {
            color: #4A4A4A;
            font-size: 14px;
            margin-top: 10px;
        }
        .section {
            border: 1px solid #E0E0E0;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .section h3 {
            color: #4A4A4A;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .section p {
            color: #4A4A4A;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
    @endsection

    @section('content')
    <div class="container">
        <nav aria-label="breadcrumb" style="margin-bottom: 32px;">
            <ol class="breadcrumb">
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('hubs.create.hubsubmission') }}" style="text-decoration: none; color: #212B36;">Hubs</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="#" style="text-decoration: none; color: #212B36;">Detail</a>
                </li>
            </ol>
        </nav>
    <div class="header">
        <h1>Details Hubs</h1>
        <h2>{{ $hub->name }}</h2>
        <p>Where Innovation Meets Impact.</p>
        <div class="info">
            <p>{{ $hub->provinsi }},{{ $hub->kota }}</p>
        </div>
    </div>

    <div class="section">
        <h3>General Description</h3>
        <p>{{ $hub->description }}</p>
        <h3>Target Participant</h3>
        <p>{{ $hub->target_participant }}</p>
        <h3>Funding Source</h3>
        <p>{{ $hub->funding_sources }}</p>
    </div>

    <div class="section">
        <h3>Place</h3>
        <ul>
            <li>Location Size
                <p>{{ $hub->location_size }}</p>
            </li>
            <li>Operation Hours
                <p>{{ $hub->operating_hours }}</p>
            </li>
            <li>Estimated Users
                <p>{{ $hub->estimated_user }}</p>
            </li>
        </ul>
    </div>

    <div class="section">
        <h3>Services Offered</h3>
        <ul>
            @forelse($facilities as $facility)
                <li>{{ $facility }}
                    @if($facility == 'Coworking Spaces')
                        <ul>
                            <li>Flexible workspaces with modern facilities.</li>
                            <li>Brainstorming areas and meeting rooms designed for collaboration.</li>
                        </ul>
                    @elseif($facility == 'Incubation and Acceleration Programs')
                        <ul>
                            <li>Intensive mentorship for impact-driven startups.</li>
                            <li>Technical support, business development, and investor access.</li>
                        </ul>
                    @elseif($facility == 'Networking and Collaboration')
                        <ul>
                            <li>Access to the global Impact Hub network.</li>
                            <li>Regular events like workshops, panel discussions, and hackathons.</li>
                        </ul>
                    @elseif($facility == 'Training and Capacity Building')
                        <ul>
                            <li>Training in technology, project management, and social entrepreneurship.</li>
                            <li>Sustainability-focused training programs for organizations and individuals.</li>
                        </ul>
                    @elseif($facility == 'Funding Access')
                        <ul>
                            <li>Partnerships with donors and investors.</li>
                            <li>Pitch competitions for innovative projects.</li>
                        </ul>
                    @endif
                </li>
            @empty
                <li>No facilities listed</li>
            @endforelse
        </ul>
    </div>

    <div class="section">
        <h3>Achievements</h3>
        <ul>
            @forelse($programs as $program)
                <li>{{ $program }}</li>
            @empty
                <li>No achievements or programs listed</li>
            @endforelse
        </ul>
    </div>

    <div class="section">
        <h3>Future Plans</h3>
        <ul>
            @forelse($alumni as $alumnus)
                <li>{{ $alumnus }}</li>
            @empty
                <li>No future plans or alumni listed</li>
            @endforelse
        </ul>
    </div>
@endsection
