<?php

namespace App\Http\Controllers;

use App\Models\Section;
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
        // Fetch sections based on the selected grade
        $sections = Section::where('grade', $request->grade)->get();

        // Return the sections as a JSON response
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
