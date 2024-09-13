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
        <h1>{{ $totalResponses }} Tanggapan</h1>
        {{-- <button class="d-flex justify-content-around align-items-center"><img src="/images/unduh.png" class="unduhimg"
                alt="">Unduh Tanggapan</button> --}}
    </div>
    <div class="container content mt-5 pb-5">
        @foreach ($results as $sectionIndex => $section)
            {{-- <div class="mb-4"> --}}
            <div class="container mt-5">
                <div class="section">
                    <h2>{{ $section['section'] }}</h2>
                    @foreach ($section['questions'] as $questionIndex => $question)
                        <div class="mb-4">
                            <h5>{{ $question['question'] }}</h5>
                            @if ($question['type'] === 'text')
                                @foreach ($question['answers'] as $answer)
                                    <input type="text" class="form-control mt-3" value={{ $answer }} readonly>
                                @endforeach
                            @elseif ($question['type'] === 'number')
                                <div class="chart-container">
                                    <canvas id="chart_{{ $sectionIndex }}_{{ $questionIndex }}"></canvas>
                                </div>
                            @else
                                <div class="chart-container">
                                    <canvas id="chart_{{ $sectionIndex }}_{{ $questionIndex }}"></canvas>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>


    {{-- <div class="container d-flex justify-content-center mt-5" style="gap: 30px">
        <button class="btn-kembali">Kembali</button>
        <button class="btn-selanjutnya">Lanjutkan</button>
    </div> --}}
    <footer>
        <div class="container mb-5 mt-5 d-flex justify-content-center align-items-center">
            <h5 style="color: #5940cb; font-weight: bold">Konten di dalam survey ini tidak dibuat oleh Impact Mate</h5>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const results = @json($results);
            Chart.register(ChartDataLabels);

            results.forEach((section, sectionIndex) => {
                section.questions.forEach((question, questionIndex) => {
                    if (question.type === 'text') return;

                    const ctx = document.getElementById(`chart_${sectionIndex}_${questionIndex}`)
                        .getContext('2d');
                    let data = [];
                    let labels = [];
                    let backgroundColors = [];

                    if (question.type === 'radio' || question.type === 'multiselect') {
                        labels = question.options;
                        data = labels.map(option => question.answers.filter(answer => answer ===
                            option.trim()).length);
                        backgroundColors = labels.map(() =>
                            `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.2)`
                        );
                    } else if (question.type === 'range') {
                        labels = ['0', '1', '2', '3', '4', '5'];
                        data = labels.map(value => question.answers.filter(answer => answer ==
                            value).length);
                        backgroundColors = labels.map(() =>
                            `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.2)`
                        );
                    } else if (question.type === 'number') {
                        // Extract all numeric answers
                        let numericAnswers = question.answers.map(answer => parseFloat(answer));

                        // Calculate unique values and their counts
                        let uniqueValues = Array.from(new Set(numericAnswers));
                        labels = uniqueValues.map(value => value.toString());
                        data = labels.map(label => numericAnswers.filter(answer => parseFloat(
                            answer) === parseFloat(label)).length);
                        backgroundColors = labels.map(() =>
                            `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.2)`
                        );
                    }

                    new Chart(ctx, {
                        type: (question.type === 'radio' || question.type ===
                            'multiselect') ? 'pie' : 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: question.question,
                                data: data,
                                backgroundColor: backgroundColors,
                                borderColor: backgroundColors.map(color => color
                                    .replace('0.2', '1')),
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                datalabels: {
                                    color: '#000000',
                                    formatter: (value, context) => {
                                        let total = context.chart.data.datasets[0].data
                                            .reduce((sum, current) => sum + current, 0);
                                        let percentage = (value / total * 100).toFixed(
                                            2) + "%";
                                        return percentage + '\n' + value;
                                    },
                                    anchor: 'center',
                                    align: 'center',
                                    display: true,
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });

                });
            });
        });
    </script>
</body>

</html>