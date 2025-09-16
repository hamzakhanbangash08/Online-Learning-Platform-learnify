@extends('layouts.main')
@section('title', 'Courses')

@section('styles')

<style>
    .table {
    border-radius: 12px;
    overflow: hidden;
}
</style>
@endsection
@section('page-title')
   <h1 class="h3">Courses</h1>
@endsection

@section('content')
{{-- Courses Table --}}
<div class="table-responsive">
    <table id="mytable" class="table table-striped table-hover align-middle shadow-sm rounded-4 overflow-hidden">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Thumbnail</th>
                <th scope="col">Title</th>
                <th scope="col">Instructor</th>
                <th scope="col">Price</th>
                <th scope="col">Lessons</th>
                <th scope="col" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $index => $course)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    @if($course->thumbnail_path && file_exists(storage_path('app/public/' . $course->thumbnail_path)))
                        <img src="{{ asset('storage/' . $course->thumbnail_path) }}" 
                             alt="{{ $course->title }}" 
                             class="img-thumbnail" 
                             style="width: 60px; height: 40px; object-fit: cover;">
                    @else
                        <span class="text-muted"><i class="bi bi-image-fill"></i></span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('courses.show', $course) }}" class="fw-bold text-decoration-none text-dark">
                        {{ $course->title }}
                    </a>
                </td>
                <td><span class="badge bg-primary">{{ $course->instructor->name }}</span></td>
                <td class="fw-bold text-success">
                    {{ $course->price > 0 ? 'PKR ' . number_format($course->price) : 'Free' }}
                </td>
                <td>
                    <span class="badge bg-info">{{ $course->lessons->count() }} Lessons</span>
                </td>
                <td class="text-center">
                    <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-info me-2">
                        <i class="bi bi-eye"></i>
                    </a>
                    @role('admin|instructor')
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-outline-warning me-2">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    @endrole
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-5">
                    <div class="alert alert-info mb-0 rounded-4">
                        <h5 class="fw-bold">No Courses Found! 😔</h5>
                        <p class="mb-0">It looks like there are no courses available at the moment. Please check back later.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection