<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\GradeOneClassRecord;
use App\Models\GradeTwoClassRecord;
use App\Models\GradeThreeClassRecord;
use App\Models\GradeFourClassRecord;
use App\Models\GradeFiveClassRecord;
use App\Models\GradeSixClassRecord;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    // Display all Sections
    public function index()
    {
        $sections = Section::all(); // Fetch all Sections
        return view('admin.admin_section', compact('sections')); // Pass Sections to the view
    }

    // Show the form to create a new Section
    public function create()
    {
        return view('admin.admin_section'); // Display the create form
    }

    // Method to fetch sections by grade
    public function getAllSectionsByGrade(Request $request)
    {
        $grade = $request->grade;
        \Log::info('Requested grade:', ['grade' => $grade]);

        // Fetch sections based on the selected grade dynamically
        switch ($grade) {
            case 'Grade One':
                $sections = GradeOneClassRecord::distinct()->pluck('section');
                break;
            case 'Grade Two':
                $sections = GradeTwoClassRecord::distinct()->pluck('section');
                break;
            case 'Grade Three':
                $sections = GradeThreeClassRecord::distinct()->pluck('section');
                break;
            case 'Grade Four':
                $sections = GradeFourClassRecord::distinct()->pluck('section');
                break;
            case 'Grade Five':
                $sections = GradeFiveClassRecord::distinct()->pluck('section');
                break;
            case 'Grade Six':
                $sections = GradeSixClassRecord::distinct()->pluck('section');
                break;
            default:
                return response()->json(['message' => 'Invalid grade.'], 400);
        }

        \Log::info('Sections found:', ['sections' => $sections]);

        // Check if sections are found
        if ($sections->isEmpty()) {
            return response()->json(['message' => 'No sections found for the selected grade.'], 404);
        }

        return response()->json($sections);
    }

    // Store a new Section
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'grade' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        // Create a new section
        Section::create($request->all());

        // Redirect back with a success message
        session()->flash('success', 'Section created successfully!');
        return redirect()->route('admin.section');
    }

    // Show the form to edit an existing Section
    public function edit($id)
    {
        $section = Section::findOrFail($id); // Find Section by ID
        return view('admin.admin_section', compact('section')); // Return edit form with Section data
    }

    // Update the existing Section
    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id); // Find Section by ID

        // Validate the input
        $request->validate([
            'grade' => 'required|string|max:255',
            'section' => 'required|string|max:255',
        ]);

        // Update the Section data
        $section->update($request->all());

        // Flash a success message
        session()->flash('success', 'Section updated successfully!');

        // Redirect back to the Sections list
        return redirect()->route('admin.section');
    }

    // Delete a Section
    public function destroy($id)
    {
        $Section = Section::findOrFail($id); // Find the Section by ID
        $Section->delete(); // Delete the Section

        // Flash a success message
        session()->flash('success', 'Section deleted successfully!');

        // Redirect back to the Sections list
        return redirect()->route('admin.section');
    }
}
