<?php

namespace App\Http\Controllers;

use App\Models\PictureAnnouncement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PictureAnnouncementController extends Controller
{
    // Show all announcements
    public function showAnnouncements()
    {
        $announcements = PictureAnnouncement::orderBy('created_at', 'desc')->get();
        return view('admin.admin_announcement', compact('announcements'));
    }

    public function showAnnouncementsAdmission()
    {
        $announcements = PictureAnnouncement::orderBy('created_at', 'desc')->get();
        return view('admission.admission_announcement', compact('announcements'));
    }

    // In your PictureAnnouncementController
    public function getAnnouncements()
    {
        // Fetch announcements ordered by created_at
        $announcements = PictureAnnouncement::orderBy('created_at', 'desc')->get();

        // Return announcements as JSON
        return response()->json($announcements);
    }

    // Store a new announcement
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store image
        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('announcements', $fileName, 'public');

        // Store the announcement
        PictureAnnouncement::create([
            'date' => $request->date,
            'image' => $fileName,
        ]);

        // Redirect back to the announcement page
        return redirect()->route('announcements.show')->with('success', 'Announcement added successfully!');
    }

    public function storeAdmission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store image
        $fileName = time() . '.' . $request->image->extension();
        $request->image->storeAs('announcements', $fileName, 'public');

        // Store the announcement
        PictureAnnouncement::create([
            'date' => $request->date,
            'image' => $fileName,
        ]);

        // Redirect back to the announcement page
        return redirect()->route('admission.announcements.show')->with('success', 'Announcement added successfully!');
    }

    // Delete an announcement
    public function deleteAnnouncement($id)
    {
        $announcement = PictureAnnouncement::findOrFail($id);
        Storage::disk('public')->delete('announcements/' . $announcement->image);
        $announcement->delete();

        // Redirect back to the announcement page
        return redirect()->route('announcements.show')->with('success', 'Announcement Delete successfully!');
    }

    public function deleteAnnouncementAdmission($id)
    {
        $announcement = PictureAnnouncement::findOrFail($id);
        Storage::disk('public')->delete('announcements/' . $announcement->image);
        $announcement->delete();

        // Redirect back to the announcement page
        return redirect()->route('admission.announcements.show')->with('success', 'Announcement Delete successfully!');
    }

    // Update an existing announcement
    public function updateAnnouncement(Request $request, $id)
    {
        // Find the announcement by ID
        $announcement = PictureAnnouncement::findOrFail($id);

        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional during update
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Update date if it is provided
        if ($request->has('date')) {
            $announcement->date = $request->date;
        }

        // If new image is uploaded, handle image replacement
        if ($request->hasFile('image')) {
            // Delete the old image from storage
            Storage::disk('public')->delete('announcements/' . $announcement->image);

            // Store the new image
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('announcements', $fileName, 'public');

            // Update image field in database
            $announcement->image = $fileName;
        }

        // Save the updated announcement
        $announcement->save();

        // Return the updated announcement
        // Redirect back to the announcement page
        return redirect()->route('announcements.show')->with('success', 'Announcement Edited successfully!');
    }

    public function updateAnnouncementAdmission(Request $request, $id)
    {
        // Find the announcement by ID
        $announcement = PictureAnnouncement::findOrFail($id);

        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional during update
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Update date if it is provided
        if ($request->has('date')) {
            $announcement->date = $request->date;
        }

        // If new image is uploaded, handle image replacement
        if ($request->hasFile('image')) {
            // Delete the old image from storage
            Storage::disk('public')->delete('announcements/' . $announcement->image);

            // Store the new image
            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('announcements', $fileName, 'public');

            // Update image field in database
            $announcement->image = $fileName;
        }

        // Save the updated announcement
        $announcement->save();

        // Return the updated announcement
        // Redirect back to the announcement page
        return redirect()->route('admission.announcements.show')->with('success', 'Announcement Edited successfully!');
    }

    public function update(Request $request, $id)
    {
        $announcement = PictureAnnouncement::findOrFail($id); // Find the announcement by its ID

        // Validation for date and image
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional for update
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update the date
        $announcement->date = $request->date;

        // If a new image is provided, store it and update the path
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if (file_exists(storage_path('app/public/announcements/' . $announcement->image))) {
                unlink(storage_path('app/public/announcements/' . $announcement->image));
            }

            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('announcements', $fileName, 'public');
            $announcement->image = $fileName;
        }

        // Save the updated announcement
        $announcement->save();

        return redirect()->route('announcements.show')->with('success', 'Announcement updated successfully!');
    }

    public function updateAdmission(Request $request, $id)
    {
        $announcement = PictureAnnouncement::findOrFail($id); // Find the announcement by its ID

        // Validation for date and image
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional for update
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update the date
        $announcement->date = $request->date;

        // If a new image is provided, store it and update the path
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if (file_exists(storage_path('app/public/announcements/' . $announcement->image))) {
                unlink(storage_path('app/public/announcements/' . $announcement->image));
            }

            $fileName = time() . '.' . $request->image->extension();
            $request->image->storeAs('announcements', $fileName, 'public');
            $announcement->image = $fileName;
        }

        // Save the updated announcement
        $announcement->save();

        return redirect()->route('admission.announcements.show')->with('success', 'Announcement updated successfully!');
    }
}
