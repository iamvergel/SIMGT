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
                            onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/admin/students-management'"
                            class="hover:text-teal-700">Report Section / Online Application</span> / New student
                    </p>
                </div>


@if (session('success'))
                    <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-5"
                        role="alert" id="success-alert">
                        <div class="flex">
                            <div class="py-1">{{ session('success') }}<i class="fa-solid fa-check text-green-500"></i></div>
                        </div>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById("success-alert").remove();
                            window.location.href = '/registrar/online-application';
                        }, 1000);
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
                        setTimeout(function() {
                            document.getElementById("error-alert").remove();
                        }, 3000);
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
                        action="{{ route('includes.add_student_form.store') }}" method="POST"
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
                                        <input type="text" name="lrn" id="lrn"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Learner Reference Number (LRN)" required value="{{ $students->lrn }}" onchange="document.getElementById('studentsNumber').value = this.value">
                                    </div>

                                    <div class="mb-5 hidden">
                                        <label for="studentNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Student No. :</label>
                                        <input type="text" name="student_number" id="studentsNumber"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="0000-0000"  required>
                                    </div>

                                    <script>
                                        document.getElementById("studentsNumber").value = document.getElementById("lrn").value;
                                    </script>

                                    <div class="mb-5 hidden">
                                        <label for="status" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>students No. :</label>
                                        <input type="text" name="status" id="status" value="Enrolled"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="0000-0000" required>
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
                                    </div><div></div>

                                    <div class="col-span-1 md:col-span-2 lg:cl-span-3 xl:col-span-4 text-lg text-teal-800 font-semibold my-3">( Add Section And Adviser )</div>
                                    <div class="mb-5">
                                        <label for="section" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Section :</label>
                                        <select id="section" name="section" required
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select Section</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="adviser" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Select Adviser :</label>
                                        <select id="teacher" name="adviser" required
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
                                            value="{{ $students->student_last_name }}"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Last Name" required >
                                    </div>

                                    <div class="mb-5">
                                        <label for="firstName" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>First Name :</label>
                                        <input type="text" name="firstName" id="firstName"
                                            value="{{ $students->student_first_name }}"
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
                                            value="{{ $students->student_middle_name }}">
                                    </div>

                                    <div class="mb-5">
                                        <label for="suffixName"
                                            class="block mb-2 text-sm font-bold text-gray-900">Suffix
                                            Name
                                            :</label>
                                        <select id="suffixName" name="suffixName" 
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select an option</option>
                                            <option value="Jr." {{ old('suffixName', $students->student_suffix_name == 'Jr.' ? 'selected' : '')}}>Jr.</option>
                                            <option value="Sr." {{ old('suffixName', $students->student_suffix_name == 'Sr.' ? 'selected' : '')}}>Sr.</option>
                                            <option value="II" {{ old('suffixName', $students->student_suffix_name == 'II' ? 'selected' : '')}}>II</option>
                                            <option value="III" {{ old('suffixName', $students->student_suffix_name == 'III' ? 'selected' : '')}}>III</option>
                                            <option value="IV" {{ old('suffixName', $students->student_suffix_name == 'IV' ? 'selected' : '')}}>IV</option>
                                            <option value="V" {{ old('suffixName', $students->student_suffix_name == 'V' ? 'selected' : '')}}>V</option>
                                        </select>
                                    </div>

                                    <div class="hidden">
                                        <label for="username" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Username :</label>
                                        <input type="text" name="username" id="username"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none "
                                            placeholder="username" required >
                                    </div>

                                    <div class="hidden">
                                        <label for="password" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Password :</label>
                                        <input type="text" name="password" id="password"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="password" required >
                                    </div>

                                    <div class="mb-5">
                                        <label for="birthplace" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Birthplace :</label>
                                        <input type="text" name="birthplace" id="birthplace"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Birthplace" required
                                            value="{{ $students->place_of_birth }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="birthDate" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Birth Date:
                                        </label>
                                        <input type="date" name="birthDate" id="birthDate" onchange="calculateAge()"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            required value="{{ $students->birth_date }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="age" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Age:
                                        </label>
                                        <input type="number" name="age" id="age"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Age" min="0" required value="{{ $students->age }}"
                                            >
                                    </div>

                                    <div class="mb-5">
                                        <label for="gender" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Gender : </label>
                                        <select name="gender" id="gender"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            required>
                                            <option value=""  selected>Select Gender</option>
                                            <option value="Male" {{ $students->sex == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ $students->sex == 'Female' ? 'selected' : '' }}>
                                                Female</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Email: <small>(Parents or
                                                students
                                                Email)</small>
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Ex. StEmilieLearningCenter@gmail.com" required
                                            pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                            title="Please enter a valid Gmail address."
                                            value="{{ $students->email_address_send }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="contactNo" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Contact No. :
                                            <small>(Parents or
                                                students)</small>
                                        </label>
                                        <input type="tel" name="contactNo" id="contactNo"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Contact Number" required
                                            value="{{ $students->contact_number }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="religion" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Religion :
                                        </label>
                                        <input type="text" name="religion" id="religion"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Religion" required value="{{ $students->religion }}"
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
                                            placeholder="Enter House No." required value="{{ $students->house_number }}"
                                            >
                                    </div>

                                    <div class="mb-5">
                                        <label for="street" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Street:
                                        </label>
                                        <input type="text" name="street" id="street"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Street" required value="{{ $students->street }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="barangay" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Barangay:
                                        </label>
                                        <input type="text" name="barangay" id="barangay"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Barangay" required value="{{ $students->barangay }}"
                                            >
                                    </div>

                                    <div class="mb-5">
                                        <label for="city" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>City:
                                        </label>
                                        <input type="text" name="city" id="city"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter City" required value="{{ $students->city }}" >
                                    </div>

                                    <div class="mb-5">
                                        <label for="province" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Province:
                                        </label>
                                        <input type="text" name="province" id="province"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Province" required value="{{ $students->province }}"
                                            >
                                    </div>
                                </div>
                            </div>

                            <div
                                class=" col-span-4 p-5 rounded-lg shadow-lg border bg-gradient-to-tr from-teal-50 via-gray-100 to-gray-100">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                    <div
                                            class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4 w-86 border-b border-b-gray-300 my-5">
                                            <p class="text-[20px] font-bold"><i class="fas fa-address-card mr-2 mb-5"></i>
                                                Parents
                                                Information </p>
                                        </div>

                                        <!-- Father's Information -->
                                        <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                            <p class="mt-2 text-lg font-bold">Father Information :</p>
                                        </div>

                                        <div class="mb-5">
                                            <label for="fatherLastName" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Father's Last Name:
                                            </label>
                                            <input type="text" name="father_last_name" id="fatherLastName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Father's Last Name" required 
                                                value="{{ $studentsAdditional[$students->lrn]->father_last_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="fatherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Father's First Name:
                                            </label>
                                            <input type="text" name="father_first_name" id="fatherFirstName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Father's First Name" required 
                                                value="{{ $studentsAdditional[$students->lrn]->father_first_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="fatherMiddleName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Father's Middle Name:
                                            </label>
                                            <input type="text" name="father_middle_name" id="fatherMiddleName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Father's Middle Name" 
                                                value="{{ $studentsAdditional[$students->lrn]->father_middle_name ?? '' }}">
                                        </div>

                                        <!-- Father's Suffix Selection -->
                                        <div class="mb-5">
                                            <label for="fatherSuffixName"
                                                class="block mb-2 text-sm font-bold text-gray-900"><span
                                                    class="text-red-600 mr-1">*</span>Father's Suffix Name:
                                            </label>
                                            <select name="father_suffix_name" id="fatherSuffixName"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                 >
                                                <option value=""  selected>Select Suffix Name</option>
                                                <option value="Jr." {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->father_suffix_name == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                                <option value="Sr." {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->father_suffix_name == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                                <option value="II" {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->father_suffix_name == 'II' ? 'selected' : '' }}>II</option>
                                                <option value="III" {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->father_suffix_name == 'III' ? 'selected' : '' }}>III</option>
                                                <option value="IV" {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->father_suffix_name == 'IV' ? 'selected' : '' }}>IV</option>
                                                <option value="V" {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->father_suffix_name == 'V' ? 'selected' : '' }}>V</option>
                                            </select>
                                        </div>

                                        <div class="mb-5">
                                            <label for="fatherOccupation"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Father's Employee Status:
                                            </label>
                                            <input type="text" name="father_occupation" id="fatherOccupation"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Father's Occupation" required 
                                                value="{{ $studentsAdditional[$students->lrn]->father_occupation ?? '' }}">
                                        </div>


                                        <!-- Mother's Information -->
                                        <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                            <p class="mt-5 text-lg font-bold">Mother Information:</p>
                                        </div>

                                        <div class="mb-5">
                                            <label for="motherLastName" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Mother's Last Name:
                                            </label>
                                            <input type="text" name="mother_last_name" id="motherLastName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Mother's Last Name" required 
                                                value="{{ $studentsAdditional[$students->lrn]->mother_last_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="motherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Mother's First Name:
                                            </label>
                                            <input type="text" name="mother_first_name" id="motherFirstName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Mother's First Name" required 
                                                value="{{ $studentsAdditional[$students->lrn]->mother_first_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="motherMiddleName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Mother's Middle Name:
                                            </label>
                                            <input type="text" name="mother_middle_name" id="motherMiddleName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Mother's Middle Name" 
                                                value="{{ $studentsAdditional[$students->lrn]->mother_middle_name ?? '' }}">
                                        </div><br class=" lg:block">

                                        <div class="mb-5">
                                            <label for="motherOccupation"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Mother's Employee Status:
                                            </label>
                                            <input type="text" name="mother_occupation" id="motherOccupation"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Mother's Occupation" required 
                                                value="{{ $studentsAdditional[$students->lrn]->mother_occupation ?? '' }}">
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
                                            <p class="text-[20px] font-bold"><i class="fas fa-address-card mr-2 mb-5"></i>
                                                Guardian Information
                                            </p>
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianLastName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Last Name:
                                            </label>
                                            <input type="text" name="guardian_last_name" id="guardianLastName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Last Name" required 
                                                value="{{ $studentsAdditional[$students->lrn]->guardian_last_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianFirstName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's First Name:
                                            </label>
                                            <input type="text" name="guardian_first_name" id="guardianFirstName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's First Name" required 
                                                value="{{ $studentsAdditional[$students->lrn]->guardian_first_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianMiddleName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Guardian's Middle Name:
                                            </label>
                                            <input type="text" name="guardian_middle_name" id="guardianMiddleName"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Middle Name" 
                                                value="{{ $studentsAdditional[$students->lrn]->guardian_middle_name ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianSuffixName"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Suffix Name:
                                            </label>
                                            <select id="guardianSuffixName" name="guardian_suffix_name"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                 >
                                                <option value="">Select Suffix Name</option>
                                                <option value="Jr." {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->guardian_suffix_name == 'Jr.' ? 'selected' : '' }}>Jr.</option>
                                                <option value="Sr." {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->guardian_suffix_name == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                                <option value="II" {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->guardian_suffix_name == 'II' ? 'selected' : '' }}>II</option>
                                                <option value="III" {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->guardian_suffix_name == 'III' ? 'selected' : '' }}>III</option>
                                                <option value="IV" {{ isset($studentsAdditional[$students->id]) && $studentsAdditional[$students->id]->guardian_suffix_name == 'IV' ? 'selected' : '' }}>IV</option>
                                            </select>
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianRelationship"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Relationship to
                                                Student:
                                            </label>
                                            <input type="text" name="guardian_relationship" id="guardianRelationship"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Relationship" required 
                                                value="{{ $studentsAdditional[$students->lrn]->guardian_relationship ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardianContactNumber"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Guardian's Contact Number:
                                            </label>
                                            <input type="text" name="guardian_contact_number" id="guardianContactNumber"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Contact Number" required 
                                                value="{{ $studentsAdditional[$students->lrn]->guardian_contact_number ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="guardian_religion"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Religion:
                                            </label>
                                            <input type="text" name="guardian_religion" id="guardian_religion"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Guardian's Religion" required 
                                                value="{{ $studentsAdditional[$students->lrn]->guardian_religion ?? '' }}">
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
                                                    class="fa-regular fa-address-card mr-2 mb-5"></i>
                                                Emergency Contact Information </p>
                                        </div>

                                        <div class="mb-5">
                                            <label for="emergencyContactPerson"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Emergency Contact Person:
                                            </label>
                                            <input type="text" name="emergency_contact_person" id="emergencyContactPerson"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Emergency Contact Person" required 
                                                value="{{ $studentsAdditional[$students->lrn]->emergency_contact_person ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="emergencyContactNumber"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Emergency Contact Number:
                                            </label>
                                            <input type="text" name="emergency_contact_number" id="emergencyContactNumber"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Emergency Contact Number" required 
                                                value="{{ $studentsAdditional[$students->lrn]->emergency_contact_number ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="emailAddress" class="block mb-2 text-sm font-bold text-gray-900">
                                                <span class="text-red-600 mr-1">*</span>Email Address:
                                            </label>
                                            <input type="email" name="email_address" id="emailAddress"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="Enter Email Address" required 
                                                value="{{ $studentsAdditional[$students->lrn]->email_address ?? '' }}">
                                        </div>

                                        <div class="mb-5">
                                            <label for="messengerAccount"
                                                class="block mb-2 text-sm font-bold text-gray-900">
                                                Messenger Account (optional):
                                            </label>
                                            <input type="text" name="messenger_account" id="messengerAccount"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                                placeholder="e.g., Facebook Messenger ID" 
                                                value="{{ $studentsAdditional[$students->lrn]->messenger_account ?? '' }}">
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
                                        <p class="text-[20px] font-bold"><i class="fa-solid fa-folder mr-2 mb-5"></i>
                                            students Documents</p>
                                    </div>
                                    <div class="mb-6">
                                        <label for="birth_certificate"
                                            class="block font-semibold text-gray-700 mb-2">Birth
                                            Certificate:</label>
                                        <label
                                            class="inline-block bg-sky-800 text-white px-4 py-2 rounded cursor-pointer hover:bg-sky-700">
                                            Choose file
                                            <input type="file" id="birth_certificate" name="birth_certificate"
                                                accept=".pdf,.jpg,.jpeg,.png" class="hidden">
                                        </label>
                                        <div class="mt-2 text-gray-600" id="birthFileName">No file chosen</div>
                                    </div>

                                    <div class="mb-6">
                                        <label for="sf10" class="block font-semibold text-gray-700 mb-2">SF10(Form
                                            137):</label>
                                        <label
                                            class="inline-block bg-sky-800 text-white px-4 py-2 rounded cursor-pointer hover:bg-sky-700">
                                            Choose file
                                            <input type="file" id="sf10" name="sf10" accept=".pdf,.jpg,.jpeg,.png"
                                                class="hidden">
                                        </label>
                                        <div class="mt-2 text-gray-600" id="residencyFileName">No file chosen
                                        </div>
                                    </div>

                                    <div class="mb-6">
                                        <label for="sf9" class="block font-semibold text-gray-700 mb-2">SF9(Form
                                            138):</label>
                                        <label
                                            class="inline-block bg-sky-800 text-white px-4 py-2 rounded cursor-pointer hover:bg-sky-700">
                                            Choose file
                                            <input type="file" id="sf9" name="sf9" accept=".pdf,.jpg,.jpeg,.png"
                                                class="hidden">
                                        </label>
                                        <div class="mt-2 text-gray-600" id="sf9File">No file chosen
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-4 flex justify-end mt-20">
                            <button type="submit"
                                class="text-white w-96 text-center bg-sky-800 hover:bg-sky-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded text-sm px-20 py-2.5 text-center">
                                Enrolled students
                            </button>
                        </div>
                    </form>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            // Get input fields
                            const lastNameInput = document.getElementById('lastName');
                            const firstNameInput = document.getElementById('firstName');
                            const studentsNumberInput = document.getElementById('lrn');
                            const passwordInput = document.getElementById('password');
                            const usernameInput = document.getElementById('username');

                            // Automatically update the password
                            const lastName = lastNameInput.value;
                            const studentsNumber = studentsNumberInput.value;

                            // Capitalize the first letter of the last name
                            const capitalizedLastName = lastName.charAt(0).toUpperCase() + lastName.slice(1).toLowerCase();

                            // Get the last four digits of the students number
                            const lastFourDigits = studentsNumber.slice(-4);

                            // Combine to form the password
                            const newPassword = `SELC${capitalizedLastName}${lastFourDigits}`;

                            // Update the password input value
                            passwordInput.value = newPassword;

                            // Update the username input value
                            const username = lastNameInput.value.toLowerCase().replace(/\s/g, '')  + firstNameInput.value.toLowerCase().replace(/\s/g, '') + '@stemilie.edu.ph';
                            usernameInput.value = username;
                        });

                        const lastNameInput = document.getElementById('lastName');
                        const firstNameInput = document.getElementById('firstName');
                        const studentsNumberInput = document.getElementById('lrn');
                        const passwordInput = document.getElementById('password');
                        const usernameInput = document.getElementById('username');

                        // Update the password in real-time
                        lastNameInput.addEventListener('input', updatePassword);
                        firstNameInput.addEventListener('input', updatePassword);
                        studentsNumberInput.addEventListener('input', updatePassword);

                        function updatePassword() {
                            const lastName = lastNameInput.value;
                            const studentsNumber = studentsNumberInput.value;

                            // Capitalize the first letter of the last name
                            const capitalizedLastName = lastName.charAt(0).toUpperCase() + lastName.slice(1).toLowerCase();

                            // Get the last four digits of the students number
                            const lastFourDigits = studentsNumber.slice(-4);

                            // Combine to form the password
                            const newPassword = `SELC${capitalizedLastName}${lastFourDigits}`;

                            // Update the password input value
                            passwordInput.value = newPassword;

                            // Update the username input value
                            const username = lastNameInput.value.toLowerCase().replace(/\s/g, '')  + firstNameInput.value.toLowerCase().replace(/\s/g, '') + '@stemilie.edu.ph';
                            usernameInput.value = username;
                        }

                        function setGuardianInfo(type) {
                            const motherFirstName = document.getElementById('motherFirstName').value;
                            const motherLastName = document.getElementById('motherLastName').value;
                            const motherMiddleName = document.getElementById('motherMiddleName').value; // Get mother's middle name

                            const fatherFirstName = document.getElementById('fatherFirstName').value;
                            const fatherLastName = document.getElementById('fatherLastName').value;
                            const fatherMiddleName = document.getElementById('fatherMiddleName').value; // Get father's middle name
                            const fatherSuffix = document.getElementById('fatherSuffixName').value;

                            const guardianRelationship = document.getElementById('guardianRelationship');

                            if (type === 'mother') {
                                document.getElementById('guardianFirstName').value = motherFirstName;
                                document.getElementById('guardianLastName').value = motherLastName;
                                document.getElementById('guardianMiddleName').value = motherMiddleName; // Set middle name
                                document.getElementById('guardianSuffixName').value = ""; // Reset suffix when choosing mother
                                guardianRelationship.value = "Mother";
                            } else if (type === 'father') {
                                document.getElementById('guardianFirstName').value = fatherFirstName;
                                document.getElementById('guardianLastName').value = fatherLastName;
                                document.getElementById('guardianMiddleName').value = fatherMiddleName; // Set middle name;
                                document.getElementById('guardianSuffixName').value = fatherSuffix; // Set suffix when choosing father
                                guardianRelationship.value = "Father";
                            }
                        }

                        document.addEventListener("DOMContentLoaded", function () {
                            document
                                .querySelector("#birth_certificate")
                                .addEventListener("change", function () {
                                    document.querySelector("#birthFileName").textContent = this.files[0]
                                        ? this.files[0].name
                                        : "No file chosen";
                                });

                            document
                                .querySelector("#sf10")
                                .addEventListener("change", function () {
                                    document.querySelector("#residencyFileName").textContent = this
                                        .files[0]
                                        ? this.files[0].name
                                        : "No file chosen";
                                });

                            document
                                .querySelector("#sf9")
                                .addEventListener("change", function () {
                                    document.querySelector("#sf9File").textContent = this
                                        .files[0]
                                        ? this.files[0].name
                                        : "No file chosen";
                                });
                        });
                    </script>
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

    #username {
        text-transform: lowercase;
    }
</style>

</html>