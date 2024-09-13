<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMM | Responden</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/responden/responden.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap");

        body {
            font-family: "Roboto", sans-serif;
            background-color: #ffffff;
            font-family: "Quicksand", sans-serif;
        }

        .content {
            background-color: #f7f6fb;
            width: 100%;
            border-radius: 20px;
            display: flex;
            align-items: center;
            padding: 0 50px;
            text-align: justify;
            flex-direction: column;
        }

        h1 {
            text-align: center;
        }

        .result {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .result h2 {
            margin-top: 0;
        }

        .result p {
            margin: 5px 0;
        }

        labels {}

        canvas {
            margin: 10px auto;
        }

        .btn-kembali {
            width: 399px;
            height: 49px;
            background-color: white;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: #5940cb;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: bold;
        }

        .btn-selanjutnya {
            width: 399px;
            height: 49px;
            background-color: #5940cb;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: white;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: bold;
        }

        .contentt {
            background-color: #f7f6fb;
            border-radius: 20px;
            width: 100%;
            padding: 20px 50px;
        }

        .satu,
        .dua,
        .tiga,
        .empat {
            font-size: 20px
        }

        .satu {
            color: #5940cb;
        }

        .dua {
            color: #6d55d8;
        }

        .tiga {
            color: #745be2;
        }

        .empat {
            color: #8870f3;
        }

        .btn-kembali {
            width: 299px;
            height: 49px;
            background-color: white;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: #5940cb;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: bold;
        }

        .result {
            display: none;
        }

        .btn-selanjutnya {
            width: 299px;
            height: 49px;
            background-color: #5940cb;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: white;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: bold;
        }

        .form-control {
            width: 70%;
            background-color: #aa98f9;
        }

        .sub-content {
            background-color: #e5e2f2;
            width: 100%;
            height: 182px;
            margin-top: 50px;
            justify-content: center;
            display: flex;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .unduhimg {
            width: 30px;
            height: 30px;
            color: white;
        }

        img {
            width: 100%;
            height: auto;
            background-size: cover;
        }

        .btn {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        button {
            width: 299px;
            height: 49px;
            background-color: #5940cb;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            color: white;
        }

        .text-primary {
            color: #5940cb !important;
        }

        .main-title {
            font-size: 40px;
            font-weight: bold;
        }

        .subtitle {
            font-weight: bold;
            font-size: 20px;
        }

        .content-text {
            font-size: 20px;
        }

        @media (max-width: 768px) {
            .content {
                padding: 20px;
                height: auto;
            }

            .sub-content {
                margin-top: 20px;
                margin-bottom: 20px;
                height: 100px;
            }

            .main-title {
                font-size: 24px;
            }

            .subtitle,
            .content-text {
                font-size: 12px;
            }

            .btn {
                justify-content: center;
                margin-top: 20px;
            }

            button {
                width: 100%;
                height: auto;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container contentt mt-5 d-flex justify-content-between">
        <h1>2 Tanggapan</h1>
        <button class="d-flex justify-content-around align-items-center"><img src="/images/unduh.png" class="unduhimg" alt="">Unduh Tanggapan</button>
    </div>
    <div class="container content mt-5 pb-5">
        <div class="container mt-5">
            <div class="section">
                <h5>Lorem ipsum</h5>
                <span>2 Tanggapan</span>
                <div class="d-flex align-items-center" style="gap: 30px">
                    <div>
                        <canvas id="surveyChart" width="200" height="200"></canvas>
                    </div>
                    <div>
                        <ul>
                            <li class="satu">Lorem</li>
                            <li class="dua">Lorem</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="results"></div>
        </div>

        <!-- Section for the second chart -->
        <div class="container mt-5">
            <div class="section">
                <h5>Dolor Sit Amet</h5>
                <span>2 Tanggapan</span>
                <div class="d-flex align-items-center" style="gap: 30px">
                    <div>
                        <canvas id="secondSurveyChart" width="200" height="200"></canvas>
                    </div>
                    <div>
                        <ul>
                            <li class="satu">Lorem</li>
                            <li class="dua">Lorem</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-flex justify-content-center mt-5" style="gap: 30px">
        <a href="/edit-survey-new"><button class="btn-kembali">Kembali</button></a>
        <a href="/survey-tangapan-chart"><button class="btn-selanjutnya">Lanjutkan</button></a>
    </div>
    <footer>
        <div class="container mb-5 mt-5 d-flex justify-content-center align-items-center">
            <h5 style="color: #5940cb; font-weight: bold">Konten di dalam survey ini tidak dibuat oleh Impact Mate</h5>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const resultsContainer = document.getElementById('results');

            const dummyData = [
                { name: 'John Doe', email: 'john@example.com', feedback: 'Great survey!' },
                { name: 'Jane Smith', email: 'jane@example.com', feedback: 'Very informative.' }
            ];

            dummyData.forEach(data => {
                const resultDiv = document.createElement('div');
                resultDiv.className = 'result';

                const name = document.createElement('p');
                name.textContent = `Name: ${data.name}`;

                const email = document.createElement('p');
                email.textContent = `Email: ${data.email}`;

                const feedback = document.createElement('p');
                feedback.textContent = `Feedback: ${data.feedback}`;

                resultDiv.appendChild(name);
                resultDiv.appendChild(email);
                resultDiv.appendChild(feedback);

                resultsContainer.appendChild(resultDiv);
            });

            // Chart.js untuk menampilkan diagram lingkaran
            const ctx1 = document.getElementById('surveyChart').getContext('2d');
            const surveyChart = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ['satu', 'dua'],
                    datasets: [{
                        data: [50, 50],
                        backgroundColor: ['#5940cb', '#aa98f9']
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Alur Kerja Form Survei'
                    }
                }
            });

            const ctx2 = document.getElementById('secondSurveyChart').getContext('2d');
            const secondSurveyChart = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['satu', 'dua'],
                    datasets: [{
                        data: [40, 60],
                        backgroundColor: ['#5940cb', '#aa98f9']
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Hasil Survey Kedua'
                    }
                }
            });
        });
    </script>
</body>

</html>