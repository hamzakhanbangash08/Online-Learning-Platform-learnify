<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function index(Question $question)
    {
        $options = $question->options;
        return view('admin.options.index', compact('question', 'options'));
    }

    public function create(Question $question)
    {
        return view('admin.options.create', compact('question'));
    }

    public function store(Request $request, Question $question)
    {
        $request->validate([
            'option_text' => 'required|string|max:255',
            'is_correct'  => 'required|boolean',
        ]);

        $question->options()->create($request->only('option_text', 'is_correct'));

        return redirect()->route('admin.options.index', $question->id)
                         ->with('success', 'Option added successfully.');
    }

    public function edit(Question $question, Option $option)
    {
        return view('admin.options.edit', compact('question', 'option'));
    }

    public function update(Request $request, Question $question, Option $option)
    {
        $request->validate([
            'option_text' => 'required|string|max:255',
            'is_correct'  => 'required|boolean',
        ]);

        $option->update($request->only('option_text', 'is_correct'));

        return redirect()->route('admin.options.index', $question->id)
                         ->with('success', 'Option updated successfully.');
    }

    public function destroy(Question $question, Option $option)
    {
        $option->delete();
        return redirect()->route('admin.options.index', $question->id)
                         ->with('success', 'Option deleted successfully.');
    }
}
