@extends('layouts.master')

@section('styles')
<style>
    :root {
        --primary-color: #007bff;
        --secondary-color: #6c757d;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --warning-color: #ffc107;
        --dark-color: #212529;
        --light-color: #f8f9fa;
        --card-bg: #ffffff;
        --font-family-base: "Poppins", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    body {
        background-color: var(--light-color);
        font-family: var(--font-family-base);
        color: var(--dark-color);
    }

    /* Hero Section */
    .hero-banner-container {
        height: 420px;
        border-bottom-left-radius: 2rem;
        border-bottom-right-radius: 2rem;
        overflow: hidden;
    }

    .hero-banner-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.6);
        transition: transform 0.6s ease;
    }

    .hero-banner-container:hover .hero-banner-image {
        transform: scale(1.08);
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.2));
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 2rem;
        backdrop-filter: blur(3px);
    }

    .display-4 {
        font-size: 2.8rem;
        text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.8);
    }

    .lead {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.85);
    }

    .price-tag {
        color: var(--warning-color);
        font-size: 1.5rem;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
    }

    /* Buttons */
    .custom-btn {
        padding: 0.8rem 2.2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
    }

    .custom-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.3);
    }

    /* Section Titles */
    .section-title {
        font-size: 1.6rem;
        position: relative;
        margin-bottom: 1.5rem;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 4px;
        background-color: var(--primary-color);
        margin-top: 0.5rem;
        border-radius: 2px;
    }

    /* Lesson Cards */
    .lesson-card {
        transition: all 0.3s ease;
        border-radius: 1rem;
        overflow: hidden;
    }

    .lesson-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
    }

    .lesson-media-container {
        position: relative;
        padding-top: 56.25%;
        background: #e9ecef;
    }

    .lesson-media-container iframe,
    .lesson-media-container video,
    .lesson-media-container .placeholder-media {
        position: absolute;
        top: 0; left: 0;
        width: 100%;
        height: 100%;
        border-radius: 1rem 1rem 0 0;
    }

    .placeholder-media {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #6c757d;
        background: #f1f3f5;
        font-size: 0.9rem;
        font-weight: 600;
    }

    .lesson-content-preview {
        color: #555;
        font-size: 0.9rem;
        line-height: 1.5;
        -webkit-line-clamp: 3;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Quiz Section */
    .quiz-section {
        margin-top: 3rem;
        padding: 1.5rem;
        background: var(--card-bg);
        border-radius: 1rem;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    .list-group-item {
        border: none;
        padding: 1rem 1.25rem;
        border-radius: 0.75rem;
        margin-bottom: 0.75rem;
        background: #f8f9fa;
        transition: all 0.2s ease;
    }

    .list-group-item:hover {
        background: #e9f2ff;
        transform: translateX(5px);
    }

    /* Responsive */
    @media (min-width: 768px) {
        .display-4 {
            font-size: 3.5rem;
        }
    }
</style>

@endsection

@section('content')
<div class="course-show">
    {{-- Hero Section --}}
    <div class="hero-banner-container bg-black position-relative overflow-hidden mb-5">
        <img src="{{ $course->thumbnail_path ?? 'https://media.istockphoto.com/id/2192707526/photo/e-learning-platforms-hands-of-robot-hold-e-learning-management-system-tools-digital-education.jpg?s=612x612&w=0&k=20&c=ZL--Gb-mCLHg5TuvgY9NY7ssMMNzjKFg_dbILR2gLV8=' }}"
            alt="{{ $course->title }}" class="hero-banner-image">
        <div class="hero-overlay p-4 p-md-5 d-flex flex-column justify-content-end">
            <div class="container-fluid text-white">
                <h1 class="display-4 fw-bold mb-2">{{ $course->title }}</h1>
                <p class="lead mb-1">By {{ $course->instructor->name }}</p>
                <p class="mb-3 d-none d-lg-block">{{ $course->description }}</p>
                <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                    <span class="price-tag fw-bold fs-4">
                        {{ $course->price > 0 ? 'PKR ' . number_format($course->price) : 'Free' }}
                    </span>
                    {{-- Enroll / Buy / Unenroll Buttons --}}
                    @if (!$enrolled)
                    @if ($course->price > 0)
                    <form action="{{ route('enrollments.store', $course) }}" method="post">
                        @csrf
                        <button class="btn btn-success btn-lg custom-btn">Enroll for Free</button>
                    </form>
                    @else
                    <form action="{{ route('checkout.course', $course) }}" method="post">
                        @csrf
                        <button class="btn btn-primary btn-lg custom-btn">Buy Now</button>
                    </form>
                    @endif
                    @else
                    <form action="{{ route('enrollments.destroy', $course) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-lg custom-btn">Unenroll</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content Section --}}
    <div class="container-fluid py-4">
        {{-- Manager Buttons --}}
        @php
        $canManage = auth()->check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('instructor') || auth()->id() === $course->user_id);
        @endphp
        @if ($canManage)
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="{{ route('admin.lessons.index', ['course' => $course->id]) }}" class="btn btn-outline-secondary">
                <i class="bi bi-gear-fill me-2"></i>Manage Lessons
            </a>
            <a href="{{ route('admin.lessons.create') }}?course_id={{ $course->id }}" class="btn btn-primary">
                <i class="bi bi-plus-circle-fill me-2"></i>New Lesson
            </a>
        </div>
        @endif

        {{-- Lessons List --}}
        <h2 class="section-title h4 fw-bold mb-4">Lessons 📚</h2>
        <div class="row g-4">
            @forelse($course->lessons as $lesson)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden lesson-card">
                    <div class="lesson-media-container position-relative">
                        {{-- Video/Image Display --}}
                        @if ($enrolled && ($lesson->video_url || $lesson->video_path))
                        @php
                        // Check if YouTube URL
                        $isYoutube = $lesson->video_url && preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $lesson->video_url, $matches);
                        $videoId = $matches[1] ?? null;
                        @endphp

                        @if ($isYoutube && $videoId)
                        <div class="ratio ratio-16x9">
                            <iframe class="rounded-top-4"
                                src="https://www.youtube.com/embed/{{ $videoId }}"
                                title="{{ $lesson->title }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        @elseif ($lesson->video_path && file_exists(storage_path('app/public/' . $lesson->video_path)))
                        <video class="w-100 rounded-top-4" controls>
                            <source src="{{ asset('storage/' . $lesson->video_path) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                        @else
                        <div class="placeholder-media d-flex align-items-center justify-content-center text-center p-3 rounded-top-4">
                            <span class="text-muted fw-bold">Video not found.</span>
                        </div>
                        @endif
                        @else
                        <div class="placeholder-media d-flex align-items-center justify-content-center text-center p-3 rounded-top-4">
                            <span class="text-muted fw-bold">
                                <i class="bi bi-lock-fill d-block mb-2"></i>
                                {{ $enrolled ? 'No Video' : 'Enroll to view' }}
                            </span>
                        </div>
                        @endif
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="card-title fw-bold mb-2">{{ $lesson->title }}</h5>
                        <div class="text-muted small mb-3 flex-grow-1 lesson-content-preview">
                            @if ($enrolled && $lesson->content)
                            {!! Str::limit(nl2br(e($lesson->content)), 150) !!}
                            @elseif (!$enrolled)
                            <em>Enroll to view content</em>
                            @else
                            <em>No content available.</em>
                            @endif
                        </div>
                        {{-- Manager Controls --}}
                      
                        <div class="d-flex justify-content-end gap-2 mt-auto pt-3 lesson-actions">
                            <a href="{{ route('admin.lessons.edit', $lesson) }}" class="btn btn-sm btn-action edit-btn" title="Edit Lesson">
                                <i class="bi bi-pencil-square"></i>
                                <span class="d-none d-sm-inline ms-1">Edit</span>
                            </a>
                            <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-action delete-btn" onclick="return confirm('Are you sure you want to delete this lesson?')" title="Delete Lesson">
                                    <i class="bi bi-trash-fill"></i>
                                    <span class="d-none d-sm-inline ms-1">Delete</span>
                                </button>
                            </form>
                           @if($course->quizzes->count())
                                <a href="{{ route('admin.course.myquizzes', $course->id) }}" target="_blank" class="btn btn-sm btn-action edit-btn">
                                    <i class="bi bi-clipboard-check me-2"></i>
                                    View All {{ $course->quizzes->count() }} {{ Str::plural('Quiz', $course->quizzes->count()) }}
                                </a>
                        @else
                            <p class="text-muted mt-5 text-center">No quizzes added yet.</p>
                        @endif

                        </div>
                       
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>No lessons have been added to this course yet.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

