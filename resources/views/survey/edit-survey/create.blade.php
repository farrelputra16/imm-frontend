@extends('layouts.app-imm')
@section('title', 'Edit Survey')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/responden/edit-survey.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/Settings/style.css') }}">
    <style>
        .content {
            background-color: #f7f6fb;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 50px;
            text-align: justify;
            /* Add some space between each section */
        }

        .form-control-select {
            width: 315px;
            height: 49px;
            background-color: #5940cb;
            color: white;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: bold;
        }

        .form-control {
            height: 47px;
            width: 100%;
            border: 2px solid #5940cb;
        }

        .btn-tambah-bagian {
            cursor: pointer;
            color: white;
            background-color: #5940cb;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 32px;
            font-family: "Quicksand", sans-serif;
            font-weight: bold;
        }

        .btn-tambah {
            width: 315px;
            height: 49px;
            background-color: #5940cb;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: white;
            font-size: 20px;
            font-family: "Quicksand", sans-serif;
            font-weight: bold;
        }

        .form-esay,
        .form-pilihan-ganda,
        .form-skala {
            padding: 20px;
            border-radius: 5px;
        }

        .radio-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .radio-item input {
            margin-bottom: 5px;
        }

        .btn-tambah.hidden {
            display: none;
        }

        .angka {
            height: 54px;
            width: 35px;
            background-color: #5940cb;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: 500;
            color: white;
        }

        .radio-item {
            display: flex;
            align-items: center;
        }

        .radio-item input[type="radio"] {
            margin-right: 5px;
        }

        .form-container {
            display: flex;
            flex-wrap: wrap;
        }

        .form-container>div {
            flex: 1 1 30%;
            /* Adjust the percentage as needed to control the width */
            margin: 10px;
        }

        .btn {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .btn-lihat {
            width: 226px;
            height: 49px;
            background-color: white;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: #5940cb;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: bold;
        }

        .btn-mulai,
        .btn-akhiri,
        .btn-lihat-responden {
            width: 200px;
            height: 49px;
            background-color: #5940cb;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: white;
            font-size: 20px;
            font-family: "Poppins", sans-serif;
            font-weight: bold;
        }

        .btn-lihat-responden {
            width: 300px;
        }

        .btn-simpan {
            width: 240px;
            height: 49px;
            background-color: #5940cb;
            border: 3px solid #5940cb;
            border-radius: 6px;
            color: white;
            font-size: 20px;
            font-family: "Quicksand", sans-serif;
            font-weight: bold;
        }

        .metric-item:hover {
            filter: brightness(0.95);
        }

        .metric-checkbox {
            width: 20px;
            height: 20px;
        }

        .text-primary {
            color: #5940cb !important;
        }

        .sub-content {
            background-color: #e5e2f2;
            width: 100%;
            height: 182px;
            justify-content: center;
            display: flex;
            margin-bottom: 30px;
        }
    </style>
@endsection
@section('content')
    <body>
        <form action="{{ route('surveys.store') }}" method="POST">
            @csrf
            <input name="project_id" value="{{ $project->id }}" hidden>
            <div class="container content mt-5 mb-5">
                <div class="container">
                    <div class="mb-2 mt-2">
                        <input type="text" name="name" class="form-control" placeholder="Judul Survey anda"
                            style="border: none; background:transparent; font-size: 40px;font-weight: bold;" required>
                        {{-- <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Survey anda"
                            style="border: none; background:transparent; font-size: 20px;font-weight: 400;" required> --}}
                    </div>

                    <div class="row d-flex justify-content-between mt-5">
                        <button type="submit" class="btn-simpan d-flex justify-content-around align-items-center">

                            <span class="text-white">Simpan Survey</span>
                            <img src="{{ asset('images/simpan-icon.png') }}" width="29" height="auto" alt="">
                        </button>
                        {{-- <button type="" class="btn-akhiri">Akhiri Survey</button>
                        <a href="responden"><button type="" class="btn-lihat-responden">Lihat Responden
                                Survey</button></a>
                        <button type="" class="btn-lihat d-flex justify-content-around align-items-center">
                            <a href="survey-tangapan-diagram" class="text-dark"><span>Lihat Survey</span></a>
                            <img src="images/mata-icon.png" width="25" height="20" alt="">
                        </button> --}}

                    </div>

                    <div class="form-group" style="display: none;">
                        <label for="accept-guest-entries">Accept Guest Entries</label>
                        <input type="hidden" name="settings[accept-guest-entries]" id="accept-guest-entries" value="true"
                            class="form-control">
                    </div>
                    <div class="form-group" style="display: none;">
                        <label for="limit-per-participant">Limit Per Participant</label>
                        <input type="hidden" name="settings[limit-per-participant]" id="limit-per-participant"
                            class="form-control" value="-1">
                    </div>

                    {{-- <div id="sections-container">
                <!-- Sections will be added dynamically here -->
            </div> --}}

                </div>

                <div class="container mb-5" id="sections-container">

                </div>

                <div class="container d-flex justify-content-center mt-5">
                    <span class="btn-tambah-bagian" id="add-section-btn">Tambah Bagian Survey +</span>
                </div>
            </div>
        </form>


        <template id="section-template">
            <div class="section-group container content mt-5">
                <div class="container d-flex align-items-center justify-content-between">
                    <span>
                        <div class="mb-2 mt-2">
                            <input type="text" name="sections[__INDEX__][name]" class="form-control section-number"
                                placeholder="Judul bagian"
                                style="border: none; background:transparent; font-size: 40px;font-weight: bold;" required>
                        </div>

                        {{-- <textarea name="sections[__INDEX__][description]" class="form-control"
                        style="font-size: 20px; border: none; background:transparent;" placeholder="Tambahkan Desksipsi"></textarea> --}}
                    </span>
                </div>
                <div class="questions-container container mt-3"></div>
                <span>
                    <button type="button" class="btn-tambah add-question ml-5">Tambah Pertanyaan</button>
                </span>
            </div>
        </template>

        <template id="question-template">
            <div class="form-group question-group">
                <span class="angka d-flex justify-content-center align-items-center mt-2 mb-1">__QUESTION_NUMBER__</span>
                <label for="question-content">Tambahkan pertanyaan</label>
                <input type="text" name="sections[__SECTION_INDEX__][questions][__QUESTION_INDEX__][content]"
                    class="form-control mb-2" required>

                <label for="question-type">Tipe pertanyaan</label>
                <select name="sections[__SECTION_INDEX__][questions][__QUESTION_INDEX__][type]"
                    class="form-control question-type mb-2" required>
                    <option value="text">Text</option>
                    <option value="number">Number</option>
                    <option value="radio">Radio</option>
                    <option value="multiselect">Multiselect</option>
                    <option value="range">Range</option>
                </select>

                <input type="hidden" name="sections[__SECTION_INDEX__][questions][__QUESTION_INDEX__][rules]"
                    class="form-control" value="">

                <div class="question-options-container mb-2">
                    <label for="question-options">Opsi (untuk radio dan multiselect)</label>
                    <input type="text" name="sections[__SECTION_INDEX__][questions][__QUESTION_INDEX__][options][0]"
                        class="form-control question-option mb-1" placeholder="Opsi 1" disabled>
                    <input type="text" name="sections[__SECTION_INDEX__][questions][__QUESTION_INDEX__][options][1]"
                        class="form-control question-option mb-1" placeholder="Opsi 2" disabled>
                    <input type="text" name="sections[__SECTION_INDEX__][questions][__QUESTION_INDEX__][options][2]"
                        class="form-control question-option mb-1" placeholder="Opsi 3" disabled>
                    <input type="text" name="sections[__SECTION_INDEX__][questions][__QUESTION_INDEX__][options][3]"
                        class="form-control question-option mb-1" placeholder="Opsi 4" disabled>
                </div>
            </div>
        </template>

        <script>
            const inputGambar = document.getElementById('gambar');
            const previewImg = document.getElementById('preview-img');

            inputGambar.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewImg.src = 'images/upload.png'; // Default image if no file selected
                }
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let sectionIndex = 0;

                function updateQuestionOptions(selectElement) {
                    const type = selectElement.value;
                    const formGroup = selectElement.closest('.form-group');
                    const optionsContainer = formGroup.querySelector('.question-options-container');
                    const optionsInputs = optionsContainer.querySelectorAll('.question-option');

                    if (type === 'radio' || type === 'multiselect') {
                        optionsInputs.forEach(input => input.disabled = false);
                    } else {
                        optionsInputs.forEach(input => {
                            input.disabled = true;
                            input.value = '';
                        });
                    }
                }

                function addSection() {
                    const sectionTemplate = document.getElementById('section-template').innerHTML;
                    const container = document.getElementById('sections-container');
                    const sectionHtml = sectionTemplate.replace(/__INDEX__/g, sectionIndex);
                    container.insertAdjacentHTML('beforeend', sectionHtml);
                    sectionIndex++;
                }

                function addQuestion(event) {
                    const sectionGroup = event.target.closest('.section-group');
                    const questionsContainer = sectionGroup.querySelector('.questions-container');
                    const questionTemplate = document.getElementById('question-template').innerHTML;
                    const sectionIndex = Array.from(sectionGroup.parentNode.children).indexOf(sectionGroup);
                    const questionIndex = questionsContainer.querySelectorAll('.question-group').length;
                    const questionNumber = `${sectionIndex + 1}.${questionIndex + 1}`;
                    const questionHtml = questionTemplate
                        .replace(/__SECTION_INDEX__/g, sectionIndex)
                        .replace(/__QUESTION_INDEX__/g, questionIndex)
                        .replace(/__QUESTION_NUMBER__/g, questionNumber);
                    questionsContainer.insertAdjacentHTML('beforeend', questionHtml);

                    const newSelectElement = questionsContainer.querySelector(
                        `.question-group:last-child .question-type`);
                    updateQuestionOptions(newSelectElement);
                    newSelectElement.addEventListener('change', function() {
                        updateQuestionOptions(newSelectElement);
                    });
                }

                document.getElementById('add-section-btn').addEventListener('click', addSection);

                document.addEventListener('click', function(event) {
                    if (event.target.classList.contains('add-question')) {
                        addQuestion(event);
                    }
                });

                document.addEventListener('change', function(event) {
                    if (event.target.classList.contains('question-type')) {
                        updateQuestionOptions(event.target);
                    }
                });

                // Initial setup if there are any existing sections (optional)
                // addSection(); // Uncomment this if you want to start with one section by default
            });
        </script>
        <script src="{{ asset('js/imm/metrix.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    </body>

@endsection
