<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class ResultDisplayController extends Controller
{
    public function index()
    {
        $results = collect();
        return view('results.index', compact('results'));
    }

    public function search(Request $request)
    {
        $query = Result::query();

        if($request->filled('item_name')) {
            $query->where('item_name', 'like', '%'.$request->item_name.'%');
        }
        if($request->filled('student_name')) {
            $query->where('student_name', 'like', '%'.$request->student_name.'%');
        }
        if($request->filled('class')) {
            $query->where('class', 'like', '%'.$request->class.'%');
        }

        $results = $query->get();

        return view('results.index', compact('results'));
    }
}
