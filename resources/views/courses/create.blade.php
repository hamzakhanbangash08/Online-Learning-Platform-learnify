@extends('layouts.main')
@section('styles')
<style>
    /* Import a modern font from Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

body {
    background-color: #f0f2f5;
    font-family: 'Poppins', sans-serif;
    color: #4a4a4a;
}

.card {
    border: none;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

/* Header Gradient Style */
.card-header-gradient {
    background: linear-gradient(90deg, #4e73df, #5a5cd1);
    color: #ffffff;
    border-bottom: 2px solid #3c5bb2;
}

/* Form control styling */
.form-control, .form-select {
    border: 1px solid #ced4da;
    transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #5a5cd1;
    box-shadow: 0 0 0 0.25rem rgba(90, 92, 209, 0.25);
}

/* Primary Button Styling */
.button-primary {
    background: linear-gradient(45deg, #4e73df, #224abe);
    color: #fff;
    border: none;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.button-primary:hover {
    background: linear-gradient(45deg, #224abe, #4e73df);
    transform: translateY(-2px);
    color: #fff;
}

/* Link styling */
.form-text a {
    color: #4e73df;
    text-decoration: none;
    transition: color 0.2s ease;
}

.form-text a:hover {
    color: #224abe;
    text-decoration: underline;
}
</style>
@endsection
@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                {{-- Updated Header Class --}}
                <div class="card-header text-white text-center fw-bold card-header-gradient">
                    Create New Course
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" name="title" class="form-control rounded-3" placeholder="Enter course title" required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" rows="4" class="form-control rounded-3" placeholder="Write a short description..."></textarea>
                        </div>

                        {{-- Price --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Price (PKR)</label>
                            <input type="number" name="price" step="0.01" value="0" class="form-control rounded-3">
                            <div class="form-text">Leave 0 for free course</div>
                        </div>

                        {{-- Category --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category</label>
                            <select name="category_id" class="form-select rounded-3" required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Thumbnail</label>
                            <input type="file" name="thumbnail_path" class="form-control rounded-3" accept="image/*">
                            <div class="form-text">Upload an image for the course thumbnail</div>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid">
                            {{-- Updated Button Class --}}
                            <button type="submit" class="button-primary py-2 rounded-3">
                                <i class="bi bi-save me-1"></i> Save Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection