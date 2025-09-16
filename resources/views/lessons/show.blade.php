@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3">{{ $lesson->title }}</h1>
    <p class="text-muted">Course: {{ $lesson->course->title }}</p>

    @if($lesson->video_path)
    <p><a href="{{ $lesson->video_path }}" target="_blank" class="btn btn-outline-primary">Watch Video</a></p>
    @endif

    <div class="mb-3">
        {!! nl2br(e($lesson->content)) !!}
    </div>

    <a href="{{ route('admin.lessons.edit', $lesson) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Delete this lesson?')">Delete</button>
    </form>
    <a href="{{ route('admin.lessons.index') }}" class="btn btn-secondary">Back to Lessons</a>

   <!-- @if($course->quizzes->count())
    <div class="text-center my-5">
        <a href="{{ route('admin.course.myquizzes', $course->id) }}" target="_blank" class="btn btn-lg btn-primary custom-btn">
            <i class="bi bi-clipboard-check me-2"></i>
            View All {{ $course->quizzes->count() }} {{ Str::plural('Quiz', $course->quizzes->count()) }}
        </a>
    </div>
@else
    <p class="text-muted mt-5 text-center">No quizzes added yet.</p>
@endif -->


</div>
@endsection