<?php
namespace App\Http\Controllers;

use App\Models\GradeFiveClassRecord;
use App\Models\GradeFourClassRecord;
use App\Models\GradeOneClassRecord;
use App\Models\GradeSixClassRecord;
use App\Models\GradeThreeClassRecord;
use App\Models\GradeTwoClassRecord;
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

        $quarters = ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'];

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

        $TeacherSubject = TeacherSubjectClass::where('teacher_number', $teacherNumber)->get();

        $allRecords = GradeOneClassRecord::where('teacher_number', $teacherNumber)
            ->orWhere('teacher_number', $teacherNumber)
            ->get()
            ->merge(GradeTwoClassRecord::where('teacher_number', $teacherNumber)->get())
            ->merge(GradeThreeClassRecord::where('teacher_number', $teacherNumber)->get())
            ->merge(GradeFourClassRecord::where('teacher_number', $teacherNumber)->get())
            ->merge(GradeFiveClassRecord::where('teacher_number', $teacherNumber)->get())
            ->merge(GradeSixClassRecord::where('teacher_number', $teacherNumber)->get());

        $students = $allRecords;

        return view('teacher.teacher_classsubject', compact('TeacherSubject', 'students'));
    }
}
