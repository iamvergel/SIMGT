<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Make sure to import Carbon
use Illuminate\Support\Facades\Storage;
use App\Mail\TeacherEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\TeacherUser;
use App\Models\TeacherAdvisory;
use App\Models\TeacherSubjectClass;

class TeacherUserController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'teacher_number' => 'required|string|unique:teacher_user,teacher_number',
            'username' => 'required|string|unique:teacher_user,username',
            'password' => 'required',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'contact_number' => 'nullable|string',
            'department' => 'nullable|string',
            'position' => 'nullable|string',
            'status' => 'nullable|string',
            'gender' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'religion' => 'nullable|string',
        ]);

        // Create the new teacher user
        $teacherUser = TeacherUser::create([
            'teacher_number' => $request->teacher_number,
            'username' => $request->username,
            'password' => $request->password, // Hash the password
            'first_name' => $request->first_name ? ucwords(strtolower($request['first_name'])) : null,
            'middle_name' => $request->middle_name ? ucwords(strtolower($request['middle_name'])) : null,
            'last_name' => $request->last_name ? ucwords(strtolower($request['last_name'])) : null,
            'suffix' => $request->suffix ? ucwords(strtolower($request['suffix'])) : null,
            'address' => $request->address ? ucwords(strtolower($request['address'])) : null,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'department' => $request->department ? ucwords(strtolower($request['department'])) : null,
            'position' => $request->position ? ucwords(strtolower($request['position'])) : null,
            'status' => $request->status ? ucwords(strtolower($request['status'])) : null,
            'gender' => $request->gender ? ucwords(strtolower($request['gender'])) : null,
            'birthdate' => $request->birthdate,
            'religion' => $request->religion ? ucwords(strtolower($request['religion'])) : null,
        ]);

        // Return success response
        return back()->with('success', 'New teacher added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'contact_number' => 'nullable|string',
            'department' => 'nullable|string',
            'position' => 'nullable|string',
            'status' => 'nullable|string',
            'gender' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'religion' => 'nullable|string',
        ]);

        // Find the teacher user
        $user = TeacherUser::find($id);
        if (!$user) {
            return response()->json(['error' => 'teacher user not found.'], 404);
        }

        // Update the other fields
        $user->first_name = $request->first_name ? ucfirst(strtolower($request['first_name'])) : null;
        $user->middle_name = $request->middle_name ? ucfirst(strtolower($request['middle_name'])) : null;
        $user->last_name = $request->last_name ? ucfirst(strtolower($request['last_name'])) : null;
        $user->suffix = $request->suffix ? ucfirst(strtolower($request['suffix'])) : null;
        $user->address = ucfirst(strtolower($request->address));
        $user->email = $request->email;
        $user->contact_number = ucfirst(strtolower($request->contact_number));
        $user->department = ucfirst(strtolower($request->department));
        $user->position = ucfirst(strtolower($request->position));
        $user->status = ucfirst(strtolower($request->status));
        $user->gender = ucfirst(strtolower($request->gender));
        $user->birthdate = $request->birthdate;
        $user->religion = ucfirst(strtolower($request->religion));

        // Save the updated user details
        $user->save();

        // Return success response
        return back()->with('success', 'Update Information Successfully!');
    }

    public function showTeacherInfotmation(Request $request, $id)
    {
        // Fetch the specific teacher based on the provided id
        $teachers = TeacherUser::where('id', $id)->where('status', 'Active')->first();

        // If the teacher doesn't exist, you could redirect back or show an error message
        if (!$teachers) {
            return redirect()->route('teacher.user')->with('error', 'Teacher not found.');
        }

        $teacherAdvisory = null;

        // Fetch related data for the specific teacher
        $teacherAdvisory = TeacherAdvisory::where('teacher_number', $teachers->teacher_number)->first();
        $teacherAdvisoryAll = TeacherAdvisory::where('teacher_number', $teachers->teacher_number)->get();
        $teacherSubjects = TeacherSubjectClass::where('teacher_number', $teachers->teacher_number)->get();
        // $teacherDocuments = teacherDocuments::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherAccount = TeacherUser::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeOne = Mteachergradeone::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeTwo = Mteachergradetwo::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeThree = Mteachergradethree::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeFour = Mteachergradefour::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeFive = Mteachergradefive::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeSix = Mteachergradesix::where('teacher_number', $teachers->teacher_number)->first();

        // You can pass other data here as needed
        return view('admin.includes.teacher_information', compact('teachers', 'teacherAdvisory', 'teacherSubjects', 'teacherAdvisoryAll'));
    }

    public function showTeacherInfotmationRegistrar(Request $request, $id)
    {
        // Fetch the specific teacher based on the provided id
        $teachers = TeacherUser::where('id', $id)->first();

        // If the teacher doesn't exist, you could redirect back or show an error message
        if (!$teachers) {
            return redirect()->route('teacher.user')->with('error', 'Teacher not found.');
        }

        $teacherAdvisory = null;

        // Fetch related data for the specific teacher
        $teacherAdvisory = TeacherAdvisory::where('teacher_number', $teachers->teacher_number)->first();
        $teacherSubjects = TeacherSubjectClass::where('teacher_number', $teachers->teacher_number)->get();
        // $teacherDocuments = teacherDocuments::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherAccount = TeacherUser::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeOne = Mteachergradeone::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeTwo = Mteachergradetwo::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeThree = Mteachergradethree::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeFour = Mteachergradefour::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeFive = Mteachergradefive::where('teacher_number', $teachers->teacher_number)->first();
        // $teacherGradeSix = Mteachergradesix::where('teacher_number', $teachers->teacher_number)->first();

        // You can pass other data here as needed
        return view('registrar.includes.teacher_information', compact('teachers', 'teacherAdvisory', 'teacherSubjects'));
    }

    public function resetAccount(Request $request, $teacherId)
    {
        // Find the teacher by ID
        $teacher = TeacherUser::find($teacherId);

        if (!$teacher) {
            return back()->withErrors('teacher not found.');
        }

        // Create username
        $username = strtolower($teacher->last_name) . strtolower($teacher->first_name) . '@stemilie.edu.ph';

        // Validate incoming request for defaultPassword
        $validatedData = $request->validate([
            'defaultPassword' => 'required',
        ]);

        $userAccount = new TeacherUser();
        // Get the password from the input
        $userAccount->password = $validatedData['defaultPassword'];

        // Create or update user account
        $userAccount = TeacherUser::firstOrNew(['teacher_number' => $teacher->teacher_number]);
        $userAccount->username = $username;
        $userAccount->password = $validatedData['defaultPassword']; // Hash the provided password
        $userAccount->save();

        return back()->with('success', 'Account reset successfully for ' . $teacher->first_name . '!');
    }

    public function sendEmail(Request $request, $teacherId)
    {
        // Find the teacher by ID
        $teacher = TeacherUser::find($teacherId);

        if (!$teacher) {
            return back()->withErrors('teacher not found.');
        }

        // Send the email
        Mail::to($teacher->email)->send(new TeacherEmail($teacher));

        return back()->with('success', 'Email sent successfully to ' . $teacher->first_name . '!');
    }

    public function destroy($id)
    {
        // Find the teacher user by ID
        $teacher = TeacherUser::find($id);

        if (!$teacher) {
            return response()->json(['error' => 'teacher user not found.'], 404);
        }

        // Delete the teacher user
        $teacher->delete();

        // Return success response
        return back()->with('success', 'teacher user deleted successfully!');
    }

    public function showAllTeacher()
    {
        // Get the currently logged-in teacher's ID
        $currentteacherId = auth()->id(); // Assuming you use Laravel's built-in auth system

        // Fetch all teachers but exclude the currently logged-in teacher
        $teacher = TeacherUser::all();

        // Check if there are no teachers
        $noteacher = $teacher->isEmpty() ? "No teacher found" : null;

        return view('admin.admin_teacher_user', compact('teacher', 'noteacher'));
    }

    public function showAllTeacherRegistrar()
    {
        // Get the currently logged-in teacher's ID
        $currentteacherId = auth()->id(); // Assuming you use Laravel's built-in auth system

        // Fetch all teachers but exclude the currently logged-in teacher
        $teacher = TeacherUser::all();

        // Check if there are no teachers
        $noteacher = $teacher->isEmpty() ? "No teacher found" : null;

        return view('registrar.registrar_teacher_user', compact('teacher', 'noteacher'));
    }

    public function changePassword(Request $request, $teacherId)
    {
        $teacher = TeacherUser::find($teacherId);

        if (!$teacher) {
            return back()->withErrors('teacher not found.');
        }

        // Validate the request
        $request->validate([
            'currentPassword' => 'required|string',
            'newPassword' => 'required|string|min:8',
        ]);

        // Track password attempts
        $attempts = session('current_password_attempts', 0);
        $lockoutTime = session('current_password_lockout_time');

        // Check if the user is locked out
        if ($attempts >= 3) {
            if ($lockoutTime && Carbon::now()->lessThan($lockoutTime)) {
                $remainingMinutes = Carbon::now()->diffInMinutes($lockoutTime);
                return back()->withErrors("You have exceeded the maximum number of attempts to change your password. Try again in {$remainingMinutes} minutes.");
            } else {
                // Reset attempts if the lockout period has expired
                session()->forget('current_password_attempts');
                session()->forget('current_password_lockout_time');
                $attempts = 0; // Reset attempts
            }
        }

        // Check if the current password is correct
        if (!Hash::check($request->currentPassword, $teacher->password)) {
            // Increment the attempt count
            $attempts++;
            session(['current_password_attempts' => $attempts]);

            // Lock out if attempts exceed the limit
            if ($attempts >= 3) {
                session(['current_password_lockout_time' => Carbon::now()->addHours(24)]); // Lock for 24 hours
                return back()->withErrors('You have exceeded the maximum number of attempts to change your password.. Try again in 24 hours.');
            }

            return back()->withErrors('Current password is incorrect.');
        }

        // Check if the last password change was less than 30 days ago
        if ($teacher->last_password_change && $teacher->last_password_change->diffInDays(now()) < 30) {
            return back()->withErrors('You can only change your password once every 30 days.');
        }

        // Update the password with hashing
        $teacher->password = $request->newPassword;
        $teacher->last_password_change = now();
        $teacher->save();

        // Clear password change attempts
        session()->forget('current_password_attempts');
        session()->forget('current_password_lockout_time');

        // Redirect with success message
        return back()->with('success', 'Password changed successfully! Please log in with your new password.');
    }

    // Function to increment password change attempts
    protected function incrementPasswordChangeAttempts()
    {
        $attempts = session('password_change_attempts', 0);
        $attempts++;
        session(['password_change_attempts' => $attempts]);

        // Lock the user out if they've reached 3 attempts
        if ($attempts >= 3) {
            session(['password_change_lockout_time' => Carbon::now()->addHours(0)]); // Lock for 24 hours
        }
    }
}
