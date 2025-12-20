@extends('layouts.main')

@section('content')
<div class="container">

    <div class="row justify-content-center px-0">
        <div class="col-lg-6 col-md-8 col-sm-10 py-0">
             <div class="my-2">
        <a href="{{ route('admin.categories.index') }}" class="button-primary">
            <i class="bi bi-arrow-left"></i> Back to Categories List
        </a>
    </div>
            <form action="{{ route('admin.categories.update', $category->id) }}" 
                  method="POST" class="card shadow p-4">
                @csrf
                @method('PUT')

                <h4 class="text-center mb-4">✏️ Edit Category</h4>

                <div class="mb-3">
                    <label class="form-label fw-bold">Category Name</label>
                    <input type="text" name="name" 
                           class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea name="description" rows="3"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Icon (Bootstrap Icon class or URL)</label>
                    <input type="text" name="icon" 
                           class="form-control @error('icon') is-invalid @enderror" 
                           value="{{ old('icon', $category->icon) }}">
                    @error('icon')
                        <div class="invalid-feedback">⚠ {{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">💾 Update Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
