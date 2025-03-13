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

class TeacherProfile extends Controller
{
    public function updateprofile(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Avatar validation
            'id' => 'required|integer', // Admin ID (we'll use this to identify the admin)
        ]);

        // Find the admin user by their ID
        $adminUser = TeacherUser::find($request->id);

        // Check if the admin user exists
        if (!$adminUser) {
            return response()->json(['error' => 'Admin user not found.'], 404);
        }

        // Check if the user has changed their avatar recently
        if ($adminUser->last_avatar_change) {
            $lastChange = Carbon::parse($adminUser->last_avatar_change);
            $now = Carbon::now();

            // Ensure that the admin can only change the avatar once every 10 days
            if ($now->diffInDays($lastChange) < 10) {
                return response()->json(['error' => 'You can only change your avatar every 10 days.'], 400);
            }
        }

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Store the avatar in the 'avatars' directory inside the public storage
            $path = $request->file('avatar')->store('teacher', 'public');

            // Update the admin user's avatar field and the timestamp for the last avatar change
            $adminUser->avatar = $path;
            $adminUser->last_avatar_change = now();
            $adminUser->save();

            // Return the URL for the uploaded avatar
            return response()->json(['avatar' => asset('storage/' . $path)]); // Public URL of the avatar
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }

    public function changePassword(Request $request, $studentId)
    {
        $student = TeacherUser::find($studentId);

        if (!$student) {
            return back()->withErrors('Student not found.');
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
        if (!Hash::check($request->currentPassword, $student->password)) {
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
        $student->password = $request->newPassword;
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
            session(['password_change_lockout_time' => Carbon::now()->addHours(0)]); // Lock for 24 hours
        }
    }
}
