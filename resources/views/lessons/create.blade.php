@extends('layouts.main')

@section('styles')
<style>
   /* Truncate text inside option for small screens */
@media (max-width: 500px) {
    .course-select option {
        display: inline-block;
        max-width: 200px; /* zarurat ke mutabiq adjust karo */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
}


</style>
@endsection
@section('content')
<div class="container">
    <div class="row px-0 justify-content-center">
        <div class="col-md-6 px-0">

            {{-- Updated Card classes --}}
            <div class="card shadow-lg border-0 rounded-4">
                {{-- Updated Header classes --}}
                <div class="card-header text-white text-center fw-bold card-header-gradient py-3">
                    <h4 class="mb-0"><i class="bi bi-journal-plus"></i> Create Lesson</h4>
                </div>
                <div class="card-body p-4">

                    <form action="{{ route('admin.lessons.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">📚 Course</label>
                            {{-- Updated Form Control classes --}}
                          <select name="course_id" class="form-select rounded-3 course-select" required>
    @foreach($courses as $course)
        <option value="{{ $course->id }}">{{ $course->title }}</option>
    @endforeach
</select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">📝 Title</label>
                            {{-- Updated Form Control classes --}}
                            <input type="text" name="title" class="form-control rounded-3" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">📖 Content</label>
                            {{-- Updated Form Control classes --}}
                            <textarea name="content" id="summernote" rows="5" class="form-control rounded-3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">🎬 Upload Video (local file)</label>
                            {{-- Updated Form Control classes --}}
                            <input type="file" name="video_path" class="form-control rounded-3" accept="video/*">
                            <small class="text-muted">Upload MP4, WebM, etc. (optional if using Video URL)</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">🌐 Or Video URL (YouTube)</label>
                            {{-- Updated Form Control classes --}}
                            <input type="url" name="video_url" class="form-control rounded-3">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">🔢 Position</label>
                            {{-- Updated Form Control classes --}}
                            <input type="number" name="position" class="form-control rounded-3" value="1">
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <!-- dynamic components -->
                          <!-- <x-dynamic-button href="{{ route('admin.lessons.index') }}" variant="vibrant_teal" icon="arrow-left" class="mx-2">Cancel is</x-dynamic-button> -->

                          {{-- 7. Link Button (Bootstrap Variant) --}}
<x-dynamic-button href="{{ route('admin.lessons.index') }}" variant="ocean_blue" class="mx-2" icon="arrow-left">cancel</x-dynamic-button>

                            {{-- 8. Submit Button (Bootstrap Variant) --}}
                            <!-- <x-dynamic-button type="submit" variant="vibrant_teal" icon="save" class="mx-2">Save Lesson</x-dynamic-button> -->

                            {{-- Updated Button classes --}}
                            <!-- <button type="submit" class="button-primary py-2 rounded-3">
                                <i class="bi bi-save"></i> Save Lesson
                            </button> -->


{{-- Submit Button --}}
    <x-dynamic-button type="submit" variant="emerald" icon="check-circle">
        Save Category
    </x-dynamic-button>
                        </div>
                    </form>

                </div>
            </div>
            </div>
    </div>
</div>

@endsection

@section('scripts')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write lesson content here...',
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

    // text
   document.addEventListener("DOMContentLoaded", function () {
    function truncateOptions() {
        let isSmall = window.innerWidth <= 500;
        document.querySelectorAll(".course-select option").forEach(opt => {
            let original = opt.getAttribute("data-full") || opt.textContent;
            opt.setAttribute("data-full", original); // original save

            if (isSmall) {
                let words = original.split(" ");
                if (words.length > 2) {
                    opt.textContent = words.slice(0, 2).join(" ") + "...";
                } else {
                    opt.textContent = original;
                }
            } else {
                opt.textContent = original;
            }
        });
    }

    truncateOptions();
    window.addEventListener("resize", truncateOptions);
});
</script>
@endsection