<style>
    :root {
        --primary-color: #007bff;
        --secondary-color: #6c757d;
        --success-color: #28a745;
        --danger-color: #dc3545;
        --dark-color: #343a40;
        --light-color: #f8f9fa;
        --card-bg: #ffffff;
        --font-family-base: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    body {
        background-color: var(--light-color);
        font-family: var(--font-family-base);
        color: var(--dark-color);
    }

    /* Hero Banner */
    .hero-banner-container {
        height: 400px;
        border-bottom-left-radius: 2rem;
        border-bottom-right-radius: 2rem;
    }

    .hero-banner-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.7);
        transition: transform 0.5s ease;
    }

    .hero-banner-container:hover .hero-banner-image {
        transform: scale(1.05);
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.1));
    }

    .display-4 {
        font-size: 2.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    .lead {
        font-size: 1.15rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .price-tag {
        color: #ffc107;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }

    .custom-btn {
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-success {
        background-color: var(--success-color);
        border-color: var(--success-color);
    }

    .btn-danger {
        background-color: var(--danger-color);
        border-color: var(--danger-color);
    }

    .btn-outline-secondary {
        border-color: var(--secondary-color);
        color: var(--secondary-color);
    }

    .btn-outline-secondary:hover {
        background-color: var(--secondary-color);
        color: white;
    }

    /* Lessons Section */
    .section-title {
        position: relative;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 50px;
        height: 3px;
        background-color: var(--primary-color);
        margin-top: 0.5rem;
    }

    .lesson-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        background: var(--card-bg);
    }

    .lesson-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .lesson-media-container {
        padding-top: 56.25%;
        /* 16:9 Aspect Ratio */
        background-color: #e9ecef;
    }

    .lesson-media-container iframe,
    .lesson-media-container video,
    .lesson-media-container .placeholder-media {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .placeholder-media {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #6c757d;
        background-color: #f1f3f5;
    }

    .lesson-content-preview {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        /* Limit to 3 lines */
        -webkit-box-orient: vertical;
    }

    /* Responsive Adjustments */
    @media (min-width: 768px) {
        .display-4 {
            font-size: 3.5rem;
        }
    }
</style>
