<?php

namespace App\Http\Controllers;

use App\Models\StudentPrimaryInfo;
use App\Models\StudentInfo;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocuments;
use App\Models\Mstudentaccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        if (
            StudentPrimaryInfo::where('lrn', $request->lrn)
                ->where('school_year', $request->school_year)
                ->where('grade', $request->grade)
                ->exists()
        ) {
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

    public function newRegistered(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'lrn' => 'required',

            'student_number' => 'required',
            'grade' => 'required',
            'school_year' => 'required',
            'section' => 'nullable',
            'adviser' => 'nullable',
            'status' => 'required',

            'lastName' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'suffixName' => 'nullable',
            'birthplace' => 'required',
            'birthDate' => 'required|date',
            'age' => 'required|integer|min:0',
            'gender' => 'required',
            'email' => 'required|email',
            'contactNo' => 'required',
            'religion' => 'required',
            'house_number' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            'province' => 'required',
            'city' => 'required',

        ]);

        try {

            $studentRecords = StudentPrimaryInfo::where('lrn', $validatedData['lrn'])
                ->where('studentnumber', $validatedData['student_number'])
                ->get();  // Get all records matching the LRN and student number

            foreach ($studentRecords as $studentprimary) {
                // If the student's status is 'Enrolled', change it to 'Completed'
                if ($studentprimary->status == 'Enrolled') {
                    $studentprimary->status = 'Completed';  // Change status to 'Completed'
                    $studentprimary->updated_at = now();   // Update timestamp
                    $studentprimary->save();               // Save the updated record
                }
                // If the student's status is 'Registered', change it to 'Enrolled'
                elseif ($studentprimary->status == 'Registered') {
                    // Update the existing record with new information
                    $studentprimary->status = 'Enrolled';  // Change status to 'Enrolled'
                    $studentprimary->grade = $validatedData['grade'] ? ucwords(strtolower($validatedData['grade'])) : $studentprimary->grade;
                    $studentprimary->school_year = $validatedData['school_year'] ?: $studentprimary->school_year;
                    $studentprimary->section = $validatedData['section'] ? ucwords(strtolower($validatedData['section'])) : $studentprimary->section;
                    $studentprimary->adviser = $validatedData['adviser'] ? ucwords(strtolower($validatedData['adviser'])) : $studentprimary->adviser;
                    $studentprimary->updated_at = now();  // Update timestamp
                    $studentprimary->save();  // Save the updated record
                }
            }


            if (in_array($validatedData['grade'], ['Grade One'])) {
                // Fetch all subjects for Grade One
                $subjects = Subject::where('grade', 'Grade One')->get();
                $quarters = ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'];

                foreach ($subjects as $subject) {
                    foreach ($quarters as $quarter) {
                        $classRecord = new GradeOneClassRecord();
                        $classRecord->lrn = $validatedData['lrn'];
                        $classRecord->student_number = $validatedData['student_number'];
                        $classRecord->school_year = $validatedData['school_year'];
                        $classRecord->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                        $classRecord->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                        $classRecord->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                        $classRecord->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                        $classRecord->gender = $validatedData['gender'];
                        $classRecord->quarter = $quarter;
                        $classRecord->grade = $validatedData['grade'];
                        $classRecord->section = $validatedData['section'];
                        $classRecord->subject = $subject->subject;

                        // Save the class record
                        $classRecord->save();
                    }

                    $finalGrade = new StudentFinalGrade();
                    $finalGrade->lrn = $validatedData['lrn'];
                    $finalGrade->student_number = $validatedData['student_number'];
                    $finalGrade->school_year = $validatedData['school_year'];
                    $finalGrade->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                    $finalGrade->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                    $finalGrade->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                    $finalGrade->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                    $finalGrade->gender = $validatedData['gender'];
                    $finalGrade->grade = $validatedData['grade'];
                    $finalGrade->section = $validatedData['section'];
                    $finalGrade->teacher_number = $validatedData['adviser'];
                    $finalGrade->subject = $subject->subject;

                    // Save the final grade record
                    $finalGrade->save();
                }
            } else if (in_array($validatedData['grade'], ['Grade Two'])) {
                $subjects = Subject::where('grade', 'Grade Two')->get();
                $quarters = ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'];

                foreach ($subjects as $subject) {
                    foreach ($quarters as $quarter) {
                        $classRecord = new GradeTwoClassRecord();
                        $classRecord->lrn = $validatedData['lrn'];
                        $classRecord->student_number = $validatedData['student_number'];
                        $classRecord->school_year = $validatedData['school_year'];
                        $classRecord->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                        $classRecord->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                        $classRecord->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                        $classRecord->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                        $classRecord->gender = $validatedData['gender'];
                        $classRecord->quarter = $quarter;
                        $classRecord->grade = $validatedData['grade'];
                        $classRecord->section = $validatedData['section'];
                        $classRecord->subject = $subject->subject;

                        // Save the class record
                        $classRecord->save();
                    }

                    $finalGrade = new StudentFinalGrade();
                    $finalGrade->lrn = $validatedData['lrn'];
                    $finalGrade->student_number = $validatedData['student_number'];
                    $finalGrade->school_year = $validatedData['school_year'];
                    $finalGrade->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                    $finalGrade->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                    $finalGrade->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                    $finalGrade->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                    $finalGrade->gender = $validatedData['gender'];
                    $finalGrade->grade = $validatedData['grade'];
                    $finalGrade->section = $validatedData['section'];
                    $finalGrade->teacher_number = $validatedData['adviser'];
                    $finalGrade->subject = $subject->subject;

                    // Save the final grade record
                    $finalGrade->save();
                }
            } else if (in_array($validatedData['grade'], ['Grade Three'])) {
                $subjects = Subject::where('grade', 'Grade Three')->get();
                $quarters = ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'];

                foreach ($subjects as $subject) {
                    foreach ($quarters as $quarter) {
                        $classRecord = new GradeThreeClassRecord();
                        $classRecord->lrn = $validatedData['lrn'];
                        $classRecord->student_number = $validatedData['student_number'];
                        $classRecord->school_year = $validatedData['school_year'];
                        $classRecord->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                        $classRecord->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                        $classRecord->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                        $classRecord->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                        $classRecord->gender = $validatedData['gender'];
                        $classRecord->quarter = $quarter;
                        $classRecord->grade = $validatedData['grade'];
                        $classRecord->section = $validatedData['section'];
                        $classRecord->subject = $subject->subject;

                        // Save the class record
                        $classRecord->save();
                    }

                    $finalGrade = new StudentFinalGrade();
                    $finalGrade->lrn = $validatedData['lrn'];
                    $finalGrade->student_number = $validatedData['student_number'];
                    $finalGrade->school_year = $validatedData['school_year'];
                    $finalGrade->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                    $finalGrade->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                    $finalGrade->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                    $finalGrade->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                    $finalGrade->gender = $validatedData['gender'];
                    $finalGrade->grade = $validatedData['grade'];
                    $finalGrade->section = $validatedData['section'];
                    $finalGrade->teacher_number = $validatedData['adviser'];
                    $finalGrade->subject = $subject->subject;

                    // Save the final grade record
                    $finalGrade->save();
                }
            } else if (in_array($validatedData['grade'], ['Grade Four'])) {
                $subjects = Subject::where('grade', 'Grade Four')->get();
                $quarters = ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'];

                foreach ($subjects as $subject) {
                    foreach ($quarters as $quarter) {
                        $classRecord = new GradeFourClassRecord();
                        $classRecord->lrn = $validatedData['lrn'];
                        $classRecord->student_number = $validatedData['student_number'];
                        $classRecord->school_year = $validatedData['school_year'];
                        $classRecord->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                        $classRecord->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                        $classRecord->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                        $classRecord->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                        $classRecord->gender = $validatedData['gender'];
                        $classRecord->quarter = $quarter;
                        $classRecord->grade = $validatedData['grade'];
                        $classRecord->section = $validatedData['section'];
                        $classRecord->subject = $subject->subject;

                        // Save the class record
                        $classRecord->save();
                    }

                    $finalGrade = new StudentFinalGrade();
                    $finalGrade->lrn = $validatedData['lrn'];
                    $finalGrade->student_number = $validatedData['student_number'];
                    $finalGrade->school_year = $validatedData['school_year'];
                    $finalGrade->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                    $finalGrade->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                    $finalGrade->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                    $finalGrade->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                    $finalGrade->gender = $validatedData['gender'];
                    $finalGrade->grade = $validatedData['grade'];
                    $finalGrade->section = $validatedData['section'];
                    $finalGrade->teacher_number = $validatedData['adviser'];
                    $finalGrade->subject = $subject->subject;

                    // Save the final grade record
                    $finalGrade->save();
                }
            } else if (in_array($validatedData['grade'], ['Grade Five'])) {
                $subjects = Subject::where('grade', 'Grade Five')->get();
                $quarters = ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'];

                foreach ($subjects as $subject) {
                    foreach ($quarters as $quarter) {
                        $classRecord = new GradeFiveClassRecord();
                        $classRecord->lrn = $validatedData['lrn'];
                        $classRecord->student_number = $validatedData['student_number'];
                        $classRecord->school_year = $validatedData['school_year'];
                        $classRecord->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                        $classRecord->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                        $classRecord->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                        $classRecord->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                        $classRecord->gender = $validatedData['gender'];
                        $classRecord->quarter = $quarter;
                        $classRecord->grade = $validatedData['grade'];
                        $classRecord->section = $validatedData['section'];
                        $classRecord->subject = $subject->subject;

                        // Save the class record
                        $classRecord->save();
                    }

                    $finalGrade = new StudentFinalGrade();
                    $finalGrade->lrn = $validatedData['lrn'];
                    $finalGrade->student_number = $validatedData['student_number'];
                    $finalGrade->school_year = $validatedData['school_year'];
                    $finalGrade->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                    $finalGrade->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                    $finalGrade->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                    $finalGrade->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                    $finalGrade->gender = $validatedData['gender'];
                    $finalGrade->grade = $validatedData['grade'];
                    $finalGrade->section = $validatedData['section'];
                    $finalGrade->teacher_number = $validatedData['adviser'];
                    $finalGrade->subject = $subject->subject;

                    // Save the final grade record
                    $finalGrade->save();
                }
            } else if (in_array($validatedData['grade'], ['Grade Six'])) {
                $subjects = Subject::where('grade', 'Grade Six')->get();
                $quarters = ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'];

                foreach ($subjects as $subject) {
                    foreach ($quarters as $quarter) {
                        $classRecord = new GradeSixClassRecord();
                        $classRecord->lrn = $validatedData['lrn'];
                        $classRecord->student_number = $validatedData['student_number'];
                        $classRecord->school_year = $validatedData['school_year'];
                        $classRecord->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                        $classRecord->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                        $classRecord->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                        $classRecord->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                        $classRecord->gender = $validatedData['gender'];
                        $classRecord->quarter = $quarter;
                        $classRecord->grade = $validatedData['grade'];
                        $classRecord->section = $validatedData['section'];
                        $classRecord->subject = $subject->subject;

                        // Save the class record
                        $classRecord->save();
                    }

                    $finalGrade = new StudentFinalGrade();
                    $finalGrade->lrn = $validatedData['lrn'];
                    $finalGrade->student_number = $validatedData['student_number'];
                    $finalGrade->school_year = $validatedData['school_year'];
                    $finalGrade->last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
                    $finalGrade->first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
                    $finalGrade->middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
                    $finalGrade->suffix = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
                    $finalGrade->gender = $validatedData['gender'];
                    $finalGrade->grade = $validatedData['grade'];
                    $finalGrade->section = $validatedData['section'];
                    $finalGrade->teacher_number = $validatedData['adviser'];
                    $finalGrade->subject = $subject->subject;

                    // Save the final grade record
                    $finalGrade->save();
                }
            }
            // Redirect or return response
            return redirect()->route('registrar.new.student')->with('success', 'Student enrolled successfully!');
        } catch (\Exception $e) {
            \Log::error('Error adding student: ' . $e->getMessage());

            return back()->withErrors('An error occurred while adding the student: ' . $e->getMessage());
        }
    }

    // Fetch the specific student based on the provided id
    public function getPrimaryInfo(request $request, $lrn)
    {
        $students = StudentPrimaryInfo::where('lrn', $lrn)->where('status', 'Registered')->first();

        $studentsInfo = StudentInfo::where('lrn', $students->lrn)->first();

        // If the student doesn't exist, you could redirect back or show an error message
        if (!$students) {
            return back()->withErrors('Student not found.');
        }

        // You can pass other data here as needed
        return view('registrar.includes.register_student_form', compact('students', 'studentsInfo'));
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

    public function showAllRegisterAdmission()
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

        return view('admission.admission_registration', compact('students', 'studentInfo', 'studentsAdditional', 'studentDocuments', 'studentAccount', 'noActiveMessage'));
    }

    public function showAllRegisterRegistrar()
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

        return view('registrar.registrar_registration', compact('students', 'studentInfo', 'studentsAdditional', 'studentDocuments', 'studentAccount', 'noActiveMessage'));
    }
}
