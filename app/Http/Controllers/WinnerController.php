<?php

// app/Http/Controllers/WinnerController.php

namespace App\Http\Controllers;

use App\Models\Winner;
use Illuminate\Http\Request;

class WinnerController extends Controller
{
    // Show winners list with search
    public function index(Request $request)
    {
        $query = Winner::query();

        if ($request->filled('item')) {
            $query->where('items', 'like', '%' . $request->item . '%');
        }

        $winners = $query->get();

        return view('winners.index', compact('winners'));
    }

    // Show form to add winner (admin only)
    public function create()
    {
        return view('winners.create');
    }

    // Store new winner
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'items' => 'required|string',
            'grade' => 'required|string|max:10',
        ]);

        Winner::create($validated);

        return redirect()->route('winners.index')->with('success', 'Winner added successfully!');
    }
}
