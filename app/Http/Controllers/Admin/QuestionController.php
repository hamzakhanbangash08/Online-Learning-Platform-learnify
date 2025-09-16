<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // ✅ Show all questions of a quiz
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('options')->get();
        return view('admin.questions.index', compact('quiz', 'questions'));
    }

    // ✅ Show create form
    public function create(Quiz $quiz)
    {
        return view('admin.questions.create', compact('quiz'));
    }

    // ✅ Store new question
    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'question_text' => 'required|string|max:255',
            'question_type' => 'required|in:mcq,true_false',
        ]);

        $question = $quiz->questions()->create([
            'question_text' => $request->question_text,
            'question_type' => $request->question_type,
        ]);

        // Agar true/false hai to default options create kar dete hain
        if ($request->question_type === 'true_false') {
            $question->options()->createMany([
                ['option_text' => 'True', 'is_correct' => true],
                ['option_text' => 'False', 'is_correct' => false],
            ]);
        }

        return redirect()->route('admin.questions.index', $quiz->id)->with('success', 'Question added successfully!');
    }

  public function destroy($quizId, $questionId)
    {
        // 1. Question ko fetch karo jo given quiz se belong karta ho
        $question = Question::where('quiz_id', $quizId)->findOrFail($questionId);

        // 2. Question ko delete karo
        $question->delete();

        // 3. Redirect karo questions list pe success message ke sath
        return redirect()
            ->route('admin.questions.index', $quizId)
            ->with('success', 'Question deleted successfully!');
    }
}
