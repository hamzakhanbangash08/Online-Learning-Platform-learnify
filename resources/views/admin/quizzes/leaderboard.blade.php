@extends('layouts.main')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">🏆 Leaderboard</h1>
        <a href="{{ route('admin.quizzes.index') }}" class="btn btn-secondary">← Back to Quizzes</a>
    </div>

    @if($leaderboard->count())
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Quiz</th>
                            <th>Best Score</th>
                            <th>Percentage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leaderboard as $index => $row)
                            <tr>
                                <td><strong>{{ $index + 1 }}</strong></td>
                             @php
    $email = strtolower(trim($row->user->email ?? 'guest@example.com'));
    $gravatar = "https://www.gravatar.com/avatar/" . md5($email) . "?s=80&d=identicon";
@endphp

<td>
    <div class="d-flex align-items-center">
        <img src="{{ $gravatar }}" 
             alt="Avatar" class="rounded-circle me-2" width="40" height="40">
        <span>{{ $row->user->name ?? 'Guest' }}</span>
    </div>
</td>

                                <td>{{ $row->quiz->title ?? '—' }}</td>
                                <td>{{ $row->best_score }}</td>
                                <td>
                                    @php
                                        $percent = $row->best_percentage;
                                        $badgeClass = 'bg-danger';
                                        if($percent >= 70) $badgeClass = 'bg-success';
                                        elseif($percent >= 40) $badgeClass = 'bg-warning text-dark';
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $percent }}%
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-info">No leaderboard data available yet.</div>
    @endif
</div>
@endsection
