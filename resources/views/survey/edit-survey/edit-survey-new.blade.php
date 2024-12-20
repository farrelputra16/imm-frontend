@extends('layouts.app-imm')
@section('title', 'Edit Survey')

@section('css')
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('css/responden/edit-survey.css') }}"> --}}
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

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    @if ($isUserRole && $status != 'benchmark')
                        <a href="{{ route('homepage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                    @else
                        @if ($status == 'benchmark' || $status == 'company')
                            <a href="{{ route('landingpage') }}" style="text-decoration: none; color: #212B36;">Home</a>
                        @else
                            <a href="{{ route('investments.pending') }}" style="text-decoration: none; color: #212B36;">Home</a>
                        @endif
                    @endif
                </li>
                @if ($isUserRole && $status != 'benchmark')
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        <a href="{{ route('myproject.myproject') }}" style="text-decoration: none; color: #212B36;">IMM</a>
                    </li>
                @else
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                        @if ($status == 'benchmark')
                            <a href="{{ route('companies.list', ['status' => 'benchmark']) }}" style="text-decoration: none; color: #212B36;">Find Company</a>
                        @elseif ($status == 'company')
                            <a href="{{ route('companies.list', ['status' => 'company']) }}" style="text-decoration: none; color: #212B36;">Find Company</a>
                        @endif
                    </li>
                    <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px; color: #212B36;" aria-current="page">
                        @if ($status == 'company')
                            <a href="{{ route('companies.show', $companyId) }}" style="text-decoration: none; color: #212B36;">Company Profile</a>
                        @elseif ($status == 'benchmark')
                            <a href="{{ route('companies.benchmark', ['id' => $companyId]) }}" style="text-decoration: none; color: #212B36;">Company Profile</a>
                        @endif
                    </li>
                @endif
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    @if ($status == 'company')
                        <a href="{{ route('projects_company.view', ['id' => $projectId, 'status' => 'company', 'companyId' => $companyId]) }}" style="text-decoration: none; color: #5A5A5A;">Project Report</a>
                    @elseif ($status == 'benchmark')
                        <a href="{{ route('projects_company.view', ['id' => $projectId, 'status' => 'benchmark', 'companyId' => $companyId]) }}" style="text-decoration: none; color: #5A5A5A;">Project Report</a>
                    @else
                        <a href="{{ route('projects.view', $projectId) }}" style="text-decoration: none; color: #5A5A5A;">Project Report</a>
                    @endif
                </li>
                <li class="breadcrumb-item sub-heading-1" style="margin-right: 4px;">
                    <a href="#" style="text-decoration: none; color: #212B36;">Survey</a>
                </li>
            </ol>
        </nav>
        <form action="{{ route('surveys.update', $survey) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="container content mt-5 mb-5">

                <div class="container">
                    <div class="mb-2 mt-2">
                        <input type="text" name="name" class="form-control" placeholder="Judul Survey anda"
                            style="border: none; background:transparent; font-size: 40px;font-weight: bold;"
                            value="{{ $survey->name }}" required>
                        {{-- <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Survey anda"
        style="border: none; background:transparent; font-size: 20px;font-weight: 400;" value="{{ $survey->deskripsi }}" required> --}}
                    </div>

                    <div class="row d-flex justify-content-between mt-5">
                        @if ($isUserRole && $status != 'benchmark')
                            <button type="submit" class="btn-simpan d-flex justify-content-around align-items-center">
                                <span class="text-white">Update Survey</span>
                                <img src="{{ asset('images/simpan-icon.png') }}" width="29" height="auto" alt="">
                            </button>
                        @endif
                        {{-- <button type="" class="btn-akhiri">Akhiri Survey</button> --}}
                        <a href="{{ route('surveys.results', $survey) }}"
                            class="btn-lihat-responden d-flex align-items-center justify-content-center">
                            <span>Lihat Responden Survey</span>
                        </a>
                        <a href="{{ route('surveys.view', $survey) }}" class="btn-lihat d-flex justify-content-around align-items-center text-dark" target="_blank">
                            <span>Lihat Survey</span>
                            <img src="{{ asset('images/mata-icon.png') }}" width="25" height="20" alt="">
                        </a>
                        {{-- Tombol untuk Menyalin URL --}}
                        <button class="btn-bagikan d-flex justify-content-center align-items-center" id="copyLinkButton" title="Bagikan Survey">
                            <i class="fas fa-share-alt" style="font-size: 25px;"></i> <!-- Ikon berbagi -->
                        </button>
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

                </div>

                <div class="container mb-5" id="sections-container">
                    @foreach ($survey->sections as $sectionIndex => $section)
                        <div class="section-group container content mt-5">
                            <div class="container d-flex align-items-center justify-content-between">
                                <span>
                                    <div class="mb-2 mt-2">
                                        <input type="text" name="sections[{{ $sectionIndex }}][name]"
                                               class="form-control section-number"
                                               placeholder="Judul bagian"
                                               style="border: none; background:transparent; font-size: 40px;font-weight: bold;"
                                               value="{{ $section->name }}" required
                                               @if (!($isUserRole && $status != 'benchmark')) readonly @endif>
                                    </div>
                                </span>
                            </div>
                            <div class="questions-container container mt-3">
                                @foreach ($section->questions as $questionIndex => $question)
                                    <div class="form-group question-group">
                                        <span class="angka d-flex justify-content-center align-items-center mt-2 mb-1">
                                            {{ $sectionIndex + 1 }}.{{ $questionIndex + 1 }}
                                        </span>
                                        <label for="question-content">Tambahkan pertanyaan</label>
                                        <input type="text"
                                               name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][content]"
                                               class="form-control mb-2"
                                               value="{{ $question->content }}" required
                                               @if (!($isUserRole && $status != 'benchmark')) readonly @endif>

                                        <label for="question-type">Tipe pertanyaan</label>
                                        <select name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][type]"
                                                class="form-control question-type mb-2" required
                                                @if (!($isUserRole && $status != 'benchmark')) disabled @endif>
                                            @foreach (['text', 'number', 'radio', 'multiselect', 'range'] as $type)
                                                <option value="{{ $type }}"
                                                        {{ $question->type == $type ? 'selected' : '' }}>{{ ucfirst($type) }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="question-options-container mb-2"
                                             @if ($question->type != 'radio' && $question->type != 'multiselect') style="display: none;" @endif>
                                            <label for="question-options">Opsi (untuk radio dan multiselect)</label>
                                            @php
                                                $options = is_array($question->options)
                                                    ? $question->options
                                                    : explode(',', $question->options);
                                            @endphp
                                            @foreach ($options as $optionIndex => $option)
                                                <input type="text"
                                                       name="sections[{{ $sectionIndex }}][questions][{{ $questionIndex }}][options][{{ $optionIndex }}]"
                                                       class="form-control question-option mb-1"
                                                       placeholder="Opsi {{ $optionIndex + 1 }}"
                                                       value="{{ $option }}"
                                                       @if ($question->type != 'radio' && $question->type != 'multiselect') disabled @endif
                                                       @if (!($isUserRole && $status != 'benchmark')) readonly @endif>
                                            @endforeach
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                            <span>
                                <button type="button" class="btn-tambah add-question ml-5"
                                        @if (!($isUserRole && $status != 'benchmark')) disabled @endif>
                                    Tambah Pertanyaan
                                </button>
                            </span>
                        </div>
                    @endforeach
                </div>

                <div class="container d-flex justify-content-center mt-5">
                    <span class="btn-tambah-bagian" id="add-section-btn"
                          @if (!($isUserRole && $status != 'benchmark')) style="pointer-events: none; opacity: 0.5;" @endif>
                        Tambah Bagian Survey +
                    </span>
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
            document.addEventListener('DOMContentLoaded', function() {
                let sectionIndex = {{ $survey->sections->count() }}; // Start with the number of existing sections

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

                // Initial setup for existing sections and questions
                document.querySelectorAll('.question-type').forEach(selectElement => {
                    updateQuestionOptions(selectElement);
                    selectElement.addEventListener('change', function() {
                        updateQuestionOptions(selectElement);
                    });
                });
            });
        </script>

        <script src="{{ asset('js/imm/metrix.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('copyLinkButton').addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah refresh halaman

                    const surveyUrl = "{{ route('surveys.view', $survey) }}"; // URL survei

                    // Coba menggunakan Clipboard API
                    if (navigator.clipboard) {
                        navigator.clipboard.writeText(surveyUrl).then(function() {
                            alert('Link survei berhasil disalin: ' + surveyUrl);
                        }).catch(function(err) {
                            console.error('Gagal menyalin link: ', err);
                            alert('Terjadi kesalahan saat mencoba untuk menyalin link.');
                        });
                    } else {
                        // Jika Clipboard API tidak tersedia, gunakan metode fallback
                        const tempInput = document.createElement('input');
                        tempInput.value = surveyUrl;
                        document.body.appendChild(tempInput);
                        tempInput.select(); // Pilih teks
                        try {
                            const successful = document.execCommand('copy'); // Salin ke clipboard
                            if (successful) {
                                alert('Link survei berhasil disalin: ' + surveyUrl);
                            } else {
                                alert('Gagal menyalin link.');
                            }
                        } catch (err) {
                            console.error('Gagal menyalin link: ', err);
                            alert('Terjadi kesalahan saat mencoba untuk menyalin link.');
                        }
                        document.body.removeChild(tempInput); // Hapus elemen input
                    }
                });
            });
        </script>
    </body>

@endsection
