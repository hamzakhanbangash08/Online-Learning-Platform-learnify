@extends('layouts.master')

@section('content')
<div class="container py-5">

    {{-- Timer --}}
    <div class="alert alert-warning d-flex justify-content-between align-items-center">
        <span>
            ⏳ Time Limit:
            {{ $quiz->duration_minutes > 0 ? $quiz->duration_minutes . ' minutes' : 'No Limit' }}
        </span>
        <span id="timer" class="fw-bold text-danger">
            {{ $quiz->duration_minutes > 0 ? gmdate('i:s', $quiz->duration_minutes * 60) : '' }}
        </span>
    </div>

    <h2 class="mb-2">{{ $quiz->title }}</h2>
    <p class="text-muted mb-4">{{ $quiz->description }}</p>

    <form id="quiz-form" action="{{ route('quiz.submit', $quiz->id) }}" method="POST">
        @csrf

        @foreach($quiz->questions as $index => $question)
            <div class="card mb-4 shadow-sm question-card {{ $index == 0 ? '' : 'd-none' }}" data-index="{{ $index }}">
                <div class="card-header fw-bold">
                    Q{{ $index + 1 }}. {{ $question->question_text }}
                </div>
                <div class="card-body">
                    @if($question->options->count())
                        @foreach($question->options as $option)
                            <div class="form-check mb-2">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="answers[{{ $question->id }}]"
                                    id="option{{ $option->id }}"
                                    value="{{ $option->id }}"
                                    required
                                >
                                <label class="form-check-label" for="option{{ $option->id }}">
                                    {{ $option->option_text }}
                                </label>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted fst-italic mb-0">No options found for this question.</p>
                    @endif
                </div>
                <div class="card-footer text-end">
                    @if($index < $quiz->questions->count() - 1)
                        <button type="button" class="btn btn-secondary next-btn">Next</button>
                    @else
                        <button type="submit" class="btn btn-primary">Submit Quiz</button>
                    @endif
                </div>
            </div>
        @endforeach

    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ==== Timer ====
        @if($quiz->duration_minutes > 0)
            let timeLeft = {{ $quiz->duration_minutes * 60 }};
            const timerEl = document.getElementById('timer');
            const formEl  = document.getElementById('quiz-form');

            function tick() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                timerEl.textContent = `${minutes}:${String(seconds).padStart(2, '0')}`;

                if (timeLeft <= 0) {
                    formEl.submit();
                    return;
                }

                timeLeft--;
                setTimeout(tick, 1000);
            }
            tick();
        @endif

        // ==== Next button logic ====
        const questionCards = document.querySelectorAll('.question-card');
        const nextButtons   = document.querySelectorAll('.next-btn');

        nextButtons.forEach((btn, idx) => {
            btn.addEventListener('click', function () {
                questionCards[idx].classList.add('d-none');       // hide current
                questionCards[idx + 1].classList.remove('d-none'); // show next
            });
        });
    });


    // 
    
</script>
@endsection
