@extends('layouts.app-imm')
@section('title', 'Halaman Perusahaan')

@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">


<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&display=swap");
html,
body {
    margin: 0;
    font-family: "Poppins", sans-serif;
    padding-top:50px;
}

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

span {
    color: #acacac;
}

.price {
    font-size: 20px;
    font-weight: bold;
    color: #6256CA;
}

p {
    margin-top: 0;
    margin-bottom: 1rem;
    position: relative;
    right: -17px;
    top: -9px;
}

h4 {
    font-size: 39px;
    color: #ffffff;
    font-weight: bold;
    line-height: 1.2;
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
    right: 2px;
    width: 300px;
    max-height: 550px;
    overflow-y: scroll;
    background: transparent;
    padding: 0px;
    padding-left: 30px;
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
    width: 250px;
    height: auto;
    transition: transform 0.3s ease;
}

.goal:hover, .goal:active {
    transform: translateX(-30px);
}

.goal img {
    width: 50px;
    height: 50px;
    margin-left: 10px;
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
                            <div class="sub-heading-2" style="color: #6256CA;"> {{ $sdg->short_name }}</div>
                            <div style="font-weight: 600; font-size: 12px; color: #505052;">SDG {{ $sdg->id }}</div>
                            <span style="font-size: 10px; color: black; opacity: 0.3;">{{ $sdg->name }}</span>
                        </div>
                        <img src="{{ asset('images/' .$sdg->img) }}" alt="Icon for {{ $sdg->short_name  }}" height="50" width="50" class="sdg-icon">
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

    <div class="container mt-5">
        <div class="sdg-container">
            <div class="grid">
                @foreach ($sdgs as $sdg)
                    <div class="grid-item" data-index="{{ $sdg->id }}">
                        <img src="{{ asset('images/E-WEB-Goal-' . $sdg->id . '.png') }}" alt="Goal {{ $sdg->id }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>


    {{-- <div class="container">
        <div class="map-container">
            <img src="https://storage.googleapis.com/a1aa/image/ADKVsTCpmWrpMRff27FM86DGCHExcp3X0f572ur4dw5eOgqOB.jpg" alt="Map of Southeast Asia with markers for various projects" height="500" width="800">

        </div>
        <button class="create-project-btn">Create a Project</button>
    </div> --}}

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['geochart'],
    });
    google.charts.setOnLoadCallback(drawRegionsMap);

    function drawRegionsMap() {
        var projects = @json($allProjects);
        var provinceToISO = {
            "ACEH": "ID-AC",
            "SUMATERA UTARA": "ID-SU",
            "SUMATERA BARAT": "ID-SB",
            "RIAU": "ID-RI",
            "JAMBI": "ID-JA",
            "SUMATERA SELATAN": "ID-SS",
            "BENGKULU": "ID-BE",
            "LAMPUNG": "ID-LA",
            "KEPULAUAN BANGKA BELITUNG": "ID-BB",
            "KEPULAUAN RIAU": "ID-KR",
            "DKI JAKARTA": "ID-JK",
            "JAWA BARAT": "ID-JB",
            "JAWA TENGAH": "ID-JT",
            "DI YOGYAKARTA": "ID-YO",
            "JAWA TIMUR": "ID-JI",
            "BANTEN": "ID-BT",
            "BALI": "ID-BA",
            "NUSA TENGGARA BARAT": "ID-NB",
            "NUSA TENGGARA TIMUR": "ID-NT",
            "KALIMANTAN BARAT": "ID-KB",
            "KALIMANTAN TENGAH": "ID-KT",
            "KALIMANTAN SELATAN": "ID-KS",
            "KALIMANTAN TIMUR": "ID-KI",
            "KALIMANTAN UTARA": "ID-KU",
            "SULAWESI UTARA": "ID-SA",
            "SULAWESI TENGAH": "ID-ST",
            "SULAWESI SELATAN": "ID-SN",
            "SULAWESI TENGGARA": "ID-SG",
            "GORONTALO": "ID-GO",
            "SULAWESI BARAT": "ID-SR",
            "MALUKU": "ID-MA",
            "MALUKU UTARA": "ID-MU",
            "PAPUA": "ID-PA",
            "PAPUA BARAT": "ID-PB",
            "PAPUA BARAT DAYA": "ID-PD",
            "PAPUA SELATAN": "ID-PS",
            "PAPUA PEGUNUNGAN": "ID-PP",
            "PAPUA TENGAH": "ID-PT"
        };

        var isoToProvince = {};
        for (var province in provinceToISO) {
            isoToProvince[provinceToISO[province]] = province;
        }

        var provinceProjects = projects.reduce((acc, project) => {
            var provinceCode = provinceToISO[project.provinsi];
            if (!acc[provinceCode]) {
                acc[provinceCode] = [];
            }

            // Menemukan target pelanggan proyek berdasarkan id proyek
            var targetPelanggan = project.target_pelanggan.find(tp => tp.id_proyek === project.id_proyek);

            // Menambahkan informasi proyek ke dalam akumulator
            acc[provinceCode].push({
                name: project.nama,
                city: project.kota,
                gmaps: project.gmaps,
                status: targetPelanggan ? targetPelanggan.status : '-',
                rentang_usia: targetPelanggan ? targetPelanggan.rentang_usia : '-',
                deskripsi_pelanggan: targetPelanggan ? targetPelanggan.deskripsi_pelanggan : '-',
            });

            return acc;
        }, {});

        var data = google.visualization.arrayToDataTable([
            ['Province', 'Projects', { role: 'tooltip', p: { html: true } }],
            ...Object.entries(provinceProjects).map(([province, projectDetails]) => [
                { v: province, f: '' },
                projectDetails.length,
                `<div style="padding:5px"><strong>${isoToProvince[province]}</strong><ul>${projectDetails.map(detail => `
                    <li>${detail.name}</li>`).join('')}</ul></div>`
            ])
        ]);

        var options = {
            region: 'ID',
            displayMode: 'regions',
            resolution: 'provinces',
            backgroundColor: 'transparent',
            datalessRegionColor: 'rgb(89, 64, 203)',
            colorAxis: { colors: ['rgb(57, 197, 44)', 'rgb(57, 197, 44)'] },
            enableRegionInteractivity: true,
            legend: 'none',
            tooltip: { isHtml: true }
        };

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        google.visualization.events.addListener(chart, 'regionClick', function (event) {
            var province = isoToProvince[event.region];
            if (province && provinceProjects[event.region]) {
                var projectDetails = provinceProjects[event.region];
                var modalContent = `<h5>Proyek di ${province}</h5><ul>`;
                projectDetails.forEach(detail => {
                    modalContent += `<li><strong>${detail.name}</strong><br>
                        Kota: ${detail.city}<br>
                        <a href="${detail.gmaps}" target="_blank">Lihat di Google Maps</a><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Rentang Usia</th>
                                    <th>Deskripsi Pelanggan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${detail.status}</td>
                                    <td>${detail.rentang_usia}</td>
                                    <td>${detail.deskripsi_pelanggan}</td>
                                </tr>
                            </tbody>
                        </table>
                    </li>`;
                });

                modalContent += `</ul>`;
                document.getElementById('modal-content').innerHTML = modalContent;
                $('#provinceModal').modal('show');
            }
        });

        chart.draw(data, options);
    }

    document.addEventListener('DOMContentLoaded', function () {
        var projects = @json($allProjects);
        var sdgContainers = document.querySelectorAll('.goal');

        sdgContainers.forEach(function (container) {
            var sdgId = container.getAttribute('data-index');
            var hasActiveProjects = projects.some(function (project) {
                return project.sdgs.some(function (sdg) {
                    return sdg.id == sdgId;
                });
            });

            var sdgIcon = container.querySelector('.sdg-icon');

            if (hasActiveProjects) {
                // Jika ada proyek aktif, atur opacity menjadi 1
                sdgIcon.style.opacity = 1;
            } else {
                // Jika tidak ada proyek aktif, atur opacity menjadi 0.3
                sdgIcon.style.opacity = 0.3;
            }
        });
    });
