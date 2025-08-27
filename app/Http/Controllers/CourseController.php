<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // List all courses
    public function index()
    {
        $courses = Course::with('instructor')->latest()->paginate(12);
        return view('courses.index', compact('courses'));
    }

    // Show create form
    public function create()
    {
        abort_unless(auth()->user()->hasAnyRole(['admin', 'instructor']), 403);
        return view('courses.create');
    }

    // Store new course
    public function store(Request $request)
    {
        abort_unless(auth()->user()->hasAnyRole(['admin', 'instructor']), 403);

        // Validate input
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'thumbnail_path' => 'nullable|image|max:2048', // max 2MB
        ]);

        // Assign the currently logged in user as instructor
        $data['user_id'] = auth()->id();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail_path')) {
            $path = $request->file('thumbnail_path')->store('courses/thumbnails', 'public');
            $data['thumbnail_path'] = $path; // relative path
        }

        // Create course
        $course = Course::create($data);

        return redirect()->route('courses.index')->with('status', 'Course created successfully!');
    }

    // Show course details
    public function show(Course $course)
    {
        $enrolled = false;

        if (auth()->check()) {
            $enrolled = $course->enrollments()
                ->where('user_id', auth()->id())
                ->exists();
        }

        return view('courses.show', [
            'course' => $course,
            'enrolled' => $enrolled,
        ]);
    }
}
