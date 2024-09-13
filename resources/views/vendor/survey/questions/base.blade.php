<div class="form-group">
    <label style="font-size:1.1rem" class="form-label mb-3" for="{{ $question->key }}">{{ $question->content }}</label>
    {{ $slot }}
    @if($errors->has($question->key))
        <div class="text-danger mt-3">{{ $errors->first($question->key) }}</div>
    @endif
</div>

<div class="text-success">
    {{ $report ?? '' }}
</div>

<link rel="stylesheet" href="{{ asset('css/responden/responden-esay.css') }}">
