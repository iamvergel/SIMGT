<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterStudentInfo;
use App\Models\RegisterAdditionalInfo;
use App\Models\RegisterDocuments;

class Registration extends Controller
{
    //
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'lrn' => 'required|unique:register_student_info,lrn',
            'school_year' => 'required',
            'grade' => 'required',
            'status' => 'required',
            'lastName' => 'required',
            'firstName' => 'required',
            'middleName' => 'nullable',
            'suffixName' => 'nullable',
            'birthplace' => 'required',
            'birthDate' => 'required|date',
            'age' => 'required|integer|min:0',
            'gender' => 'required',
            'email' => 'required|email',
            'contactNo' => 'required',
            'religion' => 'required',
            'house_number' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            'province' => 'required',
            'city' => 'required',
            // Additional validation for additional info
            'father_last_name' => 'required',
            'father_first_name' => 'required',
            'father_middle_name' => 'nullable',
            'father_suffix_name' => 'nullable',
            'father_occupation' => 'required',
            'mother_last_name' => 'required',
            'mother_first_name' => 'required',
            'mother_middle_name' => 'nullable',
            'mother_occupation' => 'required',
            'guardian_last_name' => 'required',
            'guardian_first_name' => 'required',
            'guardian_middle_name' => 'nullable',
            'guardian_suffix_name' => 'nullable',
            'guardian_relationship' => 'required',
            'guardian_contact_number' => 'required',
            'guardian_religion' => 'required',
            'emergency_contact_person' => 'required',
            'emergency_contact_number' => 'required',
            'email_address' => 'nullable|email',
            'messenger_account' => 'nullable',
            // File upload validations
            'birth_certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'proof_of_residency' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            // Create student record
            $student = new RegisterStudentInfo();
            $student->lrn = $validatedData['lrn'];
            $student->school_year = $validatedData['school_year'];
            $student->grade = $validatedData['grade'];
            $student->status = $validatedData['status'];
            $student->student_last_name = $validatedData['lastName'] ? ucwords(strtolower($validatedData['lastName'])) : null;
            $student->student_first_name = $validatedData['firstName'] ? ucwords(strtolower($validatedData['firstName'])) : null;
            $student->student_middle_name = $validatedData['middleName'] ? ucwords(strtolower($validatedData['middleName'])) : null;
            $student->student_suffix_name = $validatedData['suffixName'] ? ucwords(strtolower($validatedData['suffixName'])) : null;
            $student->place_of_birth = $validatedData['birthplace'] ? ucwords(strtolower($validatedData['birthplace'])) : null;
            $student->birth_date = $validatedData['birthDate'];
            $student->age = $validatedData['age'];
            $student->sex = $validatedData['gender'];
            $student->email_address_send = $validatedData['email'];
            $student->contact_number = $validatedData['contactNo'];
            $student->religion = $validatedData['religion'] ? ucwords(strtolower($validatedData['religion'])) : null;
            $student->house_number = $validatedData['house_number'] ? ucwords(strtolower($validatedData['house_number'])) : null;
            $student->street = $validatedData['street'] ? ucwords(strtolower($validatedData['street'])) : null;
            $student->barangay = $validatedData['barangay'] ? ucwords(strtolower($validatedData['barangay'])) : null;
            $student->province = $validatedData['province'] ? ucwords(strtolower($validatedData['province'])) : null;
            $student->city = $validatedData['city'] ? ucwords(strtolower($validatedData['city'])) : null;
            $student->save();

            // Create additional info record
            $additionalInfo = new RegisterAdditionalInfo();
            $additionalInfo->lrn = $validatedData['lrn']; // Link to student
            $additionalInfo->father_last_name = $validatedData['father_last_name'] ? ucwords(strtolower($validatedData['father_last_name'])) : null;
            $additionalInfo->father_first_name = $validatedData['father_first_name'] ? ucwords(strtolower($validatedData['father_first_name'])) : null;
            $additionalInfo->father_middle_name = $validatedData['father_middle_name'] ? ucwords(strtolower($validatedData['father_middle_name'])) : null;
            $additionalInfo->father_suffix_name = $validatedData['father_suffix_name'] ? ucwords(strtolower($validatedData['father_suffix_name'])) : null;
            $additionalInfo->father_occupation = $validatedData['father_occupation'] ? ucwords(strtolower($validatedData['father_occupation'])) : null;
            $additionalInfo->mother_last_name = $validatedData['mother_last_name'] ? ucwords(strtolower($validatedData['mother_last_name'])) : null;
            $additionalInfo->mother_first_name = $validatedData['mother_first_name'] ? ucwords(strtolower($validatedData['mother_first_name'])) : null;
            $additionalInfo->mother_middle_name = $validatedData['mother_middle_name'] ? ucwords(strtolower($validatedData['mother_middle_name'])) : null;
            $additionalInfo->mother_occupation = $validatedData['mother_occupation'] ? ucwords(strtolower($validatedData['mother_occupation'])) : null;
            $additionalInfo->guardian_last_name = $validatedData['guardian_last_name'] ? ucwords(strtolower($validatedData['guardian_last_name'])) : null;
            $additionalInfo->guardian_first_name = $validatedData['guardian_first_name'] ? ucwords(strtolower($validatedData['guardian_first_name'])) : null;
            $additionalInfo->guardian_middle_name = $validatedData['guardian_middle_name'] ? ucwords(strtolower($validatedData['guardian_middle_name'])) : null;
            $additionalInfo->guardian_suffix_name = $validatedData['guardian_suffix_name'] ? ucwords(strtolower($validatedData['guardian_suffix_name'])) : null;
            $additionalInfo->guardian_relationship = $validatedData['guardian_relationship'] ? ucwords(strtolower($validatedData['guardian_relationship'])) : null;
            $additionalInfo->guardian_contact_number = $validatedData['guardian_contact_number'];
            $additionalInfo->guardian_religion = $validatedData['guardian_religion'] ? ucwords(strtolower($validatedData['guardian_religion'])) : null;
            $additionalInfo->emergency_contact_person = $validatedData['emergency_contact_person'] ? ucwords(strtolower($validatedData['emergency_contact_person'])) : null;
            $additionalInfo->emergency_contact_number = $validatedData['emergency_contact_number'];
            $additionalInfo->email_address = $validatedData['email_address'];
            $additionalInfo->messenger_account = $validatedData['messenger_account'];
            $additionalInfo->save();

            // Handle file uploads
            $birthCertificatePath = $request->file('birth_certificate')->store('register', 'public');
            $proofOfResidencyPath = $request->file('proof_of_residency')->store('register', 'public');

            // Create student documents record
            $studentDocuments = new RegisterDocuments();
            $studentDocuments->lrn = $validatedData['lrn']; // Link to student
            $studentDocuments->birth_certificate = $birthCertificatePath;
            $studentDocuments->proof_of_residency = $proofOfResidencyPath;
            $studentDocuments->save();


            // Redirect or return response
            return back()->with('success', 'Registration Submitted successfully!');
        } catch (\Exception $e) {
            \Log::error('Error adding student: ' . $e->getMessage());

            return back()->withErrors('An error occurred while adding the student: ' . $e->getMessage());
        }
    }
}
