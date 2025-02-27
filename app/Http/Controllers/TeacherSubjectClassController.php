<?php

namespace App\Http\Controllers;

use App\Models\TeacherSubjectClass;
use Illuminate\Http\Request;

class TeacherSubjectClassController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'grade' => 'required|string',
            'section' => 'required|string',
            'subject' => 'required|string',
            'school_year' => 'required|string',
        ]);

        // Create the new teacher user
        $teacherUser = TeacherSubjectClass::create([
            'teacher_number' => $request->teacher_number,
            'grade' => $request->grade ? ucwords(strtolower($request['grade'])) : null,
            'section' => $request->section ? ucwords(strtolower($request['section'])) : null,
            'subject' => $request->subject ? ucwords(strtolower($request['subject'])) : null,
            'school_year' => $request->school_year,
        ]);

        // Return success response
        return redirect()->route('teacher.user')->with('success', 'Subject Class added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'grade' => 'required|string',
            'section' => 'required|string',
            'subject' => 'required|string',
        ]);

        // Find the teacher user
        $user = TeacherSubjectClass::find($id);
        if (!$user) {
            return response()->json(['error' => 'teacher user not found.'], 404);
        }

        // Update the other fields
        $user->grade = $request->grade ? ucfirst(strtolower($request['grade'])) : null;
        $user->section = $request->section ? ucfirst(strtolower($request['section'])) : null;
        $user->subject = $request->subject ? ucfirst(strtolower($request['subject'])) : null;

        // Save the updated user details
        $user->save();

        // Return success response
        return back()->with('success', 'Update Information Successfully!');
    }
}
