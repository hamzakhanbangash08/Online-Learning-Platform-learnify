@extends('layouts.main')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Course</h1>

<form action="{{ route('courses.update', $course) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-semibold mb-1">Title</label>
        <input type="text" name="title" class="w-full border rounded px-3 py-2"
            value="{{ old('title', $course->title) }}" required>
    </div>

    <div>
        <label class="block font-semibold mb-1">Description</label>
        <textarea name="description" rows="4" class="w-full border rounded px-3 py-2">{{ old('description', $course->description) }}</textarea>
    </div>

    <div>
        <label class="block font-semibold mb-1">Price (PKR)</label>
        <input type="number" name="price" step="0.01" class="w-full border rounded px-3 py-2"
            value="{{ old('price', $course->price) }}">
        <small class="text-gray-500">Leave 0 for free course</small>
    </div>

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
</form>
@endsection