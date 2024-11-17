<?php

namespace App\Http\Controllers;

use App\Models\Mevent; // Import your model
use App\Models\Mannouncement; // Import your model
use Illuminate\Http\Request;
use App\Models\StudentInfo;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocuments;
use App\Models\Mstudentaccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Madminaccount;
use App\Mail\MLsendemail;
use Illuminate\Routing\Controller as BaseController; // Correct import

class Cevent extends BaseController // Extend the correct base controller
{
    public function storeEvent(Request $request)
    {
        $request->validate([
            'activity_name' => 'required|string',
            'event_date' => 'required|date',
        ]);

        $event = Mevent::create([
            'activity_name' => $request->activity_name,
            'event_date' => $request->event_date,
        ]);

        return response()->json($event, 201);
    }

    // Update an existing event
    public function updateEvent(Request $request, $id)
    {
        $request->validate([
            'activity_name' => 'required|string',
            'event_date' => 'required|date',
        ]);

        $event = Mevent::findOrFail($id);
        $event->update([
            'activity_name' => $request->activity_name,
            'event_date' => $request->event_date,
        ]);

        return response()->json($event, 200);
    }

    // Show all events
    public function showEvents()
    {
        $events = Mevent::orderBy('created_at', 'desc')->get(); // Retrieve all events

        return response()->json($events, 200);
    }

    // Show all announcements
    public function showAnnouncements()
    {
        $announcements = Mannouncement::orderBy('created_at', 'desc')->get(); // Retrieve all announcements, ordered by created_at descending
        return response()->json($announcements, 200);
    }

    // Store a new announcement
    public function storeAnnouncement(Request $request)
    {
        $request->validate([
            'announcements_head' => 'required|string|max:255',
            'announcements_body' => 'required|string',
        ]);

        $announcement = Mannouncement::create([
            'announcements_head' => $request->announcements_head,
            'announcements_body' => $request->announcements_body,
        ]);

        return response()->json($announcement, 201);
    }

    // Update an existing announcement
    public function updateAnnouncement(Request $request, $id)
    {
        $request->validate([
            'announcements_head' => 'required|string|max:255',
            'announcements_body' => 'required|string',
        ]);

        $announcement = Mannouncement::findOrFail($id);
        $announcement->update([
            'announcements_head' => $request->announcements_head,
            'announcements_body' => $request->announcements_body,
        ]);

        return response()->json($announcement, 200);
    }


    public function showAllAdmin()
    {
        $studentCounts = StudentInfo::select(DB::raw('count(*) as count, grade'))->Where('status', 'Active')
            ->groupBy('grade')
            ->pluck('count', 'grade');

        $totalMaleStudent = StudentInfo::select(DB::raw('count(*) as count, sex'))->Where('status', 'Active')->where('sex', 'Male')
            ->groupBy('sex')
            ->pluck('count', 'sex');

        $totalFemaleStudent = StudentInfo::select(DB::raw('count(*) as count, sex'))->Where('status', 'Active')->where('sex', 'Female')
            ->groupBy('sex')
            ->pluck('count', 'sex');

        $totalStaff = Madminaccount::count(); // Adjust as needed
        $currentStaff = Madminaccount::count();
        ;

        return view('admin.admin_dashboard', compact('studentCounts', 'totalStaff', 'currentStaff', 'totalMaleStudent', 'totalFemaleStudent'));
    }

    public function showDashboardstudent()
    {
        // Retrieve the latest announcements
        $latestAnnouncements = Mannouncement::latest()->take(5)->get();

        // Return the view with the variable
        return view('student.student_dashboard', compact('latestAnnouncements'));
    }

    public function showCalendar()
    {
        return view('student.student_calendar'); // Ensure this view file exists
    }

    public function getEvents(Request $request)
    {
        // Check if a specific date is requested
        $date = $request->query('date');

        // If a specific date is given, return events for that date
        if ($date) {
            $events = Mevent::whereDate('event_date', $date)->get()->map(function ($event) {
                return [
                    'activity_name' => $event->activity_name,
                    'event_date' => $event->event_date,
                ];
            });

            return response()->json($events);
        }

        // If a date range is given, return events for that range
        $start = $request->query('start');
        $end = $request->query('end');

        $events = Mevent::whereBetween('event_date', [$start, $end])->get()->map(function ($event) {
            return [
                'title' => $event->activity_name,
                'start' => $event->event_date,
            ];
        });

        return response()->json($events);
    }
}
