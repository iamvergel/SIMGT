<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentInfo;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocuments;
use App\Models\Mstudentaccount;
use App\Models\Mstudentgradeone;
use App\Models\Mstudentgradetwo;
use App\Models\Mstudentgradethree;
use App\Models\Mstudentgradefour;
use App\Models\Mstudentgradefive;
use App\Models\Mstudentgradesix;
use App\Models\StudentPrimaryInfo;
use App\Models\TeacherAdvisory;
use App\Models\TeacherUser;
use Illuminate\Support\Facades\Auth;

class TeacherClassAdvisory extends Controller
{
    //
    public function showMyadvisory()
    {
        // Fetch only active students and filter them by the status 'Enrolled' and grade 'Grade One'
        $students = StudentInfo::with('student') // Only eager load 'student' relationship
            ->where('status', 'Enrolled') // Active students only
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
        return view('teacher.teacher_advisory', compact('students', 'noGradeOneMessage', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

    }

    public function showStudentInfotmation(Request $request, $id)
    {
        // Fetch the specific student based on the provided id
        $students = StudentInfo::where('id', $id)->where('status', 'Active')->first();

        // If the student doesn't exist, you could redirect back or show an error message
        if (!$students) {
            return back()->withErrors('Student not found.');
        }

        // Fetch related data for the specific student
        $studentsPrimary = StudentPrimaryInfo::where('lrn', $students->lrn)->first();
        $studentsAdditional = StudentAdditionalInfo::where('student_number', $students->student_number)->first();
        $studentDocuments = StudentDocuments::where('student_number', $students->student_number)->first();
        $studentAccount = Mstudentaccount::where('student_number', $students->student_number)->first();
        $studentGradeOne = Mstudentgradeone::where('student_number', $students->student_number)->first();
        $studentGradeTwo = Mstudentgradetwo::where('student_number', $students->student_number)->first();
        $studentGradeThree = Mstudentgradethree::where('student_number', $students->student_number)->first();
        $studentGradeFour = Mstudentgradefour::where('student_number', $students->student_number)->first();
        $studentGradeFive = Mstudentgradefive::where('student_number', $students->student_number)->first();
        $studentGradeSix = Mstudentgradesix::where('student_number', $students->student_number)->first();

        // You can pass other data here as needed
        return view('teacher.teacher_myadvisory', compact('students', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount', 'studentGradeOne', 'studentGradeTwo', 'studentGradeThree', 'studentGradeFour', 'studentGradeFive', 'studentGradeSix'));
    }
}
