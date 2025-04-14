@include('admin.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('admin.includes.topnav')
            </header>
            <div class="p-5">
                <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span
                            onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
                            class="hover:text-teal-700">Student Management</span> / Add Student
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
                        setTimeout(function () {
                            document.getElementById("success-alert").remove();
                        }, 5000);
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
                        <i class="fa-solid fa-users mr-2"></i>Add New Student
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
                                        <input type="text" name="lrn" id="lrn" maxlength="12" inputmode="numeric"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Learner Reference Number (LRN)"
                                            onkeydown="return event.key != 'ArrowUp' && event.key != 'ArrowDown'"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)"
                                            required>
                                        <small class="text-gray-500 text-xs">(LRN must be exactly 12 digits)<br />
                                            <span class="text-red-600 hidden" id="lrnAlert">LRN must be 12 digits</span>
                                        </small>
                                    </div>
                                    <script>
                                        document.getElementById('lrn').addEventListener('input', function () {
                                            const lrnAlert = document.getElementById('lrnAlert');
                                            if (this.value === null || this.value === '') {
                                                lrnAlert.classList.add('hidden');
                                                document.getElementById('lrn').classList.remove('border-red-500');
                                            } else if (this.value.length !== 12) {
                                                lrnAlert.classList.remove('hidden');
                                                document.getElementById('lrn').classList.add('border-red-500');
                                            } else {
                                                lrnAlert.classList.add('hidden');
                                                document.getElementById('lrn').classList.remove('border-red-500');
                                            }
                                        });
                                    </script>

                                    <div class="mb-5 hidden">
                                        <label for="studentNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Student No. :</label>
                                        <input type="text" name="student_number" id="studentsNumber"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="0000-0000" required>
                                    </div>

                                    <script>
                                        document.getElementById("lrn").addEventListener("input", function () {
                                            document.getElementById("studentsNumber").value = this.value;
                                        });
                                    </script>

                                    <div class="mb-5 hidden">
                                        <label for="status" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Student No. :</label>
                                        <input type="text" name="status" id="status" value="Enrolled"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="0000-0000" required>
                                    </div>
                                    <div>
                                        <label for="schoolYear" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>School Year :
                                        </label>
                                        <select name="school_year" id="schoolYear" required
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="" disabled selected>Select School Year</option>
                                            <option value="{{ date('Y') }}-{{ date('Y') + 1}}">
                                                {{ date('Y')}}-{{ date('Y') + 1 }}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="hidden xl:block"></div>
                                    <div class="hidden xl:block"></div>

                                    <div>
                                        <label for="grade" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Select Grade :
                                        </label>
                                        <select id="grade" name="grade"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            required>
                                            <option value="" selected disabled>Select Grade</option>
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
                                        <select id="section" name="section" required
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="" selected disabled>Select Section</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label for="adviser" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Select Adviser :</label>
                                        <select id="teacher" name="adviser" required
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="" selected disabled>Select Teacher</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const gradeSelect = document.getElementById("grade");
                                    const sectionSelect = document.getElementById("section");
                                    const schoolYearSelect = document.getElementById("schoolYear");
                                    const teacherSelect = document.getElementById("teacher");

                                    gradeSelect.addEventListener("change", function () {
                                        const selectedGrade = gradeSelect.value;
                                        const selectedSection = sectionSelect.value;
                                        const selectedSchoolYear = schoolYearSelect.value;

                                        if (selectedGrade) {
                                            fetch(`/api/sections?grade=${selectedGrade}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    sectionSelect.innerHTML = '<option value="" selected disabled>Select Section</option>';

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
                                                        option.selected = true;
                                                        option.disabled = true;
                                                        sectionSelect.appendChild(option);
                                                    }

                                                    if (selectedSection) {
                                                        sectionSelect.value = selectedSection;
                                                    }
                                                })
                                                .catch(error => {
                                                    const option = document.createElement("option");
                                                    option.value = "";
                                                    option.textContent = "Error loading sections";
                                                    sectionSelect.appendChild(option);
                                                });
                                        } else {
                                            sectionSelect.innerHTML = '<option value="" selected disabled>Select Section</option>';
                                        }

                                        if (selectedGrade && selectedSection && selectedSchoolYear) {
                                            fetch(`/api/allteachers?grade=${selectedGrade}&section=${selectedSection}&school_year=${selectedSchoolYear}`)
                                                .then(response => response.json())
                                                .then(data => {
                                                    teacherSelect.innerHTML = '<option value="" selected disabled>Select Teacher</option>';

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
                                                        option.selected = true;
                                                        option.disabled = true;
                                                        teacherSelect.appendChild(option);
                                                    }
                                                })
                                                .catch(error => {
                                                    const option = document.createElement("option");
                                                    option.value = "";
                                                    option.textContent = "Error loading teachers";
                                                    teacherSelect.appendChild(option);
                                                });
                                        } else {
                                            teacherSelect.innerHTML = '<option value="" selected disabled >Select Teacher</option>';
                                        }
                                    });

                                    sectionSelect.addEventListener("change", function () {
                                        const selectedGrade = gradeSelect.value;
                                        const selectedSection = sectionSelect.value;
                                        const selectedSchoolYear = schoolYearSelect.value;

                                        if (selectedGrade && selectedSchoolYear && selectedSection) {
                                            gradeSelect.dispatchEvent(new Event("change"));
                                        }
                                    });

                                    schoolYearSelect.addEventListener("change", function () {
                                        gradeSelect.value = "";
                                        sectionSelect.innerHTML = '<option value="" selected disabled>Select Section</option>';
                                        teacherSelect.innerHTML = '<option value="" selected disabled>Select Teacher</option>';
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
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Last Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="firstName" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>First Name :</label>
                                        <input type="text" name="firstName" id="firstName"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter First Name" required>
                                    </div class="mb-5">

                                    <div class="mb-5">
                                        <label for="middleName"
                                            class="block mb-2 text-sm font-bold text-gray-900">Middle
                                            Name
                                            :</label>
                                        <input type="text" name="middleName" id="middleName"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Middle Name" value="">
                                    </div>

                                    <div class="mb-5">
                                        <label for="suffixName"
                                            class="block mb-2 text-sm font-bold text-gray-900">Suffix
                                            Name
                                            :</label>
                                        <select id="suffixName" name="suffixName"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                            <option value="">Select an option</option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                        </select>
                                    </div>

                                    <div class="hidden">
                                        <label for="username" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Username :</label>
                                        <input type="text" name="username" id="username"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none "
                                            placeholder="username" required>
                                    </div>

                                    <div class="hidden">
                                        <label for="password" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Password :</label>
                                        <input type="text" name="password" id="password"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="password" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="birthplace" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Birthplace :</label>
                                        <input type="text" name="birthplace" id="birthplace"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Birthplace" required>
                                    </div>

                                    <!-- Birth Date -->
                                    <div class="mb-5">
                                        <label for="birthplace" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Birth Date
                                        </label>
                                        <input type="text" name="birthDate" id="birthDate" placeholder="MM/DD/YYYY"
                                            class=" block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            required>
                                        <small class="text-red-600 text-xs hidden" id="birthDateAlert">Birth
                                            Date is
                                            required</small>
                                    </div>

                                    <!-- Age -->
                                    <div class="mb-5">
                                        <label for="birthplace" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Age
                                        </label>
                                        <input type="number" name="age" id="ageStudent"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            placeholder="Enter Age" min="0" required readonly>
                                        <small class="text-red-600 text-xs hidden" id="ageAlert">Age is
                                            required</small>
                                    </div>

                                    <div class="mb-5">
                                        <label for="gender" class="block mb-2 text-sm font-bold text-gray-900"><span
                                                class="text-red-600 mr-1">*</span>Gender : </label>
                                        <select name="gender" id="gender"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            required>
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>

                                    <div class="mb-5">
                                        <label for="email" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Email:
                                        </label>
                                        <input type="email" name="email" id="email"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Ex. StEmilieLearningCenter@gmail.com" required
                                            pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                            title="Please enter a valid Gmail address.">
                                        <small class="text-gray-500 text-xs">(Parents, guardian or Personal
                                            Email)<br /><span class="text-red-600 hidden" id="emailAlert">Email must be
                                                @gmail.com</span></small>
                                    </div>

                                    <script>
                                        document.getElementById('email').addEventListener('input', function () {
                                            const emailAlert = document.getElementById('emailAlert');
                                            if (this.value === null || this.value === '') {
                                                emailAlert.classList.add('hidden');
                                                document.getElementById('email').classList.remove('border-red-500');
                                            } else if (!this.value.endsWith('@gmail.com')) {
                                                emailAlert.classList.remove('hidden');
                                                document.getElementById('email').classList.add('border-red-500');
                                            } else {
                                                emailAlert.classList.add('hidden');
                                                document.getElementById('email').classList.remove('border-red-500');
                                            }
                                        });
                                    </script>

                                    <div class="mb-5">
                                        <label for="contactNo" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Contact No. :
                                        </label>
                                        <input type="tel" name="contactNo" id="contactNo" maxlength="11"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Contact Number" required pattern="^09\d{9}$"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^(?!09).*/, '09');"
                                            value="09">
                                        <small class="text-gray-500 text-xs">(Parents, guardian or Personal
                                            Number)<br /><span class="text-red-600 hidden" id="contactNoAlert">Contact
                                                Number must be 11 digits</span></small>
                                    </div>
                                    <script>
                                        document.getElementById('contactNo').addEventListener('input', function () {
                                            const contactNoAlert = document.getElementById('contactNoAlert');
                                            if (this.value === null || this.value === '09') {
                                                contactNoAlert.classList.add('hidden');
                                                document.getElementById('contactNo').classList.remove('border-red-500');
                                            } else if (this.value.length !== 11) {
                                                contactNoAlert.classList.remove('hidden');
                                                document.getElementById('contactNo').classList.add('border-red-500');
                                            } else {
                                                contactNoAlert.classList.add('hidden');
                                                document.getElementById('contactNo').classList.remove('border-red-500');
                                            }
                                        });
                                    </script>

                                    <div class="mb-5">
                                        <label for="contactNo" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Religion
                                        </label>

                                        <!-- Custom dropdown with search -->
                                        <div class="relative">
                                            <input type="text" id="religion" name="religion"
                                                placeholder="Select or type your Religion"
                                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                                oninput="filterReligionOptions()" onclick="showReligionList()" required>

                                            <ul id="religionList"
                                                class="hidden absolute w-full bg-white border border-gray-300 mt-1 rounded shadow-lg max-h-60 overflow-y-auto z-10">
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Roman Catholic')">Roman Catholic
                                                </li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Protestantism')">Protestantism</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Islam')">Islam</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Iglesia ni Cristo')">Iglesia ni
                                                    Cristo
                                                </li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Hinduism')">Hinduism</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Buddhism')">Buddhism</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Indigenous Beliefs')">Indigenous
                                                    Beliefs</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Atheism and Agnosticism')">Atheism
                                                    and
                                                    Agnosticism</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Sikhism')">Sikhism</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligion('Zoroastrianism')">Zoroastrianism
                                                </li>
                                            </ul>
                                        </div>

                                        <small class="text-red-600 text-xs hidden" id="religionAlert">Religion
                                            is
                                            required</small>
                                    </div>

                                    <script>
                                        // Function to show the list when clicked
                                        function showReligionList() {
                                            const list = document.getElementById('religionList');
                                            list.classList.remove('hidden');
                                        }

                                        // Function to filter options based on input
                                        function filterReligionOptions() {
                                            const input = document.getElementById('religion');
                                            const filter = input.value.toLowerCase();
                                            const list = document.getElementById('religionList');
                                            const options = list.getElementsByTagName('li');

                                            // Show the list when typing
                                            list.classList.remove('hidden');
                                            let matchFound = false;

                                            for (let i = 0; i < options.length; i++) {
                                                const option = options[i];
                                                const text = option.textContent || option.innerText;
                                                if (text.toLowerCase().indexOf(filter) > -1) {
                                                    option.style.display = "";
                                                    matchFound = true;
                                                } else {
                                                    option.style.display = "none";
                                                }
                                            }

                                            // If no matches, hide the dropdown list
                                            if (!matchFound) {
                                                list.classList.add('hidden');
                                            }
                                        }

                                        // Function to select a religion option
                                        function selectReligion(religion) {
                                            const input = document.getElementById('religion');
                                            const list = document.getElementById('religionList');

                                            input.value = religion;
                                            list.classList.add('hidden'); // Hide dropdown after selection

                                            // Optionally, validate religion
                                            validateReligion();
                                        }

                                        // Validation to check if a religion is selected
                                        function validateReligion() {
                                            const religionInput = document.getElementById('religion');
                                            const religionAlert = document.getElementById('religionAlert');

                                            if (religionInput.value === "") {
                                                religionAlert.classList.remove('hidden');
                                            } else {
                                                religionAlert.classList.add('hidden');
                                            }
                                        }

                                        // Close the dropdown when clicked outside
                                        document.addEventListener('click', function (event) {
                                            const list = document.getElementById('religionList');
                                            const input = document.getElementById('religion');

                                            if (!input.contains(event.target) && !list.contains(event.target)) {
                                                list.classList.add('hidden');
                                            }
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="fixed inset-0 z-10 bg-black bg-opacity-50  p-5 flex items-center justify-center hidden"
                                id="ageDropdown">
                                <div class="bg-white rounded-lg shadow-lg p-5 max-w-lg mx-auto w-96">
                                    <div
                                        class="flex items-center text-teal-800 text-lg font-semibold font-normal justify-center">
                                        <span id="ageConfirmation" class="text-center"></span>
                                    </div>
                                    <div class="flex justify-end mt-10 text-sm">

                                        <button type="button"
                                            class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white ml-3"
                                            onclick="document.getElementById('ageDropdown').classList.add('hidden')">
                                            Okay
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <script>
                                // Initialize the flatpickr
                                flatpickr("#birthDate", {

                                    onChange: function (selectedDates, dateStr, instance) {
                                        calculateAge(dateStr); // When date is selected, calculate age
                                    }
                                });

                                // Function to calculate age based on the selected date
                                function calculateAge(birthDateStr) {
                                    const birthDateInput = document.getElementById('birthDate');
                                    const ageInput = document.getElementById('ageStudent');
                                    const birthDate = new Date(birthDateStr);
                                    const today = new Date();

                                    // Check if the date is valid
                                    if (isNaN(birthDate.getTime())) {
                                        return; // Don't trigger anything if the date is incomplete/invalid
                                    }

                                    // Calculate the age
                                    let age = today.getFullYear() - birthDate.getFullYear();
                                    const monthDiff = today.getMonth() - birthDate.getMonth();
                                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                                        age--;  // Adjust age if birthday hasn't occurred yet this year
                                    }

                                    // Check if the age is within the valid range
                                    if (age < 5) {
                                        document.getElementById('ageConfirmation').innerText = "The minimum age allowed is 5.";
                                        document.getElementById('ageDropdown').classList.remove('hidden');
                                        ageInput.value = '';  // Clear age input if below minimum age
                                        birthDateInput.value = ''; // Clear birthdate input as well
                                    } else if (age > 16) {
                                        document.getElementById('ageConfirmation').innerText = "The maximum age allowed is 16.";
                                        document.getElementById('ageDropdown').classList.remove('hidden');
                                        ageInput.value = '';  // Clear age input if above maximum age
                                        birthDateInput.value = ''; // Clear birthdate input as well
                                    } else {
                                        ageInput.value = age;  // Set valid age in the age input field
                                    }
                                }
                            </script>

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

                                    <!-- Region Dropdown -->
                                    <div class="mb-5">
                                        <label for="region" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Region:
                                        </label>
                                        <input type="hidden" name="house_number" id="regionValue">
                                        <select id="region"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            required>
                                            <option value="">Select Region</option>
                                        </select>
                                        <small class="text-red-600 text-xs hidden" id="regionAlert">Region is
                                            required</small>
                                    </div>

                                    <!-- Province Dropdown -->
                                    <div class="mb-5">
                                        <label for="province" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Province:
                                        </label>
                                        <input type="hidden" name="province" id="provinceValue">
                                        <select id="province"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            required>
                                            <option value="">Select Province</option>
                                        </select>
                                        <small class="text-red-600 text-xs hidden" id="provinceAlert">Province
                                            is
                                            required</small>
                                    </div>

                                    <!-- City Dropdown -->
                                    <div class="mb-5">
                                        <label for="city" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>City:
                                        </label>
                                        <input type="hidden" name="city" id="cityValue">
                                        <select id="city"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            required>
                                            <option value="">Select City</option>
                                        </select>
                                        <small class="text-red-600 text-xs hidden" id="cityAlert">City is
                                            required</small>
                                    </div>

                                    <!-- Barangay Dropdown -->
                                    <div class="mb-5">
                                        <label for="barangay" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Barangay:
                                        </label>
                                        <input type="hidden" name="barangay" id="barangayValue">
                                        <select id="barangay"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            required>
                                            <option value="">Select Barangay</option>
                                        </select>
                                        <small class="text-red-600 text-xs hidden" id="barangayAlert">Barangay
                                            is
                                            required</small>
                                    </div>

                                    <!-- Street -->
                                    <div class="mb-5">
                                        <label for="street" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Home/Building/Street:
                                        </label>
                                        <input type="text" name="street" id="street"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            placeholder="Enter Home/building/Street" required>
                                        <small class="text-red-600 text-xs hidden" id="streetAlert">Street is
                                            required</small>
                                    </div>

                                    <script>
                                        document.addEventListener('DOMContentLoaded', function () {
                                            const regionSelect = document.getElementById('region');
                                            const provinceSelect = document.getElementById('province');
                                            const citySelect = document.getElementById('city');
                                            const barangaySelect = document.getElementById('barangay');

                                            // Fetch Regions
                                            fetch('https://psgc.gitlab.io/api/regions.json')
                                                .then(response => response.json())
                                                .then(data => {
                                                    data.forEach(region => {
                                                        const option = document.createElement('option');
                                                        option.value = region.code;
                                                        option.textContent = region.name;
                                                        regionSelect.appendChild(option);
                                                    });


                                                })
                                                .catch(err => console.error('Error fetching regions:', err));




                                            // Event listener for Region change to fetch Provinces or handle NCR
                                            regionSelect.addEventListener('change', function () {
                                                const selectedRegionCode = regionSelect.value;

                                                const selectedOption = regionSelect.options[regionSelect.selectedIndex];
                                                document.getElementById("regionValue").value = selectedOption.textContent;

                                                if (selectedRegionCode === '130000000') {  // If NCR is selected
                                                    // Metro Manila is the "province" in NCR, so set it up.
                                                    const selectProvinceOption = document.createElement('option');
                                                    selectProvinceOption.value = '';
                                                    selectProvinceOption.textContent = 'Select Province';
                                                    const metroManilaOption = document.createElement('option');
                                                    metroManilaOption.value = 'Metro Manila'; // Use a placeholder value for Metro Manila
                                                    metroManilaOption.textContent = 'Metro Manila';
                                                    provinceSelect.innerHTML = '';  // Clear existing provinces
                                                    provinceSelect.appendChild(selectProvinceOption);
                                                    provinceSelect.appendChild(metroManilaOption);  // Add Metro Manila option

                                                    citySelect.innerHTML = '<option value="">Select City</option>';  // Reset city select
                                                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';  // Reset barangay select

                                                    // Update cityValue when a city is selected
                                                    provinceSelect.addEventListener('change', function () {
                                                        const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
                                                        document.getElementById("provinceValue").value = selectedOption.textContent;
                                                    });

                                                    fetchCities(selectedRegionCode);
                                                } else if (selectedRegionCode) {
                                                    fetchProvinces(selectedRegionCode);  // Fetch provinces for the selected region
                                                    fetchCities(selectedRegionCode);
                                                } else {
                                                    provinceSelect.innerHTML = '<option value="">Select Province</option>';
                                                    citySelect.innerHTML = '<option value="">Select City</option>';
                                                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                                                }
                                            });

                                            // Fetch Provinces based on selected Region
                                            function fetchProvinces(regionCode) {
                                                fetch(`https://psgc.gitlab.io/api/regions/${regionCode}/provinces.json`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        provinceSelect.innerHTML = '<option value="">Select Province</option>';
                                                        data.forEach(province => {
                                                            const option = document.createElement('option');
                                                            option.value = province.code;
                                                            option.textContent = province.name;
                                                            provinceSelect.appendChild(option);
                                                        });
                                                        citySelect.innerHTML = '<option value="">Select City</option>'; // Reset city select
                                                        barangaySelect.innerHTML = '<option value="">Select Barangay</option>'; // Reset barangay select
                                                    })
                                                    .catch(err => console.error('Error fetching provinces:', err));

                                                // Update cityValue when a city is selected
                                                provinceSelect.addEventListener('change', function () {
                                                    const selectedOption = provinceSelect.options[provinceSelect.selectedIndex];
                                                    document.getElementById("provinceValue").value = selectedOption.textContent;
                                                });
                                            }

                                            // Event listener for Province change to fetch Cities
                                            provinceSelect.addEventListener('change', function () {
                                                const selectedProvinceCode = provinceSelect.value;
                                                if (selectedProvinceCode) {

                                                } else {
                                                    citySelect.innerHTML = '<option value="">Select City</option>';
                                                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                                                }
                                            });

                                            // Fetch Cities based on selected Region or Province
                                            function fetchCities(regionCodeOrProvinceCode) {
                                                fetch(`https://psgc.gitlab.io/api/regions/${regionCodeOrProvinceCode}/cities.json`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        citySelect.innerHTML = '<option value="">Select City</option>';
                                                        data.forEach(city => {
                                                            const option = document.createElement('option');
                                                            option.value = city.code;
                                                            option.textContent = city.name;
                                                            citySelect.appendChild(option);
                                                        });
                                                        barangaySelect.innerHTML = '<option value="">Select Barangay</option>'; // Reset barangay select
                                                    })
                                                    .catch(err => console.error('Error fetching cities:', err));

                                                // Update cityValue when a city is selected
                                                citySelect.addEventListener('change', function () {
                                                    const selectedOption = citySelect.options[citySelect.selectedIndex];
                                                    document.getElementById("cityValue").value = selectedOption.textContent;
                                                });
                                            }

                                            // Event listener for City change to fetch Barangays
                                            citySelect.addEventListener('change', function () {
                                                const selectedCityCode = citySelect.value;
                                                if (selectedCityCode) {
                                                    fetchBarangays(selectedCityCode);
                                                } else {
                                                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                                                }
                                            });

                                            // Fetch Barangays based on selected City
                                            function fetchBarangays(cityCode) {
                                                fetch(`https://psgc.gitlab.io/api/cities/${cityCode}/barangays.json`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                                                        data.forEach(barangay => {
                                                            const option = document.createElement('option');
                                                            option.value = barangay.code;
                                                            option.textContent = barangay.name;
                                                            barangaySelect.appendChild(option);
                                                        });
                                                    })
                                                    .catch(err => console.error('Error fetching barangays:', err));

                                                barangaySelect.addEventListener('change', function () {
                                                    const selectedOption = barangaySelect.options[barangaySelect.selectedIndex];
                                                    document.getElementById("barangayValue").value = selectedOption.textContent;
                                                });
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <div
                                class=" col-span-4 p-5 rounded-lg shadow-lg border bg-gradient-to-tr from-teal-50 via-gray-100 to-gray-100">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                    <!-- Personal Information -->
                                    <div
                                        class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4w-86 border-b border-b-gray-300 my-5">
                                        <p class="text-[20px] font-bold"><i class="fas fa-address-card mr-2 mb-5"></i>
                                            Parents
                                            Information </p>
                                    </div>

                                    <!-- Father's Information -->
                                    <div class="col-span-4">
                                        <p class="mt-2 text-lg font-bold">Father Information :</p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="fatherLastName" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Father's Last Name:
                                        </label>
                                        <input type="text" name="father_last_name" id="fatherLastName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Father's Last Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="fatherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Father's First Name:
                                        </label>
                                        <input type="text" name="father_first_name" id="fatherFirstName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Father's First Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="fatherMiddleName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            Father's Middle Name:
                                        </label>
                                        <input type="text" name="father_middle_name" id="fatherMiddleName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Father's Middle Name">
                                    </div>

                                    <!-- Father's Suffix Selection -->
                                    <div class="mb-5">
                                        <label for="fatherSuffixName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
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

                                    <div class="mb-5">
                                        <label for="fatherOccupation"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Father's Employee Status:
                                        </label>
                                        <select id="fatherOccupation" name="father_occupation" required
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer">
                                            <option value="" disabled selected>Father's Employee Status:</option>
                                            <option value="employed">Employed</option>
                                            <option value="unemployed">Unemployed</option>
                                            <option value="self-employed">Self-employed</option>
                                        </select>
                                    </div>


                                    <!-- Mother's Information -->
                                    <div class="col-span-4">
                                        <p class="mt-5 text-lg font-bold">Mother Information:</p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="motherLastName" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Mother's Last Name:
                                        </label>
                                        <input type="text" name="mother_last_name" id="motherLastName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Mother's Last Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="motherFirstName" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Mother's First Name:
                                        </label>
                                        <input type="text" name="mother_first_name" id="motherFirstName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Mother's First Name" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="motherMiddleName"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            Mother's Middle Name:
                                        </label>
                                        <input type="text" name="mother_middle_name" id="motherMiddleName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Mother's Middle Name">
                                    </div><br>

                                    <div class="mb-5">
                                        <label for="motherOccupation"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Mother's Employee Status:
                                        </label>
                                        <select id="motherOccupation" name="mother_occupation" required
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer">
                                            <option value="" disabled selected>Mother's Employee Status</option>
                                            <option value="employed">Employed</option>
                                            <option value="unemployed">Unemployed</option>
                                            <option value="self-employed">Self-employed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div
                                class=" col-span-4 p-5 rounded-lg shadow-lg border bg-gradient-to-tr from-teal-50 via-gray-100 to-gray-100">
                                <div
                                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 pb-5 px-5">

                                    <!-- Mother's Information -->
                                    <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                        <p class="mt-5 text-lg font-bold">Guardian Information: </p>
                                    </div>
                                    <div class="col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-4">
                                        <label class="block mb-2 text-sm font-normal text-teal-700 text-sm">( "If
                                            your guardian is your parent or parents, select 'Parent/s'. If your
                                            guardian is a relative other than your parents, select 'Others'. )<span
                                                class="text-red-600">*</span></label>
                                        <div class="flex items-center mb-4 mt-4">
                                            <input type="radio" id="guardianMother" name="guardianType" value="parent"
                                                class="mr-2" onclick="setGuardianInfo('parent')" required>
                                            <label for="guardianParents"
                                                class="mr-4 text-sm font-medium text-gray-900">Parent/s</label>

                                            <input type="radio" id="guardianother" name="guardianType" value="other"
                                                class="mr-2" onclick="setGuardianInfo('other')" required>
                                            <label for="guardianOther"
                                                class="text-sm font-medium text-gray-900">Other</label>
                                        </div>
                                        <small class="text-red-600 text-xs hidden" id="guardianSelectionAlert">Select
                                            Guardian is required</small>
                                    </div>

                                    <!-- Guardian's Information -->
                                    <!-- Guardian's First Name -->
                                    <div class="mb-5 hidden" id="gfname">
                                        <label for="guardianLastName" class="block mb-2 text-sm font-bold text-gray-9000">
                                            <span class="text-red-600 mr-1">*</span>Guardian's Last Name:
                                        </label>
                                        <input type="text" name="guardian_last_name" id="guardianLastName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            placeholder="Enter Guardian's last Name" required>
                                        <small class="text-red-600 text-xs hidden" id="guardianLastNameAlert">Guardian's
                                            Last Name is required</small>
                                    </div>

                                    <!-- Guardian's First Name -->
                                    <div class="mb-5 hidden" id="glname">
                                        <label for="guardianFirstName" class="block mb-2 text-sm font-bold text-gray-9000">
                                            <span class="text-red-600 mr-1">*</span>Guardian's First Name:
                                        </label>
                                        <input type="text" name="guardian_first_name" id="guardianFirstName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            placeholder="Enter Guardian's First Name" required>
                                        <small class="text-red-600 text-xs hidden"
                                            id="guardianFirstNameAlert">Guardian's First Name is
                                            required</small>
                                    </div>

                                    <!-- Guardian's Middle Name -->
                                    <div class="mb-5 hidden" id="gmname">
                                        <label for="guardianMiddleName"
                                            class="block mb-2 text-sm font-bold text-gray-9000">Guardian's Middle
                                            Name:</label>
                                        <input type="text" name="guardian_middle_name" id="guardianMiddleName"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            placeholder="Enter Guardian's Middle Name">
                                        <small class="text-red-600 text-xs hidden"
                                            id="guardianMiddleNameAlert">Guardian's Middle Name is
                                            optional</small>
                                    </div>

                                    <!-- Guardian's Suffix Name -->
                                    <div class="mb-5 hidden" id="gsname">
                                        <label for="guardianSuffixName" class="block mb-2 text-sm font-bold text-gray-9000">Suffix
                                            Name:</label>
                                        <select id="guardianSuffixName" name="guardian_suffix_name"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer">
                                            <option value="">Select Suffix Name</option>
                                            <option value="Jr.">Jr.</option>
                                            <option value="Sr.">Sr.</option>
                                            <option value="II">II</option>
                                            <option value="III">III</option>
                                            <option value="IV">IV</option>
                                            <option value="V">V</option>
                                        </select>
                                    </div>

                                    <!-- Guardian's Relationship -->
                                    <div class="mb-5 hidden" id="grelatioanship">
                                        <label for="guardianRelationship" class="block mb-2 text-sm font-bold text-gray-9000">
                                            <span class="text-red-600 mr-1">*</span>Guardian's Relationship to
                                            Student:
                                        </label>
                                        <div class="relative">
                                            <input type="text" id="guardianRelationship" name="guardian_relationship"
                                                placeholder="Select or type relationship"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                                oninput="filterRelationshipOptions()"
                                                onclick="showGuardianRelationshipList()" required>

                                            <ul id="GuardinRelationshipList"
                                                class="hidden absolute w-full bg-white border border-gray-300 mt-1 rounded shadow-lg max-h-60 overflow-y-auto z-10">
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectRelationshipGuardian('Uncle')">Uncle</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectRelationshipGuardian('Aunt')">Aunt</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectRelationshipGuardian('Grandfather')">
                                                    Grandfather
                                                </li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectRelationshipGuardian('Grandmother')">
                                                    Grandmother
                                                </li>
                                            </ul>
                                        </div>

                                        <small class="text-red-600 text-xs hidden"
                                            id="guardianRelationshipAlert">Guardian's Relationship is
                                            required</small>
                                    </div>

                                    <div class="mb-5 hidden" id="gnumber">
                                        <label for="guardianContactNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Guardian's Contact Number:
                                        </label>
                                        <input type="tel" name="guardian_contact_number" id="guardianContactNumber"
                                            maxlength="11"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                            placeholder="Enter Guardian's Contact Number" required pattern="^09\d{9}$"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^(?!09).*/, '09');"
                                            value="09">
                                        <small class="text-gray-500 text-xs"><span class="text-red-600 hidden"
                                                id="guardianContactNumberAlert">Guardian's Contact Number must be 11
                                                digits</span></small>
                                    </div>
                                    <script>
                                        document.getElementById('guardianContactNumber').addEventListener('input',
                                            function () {
                                                const guardianContactNumberAlert = document
                                                    .getElementById('guardianContactNumberAlert');
                                                if (this.value === null || this.value === '09') {
                                                    guardianContactNumberAlert.classList.add('hidden');
                                                    document.getElementById('guardianContactNumber').classList
                                                        .remove('border-red-500');
                                                } else if (this.value.length !== 11) {
                                                    guardianContactNumberAlert.classList.remove('hidden');
                                                    document.getElementById('guardianContactNumber').classList
                                                        .add('border-red-500');
                                                } else {
                                                    guardianContactNumberAlert.classList.add('hidden');
                                                    document.getElementById('guardianContactNumber').classList
                                                        .remove('border-red-500');
                                                }
                                            });
                                    </script>

                                    <div class="mb-5 hidden" id="greligion">
                                        <label for="guardianReligion" class="block mb-2 text-sm font-bold text-gray-9000">
                                            <span class="text-red-600 mr-1">*</span>Religion
                                        </label>

                                        <!-- Custom dropdown with search -->
                                        <div class="relative">
                                            <input type="text" id="guardianReligion" name="guardian_religion"
                                                placeholder="Select or type religion"
                                                class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none peer"
                                                oninput="filterReligionOptions()" onclick="showGuardianReligionList()"
                                                required>

                                            <ul id="guardianReligionList"
                                                class="hidden absolute w-full bg-white border border-gray-300 mt-1 rounded shadow-lg max-h-60 overflow-y-auto z-10">
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Roman Catholicism')">Roman
                                                    Catholic
                                                </li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Protestantism')">
                                                    Protestantism
                                                </li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Islam')">Islam</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Iglesia ni Cristo')">
                                                    Iglesia ni
                                                    Cristo
                                                </li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Hinduism')">Hinduism</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Buddhism')">Buddhism</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Indigenous Beliefs')">
                                                    Indigenous
                                                    Beliefs</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Atheism and Agnosticism')">
                                                    Atheism and
                                                    Agnosticism</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Sikhism')">Sikhism</li>
                                                <li class="px-3 py-2 cursor-pointer hover:bg-gray-200"
                                                    onclick="selectReligionGuardian('Zoroastrianism')">
                                                    Zoroastrianism</li>
                                            </ul>
                                        </div>

                                        <small class="text-red-600 text-xs hidden" id="guardianReligionAlert">Religion
                                            is
                                            required</small>
                                    </div>

                                    <script>
                                        // Function to show the list when clicked
                                        function showGuardianReligionList() {
                                            const listGuardian = document.getElementById('guardianReligionList');
                                            listGuardian.classList.remove('hidden');
                                        }

                                        // Function to show the list when clicked
                                        function showGuardianRelationshipList() {
                                            const listGuardianRelation = document.getElementById('GuardinRelationshipList');
                                            listGuardianRelation.classList.remove('hidden');
                                        }

                                        // Function to select a religion option
                                        function selectReligionGuardian(religion) {
                                            const inputGuardian = document.getElementById('guardianReligion');
                                            const listGuardian = document.getElementById('guardianReligionList');

                                            inputGuardian.value = religion;
                                            listGuardian.classList.add('hidden'); // Hide dropdown after selection

                                            // Optionally, validate religion
                                            validateReligionGuardian();
                                        }

                                        // Function to select a relationship option
                                        function selectRelationshipGuardian(relation) {
                                            const inputGuardianRelation = document.getElementById('guardianRelationship');
                                            const listGuardianRelation = document.getElementById('GuardinRelationshipList');

                                            inputGuardianRelation.value = relation;
                                            listGuardianRelation.classList.add('hidden'); // Hide dropdown after selection

                                            // Optionally, validate relationship
                                            validateReligionGuardianRelation();
                                        }

                                        // Validation to check if a religion is selected
                                        function validateReligionGuardian() {
                                            const religionInputGuardian = document.getElementById('guardianReligion');
                                            const religionAlertGuardian = document.getElementById('guardianReligionAlert');

                                            if (religionInputGuardian.value === "") {
                                                religionAlertGuardian.classList.remove('hidden');
                                            } else {
                                                religionAlertGuardian.classList.add('hidden');
                                            }
                                        }

                                        // Validation to check if a relationship is selected
                                        function validateReligionGuardianRelation() {
                                            const religionInputGuardianRelation = document.getElementById('guardianRelationship');
                                            const religionAlertGuardianRelation = document.getElementById('guardianRelationshipAlert');

                                            if (religionInputGuardianRelation.value === "") {
                                                religionAlertGuardianRelation.classList.remove('hidden');
                                            } else {
                                                religionAlertGuardianRelation.classList.add('hidden');
                                            }
                                        }

                                        // Close the dropdown when clicked outside
                                        document.addEventListener('click', function (event) {
                                            const list = document.getElementById('guardianReligionList');
                                            const input = document.getElementById('guardianReligion');
                                            const listGuardian = document.getElementById('GuardinRelationshipList');
                                            const inputGuardian = document.getElementById('guardianRelationship');

                                            if (!input.contains(event.target) && !list.contains(event.target)) {
                                                list.classList.add('hidden');
                                            }

                                            if (!inputGuardian.contains(event.target) && !listGuardian.contains(event.target)) {
                                                listGuardian.classList.add('hidden');
                                            }
                                        });


                                        function setGuardianInfo(type) {
                                            const motherFirstName = document.getElementById('motherFirstName').value;
                                            const motherLastName = document.getElementById('motherLastName').value;
                                            const motherMiddleName = document.getElementById('motherMiddleName').value; // Get mother's middle name

                                            const fatherFirstName = document.getElementById('fatherFirstName').value;
                                            const fatherLastName = document.getElementById('fatherLastName').value;
                                            const fatherMiddleName = document.getElementById('fatherMiddleName').value; // Get father's middle name
                                            const fatherSuffix = document.getElementById('fatherSuffixName').value;

                                            const guardianRelationship = document.getElementById('guardianRelationship');

                                            if (type === 'parent') {
                                                document.getElementById('guardianFirstName').value = "N/A";
                                                document.getElementById('guardianLastName').value = "N/A";
                                                document.getElementById('guardianMiddleName').value = "N/A"; // Set middle name
                                                document.getElementById('guardianSuffixName').value = ""; // Reset suffix when choosing mother
                                                document.getElementById('guardianRelationship').value = "N/A";
                                                document.getElementById('guardianReligion').value = "N/A";
                                                document.getElementById('guardianContactNumber').value = "09000000000";
                                                document.getElementById('gfname').classList.add('hidden');
                                                document.getElementById('glname').classList.add('hidden');
                                                document.getElementById('gmname').classList.add('hidden');
                                                document.getElementById('gsname').classList.add('hidden');
                                                document.getElementById('grelatioanship').classList.add('hidden');
                                                document.getElementById('gnumber').classList.add('hidden');
                                                document.getElementById('greligion').classList.add('hidden');
                                                document.getElementById('emergencyContactInfo').classList.add('hidden');
                                            } else if (type === 'other') {
                                                document.getElementById('gfname').classList.remove('hidden');
                                                document.getElementById('glname').classList.remove('hidden');
                                                document.getElementById('gmname').classList.remove('hidden');
                                                document.getElementById('gsname').classList.remove('hidden');
                                                document.getElementById('grelatioanship').classList.remove('hidden');
                                                document.getElementById('gnumber').classList.remove('hidden');
                                                document.getElementById('greligion').classList.remove('hidden');
                                                document.getElementById('guardianFirstName').value = "";
                                                document.getElementById('guardianLastName').value = "";
                                                document.getElementById('guardianMiddleName').value = ""; // Set middle name
                                                document.getElementById('guardianSuffixName').value = ""; // Reset suffix when choosing mother
                                                document.getElementById('guardianRelationship').value = "";
                                                document.getElementById('guardianReligion').value = "";
                                                document.getElementById('guardianContactNumber').value = "09";
                                                document.getElementById('emergencyContactInfo').classList.add('hidden');
                                            }
                                        }
                                    </script>

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
                                            Emergency Contact Information< </p>
                                    </div>

                                    <div class="mb-5">
                                        <label for="emergencyContactPerson"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Emergency Contact Person:
                                        </label>
                                        <input type="text" name="emergency_contact_person" id="emergencyContactPerson"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Emergency Contact Person" required>
                                    </div>

                                    <div class="mb-5">
                                        <label for="emergencyContactNumber"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Emergency Contact Number:
                                        </label>
                                        <input type="tel" name="emergency_contact_number" id="emergencyContactNumber"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Enter Emergency Contact Number" required pattern="^09\d{9}$"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/^(?!09).*/, '09');" value="09">
                                        <small class="text-gray-500 text-xs"><span class="text-red-600 hidden" id="contactNoAlertEmergency">Contact
                                                Number must be 11 digits</span></small>
                                    </div>
                                    <script>
                                        document.getElementById('emergencyContactNumber').addEventListener('input',
                                            function () {
                                                const contactNoAlert = document.getElementById('contactNoAlertEmergency');
                                                if (this.value === null || this.value === '09') {
                                                    contactNoAlert.classList.add('hidden');
                                                    document.getElementById('emergencyContactNumber').classList.remove('border-red-500');
                                                } else if (this.value.length !== 11) {
                                                    contactNoAlert.classList.remove('hidden');
                                                    document.getElementById('emergencyContactNumber').classList.add('border-red-500');
                                                } else {
                                                    contactNoAlert.classList.add('hidden');
                                                    document.getElementById('emergencyContactNumber').classList.remove('border-red-500');
                                                }
                                            });
                                    </script>

                                    <div class="mb-5">
                                        <label for="emailAddress" class="block mb-2 text-sm font-bold text-gray-900">
                                            <span class="text-red-600 mr-1">*</span>Email Address:
                                        </label>
                                        <input type="email" name="email_address" id="emailAddress"
                                            class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="Ex. StEmilieLearningCenter@gmail.com" required
                                            pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                            title="Please enter a valid Gmail address.">
                                        <small class="text-gray-500 text-xs"><span class="text-red-600 hidden" id="emailAlertEmergency">Email must be
                                                @gmail.com</span></small>
                                    </div>
                                    <script>
                                        document.getElementById('emailAddress').addEventListener('input', function () {
                                            const emailAlert = document.getElementById('emailAlertEmergency');
                                            if (this.value === null || this.value === '') {
                                                emailAlert.classList.add('hidden');
                                                document.getElementById('emailAddress').classList.remove('border-red-500');
                                            } else if (!this.value.endsWith('@gmail.com')) {
                                                emailAlert.classList.remove('hidden');
                                                document.getElementById('emailAddress').classList.add('border-red-500');
                                            } else {
                                                emailAlert.classList.add('hidden');
                                                document.getElementById('emailAddress').classList.remove('border-red-500');
                                            }
                                        });
                                    </script>

                                    

                                    <div class="mb-5">
                                        <label for="messengerAccount"
                                            class="block mb-2 text-sm font-bold text-gray-900">
                                            Messenger Account (optional):
                                        </label>
                                        <input type="text" name="messenger_account" id="messengerAccount"
                                            class="block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                            placeholder="e.g., Facebook Messenger ID">
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
                                            Student Documents</p>
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
                                        <div class="mt-2 text-gray-600" id="sf9New">No file chosen
                                        </div>
                                    </div>
                                </div>
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
                    const username = lastNameInput.value.toLowerCase().replace(/\s/g, '') + firstNameInput.value.toLowerCase().replace(/\s/g, '') + '@stemilie.edu.ph';
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
                    const username = lastNameInput.value.toLowerCase().replace(/\s/g, '') + firstNameInput.value.toLowerCase().replace(/\s/g, '') + '@stemilie.edu.ph';
                    usernameInput.value = username;
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
                            document.querySelector("#sf9New").textContent = this
                                .files[0]
                                ? this.files[0].name
                                : "No file chosen";
                        });
                });
            </script>
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