@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- Card -->
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0"><i class="bi bi-question-circle"></i> Add Question to Quiz: 
                        <span class="fw-bold">{{ $quiz->title }}</span>
                    </h4>
                </div>

                <div class="card-body p-4">

                    <!-- Form -->
                    <form action="{{ route('admin.questions.store', $quiz->id) }}" method="POST">
                        @csrf

                        <!-- Question Text -->
                        <div class="mb-3">
                            <label for="question_text" class="form-label fw-semibold">📝 Question Text</label>
                            <input 
                                type="text" 
                                name="question_text" 
                                id="question_text" 
                                class="form-control @error('question_text') is-invalid @enderror" 
                                placeholder="Enter your question..." 
                                required>
                            @error('question_text') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <!-- Question Type -->
                        <div class="mb-3">
                            <label for="question_type" class="form-label fw-semibold">📌 Question Type</label>
                            <select 
                                name="question_type" 
                                id="question_type" 
                                class="form-select @error('question_type') is-invalid @enderror" 
                                required>
                                <option value="mcq">Multiple Choice (MCQ)</option>
                                <option value="true_false">True / False</option>
                            </select>
                            @error('question_type') 
                                <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.questions.index', $quiz->id) }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Save Question
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
