<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('lesson')->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $lessons = Lesson::all();
        return view('admin.quizzes.create', compact('lessons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lesson_id'        => 'required|exists:lessons,id',
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'duration_minutes' => 'required|integer|min:0',
            'max_attempts'     => 'required|integer|min:0',
        ]);

      

        Quiz::create([
            'lesson_id'        => $request->lesson_id,
            'course_id'        => Lesson::find($request->lesson_id)->course_id,
            'title'            => $request->title,
            'description'      => $request->description,
            'duration_minutes' => $request->duration_minutes,
            'max_attempts'     => $request->max_attempts,
        ]);

        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz created!');
    }

    public function quizpage(Course $course)
    {
        $quizzes = $course->quizzes; // or apply filters if needed
        return view('admin.quizzes.quizpage', compact('course', 'quizzes'));
    }

    //
}
