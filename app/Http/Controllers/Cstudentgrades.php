<?php

namespace App\Http\Controllers;

use App\Models\Mstudentgradeone;
use App\Models\Mstudentgradetwo;
use App\Models\Mstudentgradethree;
use App\Models\Mstudentgradefour;
use App\Models\Mstudentgradefive;
use App\Models\Mstudentgradesix;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\StudentInfo;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocuments;
use App\Models\Mstudentaccount;


class Cstudentgrades extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Mstudentgradeone::all();
        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Typically used to show a form, not needed for API
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Store method called', $request->all());

        // Validate the incoming request
        $validated = $request->validate([
            'student_number' => 'required',
            'grade' => 'required', // Ensure 'grade' is validated
            'quarter' => 'required|string|in:1st Quarter,2nd Quarter,3rd Quarter,4th Quarter',
            'subject_one' => 'required|numeric',
            'subject_two' => 'required|numeric',
            'subject_three' => 'required|numeric',
            'subject_four' => 'required|numeric',
            'subject_five' => 'required|numeric',
            'subject_six' => 'required|numeric',
            'subject_seven' => 'required|numeric',
            'subject_eight' => 'required|numeric',
            'subject_nine' => 'required|numeric',
        ]);

        // Determine the model to use based on the grade
        $model = null;
        if ($validated['grade'] === 'Grade One') {
            $model = Mstudentgradeone::class;
        } elseif ($validated['grade'] === 'Grade Two') {
            $model = Mstudentgradetwo::class;
        } elseif ($validated['grade'] === 'Grade Three') {
            $model = Mstudentgradethree::class;
        } elseif ($validated['grade'] === 'Grade Four') {
            $model = Mstudentgradefour::class;
        } elseif ($validated['grade'] === 'Grade Five') {
            $model = Mstudentgradefive::class;
        } elseif ($validated['grade'] === 'Grade Six') {
            $model = Mstudentgradesix::class;
        }

        // Check if the student already has grades for this quarter and grade
        $existingGrade = $model::where('student_number', $validated['student_number'])
            ->where('quarter', $validated['quarter'])
            ->first();

        if ($existingGrade) {
            return redirect()->back()->with('error', 'Grades for this student number and quarter already exist.');
        }

        // Fetch the student's name
        $student = StudentInfo::where('student_number', $validated['student_number'])->first();
        $studentName = $student ? $student->student_last_name . ', ' . $student->student_first_name : 'Unknown Student';

        // Create a new record
        $model::create($validated);

        return redirect()->back()->with('success', "Grades for {$studentName} have been added successfully for the {$validated['quarter']}!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mstudentgradeone  $studentGradeOne
     * @return \Illuminate\Http\Response
     */
    public function show(Mstudentgradeone $studentGradeOne)
    {
        return response()->json($studentGradeOne);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mstudentgradeone  $studentGradeOne
     * @return \Illuminate\Http\Response
     */
    public function edit(Mstudentgradeone $studentGradeOne)
    {
        // Typically used to show a form, not needed for API
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mstudentgradeone  $studentGradeOne
     * @return \Illuminate\Http\Response
     */
    public function updateStudentGrades(Request $request)
    {
        \Log::info($request->all()); // Log all request data

        $validatedData = $request->validate([
            'student_number' => 'required', // Validate student number if necessary
            'grade' => 'required', // Validate grade
            'quarter' => 'required|string|in:1st Quarter,2nd Quarter,3rd Quarter,4th Quarter',
            'subject_one' => 'required|numeric',
            'subject_two' => 'required|numeric',
            'subject_three' => 'required|numeric',
            'subject_four' => 'required|numeric',
            'subject_five' => 'required|numeric',
            'subject_six' => 'required|numeric',
            'subject_seven' => 'required|numeric',
            'subject_eight' => 'required|numeric',
            'subject_nine' => 'required|numeric',
        ]);

        // Determine the model based on the grade
        $model = null;
        if ($validatedData['grade'] === 'Grade One') {
            $model = Mstudentgradeone::class;
        } elseif ($validatedData['grade'] === 'Grade Two') {
            $model = Mstudentgradetwo::class;
        } elseif ($validatedData['grade'] === 'Grade Three') {
            $model = Mstudentgradethree::class;
        } elseif ($validatedData['grade'] === 'Grade Four') {
            $model = Mstudentgradefour::class;
        } elseif ($validatedData['grade'] === 'Grade Five') {
            $model = Mstudentgradefive::class;
        } elseif ($validatedData['grade'] === 'Grade Six') {
            $model = Mstudentgradesix::class;
        }

        // Find the existing student grades record by student number and quarter
        $grades = $model::where('student_number', $validatedData['student_number'])
            ->where('quarter', $validatedData['quarter'])
            ->first();

        if ($grades) {
            // Update the student grades
            $grades->update([
                'subject_one' => $validatedData['subject_one'],
                'subject_two' => $validatedData['subject_two'],
                'subject_three' => $validatedData['subject_three'],
                'subject_four' => $validatedData['subject_four'],
                'subject_five' => $validatedData['subject_five'],
                'subject_six' => $validatedData['subject_six'],
                'subject_seven' => $validatedData['subject_seven'],
                'subject_eight' => $validatedData['subject_eight'],
                'subject_nine' => $validatedData['subject_nine'],
            ]);

            return back()->with('success', 'Student grades updated successfully!');
        } else {
            return back()->withErrors(['error' => 'Student not found.']);
        }
    }


    // YourController.php
    public function getStudentGrades($id)
    {
        $grades = Mstudentgradeone::findOrFail($id);

        return response()->json($grades);
    }

    public function showGradebookOneData()
    {
        // Fetch all active student records with additional info and documents using eager loading
        $students = StudentInfo::with(['additionalInfo', 'documents', 'gradebookOne'])
            ->where('grade', 'Grade One')
            ->where('status', 'Active')
            ->get();

        // Check if there are no active students
        $noGradeOneMessage = $students->isEmpty() ? "No students found in Grade One." : null;

        // Calculate average grades for each student
        foreach ($students as $student) {
            $quarterAverages = [];

            foreach ($student->gradebookOne as $grade) {
                // Collect subject grades for all quarters
                $subjectGrades = [
                    $grade->subject_one,
                    $grade->subject_two,
                    $grade->subject_three,
                    $grade->subject_four,
                    $grade->subject_five,
                    $grade->subject_six,
                    $grade->subject_seven,
                    $grade->subject_eight,
                    $grade->subject_nine,
                ];

                // Filter out null or empty grades
                $validGrades = array_filter($subjectGrades, fn($value) => !is_null($value) && $value !== '');

                // Calculate average if there are valid grades
                $averageGrade = count($validGrades) > 0 ? array_sum($validGrades) / count($validGrades) : null;

                // Store the average for the specific quarter
                if (in_array($grade->quarter, ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'])) {
                    $quarterAverages[$grade->quarter] = $averageGrade;
                }

                $grade->average = $averageGrade;
            }

            // Store quarterly averages in the student object
            $student->quarter_averages = $quarterAverages;

            // Calculate final grade for the student
            if (count($quarterAverages) === 4) { // Ensure all quarters are present
                $finalGrade = array_sum($quarterAverages) / count($quarterAverages); // Average of all four quarters
                $student->final_grade = $finalGrade; // Add to student object
            } else {
                $student->final_grade = null; // No final grade if any average is missing
            }
        }

        // Pass the data to the view
        return view('admin.admin_gradebook_gradeone', compact('students', 'noGradeOneMessage'));
    }

    public function showGradebookTwoData()
    {
        // Fetch all active student records with additional info and documents using eager loading
        $students = StudentInfo::with(['additionalInfo', 'documents', 'gradebookTwo'])
            ->where('grade', 'Grade Two')
            ->where('status', 'Active')
            ->get();

        // Check if there are no active students
        $noGradeTwoMessage = $students->isEmpty() ? "No students found in Grade Two." : null;

        // Calculate average grades for each student
        foreach ($students as $student) {
            $quarterAverages = [];

            foreach ($student->gradebookTwo as $grade) {
                // Collect subject grades for all quarters
                $subjectGrades = [
                    $grade->subject_one,
                    $grade->subject_two,
                    $grade->subject_three,
                    $grade->subject_four,
                    $grade->subject_five,
                    $grade->subject_six,
                    $grade->subject_seven,
                    $grade->subject_eight,
                    $grade->subject_nine,
                ];

                // Filter out null or empty grades
                $validGrades = array_filter($subjectGrades, fn($value) => !is_null($value) && $value !== '');

                // Calculate average if there are valid grades
                $averageGrade = count($validGrades) > 0 ? array_sum($validGrades) / count($validGrades) : null;

                // Store the average for the specific quarter
                if (in_array($grade->quarter, ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'])) {
                    $quarterAverages[$grade->quarter] = $averageGrade;
                }

                $grade->average = $averageGrade;
            }

            // Store quarterly averages in the student object
            $student->quarter_averages = $quarterAverages;

            // Calculate final grade for the student
            if (count($quarterAverages) === 4) { // Ensure all quarters are present
                $finalGrade = array_sum($quarterAverages) / count($quarterAverages); // Average of all four quarters
                $student->final_grade = $finalGrade; // Add to student object
            } else {
                $student->final_grade = null; // No final grade if any average is missing
            }
        }

        // Pass the data to the view
        return view('admin.admin_gradebook_gradetwo', compact('students', 'noGradeTwoMessage'));
    }

    public function showGradebookThreeData()
    {
        // Fetch all active student records with additional info and documents using eager loading
        $students = StudentInfo::with(['additionalInfo', 'documents', 'gradebookThree'])
            ->where('grade', 'Grade Three')
            ->where('status', 'Active')
            ->get();

        // Check if there are no active students
        $noGradeThreeMessage = $students->isEmpty() ? "No students found in Grade Three." : null;

        // Calculate average grades for each student
        foreach ($students as $student) {
            $quarterAverages = [];

            foreach ($student->gradebookThree as $grade) {
                // Collect subject grades for all quarters
                $subjectGrades = [
                    $grade->subject_one,
                    $grade->subject_two,
                    $grade->subject_three,
                    $grade->subject_four,
                    $grade->subject_five,
                    $grade->subject_six,
                    $grade->subject_seven,
                    $grade->subject_eight,
                    $grade->subject_nine,
                ];

                // Filter out null or empty grades
                $validGrades = array_filter($subjectGrades, fn($value) => !is_null($value) && $value !== '');

                // Calculate average if there are valid grades
                $averageGrade = count($validGrades) > 0 ? array_sum($validGrades) / count($validGrades) : null;

                // Store the average for the specific quarter
                if (in_array($grade->quarter, ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'])) {
                    $quarterAverages[$grade->quarter] = $averageGrade;
                }

                $grade->average = $averageGrade;
            }

            // Store quarterly averages in the student object
            $student->quarter_averages = $quarterAverages;

            // Calculate final grade for the student
            if (count($quarterAverages) === 4) { // Ensure all quarters are present
                $finalGrade = array_sum($quarterAverages) / count($quarterAverages); // Average of all four quarters
                $student->final_grade = $finalGrade; // Add to student object
            } else {
                $student->final_grade = null; // No final grade if any average is missing
            }
        }

        // Pass the data to the view
        return view('admin.admin_gradebook_gradethree', compact('students', 'noGradeThreeMessage'));
    }

    public function showGradebookFourData()
    {
        // Fetch all active student records with additional info and documents using eager loading
        $students = StudentInfo::with(['additionalInfo', 'documents', 'gradebookFour'])
            ->where('grade', 'Grade Four')
            ->where('status', 'Active')
            ->get();

        // Check if there are no active students
        $noGradeFourMessage = $students->isEmpty() ? "No students found in Grade Four." : null;

        // Calculate average grades for each student
        foreach ($students as $student) {
            $quarterAverages = [];

            foreach ($student->gradebookFour as $grade) {
                // Collect subject grades for all quarters
                $subjectGrades = [
                    $grade->subject_one,
                    $grade->subject_two,
                    $grade->subject_three,
                    $grade->subject_four,
                    $grade->subject_five,
                    $grade->subject_six,
                    $grade->subject_seven,
                    $grade->subject_eight,
                    $grade->subject_nine,
                ];

                // Filter out null or empty grades
                $validGrades = array_filter($subjectGrades, fn($value) => !is_null($value) && $value !== '');

                // Calculate average if there are valid grades
                $averageGrade = count($validGrades) > 0 ? array_sum($validGrades) / count($validGrades) : null;

                // Store the average for the specific quarter
                if (in_array($grade->quarter, ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'])) {
                    $quarterAverages[$grade->quarter] = $averageGrade;
                }

                $grade->average = $averageGrade;
            }

            // Store quarterly averages in the student object
            $student->quarter_averages = $quarterAverages;

            // Calculate final grade for the student
            if (count($quarterAverages) === 4) { // Ensure all quarters are present
                $finalGrade = array_sum($quarterAverages) / count($quarterAverages); // Average of all four quarters
                $student->final_grade = $finalGrade; // Add to student object
            } else {
                $student->final_grade = null; // No final grade if any average is missing
            }
        }

        // Pass the data to the view
        return view('admin.admin_gradebook_gradefour', compact('students', 'noGradeFourMessage'));
    }

    public function showGradebookFiveData()
    {
        // Fetch all active student records with additional info and documents using eager loading
        $students = StudentInfo::with(['additionalInfo', 'documents', 'gradebookFive'])
            ->where('grade', 'Grade Five')
            ->where('status', 'Active')
            ->get();

        // Check if there are no active students
        $noGradeFiveMessage = $students->isEmpty() ? "No students found in Grade Five." : null;

        // Calculate average grades for each student
        foreach ($students as $student) {
            $quarterAverages = [];

            foreach ($student->gradebookFive as $grade) {
                // Collect subject grades for all quarters
                $subjectGrades = [
                    $grade->subject_one,
                    $grade->subject_two,
                    $grade->subject_three,
                    $grade->subject_four,
                    $grade->subject_five,
                    $grade->subject_six,
                    $grade->subject_seven,
                    $grade->subject_eight,
                    $grade->subject_nine,
                ];

                // Filter out null or empty grades
                $validGrades = array_filter($subjectGrades, fn($value) => !is_null($value) && $value !== '');

                // Calculate average if there are valid grades
                $averageGrade = count($validGrades) > 0 ? array_sum($validGrades) / count($validGrades) : null;

                // Store the average for the specific quarter
                if (in_array($grade->quarter, ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'])) {
                    $quarterAverages[$grade->quarter] = $averageGrade;
                }

                $grade->average = $averageGrade;
            }

            // Store quarterly averages in the student object
            $student->quarter_averages = $quarterAverages;

            // Calculate final grade for the student
            if (count($quarterAverages) === 4) { // Ensure all quarters are present
                $finalGrade = array_sum($quarterAverages) / count($quarterAverages); // Average of all four quarters
                $student->final_grade = $finalGrade; // Add to student object
            } else {
                $student->final_grade = null; // No final grade if any average is missing
            }
        }

        // Pass the data to the view
        return view('admin.admin_gradebook_gradefive', compact('students', 'noGradeFiveMessage'));
    }

    public function showGradebookSixData()
    {
        // Fetch all active student records with additional info and documents using eager loading
        $students = StudentInfo::with(['additionalInfo', 'documents', 'gradebookSix'])
            ->where('grade', 'Grade Six')
            ->where('status', 'Active')
            ->get();

        // Check if there are no active students
        $noGradeSixMessage = $students->isEmpty() ? "No students found in Grade Six." : null;

        // Calculate average grades for each student
        foreach ($students as $student) {
            $quarterAverages = [];

            foreach ($student->gradebookSix as $grade) {
                // Collect subject grades for all quarters
                $subjectGrades = [
                    $grade->subject_one,
                    $grade->subject_two,
                    $grade->subject_three,
                    $grade->subject_four,
                    $grade->subject_five,
                    $grade->subject_six,
                    $grade->subject_seven,
                    $grade->subject_eight,
                    $grade->subject_nine,
                ];

                // Filter out null or empty grades
                $validGrades = array_filter($subjectGrades, fn($value) => !is_null($value) && $value !== '');

                // Calculate average if there are valid grades
                $averageGrade = count($validGrades) > 0 ? array_sum($validGrades) / count($validGrades) : null;

                // Store the average for the specific quarter
                if (in_array($grade->quarter, ['1st Quarter', '2nd Quarter', '3rd Quarter', '4th Quarter'])) {
                    $quarterAverages[$grade->quarter] = $averageGrade;
                }

                $grade->average = $averageGrade;
            }

            // Store quarterly averages in the student object
            $student->quarter_averages = $quarterAverages;

            // Calculate final grade for the student
            if (count($quarterAverages) === 4) { // Ensure all quarters are present
                $finalGrade = array_sum($quarterAverages) / count($quarterAverages); // Average of all four quarters
                $student->final_grade = $finalGrade; // Add to student object
            } else {
                $student->final_grade = null; // No final grade if any average is missing
            }
        }

        // Pass the data to the view
        return view('admin.admin_gradebook_gradesix', compact('students', 'noGradeSixMessage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mstudentgradeone  $studentGradeOne
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mstudentgradeone $studentGradeOne)
    {
        $studentGradeOne->delete();
        return response()->json(null, 204);
    }

    public function getGradeOneSections()
    {
        // Fetch all distinct sections from the StudentInfo model where section is not null or empty
        $sections = StudentInfo::whereNotNull('section')  // Ensure section is not null
            ->where('section', '!=', '') // Ensure section is not an empty string
            ->where('grade', 'Grade One')
            ->where('status', 'Active')  // Ensure student is active
            ->distinct()  // Get only distinct sections
            ->pluck('section'); // Get only the 'section' column

        // Return sections as a JSON response
        return response()->json($sections);
    }

    public function getGradeTwoSections()
    {
        // Fetch all distinct sections from the StudentInfo model where section is not null or empty
        $sections = StudentInfo::whereNotNull('section')  // Ensure section is not null
            ->where('section', '!=', '') // Ensure section is not an empty string
            ->where('grade', 'Grade Two')
            ->where('status', 'Active')  // Ensure student is active
            ->distinct()  // Get only distinct sections
            ->pluck('section'); // Get only the 'section' column

        // Return sections as a JSON response
        return response()->json($sections);
    }

    public function getGradeThreeSections()
    {
        // Fetch all distinct sections from the StudentInfo model where section is not null or empty
        $sections = StudentInfo::whereNotNull('section')  // Ensure section is not null
            ->where('section', '!=', '') // Ensure section is not an empty string
            ->where('grade', 'Grade Three')
            ->where('status', 'Active')  // Ensure student is active
            ->distinct()  // Get only distinct sections
            ->pluck('section'); // Get only the 'section' column

        // Return sections as a JSON response
        return response()->json($sections);
    }

    public function getGradeFourSections()
    {
        // Fetch all distinct sections from the StudentInfo model where section is not null or empty
        $sections = StudentInfo::whereNotNull('section')  // Ensure section is not null
            ->where('section', '!=', '') // Ensure section is not an empty string
            ->where('grade', 'Grade Four')
            ->where('status', 'Active')  // Ensure student is active
            ->distinct()  // Get only distinct sections
            ->pluck('section'); // Get only the 'section' column

        // Return sections as a JSON response
        return response()->json($sections);
    }

    public function getGradeFiveSections()
    {
        // Fetch all distinct sections from the StudentInfo model where section is not null or empty
        $sections = StudentInfo::whereNotNull('section')  // Ensure section is not null
            ->where('section', '!=', '') // Ensure section is not an empty string
            ->where('grade', 'Grade Five')
            ->where('status', 'Active')  // Ensure student is active
            ->distinct()  // Get only distinct sections
            ->pluck('section'); // Get only the 'section' column

        // Return sections as a JSON response
        return response()->json($sections);
    }

    public function getGradeSixSections()
    {
        // Fetch all distinct sections from the StudentInfo model where section is not null or empty
        $sections = StudentInfo::whereNotNull('section')  // Ensure section is not null
            ->where('section', '!=', '') // Ensure section is not an empty string
            ->where('grade', 'Grade Six')
            ->where('status', 'Active')  // Ensure student is active
            ->distinct()  // Get only distinct sections
            ->pluck('section'); // Get only the 'section' column

        // Return sections as a JSON response
        return response()->json($sections);
    }

    public function getxSections()
    {
        // Fetch all distinct sections from the StudentInfo model where section is not null or empty
        $sections = StudentInfo::whereNotNull('section')  // Ensure section is not null
            ->where('section', '!=', '') // Ensure section is not an empty string
            ->where('status', 'Active')  // Ensure student is active
            ->distinct()  // Get only distinct sections
            ->pluck('section'); // Get only the 'section' column

        // Return sections as a JSON response
        return response()->json($sections);
    }

    public function getAllGrade()
    {
        // Fetch all distinct sections from the StudentInfo model where section is not null or empty
        $sections = StudentInfo::whereNotNull('grade')  // Ensure section is not null // Ensure section is not an empty string
            ->where('grade', '!=', '')
            ->where('status', 'Active')  // Ensure student is active
            ->distinct()  // Get only distinct sections
            ->pluck('grade'); // Get only the 'section' column

        // Return sections as a JSON response
        return response()->json($sections);
    }
}
