{{-- @component('survey::questions.base', compact('question'))
    @foreach($question->options as $option)
        <div class="custom-control custom-radio">
            <input type="radio"
                   name="{{ $question->key }}"
                   id="{{ $question->key . '-' . Str::slug($option) }}"
                   value="{{ $option }}"
                   class="custom-control-input"
                    {{ ($value ?? old($question->key)) == $option ? 'checked' : '' }}
                    {{ ($disabled ?? false) ? 'disabled' : '' }}
            >
            <label class="custom-control-label"
                   for="{{ $question->key . '-' . Str::slug($option) }}">{{ $option }}
                @if($includeResults ?? false)
                    <span class="text-success">
                        ({{ number_format((new \MattDaneshvar\Survey\Utilities\Summary($question))->similarAnswersRatio($option) * 100, 2) }}%)
                    </span>
                @endif
            </label>
        </div>
    @endforeach
@endcomponent --}}

@component('survey::questions.base', compact('question'))
    <div class="mb-4 d-flex flex-column">
        @foreach($question->options as $option)
            <label>
                <input type="radio"
                       name="{{ $question->key }}"
                       id="{{ $question->key . '-' . Str::slug($option) }}"
                       value="{{ $option }}"
                       class="mb-3"
                       {{ ($value ?? old($question->key)) == $option ? 'checked' : '' }}
                       {{ ($disabled ?? false) ? 'disabled' : '' }} required>
                {{ $option }}
                @if($includeResults ?? false)
                    <span class="text-success">
                        ({{ number_format((new \MattDaneshvar\Survey\Utilities\Summary($question))->similarAnswersRatio($option) * 100, 2) }}%)
                    </span>
                @endif
            </label>
        @endforeach
    </div>
@endcomponent

<link rel="stylesheet" href="{{ asset('css/responden/responden-pilihan-ganda.css') }}">

