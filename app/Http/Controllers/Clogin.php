<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Import Carbon for date/time handling
use App\Models\StudentInfo; // Import StudentInfo model
use App\Models\StudentAdditionalInfo; // Import StudentAdditionalInfo model
use App\Models\StudentDocuments; // Import StudentDocuments model
use App\Models\Mannouncement;
use App\Models\TeacherAdvisory;
use App\Models\TeacherUser;

class Clogin extends Controller
{
    public function showLoginForm(Request $request)
    {
        // Check if the user is already authenticated
        if (Auth::guard('admin')->check()) {

            return redirect()->route('admin.admin_dashboard'); // Ensure this route is correct

        } elseif (Auth::guard('teacher')->check()) {

            return view('teacher.teacher_dashboard');

        } elseif (Auth::guard('student')->check()) {
            $latestAnnouncements = Mannouncement::latest()->take(5)->get();

            // Check if there are any announcements
            $newAnnouncements = $latestAnnouncements->count() > 0;

            // Return the view with announcements data
            return view('student.student_dashboard', compact('latestAnnouncements', 'newAnnouncements'));
        }

        // Check if the user is locked out
        if ($this->isLockedOut($request)) {
            $remainingMinutes = Carbon::now()->diffInMinutes(session('lockout_time'));
            // Show login form with lockout message, not just an error
            return view('login')->withErrors(['username' => "Too many login attempts. Try again in {$remainingMinutes} minutes."]);
        }

        // Show the login form if not locked out
        return view('login'); // Show your login view
    }

    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        \Log::info('Login attempt:', [
            'username' => $request->username,
        ]);

        // Check if the user is locked out
        if ($this->isLockedOut($request)) {
            $remainingMinutes = Carbon::now()->diffInMinutes(session('lockout_time'));
            return back()->withErrors(['username' => "Too many login attempts. Try again in {$remainingMinutes} minutes."])
                ->withInput($request->only('username'));
        }

        // Attempt to log the user in as admin
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            $this->clearLoginAttempts($request);

            // Get the authenticated admin user
            $adminUser = Auth::guard('admin')->user();

            // Store admin's data in the session
            $request->session()->put('admin_username', $adminUser->username);
            $request->session()->put('admin_id', $adminUser->id);
            $request->session()->put('admin_fname', $adminUser->first_name);
            $request->session()->put('admin_mname', $adminUser->middle_name);
            $request->session()->put('admin_lname', $adminUser->last_name);
            $request->session()->put('admin_role', $adminUser->role);  // Store the role
            $request->session()->put('admin_number', $adminUser->admin_number);

            // Flash a success message
            $request->session()->flash('success', 'Welcome, ' . $adminUser->username . '! You are now logged in as Admin.');

