@extends('layouts.master')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">📊 My Quiz Results</h2>

    @if($attempts->count())
        <table class="table table-bordered table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Quiz</th>
                    <th>Score</th>
                    <th>Percentage</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attempts as $index => $attempt)
                    <tr>
                        <td>{{ $attempts->firstItem() + $index }}</td>
                        <td>{{ $attempt->quiz->title }}</td>
                        <td>{{ $attempt->score }} / {{ $attempt->total ?? '?' }}</td>
                        <td>{{ $attempt->percentage ?? 0 }}%</td>
                        <td>
                            @if($attempt->passed)
                                <span class="badge bg-success">Passed</span>
                            @else
                                <span class="badge bg-danger">Failed</span>
                            @endif
                        </td>
                        <td>{{ $attempt->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <a href="{{ route('quiz.result', $attempt->id) }}" class="btn btn-sm btn-outline-primary">
                                View Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

       
    @else
        <div class="alert alert-info">You haven’t attempted any quizzes yet.</div>
    @endif
</div>
@endsection
