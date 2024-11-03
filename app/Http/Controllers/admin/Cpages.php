<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Cpages extends Controller
{
    //
    public function showStudentManagement()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_student_management'); // Adjust according to your view structure
    }

    public function showStudentManagementGradeone()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_student_management_gradeone'); // Adjust according to your view structure
    }

    public function showStudentManagementGradetwo()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_student_management_gradetwo'); // Adjust according to your view structure
    }

    public function showStudentManagementGradethree()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_student_management_gradethree'); // Adjust according to your view structure
    }

    public function showStudentManagementGradefour()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_student_management_gradefour'); // Adjust according to your view structure
    }

    public function showStudentManagementGradefive()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_student_management_gradefive'); // Adjust according to your view structure
    }

    public function showStudentManagementGradesix()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_student_management_gradesix'); // Adjust according to your view structure
    }

    public function showGradeBook()
    {

        return view('admin.admin_gradebook');

    }

    public function showGradeBookGradeone()
    {

        return view('admin.admin_gradebook_gradeone');

    }

    public function showGradeBookGradetwo()
    {

        return view('admin.admin_gradebook_gradetwo');

    }

    public function showGradeBookGradethree()
    {

        return view('admin.admin_gradebook_gradethree');

    }

    public function showGradeBookGradefour()
    {

        return view('admin.admin_gradebook_gradefour');

    }

    public function showGradeBookGradefive()
    {


        return view('admin.admin_gradebook_gradefive');

    }

    public function showGradeBookGradesix()
    {

        return view('admin.admin_gradebook_gradesix');

    }

    public function showgraduateStudent()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_graduate_students'); // Adjust according to your view structure
    }

    public function showdropStudent()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_drop_student'); // Adjust according to your view structure
    }

    public function showarchiveStudent()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_archive_student'); // Adjust according to your view structure
    }

    public function showallStudent()
    {
        // Logic to retrieve student data (if any)
        return view('admin.admin_show_all_data');
    }

    public function showPageLoader()
    {
        // Logic to retrieve student data (if any)
        return view('admin.includes.page_loader'); // Adjust according to your view structure
    }
}
