<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class ResultController extends Controller
{
    // User: Search for results
    public function index(Request $request)
    {
        $results = collect();
        if ($request->has('item_name')) {
            $results = Result::where('item_name', 'like', '%' . $request->item_name . '%')->get();
        }
        return view('results.index', compact('results'));
    }

    // Admin: Show form for adding a result
    public function create()
    {
        return view('admin.results.create');
    }

    // Admin: Store a new result
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'student_name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'position' => 'required|integer|min:1',
            'grade' => 'required|string|max:10',
        ]);

        Result::create($validated);

        return redirect()->route('results.index')->with('success', 'Result added successfully.');
    }
}

