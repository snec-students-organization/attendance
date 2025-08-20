<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultUploadController extends Controller
{
    public function create() {
        return view('admin.results.upload');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'item_name.*' => 'required|string',
            'student_name.*' => 'required|string',
            'class.*' => 'required|string',
            'position.*' => 'required|string',
            'grade.*' => 'required|string'
        ]);

        foreach ($request->item_name as $i => $itemName) {
            Result::create([
                'item_name'     => $itemName,
                'student_name'  => $request->student_name[$i],
                'class'         => $request->class[$i],
                'position'      => $request->position[$i],
                'grade'         => $request->grade[$i],
            ]);
        }

        return redirect()->back()->with('success', 'Results uploaded successfully!');
    }
}
