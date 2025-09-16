<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // List all courses
    // public function index()
    // {
    //     $courses = Course::with('instructor')->get();
    //     return view('courses.index', compact('courses'));
    // }


//    public function index(Request $request)
// {
//     // search value
//     $search = $request->input('search');

//     // query with filter
//     $courses = Course::with('instructor')
//         ->when($search, function ($query, $search) {
//             $query->where('title', 'like', '%' . $search . '%');
//         })
//         ->orderBy('title', 'asc') // 👈 Alphabetical order A → Z
//         ->paginate(9)
//         ->appends(['search' => $search]); 

//     return view('courses.index', compact('courses', 'search'));
// }


// 
public function index(Request $request)
{
    // search value
    $search = $request->input('search');
    $category = $request->input('category');

    // query with filter
    $courses = Course::with('instructor', 'category')
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
        ->when($category, function ($query, $category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });
        })
        ->orderBy('title', 'asc')
        ->paginate(9)
        ->appends([
            'search' => $search,
            'category' => $category
        ]);

    // 👇 saare titles bhej do
    $allTitles = Course::orderBy('title', 'asc')->pluck('title');

    return view('courses.index', compact('courses', 'search', 'category', 'allTitles'));
}




    // Show create form
    // public function create()
    // {
    //     abort_unless(auth()->user()->hasAnyRole(['admin', 'instructor']), 403);

    //     $category = Category::get();
    //     return view('courses.create', compact('category'));
    // }

    // // Store new course
    // public function store(Request $request)
    // {
    //     abort_unless(auth()->user()->hasAnyRole(['admin', 'instructor']), 403);

    //     // Validate input
    //     $data = $request->validate([
    //         'title'          => 'required|string|max:255',
    //         'description'    => 'nullable|string',
    //         'price'          => 'required|numeric|min:0',
    //         'thumbnail_path' => 'nullable|image|max:2048', // max 2MB
    //     ]);

    //     // Assign the currently logged in user as instructor
    //     $data['user_id'] = auth()->id();

    //     // Handle thumbnail upload
    //     if ($request->hasFile('thumbnail_path')) {
    //         $path                   = $request->file('thumbnail_path')->store('courses/thumbnails', 'public');
    //         $data['thumbnail_path'] = $path; // relative path
    //     }

    //     // Create course
    //     $course = Course::create($data);

    //     return redirect()->route('courses.index')->with('status', 'Course created successfully!');
    // }



    // 
    public function create()
{
    abort_unless(auth()->user()->hasAnyRole(['admin', 'instructor']), 403);

    $categories = Category::all(); // plural better hai
    return view('courses.create', compact('categories'));
}

// Store new course
public function store(Request $request)
{
    abort_unless(auth()->user()->hasAnyRole(['admin', 'instructor']), 403);

    // Validate input
    $data = $request->validate([
        'title'          => 'required|string|max:255',
        'description'    => 'nullable|string',
        'price'          => 'required|numeric|min:0',
        'category_id'    => 'required|exists:categories,id', // ✅ category required
        'thumbnail_path' => 'nullable|image|max:2048', // max 2MB
    ]);

    // Assign the currently logged in user as instructor
    $data['user_id'] = auth()->id();

    // Handle thumbnail upload
    if ($request->hasFile('thumbnail_path')) {
        $path                   = $request->file('thumbnail_path')->store('courses/thumbnails', 'public');
        $data['thumbnail_path'] = $path; // relative path
    }

    // Create course
    Course::create($data);

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
            'course'   => $course,
            'enrolled' => $enrolled,
        ]);
    }

    public function myCourses()
    {
        $courses = Course::with('instructor')->get();
        return view('courses.table', compact('courses'));
    }

}
