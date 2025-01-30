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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Madminaccount;
use App\Mail\MLsendemail;
use Illuminate\Support\Facades\Mail;
class Cstudentinfo extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'student_number' => 'required|unique:student_info,student_number',
            'lrn' => 'required',
            'grade' => 'required',
            'school_year' => 'required',
            'section' => 'required',
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
            'birth_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'proof_of_residency' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            //usewraccount
            'password' => 'required',
        ]);

        try {
            // Create student record
            $student = new StudentInfo();
            $student->student_number = $validatedData['student_number'];
            $student->lrn = $validatedData['lrn'];
            $student->grade = $validatedData['grade'];
            $student->school_year = $validatedData['school_year'];
            $student->section = $validatedData['section'] ? ucwords(strtolower($validatedData['section'])) : null;
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


            // Handle file uploads
            $birthCertificatePath = $request->file('birth_certificate')->store('documents', 'public');
            $proofOfResidencyPath = $request->file('proof_of_residency')->store('documents', 'public');

            // Create student documents record
            $studentDocuments = new StudentDocuments();
            $studentDocuments->student_number = $validatedData['student_number']; // Link to student
            $studentDocuments->birth_certificate = $birthCertificatePath;
            $studentDocuments->proof_of_residency = $proofOfResidencyPath;
            $studentDocuments->save();

            // Create user account
            $username = strtolower($validatedData['lastName']) . strtolower($validatedData['firstName']) . '@stemilie.edu.ph';
            //$password = 'SELC' . $validatedData['lastName'] . substr($validatedData['student_number'], -4);
            //SELC{{ $student->student_last_name }}{{ substr($student->student_number, -4) }}

            $userAccount = new Mstudentaccount();
            $userAccount->student_number = $validatedData['student_number'];
            $userAccount->username = $username;
            $userAccount->password = $validatedData['password'];
            $userAccount->save();

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
        // Validate request data
        $validatedData = $request->validate([
            'student_number' => 'required',
            'status' => 'required',
            'lrn' => 'required',
            'grade' => 'required',
            'school_year' => 'required',
            'section' => 'required',
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
            'proof_of_residency' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Find student record
        $student = StudentInfo::findOrFail($id);

        // Update student info
        $student->update([
            'student_number' => $validatedData['student_number'],
            'status' => $validatedData['status'],
            'lrn' => $validatedData['lrn'],
            'school_year' => $validatedData['school_year'],
            'grade' => $validatedData['grade'],
            'section' => $validatedData['section'],
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

        // Update or create additional student info
        StudentAdditionalInfo::updateOrCreate(
            ['student_number' => $validatedData['student_number']],
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

        // Handle document uploads
        $studentDocuments = StudentDocuments::updateOrCreate(
            ['student_number' => $student->student_number],
            [
                'birth_certificate' => $request->hasFile('birth_certificate')
                    ? $request->file('birth_certificate')->store('documents', 'public')
                    : ($student->documents->birth_certificate ?? null),
                'proof_of_residency' => $request->hasFile('proof_of_residency')
                    ? $request->file('proof_of_residency')->store('documents', 'public')
                    : ($student->documents->proof_of_residency ?? null),
            ]
        );

        return back()->with('success',  'Student information updated successfully!');
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
        $student->status = 'Active';
        $student->save();

        // Redirect or return response
        return back()->with('success', 'Student retrieve successfully!');
    }

    public function showAllStudentData()
    {
        // Fetch all active student records with pagination
        $students = StudentInfo::where('status', 'Active')->get();

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
        $students = StudentInfo::where('status', 'Graduated')
        ->whereIn('school_year', ['2021-2022', '2022-2023', '2023-2024', '2024-2025', '2025-2026', '2026-2027'])
        ->get();

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

        // Fetch additional student information for each student
        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch additional student information for each student
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Check if there are no dropped students
        $noDroppedMessage = $students->isEmpty() ? "No dropped students found." : null;

        return view('admin.admin_drop_student', compact('students', 'studentsAdditional', 'studentDocuments','noDroppedMessage'));
    }

    public function showAllStudentDroppedData()
    {
        // Fetch all dropped student records
        $students = StudentInfo::where('status', 'Dropped')->get();

        // Fetch additional student information for each student
        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch additional student information for each student
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Check if there are no dropped students
        $noDroppedMessage = $students->isEmpty() ? "No dropped students found." : null;

        return view('admin.admin_show_all_drop_data', compact('students', 'studentsAdditional', 'studentDocuments', 'noDroppedMessage'));
    }

    public function showAllStudentArchiveData()
    {
        // Fetch all graduated student records for the specified school years
        $students = StudentInfo::where('status', 'graduated')
            ->whereIn('school_year', ['2020-2021', '2019-2020', '2018-2019', '2017-2018', '2016-2015', '2014-2015'])
            ->get();

            // Fetch additional student information for each student
        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Fetch additional student information for each student
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Check if there are no archived students
        $noArchiveMessage = $students->isEmpty() ? "No Archive students found." : null;

        return view('admin.admin_archive_student', compact('students', 'studentsAdditional', 'studentDocuments', 'noArchiveMessage'));
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
        // Fetch all active student records with additional info and documents using eager loading
        $students = StudentInfo::with(['additionalInfo', 'documents'])
            ->where('grade', 'Grade One')
            ->where('status', 'Active')
            ->get();

        // Check if there are no active students
        $noGradeOneMessage = $students->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return view('admin.admin_student_management_gradeone', compact('students', 'noGradeOneMessage'));
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
        // Fetch all Grade Two student records
        $students = StudentInfo::where('grade', 'Grade Two')->where('status', 'Active')->get();

        // Check if there are no students in Grade Two
        $noGradeTwoMessage = $students->isEmpty() ? "No students found in Grade Two." : null;

        return view('admin.admin_student_management_gradetwo', compact('students', 'noGradeTwoMessage'));
    }

    public function showGradeThreeData()
    {
        // Fetch all Grade Three student records
        $students = StudentInfo::where('grade', 'Grade Three')->where('status', 'Active')->get();

        // Check if there are no students in Grade Three
        $noGradeThreeMessage = $students->isEmpty() ? "No students found in Grade Three." : null;

        return view('admin.admin_student_management_gradethree', compact('students', 'noGradeThreeMessage'));
    }

    public function showGradeFourData()
    {
        // Fetch all Grade Four student records
        $students = StudentInfo::where('grade', 'Grade Four')->where('status', 'Active')->get();

        // Check if there are no students in Grade Four
        $noGradeFourMessage = $students->isEmpty() ? "No students found in Grade Four." : null;

        return view('admin.admin_student_management_gradefour', compact('students', 'noGradeFourMessage'));
    }

    public function showGradeFiveData()
    {
        // Fetch all Grade Five student records
        $students = StudentInfo::where('grade', 'Grade Five')->where('status', 'Active')->get();

        // Check if there are no students in Grade Five
        $noGradeFiveMessage = $students->isEmpty() ? "No students found in Grade Five." : null;

        return view('admin.admin_student_management_gradefive', compact('students', 'noGradeFiveMessage'));
    }

    public function showGradeSixData()
    {
        // Fetch all Grade Six student records
        $students = StudentInfo::where('grade', 'Grade Six')->where('status', 'Active')->get();

        // Check if there are no students in Grade Six
        $noGradeSixMessage = $students->isEmpty() ? "No students found in Grade Six." : null;

        return view('admin.admin_student_management_gradesix', compact('students', 'noGradeSixMessage'));
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