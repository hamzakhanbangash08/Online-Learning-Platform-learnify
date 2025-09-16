@extends('layouts.main')

@section('styles')
<style>
    .btn-primarys
    {
        background-color: #4e73df;
        border-color: #4e73df;
        color: #fff;
        border: none;
        padding: 10px 20px;

    }
</style>
@endsection
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Card -->
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white py-3">
                    <a href="{{ route('admin.quizzes.index') }}" class="mb-0"><i class="bi bi-plus-circle"></i> Create New Quiz</a>
                </div>
                <div class="card-body p-4">
                    <!-- Form -->
                    <form action="{{ route('admin.quizzes.store') }}" method="POST">
                        @csrf

                        <!-- Lesson -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📘 Select Lesson</label>
                            <select name="lesson_id" class="form-select" required>
                                <option value="">-- Choose Lesson --</option>
                                @foreach($lessons as $lesson)
                                    <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Quiz Title -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📝 Quiz Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter quiz title..." required>
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">🖊️ Description</label>
                            <textarea name="description" rows="4" class="form-control" placeholder="Write short description..."></textarea>
                        </div>
                        <!-- Max Attempts -->
<div class="mb-3">
    <label for="max_attempts" class="form-label fw-semibold">♻️ Max Attempts</label>
    <input type="number" name="max_attempts" id="max_attempts"
           class="form-control"
           value="{{ old('max_attempts', 1) }}" min="0" required>
    <small class="text-muted">Set 0 for unlimited attempts</small>
</div>


                        <div class="mb-3">
    <label for="duration_minutes" class="form-label">Quiz Duration (minutes)</label>
    <input type="number" name="duration_minutes" id="duration_minutes"
           class="form-control" value="{{ old('duration_minutes', $quiz->duration_minutes ?? 0) }}">
    <small class="text-muted">Set 0 for No Limit</small>
</div>


                        <!-- Buttons -->
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class=" btn-primarys">
                                <i class="bi bi-save"></i> Save Quiz
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- End Card -->

        </div>
    </div>
</div>
@endsection
