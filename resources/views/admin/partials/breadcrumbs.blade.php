<div class="mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.quizzes.index') }}">Quizzes</a>
            </li>

            @isset($quiz)
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.questions.index', $quiz->id) }}">
                        Questions ({{ $quiz->title }})
                    </a>
                </li>
            @endisset

            @isset($question)
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.options.index', $question->id) }}">
                        Options (Q: {{ Str::limit($question->question_text, 20) }})
                    </a>
                </li>
            @endisset

            <li class="breadcrumb-item active" aria-current="page">
                {{ $pageTitle ?? 'Page' }}
            </li>
        </ol>
    </nav>
</div>
