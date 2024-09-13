<div class=" ml-5 border-bottom">
    @include(view()->exists("survey::questions.types.{$question->type}")
        ? "survey::questions.types.{$question->type}"
        : "survey::questions.types.text",[
            'disabled' => !($eligible ?? true),
            'value' => $lastEntry ? $lastEntry->answerFor($question) : null,
        ]
    )
</div>
            {{-- 'includeResults' => ($lastEntry ?? null) !== null --}}
