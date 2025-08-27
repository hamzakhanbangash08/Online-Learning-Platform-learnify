@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-bold">
                    Create New Course
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter course title" required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" rows="4" class="form-control" placeholder="Write a short description..."></textarea>
                        </div>

                        {{-- Price --}}
                        <div class="mb-3">
                            <label class="form-label">Price (PKR)</label>
                            <input type="number" name="price" step="0.01" value="0" class="form-control">
                            <div class="form-text">Leave 0 for free course</div>
                        </div>

                        {{-- Thumbnail --}}
                        <div class="mb-3">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail_path" class="form-control" accept="image/*">
                            <div class="form-text">Upload an image for the course thumbnail</div>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
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