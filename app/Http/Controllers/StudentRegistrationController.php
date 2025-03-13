<?php

namespace App\Http\Controllers;

use App\Models\StudentPrimaryInfo;
use App\Models\StudentInfo;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocuments;
use App\Models\Mstudentaccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentRegistrationController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('student.registration');
    }

    // Handle the registration form submission
    public function register(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'lrn' => 'required|string|max:255',
            'studentnumber' => 'required|string|max:255|unique:student_primary_info',
            'status' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'section' => 'nullable|string|max:255',
            'adviser' => 'nullable|string|max:255',
            'school_year' => 'required|string|max:255',
        ]);

        // If the LRN, school year, and grade already exist, show an error message
        if (StudentPrimaryInfo::where('lrn', $request->lrn)
            ->where('school_year', $request->school_year)
            ->where('grade', $request->grade)
            ->exists()) {
            return back()->withErrors(['lrn' => 'The LRN is already registered with the same school year and grade.']);
        }

        // Create the new student
        StudentPrimaryInfo::create([
            'lrn' => $request->lrn,
            'studentnumber' => $request->student_number,
            'status' => $request->status,
            'grade' => $request->grade,
            'section' => $request->section,
            'adviser' => $request->adviser,
            'school_year' => $request->school_year,
        ]);

        // Redirect to a success page or back to the form
        return redirect()->route('students.registration')->with('success', 'Registration successful!');
    }

    //
    public function showAllRegister()
    {
        // Fetch all active student records with pagination
        $students = StudentPrimaryInfo::where('status', 'Registered')->get();

        // Fetch additional student information for each student
        $studentInfo = StudentInfo::whereIn('lrn', $students->pluck('lrn'))->get()->keyBy('lrn');
        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('studentnumber'))->get()->keyBy('student_number');
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('studentnumber'))->get()->keyBy('student_number');
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('studentnumber'))->get()->keyBy('student_number');

        // Check if there are no active students
        $noActiveMessage = $students->isEmpty() ? "No active students found." : null;

        return view('admin.admin_registration', compact('students', 'studentInfo', 'studentsAdditional', 'studentDocuments', 'studentAccount', 'noActiveMessage'));
    }
}
