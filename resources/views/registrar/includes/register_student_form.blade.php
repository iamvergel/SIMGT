@include('registrar.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('registrar.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('registrar.includes.topnav')
            </header>
            <div class="p-5">
                <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Registrar</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span
                            onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/admin/studentPrimaryInfo-management'"
                            class="hover:text-teal-700">Report Section / Online Application</span> / Old student
                    </p>
                </div>

                @if (session('success'))
                    <script>
                        alert("Student Enrolled Successfully");
                    </script>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-5"
                        role="alert" id="error-alert">
                        <div class="flex">
                            <div class="py-1">{{ session('success') }}<i
                                    class="fa-solid fa-circle-exclamation text-red-500"></i></div>
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <script>
                        setTimeout(function () {
                            document.getElementById("error-alert").remove();
                        }, 1000000);
                    </script>
                @endif

                <div class="bg-teal-800 p-5 shadow-lg mt-10 rounded-t-lg">
                    <h2 class="text-md font-semibold text-white">
                        <i class="fa-solid fa-users mr-2"></i>
                    </h2>
                </div>

                <div class=" mt-1 border-t-2 border-teal-800 bg-white">
                    <!-- Modal body -->
                    <form class="p-10 shadow-lg " onsubmit="return validateForm()" id="myform"
                        action="{{ route('includes.register_student_form.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-4 gap-4 mb-4 text-[13px] text-gray-900">
                            <div
                                class=" col-span-4 p-5 rounded-lg shadow-lg border bg-gradient-to-tr from-teal-50 via-gray-100 to-gray-100">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">
                                    <div
                                        class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                        <p class="text-[20px] font-bold"><i class="fas fa-user mr-2 mb-5"></i>
                                            Primary Information
                                        </p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="lrn" class="block mb-2 text-[12px] font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>LRN
                                            :</label>
                                        <input type="text" name="lrn" id="lrn" value="{{ $students->lrn }}"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Learner Reference Number (LRN)" required>
                                    </div>

                                    <div class="mb-5 hidden">
                                        <label for="studentNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>student No. :</label>
                                        <input type="text" name="student_number" id="studentsInfoNumber"  value="{{ $students->studentnumber }}"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="0000-0000" required>
                                    </div>
                                    <div class="mb-5">
                                        <label for="status" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Select Status :
                                        </label>
                                        <select id="status" name="status" required
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select Status</option>
                                            <option value="Registered" {{ $students->status == 'Registered' ? 'selected' : '' }}>Registered</option>
                                            <option value="Enrolled" {{ $students->status == 'Enrolled' ? 'selected' : '' }}>Enrolled</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="schoolYear" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>School Year :
                                        </label>
                                        <input type="text" name="school_year" id="schoolYear" 
                                            value="{{ $students->school_year }}"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                    </div>

                                    <div class="mb-5">
                                        <label for="grade" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Select Grade :
                                        </label>
                                        <select id="grade" name="grade" required
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select Grade</option>
                                            <option value="Grade One" {{ $students->grade == 'Grade One' ? 'selected' : '' }}>Grade One</option>
                                            <option value="Grade Two" {{ $students->grade == 'Grade Two' ? 'selected' : '' }}>Grade Two</option>
                                            <option value="Grade Three" {{ $students->grade == 'Grade Three' ? 'selected' : '' }}>Grade Three</option>
                                            <option value="Grade Four" {{ $students->grade == 'Grade Four' ? 'selected' : '' }}>Grade Four</option>
                                            <option value="Grade Five" {{ $students->grade == 'Grade Five' ? 'selected' : '' }}>Grade Five</option>
                                            <option value="Grade Six" {{ $students->grade == 'Grade Six' ? 'selected' : '' }}>Grade Six</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="section" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Section :</label>
                                        <select id="section" name="section"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select Section</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="adviser" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Select Adviser :</label>
                                        <select id="teacher" name="adviser"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select Teacher</option>
                                        </select>
                                    </div>


                                </div>

                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const gradeSelect = document.getElementById("grade");
                                    const sectionSelect = document.getElementById("section");
                                    const schoolYearInput = document.getElementById("schoolYear");
                                    const teacherSelect = document.getElementById("teacher");

                                    // Automatically set the school year and grade
                                    schoolYearInput.value = "{{ $students->school_year }}";  // Automatically populate school year
                                    gradeSelect.value = "{{ $students->grade }}";  // Automatically set the grade

                                    // Function to load sections based on the grade selected
                                    function loadSections(grade) {
                                        fetch(`/api/sections?grade=${grade}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                sectionSelect.innerHTML = '<option value="">Select Section</option>';
                                                data.forEach(section => {
                                                    const option = document.createElement("option");
                                                    option.value = section.section;
                                                    option.textContent = section.section;
                                                    sectionSelect.appendChild(option);
                                                });
                                            })
                                            .catch(error => {
                                                sectionSelect.innerHTML = '<option value="">Error loading sections</option>';
                                            });
                                    }

                                    // Function to load teachers based on grade, school year, and section
                                    function loadTeachers(grade, section, schoolYear) {
                                        fetch(`/api/allteachers?grade=${grade}&section=${section}&school_year=${schoolYear}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                teacherSelect.innerHTML = '<option value="">Select Teacher</option>';
                                                if (data.length) {
                                                    data.forEach(teacher => {
                                                        const option = document.createElement("option");
                                                        option.value = teacher.teacher_number;
                                                        option.textContent = teacher.name;
                                                        teacherSelect.appendChild(option);
                                                    });
                                                } else {
                                                    const option = document.createElement("option");
                                                    option.value = "";
                                                    option.textContent = "No Teachers Available";
                                                    teacherSelect.appendChild(option);
                                                }
                                            })
                                            .catch(error => {
                                                teacherSelect.innerHTML = '<option value="">Error loading teachers</option>';
                                            });
                                    }

                                    // When the grade, section, or school year is changed, update the adviser
                                    function updateAdviser() {
                                        const selectedGrade = gradeSelect.value;
                                        const selectedSection = sectionSelect.value;
                                        const selectedSchoolYear = schoolYearInput.value;

                                        // Ensure all fields are selected before loading teachers
                                        if (selectedGrade && selectedSection && selectedSchoolYear) {
                                            loadTeachers(selectedGrade, selectedSection, selectedSchoolYear);
                                        } else {
                                            teacherSelect.innerHTML = '<option value="">Select Teacher</option>'; // Reset if any field is missing
                                        }
                                    }

                                    // When the grade is selected, load sections
                                    gradeSelect.addEventListener("change", function () {
                                        const selectedGrade = gradeSelect.value;
                                        if (selectedGrade) {
                                            // Load sections based on selected grade
                                            loadSections(selectedGrade);
                                            updateAdviser(); // Update adviser when grade changes
                                        }
                                    });

                                    // When the section is selected, update the adviser
                                    sectionSelect.addEventListener("change", function () {
                                        updateAdviser(); // Update adviser when section changes
                                    });

                                    // Trigger the grade change event for initial load
                                    if (gradeSelect.value) {
                                        gradeSelect.dispatchEvent(new Event("change"));
                                    }

                                    // When the school year is selected, reset the adviser list
                                    schoolYearInput.addEventListener("change", function () {
                                        updateAdviser(); // Update adviser when school year changes
                                    });
                                });

                            </script>
                            

                            <div
                                class=" col-span-4 p-5 rounded-lg shadow-lg border bg-gradient-to-tr from-teal-50 via-gray-100 to-gray-100">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                    <!-- Personal Information -->
                                    <div
                                        class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                        <p class="text-[20px] font-bold"><i class="fas fa-user mr-2 mb-5"></i>
                                            Personal Information
                                        </p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="lastName" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Last Name :</label>
                                        <input type="text" name="lastName" id="lastName"
                                            value="{{ $studentsInfo->student_last_name }}"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Last Name" required >
                                    </div>

                                    <div class="mb-5">
                                        <label for="firstName" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>First Name :</label>
                                        <input type="text" name="firstName" id="firstName"
                                            value="{{ $studentsInfo->student_first_name }}"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter First Name" required >
                                    </div class="mb-5">

                                    <div class="mb-5">
                                        <label for="middleName"
                                            class="block mb-2 text-sm font-bold text-gray-900">Middle
                                            Name
                                            :</label>
                                        <input type="text" name="middleName" id="middleName"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Middle Name" 
                                            value="{{ $studentsInfo->student_middle_name }}">
                                    </div>

                                    <div class="mb-5">
                                        <label for="suffixName"
                                            class="block mb-2 text-sm font-bold text-gray-900">Suffix
                                            Name
                                            :</label>
                                        <select id="suffixName" name="suffixName" 
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select an option</option>
                                            <option value="Jr." {{ old('suffixName', $studentsInfo->student_suffix_name == 'Jr.' ? 'selected' : '')}}>Jr.</option>
                                            <option value="Sr." {{ old('suffixName', $studentsInfo->student_suffix_name == 'Sr.' ? 'selected' : '')}}>Sr.</option>
                                            <option value="II" {{ old('suffixName', $studentsInfo->student_suffix_name == 'II' ? 'selected' : '')}}>II</option>
                                            <option value="III" {{ old('suffixName', $studentsInfo->student_suffix_name == 'III' ? 'selected' : '')}}>III</option>
                                            <option value="IV" {{ old('suffixName', $studentsInfo->student_suffix_name == 'IV' ? 'selected' : '')}}>IV</option>
                                            <option value="V" {{ old('suffixName', $studentsInfo->student_suffix_name == 'V' ? 'selected' : '')}}>V</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="birthplace" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Birthplace :</label>
                                        <input type="text" name="birthplace" id="birthplace"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Birthplace" required
                                            value="{{ $studentsInfo->place_of_birth }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="birthDate" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Birth Date:
                                        </label>
                                        <input type="date" name="birthDate" id="birthDate" onchange="calculateAge()"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            required value="{{ $studentsInfo->birth_date }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="age" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Age:
                                        </label>
                                        <input type="number" name="age" id="age"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Age" min="0" required value="{{ $studentsInfo->age }}"
                                            >
                                    </div>

                                    <div class="mb-5">
                                        <label for="gender" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Gender : </label>
                                        <select name="gender" id="gender"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            required>
                                            <option value=""  selected>Select Gender</option>
                                            <option value="Male" {{ $studentsInfo->sex == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ $studentsInfo->sex == 'Female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Email: <small>(Parents or
                                                studentsInfo
                                                Email)</small>
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Ex. StEmilieLearningCenter@gmail.com" required
                                            pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                            title="Please enter a valid Gmail address."
                                            value="{{ $studentsInfo->email_address_send }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="contactNo" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Contact No. :
                                            <small>(Parents or
                                                studentsInfo)</small>
                                        </label>
                                        <input type="tel" name="contactNo" id="contactNo"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Contact Number" required
                                            value="{{ $studentsInfo->contact_number }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="religion" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Religion :
                                        </label>
                                        <input type="text" name="religion" id="religion"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Religion" required value="{{ $studentsInfo->religion }}"
                                            >
                                    </div>
                                </div>
                            </div>

                            <div
                                class=" col-span-4 p-5 rounded-lg shadow-lg border bg-gradient-to-tr from-teal-50 via-gray-100 to-gray-100">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                    <!-- Personal Information -->
                                    <div
                                        class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                        <p class="text-[20px] font-bold"><i
                                                class="fa-solid fa-map-location-dot mr-2 mb-5"></i>
                                            Permanent Address
                                        </p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="houseNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>House Number:
                                        </label>
                                        <input type="text" name="house_number" id="houseNumber"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter House No." required value="{{ $studentsInfo->house_number }}"
                                            >
                                    </div>

                                    <div class="mb-5">
                                        <label for="street" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Street:
                                        </label>
                                        <input type="text" name="street" id="street"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Street" required value="{{ $studentsInfo->street }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="barangay" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Barangay:
                                        </label>
                                        <input type="text" name="barangay" id="barangay"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Barangay" required value="{{ $studentsInfo->barangay }}"
                                            >
                                    </div>

                                    <div class="mb-5">
                                        <label for="city" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>City:
                                        </label>
                                        <input type="text" name="city" id="city"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter City" required value="{{ $studentsInfo->city }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="province" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Province:
                                        </label>
                                        <input type="text" name="province" id="province"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Province" required value="{{ $studentsInfo->province }}"
                                            >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 flex justify-end mt-20">
                            <button type="submit"
                                class="text-white w-96 text-center bg-sky-800 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded text-sm px-20 py-2.5 text-center">
                                Enrolled studentsInfo
                            </button>
                        </div>
                    </form>

                   
                </div>
            </div>


        </main>
    </div>
</body>
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

</html>