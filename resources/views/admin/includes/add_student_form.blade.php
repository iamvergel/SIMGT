<style>
    option {
        border: none;
    }

    .input-field {
        width: 100%;
        padding: 0.625rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }

    .select-field {
        width: 100%;
        padding: 0.625rem;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }

    form input[type="text"] {
        text-transform: capitalize;
    }
</style>

<!-- Main modal -->
<div id="addnewstudent" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll">
    <div class="relative px-20 py-10 w-screen h-screen">
        <div class="w-full h-full bg-white rounded-lg shadow overflow-y-scroll">
            <div
                class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg sticky top-0">
                <h3 class="text-lg font-bold text-teal-800 uppercase"><i class="fa-solid fa-users mr-2"></i>Add New
                    Student</h3>
                <button type="button"
                    class="text-teal-800 hover:bg-gray-100 hover:text-teal-700 p-3 py-2 rounded-full bg-white text-xl font-bold flex items-center justify-center shadow-lg"
                    data-modal-toggle="addnewstudent" aria-label="Close modal" id="addnewstudentClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-20 shadow-lg" onsubmit="return validateForm()" id="myform"
                action="{{ route('includes.add_student_form.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-4 gap-4 mb-4 text-[13px] text-gray-900">
                    <!-- Basic Information -->
                    <div class="mb-5">
                        <label for="studentNumber" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Student No. :</label>
                        <input type="text" name="student_number" id="studentNumber"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="0000-0000" required>
                    </div>
                    <div></div>
                    <div></div>
                    <div></div>

                    <div class="mb-5">
                        <label for="lrn" class="block mb-2 text-[12px] font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Learner Reference Number (LRN) :</label>
                        <input type="text" name="lrn" id="lrn"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Learner Reference Number (LRN)" required>
                    </div>

                    <div class="">
                        <label for="schoolYear" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>School Year :
                        </label>
                        <input type="text" name="school_year" id="schoolYear"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="0000-0000" required>
                    </div>

                    <div class="mb-5">
                        <label for="school" class="block mb-2 text-sm font-bold text-gray-900">School :</label>
                        <input type="text" name="school" id="school"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            value="St. Emelie Learning Center" readonly>
                    </div>
                    <div></div>

                    <div>
                        <label for="grade" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Select Grade :
                        </label>
                        <select id="grade" name="grade"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            required>
                            <option value="">Select Grade</option>
                            <option value="Grade One">Grade One</option>
                            <option value="Grade Two">Grade Two</option>
                            <option value="Grade Three">Grade Three</option>
                            <option value="Grade Four">Grade Four</option>
                            <option value="Grade Five">Grade Five</option>
                            <option value="Grade Six">Grade Six</option>
                        </select>
                    </div>

                    <div>
                        <label for="section" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Section :</label>
                        <select id="section" name="section"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            required>
                            <option value="">Select Section</option>
                        </select>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            const gradeSelect = document.getElementById("grade");
                            const sectionSelect = document.getElementById("section");

                            // Add event listener for grade change
                            gradeSelect.addEventListener("change", function () {
                                const selectedGrade = gradeSelect.value;

                                if (selectedGrade) {
                                    // Fetch sections based on the selected grade
                                    fetch(`/api/allsections?grade=${selectedGrade}`)
                                        .then(response => response.json())
                                        .then(data => {
                                            // Clear previous options
                                            sectionSelect.innerHTML = '<option value="">Select Section</option>';

                                            // Add new options
                                            if (data.length) {
                                                data.forEach(section => {
                                                    const option = document.createElement("option");
                                                    option.value = section.section;  // Make sure 'section' is the correct field in your model
                                                    option.textContent = section.section;
                                                    sectionSelect.appendChild(option);
                                                });
                                            } else {
                                                // Handle case where no sections are found
                                                const option = document.createElement("option");
                                                option.value = "";
                                                option.textContent = "No Sections Available";
                                                sectionSelect.appendChild(option);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error fetching sections:', error);
                                            // Handle error and display a message in the dropdown
                                            const option = document.createElement("option");
                                            option.value = "";
                                            option.textContent = "Error loading sections";
                                            sectionSelect.appendChild(option);
                                        });
                                } else {
                                    // If no grade selected, clear sections
                                    sectionSelect.innerHTML = '<option value="">Select Section</option>';
                                }
                            });
                        });
                    </script>

                    <!-- Personal Information -->
                    <div class="col-span-4 w-86 border-b border-b-gray-300 my-5">
                        <p class="text-[20px] font-bold"><i class="fas fa-user mr-2 mb-5"></i>
                            Personal Information
                        </p>
                    </div>

                    <div>
                        <label for="lastName" class="block mb-2 text-sm font-bold text-gray-900"><span
                                class="text-red-600 mr-1">*</span>Last Name :</label>
                        <input type="text" name="lastName" id="lastName"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Last Name" required>
                    </div>

                    <div>
                        <label for="firstName" class="block mb-2 text-sm font-bold text-gray-900"><span
                                class="text-red-600 mr-1">*</span>First Name :</label>
                        <input type="text" name="firstName" id="firstName"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter First Name" required>
                    </div>

                    <div>
                        <label for="middleName" class="block mb-2 text-sm font-bold text-gray-900">Middle Name :</label>
                        <input type="text" name="middleName" id="middleName"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Middle Name" value="">
                    </div>

                    <div>
                        <label for="suffixName" class="block mb-2 text-sm font-bold text-gray-900">Suffix Name :</label>
                        <select id="suffixName" name="suffixName"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            <option value="">Select an option</option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                    </div>

                    <div class="hidden">
                        <label for="password" class="block mb-2 text-sm font-bold text-gray-900"><span
                                class="text-red-600 mr-1">*</span>Password :</label>
                        <input type="text" name="password" id="password"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="password" required readonly>
                    </div>

                    <div>
                        <label for="birthplace" class="block mb-2 text-sm font-bold text-gray-900"><span
                                class="text-red-600 mr-1">*</span>Birthplace :</label>
                        <input type="text" name="birthplace" id="birthplace"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Birthplace" required>
                    </div>

                    <div>
                        <label for="birthDate" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Birth Date:
                        </label>
                        <input type="date" name="birthDate" id="birthDate" onchange="calculateAge()"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label for="age" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Age:
                        </label>
                        <input type="number" name="age" id="age"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Age" min="0" required readonly>
                    </div>

                    <div>
                        <label for="gender" class="block mb-2 text-sm font-bold text-gray-900"><span
                                class="text-red-600 mr-1">*</span>Sex : </label>
                        <select name="gender" id="gender"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div>
                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Email: <small>(Parents or Student Email)</small>
                        </label>
                        <input type="email" name="email" id="email"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Ex. StEmilieLearningCenter@gmail.com" required
                            pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$" title="Please enter a valid Gmail address.">
                    </div>

                    <div>
                        <label for="contactNo" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Contact No. : <small>(Parents or Student)</small>
                        </label>
                        <input type="tel" name="contactNo" id="contactNo"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Contact Number" required>
                    </div>

                    <div>
                        <label for="religion" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Religion :
                        </label>
                        <input type="text" name="religion" id="religion"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Religion" required>
                    </div>

                    <!-- Address Information -->
                    <div class="col-span-4 w-86 border-b border-b-gray-300 my-5">
                        <p class="text-[20px] font-bold"><i class="fas fa-address-card mr-2 mb-5"></i>
                            Permanent Address
                        </p>
                    </div>

                    <div>
                        <label for="houseNumber" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>House Number:
                        </label>
                        <input type="text" name="house_number" id="houseNumber"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter House No." required>
                    </div>

                    <div>
                        <label for="street" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Street:
                        </label>
                        <input type="text" name="street" id="street"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Street" required>
                    </div>

                    <div>
                        <label for="barangay" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Barangay:
                        </label>
                        <input type="text" name="barangay" id="barangay"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Barangay" required>
                    </div>

                    <div>
                        <label for="city" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>City:
                        </label>
                        <input type="text" name="city" id="city"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter City" required>
                    </div>

                    <div>
                        <label for="province" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Province:
                        </label>
                        <input type="text" name="province" id="province"
                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Province" required>
                    </div>

                    <!-- Parent Information -->
                    <div class="col-span-4 w-86 border-b border-b-gray-300 my-5">
                        <p class="text-[20px] font-bold"><i class="fas fa-address-card mr-2 mb-5"></i> Parents
                            Information </p>
                    </div>

                    <!-- Father's Information -->
                    <div class="col-span-4">
                        <p>Father Information :</p>
                    </div>

                    <div>
                        <label for="fatherLastName" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Father's Last Name:
                        </label>
                        <input type="text" name="father_last_name" id="fatherLastName"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Father's Last Name" required>
                    </div>

                    <div>
                        <label for="fatherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Father's First Name:
                        </label>
                        <input type="text" name="father_first_name" id="fatherFirstName"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Father's First Name" required>
                    </div>

                    <div>
                        <label for="fatherMiddleName" class="block mb-2 text-sm font-bold text-gray-900">
                            Father's Middle Name:
                        </label>
                        <input type="text" name="father_middle_name" id="fatherMiddleName"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Father's Middle Name">
                    </div>

                    <!-- Father's Suffix Selection -->
                    <div>
                        <label for="fatherSuffixName" class="block mb-2 text-sm font-bold text-gray-900">
                            Father's Suffix Name:
                        </label>
                        <select id="fatherSuffixName" name="father_suffix_name"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            <option value="">Select Suffix Name</option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                    </div>

                    <div>
                        <label for="fatherOccupation" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Father's Occupation:
                        </label>
                        <input type="text" name="father_occupation" id="fatherOccupation"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Father's Occupation" required>
                    </div>

                    <!-- Mother's Information -->
                    <div class="col-span-4">
                        <p class="mt-5">Mother Information:</p>
                    </div>

                    <div>
                        <label for="motherLastName" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Mother's Last Name:
                        </label>
                        <input type="text" name="mother_last_name" id="motherLastName"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Mother's Last Name" required>
                    </div>

                    <div>
                        <label for="motherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Mother's First Name:
                        </label>
                        <input type="text" name="mother_first_name" id="motherFirstName"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Mother's First Name" required>
                    </div>

                    <div>
                        <label for="motherMiddleName" class="block mb-2 text-sm font-bold text-gray-900">
                            Mother's Middle Name:
                        </label>
                        <input type="text" name="mother_middle_name" id="motherMiddleName"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Mother's Middle Name">
                    </div><br>

                    <div>
                        <label for="motherOccupation" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Mother's Occupation:
                        </label>
                        <input type="text" name="mother_occupation" id="motherOccupation"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Mother's Occupation" required>
                    </div>

                    <!-- Guardian's Information -->
                    <div class="col-span-4">
                        <p class="mt-5">Guardian Information:</p>
                    </div>

                    <div class="col-span-4">
                        <label class="block mb-2 text-sm font-bold text-gray-900">Guardian Type:</label>
                        <div class="flex items-center mb-4">
                            <input type="radio" id="guardianMother" name="guardianType" value="mother" class="mr-2"
                                onclick="setGuardianInfo('mother')">
                            <label for="guardianMother" class="mr-4 text-sm font-medium text-gray-900">Mother</label>

                            <input type="radio" id="guardianFather" name="guardianType" value="father" class="mr-2"
                                onclick="setGuardianInfo('father')">
                            <label for="guardianFather" class="text-sm font-medium text-gray-900">Father</label>
                        </div>
                    </div>

                    <div>
                        <label for="guardianLastName" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Guardian's Last Name:
                        </label>
                        <input type="text" name="guardian_last_name" id="guardianLastName"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Guardian's Last Name" required>
                    </div>

                    <div>
                        <label for="guardianFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Guardian's First Name:
                        </label>
                        <input type="text" name="guardian_first_name" id="guardianFirstName"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Guardian's First Name" required>
                    </div>

                    <div>
                        <label for="guardianMiddleName" class="block mb-2 text-sm font-bold text-gray-900">
                            Guardian's Middle Name:
                        </label>
                        <input type="text" name="guardian_middle_name" id="guardianMiddleName"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Guardian's Middle Name">
                    </div>

                    <div>
                        <label for="guardianSuffixName" class="block mb-2 text-sm font-bold text-gray-900">
                            Suffix Name:
                        </label>
                        <select id="guardianSuffixName" name="guardian_suffix_name"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                            <option value="">Select Suffix Name</option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                    </div>

                    <div>
                        <label for="guardianRelationship" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Guardian's Relationship to Student:
                        </label>
                        <input type="text" name="guardian_relationship" id="guardianRelationship"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Guardian's Relationship" required>
                    </div>

                    <div>
                        <label for="guardianContactNumber" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Guardian's Contact Number:
                        </label>
                        <input type="text" name="guardian_contact_number" id="guardianContactNumber"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Guardian's Contact Number" required>
                    </div>

                    <div>
                        <label for="guardian_religion" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Religion:
                        </label>
                        <input type="text" name="guardian_religion" id="guardian_religion"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Guardian's Religion" required>
                    </div>

                    <!-- Emergency Information -->
                    <div class="col-span-4">
                        <p class="mt-5">Emergency Information:</p>
                    </div>

                    <div>
                        <label for="emergencyContactPerson" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Emergency Contact Person:
                        </label>
                        <input type="text" name="emergency_contact_person" id="emergencyContactPerson"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Emergency Contact Person" required>
                    </div>

                    <div>
                        <label for="emergencyContactNumber" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Emergency Contact Number:
                        </label>
                        <input type="text" name="emergency_contact_number" id="emergencyContactNumber"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Emergency Contact Number" required>
                    </div>

                    <div>
                        <label for="emailAddress" class="block mb-2 text-sm font-bold text-gray-900">
                            <span class="text-red-600 mr-1">*</span>Email Address:
                        </label>
                        <input type="email" name="email_address" id="emailAddress"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="Enter Email Address" required>
                    </div>

                    <div>
                        <label for="messengerAccount" class="block mb-2 text-sm font-bold text-gray-900">
                            Messenger Account (optional):
                        </label>
                        <input type="text" name="messenger_account" id="messengerAccount"
                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                            placeholder="e.g., Facebook Messenger ID">
                    </div>

                    <div class="col-span-4">
                        <p class="mt-5">Document Uploads :</p>
                    </div>
                    <div class="mb-6">
                        <label for="birth_certificate" class="block font-semibold text-gray-700 mb-2">Birth
                            Certificate:</label>
                        <label
                            class="inline-block bg-sky-800 text-white px-4 py-2 rounded cursor-pointer hover:bg-sky-700">
                            Choose file
                            <input type="file" id="birth_certificate" name="birth_certificate"
                                accept=".pdf,.jpg,.jpeg,.png" required class="hidden">
                        </label>
                        <div class="mt-2 text-gray-600" id="birthFileName">No file chosen</div>
                    </div>

                    <div class="mb-6">
                        <label for="proof_of_residency" class="block font-semibold text-gray-700 mb-2">Form 137:</label>
                        <label
                            class="inline-block bg-sky-800 text-white px-4 py-2 rounded cursor-pointer hover:bg-sky-700">
                            Choose file
                            <input type="file" id="proof_of_residency" name="proof_of_residency"
                                accept=".pdf,.jpg,.jpeg,.png" required class="hidden">
                        </label>
                        <div class="mt-2 text-gray-600" id="residencyFileName">No file chosen</div>
                    </div>
                </div>
                <div class="col-span-4 flex justify-end mt-20">
                    <button type="submit"
                        class="text-white w-96 text-center bg-sky-800 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded text-sm px-20 py-2.5 text-center">
                        Add Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the current URL
        const currentUrl = window.location.pathname;

        // Check if the URL contains 'GradeOne', 'GradeTwo', etc.
        const gradeMatch = currentUrl.match(/\/admin\/student-management\/(GradeOne|GradeTwo|GradeThree|GradeFour|GradeFive|GradeSix)/);

        // If a match is found, set the selected option
        if (gradeMatch) {
            const grade = gradeMatch[1].replace(/([A-Z])/g, ' $1').trim(); // Convert 'GradeOne' to 'Grade One'
            const selectElement = document.getElementById("grade");

            // Set the selected option
            selectElement.value = grade; // Sets the value to the corresponding grade
        }

        const lastNameInput = document.getElementById('lastName');
        const studentNumberInput = document.getElementById('studentNumber');
        const passwordInput = document.getElementById('password');

        function updatePassword() {
            const lastName = lastNameInput.value;
            const capitalizedLastName = lastName.charAt(0).toUpperCase() + lastName.slice(1).toLowerCase(); // Capitalize first letter
            const studentNumber = studentNumberInput.value;
            const lastFourDigits = studentNumber.slice(-4);

            const newPassword = `SELC${capitalizedLastName}${lastFourDigits}`;
            passwordInput.value = newPassword;
        }

        lastNameInput.addEventListener('input', updatePassword);
        studentNumberInput.addEventListener('input', updatePassword);
    });

    function calculateAge() {
        const birthDateInput = document.getElementById('birthDate');
        const ageInput = document.getElementById('age');
        const birthDate = new Date(birthDateInput.value);
        const today = new Date();

        if (birthDate) {
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            ageInput.value = age;
        } else {
            ageInput.value = '';
        }
    }

    function setGuardianInfo(type) {
        const motherFirstName = document.getElementById('motherFirstName').value;
        const motherLastName = document.getElementById('motherLastName').value;
        const motherMiddleName = document.getElementById('motherMiddleName').value; // Get mother's middle name

        const fatherFirstName = document.getElementById('fatherFirstName').value;
        const fatherLastName = document.getElementById('fatherLastName').value;
        const fatherMiddleName = document.getElementById('fatherMiddleName').value; // Get father's middle name
        const fatherSuffix = document.getElementById('fatherSuffixName').value;

        if (type === 'mother') {
            document.getElementById('guardianFirstName').value = motherFirstName;
            document.getElementById('guardianLastName').value = motherLastName;
            document.getElementById('guardianMiddleName').value = motherMiddleName; // Set middle name
            document.getElementById('guardianSuffixName').value = ""; // Reset suffix when choosing mother
        } else if (type === 'father') {
            document.getElementById('guardianFirstName').value = fatherFirstName;
            document.getElementById('guardianLastName').value = fatherLastName;
            document.getElementById('guardianMiddleName').value = fatherMiddleName; // Set middle name;
            document.getElementById('guardianSuffixName').value = fatherSuffix; // Set suffix when choosing father
        }
    }
</script>