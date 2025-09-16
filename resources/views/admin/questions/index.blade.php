@extends('layouts.main')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">📝 Questions for Quiz: <span class="text-primary">{{ $quiz->title }}</span></h3>
        <a href="{{ route('admin.questions.create', $quiz->id) }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Question
        </a>
    </div>

    <!-- Breadcrumbs -->
    @include('admin.partials.breadcrumbs', ['quiz' => $quiz, 'pageTitle' => 'Questions'])

    <!-- Success Message -->
    <!-- @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif -->

    <!-- Questions Table -->
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Question</th>
                        <th style="width: 120px;">Type</th>
                        <th>Options</th>
                        <th style="width: 180px;" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($questions as $question)
                        <tr>
                            <td><strong>{{ $question->id }}</strong></td>
                            <td>{{ $question->question_text }}</td>
                            <td>
                                <span class="badge bg-info text-dark">
                                    {{ ucfirst($question->question_type) }}
                                </span>
                            </td>
                            <td>
                                @if($question->options->count() > 0)
                                    <ul class="list-unstyled mb-2">
                                        @foreach($question->options as $opt)
                                            <li>
                                                <i class="bi bi-chevron-right text-secondary"></i>
                                                {{ $opt->option_text }}
                                                @if($opt->is_correct) 
                                                    <span class="badge bg-success ms-1">Correct</span> 
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted fst-italic">No options yet</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex  ">

                               
                                <a href="{{ route('admin.options.create', $question->id) }}" class="btn btn-sm btn-outline-success me-1">
                                    <i class="bi bi-plus-circle"></i> Add Option
                                </a>
                                <a href="{{ route('admin.options.index', $question->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-list-ul"></i> Manage
                                </a>

                               <form action="{{ route('admin.questions.destroy', [$quiz->id, $question->id]) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-outline-danger"
        onclick="return confirm('Are you sure you want to delete this question?');">
        <i class="bi bi-trash"></i> Delete
    </button>
</form>
 </div>


                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle"></i> No questions found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
