<?php

namespace App\Http\Controllers;

use App\Models\TeacherAdvisory;
use Illuminate\Http\Request;

class TeacherAdvisoryController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'teacher_number' => 'required|string|unique:teacher_advisory,teacher_number',
            'grade' => 'required|string',
            'section' => 'required|string',
            'school_year' => 'required|string',
        ]);

        // Create the new teacher user
        $teacherUser = TeacherAdvisory::create([
            'teacher_number' => $request->teacher_number,
            'grade' => $request->grade ? ucwords(strtolower($request['middle_name'])) : null,
            'section' => $request->section ? ucwords(strtolower($request['last_name'])) : null,
            'school_year' => $request->school_year,
        ]);

        // Return success response
        return redirect()->route('teacher.user')->with('success', 'New teacher added successfully!');
    }
}
