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
}
