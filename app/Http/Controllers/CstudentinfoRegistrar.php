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

class CstudentinfoRegistrar extends Controller
{

    public function showStudentInfotmation(Request $request, $id)
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
    
    public function showDroppedStudentInfotmation(Request $request, $id)
    {
        // Fetch the specific student based on the provided id
        $students = StudentInfo::where('id', $id)->where('status', 'Dropped')->first();

        // If the student doesn't exist, you could redirect back or show an error message
        if (!$students) {
            return back()->withErrors('Student not found.');
        }

        // Fetch related data for the specific student
        $studentsPrimary = StudentPrimaryInfo::where('lrn', $students->lrn)->where('status', 'Dropped')->first();
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

    public function showTransferStudentInfotmation(Request $request, $id)
    {
        // Fetch the specific student based on the provided id
        $students = StudentInfo::where('id', $id)->where('status', 'Transfer')->first();

        // If the student doesn't exist, you could redirect back or show an error message
        if (!$students) {
            return back()->withErrors('Student not found.');
        }

        // Fetch related data for the specific student
        $studentsPrimary = StudentPrimaryInfo::where('lrn', $students->lrn)->where('status', 'Transfer')->first();
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

    public function showGradutedStudentInfotmation(Request $request, $id)
    {
        // Fetch the specific student based on the provided id
        $students = StudentInfo::where('id', $id)->where('status', 'Graduated')->first();

        // If the student doesn't exist, you could redirect back or show an error message
        if (!$students) {
            return back()->withErrors('Student not found.');
        }

        // Fetch related data for the specific student
        $studentsPrimary = StudentPrimaryInfo::where('lrn', $students->lrn)->where('status', 'Graduated')->first();
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

    public function dropStudent(Request $request, $studentId)
    {
        // Find the student by ID
        $student = StudentInfo::find($studentId);

        // Check if the student exists
        if (!$student) {
            return back()->withErrors('Student not found.');
        }

        // Update the status to "Dropped"
        $student->status = 'Dropped';
        $student->save();

        // Update student primary record
        StudentPrimaryInfo::where('studentnumber', $student->student_number)
            ->update(['status' => 'Dropped']);

        // Redirect or return response
        return back()->with('success', 'Student dropped successfully!');
    }

    public function retrieveStudent(Request $request, $studentId)
    {
        // Find the student by ID
        $student = StudentInfo::find($studentId);

        // Check if the student exists
        if (!$student) {
            return back()->withErrors('Student not found.');
        }

        // Update the status to "Dropped"
        $student->status = 'Enrolled';
        $student->save();

        StudentPrimaryInfo::where('studentnumber', $student->student_number)
            ->update(['status' => 'Enrolled']);

        // Redirect or return response
        return back()->with('success', 'Student retrieve successfully!');
    }

    public function showAllStudentData()
    {
        // Fetch all active student records with pagination
        $students = StudentInfo::where('status', 'Enrolled')->get();

        // Fetch additional student information for each student
        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch additional student information for each student
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        $studentGradeOne = Mstudentgradeone::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentGradeTwo = Mstudentgradetwo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentGradeThree = Mstudentgradethree::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentGradeFour = Mstudentgradefour::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentGradeFive = Mstudentgradefive::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentGradeSix = Mstudentgradesix::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Check if there are no active students
        $noActiveMessage = $students->isEmpty() ? "No active students found." : null;
        $gradeOne = Mstudentgradeone::all();
        $gradeTwo = Mstudentgradetwo::all();
        $gradeThree = Mstudentgradethree::all();
        $gradeFour = Mstudentgradefour::all();
        $gradeFive = Mstudentgradefive::all();
        $gradeSix = Mstudentgradesix::all();

        return view('registrar.registrar_show_all_data', compact('students', 'gradeOne', 'gradeTwo', 'gradeThree', 'gradeFour', 'gradeFive', 'gradeSix', 'studentsAdditional', 'studentDocuments', 'studentAccount', 'studentGradeOne', 'studentGradeTwo', 'studentGradeThree', 'studentGradeFour', 'studentGradeFive', 'studentGradeSix', 'noActiveMessage'));
    }

    public function fetchGrades($studentNumber)
    {
        // Fetch the student grades from the database based on the student number
        $grades = Mstudentgradeone::where('student_number', $studentNumber)->get();

        // Format the grades for the modal response
        $formattedGrades = $grades->map(function ($grade) {
            return [
                'subject' => $grade->subject,
                'Q1' => $grade->Q1 ?? 'N/A',
                'Q2' => $grade->Q2 ?? 'N/A',
                'Q3' => $grade->Q3 ?? 'N/A',
                'Q4' => $grade->Q4 ?? 'N/A',
            ];
        });

        return response()->json(['grades' => $formattedGrades]);
    }

    public function showAllStudentGraduateData()
    {
        // Fetch all graduate student records
        $students = StudentInfo::where('status', 'Graduated')->get();

        // Fetch additional student information for each student
        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch additional student information for each student
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Check if there are no graduate students
        $noGraduatesMessage = $students->isEmpty() ? "No graduate students found." : null;

        return view('registrar.registrar_graduate_students', compact('students', 'studentsAdditional', 'studentDocuments', 'noGraduatesMessage', ));
    }

    public function showAllStudentDropData()
    {
        // Fetch all dropped student records
        $students = StudentInfo::where('status', 'Dropped')->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('status', 'Dropped') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        // Fetch additional student information for each student
        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch additional student information for each student
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch teacher information for each student
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch teacher information for each student
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser')->map(function ($value) {
            return $value === null ? null : $value;
        })->toArray())->get()->keyBy('teacher_number');

        // Check if there are no dropped students
        $noDroppedMessage = $students->isEmpty() ? "No dropped students found." : null;

        return view('registrar.registrar_drop_student', compact('students', 'studentsAdditional', 'studentDocuments', 'noDroppedMessage', 'studentAccount', 'myTeacher'));
    }

    public function showAllStudentDroppedData()
    {
        // Fetch all dropped student records
        $students = StudentInfo::where('status', 'Dropped')->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('status', 'Dropped') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        // Fetch additional student information for each student
        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch additional student information for each student
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch teacher information for each student
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch teacher information for each student
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser')->map(function ($value) {
            return $value === null ? null : $value;
        })->toArray())->get()->keyBy('teacher_number');

        // Check if there are no dropped students
        $noDroppedMessage = $students->isEmpty() ? "No dropped students found." : null;

        return view('registrar.registrar_show_all_drop_data', compact('students', 'studentsAdditional', 'studentDocuments', 'noDroppedMessage', 'studentAccount', 'myTeacher'));
    }

    public function showAllStudentArchiveData()
    {
        // Fetch all dropped student records
        $students = StudentInfo::where('status', 'Transfer')->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('status', 'Transfer') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        // Fetch additional student information for each student
        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch additional student information for each student
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch teacher information for each student
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch teacher information for each student
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser')->map(function ($value) {
            return $value === null ? null : $value;
        })->toArray())->get()->keyBy('teacher_number');

        // Check if there are no dropped students
        $noDroppedMessage = $students->isEmpty() ? "No dropped students found." : null;

        return view('registrar.registrar_archive_student', compact('students', 'studentsAdditional', 'studentDocuments', 'noDroppedMessage', 'studentAccount', 'myTeacher'));
    }

    public function showGradeData()
    {

        // Fetch all student records
        $students = StudentInfo::all();

        // Count the number of students
        $studentCount = $students->count();

        // Check if there are no students
        $noGradeOneMessage = $studentCount === 0 ? "No students found." : null;

        return view('registrar.registrar_student_management', compact('students', 'noGradeOneMessage'))
            ->with('students', $students)
            ->with('noGradeOneMessage', $noGradeOneMessage);
    }

    public function showGradeOneData()
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
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser')->map(function ($value) {
            return $value === null ? null : $value;
        })->toArray())->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeOneMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradeone', compact('students', 'noGradeOneMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));
    }

    public function additionalInfo()
    {
        return $this->hasOne(StudentAdditionalInfo::class, 'student_number', 'student_number');
    }

    public function documents()
    {
        return $this->hasOne(StudentDocuments::class, 'student_number', 'student_number');
    }

    public function showGradeTwoData()
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
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradetwo', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

    }

    public function showGradeThreeData()
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
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradethree', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

    }

    public function showGradeFourData()
    {
        // Fetch all Grade Four student records
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
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradefour', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

    }

    public function showGradeFiveData()
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
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradefive', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

    }

    public function showGradeSixData()
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
        $myTeacher = TeacherUser::whereIn('teacher_number', $studentsPrimary->pluck('adviser'))->get()->keyBy('teacher_number');

        // Check if there are no students found in Grade One
        $noGradeTwoMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('registrar.registrar_student_management_gradesix', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));
    }

    //_________________________________________________________________
    public function showGradebook()
    {
        // Fetch all student records
        $students = StudentInfo::all();

        // Count the number of students
        $studentCount = $students->count();

        // Check if there are no students
        $noGradeOneMessage = $studentCount === 0 ? "No students found." : null;

        return view('registrar.registrar_gradebook', compact('students', 'noGradeOneMessage'))
            ->with('students', $students)
            ->with('noGradeOneMessage', $noGradeOneMessage);
    }
}