@extends('layouts.main')

@section('content')
<div class="container-fluid">
    @include('admin.partials.breadcrumbs', ['pageTitle' => 'All Quizzes'])

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">📚 All Quizzes</h2>
        <a href="{{ route('admin.quizzes.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle"></i> Add Quiz
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Lesson</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Created At</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $quiz)
                            <tr>
                                <td class="fw-semibold">{{ $quiz->id }}</td>
                                <td>{{ $quiz->lesson->title ?? 'N/A' }}</td>
                                <td>{{ $quiz->title }}</td>
                                <td>{{ Str::limit($quiz->description, 50) }}</td>
                                <td>{{ $quiz->created_at->format('d M Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.questions.create', $quiz->id) }}"
                                       class="btn btn-sm btn-outline-success me-2">
                                       <i class="bi bi-plus-lg"></i> Add Question
                                    </a>
                                    <a href="{{ route('admin.questions.index', $quiz->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                       <i class="bi bi-list-task"></i> Manage
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3"></i><br>
                                    No quizzes found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
