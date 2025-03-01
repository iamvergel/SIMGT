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
         // Fetch only active students and filter them by the status 'Enrolled' and grade 'Grade One'
         $students = StudentInfo::with('student') // Only eager load 'student' relationship
             ->where('status', 'Active') // Active students only
             ->get();
 
         // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
         $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
             ->where('status', 'Enrolled') // Ensure students are enrolled
             ->get()->keyBy('studentnumber');
 
         $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
         $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
         $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
 
         // Check if there are no students found in Grade One
         $noGradeOneMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;
 
         // Pass the data to the view
         return view('teacher.teacher_classsubject', compact('students', 'noGradeOneMessage', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));
 
     }
}

