<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;

class AdminController extends Controller
{
    //
    public function analytics()
    {
        $courses = Course::with('quizzes.attempts')->get();

        // === Course-wise Stats ===
        $courseStats = $courses->map(function ($course) {
            $totalAttempts = 0;
            $passed        = 0;

            foreach ($course->quizzes as $quiz) {
                $totalAttempts += $quiz->attempts->count();
                $passed += $quiz->attempts->where('passed', 1)->count();
            }

            $passRate = $totalAttempts > 0
            ? round(($passed / $totalAttempts) * 100, 2)
            : 0;

            return [
                'course'         => $course->title,
                'total_attempts' => $totalAttempts,
                'passed'         => $passed,
                'pass_rate'      => $passRate,
            ];
        });

        // === Quiz-wise Stats ===
        $quizStats = Quiz::with(['course'])
            ->withCount([
                'attempts',
                'attempts as passed_count' => function ($q) {
                    $q->where('passed', 1);
                },
            ])
            ->get()
            ->map(function ($quiz) {
                $passRate = $quiz->attempts_count > 0
                ? round(($quiz->passed_count / $quiz->attempts_count) * 100, 2)
                : 0;

                return [
                    'quiz'           => $quiz->title,
                    'course'         => $quiz->course->title ?? '-',
                    'total_attempts' => $quiz->attempts_count,
                    'passed'         => $quiz->passed_count,
                    'failed'         => $quiz->attempts_count - $quiz->passed_count,
                    'pass_rate'      => $passRate,
                ];
            });

        return view('admin.analytics', compact('courseStats', 'quizStats'));
    }

    function faq()
    {
        return view('admin.faq');

    }

    // 
    function messages()
    {
        
    }

    public function index()
    {

        $users = User::all();
        return view('admin.allusers', compact('users'));
    }

    function destroyUser($id)
    {
        $users = User::find($id);

        if($users)
        {
          $users->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        }
       

    }


    // home page browse category
    public function home()
{
    $categories = Category::withCount('courses')->get();
    return view('home', compact('categories'));
}
   

}
