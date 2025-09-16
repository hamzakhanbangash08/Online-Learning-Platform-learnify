@extends('layouts.master')

@section('content')
<div class="container py-5">

    {{-- Back Button --}}
    <div class="mb-4">
        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle me-2"></i> Back to Course
        </a>
    </div>

    {{-- Title --}}
    <h1 class="mb-4 fw-bold text-primary">
        <i class="bi bi-question-circle me-2"></i> Quizzes for: {{ $course->title }}
    </h1>

    @if($quizzes->count())
        <div class="row g-4">
            @foreach($quizzes as $quiz)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 quiz-card">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold">{{ $quiz->title }}</h5>
                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit($quiz->description ?? 'No description provided.', 100) }}
                            </p>
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <span class="badge bg-primary">Quiz #{{ $loop->iteration }}</span>
                                <a href="{{ route('quiz.start', $quiz->id) }}" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-play-circle me-1"></i> Take Quiz
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info mt-4 text-center">
            <i class="bi bi-info-circle me-2"></i>No quizzes available for this course.
        </div>
    @endif

</div>
@endsection

@push('styles')
<style>
    .quiz-card {
        border-radius: 1rem;
        transition: all 0.3s ease;
    }
    .quiz-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .quiz-card .card-title {
        color: #0d6efd;
    }
</style>
@endpush
