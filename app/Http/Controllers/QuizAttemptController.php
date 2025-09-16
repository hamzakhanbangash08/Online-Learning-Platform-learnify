<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\Certificate;
use App\Models\QuizAttempt;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuizAttemptController extends Controller
{
    /**
     * Show quiz attempt page (questions + options)
     */
//    public function start(Quiz $quiz)
// {
//     // Load quiz with its questions and options
//     $quiz->load(['questions.options']);
//     return view('quiz.start', compact('quiz'));
// }

    public function start(Quiz $quiz)
    {
        $user = Auth::user();

        // count attempts of this user for this quiz
        $attemptsCount = $quiz->attempts()->where('user_id', $user->id)->count();

        if ($quiz->max_attempts > 0 && $attemptsCount >= $quiz->max_attempts) {
            return redirect()->route('quiz.resultHistory')
                ->with('error', '⚠️ You have reached the maximum attempts for this quiz.');
        }

        $quiz->load('questions.options');
        return view('quiz.start', compact('quiz'));
    }

    /**
     * Handle submission, grade answers, persist attempt & answers, return result
     */
    // public function submit(Request $request, Quiz $quiz)
    // {
    //     $quiz->load('questions.options');
    //     $user = Auth::user();

    //     DB::beginTransaction();
    //     try {
    //         // Create attempt
    //         $attempt = QuizAttempt::create([
    //             'quiz_id'    => $quiz->id,
    //             'user_id'    => $user ? $user->id : null,
    //             'score'      => 0,
    //             'total'      => 0,
    //             'percentage' => 0,
    //             'passed'     => false,
    //         ]);

    //         $score       = 0;
    //         $totalPoints = 0;

    //         foreach ($quiz->questions as $question) {
    //             $points = $question->points ?? 1;
    //             $totalPoints += $points;

    //             // answers[question_id] format
    //             $given = $request->input("answers.{$question->id}", null);

    //             $isCorrect        = false;
    //             $selectedOptionId = null;
    //             $answerText       = null;

    //             if (in_array($question->question_type, ['mcq', 'true_false'])) {
    //                 if (is_numeric($given)) {
    //                     $selectedOptionId = (int) $given;
    //                     $option           = $question->options->firstWhere('id', $selectedOptionId);
    //                 } else {
    //                     $option           = $question->options->firstWhere('option_text', $given);
    //                     $selectedOptionId = $option->id ?? null;
    //                 }

    //                 if (! empty($option) && (bool) $option->is_correct) {
    //                     $isCorrect = true;
    //                 }
    //             } else {
    //                 // Short answer
    //                 $answerText = trim((string) $given);
    //                 if ($question->correct_answer) {
    //                     $isCorrect = strcasecmp($answerText, $question->correct_answer) === 0;
    //                 }
    //             }

    //             if ($isCorrect) {
    //                 $score += $points;
    //             }

    //             QuizAnswer::create([
    //                 'quiz_attempt_id' => $attempt->id,
    //                 'question_id'     => $question->id,
    //                 'option_id'       => $selectedOptionId,
    //                 'answer_text'     => $answerText,
    //                 'is_correct'      => $isCorrect,
    //             ]);
    //         }

    //         // Finalize attempt
    //         $percentage = $totalPoints > 0 ? round(($score / $totalPoints) * 100, 2) : 0;
    //         $passing    = $quiz->passing_score ?? 60;
    //         $passed     = $percentage >= $passing;

    //         $attempt->update([
    //             'score'      => $score,
    //             'total'      => $totalPoints,
    //             'percentage' => $percentage,
    //             'passed'     => $passed,
    //         ]);

    //         // //////

    //        if ($passed && $user) {
    // $filename = 'certificate_' . $quiz->id . '_' . $user->id . '_' . now()->timestamp . '.pdf';
    // $folder   = "certificates/user_{$user->id}";
    // $path     = $folder . '/' . $filename;

    // // make sure directory exists inside public
    // if (!file_exists(public_path($folder))) {
    //     mkdir(public_path($folder), 0777, true);
    // }

    // $data = [
    //     'user'       => $user,
    //     'quiz'       => $quiz,
    //     'attempt'    => $attempt,
    //     'issued_at'  => now(),
    //     'token'      => $token = Str::uuid(),
    //     'score'      => $score,
    //     'total'      => $totalPoints,
    //     'percentage' => $percentage,
    //     'passed'     => $passed,
    //     'date'       => now()->toFormattedDateString(),
    // ];

    // try {
    //     // Save PDF in public folder
    //     $pdf = Pdf::loadView('certificates.template', $data);
    //     $pdf->save(public_path($path));   // 👈 direct save

    //     // Save certificate record in DB
    //     $certificate = Certificate::create([
    //         'user_id'         => $user->id,
    //         'quiz_id'         => $quiz->id,
    //         'quiz_attempt_id' => $attempt->id,
    //         'file_path'       => $path,  // relative to public
    //         'token'           => $data['token'],
    //         'issued_at'       => now(),
    //     ]);

    // } catch (\Exception $ex) {
    //     dd('Certificate generation failed:', $ex->getMessage());
    // }
    //        }
    //         // //////

    //         DB::commit();
    //         return redirect()->route('quiz.result', $attempt->id)
    //             ->with('success', 'Quiz submitted successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', 'An error occurred while submitting the quiz. Please try again.');
    //     }
    // }

    // 
    public function submit(Request $request, Quiz $quiz)
{
    $quiz->load('questions.options');
    $user = Auth::user();

    DB::beginTransaction();
    try {
        // Create attempt
        $attempt = QuizAttempt::create([
            'quiz_id'    => $quiz->id,
            'user_id'    => $user ? $user->id : null,
            'score'      => 0,
            'total'      => 0,
            'percentage' => 0,
            'passed'     => false,
        ]);

        $score       = 0;
        $totalPoints = 0;

        foreach ($quiz->questions as $question) {
            $points = $question->points ?? 1;
            $totalPoints += $points;

            $given = $request->input("answers.{$question->id}", null);

            $isCorrect        = false;
            $selectedOptionId = null;
            $answerText       = null;

            if (in_array($question->question_type, ['mcq', 'true_false'])) {
                if (is_numeric($given)) {
                    $selectedOptionId = (int) $given;
                    $option           = $question->options->firstWhere('id', $selectedOptionId);
                } else {
                    $option           = $question->options->firstWhere('option_text', $given);
                    $selectedOptionId = $option->id ?? null;
                }

                if (! empty($option) && (bool) $option->is_correct) {
                    $isCorrect = true;
                }
            } else {
                $answerText = trim((string) $given);
                if ($question->correct_answer) {
                    $isCorrect = strcasecmp($answerText, $question->correct_answer) === 0;
                }
            }

            if ($isCorrect) {
                $score += $points;
            }

            QuizAnswer::create([
                'quiz_attempt_id' => $attempt->id,
                'question_id'     => $question->id,
                'option_id'       => $selectedOptionId,
                'answer_text'     => $answerText,
                'is_correct'      => $isCorrect,
            ]);
        }

        // Finalize attempt
        $percentage = $totalPoints > 0 ? round(($score / $totalPoints) * 100, 2) : 0;
        $passing    = $quiz->passing_score ?? 60;
        $passed     = $percentage >= $passing;

        $attempt->update([
            'score'      => $score,
            'total'      => $totalPoints,
            'percentage' => $percentage,
            'passed'     => $passed,
        ]);

        // --------------------------
        // CERTIFICATE GENERATION
        // --------------------------
        if ($passed && $user) {
            $filename = 'certificate_' . $quiz->id . '_' . $user->id . '_' . now()->timestamp . '.pdf';
            $folder   = "certificates/user_{$user->id}";
            $path     = $folder . '/' . $filename;

            // make sure directory exists inside public
            if (!file_exists(public_path($folder))) {
                mkdir(public_path($folder), 0777, true);
            }

            $data = [
                'user'       => $user,
                'quiz'       => $quiz,
                'attempt'    => $attempt,
                'issued_at'  => now(),
                'token'      => $token = Str::uuid(),
                'score'      => $score,
                'total'      => $totalPoints,
                'percentage' => $percentage,
                'passed'     => $passed,
                'date'       => now()->toFormattedDateString(),
            ];

            try {
                // Save PDF in public folder
                $pdf = Pdf::loadView('certificates.template', $data);
                $pdf->save(public_path($path));

                // Save certificate record in DB
                $certificate = Certificate::create([
                    'user_id'         => $user->id,
                    'quiz_id'         => $quiz->id,
                    'quiz_attempt_id' => $attempt->id,
                    'file_path'       => $path,  // relative to public
                    'token'           => $data['token'],
                    'issued_at'       => now(),
                ]);

                // --------------------------
                // AUTO EMAIL (with attachment)
                // --------------------------
                Mail::to($user->email)->queue(new \App\Mail\CertificateIssued($certificate));

            } catch (\Exception $ex) {
                Log::error("Certificate generation failed: " . $ex->getMessage());
            }
        }

        DB::commit();
        return redirect()->route('quiz.result', $attempt->id)
            ->with('success', 'Quiz submitted successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'An error occurred while submitting the quiz. Please try again.');
    }
}

    public function download(Certificate $certificate)
    {
        $path = public_path($certificate->file_path); // direct public/ se resolve karega

        if (! file_exists($path)) {
            return back()->with('error', 'Certificate not found.');
        }

        return response()->download($path, 'certificate.pdf');
    }

    public function result(QuizAttempt $attempt)
    {
        // load questions + options + answers
        // $attempt->load([
        //     'quiz',
        //     'answers',
        //     'answers.question.options',
        // ]);

         $attempt->load('quiz', 'quiz.questions', 'quiz.questions.options');

    // fetch certificate related to this attempt
    $certificate = Certificate::where('quiz_attempt_id', $attempt->id)->first();


        return view('admin.quizzes.result', compact('attempt', 'certificate'));
    }

// attempt result
    public function myResults()
    {
        $user = auth()->user();

        // User ke sare attempts load with quiz
        $attempts = QuizAttempt::with('quiz')
            ->where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('admin.quizzes.my_results', compact('attempts'));
    }

    public function leaderboard()
    {
        // Top scorers fetch karo with user & quiz
        $leaderboard = QuizAttempt::with('user', 'quiz')
            ->select('user_id', 'quiz_id')
            ->selectRaw('MAX(score) as top_score, MAX(percentage) as best_percentage')
            ->groupBy('user_id', 'quiz_id')
            ->orderByDesc('best_percentage')
            ->take(20) // top 20
            ->get();

        return view('admin.quizzes.leaderboard', compact('leaderboard'));
    }

    public function generateCertificate(QuizAttempt $attempt)
    {
        if (! $attempt->passed) {
            abort(403, "You did not pass the quiz!");
        }

        $pdf = Pdf::loadView('certificates.template', [
            'user'       => $attempt->user,
            'quiz'       => $attempt->quiz,
            'score'      => $attempt->score,
            'percentage' => $attempt->percentage,
            'date'       => now()->format('d M Y'),
        ]);

        $fileName = "certificate-{$attempt->id}.pdf";
        return $pdf->download($fileName);
    }

}
