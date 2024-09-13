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

        canvas {
            color: #5940cb
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

        .chart-container {
            display: block;
            box-sizing: border-box;
            height: 257px;
            width: 490px;
            position: relative;
            top: 10px;
        }

        .chart-containerr {
            position: relative;
            width: 100%;
            height: 14px;
            margin: auto;
        }

        .month-row {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin-bottom: 10px;
        }

        .month-row div {
            text-align: center;
        }

        .input-row {
            display: flex;
            justify-content: space-around;
            width: 100%;
            margin-bottom: 20px;
        }

        .input-row input {
            width: 60px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .slider {
            width: 100%;
            margin-bottom: 20px;
        }

        .label {
            margin-bottom: 10px;
            text-align: left;
            width: 100%;
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
        <button class="d-flex justify-content-around align-items-center"><img src="/images/unduh.png" class="unduhimg"
                alt="">Unduh Tanggapan</button>
    </div>
    <div class="container content mt-5 pb-5">
        <div class="container mt-5">
            <div class="section">
                <h5>Lorem ipsum</h5>
                <span>2 Tanggapan</span>
                <div class="d-flex align-items-center" style="gap: 30px">
                    <div class="chart-container">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            <div id="results"></div>
        </div> <div class="container mt-5">
            <div class="section">
                <h5>Dolor Sit Amet</h5>
                <span>2 Tanggapan</span>
                <div class="d-flex align-items-center" style="gap: 30px">
                    <div class="chart-container">
                        <canvas id="secondChart"></canvas>
                    </div>
                </div>
            </div>

            <div id="results"></div>
        </div>
    </div>

    <!-- Section for the second chart -->

    <div class="container d-flex justify-content-center mt-5" style="gap: 30px">
        <button class="btn-kembali">Kembali</button>
        <button class="btn-selanjutnya">Lanjutkan</button>
    </div>
    <footer>
        <div class="container mb-5 mt-5 d-flex justify-content-center align-items-center">
            <h5 style="color: #5940cb; font-weight: bold">Konten di dalam survey ini tidak dibuat oleh Impact Mate</h5>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            const initialData = [10, 10, 10, 10, 10];

            // First chart
            const ctx1 = document.getElementById("myChart").getContext("2d");
            const myChart = new Chart(ctx1, {
                type: "bar",
                data: {
                    labels: ["1", "2", "3", "4", "5"],
                    datasets: [{
                        label: "",
                        data: initialData.slice(),
                    }, ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

            // Second chart
            const ctx2 = document.getElementById("secondChart").getContext("2d");
            const secondChart = new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: ["1", "2", "3", "4", "5"],
                    datasets: [{
                        label: "",
                        data: initialData.slice(),
                    }, ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

            // Update first chart data
            const updateFirstChartData = () => {
                const inputs = document.querySelectorAll(".input-row input");
                const newData = Array.from(inputs).map((input) => parseInt(input.value) || 0);
                myChart.data.datasets[0].data = newData;
                myChart.update();
            };

            // Update second chart data
            const updateSecondChartData = () => {
                const inputs = document.querySelectorAll(".input-row input");
                const newData = Array.from(inputs).map((input) => parseInt(input.value) || 0);
                secondChart.data.datasets[0].data = newData;
                secondChart.update();
            };

            // Adding event listener to inputs
            document.querySelectorAll(".input-row input").forEach((input) => {
                input.addEventListener("input", () => {
                    updateFirstChartData();
                    updateSecondChartData();
                });
            });

            // Adding event listener to slider
            const slider = document.getElementById("myRange");
            slider.addEventListener("input", function () {
                const value = slider.value;
                document.querySelectorAll(".input-row input").forEach((input) => {
                    input.value = value;
                });
                updateFirstChartData();
                updateSecondChartData();
            });

            // Adding event listener to reset button
            document.querySelector(".btn-outline-primary").addEventListener("click", () => {
                document.querySelectorAll(".input-row input").forEach((input, index) => {
                    input.value = initialData[index] || 0;
                });
                slider.value = 5000; // Set slider to default value
                updateFirstChartData();
                updateSecondChartData();
            });

            // Adding event listener to save button
            document.querySelector(".btn-primary").addEventListener("click", () => {
                alert("Data berhasil disimpan!");
            });
        });
    </script>
</body>

</html>