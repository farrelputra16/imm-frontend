@component('survey::questions.base', compact('question'))
    <div class="form-group">
        <div class="mb-5 d-flex" style="gap: 125px">
            @php
                $min = getRuleValue($question->rules, 'minValue') ?? 0;
                $max = getRuleValue($question->rules, 'maxValue') ?? 5;
                $step = getRuleValue($question->rules, 'step') ?? 1;
            @endphp

            @for($i = $min; $i <= $max; $i += $step)
                <div class="radio-item">
                    <input type="radio" name="{{ $question->key }}" id="{{ $question->key . '-' . $i }}" value="{{ $i }}"
                           {{ old($question->key, $value ?? '') == $i ? 'checked' : '' }}
                           {{ $disabled ?? false ? 'disabled' : '' }} required>
                    <label for="{{ $question->key . '-' . $i }}">{{ $i }}</label>
                </div>
            @endfor
        </div>
    </div>

    @if($errors->has($question->key))
        <div class="text-danger mt-3">{{ $errors->first($question->key) }}</div>
    @endif
@endcomponent

<link rel="stylesheet" href="{{ asset('css/responden/responden-skala.css') }}">
