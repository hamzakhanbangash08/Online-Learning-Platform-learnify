<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Store a newly created enrollment (enroll user in course).
     */
    public function store(Course $course)
    {
        $user = auth()->user();

        // Already enrolled?
        if ($course->enrollments()->where('user_id', $user->id)->exists()) {
            return back()->with('info', 'You are already enrolled.');
        }

        Enrollment::create([
            'user_id'    => $user->id,
            'course_id'  => $course->id,
            'enrolled_at' => now(),
        ]);

        return back()->with('success', 'Enrolled successfully!');
    }


    /**
     * Remove the enrollment (unenroll).
     */
    public function destroy(Course $course)
    {
        $user = auth()->user();

        $course->enrollments()
            ->where('user_id', $user->id)
            ->delete();

        return back()->with('success', 'Unenrolled successfully.');
    }
}
