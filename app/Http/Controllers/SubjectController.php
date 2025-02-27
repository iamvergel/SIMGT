<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Display all subjects
    public function index()
    {
        $subjects = Subject::all(); // Fetch all subjects
        return view('admin.admin_subject', compact('subjects')); // Pass subjects to the view
    }

     // Method to fetch sections by grade
     public function getAllSubjectsByGrade(Request $request)
     {
         // Fetch sections based on the selected grade
         $sections = Subject::where('grade', $request->grade)->get();
 
         // Return the sections as a JSON response
         return response()->json($sections);
     }

    // Show the form to create a new subject
    public function create()
    {
        return view('admin.admin_subject'); // Display the create form
    }

    // Store a new subject
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'grade' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
        ]);

        // Create a new subject
        Subject::create($request->all());

        // Flash a success message
        session()->flash('success', 'Subject created successfully!');

        // Redirect back to the subjects list
        return redirect()->route('admin.subject');
    }

    // Show the form to edit an existing subject
    public function edit($id)
    {
        $subject = Subject::findOrFail($id); // Find subject by ID
        return view('admin.admin_subject', compact('subject')); // Return edit form with subject data
    }

    // Update the existing subject
    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id); // Find subject by ID

        // Validate the input
        $request->validate([
            'grade' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
        ]);

        // Update the subject data
        $subject->update($request->all());

        // Flash a success message
        session()->flash('success', 'Subject updated successfully!');

        // Redirect back to the subjects list
        return redirect()->route('admin.subject');
    }

    // Delete a subject
    public function destroy($id)
    {
        $subject = Subject::findOrFail($id); // Find the subject by ID
        $subject->delete(); // Delete the subject

        // Flash a success message
        session()->flash('success', 'Subject deleted successfully!');

        // Redirect back to the subjects list
        return redirect()->route('admin.subject');
    }
}
