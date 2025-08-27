<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the lessons.
     */
    public function index(Request $request)
    {
        $query = Lesson::with('course')->orderBy('position');

        if ($request->filled('course')) {
            $query->where('course_id', $request->input('course'));
        }

        $lessons = $query->paginate(12)->withQueryString();

        // optionally you may want to pass list of courses for filter dropdown
        $courses = Course::select('id', 'title')->get();

        return view('lessons.index', compact('lessons', 'courses'));
    }


    /**
     * Show the form for creating a new lesson.
     */
    public function create()
    {
        $courses = Course::all();
        return view('lessons.create', compact('courses'));
    }

    /**
     * Store a newly created lesson in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'video_path' => 'nullable|file|mimetypes:video/mp4,video/webm,video/ogg|max:50000', // max 50MB
            'position' => 'nullable|integer',
        ]);

        if ($request->hasFile('video_path')) {
            // File ko 'public/storage/lessons/videos' me store karenge
            $path = $request->file('video_path')->store('lessons/videos', 'public');

            // Database me **sirf relative path** store karenge
            $data['video_path'] = $path;
        }

        Lesson::create($data);

        return redirect()->route('lessons.index')->with('success', 'Lesson created successfully.');
    }



    /**
     * Display the specified lesson.
     */
    public function show(Lesson $lesson)
    {
        $lesson->load('course');
        return view('lessons.show', compact('lesson'));
    }

    /**
     * Show the form for editing the specified lesson.
     */
    public function edit(Lesson $lesson)
    {
        $courses = Course::all();
        return view('lessons.edit', compact('lesson', 'courses'));
    }

    /**
     * Update the specified lesson in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title'     => 'required|string|max:255',
            'content'   => 'nullable|string',
            'video_url' => 'nullable|url',
            'position'  => 'nullable|integer|min:1',
        ]);

        $lesson->update($validated);

        return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified lesson from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully.');
    }
}
