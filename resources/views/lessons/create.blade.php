@extends('layouts.master')

@section('content')
<div class="container">
    <h1 class="h3 mb-3">Create Lesson</h1>

    <form action="{{ route('lessons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Course</label>
            <select name="course_id" class="form-select" required>
                @foreach($courses as $course)
                <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" rows="4" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Video (local file)</label>
            <input type="file" name="video_path" class="form-control" accept="video/*">
            <small class="text-muted">Upload MP4, WebM, etc. (optional if using Video URL)</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Or Video URL (YouTube)</label>
            <input type="url" name="video_url" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Position</label>
            <input type="number" name="position" class="form-control" value="1">
        </div>

        <button type="submit" class="btn btn-success">Save Lesson</button>
        <a href="{{ route('lessons.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection