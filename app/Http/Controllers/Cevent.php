<?php

namespace App\Http\Controllers;

use App\Models\Mevent; // Import your model
use App\Models\Mannouncement; // Import your model
use Illuminate\Http\Request;
use App\Models\StudentInfo;
use App\Models\StudentAdditionalInfo;
use App\Models\StudentDocuments;
use App\Models\Mstudentaccount;
use App\Models\StudentPrimaryInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Madminaccount;
use App\Models\PictureAnnouncement;
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

    public function deleteEvent($id)
    {
        try {
            $event = Mevent::findOrFail($id);
            $event->delete();

            return response()->json(['message' => 'Event deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete event', 'error' => $e->getMessage()], 500);
        }
    }

    // Show all events
    public function showEvents()
    {
        $events = Mevent::orderBy('created_at', 'desc')->get(); // Retrieve all events

        return response()->json($events, 200);
    }

    // Show all events
    public function showEventslanding()
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

    public function deleteAnnouncement($id)
    {
        try {
            $event = Mannouncement::findOrFail($id);
            $event->delete();

            return response()->json(['message' => 'Announcement deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete event', 'error' => $e->getMessage()], 500);
        }
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
        // Count the number of active students for each grade (Grade One to Grade Six)
        $studentCounts = StudentPrimaryInfo::select(DB::raw('count(*) as count, grade'))
            ->where('status', 'Enrolled')
            ->whereIn('grade', ['Grade One', 'Grade Two', 'Grade Three', 'Grade Four', 'Grade Five', 'Grade Six']) // Filter by Grade One to Grade Six
            ->groupBy('grade')
            ->pluck('count', 'grade');

        // Count the number of active students for each grade (Grade One to Grade Six)
        $studentDroppedCounts = StudentInfo::select(DB::raw('count(*) as count, id'))
            ->where('status', 'Dropped')->groupBy('id')
            ->pluck('count', 'id');

        // Count the number of active students for each grade (Grade One to Grade Six)
        $studentGraduatedCounts = StudentInfo::select(DB::raw('count(*) as count, id'))
            ->where('status', 'Graduated')->groupBy('id')
            ->pluck('count', 'id');

        // Count the number of active male students
        $totalMaleStudent = StudentInfo::select(DB::raw('count(*) as count, sex'))
            ->where('status', 'Active')
            ->where('sex', 'Male')
            ->groupBy('sex')
            ->pluck('count', 'sex');

        // Count the number of active female students
        $totalFemaleStudent = StudentInfo::select(DB::raw('count(*) as count, sex'))
            ->where('status', 'Active')
            ->where('sex', 'Female')
            ->groupBy('sex')
            ->pluck('count', 'sex');

        // Count the total number of staff
        $totalStaff = Madminaccount::count();

        // Count the number of current staff (You may want to modify this query depending on your definition of "current staff")
        $currentStaff = Madminaccount::count();

        // Return the view with all the necessary data
        return view('admin.admin_dashboard', compact('studentCounts', 'studentGraduatedCounts', 'studentDroppedCounts', 'totalStaff', 'currentStaff', 'totalMaleStudent', 'totalFemaleStudent'));
    }

    public function showAllAdmission()
    {
        // Count the number of active students for each grade (Grade One to Grade Six)
        $studentCounts = StudentPrimaryInfo::select(DB::raw('count(*) as count, grade'))
            ->where('status', 'Enrolled')
            ->whereIn('grade', ['Grade One', 'Grade Two', 'Grade Three', 'Grade Four', 'Grade Five', 'Grade Six']) // Filter by Grade One to Grade Six
            ->groupBy('grade')
            ->pluck('count', 'grade');

        // Count the number of active students for each grade (Grade One to Grade Six)
        $studentDroppedCounts = StudentInfo::select(DB::raw('count(*) as count, id'))
            ->where('status', 'Dropped')->groupBy('id')
            ->pluck('count', 'id');

        // Count the number of active students for each grade (Grade One to Grade Six)
        $studentGraduatedCounts = StudentInfo::select(DB::raw('count(*) as count, id'))
            ->where('status', 'Graduated')->groupBy('id')
            ->pluck('count', 'id');

        // Count the number of active male students
        $totalMaleStudent = StudentInfo::select(DB::raw('count(*) as count, sex'))
            ->where('status', 'Active')
            ->where('sex', 'Male')
            ->groupBy('sex')
            ->pluck('count', 'sex');

        // Count the number of active female students
        $totalFemaleStudent = StudentInfo::select(DB::raw('count(*) as count, sex'))
            ->where('status', 'Active')
            ->where('sex', 'Female')
            ->groupBy('sex')
            ->pluck('count', 'sex');

        // Count the total number of staff
        $totalStaff = Madminaccount::count();

        // Count the number of current staff (You may want to modify this query depending on your definition of "current staff")
        $currentStaff = Madminaccount::count();

        // Return the view with all the necessary data
        return view('admission.admission_dashboard', compact('studentCounts', 'studentGraduatedCounts', 'studentDroppedCounts', 'totalStaff', 'currentStaff', 'totalMaleStudent', 'totalFemaleStudent'));
    }

    public function showAllRegistrar()
    {
        // Count the number of active students for each grade (Grade One to Grade Six)
        $studentCounts = StudentPrimaryInfo::select(DB::raw('count(*) as count, grade'))
            ->where('status', 'Enrolled')
            ->whereIn('grade', ['Grade One', 'Grade Two', 'Grade Three', 'Grade Four', 'Grade Five', 'Grade Six']) // Filter by Grade One to Grade Six
            ->groupBy('grade')
            ->pluck('count', 'grade');

        // Count the number of active students for each grade (Grade One to Grade Six)
        $studentDroppedCounts = StudentInfo::select(DB::raw('count(*) as count, id'))
            ->where('status', 'Dropped')->groupBy('id')
            ->pluck('count', 'id');

        // Count the number of active students for each grade (Grade One to Grade Six)
        $studentGraduatedCounts = StudentInfo::select(DB::raw('count(*) as count, id'))
            ->where('status', 'Graduated')->groupBy('id')
            ->pluck('count', 'id');

        // Count the number of active male students
        $totalMaleStudent = StudentInfo::select(DB::raw('count(*) as count, sex'))
            ->where('status', 'Active')
            ->where('sex', 'Male')
            ->groupBy('sex')
            ->pluck('count', 'sex');

        // Count the number of active female students
        $totalFemaleStudent = StudentInfo::select(DB::raw('count(*) as count, sex'))
            ->where('status', 'Active')
            ->where('sex', 'Female')
            ->groupBy('sex')
            ->pluck('count', 'sex');

        // Count the total number of staff
        $totalStaff = Madminaccount::count();

        // Count the number of current staff (You may want to modify this query depending on your definition of "current staff")
        $currentStaff = Madminaccount::count();

        // Return the view with all the necessary data
        return view('registrar.registrar_dashboard', compact('studentCounts', 'studentGraduatedCounts', 'studentDroppedCounts', 'totalStaff', 'currentStaff', 'totalMaleStudent', 'totalFemaleStudent'));
    }

    public function showDashboardstudent()
    {
        // Retrieve the latest announcements (Ensure 'Mannouncement' is your model)
        $latestAnnouncements = Mannouncement::latest()->take(5)->get();
        

        // Check if there are any announcements
        $newAnnouncements = $latestAnnouncements->count() > 0;

        $pictureAnnouncements = PictureAnnouncement::orderBy('created_at', 'desc')->get();

        // Return the view with announcements data
        return view('student.student_dashboard', compact('latestAnnouncements', 'newAnnouncements', 'pictureAnnouncements'));
    }

    public function showDashboardteacher()
    {
        // Retrieve the latest announcements (Ensure 'Mannouncement' is your model)
        $latestAnnouncements = Mannouncement::latest()->take(5)->get();
        

        // Check if there are any announcements
        $newAnnouncements = $latestAnnouncements->count() > 0;

        $pictureAnnouncements = PictureAnnouncement::orderBy('created_at', 'desc')->get();

        // Return the view with announcements data
        return view('teacher.teacher_dashboard', compact('latestAnnouncements', 'newAnnouncements', 'pictureAnnouncements'));
    }

    public function showCalendar()
    {
        return view('student.student_calendar'); // Ensure this view file exists
    }

    public function showteacherCalendar()
    {
        return view('teacher.teacher_calendar'); // Ensure this view file exists
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
                'id' => $event->id,  // Add event ID
                'title' => $event->activity_name,
                'start' => $event->event_date,
            ];
        });

        return response()->json($events);
    }
}
