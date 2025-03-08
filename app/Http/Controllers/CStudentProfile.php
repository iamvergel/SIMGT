<?php
namespace App\Http\Controllers;

use App\Models\Mstudentaccount;
use App\Models\Mstudentgradefive;
use App\Models\Mstudentgradefour;
use App\Models\Mstudentgradeone;
use App\Models\Mstudentgradesix;
use App\Models\Mstudentgradethree;
use App\Models\Mstudentgradetwo;
use App\Models\StudentFinalGrade;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Make sure to import Carbon
use Illuminate\Support\Facades\Hash;

class CStudentProfile extends Controller
{
    public function update(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'avatar'         => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'student_number' => 'required|string',
        ]);

        $student        = Auth::guard('student')->user();
        $studentAccount = Mstudentaccount::find($student->id);

        // Check if the student number matches
        if ($student->student_number !== $request->student_number) {
            return response()->json(['error' => 'Invalid student number.'], 400);
        }

        // Check if the user has changed their avatar recently
        if ($studentAccount->last_avatar_change) {
            $lastChange = Carbon::parse($studentAccount->last_avatar_change);
            $now        = Carbon::now();

            if ($now->diffInDays($lastChange) < 10) {
                return response()->json(['error' => 'You can only change your avatar every 10 days.'], 400);
            }
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $path                               = $request->file('avatar')->store('avatars', 'public');
            $studentAccount->avatar             = $path;
            $studentAccount->last_avatar_change = now(); // Update the timestamp
            $studentAccount->save();

            return response()->json(['avatar' => asset('storage/' . $path)]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }

    public function changePassword(Request $request, $studentId)
    {
        $student = Mstudentaccount::find($studentId);

        if (! $student) {
            return back()->withErrors('Student not found.');
        }

        // Validate the request
        $request->validate([
            'currentPassword' => 'required|string',
            'newPassword'     => 'required|string|min:8',
        ]);

        // Track password attempts
        $attempts    = session('current_password_attempts', 0);
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
        if (! Hash::check($request->currentPassword, $student->password)) {
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
        if ($student->last_password_change && $student->last_password_change->diffInDays(now()) < 30) {
            return back()->withErrors('You can only change your password once every 30 days.');
        }

        // Update the password with hashing
        $student->password             = $request->newPassword;
        $student->last_password_change = now();
        $student->save();

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
            session(['password_change_lockout_time' => Carbon::now()->addHours(24)]); // Lock for 24 hours
        }
    }

    public function fetchAllGrades(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'student_number' => 'required|string',
        ]);

        // Fetch the student account based on the provided student number
        $student = Mstudentaccount::where('student_number', $request->student_number)->first();

        if (! $student) {
            return response()->json(['error' => 'Student not found.'], 404);
        }

        // Initialize an array to hold the grades
        $grades = [];

        // Fetch grades from each grade model
        $grades['grade_one']   = Mstudentgradeone::where('student_id', $student->id)->get();
        $grades['grade_two']   = Mstudentgradetwo::where('student_id', $student->id)->get();
        $grades['grade_three'] = Mstudentgradethree::where('student_id', $student->id)->get();
        $grades['grade_four']  = Mstudentgradefour::where('student_id', $student->id)->get();
        $grades['grade_five']  = Mstudentgradefive::where('student_id', $student->id)->get();
        $grades['grade_six']   = Mstudentgradesix::where('student_id', $student->id)->get();

        // You can also include quarter information if needed
        // Assuming each grade model has quarter fields (quarter1, quarter2, quarter3, quarter4)

        return response()->json($grades);
    }

    public function showGrades(Request $request)
    {
        $student = Auth::guard('student')->user();

        // Fetch grades based on student number
        $grades = [
            'grade_one'   => Mstudentgradeone::where('student_number', $student->student_number)->get(),
            'grade_two'   => Mstudentgradetwo::where('student_number', $student->student_number)->get(),
            'grade_three' => Mstudentgradethree::where('student_number', $student->student_number)->get(),
            'grade_four'  => Mstudentgradefour::where('student_number', $student->student_number)->get(),
            'grade_five'  => Mstudentgradefive::where('student_number', $student->student_number)->get(),
            'grade_six'   => Mstudentgradesix::where('student_number', $student->student_number)->get(),
        ];

        return response()->json($grades);
    }

    public function showStudentGrades(Request $request)
    {
        // Ensure the student is authenticated
        $student = Auth::guard('student')->user();
        if (!$student) {
            return response()->json(['error' => 'Student not authenticated.'], 401);
        }

        // Fetch student grades based on student_number
        $grades = StudentFinalGrade::where('student_number', $student->student_number)->get();


        return view('student.student_grades_new', compact('grades'));
    }
}
