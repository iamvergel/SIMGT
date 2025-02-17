<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Clogin;
use App\Http\Controllers\Admin\Cpages;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\Cstudentinfo;
use App\Http\Controllers\Cadmininfo;
use App\Http\Controllers\Cevent;
use App\Http\Controllers\MyController;
use App\Http\Controllers\Cstudentgrades;
use App\Http\Controllers\CStudentProfile;

// Landing Page
Route::get('/StEmelieLearningCenter', function () {
    return view('landing_page');
});

// Authentication Routes
Route::get('/StEmelieLearningCenter.HopeSci66/sign-in', [Clogin::class, 'showLoginForm'])->name('admin.login');
Route::post('/StEmelieLearningCenter.HopeSci66/sign-in', [Clogin::class, 'login']);
Route::post('/logout', [Clogin::class, 'logout'])->name('logout');
// Middleware to Prevent Back History and Redirect
Route::middleware([PreventBackHistory::class, 'auth.redirect'])->group(function () {

    Route::get('/StEmelieLearningCenter.HopeSci66', [Clogin::class, 'showDashboard'])->name('dashboard');

    // Student Management Routes
    Route::prefix('/StEmelieLearningCenter.HopeSci66/admin/student-management')->group(function () {
        Route::get('/', [Cpages::class, 'showStudentManagement'])->name('admin.admin_student_management');
        Route::get('/GradeOne', [Cpages::class, 'showStudentManagementGradeone'])->name('admin.admin_student_management_gradeone');
        Route::get('/GradeTwo', [Cpages::class, 'showStudentManagementGradetwo'])->name('admin.admin_student_management_gradetwo');
        Route::get('/GradeThree', [Cpages::class, 'showStudentManagementGradethree'])->name('admin.admin_student_management_gradethree');
        Route::get('/GradeFour', [Cpages::class, 'showStudentManagementGradefour'])->name('admin.admin_student_management_gradefour');
        Route::get('/GradeFive', [Cpages::class, 'showStudentManagementGradefive'])->name('admin.admin_student_management_gradefive');
        Route::get('/GradeSix', [Cpages::class, 'showStudentManagementGradesix'])->name('admin.admin_student_management_gradesix');
        Route::get('/AllStudentData', [Cpages::class, 'showAllStudent'])->name('admin.admin_show_all_data');
        Route::get('/StudentProfile', function () {
            return view('admin.includes.show_student_profile');
        });
    });

    // Grade Book Routes
    Route::prefix('/StEmelieLearningCenter.HopeSci66/admin/Grade-book')->group(function () {
        Route::get('/', [Cpages::class, 'showGradeBook'])->name('admin.admin_gradebook');
        Route::get('/GradeOne', [Cpages::class, 'showGradeBookGradeone'])->name('admin.admin_gradebook_gradeone');
        Route::get('/GradeTwo', [Cpages::class, 'showGradeBookGradetwo'])->name('admin.admin_gradebook_gradetwo');
        Route::get('/GradeThree', [Cpages::class, 'showGradeBookGradethree'])->name('admin.admin_gradebook_gradethree');
        Route::get('/GradeFour', [Cpages::class, 'showGradeBookGradefour'])->name('admin.admin_gradebook_gradefour');
        Route::get('/GradeFive', [Cpages::class, 'showGradeBookGradefive'])->name('admin.admin_gradebook_gradefive');
        Route::get('/GradeSix', [Cpages::class, 'showGradeBookGradesix'])->name('admin.admin_gradebook_gradesix');
    });

    // Report Section Routes
    Route::prefix('/StEmelieLearningCenter.HopeSci66/admin/Report-Section')->group(function () {
        Route::get('/Graduate-Student', [Cpages::class, 'showGraduateStudent'])->name('admin.admin_graduate_students');
        Route::get('/Drop-Student', [Cpages::class, 'showDropStudent'])->name('admin.admin_drop_student');
        Route::get('/Archive-Student', [Cpages::class, 'showArchiveStudent'])->name('admin.admin_archive_student');
    });


    Route::get('/StEmelieLearningCenter.HopeSci66/admin/student-management', [Cstudentinfo::class, 'showGradeData']);
    Route::get('/StEmelieLearningCenter.HopeSci66/admin/Grade-book', [Cstudentinfo::class, 'showGradebook'])->name('gradebook');

    Route::prefix('StEmelieLearningCenter.HopeSci66/admin/student-management')->group(function () {
        Route::get('/GradeOne', [Cstudentinfo::class, 'showGradeOneData'])->name('grade.one');
        Route::get('/GradeTwo', [Cstudentinfo::class, 'showGradeTwoData'])->name('grade.two');
        Route::get('/GradeThree', [Cstudentinfo::class, 'showGradeThreeData'])->name('grade.three');
        Route::get('/GradeFour', [Cstudentinfo::class, 'showGradeFourData'])->name('grade.four');
        Route::get('/GradeFive', [Cstudentinfo::class, 'showGradeFiveData'])->name('grade.five');
        Route::get('/GradeSix', [Cstudentinfo::class, 'showGradeSixData'])->name('grade.six');
        Route::get('/AllStudentData', [Cstudentinfo::class, 'showAllStudentData'])->name('admin.admin_show_all_data');
    });

    Route::prefix('StEmelieLearningCenter.HopeSci66/admin/Grade-book')->group(function () {
        Route::get('/GradeOne', [Cstudentgrades::class, 'showGradebookOneData'])->name('grade.one');
        Route::get('/GradeTwo', [Cstudentgrades::class, 'showGradebookTwoData'])->name('grade.two');
        Route::get('/GradeThree', [Cstudentgrades::class, 'showGradebookThreeData'])->name('grade.three');
        Route::get('/GradeFour', [Cstudentgrades::class, 'showGradebookFourData'])->name('grade.four');
        Route::get('/GradeFive', [Cstudentgrades::class, 'showGradebookFiveData'])->name('grade.five');
        Route::get('/GradeSix', [Cstudentgrades::class, 'showGradebookSixData'])->name('grade.six');
    });

    // Other Admin Dashboard Routes
    Route::post('/students', [Cstudentinfo::class, 'store'])->name('includes.add_student_form.store');
    Route::post('/student-grade', [Cstudentgrades::class, 'store'])->name('student.grade.store');
    Route::get('/fetch-grades', [Cstudentgrades::class, 'fetchGrades'])->name('grades.fetch');
    // web.php
    Route::post('/admin/Grade-book/GradeOne', [Cstudentgrades::class, 'updateStudentGrades'])->name('StEmelieLearningCenter.HopeSci66.admin.Grade-book.GradeOne');
    Route::get('/student-grades/{id}', [Cstudentgrades::class, 'getStudentGrades'])->name('student.grades.show');


    Route::get('/StEmelieLearningCenter.HopeSci66/admin/Report-Section/Graduate-Student', [Cstudentinfo::class, 'showAllStudentGraduateData'])->name('admin.admin_graduate_students');
    Route::get('/StEmelieLearningCenter.HopeSci66/admin/Report-Section/Drop-Student', [Cstudentinfo::class, 'showAllStudentDropData'])->name('admin.admin_drop_students');
    Route::get('/StEmelieLearningCenter.HopeSci66/admin/Report-Section/Drop-Student/All-Drop-Data', [Cstudentinfo::class, 'showAllStudentDroppedData'])->name('admin.admin_show_all_drop_data');

    Route::get('/StEmelieLearningCenter.HopeSci66/admin/Report-Section/Archive-Student', [Cstudentinfo::class, 'showAllStudentArchiveData'])->name('admin.admin_archive_student');

    Route::get('/StEmelieLearningCenter.HopeSci66/admin/dashboard', [Cevent::class, 'showAllAdmin'])->name('admin.admin_dashboard');

    Route::get('/StEmelieLearningCenter.HopeSci66/admin/website-gallery', function () {
        return view('admin.website.admin_website_gallery');
    });

    // events Routes
    Route::post('/events', [Cevent::class, 'storeEvent'])->name('events.store');
    Route::put('/events/{id}', [Cevent::class, 'updateEvent'])->name('events.update');
    Route::get('/events', [Cevent::class, 'showEvents']);

    // Announcement Routes
    Route::get('/announcements', [Cevent::class, 'showAnnouncements']);
    Route::post('/announcements', [Cevent::class, 'storeAnnouncement'])->name('announcements.store');
    Route::put('/announcements/{id}', [Cevent::class, 'updateAnnouncement'])->name('announcements.update');

    Route::get('/StEmelieLearningCenter.HopeSci66/student/dashboard', function () {
        return view('student.student_dashboard');
    });

    //teacher routes
    Route::get('/StEmelieLearningCenter.HopeSci66/teacher/dashboard', function () {
        return view('teacher.teacher_dashboard');
    });

    // Student Dashboard Route with Latest Announcements
    Route::get('/StEmelieLearningCenter.HopeSci66/student/dashboard', [Cevent::class, 'showDashboardstudent']);
    Route::get('/StEmelieLearningCenter.HopeSci66/student/calendar', [Cevent::class, 'showCalendar'])->name('student.calendar');
    Route::get('/api/events', [Cevent::class, 'getEvents']);

    Route::get('/StEmelieLearningCenter.HopeSci66/student/student-profile/account', function () {
        return view('student.student_profile');
    });

    Route::get('/StEmelieLearningCenter.HopeSci66/student/student-profile/security', function () {
        return view('student.student_profile_security');
    });

    Route::get('/StEmelieLearningCenter.HopeSci66/student/student-profile/additional-inforamtion', function () {
        return view('student.student_profile_information');
    });

    Route::get('/StEmelieLearningCenter.HopeSci66/student/student-profile/grades', function () {
        return view('student.student_grades');
    });
});

