@extends('layouts.master')

@section('content')
<div class="container py-5 quiz-result-page">
    <h2 class="mb-4 text-center fw-bold text-dark">Quiz Result: {{ $attempt->quiz->title }}</h2>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('quiz.myResults') }}" class="btn btn-outline-primary">Back to my result</a>
        <!-- @if($attempt->passed)
            <a href="{{ route('quiz.certificate', $attempt->id) }}" class="btn btn-success">
                Download Certificate 🎓
            </a>
        @endif -->
@if($certificate)
    <a href="{{ route('certificate.verify', $certificate->token) }}" 
       class="btn btn-success">
       Verify your certificate here
    </a>
@endif


    </div>

    {{-- Summary Card --}}
    <div class="card mb-5 shadow-lg summary-card">
        <div class="card-body p-5">
            <h5 class="card-title text-center mb-4 fw-bold text-dark">Your Quiz Result</h5>

            @php
            $percentage = $attempt->percentage;

            if ($percentage < 40) {
                $color = 'bg-danger'; // red
                $status = 'Failed';
                $icon = '❌';
            } elseif ($percentage < 70) {
                $color = 'bg-warning'; // orange/yellow
                $status = 'Needs Improvement';
                $icon = '⚠️';
            } else {
                $color = 'bg-success'; // green
                $status = 'Passed';
                $icon = '🎉';
            }
            @endphp

            <div class="progress mb-4" style="height: 35px;">
                <div
                    class="progress-bar progress-bar-striped progress-bar-animated {{ $color }}"
                    role="progressbar"
                    style="width: {{ $percentage }}%;"
                    aria-valuenow="{{ $percentage }}"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    <span class="fw-bold">{{ $percentage }}%</span>
                </div>
            </div>

            <div class="d-flex justify-content-center align-items-center flex-column">
                <p class="mb-2 fs-5">
                    <span class="text-secondary fw-bold">Score:</span>
                    <strong class="text-dark">{{ $attempt->score }} / {{ $attempt->total }}</strong>
                </p>
                <p class="mb-0 fs-5">
                    <span class="text-secondary fw-bold">Status:</span>
                    <strong class="{{ $color == 'bg-success' ? 'text-success' : ($color == 'bg-danger' ? 'text-danger' : 'text-warning') }}">
                        {{ $icon }} {{ $status }}
                    </strong>
                </p>
            </div>
        </div>
    </div>

    {{-- Question-wise breakdown --}}
    <h3 class="mb-4 text-dark fw-bold text-center">Answer Breakdown</h3>
    @foreach($attempt->answers as $index => $answer)
        @php
            $question = $answer->question;
            $isCorrect = $answer->is_correct;
            $cardClass = $isCorrect ? 'border-success' : 'border-danger';
        @endphp
        <div class="card mb-4 shadow-sm {{ $cardClass }}">
            <div class="card-header fw-bold d-flex justify-content-between align-items-center">
                <span>Q{{ $index+1 }}. {{ $question->question_text }}</span>
                @if($isCorrect)
                    <span class="badge bg-success">Correct</span>
                @else
                    <span class="badge bg-danger">Incorrect</span>
                @endif
            </div>
            <div class="card-body">
                {{-- Multiple Choice/Options --}}
                @if($question->options->count())
                    @foreach($question->options as $option)
                        @php
                            $optionClass = 'border';
                            $userSelected = $option->id == $answer->option_id;
                            $isCorrectOption = $option->is_correct;

                            if ($userSelected && !$isCorrect) {
                                $optionClass = 'bg-danger text-white incorrect-answer';
                            } elseif ($isCorrectOption) {
                                $optionClass = 'bg-success text-white correct-answer';
                            }
                        @endphp
                        <div class="p-3 mb-2 rounded {{ $optionClass }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>{{ $option->option_text }}</span>
                                <div class="icon-group">
                                    @if($userSelected)
                                        <i class="bi bi-person-fill text-muted me-1" title="Your Answer"></i>
                                    @endif
                                    @if($isCorrectOption)
                                        <i class="bi bi-check-circle-fill" title="Correct Answer"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    {{-- Short Answer Case --}}
                    <div class="mb-3">
                        <strong class="text-secondary">Your Answer:</strong>
                        <p class="p-2 border rounded bg-light">{{ $answer->answer_text ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <strong class="text-secondary">Correct Answer:</strong>
                        <p class="p-2 border rounded bg-light">{{ $question->correct_answer ?? 'N/A' }}</p>
                    </div>
                @endif
            </div>
        </div>
    @endforeach

    <div class="text-center mt-5">
        <a href="{{ route('quiz.start', $attempt->quiz->id) }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
            <i class="bi bi-arrow-repeat me-2"></i> Retake Quiz
        </a>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    :root {
        --primary-color: #5A67D8;
        --secondary-color: #6B7280;
        --dark-color: #1A202C;
        --light-color: #F7FAFC;
        --card-bg: #FFFFFF;
        --success-color: #48BB78;
        --danger-color: #F56565;
        --warning-color: #F6AD55;
        --font-family-base: "Inter", sans-serif;
    }

    body {
        background-color: var(--light-color);
        font-family: var(--font-family-base);
        color: var(--dark-color);
    }

    .quiz-result-page {
        max-width: 900px;
        margin: auto;
    }

    /* Summary Card Styling */
    .summary-card {
        border-radius: 1rem;
        border: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .progress {
        background-color: #E2E8F0;
        border-radius: 999px;
    }

    .progress-bar {
        font-weight: 600;
        color: white;
    }

    /* Question Cards Styling */
    .card-header {
        background-color: #F7FAFC;
        border-bottom: 1px solid #E2E8F0;
        padding: 1.25rem 1.5rem;
    }

    .card.border-success { border-left: 5px solid var(--success-color) !important; }
    .card.border-danger { border-left: 5px solid var(--danger-color) !important; }

    .card-body {
        padding: 1.5rem;
    }

    /* Option Styling */
    .p-3.mb-2.rounded {
        transition: transform 0.2s ease;
        border-color: #E2E8F0 !important;
    }

    .correct-answer {
        background-color: var(--success-color) !important;
        border-color: var(--success-color) !important;
        color: white !important;
    }

    .incorrect-answer {
        background-color: var(--danger-color) !important;
        border-color: var(--danger-color) !important;
        color: white !important;
    }

    .correct-answer .icon-group,
    .incorrect-answer .icon-group {
        color: white;
    }

    .icon-group .bi-check-circle-fill {
        color: white;
        font-size: 1.1em;
    }

    .icon-group .bi-person-fill {
        color: white;
        font-size: 1.1em;
    }

    .incorrect-answer .bi-person-fill {
        color: white;
    }

    /* Badge Styling */
    .badge {
        font-size: 0.8em;
        padding: 0.5em 1em;
        border-radius: 999px;
    }

    /* Retake Button */
    .btn-lg {
        font-weight: 600;
    }
</style>
@endpush
