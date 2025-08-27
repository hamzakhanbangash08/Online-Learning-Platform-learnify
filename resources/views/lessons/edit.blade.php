@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="h3 mb-3">Edit Lesson</h1>

    <form action="{{ route('lessons.update', $lesson) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="course_id" class="form-select" required>
                @foreach($courses as $course)
                <option value="{{ $course->id }}" {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                    {{ $course->title }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $lesson->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" rows="4" class="form-control">{{ $lesson->content }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Video URL</label>
            <input type="url" name="video_url" class="form-control" value="{{ $lesson->video_url }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="number" name="position" class="form-control" value="{{ $lesson->position }}">
        </div>

        <button type="submit" class="btn btn-success">Update Lesson</button>
        <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection