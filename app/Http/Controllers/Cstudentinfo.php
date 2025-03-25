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

class Cstudentinfo extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'lrn' => 'required|unique:student_info,lrn',

            'student_number' => '|unique:student_info,student_number',
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
            // Additional validation for additional info
            'father_last_name' => 'required',
            'father_first_name' => 'required',
            'father_middle_name' => 'nullable',
            'father_suffix_name' => 'nullable',
            'father_occupation' => 'required',
            'mother_last_name' => 'required',
            'mother_first_name' => 'required',
            'mother_middle_name' => 'nullable',
            'mother_occupation' => 'required',
            'guardian_last_name' => 'required',
            'guardian_first_name' => 'required',
            'guardian_middle_name' => 'nullable',
            'guardian_suffix_name' => 'nullable',
            'guardian_relationship' => 'required',
            'guardian_contact_number' => 'required',
            'guardian_religion' => 'required',
            'emergency_contact_person' => 'required',
            'emergency_contact_number' => 'required',
            'email_address' => 'nullable|email',
            'messenger_account' => 'nullable',
            // File upload validations
            'birth_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sf10' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sf9' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            //usewraccount
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            // Create user account
            $username = strtolower($validatedData['lastName']) . strtolower($validatedData['firstName']) . '@stemilie.edu.ph';
            //$password = 'SELC' . $validatedData['lastName'] . substr($validatedData['student_number'], -4);
            //SELC{{ $student->student_last_name }}{{ substr($student->student_number, -4) }}

            $userAccount = new Mstudentaccount();
            $userAccount->student_number = $validatedData['student_number'];
            $userAccount->username = $validatedData['username'];
            $userAccount->password = $validatedData['password'];
            $userAccount->save();

            // Create student record
            $student = new StudentInfo();
            $student->lrn = $validatedData['lrn'];
            $student->student_number = $validatedData['student_number'];
            $student->student_last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
            $student->student_first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
            $student->student_middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
            $student->student_suffix_name = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
            $student->place_of_birth = $validatedData['birthplace'] ? ucwords(strtolower($validatedData['birthplace'])) : null;
            $student->birth_date = $validatedData['birthDate'];
            $student->age = $validatedData['age'];
            $student->sex = $validatedData['gender'];
            $student->email_address_send = $validatedData['email'];
            $student->contact_number = $validatedData['contactNo'];
            $student->religion = $validatedData['religion'] ? ucwords(strtolower($validatedData['religion'])) : null;
            $student->house_number = $validatedData['house_number'] ? ucwords(strtolower($validatedData['house_number'])) : null;
            $student->street = $validatedData['street'] ? ucwords(strtolower($validatedData['street'])) : null;
            $student->barangay = $validatedData['barangay'] ? ucwords(strtolower($validatedData['barangay'])) : null;
            $student->province = $validatedData['province'] ? ucwords(strtolower($validatedData['province'])) : null;
            $student->city = $validatedData['city'] ? ucwords(strtolower($validatedData['city'])) : null;
            $student->save();

            // Create additional info record
            $additionalInfo = new StudentAdditionalInfo();
            $additionalInfo->student_number = $validatedData['student_number']; // Link to student
            $additionalInfo->father_last_name = $validatedData['father_last_name'] ? ucwords(strtolower($validatedData['father_last_name'])) : null;
            $additionalInfo->father_first_name = $validatedData['father_first_name'] ? ucwords(strtolower($validatedData['father_first_name'])) : null;
            $additionalInfo->father_middle_name = $validatedData['father_middle_name'] ? ucwords(strtolower($validatedData['father_middle_name'])) : null;
            $additionalInfo->father_suffix_name = $validatedData['father_suffix_name'] ? ucwords(strtolower($validatedData['father_suffix_name'])) : null;
            $additionalInfo->father_occupation = $validatedData['father_occupation'] ? ucwords(strtolower($validatedData['father_occupation'])) : null;
            $additionalInfo->mother_last_name = $validatedData['mother_last_name'] ? ucwords(strtolower($validatedData['mother_last_name'])) : null;
            $additionalInfo->mother_first_name = $validatedData['mother_first_name'] ? ucwords(strtolower($validatedData['mother_first_name'])) : null;
            $additionalInfo->mother_middle_name = $validatedData['mother_middle_name'] ? ucwords(strtolower($validatedData['mother_middle_name'])) : null;
            $additionalInfo->mother_occupation = $validatedData['mother_occupation'] ? ucwords(strtolower($validatedData['mother_occupation'])) : null;
            $additionalInfo->guardian_last_name = $validatedData['guardian_last_name'] ? ucwords(strtolower($validatedData['guardian_last_name'])) : null;
            $additionalInfo->guardian_first_name = $validatedData['guardian_first_name'] ? ucwords(strtolower($validatedData['guardian_first_name'])) : null;
            $additionalInfo->guardian_middle_name = $validatedData['guardian_middle_name'] ? ucwords(strtolower($validatedData['guardian_middle_name'])) : null;
            $additionalInfo->guardian_suffix_name = $validatedData['guardian_suffix_name'] ? ucwords(strtolower($validatedData['guardian_suffix_name'])) : null;
            $additionalInfo->guardian_relationship = $validatedData['guardian_relationship'] ? ucwords(strtolower($validatedData['guardian_relationship'])) : null;
            $additionalInfo->guardian_contact_number = $validatedData['guardian_contact_number'];
            $additionalInfo->guardian_religion = $validatedData['guardian_religion'] ? ucwords(strtolower($validatedData['guardian_religion'])) : null;
            $additionalInfo->emergency_contact_person = $validatedData['emergency_contact_person'] ? ucwords(strtolower($validatedData['emergency_contact_person'])) : null;
            $additionalInfo->emergency_contact_number = $validatedData['emergency_contact_number'];
            $additionalInfo->email_address = $validatedData['email_address'];
            $additionalInfo->messenger_account = $validatedData['messenger_account'];
            $additionalInfo->save();


            $studentprimary = new StudentPrimaryInfo();
            $studentprimary->lrn = $validatedData['lrn'];
            $studentprimary->studentnumber = $validatedData['student_number'];
            $studentprimary->grade = $validatedData['grade'] ? ucwords(strtolower($validatedData['grade'])) : null;
            $studentprimary->school_year = $validatedData['school_year'];
            $studentprimary->section = $validatedData['section'] ? ucwords(strtolower($validatedData['section'])) : null;
            $studentprimary->status = $validatedData['status'] ? ucwords(strtolower($validatedData['status'])) : null;
            $studentprimary->adviser = $validatedData['adviser'] ? ucwords(strtolower($validatedData['adviser'])) : null;
            $studentprimary->save();


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

            // Handle file uploads
            $birthCertificatePath = $request->hasFile('birth_certificate') ? $request->file('birth_certificate')->store('documents', 'public') : null;
            $proofOfResidencyPath = $request->hasFile('sf10') ? $request->file('sf10')->store('documents', 'public') : null;
            $sf9 = $request->hasFile('sf9') ? $request->file('sf9')->store('documents', 'public') : null;

            // Create student documents record
            $studentDocuments = new StudentDocuments();
            $studentDocuments->student_number = $validatedData['student_number']; // Link to student
            $studentDocuments->birth_certificate = $birthCertificatePath;
            $studentDocuments->sf10 = $proofOfResidencyPath;
            $studentDocuments->sf9 = $sf9;

            $studentDocuments->save();

            // Redirect or return response
            return back()->with('success', 'Student added successfully!');
        } catch (\Exception $e) {
            \Log::error('Error adding student: ' . $e->getMessage());

            return back()->withErrors('An error occurred while adding the student: ' . $e->getMessage());
        }
    }

    public function resetAccount(Request $request, $studentId)
    {
        // Find the student by ID
        $student = StudentInfo::find($studentId);

        if (!$student) {
            return back()->withErrors('Student not found.');
        }

        // Create username
        $username = strtolower($student->student_last_name) . strtolower($student->student_first_name) . '@stemilie.edu.ph';

        // Validate incoming request for defaultPassword
        $validatedData = $request->validate([
            'defaultPassword' => 'required',
        ]);

        $userAccount = new Mstudentaccount();
        // Get the password from the input
        $userAccount->password = $validatedData['defaultPassword'];

        // Create or update user account
        $userAccount = Mstudentaccount::firstOrNew(['student_number' => $student->student_number]);
        $userAccount->username = $username;
        $userAccount->password = $validatedData['defaultPassword']; // Hash the provided password
        $userAccount->save();

        return back()->with('success', 'Account reset successfully for ' . $student->student_first_name . '!');
    }

    public function sendEmail(Request $request, $studentId)
    {
        // Find the student by ID
        $student = StudentInfo::find($studentId);

        if (!$student) {
            return back()->withErrors('Student not found.');
        }

        // Send the email
        Mail::to($student->email_address_send)->send(new MLsendemail($student));

        return back()->with('success', 'Email sent successfully to ' . $student->student_first_name . '!');
    }

    public function updateStudentInfo(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required',
            'section' => 'nullable',
            'adviser' => 'nullable',
            'lrn' => 'required',
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
            'city' => 'required',
            'province' => 'required',
            'father_last_name' => 'required',
            'father_first_name' => 'required',
            'father_middle_name' => 'nullable',
            'father_suffix_name' => 'nullable',
            'father_occupation' => 'required',
            'mother_last_name' => 'required',
            'mother_first_name' => 'required',
            'mother_middle_name' => 'nullable',
            'mother_occupation' => 'required',
            'guardian_last_name' => 'required',
            'guardian_first_name' => 'required',
            'guardian_middle_name' => 'nullable',
            'guardian_suffix_name' => 'nullable',
            'guardian_relationship' => 'required',
            'guardian_contact_number' => 'required',
            'guardian_religion' => 'required',
            'emergency_contact_person' => 'required',
            'emergency_contact_number' => 'required',
            'email_address' => 'required|email',
            'messenger_account' => 'nullable',
            'birth_certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sf10' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sf9' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $student = StudentInfo::findOrFail($id);

        $student->update([
            'status' => $validatedData['status'],
            'lrn' => $validatedData['lrn'],
            'student_last_name' => $validatedData['lastName'],
            'student_first_name' => $validatedData['firstName'],
            'student_middle_name' => $validatedData['middleName'],
            'student_suffix_name' => $validatedData['suffixName'],
            'place_of_birth' => $validatedData['birthplace'],
            'birth_date' => $validatedData['birthDate'],
            'age' => $validatedData['age'],
            'sex' => $validatedData['gender'],
            'email_address_send' => $validatedData['email'],
            'contact_number' => $validatedData['contactNo'],
            'religion' => $validatedData['religion'],
            'house_number' => $validatedData['house_number'],
            'street' => $validatedData['street'],
            'barangay' => $validatedData['barangay'],
            'city' => $validatedData['city'],
            'province' => $validatedData['province'],
        ]);

        StudentAdditionalInfo::updateOrCreate(
            ['student_number' => $student->student_number],
            [
                'father_last_name' => $validatedData['father_last_name'],
                'father_first_name' => $validatedData['father_first_name'],
                'father_middle_name' => $validatedData['father_middle_name'],
                'father_suffix_name' => $validatedData['father_suffix_name'],
                'father_occupation' => $validatedData['father_occupation'],
                'mother_last_name' => $validatedData['mother_last_name'],
                'mother_first_name' => $validatedData['mother_first_name'],
                'mother_middle_name' => $validatedData['mother_middle_name'],
                'mother_occupation' => $validatedData['mother_occupation'],
                'guardian_last_name' => $validatedData['guardian_last_name'],
                'guardian_first_name' => $validatedData['guardian_first_name'],
                'guardian_middle_name' => $validatedData['guardian_middle_name'],
                'guardian_suffix_name' => $validatedData['guardian_suffix_name'],
                'guardian_relationship' => $validatedData['guardian_relationship'],
                'guardian_contact_number' => $validatedData['guardian_contact_number'],
                'guardian_religion' => $validatedData['guardian_religion'],
                'emergency_contact_person' => $validatedData['emergency_contact_person'],
                'emergency_contact_number' => $validatedData['emergency_contact_number'],
                'email_address' => $validatedData['email_address'],
                'messenger_account' => $validatedData['messenger_account'],
            ]
        );

        StudentDocuments::updateOrCreate(
            ['student_number' => $student->student_number],
            [
                'birth_certificate' => $request->hasFile('birth_certificate')
                    ? $request->file('birth_certificate')->store('documents', 'public')
                    : optional($student->documents)->birth_certificate,
                'sf10' => $request->hasFile('sf10')
                    ? $request->file('sf10')->store('documents', 'public')
                    : optional($student->documents)->sf10,
                'sf9' => $request->hasFile('sf9')
                    ? $request->file('sf9')->store('documents', 'public')
                    : optional($student->documents)->sf9,
            ]
        );

        StudentPrimaryInfo::updateOrCreate(
            ['studentnumber' => $student->student_number],
            [
                'status' => $validatedData['status'],
                'section' => ucwords(strtolower($validatedData['section'] ?? '')),
                'adviser' => ucwords(strtolower($validatedData['adviser'] ?? '')),
            ]
        );

        return back()->with('success', 'Student information updated successfully!');
    }

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
        return view('admin.includes.student_information', compact('students', 'studentsPrimary', 'teachers', 'studentsAdditional', 'studentsPrimaryOne', 'studentDocuments', 'studentAccount', 'finalGradeOne', 'finalGradeTwo', 'finalGradeThree', 'finalGradeFour', 'finalGradeFive', 'finalGradeSix'));
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
        return view('admin.includes.student_information', compact('students', 'studentsPrimary', 'teachers', 'studentsAdditional', 'studentsPrimaryOne', 'studentDocuments', 'studentAccount', 'finalGradeOne', 'finalGradeTwo', 'finalGradeThree', 'finalGradeFour', 'finalGradeFive', 'finalGradeSix'));
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
        return view('admin.includes.student_information', compact('students', 'studentsPrimary', 'teachers', 'studentsAdditional', 'studentsPrimaryOne', 'studentDocuments', 'studentAccount', 'finalGradeOne', 'finalGradeTwo', 'finalGradeThree', 'finalGradeFour', 'finalGradeFive', 'finalGradeSix'));
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
        return view('admin.includes.student_information', compact('students', 'studentsPrimary', 'teachers', 'studentsAdditional', 'studentsPrimaryOne', 'studentDocuments', 'studentAccount', 'finalGradeOne', 'finalGradeTwo', 'finalGradeThree', 'finalGradeFour', 'finalGradeFive', 'finalGradeSix'));
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

        return view('admin.admin_show_all_data', compact('students', 'gradeOne', 'gradeTwo', 'gradeThree', 'gradeFour', 'gradeFive', 'gradeSix', 'studentsAdditional', 'studentDocuments', 'studentAccount', 'studentGradeOne', 'studentGradeTwo', 'studentGradeThree', 'studentGradeFour', 'studentGradeFive', 'studentGradeSix', 'noActiveMessage'));
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

        return view('admin.admin_graduate_students', compact('students', 'studentsAdditional', 'studentDocuments', 'noGraduatesMessage', ));
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

        return view('admin.admin_drop_student', compact('students', 'studentsAdditional', 'studentDocuments', 'noDroppedMessage', 'studentAccount', 'myTeacher'));
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

        return view('admin.admin_show_all_drop_data', compact('students', 'studentsAdditional', 'studentDocuments', 'noDroppedMessage', 'studentAccount', 'myTeacher'));
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

        return view('admin.admin_archive_student', compact('students', 'studentsAdditional', 'studentDocuments', 'noDroppedMessage', 'studentAccount', 'myTeacher'));
    }

    public function showGradeData()
    {

        // Fetch all student records
        $students = StudentInfo::all();

        // Count the number of students
        $studentCount = $students->count();

        // Check if there are no students
        $noGradeOneMessage = $studentCount === 0 ? "No students found." : null;

        return view('admin.admin_student_management', compact('students', 'noGradeOneMessage'))
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
        return view('admin.admin_student_management_gradeone', compact('students', 'noGradeOneMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));
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
        return view('admin.admin_student_management_gradetwo', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

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
        return view('admin.admin_student_management_gradethree', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

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
        return view('admin.admin_student_management_gradefour', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

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
        return view('admin.admin_student_management_gradefive', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));

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
        return view('admin.admin_student_management_gradesix', compact('students', 'noGradeTwoMessage', 'myTeacher', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));
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

        return view('admin.admin_gradebook', compact('students', 'noGradeOneMessage'))
            ->with('students', $students)
            ->with('noGradeOneMessage', $noGradeOneMessage);
    }
}