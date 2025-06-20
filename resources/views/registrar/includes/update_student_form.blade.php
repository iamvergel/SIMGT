<!-- Update Student Modal -->
@foreach ($students as $student)
    @php
        $account = $studentAccount[$student->student_number] ?? null;
        $avatar = $account && $account->avatar ? asset('storage/' . $account->avatar) : null;
        $initials = strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1));
        $primaryInfo = $studentsPrimary[$student->student_number] ?? null;
        $teacherInfo = $myTeacher[$primaryInfo->adviser ?? null] ?? null;
    @endphp
    <div id="updatetudentinfo{{ $student->id }}" tabindex="-1" aria-hidden="true"
        class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll"
        style="scrollbar-width: none;">
        <div class="relative px-20 py-10 w-screen h-screen">
            <div class="w-full h-full bg-white rounded-lg shadow overflow-y-scroll">
                <div
                    class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg sticky top-0">
                    <h3 class="text-lg font-bold text-teal-800 uppercase"><i class="fa-solid fa-users mr-2"></i>Update
                        {{ old('lastName', $student->student_last_name) }},
                        {{ old('lastName', $student->student_first_name) }}
                        {{ old('lastName', $student->student_suffix_name) }}
                        {{ old('lastName', $student->student_middle_name) }}
                        Information
                    </h3>
                    <button type="button"
                        class="text-white bg-teal-700 hover:bg-teal-800 p-3 py-2 rounded-full text-xl font-bold flex items-center justify-center shadow-lg"
                        aria-label="Close modal" id="updatetudentinfoClose{{ $student->id }}">
                        <i class="fas fa-times"></i>
                    </button>
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
                        }, 3000);
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

                <form class="p-10 shadow-lg" id="updateStudentForm{{ $student->id }}"
                    action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-3 xl:grid-cols=-4 gap-4 mb-4 text-[13px] text-gray-900">
                        <div class="col-span-2 2xl:col-span-1 p-10 bg-gray-200">
                            @php
                                $account = $studentAccount[$student->student_number] ?? null;
                                $avatar = $account && $account->avatar ? asset('storage/' . $account->avatar) : null;
                                $initials = strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1));
                            @endphp
                            <div class="w-full  flex items-center justify-center">
                                <div
                                    class="w-48 h-48 text-[50px] rounded-full bg-teal-700 text-white flex items-center justify-center font-bold mx-2 border-4 border-white">
                                    @if ($avatar)
                                        <img src="{{ $avatar }}" alt="Student Avatar"
                                            class="w-full h-full rounded-full object-cover">
                                    @else
                                        {{ $initials }}
                                    @endif
                                </div>
                            </div>
                            <div class="text-center mt-5 text-teal-800 ">
                                <p class="text-md tracking-widest font-semibold  shadow-text-lg mt-2 leading-3">
                                    {{ $student->student_last_name }},
                                    {{ $student->student_first_name }}
                                    {{ $student->student_suffix_name }}
                                    {{ $student->student_middle_name }}
                                </p>
                                <span
                                    class="text-xs tracking-widest font-normal shadow-text-lg mt-0">{{ $account->username ?? 'no username'}}</span>
                                <p class="text-xs">
                                    Student
                                </p>
                            </div>
                        </div>
                        <div class="col-span-2 2xl:col-span-3">
                            <div class="grid grid-cols-1 2xl:grid-cols-3 gap-4">
                                <div>
                                    <label for="lrn" class="block mb-2 text-[12px] font-bold text-gray-900">
                                        Learner Reference Number (LRN) :</label>
                                    <input type="text" name="lrn" id="lrn"
                                        class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                        value="{{ old('lrn', $student->lrn) }}"
                                        placeholder="Enter Learner Reference Number (LRN)" required readonly>
                                </div>

                                <div>
                                    <label for="status" class="block mb-2 text-sm font-bold text-gray-900">
                                        Status :</label>
                                    <select id="status" name="status"
                                        class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                        required>
                                        <option value="">Select Status</option>
                                        <option value="Enrolled" {{ old('status', $student->status) == 'Enrolled' ? 'selected' : '' }}>
                                            Enrolled</option>
                                        <option value="Graduated" {{ old('status', $student->status) == 'Graduated' ? 'selected' : '' }}>Graduated</option>

                                        <option value="Transfer" {{ old('status', $student->status) == 'Transfer' ? 'selected' : '' }}>
                                            Transfer</option>
                                    </select>
                                </div>

                                <div class="mb-5">
                                    <label for="studentNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                        Student No. :</label>
                                    <input type="text" name="student_number" id="studentNumber"
                                        class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                        value="{{ old('student_number', $student->student_number) }}"
                                        placeholder="0000-0000" required readonly>
                                </div>

                                <div>
                                    <label for="schoolYear" class="block mb-2 text-sm font-bold text-gray-900">
                                        School Year :</label>
                                    <input type="text" name="school_year" id="schoolYear"
                                        class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                        value="{{ old('school_year', $primaryInfo->school_year) }}" placeholder="0000-0000"
                                        required readonly>
                                </div>

                                <!-- <label for="school" class="block mb-2 text-sm font-bold text-gray-900">School :</label> -->
                                <input type="hidden" name="school" id="school"
                                    class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                    value="St. Emelie Learning Center" readonly>


                                <div>
                                    <label for="grade" class="block mb-2 text-sm font-bold text-gray-900">
                                        Select Grade :</label>
                                    <select id="gradeSelect"
                                        class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                        required disabled>
                                        <!-- Grades options to be dynamically handled -->
                                        <option value="Grade One" {{ old('grade', $primaryInfo->grade) == 'Grade One' ? 'selected' : '' }}>Grade One</option>
                                        <option value="Grade Two" {{ old('grade', $primaryInfo->grade) == 'Grade Two' ? 'selected' : '' }}>Grade Two</option>
                                        <option value="Grade Three" {{ old('grade', $primaryInfo->grade) == 'Grade Three' ? 'selected' : '' }}>Grade Three</option>
                                        <option value="Grade Four" {{ old('grade', $primaryInfo->grade) == 'Grade Four' ? 'selected' : '' }}>Grade Four</option>
                                        <option value="Grade Five" {{ old('grade', $primaryInfo->grade) == 'Grade Five' ? 'selected' : '' }}>Grade Five</option>
                                        <option value="Grade Six" {{ old('grade', $primaryInfo->grade) == 'Grade Six' ? 'selected' : '' }}>Grade Six</option>
                                    </select>
                                    <input type="hidden" name="grade" id="grade"
                                        value="{{ old('grade', $primaryInfo->grade) }}">
                                </div>

                                <div>
                                    <label for="section" class="block mb-2 text-sm font-bold text-gray-900">
                                        Section :</label>
                                    <!-- <select id="sectionSelect" name="section"
                                        class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                        >
                                       
                                    </select> -->
                                    <input type="text" name="section" id="section"
                                        class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                        value="{{ old('section', $primaryInfo->section) }}" placeholder="0000-0000"
                                        required readonly>
                                </div>

                                <div>
                                    <label for="adviser" class="block mb-2 text-sm font-bold text-gray-900 mt-5">
                                        Select Adviser :</label>
                                    <!-- <select id="teacherSelect" name="adviser"
                                        class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                        >
                                        
                                    </select> -->
                                    <input type="text" id="adviser"
                                        class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                        value="{{ $teacherInfo->first_name }} {{ $teacherInfo->middle_name }} {{ $teacherInfo->last_name }}" placeholder="0000-0000"
                                        required readonly>
                                    <input type="hidden" name="adviser" id="advisercurrent" value="{{$primaryInfo->adviser }}">
                                    
                                </div>

                                <script>
                                    document.addEventListener("DOMContentLoaded", function () {
                                        const gradeSelect = document.getElementById("gradeSelect");
                                        const sectionSelect = document.getElementById("sectionSelect");
                                        const teacherSelect = document.getElementById("teacherSelect");
                                        const schoolYearSelect = document.getElementById("schoolYear");

                                        const currentSection = document.getElementById("section").value; // Get the current section value
                                        const currentTeacher = document.getElementById("advisercurrent").value; // Get the current teacher value

                                        // Function to load sections based on selected grade and school year
                                        function loadSections() {
                                            const selectedGrade = gradeSelect.value;
                                            const selectedSchoolYear = schoolYearSelect.value;

                                            console.log(selectedGrade, selectedSchoolYear);

                                            if (selectedGrade && selectedSchoolYear) {
                                                fetch(`/api/sections?grade=${selectedGrade}&school_year=${selectedSchoolYear}`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        sectionSelect.innerHTML = '<option value="">Select Section</option>';
                                                        if (data.length) {
                                                            data.forEach(section => {
                                                                const option = document.createElement("option");
                                                                option.value = section.section;
                                                                option.textContent = section.section;
                                                                sectionSelect.appendChild(option);
                                                            });
                                                        } else {
                                                            const option = document.createElement("option");
                                                            option.value = "";
                                                            option.textContent = "No Sections Available";
                                                            sectionSelect.appendChild(option);
                                                        }

                                                        // Set the current section value (if available)
                                                        if (currentSection) {
                                                            sectionSelect.value = currentSection;
                                                        }
                                                    })
                                                    .catch(error => {
                                                        const option = document.createElement("option");
                                                        option.value = "";
                                                        option.textContent = "Error loading sections";
                                                        sectionSelect.appendChild(option);
                                                    });
                                            }
                                        }

                                        // Function to load teachers based on selected grade, section, and school year
                                        function loadTeachers() {
                                            const selectedGrade = gradeSelect.value;
                                            const selectedSection = sectionSelect.value;
                                            const selectedSchoolYear = schoolYearSelect.value;

                                            if (selectedGrade && selectedSection && selectedSchoolYear) {
                                                fetch(`/api/allteachers?grade=${selectedGrade}&section=${selectedSection}&school_year=${selectedSchoolYear}`)
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

                                                        // Set the current teacher value (if available)
                                                        if (currentTeacher) {
                                                            teacherSelect.value = currentTeacher;
                                                        }
                                                    })
                                                    .catch(error => {
                                                        const option = document.createElement("option");
                                                        option.value = "";
                                                        option.textContent = "Error loading teachers";
                                                        teacherSelect.appendChild(option);
                                                    });
                                            }
                                        }

                                        // Function to update the sections and teachers when the page is loaded
                                        function initialize() {
                                            const selectedGrade = gradeSelect.value;
                                            const selectedSchoolYear = schoolYearSelect.value;

                                            // Load sections and teachers automatically based on current grade and school year
                                            loadSections();
                                            loadTeachers();
                                        }

                                        // Initialize the dropdowns when the page is loaded
                                        initialize();

                                        // Event listener for the grade selection
                                        gradeSelect.addEventListener("change", function () {
                                            // Hide all grades except the selected one
                                            const selectedGrade = gradeSelect.value;
                                            const allOptions = gradeSelect.querySelectorAll("option");

                                            allOptions.forEach(option => {
                                                option.style.display = option.value === selectedGrade ? "block" : "none";
                                            });

                                            // Load sections and teachers based on the selected grade
                                            loadSections();
                                            loadTeachers();
                                        });

                                        // Event listeners for the section and school year changes
                                        sectionSelect.addEventListener("change", loadTeachers);
                                        schoolYearSelect.addEventListener("change", function () {
                                            loadSections();
                                            loadTeachers();
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="col-span-4 w-86 border-b border-b-gray-300 my-5">
                            <p class="text-[20px] font-bold"><i class="fas fa-user mr-2 mb-5"></i>
                                Personal Information
                            </p>
                        </div>

                        <div class="mb-5">
                            <label for="lastName" class="block mb-2 text-sm font-bold text-gray-900">Last Name:
                            </label>
                            <input type="text" name="lastName" id="lastName"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('lastName', $student->student_last_name) }}" required>
                        </div>

                        <div class="mb-5">
                            <label for="firstName" class="block mb-2 text-sm font-bold text-gray-900">First Name:
                            </label>
                            <input type="text" name="firstName" id="firstName"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('firstName', $student->student_first_name) }}" required>
                        </div>


                        <div class="mb-5">
                            <label for="middleName" class="block mb-2 text-sm font-bold text-gray-900">Middle Name:</label>
                            <input type="text" name="middleName" id="middleName"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('middleName', $student->student_middle_name) }}">
                        </div>

                        <div>
                            <label for="suffixName" class="block mb-2 text-sm font-bold text-gray-900">Suffix Name :</label>
                            <select id="suffixName" name="suffixName"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                <option value="">Select an option</option>
                                <option value="Jr." {{ old('suffixName', $student->student_suffix_name) == 'Jr.' ? 'selected' : '' }}>Jr./option>
                                <option value="Sr." {{ old('suffixName', $student->student_suffix_name) == 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                <option value="II" {{ old('suffixName', $student->student_suffix_name) == 'II' ? 'selected' : '' }}>II</option>
                                <option value="III" {{ old('suffixName', $student->student_suffix_name) == 'III' ? 'selected' : '' }}>III</option>
                                <option value="IV" {{ old('suffixName', $student->student_suffix_name) == 'IV' ? 'selected' : '' }}>IV</option>
                                <option value="V" {{ old('suffixName', $student->student_suffix_name) == 'V' ? 'selected' : '' }}>V</option>
                            </select>
                        </div>

                        <div>
                            <label for="birthplace" class="block mb-2 text-sm font-bold text-gray-900">Birthplace :</label>
                            <input type="text" name="birthplace" id="birthplace"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('birthplace', $student->place_of_birth) }}" placeholder="Enter Birthplace"
                                required>
                        </div>

                        <div>
                            <label for="birthDate" class="block mb-2 text-sm font-bold text-gray-900">
                                Birth Date:
                            </label>
                            <input type="date" name="birthDate" id="birthDate" onchange="calculateAge()"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('birthDate', $student->birth_date) }}" required>
                        </div>

                        <div>
                            <label for="age" class="block mb-2 text-sm font-bold text-gray-900">
                                Age:
                            </label>
                            <input type="number" name="age" id="age"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('age', $student->age) }}" placeholder="Enter Age" min="0" required readonly>
                        </div>

                        <div>
                            <label for="gender" class="block mb-2 text-sm font-bold text-gray-900">Sex : </label>
                            <select name="gender" id="gender"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                required>
                                <option value="" disabled selected>Select Gender</option>
                                <option value="Male" {{ old('gender', $student->sex) == 'Male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="Female" {{ old('gender', $student->sex) == 'Female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                        </div>

                        <div>
                            <label for="email" class="block mb-2 text-sm font-bold text-gray-900">
                                Email: <small>(Parents or Student Email)</small>
                            </label>
                            <input type="email" name="email" id="email"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('email', $student->email_address_send) }}" placeholder="example@gmail.com"
                                required>
                        </div>

                        <div>
                            <label for="contactNo" class="block mb-2 text-sm font-bold text-gray-900">
                                Contact No. : <small>(Parents or Student)</small>
                            </label>
                            <input type="tel" name="contactNo" id="contactNo"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('contactNo', $student->contact_number) }}" placeholder="Enter Contact Number"
                                required>
                        </div>

                        <div>
                            <label for="religion" class="block mb-2 text-sm font-bold text-gray-900">
                                Religion :
                            </label>
                            <input type="text" name="religion" id="religion"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('religion', $student->religion) }}" placeholder="Enter Religion" required>
                        </div>

                        <!-- Address Information -->
                        <div class="col-span-4 w-86 border-b border-b-gray-300 my-5">
                            <p class="text-[20px] font-bold"><i class="fas fa-address-card mr-2 mb-5"></i>
                                Permanent Address
                            </p>
                        </div>

                        <div>
                            <label for="houseNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                House Number:
                            </label>
                            <input type="text" name="house_number" id="houseNumber"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('house_number', $student->house_number) }}" placeholder="Enter House No."
                                required>
                        </div>

                        <div>
                            <label for="street" class="block mb-2 text-sm font-bold text-gray-900">
                                Street:
                            </label>
                            <input type="text" name="street" id="street"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('street', $student->street) }}" placeholder="Enter Street" required>
                        </div>

                        <div>
                            <label for="barangay" class="block mb-2 text-sm font-bold text-gray-900">
                                Barangay:
                            </label>
                            <input type="text" name="barangay" id="barangay"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('barangay', $student->barangay) }}" placeholder="Enter Barangay" required>
                        </div>

                        <div>
                            <label for="city" class="block mb-2 text-sm font-bold text-gray-900">
                                City:
                            </label>
                            <input type="text" name="city" id="city"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('city', $student->city) }}" placeholder="Enter City" required>
                        </div>

                        <div>
                            <label for="province" class="block mb-2 text-sm font-bold text-gray-900">
                                Province:
                            </label>
                            <input type="text" name="province" id="province"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('province', $student->province) }}" placeholder="Enter Province" required>
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
                                Father's Last Name:
                            </label>
                            <input type="text" name="father_last_name" id="fatherLastName"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('father_last_name', $student->additionalInfo->father_last_name ?? '') }}"
                                placeholder="Enter Father's Last Name" required>
                            @error('father_last_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="fatherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                Father's First Name:
                            </label>
                            <input type="text" name="father_first_name" id="fatherFirstName"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('father_first_name', $student->additionalInfo->father_first_name ?? '') }}"
                                placeholder="Enter Father's First Name" required>
                            @error('father_first_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="fatherMiddleName" class="block mb-2 text-sm font-bold text-gray-900">
                                Father's Middle Name:
                            </label>
                            <input type="text" name="father_middle_name" id="fatherMiddleName"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('father_middle_name', $student->additionalInfo->father_middle_name ?? '') }}"
                                placeholder="Enter Father's Middle Name">
                            @error('father_middle_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Father's Suffix Selection -->
                        <div>
                            <label for="fatherSuffixName" class="block mb-2 text-sm font-bold text-gray-900">
                                Father's Suffix Name:
                            </label>
                            <select id="fatherSuffixName" name="father_suffix_name"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                <option value="">Select Suffix Name</option>
                                <option value="Jr." {{ (old('father_suffix_name', $student->additionalInfo->father_suffix_name) === 'Jr.') ? 'selected' : '' }}>Jr.</option>
                                <option value="Sr." {{ (old('father_suffix_name', $student->additionalInfo->father_suffix_name) === 'Sr.') ? 'selected' : '' }}>Sr.</option>
                                <option value="II" {{ (old('father_suffix_name', $student->additionalInfo->father_suffix_name) === 'II') ? 'selected' : '' }}>II</option>
                                <option value="III" {{ (old('father_suffix_name', $student->additionalInfo->father_suffix_name) === 'III') ? 'selected' : '' }}>III</option>
                                <option value="IV" {{ (old('father_suffix_name', $student->additionalInfo->father_suffix_name) === 'IV') ? 'selected' : '' }}>IV</option>
                                <option value="V" {{ (old('father_suffix_name', $student->additionalInfo->father_suffix_name) === 'V') ? 'selected' : '' }}>V</option>
                            </select>
                        </div>

                        <!-- Father's Occupation -->
                        <div>
                            <label for="fatherOccupation" class="block mb-2 text-sm font-bold text-gray-900">
                                Father's Employee Status:
                            </label>
                            <input type="text" name="father_occupation" id="fatherOccupation"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('father_occupation', $student->additionalInfo->father_occupation) }}"
                                placeholder="Enter Father's Occupation" required>
                            @error('father_occupation')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mother's Information -->
                        <div class="col-span-4">
                            <p class="mt-5">Mother Information:</p>
                        </div>

                        <div>
                            <label for="motherLastName" class="block mb-2 text-sm font-bold text-gray-900">
                                Mother's Last Name:
                            </label>
                            <input type="text" name="mother_last_name" id="motherLastName"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('mother_last_name', $student->additionalInfo->mother_last_name) }}"
                                placeholder="Enter Mother's Last Name" required>
                            @error('mother_last_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="motherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                Mother's First Name:
                            </label>
                            <input type="text" name="mother_first_name" id="motherFirstName"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('mother_first_name', $student->additionalInfo->mother_first_name) }}"
                                placeholder="Enter Mother's First Name" required>
                            @error('mother_first_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="motherMiddleName" class="block mb-2 text-sm font-bold text-gray-900">
                                Mother's Middle Name:
                            </label>
                            <input type="text" name="mother_middle_name" id="motherMiddleName"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('mother_middle_name', $student->additionalInfo->mother_middle_name) }}"
                                placeholder="Enter Mother's Middle Name">
                            @error('mother_middle_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="motherOccupation" class="block mb-2 text-sm font-bold text-gray-900">
                                Mother's Employee Status:
                            </label>
                            <input type="text" name="mother_occupation" id="motherOccupation"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('mother_occupation', $student->additionalInfo->mother_occupation) }}"
                                placeholder="Enter Mother's Occupation" required>
                            @error('mother_occupation')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Guardian's Information -->
                        <div class="col-span-4">
                            <p class="mt-5">Guardian Information:</p>
                        </div>

                        <div>
                            <label for="guardianLastName" class="block mb-2 text-sm font-bold text-gray-900">
                                Guardian's Last Name:
                            </label>
                            <input type="text" name="guardian_last_name" id="guardianLastName"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('guardian_last_name', $student->additionalInfo->guardian_last_name) }}"
                                placeholder="Enter Guardian's Last Name" required>
                            @error('guardian_last_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="guardianFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                Guardian's First Name:
                            </label>
                            <input type="text" name="guardian_first_name" id="guardianFirstName"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('guardian_first_name', $student->additionalInfo->guardian_first_name) }}"
                                placeholder="Enter Guardian's First Name" required>
                            @error('guardian_first_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="guardianMiddleName" class="block mb-2 text-sm font-bold text-gray-900">
                                Guardian's Middle Name:
                            </label>
                            <input type="text" name="guardian_middle_name" id="guardianMiddleName"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('guardian_middle_name', $student->additionalInfo->guardian_middle_name) }}"
                                placeholder="Enter Guardian's Middle Name">
                            @error('guardian_middle_name')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="guardianSuffixName" class="block mb-2 text-sm font-bold text-gray-900">
                                Suffix Name:
                            </label>
                            <select id="guardianSuffixName" name="guardian_suffix_name"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                <option value="">Select Suffix Name</option>
                                <option value="Jr." {{ (old('guardian_suffix_name', $student->additionalInfo->guardian_suffix_name) === 'Jr.') ? 'selected' : '' }}>Jr.
                                </option>
                                <option value="Sr." {{ (old('guardian_suffix_name', $student->additionalInfo->guardian_suffix_name) === 'Sr.') ? 'selected' : '' }}>Sr.
                                </option>
                                <option value="II" {{ (old('guardian_suffix_name', $student->additionalInfo->guardian_suffix_name) === 'II') ? 'selected' : '' }}>II</option>
                                <option value="III" {{ (old('guardian_suffix_name', $student->additionalInfo->guardian_suffix_name) === 'III') ? 'selected' : '' }}>III
                                </option>
                                <option value="IV" {{ (old('guardian_suffix_name', $student->additionalInfo->guardian_suffix_name) === 'IV') ? 'selected' : '' }}>IV</option>
                                <option value="V" {{ (old('guardian_suffix_name', $student->additionalInfo->guardian_suffix_name) === 'V') ? 'selected' : '' }}>V</option>
                            </select>
                        </div>

                        <div>
                            <label for="guardianRelationship" class="block mb-2 text-[12px] font-bold text-gray-900">
                                Guardian's Relationship to Student:
                            </label>
                            <input type="text" name="guardian_relationship" id="guardianRelationship"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('guardian_relationship', $student->additionalInfo->guardian_relationship) }}"
                                placeholder="Enter Guardian's Relationship" required>
                            @error('guardian_relationship')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="guardianContactNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                Guardian's Contact Number:
                            </label>
                            <input type="text" name="guardian_contact_number" id="guardianContactNumber"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('guardian_contact_number', $student->additionalInfo->guardian_contact_number) }}"
                                placeholder="Enter Guardian's Contact Number" required>
                            @error('guardian_contact_number')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="guardian_religion" class="block mb-2 text-sm font-bold text-gray-900">
                                Religion:
                            </label>
                            <input type="text" name="guardian_religion" id="guardian_religion"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('guardian_religion', $student->additionalInfo->guardian_religion) }}"
                                placeholder="Enter Guardian's Religion" required>
                            @error('guardian_religion')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Emergency Information -->
                        <div class="col-span-4">
                            <p class="mt-5">Emergency Information:</p>
                        </div>

                        <div>
                            <label for="emergencyContactPerson" class="block mb-2 text-sm font-bold text-gray-900">
                                Emergency Contact Person:
                            </label>
                            <input type="text" name="emergency_contact_person" id="emergencyContactPerson"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('emergency_contact_person', $student->additionalInfo->emergency_contact_person) }}"
                                placeholder="Enter Emergency Contact Person" required>
                            @error('emergency_contact_person')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="emergencyContactNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                Emergency Contact Number:
                            </label>
                            <input type="text" name="emergency_contact_number" id="emergencyContactNumber"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('emergency_contact_number', $student->additionalInfo->emergency_contact_number) }}"
                                placeholder="Enter Emergency Contact Number" required>
                            @error('emergency_contact_number')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="emailAddress" class="block mb-2 text-sm font-bold text-gray-900">
                                Email Address:
                            </label>
                            <input type="email" name="email_address" id="emailAddress"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('email_address', $student->additionalInfo->email_address) }}"
                                placeholder="Enter Email Address" required>
                            @error('email_address')
                                <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label for="messengerAccount" class="block mb-2 text-sm font-bold text-gray-900">
                                Messenger Account (optional):
                            </label>
                            <input type="text" name="messenger_account" id="messengerAccount"
                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                value="{{ old('messenger_account', $student->additionalInfo->messenger_account) }}"
                                placeholder="e.g., Facebook Messenger ID">
                        </div>

                        <div class="col-span-4 w-86 border-b border-b-gray-300 my-5">
                            <p class="text-[20px] font-bold"><i class="fa-solid fa-folder-open mr-2 mb-5"></i>
                                Student Documents
                            </p>
                        </div>

                        <!-- Document Uploads -->
                        <div class="col-span-4">
                            <p class="mt-5">Document Uploads:</p>
                        </div>

                        <div class="mb-6">
                            <label for="birth_certificate" class="block font-semibold text-gray-700 mb-2">Birth
                                Certificate:</label>
                            <input type="file" id="birth_certificate" name="birth_certificate" accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full p-3 border-2 uppercase rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px] file:mr-4 file:rounded-full file:border-0 file:bg-teal-100 file:px-4 file:py-2 file:text-md file:font-semibold file:text-teal-800 hover:file:bg-teal-200">
                            @if($student->documents && $student->documents->birth_certificate)
                                <div class="mt-2 text-gray-800">
                                    <a href="{{ asset('storage/' . $student->documents->birth_certificate) }}" target="_blank"
                                        class="text-blue-600 font-semibold hover:text-blue-700">Current File:
                                        Click To Open Current Birth Certificate</a>
                                </div>
                            @endif
                        </div>

                        <div class="mb-6">
                            <label for="sf10" class="block font-semibold text-gray-700 mb-2">SF10(Form 137):</label>

                            <input type="file" id="sf10" name="sf10" accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full p-3 border-2 uppercase rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px] file:mr-4 file:rounded-full file:border-0 file:bg-teal-100 file:px-4 file:py-2 file:text-md file:font-semibold file:text-teal-800 hover:file:bg-teal-200">
                            <!-- <div class="mt-2 text-gray-600" id="residencyFileName">No file chosen</div> -->
                            @if($student->documents && $student->documents->sf10)
                                <div class="mt-2 text-gray-800 flex">
                                    <a href="{{ asset('storage/' . $student->documents->sf10) }}" target="_blank"
                                        class="text-blue-600 font-semibold hover:text-blue-700">Current File: Click To Open
                                        Current SF10</a>
                                </div>
                            @endif
                        </div>

                        <div class="mb-6">
                            <label for="sf9" class="block font-semibold text-gray-700 mb-2">SF9(Form 138):</label>

                            <input type="file" id="sf9" name="sf9" accept=".pdf,.jpg,.jpeg,.png"
                                class="w-full p-3 border-2 uppercase rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-700 text-[15px] file:mr-4 file:rounded-full file:border-0 file:bg-teal-100 file:px-4 file:py-2 file:text-md file:font-semibold file:text-teal-800 hover:file:bg-teal-200">
                            <!-- <div class="mt-2 text-gray-600" id="residencyFileName">No file chosen</div> -->
                            @if($student->documents && $student->documents->sf9)
                                <div class="mt-2 text-gray-800 flex">
                                    <a href="{{ asset('storage/' . $student->documents->sf9) }}" target="_blank"
                                        class="text-blue-600 font-semibold hover:text-blue-700">Current File: Click To Open
                                        Current SF9</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex justify-end mt-5">
                        <button type="submit" class="bg-teal-800 hover:bg-teal-700 text-white font-bold py-3 px-20 rounded">
                            Update Student Information
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach