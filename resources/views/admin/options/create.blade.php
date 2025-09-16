@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <!-- Card -->
            <div class="card shadow border-0 rounded-3">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-plus-circle"></i> Add Option for: 
                        <span class="fw-bold">{{ $question->question_text }}</span>
                    </h5>
                </div>
                <div class="card-body p-4">

                    <!-- Form -->
                    <form action="{{ route('admin.options.store', $question->id) }}" method="POST">
                        @csrf

                        <!-- Option Text -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">📝 Option Text</label>
                            <input type="text" name="option_text" class="form-control" placeholder="Enter option text..." required>
                            @error('option_text') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Is Correct -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">✅ Is Correct?</label>
                            <select name="is_correct" class="form-select">
                                <option value="0">❌ No</option>
                                <option value="1">✔️ Yes</option>
                            </select>
                            @error('is_correct') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.options.index', $question->id) }}" class="btn btn-outline-secondary me-2">
                                <i class="bi bi-arrow-left"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-save"></i> Save Option
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
