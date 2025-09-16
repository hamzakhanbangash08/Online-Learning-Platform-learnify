@extends('layouts.master')


@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* ------------------------------------ */
    /* --- Modern, Professional Styling --- */
    /* ------------------------------------ */
    :root {
        --primary-color: #5A67D8; /* Deep blue */
        --primary-light: #EBF4FF; /* Light blue for subtle bg */
        --secondary-color: #6B7280; /* Muted gray */
        --dark-color: #1A202C; /* Charcoal */
        --light-color: #F7FAFC; /* Soft background */
        --accent-color: #48BB78; /* Green price */
        --shadow-color: rgba(0, 0, 0, 0.05);
        --font-family-base: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    }

    body {
        background-color: var(--light-color);
        font-family: var(--font-family-base);
        color: var(--dark-color);
    }

    .course-list-page {
        background-color: var(--light-color);
      
    }

    .display-5 {
        font-size: clamp(2.25rem, 5vw, 2.75rem);
        color: var(--dark-color);
    }

    /* Action Button Styling */
    .custom-btn-lg {
        padding: 0.75rem 2rem;
        border-radius: 999px; /* Pill shape */
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        background-color: var(--primary-color);
        border: none;
        box-shadow: 0 4px 14px var(--shadow-color);
    }

    .custom-btn-lg:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        background-color: #434190;
    }

    /* Course Card Styling */
    .course-card-link {
        text-decoration: none;
        display: block;
        height: 100%;
    }

    .course-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 6px var(--shadow-color);
    }

    .course-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08) !important;
    }

    .course-thumbnail-container {
        width: 100%;
        height: 220px;
        overflow: hidden;
    }

    .course-thumbnail {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .course-card:hover .course-thumbnail {
        transform: scale(1.05);
    }

    .placeholder-thumbnail {
        width: 100%;
        height: 100%;
        background-color: #EDF2F7;
        color: #A0AEC0;
    }

    .card-body {
        padding: 1.5rem;
    }

    .card-title {
        color: var(--dark-color);
        font-weight: 700;
        font-size: 1.25rem;
    }

    .card-text {
        color: var(--secondary-color);
        font-size: 0.95rem;
    }

    .text-primary {
        color: var(--primary-color) !important;
        font-weight: 600;
    }

    .price-tag {
        color: var(--accent-color);
        font-size: 1.6rem;
    }

    /* Badge Styling */
    .badge {
        padding: 0.4em 1em;
        font-size: 0.75em;
        font-weight: 600;
        border-radius: 999px;
    }

    .bg-primary-subtle {
        background-color: var(--primary-light) !important;
        color: var(--primary-color) !important;
    }

    /* Empty State */
    .alert-info {
        background-color: #EBF8FF;
        color: #2C5282;
        border: 1px solid #BEE3F8;
    }
</style>
@endsection
@section('content')
<div class="course-list-page py-5">
    <div class="container">
        {{-- Header with Action Button --}}
        {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Explore Courses</h1>

        @role('admin|instructor')
        <a href="{{ route('courses.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Course
        </a>
        @endrole
    </div>


{{-- Search Dropdown  title in course--}}
<div class="dropdown mb-4">
    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="searchDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-search"></i> Search
    </button>

    <div class="dropdown-menu p-3" style="min-width: 300px;">
        <form method="GET" action="{{ route('courses.index') }}" id="searchForm">
            <div class="position-relative">
                <input type="text" 
                       name="search" 
                       id="searchInput"
                       value="{{ $search ?? '' }}"
                       class="form-control"
                       placeholder="Search by course title...">
                
                <!-- Suggestion list -->
                <ul class="list-group position-absolute w-100 mt-1 shadow-sm d-none" id="suggestionBox" style="z-index: 1050; max-height: 200px; overflow-y: auto;">
                    @foreach($allTitles as $title)
                        <li class="list-group-item list-group-item-action suggestion-item">{{ $title }}</li>
                    @endforeach
                </ul>
            </div>
        </form>
    </div>
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
                                By <strong class="text-primary">{{ $course->instructor->name ?? 'Unknown' }}</strong>
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
    </div>
      {{-- Pagination --}}
    <div class="mt-4">
        {{ $courses->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const suggestionBox = document.getElementById('suggestionBox');
    const items = document.querySelectorAll('.suggestion-item');

    // Show suggestion box on focus
    searchInput.addEventListener('focus', () => {
        suggestionBox.classList.remove('d-none');
    });

    // Hide suggestions if clicked outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionBox.contains(e.target)) {
            suggestionBox.classList.add('d-none');
        }
    });

    // Filter suggestions as user types
    searchInput.addEventListener('input', function() {
        let value = this.value.toLowerCase();
        items.forEach(item => {
            if (item.textContent.toLowerCase().includes(value)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Click on suggestion → fill input + submit
    items.forEach(item => {
        item.addEventListener('click', function() {
            searchInput.value = this.textContent;
            document.getElementById('searchForm').submit();
        });
    });
</script>
@endsection
@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const suggestionBox = document.getElementById('suggestionBox');
    const items = document.querySelectorAll('.suggestion-item');

    // Show suggestion box on focus
    searchInput.addEventListener('focus', () => {
        suggestionBox.classList.remove('d-none');
    });

    // Hide suggestions if clicked outside
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !suggestionBox.contains(e.target)) {
            suggestionBox.classList.add('d-none');
        }
    });

    // Filter suggestions as user types
    searchInput.addEventListener('input', function() {
        let value = this.value.toLowerCase();
        items.forEach(item => {
            if (item.textContent.toLowerCase().includes(value)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });

    // Click on suggestion → fill input + submit
    items.forEach(item => {
        item.addEventListener('click', function() {
            searchInput.value = this.textContent;
            document.getElementById('searchForm').submit();
        });
    });
</script>
@endsection



