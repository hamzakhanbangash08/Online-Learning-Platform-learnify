<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('admin.lessons.index')->with('success', 'Lesson created successfully.');
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
        return view('admin.lessons.edit', compact('lesson', 'courses'));
    }

    /**
     * Update the specified lesson in storage.
     */
   /**
 * Update the specified lesson in storage.
 */
public function update(Request $request, Lesson $lesson)
{
    $validated = $request->validate([
        'course_id'  => 'required|exists:courses,id',
        'title'      => 'required|string|max:255',
        'content'    => 'nullable|string',
        'video_url'  => 'nullable|url',
        'video_path' => 'nullable|file|mimetypes:video/mp4,video/webm,video/ogg|max:50000', // max 50MB
        'position'   => 'nullable|integer|min:1',
    ]);

    // Agar naya video upload hua hai
    if ($request->hasFile('video_path')) {
        // Purani file delete karni ho to:
        if ($lesson->video_path && Storage::disk('public')->exists($lesson->video_path)) {
            Storage::disk('public')->delete($lesson->video_path);
        }

        // Naya file store karo
        $path = $request->file('video_path')->store('lessons/videos', 'public');
        $validated['video_path'] = $path;
    }

    $lesson->update($validated);

    return redirect()->route('admin.lessons.index')->with('success', 'Lesson updated successfully.');
}

    /**
     * Remove the specified lesson from storage.
     */
   /**
 * Remove the specified lesson from storage.
 */
public function destroy(Lesson $lesson)
{
    // Agar lesson ke sath koi video_path hai to usko bhi delete karo
    if ($lesson->video_path && Storage::disk('public')->exists($lesson->video_path)) {
        Storage::disk('public')->delete($lesson->video_path);
    }

    $lesson->delete();

    return redirect()->route('admin.lessons.index')->with('success', 'Lesson deleted successfully (including video file).');
}
}   