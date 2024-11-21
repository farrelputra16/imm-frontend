@extends('layouts.app-landingpage')

@section('title', 'Ajukan Innovation Hub Baru')

@section('css')
    <!-- Tambahkan CSS tambahan jika diperlukan -->
    <style>
    .btn-create-project {
        background-color: #5940CB;
        color: white;
        width: 200px;
        height: 40px;
        border: none;
        border-radius: 5px;
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
                <a href="#" style="text-decoration: none; color: #212B36;">Hubs</a>
            </li>
        </ol>
    </nav>
    <div class="row" style="justify-content: space-between; margin: 0px;">
        <h2>Pengajuan Innovation Hub</h2>
        {{-- Tombol Membuat Innovation Hub --}}
        <div class="col-md-4 text-right">
            <a href="{{ route('hubs.create') }}">
                <button class="btn-primary btn-create-project">Create New Hubs</button>
            </a>
        </div>
    </div>
    <!-- Menampilkan pesan sukses -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($hubs->isEmpty())
        <p>Anda belum mengajukan innovation hub.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Hub</th>
                    <th>Provinsi</th>
                    <th>Kota</th>
                    <th>Status</th>
                    <th>Diajukan pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hubs as $hub)
                    <tr>
                        <td>{{ $hub->name }}</td>
                        <td>{{ $hub->provinsi }}</td>
                        <td>{{ $hub->kota }}</td>
                        <td>
                            @if ($hub->status == 'pending')
                                <span class="badge-pending">Pending</span>
                            @elseif ($hub->status == 'approved')
                                <span class="badge-approved">Disetujui</span>
                            @elseif ($hub->status == 'rejected')
                                <span class="badge-rejected">Ditolak</span>
                            @endif
                        </td>
                        <td>{{ $hub->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('hubs.hubsubmission.detail', $hub->id) }}" class="btn btn-sm btn-info">Lihat Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Menambahkan jQuery dan JS Bootstrap (jika diperlukan) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@endsection
