@extends('layouts.app-imm')
@section('title', 'Halaman Perusahaan')

@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">


<style>
* {
    text-decoration: none;
    list-style-type: none;
}

.edit-icon {
    cursor: pointer;
    font-size: 1.2rem;
    color: #007bff;
}

.btn-kelola {
    width: 300px;
    height: 43px;
    background-color: #6256CA;
    color: white;
    font-size: 20px;
    border: none;
    border-radius: 10px;
}

.boxx {
    gap: 40px;
}

.box1, .box2 {
    background-color: white;
    padding: 10px;
    border-radius: 17px;
    text-align: center;
    width: 100%;
    border: 1px solid #d1d1d1;
}

.balance-card,
.outcome-card {
    display: flex;
    flex-direction: column;
    align-items: start;
    margin-top: 20px;
}

.balance-card i,
.outcome-card i {
    font-size: 24px;
}

.balance-card {
    color: #ffa500;
}

.outcome-card {
    color: #ff6347;
}

.price {
    font-size: 20px;
    font-weight: bold;
    color: #6256CA;
}



.notification-section {
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    padding: 10px;
    background-color: #fff;
    display: flex;
    align-items: center;
    position: relative;
    width: 1130px;
    cursor: pointer;
}

.row {
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
}

.col-6 {
    flex: 0 0 50%;
    max-width: 50%;
}

.sdg-container {
    width: 100%;
    padding: 35px;
    background-color: #5940cb0f;
    border-radius: 7px;
}

.grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 10px;
    margin-bottom: 20px;
}

.grid-item {
    transition: opacity 0.3s;
    opacity: 0.5;
    cursor: pointer;
}

.grid-item img {
    width: 100%;
    display: block;
    border-radius: 4px;
}

.grid-item.active {
    opacity: 1;
}

.submit-button {
    padding: 10px 20px;
    font-size: 16px;
    background-color: #6c63ff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.submit-button:hover {
    background-color: #524eff;
}

.map-container {
    position: relative;
    width: 100%;
    height: 600px;
    margin: 20px 0;
}

.map img {
    width: 100%;
    height: 100%;
}

#map {
    height: 100%; /* Pastikan peta mengisi seluruh kontainer */
    width: 100%; /* Pastikan peta mengisi seluruh kontainer */
    z-index: 0; /* Pastikan peta berada di belakang elemen lain */
}

.city-overlay {
    position: absolute;
    width: 20px;
    height: 20px;
    background: rgba(255, 0, 0, 0.5);
    border-radius: 50%;
    cursor: pointer;
    transition: transform 0.3s ease-in-out;
}

.marker {
    position: absolute;
    z-index: 1; /* Pastikan marker berada di atas peta */
}

#outer-wrapper {
    width: 1268px;
    height: 480px;
    overflow: hidden;
    position: relative;
}

#inner-wrapper {
    position: absolute;
    top: -130px;
    height: 800px;
    width: 100%;
}

#regions_div {
    width: 100%;
    height: 100%;
}

.location-info {
    margin-top: 20px;
    font-size: 1.2em;
    font-weight: bold;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin: 0px;
}

.dashboard-title {
    font-weight: bold;
}

.scope {
    text-align: left;
}

.scope h5 {
    font-size: 1rem;
    color: #6a1b9a;
}

.scope h6 {
    font-size: 1.2rem;
    color: #1e88e5;
    font-weight: bold;
}

.info-box {
    position: absolute;
    background: white;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 200px;
    z-index: 1; /* Pastikan info box berada di atas peta */
}

.info-box i {
    font-size: 1.5rem;
    margin-left: 10px;
}

.info-box.expenditure {
    top: 20px;
    left: 20px;
}

.info-box.funds {
    top: 100px;
    left: 20px;
}

.goals-container {
    position: absolute;
    top: 20px;
    right: 5px;
    width: 350px;
    max-height: 550px;
    overflow-y: scroll;
    background: transparent;
    padding: 0px;
    padding-left: 35px;
    z-index: 1; /* Pastikan goals container berada di atas peta */
}

.goals-container::-webkit-scrollbar {
    width: 0;
    background: transparent;
}

.goal {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
    cursor: pointer; /* Ensures the cursor changes to a pointer */
    width: 300px;
    transition: transform 0.3s ease;
    border: 2px solid transparent; /* Default border */
}

.goal:hover, .goal.active {
    transform: translateX(-30px);
    border: 2px solid #6256CA; /* Highlight when hovered or active */
}

.goal img {
    width: 60px;
    height: 60px;
    border-radius: 10px;
    margin-left: 10px;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); /* Shadow effect */
}
.goal div {
    flex: 1;
    word-wrap: break-word;
}

.create-project-btn {
    display: block;
    width: 200px;
    margin: 20px auto;
    background-color: #6a1b9a;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
    font-size: 1rem;
}

.breadcrumb {
    background-color: white;
    padding: 0;
}
.breadcrumb-item + .breadcrumb-item::before {
    content: ">";
    margin-right: 14px;
    color: #9CA3AF;
}

/* popup content di peta  */
.leaflet-popup-content {
    font-family: 'Arial', sans-serif; /* Ganti dengan font yang Anda inginkan */
    font-size: 14px;
    padding: 10px; /* Padding di dalam popup */
}

.leaflet-popup-content strong {
    color: #d9534f; /* Warna untuk nama proyek */
    display: block; /* Membuat nama proyek berada di baris baru */
    margin-bottom: 10px; /* Jarak bawah */
}

.leaflet-popup-content a {
    color: #007bff; /* Warna link */
    text-decoration: none; /* Menghilangkan garis bawah */
}

.leaflet-popup-content a:hover {
    text-decoration: underline; /* Garis bawah saat hover */
}

.leaflet-popup-content table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px; /* Jarak atas tabel */
}

.leaflet-popup-content th, .leaflet-popup-content td {
    border: 1px solid #ddd;
    padding: 8px;
}

.leaflet-popup-content th {
    background-color: #f2f2f2; /* Warna latar belakang header tabel */
    text-align: left;
}

.leaflet-popup-content tr:hover {
    background-color: #f5f5f5; /* Warna latar belakang saat hover */
}

.sdg-list ul {
    list-style-type: none; /* Menghilangkan bullet points */
    padding: 0; /* Menghilangkan padding default */
    margin: 0; /* Menghilangkan margin default */
}

.sdg-list li {
    display: flex;
    align-items: center;
    margin-bottom: 5px; /* Jarak antar item */
}

.sdg-list img {
    width: 24px; /* Ukuran ikon */
    height: 24px; /* Ukuran ikon */
    margin-right: 8px; /* Jarak antara ikon dan teks */
}

@media (max-width: 768px) {
    .navbar-nav .nav-item .nav-link {
        margin-right: 0;
        margin-bottom: 10px;
    }

    .box, .box1, .box2 {
        /* Add styles for smaller screens */
    }
}

@media (max-width: 576px) {
    .analytics-title, .balance-card, .outcome-card, .report-container h4, .sdg-container .grid-item img {
        font-size: 14px;
    }

    .navbar-brand, .navbar-nav .nav-link {
        font-size: 14px;
    }

    .btn-report {
        font-size: 14px;
        padding: 5px 10px;
    }

    .progress-bar-container, .map-container {
        width: 100%;
        overflow-x: auto;
    }

    .progress-bar {
        width: 100%;
    }

    .box1, .box2 {
        background-color: white;
        padding: 10px;
        border-radius: 17px;
        text-align: center;
        width: 140px;
        border: 1px solid #d1d1d1;
    }

    .price {
        font-size:8px;
    }

    .boxxx {
        display: flex;
        justify-content: space-evenly;
        flex-direction: row;
    }
}
</style>
@endsection
@section('content')

