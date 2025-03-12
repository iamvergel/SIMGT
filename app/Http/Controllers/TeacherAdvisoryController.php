<?php

namespace App\Http\Controllers;

use App\Models\TeacherAdvisory;
use App\Models\TeacherUser;
use Illuminate\Http\Request;
use App\Models\TeacherSubjectClass;

class TeacherAdvisoryController extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'grade' => 'required|string',
            'section' => 'required|string',
            'school_year' => 'required|string',
        ]);

        // Create the new teacher user
        $teacherUser = TeacherAdvisory::create([
            'teacher_number' => $request->teacher_number,
            'grade' => $request->grade ? ucwords(strtolower($request['grade'])) : null,
            'section' => $request->section ? ucwords(strtolower($request['section'])) : null,
            'school_year' => $request->school_year,
        ]);

        // Return success response
        return redirect()->route('teacher.user')->with('success', 'Advisory added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'grade' => 'required|string',
            'section' => 'required|string',
        ]);

        // Find the teacher user
        $user = TeacherAdvisory::find($id);
        if (!$user) {
            return response()->json(['error' => 'teacher user not found.'], 404);
        }

        // Update the other fields
        $user->grade = $request->grade ? ucfirst(strtolower($request['grade'])) : null;
        $user->section = $request->section ? ucfirst(strtolower($request['section'])) : null;

        // Save the updated user details
        $user->save();

        // Return success response
        return back()->with('success', 'Update Information Successfully!');
    }

    public function getAllAdviserByGrade(Request $request)
    {
        // Fetch sections based on the selected grade, section, and school year
        $sections = TeacherAdvisory::where('grade', $request->grade)
            ->where('section', $request->section)
            ->where('school_year', $request->school_year)
            ->get();

        // Fetch teachers who belong to those sections
        $teachers = TeacherUser::whereIn('teacher_number', $sections->pluck('teacher_number'))->get()->map(function ($teacher) {
            return [
                'teacher_number' => $teacher->teacher_number,
                'name' => $teacher->first_name . ' ' . $teacher->last_name
            ];
        });

        // Return the teachers as a JSON response
        return response()->json($teachers);
    }

    public function getTeachersAndSubjects(Request $request)
    {
        // Fetch sections based on the selected grade, section, and school year
        $sections = TeacherAdvisory::where('grade', $request->grade)
            ->where('school_year', $request->school_year)
            ->get();

        // Fetch teachers who belong to those sections
        $teachers = TeacherUser::whereIn('teacher_number', $sections->pluck('teacher_number'))->get();

        $teachersWithSubjects = $teachers->map(function ($teacher) use ($request) {
            // Fetch subjects for each teacher based on their teacher_number and school_year
            $subjects = TeacherSubjectClass::select('subject', 'grade', 'section')
                ->where('teacher_number', $teacher->teacher_number)
                ->where('school_year', $request->school_year)
                ->whereNotNull('subject')
                ->where('subject', '!=', '')
                ->where('grade', '!=', '')
                ->where('section', '!=', '')
                ->distinct()
                ->get();

            // Add teacher's name and their subjects to the result
            return [
                'teacher_number' => $teacher->teacher_number,
                'name' => $teacher->first_name . ' ' . $teacher->last_name,
                'subjects' => $subjects
            ];
        });

        // Return the combined data as a JSON response
        return response()->json($teachersWithSubjects);
    }
}
