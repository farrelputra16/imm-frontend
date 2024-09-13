{{-- @component('survey::questions.base', compact('question'))
    <input type="text" name="{{ $question->key }}" id="{{ $question->key }}" class="form-control"
           value="{{ $value ?? old($question->key) }}" {{ ($disabled ?? false) ? 'disabled' : '' }}>
@endcomponent --}}


@component('survey::questions.base', compact('question'))
    <div class="mb-4 mt-4">
        <input type="text " style="margin-top: -30px" name="{{ $question->key }}" id="{{ $question->key }}" class="form-control"
               value="{{ $value ?? old($question->key) }}" {{ ($disabled ?? false) ? 'disabled' : '' }}
               placeholder="Isi disini" required>
    </div>
@endcomponent

<link rel="stylesheet" href="{{ asset('css/responden/responden-esay.css') }}">
