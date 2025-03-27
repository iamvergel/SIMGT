<?php
namespace App\Http\Controllers;

use App\Models\GradeFiveClassRecord;
use App\Models\GradeFourClassRecord;
use App\Models\GradeOneClassRecord;
use App\Models\GradeSixClassRecord;
use App\Models\GradeThreeClassRecord;
use App\Models\GradeTwoClassRecord;
use App\Models\StudentFinalGrade;
use App\Models\Subject;
use App\Models\TeacherSubjectClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherSubjectClassController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'grade' => 'required|string',
            'section' => 'required|string',
            'subject' => 'required|string',
            'school_year' => 'required|string',
            'teacher_number' => 'required|string', // Ensuring teacher_number is provided
        ]);

        // List of quarters
        $quarters = ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'];

        // Check if the teacher already have this subject
        $checkSubject = TeacherSubjectClass::where([
            'teacher_number' => $validatedData['teacher_number'],
            'grade' => ucwords(strtolower($validatedData['grade'])),
            'section' => ucwords(strtolower($validatedData['section'])),
            'subject' => $validatedData['subject'],
            'school_year' => $validatedData['school_year'],
        ])->first();

        if ($checkSubject) {
            return back()->with('error', 'The teacher already has this subject assigned.');
        }

        // Create TeacherSubjectClass records for each quarter
        foreach ($quarters as $quarter) {
            TeacherSubjectClass::updateOrCreate(
                [
                    'teacher_number' => $validatedData['teacher_number'],
                    'grade' => ucwords(strtolower($validatedData['grade'])),
                    'section' => ucwords(strtolower($validatedData['section'])),
                    'subject' => $validatedData['subject'],
                    'school_year' => $validatedData['school_year'],
                    'quarter' => $quarter,
                ],
                [
                    'teacher_number' => $validatedData['teacher_number'],
                ]
            );
        }

        // Determine the correct model based on the grade
        $gradeClassRecordModel = [
            'Grade One' => GradeOneClassRecord::class,
            'Grade Two' => GradeTwoClassRecord::class,
            'Grade Three' => GradeThreeClassRecord::class,
            'Grade Four' => GradeFourClassRecord::class,
            'Grade Five' => GradeFiveClassRecord::class,
            'Grade Six' => GradeSixClassRecord::class,
        ][$validatedData['grade']] ?? null;

        if ($gradeClassRecordModel) {
            foreach ($quarters as $quarter) {
                // Update the teacher number for all records with the same grade, section, subject, school year, and quarter
                $gradeClassRecordModel::where([
                    'grade' => $validatedData['grade'],
                    'section' => $validatedData['section'],
                    'subject' => $validatedData['subject'],
                    'school_year' => $validatedData['school_year'],
                    'quarter' => $quarter,
                ])->update(['teacher_number' => $validatedData['teacher_number']]);
            }
        }

        // Update teacher_number in StudentFinalGrade
        StudentFinalGrade::where([
            'grade' => $validatedData['grade'],
            'section' => $validatedData['section'],
            'subject' => $validatedData['subject'],
            'school_year' => $validatedData['school_year'],
        ])->update(['teacher_number' => $validatedData['teacher_number']]);

        // Return success response
        return back()->with('success', 'Subject Class added successfully!');
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
        $user->subject = $request->subject ? $request['subject'] : null;

        // Save the updated user details
        $user->save();

        // Return success response
        return back()->with('success', 'Update Information Successfully!');
    }

    public function getClassSubject()
    {
        $teacherNumber = Auth::guard('teacher')->user()->teacher_number;

        // Fetch distinct subjects and their corresponding school years
        $subjects = TeacherSubjectClass::whereNotNull('subject')
            ->where('subject', '!=', '')
            ->where('teacher_number', $teacherNumber)
            ->where('school_year', '!=', '')
            ->where('grade', '!=', '')
            ->where('section', '!=', '')
            ->distinct()
            ->get(['subject', 'school_year', 'grade', 'section']);

        return response()->json($subjects);
    }
    
    public function getTeacherSubject(Request $request)
{
    // Get the teacher number from the request
    $teacherNumber = $request->teacher_number;

    // Fetch distinct subjects based on teacher_number and school_year
    $subjects = TeacherSubjectClass::select('subject', 'school_year', 'grade', 'section')
        ->whereNotNull('subject')
        ->where('subject', '!=', '')
        ->where('teacher_number', $teacherNumber)
        ->where('school_year', $request->school_year)  // Filter by school_year
        ->where('grade', '!=', '')
        ->where('section', '!=', '')
        ->distinct()
        ->get();

    // Add logging for debugging
    \Log::info('Fetched Subjects:', $subjects->toArray());

    return response()->json($subjects);
}

    public function getTeacherClassSubject()
    {
        try {
            $teacherNumber = Auth::guard('teacher')->user()->teacher_number;

            // Fetch distinct subjects and their corresponding school years
            $subjects = TeacherSubjectClass::whereNotNull('subject')
                ->where('subject', '!=', '')
                ->where('teacher_number', $teacherNumber)
                ->where('school_year', '!=', '')
                ->distinct()
                ->get(['subject', 'school_year']);

            return response()->json($subjects);
        } catch (\Exception $e) {
            \Log::error('Error fetching subjects: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching subjects.'], 500);
        }
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
        $teacherNumber = auth('teacher')->user()->teacher_number;

        $TeacherSubject = TeacherSubjectClass::where('teacher_number', $teacherNumber)
            ->where('school_year', now()->format('Y') . '-' . (now()->format('Y') + 1))
            ->get();

        $StudentFinals = StudentFinalGrade::where('teacher_number', $teacherNumber)
            ->where('school_year', now()->format('Y') . '-' . (now()->format('Y') + 1))
            ->get();

        $allRecords = GradeOneClassRecord::where('teacher_number', $teacherNumber)
            ->where('school_year', now()->format('Y') . '-' . (now()->format('Y') + 1))
            ->get()
            ->merge(GradeTwoClassRecord::where('teacher_number', $teacherNumber)
                ->where('school_year', now()->format('Y') . '-' . (now()->format('Y') + 1))
                ->get())
            ->merge(GradeThreeClassRecord::where('teacher_number', $teacherNumber)
                ->where('school_year', now()->format('Y') . '-' . (now()->format('Y') + 1))
                ->get())
            ->merge(GradeFourClassRecord::where('teacher_number', $teacherNumber)
                ->where('school_year', now()->format('Y') . '-' . (now()->format('Y') + 1))
                ->get())
            ->merge(GradeFiveClassRecord::where('teacher_number', $teacherNumber)
                ->where('school_year', now()->format('Y') . '-' . (now()->format('Y') + 1))
                ->get())
            ->merge(GradeSixClassRecord::where('teacher_number', $teacherNumber)
                ->where('school_year', now()->format('Y') . '-' . (now()->format('Y') + 1))
                ->get());

        $students = $allRecords;

        return view('teacher.teacher_classsubject', compact('TeacherSubject', 'students', 'StudentFinals'));
    }

    public function updateInline(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'id' => 'required|exists:teacher_subject_class,id', // Ensure the teacher record exists
            'column' => 'required|string', // The column to update
            'value' => 'required|numeric', // Assuming all columns are numeric (adjust as necessary)
        ]);

        // Find the TeacherSubjectClass record by ID
        $teacherSubjectClass = TeacherSubjectClass::findOrFail($request->id);

        // Dynamically update the specified column in the teacher's record
        $teacherSubjectClass->{$request->column} = $request->value;

        // If the column being updated is related to performance (e.g., hps_written_one, hps_performance_one, etc.)
        $performanceColumns = [
            'hps_written_one',
            'hps_written_two',
            'hps_written_three',
            'hps_written_four',
            'hps_written_five',
            'hps_written_six',
            'hps_written_seven',
            'hps_written_eight',
            'hps_written_nine',
            'hps_written_ten',
            'written_ws',
            'hps_performance_one',
            'hps_performance_two',
            'hps_performance_three',
            'hps_performance_four',
            'hps_performance_five',
            'hps_performance_six',
            'hps_performance_seven',
            'hps_performance_eight',
            'hps_performance_nine',
            'hps_performance_ten',
            'performance_ws',
            'hps_q_assessment_one',
            'hps_q_assessment_ws',
        ];

        // If the updated column is one of the performance-related columns, update student records
        if (in_array($request->column, $performanceColumns)) {
            $grades = ['Grade One', 'Grade Two', 'Grade Three', 'Grade Four', 'Grade Five', 'Grade Six'];

            foreach ($grades as $grade) {
                // Get the appropriate student model for each grade
                $studentRecords = $this->getGradeModel($grade);

                // Update the student records with the same value for the given column
                $studentRecords::where([
                    'teacher_number' => $teacherSubjectClass->teacher_number,
                    'grade' => $teacherSubjectClass->grade,
                    'section' => $teacherSubjectClass->section,
                    'quarter' => $teacherSubjectClass->quarter,
                    'subject' => $teacherSubjectClass->subject,
                ])->update([$request->column => $request->value]);
            }
        }

        // Save the teacher's record after updating the column
        $teacherSubjectClass->save();

        // Return a success response
        return response()->json(['success' => true]);
    }

    private function getGradeModel($grade)
    {
        // Map the grade to the corresponding model class
        $gradeClassMap = [
            'Grade One' => GradeOneClassRecord::class,
            'Grade Two' => GradeTwoClassRecord::class,
            'Grade Three' => GradeThreeClassRecord::class,
            'Grade Four' => GradeFourClassRecord::class,
            'Grade Five' => GradeFiveClassRecord::class,
            'Grade Six' => GradeSixClassRecord::class,
        ];

        // Return the corresponding model class for the given grade
        return $gradeClassMap[$grade] ?? null;
    }

    public function updateInlinestudent(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'id' => 'required|integer', // Ensure it's a valid integer ID
            'grade' => 'required|string|in:Grade One,Grade Two,Grade Three,Grade Four,Grade Five,Grade Six', // Ensure the grade is valid
            'column' => 'required|string', // The column to update
            'value' => 'required', // Assuming value can be any type (numeric or string)
        ]);

        // Grade class mapping
        $gradeClassMap = [
            'Grade One' => GradeOneClassRecord::class,
            'Grade Two' => GradeTwoClassRecord::class,
            'Grade Three' => GradeThreeClassRecord::class,
            'Grade Four' => GradeFourClassRecord::class,
            'Grade Five' => GradeFiveClassRecord::class,
            'Grade Six' => GradeSixClassRecord::class,
        ];

        // Check if the grade is valid
        if (!isset($gradeClassMap[$request->grade])) {
            return response()->json(['error' => 'Invalid grade.'], 400);
        }

        // Get the model class based on grade
        $modelClass = $gradeClassMap[$request->grade];

        // Find the student record using the model for the specific grade
        $student = $modelClass::find($request->id);

        if (!$student) {
            return response()->json(['error' => 'Student record not found.'], 404);
        }

        // Dynamically update the specified column in the student record
        $student->{$request->column} = $request->value;
        $student->save();

        // Return a success response
        return response()->json(['success' => true]);
    }

    public function updateInlinestudentfinal(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'id' => 'required|integer', // Ensure it's a valid integer ID
            'column' => 'required|string', // The column to update
            'value' => 'required', // Assuming value can be any type (numeric or string)
        ]);

        // Find the student record
        $student = StudentFinalGrade::find($request->id);

        if (!$student) {
            return response()->json(['error' => 'Student record not found.'], 404);
        }

        // Dynamically update the specified column in the student record
        $student->{$request->column} = $request->value;
        $student->save();

        // Return a success response
        return response()->json(['success' => true]);
    }
}
