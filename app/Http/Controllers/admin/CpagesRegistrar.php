<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentInfo;
use App\Models\Section;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocuments;
use App\Models\Mstudentaccount;
use App\Models\StudentPrimaryInfo;
use App\Models\TeacherUser;
use App\Models\TeacherSubjectClass;
use App\Models\TeacherAdvisory;
use App\Models\GradeOneClassRecord;
use App\Models\GradeTwoClassRecord;
use App\Models\GradeThreeClassRecord;
use App\Models\GradeFourClassRecord;
use App\Models\GradeFiveClassRecord;
use App\Models\GradeSixClassRecord;
use App\Models\StudentFinalGrade;

class CpagesRegistrar extends Controller
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

    public function showStudentManagementGradeoneAdmission()
    {
        // Logic to retrieve student data (if any)
        return view('admission.admission_student_management_gradeone'); // Adjust according to your view structure
    }

    public function showStudentManagementGradetwoAdmission()
    {
        // Logic to retrieve student data (if any)
        return view('admission.admission_student_management_gradetwo'); // Adjust according to your view structure
    }

    public function showStudentManagementGradethreeAdmission()
    {
        // Logic to retrieve student data (if any)
        return view('admission.admission_student_management_gradethree'); // Adjust according to your view structure
    }

    public function showStudentManagementGradefourAdmission()
    {
        // Logic to retrieve student data (if any)
        return view('admission.admission_student_management_gradefour'); // Adjust according to your view structure
    }

    public function showStudentManagementGradefiveAdmission()
    {
        // Logic to retrieve student data (if any)
        return view('admission.admission_student_management_gradefive'); // Adjust according to your view structure
    }

    public function showStudentManagementGradesixAdmission()
    {
        // Logic to retrieve student data (if any)
        return view('admission.admission_student_management_gradesix'); // Adjust according to your view structure
    }

    public function showStudentManagementGradeoneRegistrar()
    {
        // Logic to retrieve student data (if any)
        return view('registrar.registrar_student_management_gradeone'); // Adjust according to your view structure
    }

    public function showStudentManagementGradetwoRegistrar()
    {
        // Logic to retrieve student data (if any)
        return view('registrar.registrar_student_management_gradetwo'); // Adjust according to your view structure
    }

    public function showStudentManagementGradethreeRegistrar()
    {
        // Logic to retrieve student data (if any)
        return view('registrar.registrar_student_management_gradethree'); // Adjust according to your view structure
    }

    public function showStudentManagementGradefourRegistrar()
    {
        // Logic to retrieve student data (if any)
        return view('registrar.registrar_student_management_gradefour'); // Adjust according to your view structure
    }

    public function showStudentManagementGradefiveRegistrar()
    {
        // Logic to retrieve student data (if any)
        return view('registrar.registrar_student_management_gradefive'); // Adjust according to your view structure
    }

    public function showStudentManagementGradesixRegistrar()
    {
        // Logic to retrieve student data (if any)
        return view('registrar.registrar_student_management_gradesix'); // Adjust according to your view structure
    }

    public function showGradeBook()
    {

        return view('registrar.registrar_gradebook');

    }
    public function showGradeBookGradeone($teacherNumber, $subject)
    {
        $TeacherInfo = TeacherUser::where('teacher_number', $teacherNumber)->first();
        $TeacherSubject = TeacherSubjectClass::where('teacher_number', $teacherNumber)->get();

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

        // Pass the data to the view
        return view('registrar.registrar_gradebook_gradeone', compact('students', 'TeacherInfo', 'TeacherSubject', 'StudentFinals'));
    }

    public function showGradeBookGradetwo($teacherNumber, $subject)
    {
        $TeacherInfo = TeacherUser::where('teacher_number', $teacherNumber)->first();
        $TeacherSubject = TeacherSubjectClass::where('teacher_number', $teacherNumber)->get();

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

        // Pass the data to the view
        return view('registrar.registrar_gradebook_gradetwo', compact('students', 'TeacherInfo', 'TeacherSubject', 'StudentFinals'));
    
    }

    public function showGradeBookGradethree($teacherNumber, $subject)
    {
        $TeacherInfo = TeacherUser::where('teacher_number', $teacherNumber)->first();
        $TeacherSubject = TeacherSubjectClass::where('teacher_number', $teacherNumber)->get();

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

        // Pass the data to the view
        return view('registrar.registrar_gradebook_gradethree', compact('students', 'TeacherInfo', 'TeacherSubject', 'StudentFinals'));
    }

    public function showGradeBookGradefour($teacherNumber, $subject)
    {
        $TeacherInfo = TeacherUser::where('teacher_number', $teacherNumber)->first();
        $TeacherSubject = TeacherSubjectClass::where('teacher_number', $teacherNumber)->get();

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

        // Pass the data to the view
        return view('registrar.registrar_gradebook_gradefour', compact('students', 'TeacherInfo', 'TeacherSubject', 'StudentFinals'));
    
    }

    public function showGradeBookGradefive($teacherNumber, $subject)
    {
        $TeacherInfo = TeacherUser::where('teacher_number', $teacherNumber)->first();
        $TeacherSubject = TeacherSubjectClass::where('teacher_number', $teacherNumber)->get();

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

        // Pass the data to the view
        return view('registrar.registrar_gradebook_gradefive', compact('students', 'TeacherInfo', 'TeacherSubject', 'StudentFinals'));
    }

    public function showGradeBookGradesix($teacherNumber, $subject)
    {
        $TeacherInfo = TeacherUser::where('teacher_number', $teacherNumber)->first();
        $TeacherSubject = TeacherSubjectClass::where('teacher_number', $teacherNumber)->get();

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

        // Pass the data to the view
        return view('registrar.registrar_gradebook_gradesix', compact('students', 'TeacherInfo', 'TeacherSubject', 'StudentFinals'));
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
