<?php

namespace App\Http\Controllers;

use App\Models\StudentPrimaryInfo;
use Illuminate\Http\Request;

class StudentPrimaryInfoController extends Controller
{
    // Show the list of students
    public function index()
    {
        $students = StudentPrimaryInfo::all();  // Get all records from the database
        return response()->json($students);     // Return the data as JSON (or return a view if needed)
    }

    // Show the form for creating a new student (Optional if using Blade)
    public function create()
    {
        // Return a view if needed (e.g., return view('students.create'))
    }

    // Store a newly created student in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'lrn' => 'required|string|max:255|unique:student_primary_info',
            'studentnumber' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'adviser' => 'required|string|max:255',
            'school_year' => 'required|string|max:255',
        ]);

        // Create a new student record
        $student = StudentPrimaryInfo::create($validated);

        // Return a response (you could redirect, return JSON, etc.)
        return response()->json($student, 201);
    }

    // Display the specified student
    public function show($id)
    {
        $student = StudentPrimaryInfo::findOrFail($id); // Find student by ID, or fail
        return response()->json($student);
    }

    // Show the form for editing a student (Optional if using Blade)
    public function edit($id)
    {
        // Return a view to edit the student, e.g., return view('students.edit', compact('student'));
    }

    // Update the specified student in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'lrn' => 'required|string|max:255|unique:student_primary_info,lrn,' . $id,
            'studentnumber' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'adviser' => 'required|string|max:255',
            'school_year' => 'required|string|max:255',
        ]);

        // Find the student record by ID and update it
        $student = StudentPrimaryInfo::findOrFail($id);
        $student->update($validated);

        // Return a response (you could redirect, return JSON, etc.)
        return response()->json($student);
    }

    // Remove the specified student from the database
    public function destroy($id)
    {
        $student = StudentPrimaryInfo::findOrFail($id);
        $student->delete();

        // Return a response (you could redirect, return JSON, etc.)
        return response()->json(null, 204);
    }
}
