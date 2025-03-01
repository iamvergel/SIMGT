<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterAdditionalInfo;
use App\Models\RegisterStudentInfo;
use App\Models\RegisterDocuments;

class RegisterStudent extends Controller
{
    //
    public function showAllRegister()
    {
        // Fetch all active student records with pagination
        $students = RegisterStudentInfo::get();

        // Fetch additional student information for each student
        $studentsAdditional = RegisterAdditionalInfo::whereIn('lrn', $students->pluck('lrn'))->get()->keyBy('lrn');
        // Fetch additional student information for each student
        $studentDocuments = RegisterDocuments::whereIn('lrn', $students->pluck('lrn'))->get()->keyBy('lrn');

        // Check if there are no active students
        $noActiveMessage = $students->isEmpty() ? "No active students found." : null;

        return view('admin.admin_registration', compact('students', 'studentsAdditional', 'studentDocuments', 'noActiveMessage'));
    }
}
