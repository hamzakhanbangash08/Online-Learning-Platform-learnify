@extends('layouts.main')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between ">
   <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mb-4"><i class="bi bi-arrow-left"></i> Back to Categories</a>
    <a href="{{ route('admin.categories.create') }}) }}" class="mb-4">➕ Add New Category</a>

    </div>
 
    {{-- Show Errors --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>⚠ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.categories.store') }}" method="POST" class="card shadow p-4">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-bold">Category Name</label>
            <input type="text" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="e.g. Web Development" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">⚠ {{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Description</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Short description">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">⚠ {{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Icon (Bootstrap Icon class or URL)</label>
            <input type="text" name="icon"
                   class="form-control @error('icon') is-invalid @enderror"
                   placeholder="e.g. bi bi-code-slash" value="{{ old('icon') }}">
            @error('icon')
                <div class="invalid-feedback">⚠ {{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Save Category</button>
    </form>
</div>
@endsection
