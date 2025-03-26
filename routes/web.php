<?php

use App\Models\Student;
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
use App\Http\Controllers\PictureAnnouncementController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TeacherUserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\TeacherAdvisoryController;
use App\Http\Controllers\TeacherSubjectClassController;
use App\Http\Controllers\TeacherProfile;
use App\Http\Controllers\Registration;
use App\Http\Controllers\TeacherClassAdvisory;
use App\Http\Controllers\RegisterStudent;
use App\Http\Controllers\StudentPrimaryInfoController;
use App\Http\Controllers\StudentRegistrationController;
use App\Http\Controllers\RegistrationButtonController;
use App\Http\Controllers\AdmissionUserController;
use App\Http\Controllers\RegistrarUserController;
use App\Http\Controllers\AdmissionStudent;
use App\Http\Controllers\RegistrarStudent;

Route::get('/Admission', function () {
    // Redirect to the desired URL
    return view('landing_page');
});

Route::get('/Registration', function () {
    return view('registration');
});

Route::post('/register', [Registration::class, 'store'])->name('student.register');

// Authentication Routes
Route::get('/', [Clogin::class, 'showLoginForm'])->name('admin.login');
Route::post('/', [Clogin::class, 'login']);
Route::post('/logout', [Clogin::class, 'logout'])->name('logout');
// Middleware to Prevent Back History and Redirect
Route::middleware([PreventBackHistory::class, 'auth.redirect'])->group(function () {

    Route::get('/StEmelieLearningCenter.HopeSci66', [Clogin::class, 'showDashboard'])->name('dashboard');

    // Student Management Routes admin
    Route::prefix('/admin/student-management')->group(function () {
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

    // Student Management Routes admission
    Route::prefix('/admission/student-management')->group(function () {
        Route::get('/', [Cpages::class, 'showStudentManagement'])->name('admissionmin.admission_student_management');
        Route::get('/GradeOne', [Cpages::class, 'showStudentManagementGradeoneAdmission'])->name('admission.admission_student_management_gradeone');
        Route::get('/GradeTwo', [Cpages::class, 'showStudentManagementGradetwoAdmission'])->name('admission.admission_student_management_gradetwo');
        Route::get('/GradeThree', [Cpages::class, 'showStudentManagementGradethreeAdmission'])->name('admission.admission_student_management_gradethree');
        Route::get('/GradeFour', [Cpages::class, 'showStudentManagementGradefourAdmission'])->name('admission.admission_student_management_gradefour');
        Route::get('/GradeFive', [Cpages::class, 'showStudentManagementGradefiveAdmission'])->name('admission.admission_student_management_gradefive');
        Route::get('/GradeSix', [Cpages::class, 'showStudentManagementGradesixAdmission'])->name('admission.admission_student_management_gradesix');
        Route::get('/AllStudentData', [Cpages::class, 'showAllStudent'])->name('admission.admission_show_all_data');
        Route::get('/StudentProfile', function () {
            return view('admission.includes.show_student_profile');
        });
    });

    // Student Management Routes registrar
    Route::prefix('/registrar/student-management')->group(function () {
        Route::get('/', [Cpages::class, 'showStudentManagement'])->name('admin.admin_student_management');
        Route::get('/GradeOne', [Cpages::class, 'showStudentManagementGradeoneRegistrar'])->name('registrar.registrar_student_management_gradeone');
        Route::get('/GradeTwo', [Cpages::class, 'showStudentManagementGradetwoRegistrar'])->name('registrar.registrar_student_management_gradetwo');
        Route::get('/GradeThree', [Cpages::class, 'showStudentManagementGradethreeRegistrar'])->name('registrar.registrar_student_management_gradethree');
        Route::get('/GradeFour', [Cpages::class, 'showStudentManagementGradefourRegistrar'])->name('registrar.registrar_student_management_gradefour');
        Route::get('/GradeFive', [Cpages::class, 'showStudentManagementGradefiveRegistrar'])->name('registrar.registrar_student_management_gradefive');
        Route::get('/GradeSix', [Cpages::class, 'showStudentManagementGradesixRegistrar'])->name('registrar.registrar_student_management_gradesix');
        Route::get('/AllStudentData', [Cpages::class, 'showAllStudent'])->name('registrar.registrar_show_all_data');
        Route::get('/StudentProfile', function () {
            return view('registrar.includes.show_student_profile');
        });
    });

    Route::get('/admin/student-management/AddStudent', function () {
        return view('admin.includes.add_student_form');
    });

    // Grade Book Routes
    Route::prefix('/admin/Grade-book/class-record')->group(function () {
        Route::get('/', [Cpages::class, 'showGradeBook'])->name('admin.admin_gradebook');
        Route::get('/GradeOne/{teachernumber}/{subject}', [Cpages::class, 'showGradeBookGradeone'])->name('admin.admin_gradebook_gradeone');
        Route::get('/GradeTwo/{teachernumber}/{subject}', [Cpages::class, 'showGradeBookGradetwo'])->name('admin.admin_gradebook_gradetwo');
        Route::get('/GradeThree/{teachernumber}/{subject}', [Cpages::class, 'showGradeBookGradethree'])->name('admin.admin_gradebook_gradethree');
        Route::get('/GradeFour/{teachernumber}/{subject}', [Cpages::class, 'showGradeBookGradefour'])->name('admin.admin_gradebook_gradefour');
        Route::get('/GradeFive/{teachernumber}/{subject}', [Cpages::class, 'showGradeBookGradefive'])->name('admin.admin_gradebook_gradefive');
        Route::get('/GradeSix/{teachernumber}/{subject}', [Cpages::class, 'showGradeBookGradesix'])->name('admin.admin_gradebook_gradesix');
    });

    // Report Section Routes
    Route::prefix('/admin/Report-Section')->group(function () {
        Route::get('/Graduate-Student', [Cpages::class, 'showGraduateStudent'])->name('admin.admin_graduate_students');
        Route::get('/Drop-Student', [Cpages::class, 'showDropStudent'])->name('admin.admin_drop_student');
        Route::get('/Archive-Student', [Cpages::class, 'showArchiveStudent'])->name('admin.admin_archive_student');
    });


    Route::get('/admin/student-management', [Cstudentinfo::class, 'showGradeData']);
    Route::get('/admin/Grade-book', [Cstudentinfo::class, 'showGradebook'])->name('gradebook');

    Route::prefix('/admin/student-management')->group(function () {
        Route::get('/GradeOne', [Cstudentinfo::class, 'showGradeOneData'])->name('grade.one');
        Route::get('/GradeTwo', [Cstudentinfo::class, 'showGradeTwoData'])->name('grade.two');
        Route::get('/GradeThree', [Cstudentinfo::class, 'showGradeThreeData'])->name('grade.three');
        Route::get('/GradeFour', [Cstudentinfo::class, 'showGradeFourData'])->name('grade.four');
        Route::get('/GradeFive', [Cstudentinfo::class, 'showGradeFiveData'])->name('grade.five');
        Route::get('/GradeSix', [Cstudentinfo::class, 'showGradeSixData'])->name('grade.six');
        Route::get('/AllStudentData', [Cstudentinfo::class, 'showAllStudentData'])->name('admin.admin_show_all_data');
    });

    Route::prefix('/admission/student-management')->group(function () {
        Route::get('/GradeOne', [AdmissionStudent::class, 'showGradeOneData'])->name('admission.grade.one');
        Route::get('/GradeTwo', [AdmissionStudent::class, 'showGradeTwoData'])->name('admission.grade.two');
        Route::get('/GradeThree', [AdmissionStudent::class, 'showGradeThreeData'])->name('admission.grade.three');
        Route::get('/GradeFour', [AdmissionStudent::class, 'showGradeFourData'])->name('admission.grade.four');
        Route::get('/GradeFive', [AdmissionStudent::class, 'showGradeFiveData'])->name('admission.grade.five');
        Route::get('/GradeSix', [AdmissionStudent::class, 'showGradeSixData'])->name('admission.grade.six');
        Route::get('/AllStudentData', [AdmissionStudent::class, 'showAllStudentData'])->name('admin.admin_show_all_data');
    });

    Route::prefix('/registrar/student-management')->group(function () {
        Route::get('/GradeOne', [RegistrarStudent::class, 'showGradeOneData'])->name('registrar.grade.one');
        Route::get('/GradeTwo', [RegistrarStudent::class, 'showGradeTwoData'])->name('registrar.grade.two');
        Route::get('/GradeThree', [RegistrarStudent::class, 'showGradeThreeData'])->name('registrar.grade.three');
        Route::get('/GradeFour', [RegistrarStudent::class, 'showGradeFourData'])->name('aregistrargrade.four');
        Route::get('/GradeFive', [RegistrarStudent::class, 'showGradeFiveData'])->name('registrar.grade.five');
        Route::get('/GradeSix', [RegistrarStudent::class, 'showGradeSixData'])->name('registrar.grade.six');
        Route::get('/AllStudentData', [RegistrarStudent::class, 'showAllStudentData'])->name('admin.admin_show_all_data');
    });

    Route::get('/admin/online-application', [RegisterStudent::class, 'showAllRegister'])->name('register.student');
    Route::get('/admin/student-registration', [StudentRegistrationController::class, 'showAllRegister'])->name('register.new.student');
    Route::get('/admission/student-registration', [StudentRegistrationController::class, 'showAllRegisterAdmission'])->name('admission.new.student');
    Route::get('/registrar/student-registration', [StudentRegistrationController::class, 'showAllRegisterRegistrar'])->name('registrar.new.student');

    Route::get('/teacher/myadvisory', [TeacherClassAdvisory::class, 'showMyadvisory'])->name('teacher.advisory');
    Route::get('/teacher/class-record', [TeacherSubjectClassController::class, 'showclasssubjectadvisory'])->name('teacher.class-record');
    Route::get('/teacher/class-record/{subject}', [TeacherSubjectClassController::class, 'showclasssubjectadvisory'])->name('teacher.class-record');


    Route::get('/admin/manage-accounts/admin-users', [Cadmininfo::class, 'showAllAdmin'])->name('admin.user');
    Route::post('/admin/create', [Cadmininfo::class, 'store'])->name('admin.create');
    Route::delete('/admin/{id}', [Cadmininfo::class, 'destroy'])->name('admin.delete');

    Route::get('/admin/manage-accounts/admission-users', [AdmissionUserController::class, 'showAllAdmin'])->name('admission.user');
    Route::post('/admission/create', [AdmissionUserController::class, 'store'])->name('admission.create');
    Route::delete('/admission/{id}', [AdmissionUserController::class, 'destroy'])->name('admission.delete');

    Route::get('/admin/manage-accounts/registrar-users', [RegistrarUserController::class, 'showAllAdmin'])->name('registrar.user');
    Route::post('/registrar/create', [RegistrarUserController::class, 'store'])->name('registrar.create');
    Route::delete('/registrar/{id}', [RegistrarUserController::class, 'destroy'])->name('registrar.delete');

    Route::get('/admin/manage-accounts/teacher-users', [TeacherUserController::class, 'showAllTeacher'])->name('teacher.user');
    Route::post('/teacher/create', [TeacherUserController::class, 'store'])->name('teacher.create');
    Route::delete('/teacher/{id}', [TeacherUserController::class, 'destroy'])->name('teacher.delete');
    Route::post('/manage-account/{teacherId}/reset', [TeacherUserController::class, 'resetAccount'])->name('teacher.reset');
    Route::put('/teacher/{id}', [TeacherUserController::class, 'update'])->name('teacher.update');

    Route::post('/advisory/create', [TeacherAdvisoryController::class, 'store'])->name('advisory.create');
    Route::post('/advisory/{id}', [TeacherAdvisoryController::class, 'update'])->name('advisory.update');

    Route::post('/subject/create', [TeacherSubjectClassController::class, 'store'])->name('teachersubject.create');
    Route::post('/subject/{id}', [TeacherSubjectClassController::class, 'update'])->name('teachersubject.update');

    Route::get('/admin/manage-system/subject', [SubjectController::class, 'index'])->name('admin.subject');
    Route::get('admin/createsubject', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('admin/createsubject', [SubjectController::class, 'store'])->name('subject.store');
    Route::get('admin/subject/{id}/edit', [SubjectController::class, 'edit'])->name('subject.edit'); // Edit subject route
    Route::put('admin/subject/{id}', [SubjectController::class, 'update'])->name('subject.update'); // Update subject route
    Route::delete('admin/subject/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy'); // Delete subject route

    Route::get('/admin/manage-system/section', [SectionController::class, 'index'])->name('admin.section');
    Route::get('admin/createsection', [SectionController::class, 'create'])->name('section.create');
    Route::post('admin/createsection', [SectionController::class, 'store'])->name('section.store');
    Route::get('admin/section/{id}/edit', [SectionController::class, 'edit'])->name('section.edit'); // Edit subject route
    Route::put('admin/section/{id}', [SectionController::class, 'update'])->name('section.update'); // Update subject route
    Route::delete('admin/section/{id}', [SectionController::class, 'destroy'])->name('section.destroy'); // Delete subject route

    Route::get('/admin/student-management/{id}', [Cstudentinfo::class, 'showStudentInfotmation'])->name('student.show');
    Route::get('/admin/student-management/dropped/{id}', [Cstudentinfo::class, 'showDroppedStudentInfotmation'])->name('student.show.dropped');
    Route::get('/admin/student-management/gradute/{id}', [Cstudentinfo::class, 'showGradutedStudentInfotmation'])->name('student.show.gradute');
    Route::get('/admin/student-management/transfer/{id}', [Cstudentinfo::class, 'showTransferStudentInfotmation'])->name('student.show.transfer');
    Route::get('/admission/student-management/{id}', [AdmissionStudent::class, 'showAdmissionInfotmation'])->name('admission.student.show');
    Route::get('/registrar/student-management/{id}', [Cstudentinfo::class, 'showregistrarInfotmation'])->name('registar.student.show');
    Route::get('/admin/teacher-management/{id}', [TeacherUserController::class, 'showTeacherInfotmation'])->name('teacher.show');

    Route::get('/taecher/myadvisory/{id}', [TeacherClassAdvisory::class, 'showStudentInfotmation'])->name('mystudent.show');

    Route::prefix('/admin/Grade-book')->group(function () {
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
    Route::post('/admin/Grade-book/GradeOne', [Cstudentgrades::class, 'updateStudentGrades'])->name('.admin.Grade-book.GradeOne');
    Route::get('/student-grades/{id}', [Cstudentgrades::class, 'getStudentGrades'])->name('student.grades.show');


    Route::get('/admin/Report-Section/Graduate-Student', [Cstudentinfo::class, 'showAllStudentGraduateData'])->name('admin.admin_graduate_students');
    Route::get('/admin/Report-Section/Drop-Student', [Cstudentinfo::class, 'showAllStudentDropData'])->name('admin.admin_drop_students');
    Route::get('/admin/Report-Section/Drop-Student/All-Drop-Data', [Cstudentinfo::class, 'showAllStudentDroppedData'])->name('admin.admin_show_all_drop_data');

    Route::get('/admin/Report-Section/Transfer-Student', [Cstudentinfo::class, 'showAllStudentArchiveData'])->name('admin.admin_archive_student');

    Route::get('/admin/dashboard', [Cevent::class, 'showAllAdmin'])->name('admin.admin_dashboard');

    Route::get('/admin/calendar', function () {
        return view('admin.admin_calendar');
    });

    Route::get('/admin/announcement', function () {
        return view('admin.admin_announcement');
    });

    Route::get('/admin/website-gallery', function () {
        return view('admin.website.admin_website_gallery');
    });

    Route::get('/admin/manage-registration', function () {
        return view('admin.website.admin_registration');
    });

    Route::get('/admin/SIMGT-Profile', function () {
        return view('admin.admin_profile');
    });

    Route::get('/teacher/SIMGT-Profile', function () {
        return view('teacher.teacher_profile');
    });

    // events Routes
    Route::post('/events', [Cevent::class, 'storeEvent'])->name('events.store');
    Route::put('/events/{id}', [Cevent::class, 'updateEvent'])->name('events.update');
    Route::delete('/events/{id}', [Cevent::class, 'deleteEvent'])->name('events.delete');
    Route::get('/events', [Cevent::class, 'showEvents']);

    // Announcement Routes
    Route::get('/announcements', [Cevent::class, 'showAnnouncements']);
    Route::post('/announcements', [Cevent::class, 'storeAnnouncement'])->name('announcements.store');
    Route::put('/announcements/{id}', [Cevent::class, 'updateAnnouncement'])->name('announcements.update');
    Route::delete('/announcements/{id}', [Cevent::class, 'deleteAnnouncement'])->name('announcements.delete');

    Route::get('/admin/announcement', [PictureAnnouncementController::class, 'showAnnouncements'])->name('announcements.show');

    Route::delete('/admin/announcement/{id}', [PictureAnnouncementController::class, 'deleteAnnouncement'])->name('pictureannouncements.delete');
    // Route::post('/admin/announcement/{id}', [PictureAnnouncementController::class, 'updateAnnouncement'])->name('announcements.update');
    Route::post('/admin/announcement', [PictureAnnouncementController::class, 'store'])->name('announcementspicture.store');
    // Route::get('/announcements', [PictureAnnouncementController::class, 'index'])->name('announcements.index');
    // Update announcement route
    Route::post('/announcements/{id}', [PictureAnnouncementController::class, 'update'])->name('announcements.update');


    Route::get('grades/upload', [GradeController::class, 'index'])->name('grades.upload');
    Route::post('grades/upload', [GradeController::class, 'store'])->name('grades.store');

    //teacher routes
    Route::get('/teacher/dashboard', function () {
        return view('teacher.teacher_dashboard');
    });
    Route::get('/teacher/dashboard', [Cevent::class, 'showDashboardteacher'])->name('teacher.dashboard');

    // Student Dashboard Route with Latest Announcements
    Route::get('/student/dashboard', function () {
        return view('student.student_dashboard');
    });

    Route::get('/student/dashboard', [Cevent::class, 'showDashboardstudent'])->name('student.dashboard');
    Route::get('/student/calendar', [Cevent::class, 'showCalendar'])->name('student.calendar');
    Route::get('/api/events', [Cevent::class, 'getEvents']);

    Route::get('/student/registration', function () {
        return view('student.registration');
    });

    Route::get('students/register', [StudentRegistrationController::class, 'showRegistrationForm'])->name('students.registration');
    Route::post('students/registers', [StudentRegistrationController::class, 'register'])->name('students.register');

    Route::get('/teacher/calendar', [Cevent::class, 'showteacherCalendar'])->name('teacher.calendar');

    Route::get('/student/student-profile/account', function () {
        return view('student.student_profile');
    });

    Route::get('/student/student-profile/security', function () {
        return view('student.student_profile_security');
    });

    Route::get('/student/student-profile/additional-inforamtion', function () {
        return view('student.student_profile_information');
    });

    Route::get('/student/grades', function () {
        return view('student.student_grades');
    });

    Route::get('/student/student-grade', function () {
        return view('student.student_grades_new');
    });

    Route::get('/student/student-grade', [CStudentProfile::class, 'showStudentGrades'])->name('student.gradesnew');

    Route::post('/update-avatar', [TeacherProfile::class, 'updateprofile'])->name('teacher.update-avatar');
    Route::post('/student/update-avatar', [CStudentProfile::class, 'update'])->name('student.update-avatar');
    Route::post('/teacher/change-password/{studentId}', [TeacherProfile::class, 'changePassword'])->name('teacher.changePassword');

    //REGISTRAR________________________________________________________________
    //________________________________________________________________
    Route::get('/registrar/dashboard', function () {
        return view('registrar.registrar_dashboard');
    });

    Route::get('/registrar/SIMGT-Profile', function () {
        return view('registrar.registrar_profile');
    });

    Route::post('/registrar/update-avatar', [RegistrarUserController::class, 'updateProfile'])->name('registrar.update-avatar');
    Route::put('/registrar/{id}/update', [RegistrarUserController::class, 'update'])->name('registrar.update');
    Route::post('/registrar/change-password/{studentId}', [RegistrarUserController::class, 'changePassword'])->name('registrar.changePassword');

    Route::get('/registrar/student-management/{id}', [RegistrarStudent::class, 'showRegistrarInfotmation'])->name('student.show.registrar');

    Route::post('/register/students', [StudentRegistrationController::class, 'newRegistered'])->name('includes.register_student_form.store');

    Route::get('/registrar/student-management/Add-Student', function () {
        return view('registrar.includes.add_student_form');
    });
    Route::get('/registrar/online-application/{lrn}', [RegisterStudent::class, 'showEnrolleesInformation'])->name('student.show.enrollees');
    Route::get('/registrar/Student-Registration/{lrn}', [StudentRegistrationController::class, 'getPrimaryInfo'])->name('student.show.enrollees.register');

    Route::get('/check-enrollment-status/{lrn}', [RegisterStudent::class, 'checkEnrollmentStatus']);

    Route::get('/registrar/dashboard', [Cevent::class, 'showAllRegistrar'])->name('registrar.registrar_dashboard');

    Route::get('/registrar/online-application', [RegisterStudent::class, 'showAllRegisterRegistrar'])->name('registrar.register.student');

    //ADMISSION________________________________________________________________
    //________________________________________________________________
    Route::get('/admission/dashboard', function () {
        return view('admission.admission_dashboard');
    });

    Route::get('/admission/SIMGT-Profile', function () {
        return view('admission.admission_profile');
    });

    Route::get('/admission/calendar', function () {
        return view('admission.admission_calendar');
    });

    Route::get('/admission/announcement', function () {
        return view('admission.admission_announcement');
    });

    Route::get('/admission/website-gallery', function () {
        return view('admission.website.admission_website_gallery');
    });
    
    Route::get('/admission/manage-registration', function () {
        return view('admission.website.admission_registration');
    });

    Route::get('/admission/website-gallery', function () {
        return view('admission.website.admission_website_gallery');
    });

    Route::get('/admission/dashboard', [Cevent::class, 'showAllAdmission'])->name('admission.admission_dashboard');
    Route::post('/admission/update-avatar', [AdmissionUserController::class, 'updateProfile'])->name('admission.update-avatar');
    Route::put('/admission/{id}/update', [AdmissionUserController::class, 'update'])->name('admission.update');
    Route::post('/admission/change-password/{studentId}', [AdmissionUserController::class, 'changePassword'])->name('admission.changePassword');

    Route::get('/admission/announcement', [PictureAnnouncementController::class, 'showAnnouncementsAdmission'])->name('admission.announcements.show');
    Route::delete('/admission/announcement/{id}', [PictureAnnouncementController::class, 'deleteAnnouncementAdmission'])->name('pictureannouncementsAdmission.delete');
    Route::post('/admission/announcement', [PictureAnnouncementController::class, 'storeAdmission'])->name('admission.announcementspicture.store');

    Route::post('/announcements/admission/{id}', [PictureAnnouncementController::class, 'updateAnnouncementAdmission'])->name('admission.announcements.update');
    Route::get('/admission/online-application', [RegisterStudent::class, 'showAllRegisterAdmission'])->name('admission.register.student');
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
Route::put('/students/primary/{id}', [Cstudentinfo::class, 'updateStudentInfoPrimary'])->name('students.update.primary');
Route::post('/send-email/{id}', [Cstudentinfo::class, 'sendEmail'])->name('send.email');
Route::put('/students/drop/{id}', [Cstudentinfo::class, 'dropStudent'])->name('students.drop');
Route::put('/students/retrive/{id}', [Cstudentinfo::class, 'retrieveStudent'])->name('students.retrieve');

Route::post('/teachersend-email/{id}', [TeacherUserController::class, 'sendEmail'])->name('teacher.email');

Route::post('/student/change-password/{studentId}', [CStudentProfile::class, 'changePassword'])->name('student.changePassword');
Route::post('/show-grades', [CStudentProfile::class, 'showGrades'])->name('showGrades');

Route::post('/show-quarterly-grades', [CStudentProfile::class, 'showStudentGrades'])->name(name: 'showquarterlyGrades');

Route::post('/profile/update-avatar', [Cadmininfo::class, 'updateProfile'])->name('profile.update-avatar');
Route::put('/admin/{id}/update', [Cadmininfo::class, 'update'])->name('admin.update');
Route::post('/admin/change-password/{studentId}', [Cadmininfo::class, 'changePassword'])->name('admin.changePassword');

Route::post('/teacher/change-password/{studentId}', [TeacherProfile::class, 'changePassword'])->name('teacher.changePassword');

Route::get('/get-classsubject', [TeacherSubjectClassController::class, 'getClassSubject'])->name('get.classsubject');
Route::get('/get-teacherclasssubject', [TeacherSubjectClassController::class, 'getTeacherSubject'])->name('get.teacherclasssubject');
Route::get('/get-onesections', [Cstudentgrades::class, 'getGradeOneSections'])->name('get.sections');
Route::get('/get-twosections', [Cstudentgrades::class, 'getGradeTwoSections'])->name('get.twosections');
Route::get('/get-threesections', [Cstudentgrades::class, 'getGradeThreeSections'])->name('get.threesections');
Route::get('/get-foursections', [Cstudentgrades::class, 'getGradeFourSections'])->name('get.foursections');
Route::get('/get-fivesections', [Cstudentgrades::class, 'getGradeFiveSections'])->name('get.fivesections');
Route::get('/get-sixsections', [Cstudentgrades::class, 'getGradeSixSections'])->name('get.sixsections');
Route::get('/get-grade', [Cstudentgrades::class, 'getAllGrade'])->name('get.allgrade');
Route::get('/get-Section', [Cstudentgrades::class, 'getxSections'])->name('get.allsection');

Route::post('/teacher-subject-class/update-inline', [TeacherSubjectClassController::class, 'updateInline'])->name('teacher-subject-class.update-inline');
Route::post('/student/update-inline', [TeacherSubjectClassController::class, 'updateInlinestudent'])->name('student.update-inline');
Route::post('/student/update-inlin/final', [TeacherSubjectClassController::class, 'updateInlinestudentfinal'])->name('student.update-final');

// Route to toggle the status of the first registration button
Route::patch('/registration-button/toggle', [RegistrationButtonController::class, 'toggleStatus'])->name('registration-button.toggle');

// Route to get the current status of the first registration button
Route::get('/registration-button/status', [RegistrationButtonController::class, 'currentStatus'])->name('registration-button.status');
