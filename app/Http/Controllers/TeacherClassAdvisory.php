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
            ->where('status', 'Active') // Active students only
            ->get();

        // Fetch related primary info for students that are in Grade One and have an 'Enrolled' status
        $studentsPrimary = StudentPrimaryInfo::whereIn('studentnumber', $students->pluck('student_number'))
            ->where('grade', 'Grade One') // Filter for Grade One
            ->where('status', 'Enrolled') // Ensure students are enrolled
            ->get()->keyBy('studentnumber');

        $studentsAdditional = StudentAdditionalInfo::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentDocuments = StudentDocuments::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');
        $studentAccount = Mstudentaccount::whereIn('student_number', $students->pluck('student_number'))->get()->keyBy('student_number');

        // Check if there are no students found in Grade One
        $noGradeOneMessage = $studentsPrimary->isEmpty() ? "No students found in Grade One." : null;

        // Pass the data to the view
        return route('teacher.dashboard', compact('students', 'noGradeOneMessage', 'studentsPrimary', 'studentsAdditional', 'studentDocuments', 'studentAccount'));
    }
}
