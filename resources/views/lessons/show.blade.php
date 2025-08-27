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

    <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="d-inline">
        @csrf @method('DELETE')
        <button class="btn btn-danger" onclick="return confirm('Delete this lesson?')">Delete</button>
    </form>
    <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Back to Lessons</a>
</div>
@endsection