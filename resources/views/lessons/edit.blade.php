@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            <!-- Card -->
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-warning text-dark py-3">
                    <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Lesson</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('lessons.update', $lesson) }}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        @method('PUT')

                        <!-- Course -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📚 Course</label>
                            <select name="course_id" class="form-select" required>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $lesson->course_id == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📝 Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $lesson->title }}" required>
                        </div>

                        <!-- Content (Summernote) -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📖 Content</label>
                            <textarea name="content" id="summernote" rows="5" class="form-control">{{ $lesson->content }}</textarea>
                        </div>

                        <!-- Video Upload -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">🎥 Upload Video File</label>
                            <input type="file" name="video_path" class="form-control" accept="video/*">
                            @if($lesson->video_path)
                                <small class="text-muted d-block mt-1">Current file: {{ basename($lesson->video_path) }}</small>
                            @endif
                            <small class="text-muted">Supported formats: MP4, WebM etc. (optional if using Video URL)</small>
                        </div>

                        <!-- Video URL -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">🌐 Video URL (YouTube)</label>
                            <input type="url" name="video_url" class="form-control" value="{{ $lesson->video_url }}">
                        </div>

                        <!-- Position -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">🔢 Position</label>
                            <input type="number" name="position" class="form-control" value="{{ $lesson->position }}">
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.lessons.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-warning text-white">
                                <i class="bi bi-save"></i> Update Lesson
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- End Card -->

        </div>
    </div>
</div>

<!-- Summernote CSS + JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
$(document).ready(function() {
    $('#summernote').summernote({
        placeholder: 'Edit lesson content here...',
        tabsize: 2,
        height: 250,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['fontsize', 'color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview']]
        ]
    });
});
</script>
@endsection