<body>
    <div class="container"  style="margin-bottom: 0px; margin-top: 0px;">
        <nav aria-label="breadcrumb" class="mb-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Dashboard</a>
                </li>
            </ol>
        </nav>

        <div class="header">
            <h2 style="color: #6256CA;">Dashboard</h2>
            <div class="scope">
                <h5 style="color: #282828; font-size: 16px;">Scope</h5>
                <h6 style="color: #6256CA; font-size: 21.42px;">Sustainable <br> Development Goals</h6>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center" style="padding-top: 0px; margin-top:0px;">
        <div class="map-container">
            <div id="map"></div>
            <div id="modal-content" class="location-info"></div>

            <!-- Info Boxes -->
            <div class="info-box expenditure">
                <div>
                    <div>Expenditure</div>
                    <span class="price" id="totalOutcome">Rp{{ number_format($totalOutcome, 0, ',', '.') }}</span>
                </div>
                <img src="{{ asset('images/expense.svg') }}" height="40" width="40">
            </div>
            <div class="info-box funds">
                <div>
                    <div>Amount of Funds</div>
                    <span class="price" id="totalBalance">Rp{{ number_format($totalBalance, 0, ',', '.') }}</span>
                </div>
                <img src="{{ asset('images/zondicons_wallet.svg') }}" height="40" width="40">
            </div>

            <!-- Goals Container -->
            <div class="goals-container">
                @foreach($sdgs as $sdg)
                    <div class="goal" data-index="{{ $sdg->id }}">
                        <div>
                            <div class="sub-heading-2" style="color: #6256CA;">{{ $sdg->short_name }}</div>
                            <div style="font-weight: 600; font-size: 12px; color: #505052;">SDG {{ $sdg->id }}</div>
                            <span style="font-size: 10px; color: black; opacity: 0.5; margin-top: 2px; margin-bottom: 2px; line-height: 0.2;">{{ $sdg->name }}</span>
                        </div>
                        <img src="{{ asset('images/' .$sdg->img) }}" alt="Icon for {{ $sdg->short_name }}" height="50" width="50" class="sdg-icon">
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="provinceModal" tabindex="-1" aria-labelledby="provinceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="provinceModalLabel">Detail Proyek</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-content">
                        <!-- Content will be dynamically inserted here -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-flex justify-content-center mt-5">
        <a href="{{ route('kelolapengeluaran', ['company_id' => $company->id]) }}"><button class="btn-kelola">Financial Project Report</button></a>
    </div>

    <div class="container d-flex justify-content-center mt-5">
        <a href="{{ route('company_finances.index', ['companyId' => $company->id]) }}"><button class="btn-kelola">Financial Report</button></a>
    </div>


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var projects = @json($allProjects);
        var sdgContainers = document.querySelectorAll('.goal');
        var markers = []; // Array to store markers

        // Initialize the map
        var map = L.map('map', {
            zoomControl: false,
            attributionControl: false
        }).setView([-2.5, 118], 5);

        // Add OpenStreetMap layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Function to create markers
        function createMarkers() {
            projects.forEach(function (project) {
                if (project.latitude && project.longitude) {
                    var redIcon = L.icon({
                        iconUrl: '/images/maps-marker.svg',
                        iconSize: [25, 41],
                        iconAnchor: [12, 41],
                        popupAnchor: [1, -34],
                    });

                    var marker = L.marker([project.latitude, project.longitude], { icon: redIcon }).addTo(map);
                    markers.push({ marker: marker, project: project });

                    // Create popup content
                    var targetPelanggan = project.target_pelanggan.find(tp => tp.id_proyek === project.id_proyek);
                    var sdgList = project.sdgs.map(sdg => {
                        return `<li data-sdg-id="${sdg.id}" style="display: flex; align-items: center; margin-bottom: 5px;">
                                    <img src="/images/${sdg.img}" alt="SDG ${sdg.id}" style="width: 24px; height: 24px; margin-right: 8px;">
                                    SDG ${sdg.id}
                                </li>`;
                    }).join('');

                    var popupContent = `<strong>${project.nama}</strong><br>
                                        Kota: ${project.kota}<br>
                                        <a href="${project.gmaps}" target="_blank">Lihat di Google Maps</a><br>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Status</th>
                                                    <th>Rentang Usia</th>
                                                    <th>Deskripsi Pelanggan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>${targetPelanggan ? targetPelanggan.status : '-'}</td>
                                                    <td>${targetPelanggan ? targetPelanggan.rentang_usia : '-'}</td>
                                                    <td>${targetPelanggan ? targetPelanggan.deskripsi_pelanggan : '-'}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="sdg-list" style="margin-top: 5px;">
                                            <strong>Indikator SDG:</strong>
                                            <ul>
                                                ${sdgList.length > 0 ? sdgList : '<li>Tidak ada SDG yang terkait</li>'}
                                            </ul>
                                        </div>`;

                    marker.bindPopup(popupContent);
                }
            });
        }

        // Create markers on map
        createMarkers();

        // Set up event listeners for SDG containers
        sdgContainers.forEach(function (container) {
            container.addEventListener('click', function () {
                container.classList.toggle('active');
                updateMarkers();
            });
        });

        // Function to update markers based on active SDGs
        function updateMarkers() {
            var activeSdgs = Array.from(sdgContainers)
                .filter(container => container.classList.contains('active'))
                .map(container => parseInt(container.getAttribute('data-index')));

            markers.forEach(function (markerData) {
                var project = markerData.project;
                var sdgIds = project.sdgs.map(sdg => sdg.id);

                if (activeSdgs.length > 0) {
                    if (sdgIds.some(id => activeSdgs.includes(id))) {
                        markerData.marker.addTo(map);
                    } else {
                        map.removeLayer(markerData.marker);
                    }
                } else {
                    markerData.marker.addTo(map);
                }
            });
        }

        // Initial call to set the opacity of SDG icons
        sdgContainers.forEach(function (container) {
            var sdgId = container.getAttribute('data-index');
            var hasActiveProjects = projects.some(function (project) {
                return project.sdgs.some(function (sdg) {
                    return sdg.id == sdgId;
                });
            });

            var sdgIcon = container .querySelector('.sdg-icon');

            if (hasActiveProjects) {
                sdgIcon.style.opacity = 1;
            } else {
                sdgIcon.style.opacity = 0.3;
            }
        });
    });
</script>


</body>

@endsection