Route::get('/caloocan_barangay', function () {
    $path = storage_path('../json/caloocan_barangay.json');

    if (!file_exists($path)) {
        return response()->json(['error' => 'File not found'], 404);
    }

    $json = file_get_contents($path);
    return response()->json(json_decode($json));
});

// In routes/api.php
Route::post('/manage-account/{studentId}/reset', [Cstudentinfo::class, 'resetAccount'])->name('account.reset');
Route::put('/students/{id}', [Cstudentinfo::class, 'updateStudentInfo'])->name('students.update');
Route::post('/send-email/{id}', [Cstudentinfo::class, 'sendEmail'])->name('send.email');
Route::put('/students/drop/{id}', [Cstudentinfo::class, 'dropStudent'])->name('students.drop');
Route::put('/students/retrive/{id}', [Cstudentinfo::class, 'retrieveStudent'])->name('students.retrieve');

Route::post('/profile/update-avatar', [CStudentProfile::class, 'update'])->name('profile.update-avatar');
Route::post('/student/change-password/{studentId}', [CStudentProfile::class, 'changePassword'])->name('student.changePassword');
Route::post('/show-grades', [CStudentProfile::class, 'showGrades'])->name('showGrades');

Route::get('/get-onesections', [Cstudentgrades::class, 'getGradeOneSections'])->name('get.sections');
Route::get('/get-twosections', [Cstudentgrades::class, 'getGradeTwoSections'])->name('get.twosections');
Route::get('/get-threesections', [Cstudentgrades::class, 'getGradeThreeSections'])->name('get.threesections');
Route::get('/get-foursections', [Cstudentgrades::class, 'getGradeFourSections'])->name('get.foursections');
Route::get('/get-fivesections', [Cstudentgrades::class, 'getGradeFiveSections'])->name('get.fivesections');
Route::get('/get-sixsections', [Cstudentgrades::class, 'getGradeSixSections'])->name('get.sixsections');
Route::get('/get-grade', [Cstudentgrades::class, 'getAllGrade'])->name('get.allgrade');
Route::get('/get-Section', [Cstudentgrades::class, 'getxSections'])->name('get.allsection');
