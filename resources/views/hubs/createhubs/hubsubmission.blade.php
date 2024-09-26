<!-- resources/views/hubs/createhubs/my_submissions.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Pengajuan Innovation Hub Saya</title>
    <!-- Menambahkan CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container mt-5">
    <h1>Pengajuan Innovation Hub Saya</h1>

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
                                <span class="badge badge-warning">Pending</span>
                            @elseif ($hub->status == 'approved')
                                <span class="badge badge-success">Disetujui</span>
                            @elseif ($hub->status == 'rejected')
                                <span class="badge badge-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>{{ $hub->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <a href="{{ route('hubs.show', $hub->id) }}" class="btn btn-sm btn-info">Lihat</a>
                            <!-- Tambahkan aksi lain jika diperlukan -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Menambahkan jQuery dan JS Bootstrap (jika diperlukan) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</body>
</html>
