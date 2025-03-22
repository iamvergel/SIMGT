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
use App\Models\Section;
use App\Models\Subject;
use App\Models\GradeOneClassRecord;
use App\Models\GradeTwoClassRecord;
use App\Models\GradeThreeClassRecord;
use App\Models\GradeFourClassRecord;
use App\Models\GradeFiveClassRecord;
use App\Models\GradeSixClassRecord;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Madminaccount;
use App\Mail\MLsendemail;
use Illuminate\Support\Facades\Mail;
use App\Models\StudentFinalGrade;

class RegistrarStudent extends Controller
{
    //
    public function showGradeOneData()
    {
        // Fetch only Enrolled students and filter them by the status 'Enrolled' and grade 'Grade One'
        $students = StudentInfo::with('student') // Only eager load 'student' relationship
            ->where('status', 'Enrolled') // Enrolled students only
            ->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('status', 'Enrolled') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser')->map(function ($value) {
            return $value === null ? null : $value;
        })->toArray())->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeOneMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradeone', compact('students', 'noGradeOneMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));
    }
public function showGradeTwoData()
    {
        // Fetch only Enrolled students and filter them by the status 'Enrolled' and grade 'Grade One'
        $students = StudentInfo::with('student') // Only eager load 'student' relationship
            ->where('status', 'Enrolled') // Enrolled students only
            ->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('status', 'Enrolled') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradetwo', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

    }

    public function showGradeThreeData()
    {
        // Fetch only Enrolled students and filter them by the status 'Enrolled' and grade 'Grade One'
        $students = StudentInfo::with('student') // Only eager load 'student' relationship
            ->where('status', 'Enrolled') // Enrolled students only
            ->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('status', 'Enrolled') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradethree', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

    }

    public function showGradeFourData()
    {
        // Fetch all Grade Four student records
        // Fetch only Enrolled students and filter them by the status 'Enrolled' and grade 'Grade One'
        $students = StudentInfo::with('student') // Only eager load 'student' relationship
            ->where('status', 'Enrolled') // Enrolled students only
            ->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('status', 'Enrolled') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradefour', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

    }

    public function showGradeFiveData()
    {
        // Fetch only Enrolled students and filter them by the status 'Enrolled' and grade 'Grade One'
        $students = StudentInfo::with('student') // Only eager load 'student' relationship
            ->where('status', 'Enrolled') // Enrolled students only
            ->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('status', 'Enrolled') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradefive', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

    }

    public function showGradeSixData()
    {
        // Fetch only Enrolled students and filter them by the status 'Enrolled' and grade 'Grade One'
        $students = StudentInfo::with('student') // Only eager load 'student' relationship
            ->where('status', 'Enrolled') // Enrolled students only
            ->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('status', 'Enrolled') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradesix', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));
    }

    public function showRegistrarInfotmation(Request $request, $id)
    {
        // Fetch the specific student based on the provided id
        $students = StudentInfo::where('id', $id)->where('status', 'Enrolled')->first();

        // If the student doesn't exist, you could redirect back or show an error message
        if (!$students) {
            return back()->withErrors('Student not found.');
        }

        // Fetch related data for the specific student
        $studentsPrimary = StudentPrimaryInfo::where('lrn', $students->lrn)->where('status', 'Enrolled')->first();
        $studentsPrimaryOne = StudentPrimaryInfo::where('lrn', $students->lrn)->first();
        $studentsAdditional = StudentAdditionalInfo::where('student_number', $students->student_number)->first();
        $studentDocuments = StudentDocuments::where('student_number', $students->student_number)->first();
        $studentAccount = Mstudentaccount::where('student_number', $students->student_number)->first();
        $finalGradeOne = StudentFinalGrade::where('student_number', $students->student_number)->where('grade', 'Grade One')->get();
        $finalGradeTwo = StudentFinalGrade::where('student_number', $students->student_number)->where('grade', 'Grade Two')->get();
        $finalGradeThree = StudentFinalGrade::where('student_number', $students->student_number)->where('grade', 'Grade Three')->get();
        $finalGradeFour = StudentFinalGrade::where('student_number', $students->student_number)->where('grade', 'Grade Four')->get();
        $finalGradeFive = StudentFinalGrade::where('student_number', $students->student_number)->where('grade', 'Grade Five')->get();
        $finalGradeSix = StudentFinalGrade::where('student_number', $students->student_number)->where('grade', 'Grade Six')->get();
        $teachers = TeacherUser::where('teacher_number', $studentsPrimaryOne->adviser)->first();

        // You can pass other data here as needed
        return view('registrar.includes.student_information', compact('students', 'studentsPrimary', 'teachers', 'studentsAdditional', 'studentsPrimaryOne', 'studentDocuments', 'studentAccount', 'finalGradeOne', 'finalGradeTwo', 'finalGradeThree', 'finalGradeFour', 'finalGradeFive', 'finalGradeSix'));
    }
}
