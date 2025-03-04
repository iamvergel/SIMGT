<?php

namespace App\Http\Controllers;

use App\Models\TeacherSubjectClass;
use App\Models\TeacherUser;
use App\Models\StudentInfo;
use App\Models\TeacherAdvisory;
use App\Models\StudentPrimaryInfo;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocuments;
use App\Models\Mstudentaccount;
use App\Models\Subject;
use App\Models\GradeOneClassRecord;
use App\Models\GradeTwoClassRecord;
use App\Models\GradeThreeClassRecord;
use App\Models\GradeFourClassRecord;
use App\Models\GradeFiveClassRecord;
use App\Models\GradeSixClassRecord;
use Illuminate\Support\Facades\Auth;
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

    public function getClassSubject()
    {
        // Get the teacher number of the currently logged in user
        $teacherNumber = Auth::guard('teacher')->user()->teacher_number;

        // Fetch all distinct sections from the TeacherSubjectClass model where section is not null or empty
        $Subject = TeacherSubjectClass::whereNotNull('subject') // Ensure section is not null
            ->where('subject', '!=', '') // Ensure section is not an empty string
            ->where('teacher_number', $teacherNumber) // Filter by the teacher number
            ->distinct() // Get only distinct sections
            ->pluck('subject'); // Get only the 'section' column

        // Return sections as a JSON response
        return response()->json($Subject);
    }

    public function getAllSubjectsByGrade(Request $request)
    {
        // Fetch sections based on the selected grade
        $sections = TeacherSubjectClass::where('teacher_number', $request->grade)->get();

        // Return the sections as a JSON response
        return response()->json($sections);
    }

    public function showclasssubjectadvisory()
    {
        // Assuming the teacher is authenticated and their teacher_number is in the session
        $teacherNumber = auth('teacher')->user()->teacher_number; // Fetch teacher number from authenticated user

        // Query each grade class model for matching teacher_number
        $gradeOneRecords = GradeOneClassRecord::where('teacher_number', $teacherNumber)->get();
        $gradeTwoRecords = GradeTwoClassRecord::where('teacher_number', $teacherNumber)->get();
        $gradeThreeRecords = GradeThreeClassRecord::where('teacher_number', $teacherNumber)->get();
        $gradeFourRecords = GradeFourClassRecord::where('teacher_number', $teacherNumber)->get();
        $gradeFiveRecords = GradeFiveClassRecord::where('teacher_number', $teacherNumber)->get();
        $gradeSixRecords = GradeSixClassRecord::where('teacher_number', $teacherNumber)->get();

        // Combine all results into one collection
        $allRecords = $gradeOneRecords->merge($gradeTwoRecords)
            ->merge($gradeThreeRecords)
            ->merge($gradeFourRecords)
            ->merge($gradeFiveRecords)
            ->merge($gradeSixRecords);

        // Additional variables you may want to pass to the view
        $students = $allRecords; // Adjust accordingly if you need separate collections for students
        $noGradeOneMessage = $gradeOneRecords->isEmpty() ? 'No records found for Grade One' : null;
        $studentsPrimary = $allRecords;  // You can filter if needed based on primary/secondary
        $studentsAdditional = $allRecords; // Similar to above
        $studentDocuments = $allRecords; // Adjust as per your logic
        $studentAccount = $allRecords; // Adjust as per your logic

        // Pass the data to the view
        return view('teacher.teacher_classsubject', compact('students', 'noGradeOneMessage', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));
    }
}

