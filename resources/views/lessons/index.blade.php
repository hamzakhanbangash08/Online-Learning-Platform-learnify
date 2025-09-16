@extends('layouts.main')
@section('title', 'Lessons')
@section('content')
<div class="container">
   @section('page-title')
   <h1 class="h3">Lessons</h1>
   @endsection
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('admin.lessons.create') }}" class="btn btn-primary">+ New Lesson</a>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back to Courses</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Course</th>
                <th>Title</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lessons as $lesson)
            <tr>
                <td>{{ $lesson->id }}</td>
                <td>{{ $lesson->course->title }}</td>
                <td>{{ $lesson->title }}</td>
                <td>{{ $lesson->position }}</td>
                <td>
                    <a href="{{ route('admin.lessons.show', $lesson) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('admin.lessons.edit', $lesson) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.lessons.destroy', $lesson) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this lesson?')">Delete</button>
                    </form>
                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-sm btn-secondary">Add Quizzes</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
