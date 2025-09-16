@extends('layouts.main')

@section('title')
Category of - COurse
@endsection

@section('styles')
<style>
    /* Import a modern font from Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

body {
    background-color: #f0f2f5; /* A soft, light gray background */
    font-family: 'Poppins', sans-serif; /* A clean, modern sans-serif font */
    color: #4a4a4a; /* Dark gray for better readability */
}

.card {
    border: none; /* Remove default border */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-5px); /* A subtle lift effect on hover */
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); /* Softer, more pronounced shadow on hover */
}

/* Header Gradient Style */
.card-header-gradient {
    background: linear-gradient(90deg, #4e73df, #5a5cd1); /* Modern blue-purple gradient */
    color: #ffffff; /* White text for contrast */
    border-bottom: 2px solid #3c5bb2; /* A subtle line at the bottom */
}

/* Form control styling */
.form-control {
    border: 1px solid #ced4da;
    transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.form-control:focus {
    border-color: #5a5cd1; /* Highlight with a secondary color on focus */
    box-shadow: 0 0 0 0.25rem rgba(90, 92, 209, 0.25); /* Subtle glowing effect */
}

/* Primary Button Styling */
.button-primary {
    background: linear-gradient(45deg, #4e73df, #224abe); /* A professional, primary button color */
    color: #fff;
    border: none;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.2s ease;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.button-primary:hover {
    background: linear-gradient(45deg, #224abe, #4e73df); /* Reverse gradient on hover */
    transform: translateY(-2px); /* A slight lift on hover */
    color: #fff; /* Ensure text color remains white */
}

/* Link styling */
.form-text a {
    color: #4e73df; /* Use the primary color for links */
    text-decoration: none;
    transition: color 0.2s ease;
}

.form-text a:hover {
    color: #224abe; /* Darken on hover */
    text-decoration: underline;
}
</style>
@endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                {{-- Updated Header Class --}}
                <div class="card-header text-white text-center fw-bold card-header-gradient">
                    <i class="bi bi-folder-plus me-2"></i> Add New Category
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Category Name</label>
                            <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" placeholder="e.g. Web Development" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Description</label>
                            <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Short description...">{{ old('description') }}</textarea>
                        </div>

                        {{-- Icon --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Icon (Bootstrap Icon Class)</label>
                            <input type="text" name="icon" class="form-control rounded-3" placeholder="e.g. bi bi-code-slash" value="{{ old('icon') }}">
                            <div class="form-text">Use any <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icon</a> class name</div>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="button-primary py-2 rounded-3">
                                <i class="bi bi-save me-1"></i> Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection