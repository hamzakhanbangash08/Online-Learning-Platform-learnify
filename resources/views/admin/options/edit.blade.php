@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Edit Option for: {{ $question->question_text }}</h2>

    <form action="{{ route('admin.options.update', [$question->id, $option->id]) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Option Text</label>
            <input type="text" name="option_text" class="form-control" value="{{ $option->option_text }}" required>
        </div>

        <div class="mb-3">
            <label>Is Correct?</label>
            <select name="is_correct" class="form-control">
                <option value="0" {{ !$option->is_correct ? 'selected' : '' }}>No</option>
                <option value="1" {{ $option->is_correct ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Option</button>
    </form>
</div>
@endsection
