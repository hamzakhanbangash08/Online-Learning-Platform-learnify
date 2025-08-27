@extends('layouts.master')

@section('content')
<div class="course-list-page py-5">
    <div class="container">
        {{-- Header with Action Button --}}
        <div class="d-flex justify-content-between align-items-center mb-5 flex-wrap gap-3">
            <h1 class="display-5 fw-bold text-dark">Explore Our Courses ✨</h1>
            @role('admin|instructor')
            <a href="{{ route('courses.create') }}" class="btn btn-primary custom-btn-lg">
                <i class="bi bi-plus-circle-fill me-2"></i> New Course
            </a>
            @endrole
        </div>

        {{-- Course Cards Grid --}}
        <div class="row g-4 justify-content-center">
            @forelse($courses as $course)
            <div class="col-12 col-sm-6 col-md-6 col-lg-4 d-flex">
                <a href="{{ route('courses.show', $course) }}" class="course-card-link w-100">
                    <div class="card h-100 border-0 shadow-lg rounded-4 overflow-hidden course-card">
                        <div class="course-thumbnail-container">
                            @if($course->thumbnail_path && file_exists(storage_path('app/public/' . $course->thumbnail_path)))
                            <img src="{{ asset('storage/' . $course->thumbnail_path) }}"
                                class="card-img-top course-thumbnail" alt="{{ $course->title }}">
                            @else
                            <div class="placeholder-thumbnail d-flex align-items-center justify-content-center bg-light text-muted">
                                <i class="bi bi-image-fill fs-1"></i>
                            </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <h5 class="card-title fw-bold text-dark mb-1">{{ $course->title }}</h5>
                            <p class="card-text text-muted small mb-2">
                                By <strong class="text-primary">{{ $course->instructor->name }}</strong>
                            </p>
                            <div class="mt-auto d-flex justify-content-between align-items-center pt-3">
                                <span class="price-tag fw-bold fs-4 text-success">
                                    {{ $course->price > 0 ? 'PKR ' . number_format($course->price) : 'Free' }}
                                </span>
                                <span class="badge bg-primary-subtle text-primary">
                                    {{ $course->lessons->count() }} Lessons
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center py-5 rounded-4" role="alert">
                    <h4 class="alert-heading fw-bold">No Courses Found! 😔</h4>
                    <p class="mb-0">It looks like there are no courses available at the moment. Please check back later.</p>
                </div>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <!-- @if($courses->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $courses->links() }}
        </div>
        @endif -->
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    :root {
        --primary-color: #007bff;
        --secondary-color: #6c757d;
        --dark-color: #212529;
        --light-color: #f8f9fa;
        --card-bg: #ffffff;
        --font-family-base: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    body {
        background-color: var(--light-color);
        font-family: var(--font-family-base);
        color: var(--dark-color);
    }

    .course-list-page {
        background-color: #f4f7f9;
        min-height: 100vh;
    }

    .display-5 {
        font-size: clamp(2rem, 5vw, 2.5rem);
    }

    .custom-btn-lg {
        padding: 0.85rem 2.25rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .custom-btn-lg:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        background-color: #004494;
        border-color: #004494;
    }

    .card-img-top {
        height: 200px;
    }

    /* Course Card Styling */
    .course-card-link {
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .course-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: var(--card-bg);
        border: 1px solid #e0e0e0;
    }

    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .course-thumbnail-container {
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .course-thumbnail {
        width: 100%;
        height: 100%;
        height: 200px;
        transition: transform 0.4s ease;
    }

    .course-card:hover .course-thumbnail {
        transform: scale(1.1);
    }

    .placeholder-thumbnail {
        width: 100%;

        height: 100%;
    }

    .card-title {
        color: var(--dark-color);
    }

    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .price-tag {
        color: #28a745;
    }

    /* Badge Styling */
    .badge {
        padding: 0.5em 1em;
        font-size: 0.8em;
        font-weight: 600;
        border-radius: 20px;
    }

    .bg-primary-subtle {
        background-color: rgba(0, 123, 255, 0.1) !important;
    }
</style>
@endpush