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
        $studentsAdditional = RegisterAdditionalInfo::whereIn('id', $students->pluck('id'))->get()->keyBy('id');
        // Fetch additional student information for each student
        $studentDocuments = RegisterDocuments::whereIn('id', $students->pluck('id'))->get()->keyBy('id');

        // Check if there are no active students
        $noActiveMessage = $students->isEmpty() ? "No active students found." : null;

        return view('admin.admin_online_aplication', compact('students', 'studentsAdditional', 'studentDocuments', 'noActiveMessage'));
    }

    public function showAllRegisterAdmission()
    {
        // Fetch all active student records with pagination
        $students = RegisterStudentInfo::get();

        // Fetch additional student information for each student
        $studentsAdditional = RegisterAdditionalInfo::whereIn('id', $students->pluck('id'))->get()->keyBy('id');
        // Fetch additional student information for each student
        $studentDocuments = RegisterDocuments::whereIn('id', $students->pluck('id'))->get()->keyBy('id');

        // Check if there are no active students
        $noActiveMessage = $students->isEmpty() ? "No active students found." : null;

        return view('admission.admission_online_aplication', compact('students', 'studentsAdditional', 'studentDocuments', 'noActiveMessage'));
    }

    public function showAllRegisterRegistrar()
    {
        // Fetch all active student records with pagination
        $students = RegisterStudentInfo::get();

        // Fetch additional student information for each student
        $studentsAdditional = RegisterAdditionalInfo::whereIn('id', $students->pluck('id'))->get()->keyBy('id');
        // Fetch additional student information for each student
        $studentDocuments = RegisterDocuments::whereIn('id', $students->pluck('id'))->get()->keyBy('id');

        // Check if there are no active students
        $noActiveMessage = $students->isEmpty() ? "No active students found." : null;

        return view('registrar.registrar_online_aplication', compact('students', 'studentsAdditional', 'studentDocuments', 'noActiveMessage'));
    }

    public function showEnrolleesInformation(Request $request, $id)
    {
        // Fetch the specific student based on the provided id
        $students = RegisterStudentInfo::where('id', $id)->first();

        // If the student doesn't exist, you could redirect back or show an error message
        if (!$students) {
            return back()->withErrors('Student not found.');
        }

        // Fetch related data for the specific student
        $studentsAdditional = RegisterAdditionalInfo::whereIn('id', $students->pluck('id'))->get()->keyBy('id');
        $studentDocuments = RegisterDocuments::where('id', $students->id)->first();

        // You can pass other data here as needed
        return view('registrar.includes.add_student_form', compact('students', 'studentsAdditional', 'studentDocuments'));
    }

}
