<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;


class GradeController extends Controller
{
    public function index()
    {
        return view('grades.upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'teacher_number' => 'required|string',
            'subject' => 'nullable|string',
            'grade' => 'nullable|numeric',
            'section' => 'nullable|string',
            'excelfile' => 'nullable|file|mimes:xlsx,csv'
        ]);

        // Handling file upload
        if ($request->hasFile('excelfile')) {
            $file = $request->file('excelfile');
            $path = $file->storeAs('grades', time() . '.' . $file->getClientOriginalExtension(), 'public');
        }

        // Store grade data in database
        Grade::create([
            'teacher_number' => $request->teacher_number,
            'subject' => $request->subject,
            'grade' => $request->grade,
            'section' => $request->section,
            'excelfile' => $path ?? null,
        ]);

        return redirect()->back()->with('success', 'Grade uploaded successfully.');
    }
}