</script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Contoh data proyek
        var projects = [
            {
                "id_proyek": 1,
                "nama": "Proyek A",
                "kota": "Jakarta",
                "latitude": -6.2088,
                "longitude": 106.8456,
                "target_pelanggan": [
                    {
                        "id_proyek": 1,
                        "status": "Aktif",
                        "rentang_usia": "18-25",
                        "deskripsi_pelanggan": "Mahasiswa"
                    }
                ],
                "gmaps": "https://maps.google.com/?q=-6.2088,106.8456"
            },
            // Tambahkan proyek lainnya di sini
        ];

        // Inisialisasi peta tanpa kontrol zoom
        var map = L.map('map', {
            zoomControl: false,
            attributionControl: false
        }).setView([-2.5, 118], 5); // Koordinat tengah Indonesia

        // Tambahkan layer peta dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Tambahkan marker untuk setiap proyek
        projects.forEach(function (project) {
            // Pastikan project memiliki latitude dan longitude
            if (project.latitude && project.longitude) {
                var marker = L.marker([project.latitude, project.longitude]).addTo(map);

                // Buat popup untuk marker
                var targetPelanggan = project.target_pelanggan.find(tp => tp.id_proyek === project.id_proyek);
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
                                    </table>`;

                marker.bindPopup(popupContent);
            }
        });
    });
</script>


</body>

@endsection