            // Redirect to the admin dashboard or admin loader
            return view('includes.admin_loader');
        }

        // Attempt to log the user in as admin
        if (Auth::guard('teacher')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            $this->clearLoginAttempts($request);

            // Get the authenticated admin user
            $teacherUser = Auth::guard('teacher')->user();

            // Store admin's data in the session
            $request->session()->put('teacher_username', $teacherUser->username);
            $request->session()->put('teacher_id', $teacherUser->id);

            //Flash a success message
            $request->session()->flash('success', 'Welcome,' . $teacherUser->username . ' ! You are now logged in as Teacher.');

            // Redirect to the admin dashboard or admin loader
            return view('includes.teacher_loader');
        }


        // Attempt to log the user in as student
        if (Auth::guard('student')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            $this->clearLoginAttempts($request);

            $student = Auth::guard('student')->user(); // Get the authenticated student

            $request->session()->put('student_username', $student->username); // Adjust based on your username field
            $request->session()->put('student_id', $student->student_number);

            // Fetch additional student info from StudentInfo
            $studentInfo = StudentInfo::where('student_number', $student->student_number)->first();

            if ($studentInfo) {
                // Store the names in the session from StudentInfo
                $request->session()->put('student_number', $studentInfo->student_number);
                $request->session()->put('lrn', $studentInfo->lrn);
                $request->session()->put('grade', $studentInfo->grade);
                $request->session()->put('school_year', $studentInfo->school_year);
                $request->session()->put('section', $studentInfo->section);
                $request->session()->put('status', $studentInfo->status);
                $request->session()->put('student_last_name', $studentInfo->student_last_name);
                $request->session()->put('student_first_name', $studentInfo->student_first_name);
                $request->session()->put('student_middle_name', $studentInfo->student_middle_name);
                $request->session()->put('student_suffix_name', $studentInfo->student_suffix_name);
                $request->session()->put('place_of_birth', $studentInfo->place_of_birth);
                $request->session()->put('birth_date', $studentInfo->birth_date);
                $request->session()->put('sex', $studentInfo->sex);
                $request->session()->put('age', $studentInfo->age);
                $request->session()->put('email_address_send', $studentInfo->email_address_send);
                $request->session()->put('contact_number', $studentInfo->contact_number);
                $request->session()->put('religion', $studentInfo->religion);
                $request->session()->put('house_number', $studentInfo->house_number);
                $request->session()->put('street', $studentInfo->street);
                $request->session()->put('barangay', $studentInfo->barangay);
                $request->session()->put('province', $studentInfo->province);
                $request->session()->put('city', $studentInfo->city);

            }

            // Fetch additional information
            $additionalInfo = StudentAdditionalInfo::where('student_number', $student->student_number)->first();

            if ($additionalInfo) {
                // Store the names in the session from StudentInfo
                $request->session()->put('student_number', $additionalInfo->student_number);
                $request->session()->put('father_last_name', $additionalInfo->father_last_name);
                $request->session()->put('father_first_name', $additionalInfo->father_first_name);
                $request->session()->put('father_middle_name', $additionalInfo->father_middle_name);
                $request->session()->put('father_suffix_name', $additionalInfo->father_suffix_name);
                $request->session()->put('father_occupation', $additionalInfo->father_occupation);
                $request->session()->put('mother_last_name', $additionalInfo->mother_last_name);
                $request->session()->put('mother_first_name', $additionalInfo->mother_first_name);
                $request->session()->put('mother_middle_name', $additionalInfo->mother_middle_name);
                $request->session()->put('mother_occupation', $additionalInfo->mother_occupation);
                $request->session()->put('guardian_last_name', $additionalInfo->guardian_last_name);
                $request->session()->put('guardian_first_name', $additionalInfo->guardian_first_name);
                $request->session()->put('guardian_middle_name', $additionalInfo->guardian_middle_name);
                $request->session()->put('guardian_suffix_name', $additionalInfo->guardian_suffix_name);
                $request->session()->put('guardian_relationship', $additionalInfo->guardian_relationship);
                $request->session()->put('guardian_contact_number', $additionalInfo->guardian_contact_number);
                $request->session()->put('guardian_religion', $additionalInfo->guardian_religion);
                $request->session()->put('emergency_contact_person', $additionalInfo->emergency_contact_person);
                $request->session()->put('emergency_contact_number', $additionalInfo->emergency_contact_number);
                $request->session()->put('email_address', $additionalInfo->email_address);
                $request->session()->put('messenger_account', $additionalInfo->messenger_account);

            }

            $documents = StudentDocuments::where('student_number', $student->student_number)->first();

            $adviser = null;

            // Fetch the advisory (teacher's details based on section)
            $section = TeacherAdvisory::where('section', $studentInfo->section)->first();

            if ($section) {
                // Fetch the teacher's information (adviser)
                $adviser = TeacherUser::where('teacher_number', $section->teacher_number)->first();

                if ($adviser) {
                    // Store the adviser's information in session
                    $request->session()->put('adviser_employee_number', $adviser->teacher_number);
                    $request->session()->put('adviser_last_name', $adviser->last_name);
                    $request->session()->put('adviser_first_name', $adviser->first_name);
                    $request->session()->put('adviser_middle_name', $adviser->middle_name);
                    $request->session()->put('adviser_email', $adviser->email);
                }
            }

            // Pass the data to the view
            return view('includes.student_loader', [
                'student' => $studentInfo,
                'additionalInfo' => $additionalInfo,
                'documents' => $documents,
                'adviser' => $adviser,  // Pass the adviser details to the view
            ]);
        }

        // Increment login attempts and show error message
        $this->incrementLoginAttempts($request);
        return back()->withErrors(['username' => 'The provided credentials do not match our records.'])->onlyInput('username');
    }

    // Function to increment login attempts
    protected function incrementLoginAttempts(Request $request)
    {
        $attempts = session('login_attempts', 0);
        $attempts++;
        session(['login_attempts' => $attempts]);

        // Lock the user out if they've reached 3 attempts
        if ($attempts >= 3) {
            session(['lockout_time' => Carbon::now()->addMinutes(5)]); // Lock for 5 minutes
        }
    }

    // Function to check if the user is locked out
    protected function isLockedOut(Request $request)
    {
        $lockoutTime = session('lockout_time');
        if ($lockoutTime && Carbon::now()->lessThan($lockoutTime)) {
            return true;
        }

        return false;
    }

    // Function to clear login attempts after a successful login
    protected function clearLoginAttempts(Request $request)
    {
        session()->forget('login_attempts');
        session()->forget('lockout_time');
    }

    public function logout(Request $request)
    {
        // Check which guard is authenticated and log the user out accordingly
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->flash('success', 'You have been logged out successfully as Admin.');
        } elseif (Auth::guard('student')->check()) {
            Auth::guard('student')->logout();
            $request->session()->flash('success', 'You have been logged out successfully as Student.');
        }

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect()->route('admin.login'); // Adjust as necessary for student login
    }


    public function showDashboard()
    {
        if (Auth::guard('admin')->check()) {
            return view('login'); // Admin view
        }

        if (Auth::guard('student')->check()) {
            return view('includes.student_loader'); // Student view
        }

        return redirect()->route('login')->withErrors(['error' => 'You must be logged in to access this page.']);
    }
}
