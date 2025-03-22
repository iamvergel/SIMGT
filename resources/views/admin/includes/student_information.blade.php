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
                @if ($students)
                                <div id="studentModal" class="relative w-full min-h-screen bg-gray-100">
                                    <div class="relative">
                                        <div class="w-full h-full bg-white rounded-lg shadow p-5">
                                            <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                                            <p class="text-2xl font-bold text-teal-900 ml-5">
                                                <span
                                                    onclick="window.location.href ='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
                                                    class="hover:text-teal-700">Student Management /
                                                </span>{{ $studentsPrimary->grade }} /
                                                {{ $students->student_last_name }}, {{ $students->student_first_name }}
                                                {{ $students->student_suffix_name }} {{ $students->student_middle_name }} | S.Y.
                                                {{ $studentsPrimary->school_year }}
                                            </p>
                                            <div class="flex justify-start  my-8"><button onclick="window.history.back();"
                                                    class="text-[12px] text-white shadow-lg bg-sky-700 rounded-full shadow hover:bg-sky-600 px-3 mt-3"><i
                                                        class="fas fa-arrow-left" style="color: white;"></i>
                                                    Go Back</button>

                                            </div>

                                            <div class="mt-5 text-[14px] font-semibold w-full">
                                                <ul
                                                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-8 gap-0 xl:gap-0 bg-gray-50 p-0 m-0">
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 active1 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#Information">SIMGT</li>
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#documents">Documents</li>
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#gradeOne">Grade One</li>
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#gradeTwo">Grade Two</li>
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#gradeThree">Grade Three</li>
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#gradeFour">Grade Four</li>
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#gradeFive">Grade Five</li>
                                                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1"
                                                        data-target="#gradeSix">Grade Six</li>
                                                </ul>
                                            </div>

                                            <!-- Student Details -->
                                            <div
                                                class="grid grid-cols-5 mt-5 xl:mt-0 xl:grid-cols-6 border-0 border-t-4 border-teal-800 h-full pt-5">
                                                <div class="col-span-5 lg:col-span-2 rounded-lg rounded-bl-xl bg-gray-100">
                                                    <!-- Profile Section -->
                                                    <div class=" p-5 h-auto">
                                                        <div class="bg-white py-5 rounded-lg shadow-ms">
                                                            <div class="flex justify-center mt-5 ">
                                                                @php
                                                                    $avatar = $studentAccount && $studentAccount->avatar ? asset('storage/' . $studentAccount->avatar) : null;
                                                                    $initials = strtoupper(substr($students->student_last_name, 0, 1) . substr($students->student_first_name, 0, 1));
                                                                @endphp
                                                                <div
                                                                    class="w-36 h-36 xl:w-36 xl:h-36 border-[3px] border-teal-800 text-[50px] rounded-full bg-teal-700 text-white flex items-center justify-center font-bold mx-2">
                                                                    @if ($avatar)
                                                                        <img src="{{ $avatar }}" alt="Student Avatar"
                                                                            class="w-full h-full rounded-full object-cover">
                                                                    @else


                                                                        {{ $initials }}
                                                                    @endif



                                                                </div>
                                                            </div>
                                                            <div class="text-center mt-5 text-teal-800 ">
                                                                <p
                                                                    class="text-md tracking-widest font-semibold  shadow-text-lg mt-2 leading-3">
                                                                    {{ $students->student_last_name }},
                                                                    {{ $students->student_first_name }}
                                                                    {{ $students->student_suffix_name }}
                                                                    {{ $students->student_middle_name }}
                                                                </p>
                                                                <span
                                                                    class="text-xs tracking-widest font-normal shadow-text-lg mt-0">{{ $studentAccount->username ?? 'no username'}}</span>
                                                                <p class="text-xs">
                                                                    Student
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <hr class="border-1 border-gray-400 mt-10">
                                                        <div
                                                            class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-2 2xl:grid-cols-2 gap-3 2xl:gap-5 mt-10 text-[13px] text-gray-900">
                                                            <div class="col-span-1 lg:col-span-2 ">
                                                                <label for="modalLrn"
                                                                    class="block mb-2 text-[14px] font-bold text-gray-900">Learner
                                                                    Reference Number (LRN):</label>
                                                                {{ $students->lrn }}
                                                            </div>

                                                            <div>
                                                                <label for="modalStudentNumber"
                                                                    class="block text-[14px] font-bold text-gray-900">Student Number
                                                                    :</label>
                                                                {{ $students->student_number }}
                                                            </div>

                                                            <div
                                                                class="font-bold
                                                                {{ $studentsPrimary->status == 'Dropped' ? 'text-red-500' : ($studentsPrimary->status == 'Graduated' ? 'text-blue-500' : ($studentsPrimary->status == 'Enrolled' ? 'text-green-500' : 'text-violet-500')) }}">
                                                                <label for="modalStatus"
                                                                    class="block text-[14px] font-bold text-gray-900">Status :</label>
                                                              {{ $studentsPrimary->status }}
                                                            </div>

                                                            <div>
                                                                <label for="modalGrade"
                                                                    class="block text-[14px] font-bold text-gray-900">Grade:</label>
                                                                {{ $studentsPrimary->grade }}
                                                            </div>

                                                            <div>
                                                                <label for="modalSection"
                                                                    class="block text-[14px] font-bold text-gray-900">Section:</label>
                                                                {{ $studentsPrimary->section }}
                                                            </div>

                                                            <div class="col-span-1 lg:col-span-2 mt-5 text-[16px] font-semibold">
                                                                <hr class="border-1 border-gray-400 mb-3">
                                                                <p>Personal Information</p>
                                                            </div>


                                                            <div>
                                                                <label for="modalPlaceOfBirth"
                                                                    class="block text-[14px] font-bold text-gray-900">Place of
                                                                    Birth:</label>
                                                                {{ $students->place_of_birth }}
                                                            </div>

                                                            <div>
                                                                <label for="modalBirthDate"
                                                                    class="block text-[14px] font-bold text-gray-900">Birth
                                                                    Date:</label>
                                                                {{ $students->birth_date }}
                                                            </div>

                                                            <div>
                                                                <label for="modalAge"
                                                                    class="block text-[14px] font-bold text-gray-900">Age:</label>
                                                                {{ $students->age }}
                                                            </div>

                                                            <div>
                                                                <label for="modalSex"
                                                                    class="block text-[14px] font-bold text-gray-900">Sex:</label>
                                                                {{ $students->sex }}
                                                            </div>

                                                            <div>
                                                                <label for="modalReligion"
                                                                    class="block text-[14px] font-bold text-gray-900">Religion:</label>
                                                                {{ $students->religion }}
                                                            </div>

                                                            <div class="col-span-1 lg:col-span-2 mt-5 text-[16px] font-semibold">
                                                                <hr class="border-1 border-gray-400 mb-3">
                                                                <p>Contact Information</p>
                                                            </div>


                                                            <div class="col-span-1 lg:col-span-2">
                                                                <label for="modalEmail"
                                                                    class="block text-[14px] font-bold text-gray-900">Email:</label>
                                                                {{ $students->email_address_send}}
                                                            </div>

                                                            <div class="col-span-1 lg:col-span-2">
                                                                <label for="modalContactNumber"
                                                                    class="block text-[14px] font-bold text-gray-900">Contact
                                                                    Number:</label>
                                                                {{ $students->contact_number}}
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-span-5 lg:col-span-3 xl:col-span-4 px-5">
                                                    <!-- <div class="col-span-3 my-5 flex justify-start">
                                                                                                                                        <button id="btnPrint"
                                                                                                                                            class="text-[12px] text-white shadow-lg bg-sky-700 rounded-lg shadow hover:bg-sky-600 px-3 mt-3"><i
                                                                                                                                                class="fas fa-file-pdf mr-2"></i>Download Reports
                                                                                                                                            Grade</button>
                                                                                                                                    </div> -->

                                                    <!-- Scheduled Table -->
                                                    <div class="table-container w-full mt-0 pb-10" id="Information">
                                                        <div class="grid grid-cols-4 gap-4">
                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div
                                                                    class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Address</p>
                                                                        <p class="text-sm">{{ $students->house_number }}
                                                                            {{ $students->street }}
                                                                            {{ $students->barangay }}
                                                                            {{ $students->city }}, {{ $students->province }}
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <i
                                                                            class="fa-solid fa-map-location-dot text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div
                                                                    class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Father's Information</p>
                                                                        <p class="text-sm">Name :
                                                                            {{ $studentsAdditional->father_last_name }},
                                                                            {{ $studentsAdditional->father_first_name }}
                                                                            {{ $studentsAdditional->father_middle_name }}
                                                                            {{ $studentsAdditional->father_suffix }}
                                                                        </p>
                                                                        <p class="text-sm">Occupation :
                                                                            {{ $studentsAdditional->father_occupation }}
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <i
                                                                            class="fa-solid fa-address-card text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div
                                                                    class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Mother's Information</p>
                                                                        <p class="text-sm">Name :
                                                                            {{ $studentsAdditional->mother_last_name }},
                                                                            {{ $studentsAdditional->mother_first_name }}
                                                                            {{ $studentsAdditional->mother_middle_name }}
                                                                        </p>
                                                                        <p class="text-sm">Occupation :
                                                                            {{ $studentsAdditional->mother_occupation }}
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <i
                                                                            class="fa-solid fa-address-card text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div
                                                                    class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Guardian's Information</p>
                                                                        <p class="text-sm">Name :
                                                                            {{ $studentsAdditional->guardian_last_name }},
                                                                            {{ $studentsAdditional->guardian_first_name }}
                                                                            {{ $studentsAdditional->guardian_middle_name }}
                                                                            {{ $studentsAdditional->guadian_suffix }}
                                                                        </p>
                                                                        <p class="text-sm">Relationship to Student :
                                                                            {{ $studentsAdditional->guardian_relationship }}
                                                                        </p>
                                                                        <p class="text-sm">guardian Religion :
                                                                            {{ $studentsAdditional->guardian_religion }}
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <i
                                                                            class="fa-solid fa-address-card text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div
                                                                    class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Contact Information</p>
                                                                        <p class="text-sm">Name :
                                                                            {{ $studentsAdditional->emergency_contact_person }}
                                                                        </p>
                                                                        <p class="text-sm">Contact Number :
                                                                            {{ $studentsAdditional->emergency_contact_number }}
                                                                        </p>
                                                                        <p class="text-sm">Email Address :
                                                                            {{ $studentsAdditional->email_address }}
                                                                        </p>
                                                                        <p class="text-sm">Messenger Account :
                                                                            {{ $studentsAdditional->messenger_account }}
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <i
                                                                            class="fa-solid fa-address-card text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- documents -->
                                                    <div class="table-container" id="documents" style="display:none;">
                                                        <div class="grid grid-cols-4 mt-0 gap-4">
                                                            <div class="col-span-1 my-5 flex justify-start">
                                                                <button
                                                                    onclick="window.open('{{ asset('storage/' . $studentDocuments->birth_certificate) }}')"
                                                                    class="w-full text-[12px] text-white text-start px-5 shadow-lg bg-sky-700 rounded-lg hover:bg-sky-600 px-3 mt-3 group relative">
                                                                    <i class="fa-solid fa-file me-2 text-sm"></i>Birth Certificate
                                                                    <div
                                                                        class="absolute w-full opacity-0 -top-[-2.8rem] rounded-md py-2 px-2 bg-sky-700 bg-opacity-70 left-1/2 -translate-x-1/2 group-hover:opacity-100 transition-opacity shadow-lg">
                                                                        @if (pathinfo($studentDocuments->birth_certificate, PATHINFO_EXTENSION) === 'pdf')
                                                                            <i class="fa-solid fa-file-pdf text-white me-2"></i> PDF
                                                                        @else


                                                                            <img src="{{ asset('storage/' . $studentDocuments->birth_certificate) }}"
                                                                                alt="{{ $students->student_first_name }}" width="500">
                                                                        @endif


                                                                    </div>
                                                                </button>

                                                            </div>

                                                            <div class="col-span-1 my-5 flex justify-startt">
                                                                <button
                                                                    onclick="window.open('{{ asset('storage/' . $studentDocuments->sf10) }}')"
                                                                    class="w-full text-[12px] text-start px-5 text-white shadow-lg bg-sky-700 rounded-lg hover:bg-sky-600 px-3 mt-3 group relative"><i
                                                                        class="fa-solid fa-file me-2 text-sm"></i>SCHOOL FORM 10 (SF10)
                                                                    <div
                                                                        class="absolute w-full opacity-0 -top-[-2.8rem] rounded-md py-2 px-2 bg-sky-700 bg-opacity-70 left-1/2 -translate-x-1/2 group-hover:opacity-100 transition-opacity shadow-lg">
                                                                        @if (pathinfo($studentDocuments->sf10, PATHINFO_EXTENSION) === 'pdf')
                                                                            <i class="fa-solid fa-file-pdf text-white me-2"></i> PDF
                                                                        @else


                                                                            <img src="{{ asset('storage/' . $studentDocuments->sf10) }}"
                                                                                alt="{{ $students->student_first_name }}" width="500">
                                                                        @endif


                                                                    </div>
                                                                </button>
                                                            </div>

                                                            @if($studentDocuments && $studentDocuments->sf9)
                                                                <div class="col-span-1 my-5 flex justify-start">
                                                                    <button
                                                                        onclick="window.open('{{ asset('storage/' . $studentDocuments->sf9) }}')"
                                                                        class="w-full text-[12px] text-start px-5 text-white shadow-lg bg-sky-700 rounded-lg hover:bg-sky-600 px-3 mt-3 group relative"><i
                                                                            class="fa-solid fa-file me-2 text-sm"></i>SCHOOL FORM 9 (SF9)
                                                                        <div
                                                                            class="absolute w-full opacity-0 -top-[-2.8rem] rounded-md py-2 px-2 bg-sky-700 bg-opacity-70 left-1/2 -translate-x-1/2 group-hover:opacity-100 transition-opacity shadow-lg">
                                                                            @if (pathinfo($studentDocuments->sf9, PATHINFO_EXTENSION) === 'pdf')
                                                                                <i class="fa-solid fa-file-pdf text-white me-2"></i> PDF
                                                                            @else
                                                                                <img src="{{ asset('storage/' . $studentDocuments->sf9) }}"
                                                                                    alt="{{ $students->student_first_name }}" width="500">
                                                                            @endif
                                                                        </div>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="table-container w-full" id="gradeOne" style="display: none;">
                                                        <div class="my-10">
                                                            @if (isset($finalGradeOne[0]->grade) && $finalGradeOne[0]->grade == "Grade One")
                                                                <h2 class="text-lg font-semibold">{{ $finalGradeOne[0]->grade }} ||
                                                                    {{ $finalGradeOne[0]->school_year }} || Section :
                                                                    {{ $finalGradeOne[0]->section }}
                                                                </h2>
                                                            @endif
                                                        </div>
                                                        <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">

                                                            <table class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Learning Areas
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" colspan="4">
                                                                            Periodic Rating
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Final Grade
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Remarks
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="border border-gray-600 export">1</th>
                                                                        <th class="border border-gray-600 export">2</th>
                                                                        <th class="border border-gray-600 export">3</th>
                                                                        <th class="border border-gray-600 export">4</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $gradeOneExists = false;
                                                                        $totalFinalGrade = 0;
                                                                        $count = 0;
                                                                        $allGradesAvailable = true; // Variable to check if all grades are available
                                                                    @endphp

                                                                    @foreach ($finalGradeOne as $grades)
                                                                                                                @if ($grades->grade == "Grade One")
                                                                                                                                                            @php
                                                                                                                                                                $gradeOneExists = true;
                                                                                                                                                                $totalFinalGrade += $grades->final_grade;
                                                                                                                                                                $count++;

                                                                                                                                                                // Check if all quarterly grades are available
                                                                                                                                                                if (
                                                                                                                                                                    empty($grades->first_quarter_grade) || empty($grades->second_quarter_grade) ||
                                                                                                                                                                    empty($grades->third_quarter_grade) || empty($grades->fourth_quarter_grade) ||
                                                                                                                                                                    empty($grades->final_grade)
                                                                                                                                                                ) {
                                                                                                                                                                    $allGradesAvailable = false;
                                                                                                                                                                }
                                                                                                                                                            @endphp
                                                                                                                                                            <tr class="subject-row">
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grades->subject }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grades->first_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grades->second_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grades->third_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grades->fourth_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grades->final_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    @if (empty($grades->final_grade))
                                                                                                                                                                        <!-- No final grade available -->
                                                                                                                                                                    @elseif ($grades->final_grade < 75)
                                                                                                                                                                        Failed
                                                                                                                                                                    @else


                                                                                                                                                                        Passed
                                                                                                                                                                    @endif


                                                                                                                                                                </td>
                                                                                                                                                            </tr>
                                                                                                                @endif


                                                                    @endforeach

                                                                    @if (!$gradeOneExists)
                                                                        <tr>
                                                                            <td colspan="7" class="text-center border-2 px-4 py-2">No Data
                                                                                Available</td>
                                                                        </tr>
                                                                    @endif


                                                                </tbody>

                                                                @if ($allGradesAvailable && $count > 0)
                                                                                                            <tfoot>
                                                                                                                <tr>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        General Average</td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @php
                                                                                                                            $finalGrade = round($totalFinalGrade / $count, 2);
                                                                                                                            if ($finalGrade >= 100) {
                                                                                                                                $grade = 100;
                                                                                                                            } elseif ($finalGrade >= 98.40) {
                                                                                                                                $grade = 99;
                                                                                                                            } elseif ($finalGrade >= 96.80) {
                                                                                                                                $grade = 98;
                                                                                                                            } elseif ($finalGrade >= 95.20) {
                                                                                                                                $grade = 97;
                                                                                                                            } elseif ($finalGrade >= 93.60) {
                                                                                                                                $grade = 96;
                                                                                                                            } elseif ($finalGrade >= 92.00) {
                                                                                                                                $grade = 95;
                                                                                                                            } elseif ($finalGrade >= 90.40) {
                                                                                                                                $grade = 94;
                                                                                                                            } elseif ($finalGrade >= 88.80) {
                                                                                                                                $grade = 93;
                                                                                                                            } elseif ($finalGrade >= 87.20) {
                                                                                                                                $grade = 92;
                                                                                                                            } elseif ($finalGrade >= 85.60) {
                                                                                                                                $grade = 91;
                                                                                                                            } elseif ($finalGrade >= 84.00) {
                                                                                                                                $grade = 90;
                                                                                                                            } elseif ($finalGrade >= 82.40) {
                                                                                                                                $grade = 89;
                                                                                                                            } elseif ($finalGrade >= 80.80) {
                                                                                                                                $grade = 88;
                                                                                                                            } elseif ($finalGrade >= 79.20) {
                                                                                                                                $grade = 87;
                                                                                                                            } elseif ($finalGrade >= 77.60) {
                                                                                                                                $grade = 86;
                                                                                                                            } elseif ($finalGrade >= 76.00) {
                                                                                                                                $grade = 85;
                                                                                                                            } elseif ($finalGrade >= 74.40) {
                                                                                                                                $grade = 84;
                                                                                                                            } elseif ($finalGrade >= 72.80) {
                                                                                                                                $grade = 83;
                                                                                                                            } elseif ($finalGrade >= 71.20) {
                                                                                                                                $grade = 82;
                                                                                                                            } elseif ($finalGrade >= 69.60) {
                                                                                                                                $grade = 81;
                                                                                                                            } elseif ($finalGrade >= 68.00) {
                                                                                                                                $grade = 80;
                                                                                                                            } elseif ($finalGrade >= 66.40) {
                                                                                                                                $grade = 79;
                                                                                                                            } elseif ($finalGrade >= 64.80) {
                                                                                                                                $grade = 78;
                                                                                                                            } elseif ($finalGrade >= 63.20) {
                                                                                                                                $grade = 77;
                                                                                                                            } elseif ($finalGrade >= 61.60) {
                                                                                                                                $grade = 76;
                                                                                                                            } elseif ($finalGrade >= 60.00) {
                                                                                                                                $grade = 75;
                                                                                                                            } elseif ($finalGrade >= 56.00) {
                                                                                                                                $grade = 74;
                                                                                                                            } elseif ($finalGrade >= 52.00) {
                                                                                                                                $grade = 73;
                                                                                                                            } elseif ($finalGrade >= 48.00) {
                                                                                                                                $grade = 72;
                                                                                                                            } elseif ($finalGrade >= 44.00) {
                                                                                                                                $grade = 71;
                                                                                                                            } elseif ($finalGrade >= 40.00) {
                                                                                                                                $grade = 70;
                                                                                                                            } elseif ($finalGrade >= 36.00) {
                                                                                                                                $grade = 69;
                                                                                                                            } elseif ($finalGrade >= 32.00) {
                                                                                                                                $grade = 68;
                                                                                                                            } elseif ($finalGrade >= 28.00) {
                                                                                                                                $grade = 67;
                                                                                                                            } elseif ($finalGrade >= 24.00) {
                                                                                                                                $grade = 66;
                                                                                                                            } elseif ($finalGrade >= 20.00) {
                                                                                                                                $grade = 65;
                                                                                                                            } elseif ($finalGrade >= 16.00) {
                                                                                                                                $grade = 64;
                                                                                                                            } elseif ($finalGrade >= 12.00) {
                                                                                                                                $grade = 63;
                                                                                                                            } elseif ($finalGrade >= 8.00) {
                                                                                                                                $grade = 62;
                                                                                                                            } elseif ($finalGrade >= 4.00) {
                                                                                                                                $grade = 61;
                                                                                                                            } else {
                                                                                                                                $grade = 60;
                                                                                                                            }
                                                                                                                        @endphp

                                                                                                                        {{ $grade }}
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @if (round($grade, 2) < 75)
                                                                                                                            Failed
                                                                                                                        @else





                                                                                                                            Passed
                                                                                                                        @endif





                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tfoot>
                                                                @endif


                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="table-container w-full" id="gradeTwo" style="display: none;">
                                                        <div class="my-10">
                                                            @if (isset($finalGradeTwo[0]->grade) && $finalGradeTwo[0]->grade == "Grade Two")
                                                                <h2 class="text-lg font-semibold">{{ $finalGradeTwo[0]->grade }} ||
                                                                    {{ $finalGradeTwo[0]->school_year }} || Section :
                                                                    {{ $finalGradeTwo[0]->section }}
                                                                </h2>
                                                            @endif

                                                        </div>
                                                        <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                            <table class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Learning Areas
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" colspan="4">
                                                                            Periodic Rating
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Final Grade
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Remarks
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="border border-gray-600 export">1</th>
                                                                        <th class="border border-gray-600 export">2</th>
                                                                        <th class="border border-gray-600 export">3</th>
                                                                        <th class="border border-gray-600 export">4</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $gradeTwoExists = false;
                                                                        $totalFinalGrade = 0;
                                                                        $count = 0;
                                                                        $allGradesAvailable = true; // Variable to check if all grades are available
                                                                    @endphp

                                                                    @foreach ($finalGradeTwo as $gradeTwo)
                                                                                                                @if ($gradeTwo && $gradeTwo->grade == "Grade Two")
                                                                                                                                                            @php
                                                                                                                                                                $gradeTwoExists = true;
                                                                                                                                                                $totalFinalGrade += $gradeTwo->final_grade;
                                                                                                                                                                $count++;

                                                                                                                                                                // Check if all quarterly grades are available
                                                                                                                                                                if (
                                                                                                                                                                    empty($gradeTwo->first_quarter_grade) || empty($gradeTwo->second_quarter_grade) ||
                                                                                                                                                                    empty($gradeTwo->third_quarter_grade) || empty($gradeTwo->fourth_quarter_grade) ||
                                                                                                                                                                    empty($gradeTwo->final_grade)
                                                                                                                                                                ) {
                                                                                                                                                                    $allGradesAvailable = false;
                                                                                                                                                                }
                                                                                                                                                            @endphp
                                                                                                                                                            <tr class="subject-row">
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeTwo->subject }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeTwo->first_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeTwo->second_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeTwo->third_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeTwo->fourth_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeTwo->final_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    @if (empty($gradeTwo->final_grade))
                                                                                                                                                                        <!-- No final grade available -->
                                                                                                                                                                    @elseif ($gradeTwo->final_grade < 75)
                                                                                                                                                                        Failed
                                                                                                                                                                    @else

                                                                                                                                                                        Passed
                                                                                                                                                                    @endif

                                                                                                                                                                </td>
                                                                                                                                                            </tr>
                                                                                                                @endif

                                                                    @endforeach

                                                                    @if (!$gradeTwoExists)
                                                                        <tr>
                                                                            <td colspan="7" class="text-center border-2 px-4 py-2">No Grades
                                                                                Available</td>
                                                                        </tr>
                                                                    @endif

                                                                </tbody>

                                                                @if ($allGradesAvailable && $count > 0)
                                                                                                            <tfoot>
                                                                                                                <tr>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        General Average</td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @php
                                                                                                                            $finalGrade = round($totalFinalGrade / $count, 2);
                                                                                                                            if ($finalGrade >= 100) {
                                                                                                                                $grade = 100;
                                                                                                                            } elseif ($finalGrade >= 98.40) {
                                                                                                                                $grade = 99;
                                                                                                                            } elseif ($finalGrade >= 96.80) {
                                                                                                                                $grade = 98;
                                                                                                                            } elseif ($finalGrade >= 95.20) {
                                                                                                                                $grade = 97;
                                                                                                                            } elseif ($finalGrade >= 93.60) {
                                                                                                                                $grade = 96;
                                                                                                                            } elseif ($finalGrade >= 92.00) {
                                                                                                                                $grade = 95;
                                                                                                                            } elseif ($finalGrade >= 90.40) {
                                                                                                                                $grade = 94;
                                                                                                                            } elseif ($finalGrade >= 88.80) {
                                                                                                                                $grade = 93;
                                                                                                                            } elseif ($finalGrade >= 87.20) {
                                                                                                                                $grade = 92;
                                                                                                                            } elseif ($finalGrade >= 85.60) {
                                                                                                                                $grade = 91;
                                                                                                                            } elseif ($finalGrade >= 84.00) {
                                                                                                                                $grade = 90;
                                                                                                                            } elseif ($finalGrade >= 82.40) {
                                                                                                                                $grade = 89;
                                                                                                                            } elseif ($finalGrade >= 80.80) {
                                                                                                                                $grade = 88;
                                                                                                                            } elseif ($finalGrade >= 79.20) {
                                                                                                                                $grade = 87;
                                                                                                                            } elseif ($finalGrade >= 77.60) {
                                                                                                                                $grade = 86;
                                                                                                                            } elseif ($finalGrade >= 76.00) {
                                                                                                                                $grade = 85;
                                                                                                                            } elseif ($finalGrade >= 74.40) {
                                                                                                                                $grade = 84;
                                                                                                                            } elseif ($finalGrade >= 72.80) {
                                                                                                                                $grade = 83;
                                                                                                                            } elseif ($finalGrade >= 71.20) {
                                                                                                                                $grade = 82;
                                                                                                                            } elseif ($finalGrade >= 69.60) {
                                                                                                                                $grade = 81;
                                                                                                                            } elseif ($finalGrade >= 68.00) {
                                                                                                                                $grade = 80;
                                                                                                                            } elseif ($finalGrade >= 66.40) {
                                                                                                                                $grade = 79;
                                                                                                                            } elseif ($finalGrade >= 64.80) {
                                                                                                                                $grade = 78;
                                                                                                                            } elseif ($finalGrade >= 63.20) {
                                                                                                                                $grade = 77;
                                                                                                                            } elseif ($finalGrade >= 61.60) {
                                                                                                                                $grade = 76;
                                                                                                                            } elseif ($finalGrade >= 60.00) {
                                                                                                                                $grade = 75;
                                                                                                                            } elseif ($finalGrade >= 56.00) {
                                                                                                                                $grade = 74;
                                                                                                                            } elseif ($finalGrade >= 52.00) {
                                                                                                                                $grade = 73;
                                                                                                                            } elseif ($finalGrade >= 48.00) {
                                                                                                                                $grade = 72;
                                                                                                                            } elseif ($finalGrade >= 44.00) {
                                                                                                                                $grade = 71;
                                                                                                                            } elseif ($finalGrade >= 40.00) {
                                                                                                                                $grade = 70;
                                                                                                                            } elseif ($finalGrade >= 36.00) {
                                                                                                                                $grade = 69;
                                                                                                                            } elseif ($finalGrade >= 32.00) {
                                                                                                                                $grade = 68;
                                                                                                                            } elseif ($finalGrade >= 28.00) {
                                                                                                                                $grade = 67;
                                                                                                                            } elseif ($finalGrade >= 24.00) {
                                                                                                                                $grade = 66;
                                                                                                                            } elseif ($finalGrade >= 20.00) {
                                                                                                                                $grade = 65;
                                                                                                                            } elseif ($finalGrade >= 16.00) {
                                                                                                                                $grade = 64;
                                                                                                                            } elseif ($finalGrade >= 12.00) {
                                                                                                                                $grade = 63;
                                                                                                                            } elseif ($finalGrade >= 8.00) {
                                                                                                                                $grade = 62;
                                                                                                                            } elseif ($finalGrade >= 4.00) {
                                                                                                                                $grade = 61;
                                                                                                                            } else {
                                                                                                                                $grade = 60;
                                                                                                                            }
                                                                                                                        @endphp

                                                                                                                        {{ $grade }}
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @if (round($grade, 2) < 75)
                                                                                                                            Failed
                                                                                                                        @else

                                                                                                                            Passed
                                                                                                                        @endif


                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tfoot>
                                                                @endif

                                                            </table>
                                                        </div>


                                                    </div>

                                                    <div class="table-container w-full mt-10 pb-10" id="gradeThree"
                                                        style="display: none;">
                                                        <div class="my-10">
                                                            @if (isset($finalGradeThree[0]->grade) && $finalGradeThree[0]->grade == "Grade Three")
                                                                <h2 class="text-lg font-semibold">{{ $finalGradeThree[0]->grade }} ||
                                                                    {{ $finalGradeThree[0]->school_year }} || Section :
                                                                    {{ $finalGradeThree[0]->section }}
                                                                </h2>
                                                            @endif
                                                        </div>
                                                        <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                            <table class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Learning Areas
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" colspan="4">
                                                                            Periodic Rating
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Final Grade
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Remarks
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="border border-gray-600 export">1</th>
                                                                        <th class="border border-gray-600 export">2</th>
                                                                        <th class="border border-gray-600 export">3</th>
                                                                        <th class="border border-gray-600 export">4</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $gradeThreeExists = false;
                                                                        $totalFinalGrade = 0;
                                                                        $count = 0;
                                                                        $allGradesAvailable = true; // Variable to check if all grades are available
                                                                    @endphp

                                                                    @foreach ($finalGradeThree as $gradeThree)
                                                                                                                @if (is_object($gradeThree) && $gradeThree->grade == "Grade Three")
                                                                                                                                                            @php
                                                                                                                                                                $gradeThreeExists = true;
                                                                                                                                                                $totalFinalGrade += $gradeThree->final_grade;
                                                                                                                                                                $count++;

                                                                                                                                                                // Check if all quarterly grades are available
                                                                                                                                                                if (
                                                                                                                                                                    empty($gradeThree->first_quarter_grade) || empty($gradeThree->second_quarter_grade) ||
                                                                                                                                                                    empty($gradeThree->third_quarter_grade) || empty($gradeThree->fourth_quarter_grade) ||
                                                                                                                                                                    empty($gradeThree->final_grade)
                                                                                                                                                                ) {
                                                                                                                                                                    $allGradesAvailable = false;
                                                                                                                                                                }
                                                                                                                                                            @endphp
                                                                                                                                                            <tr class="subject-row">
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeThree->subject }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeThree->first_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeThree->second_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeThree->third_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeThree->fourth_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $gradeThree->final_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    @if (empty($gradeThree->final_grade))
                                                                                                                                                                        <!-- No final grade available -->
                                                                                                                                                                    @elseif ($gradeThree->final_grade < 75)
                                                                                                                                                                        Failed
                                                                                                                                                                    @else
                                                                                                                                                                        Passed
                                                                                                                                                                    @endif
                                                                                                                                                                </td>
                                                                                                                                                            </tr>
                                                                                                                @endif
                                                                    @endforeach

                                                                    @if (!$gradeThreeExists)
                                                                        <tr>
                                                                            <td colspan="7" class="text-center border-2 px-4 py-2">No Grades
                                                                                Available</td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>

                                                                @if ($allGradesAvailable && $count > 0)
                                                                                                            <tfoot>
                                                                                                                <tr>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        General Average</td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @php
                                                                                                                            $finalGrade = round($totalFinalGrade / $count, 2);
                                                                                                                            if ($finalGrade >= 100) {
                                                                                                                                $grade = 100;
                                                                                                                            } elseif ($finalGrade >= 98.40) {
                                                                                                                                $grade = 99;
                                                                                                                            } elseif ($finalGrade >= 96.80) {
                                                                                                                                $grade = 98;
                                                                                                                            } elseif ($finalGrade >= 95.20) {
                                                                                                                                $grade = 97;
                                                                                                                            } elseif ($finalGrade >= 93.60) {
                                                                                                                                $grade = 96;
                                                                                                                            } elseif ($finalGrade >= 92.00) {
                                                                                                                                $grade = 95;
                                                                                                                            } elseif ($finalGrade >= 90.40) {
                                                                                                                                $grade = 94;
                                                                                                                            } elseif ($finalGrade >= 88.80) {
                                                                                                                                $grade = 93;
                                                                                                                            } elseif ($finalGrade >= 87.20) {
                                                                                                                                $grade = 92;
                                                                                                                            } elseif ($finalGrade >= 85.60) {
                                                                                                                                $grade = 91;
                                                                                                                            } elseif ($finalGrade >= 84.00) {
                                                                                                                                $grade = 90;
                                                                                                                            } elseif ($finalGrade >= 82.40) {
                                                                                                                                $grade = 89;
                                                                                                                            } elseif ($finalGrade >= 80.80) {
                                                                                                                                $grade = 88;
                                                                                                                            } elseif ($finalGrade >= 79.20) {
                                                                                                                                $grade = 87;
                                                                                                                            } elseif ($finalGrade >= 77.60) {
                                                                                                                                $grade = 86;
                                                                                                                            } elseif ($finalGrade >= 76.00) {
                                                                                                                                $grade = 85;
                                                                                                                            } elseif ($finalGrade >= 74.40) {
                                                                                                                                $grade = 84;
                                                                                                                            } elseif ($finalGrade >= 72.80) {
                                                                                                                                $grade = 83;
                                                                                                                            } elseif ($finalGrade >= 71.20) {
                                                                                                                                $grade = 82;
                                                                                                                            } elseif ($finalGrade >= 69.60) {
                                                                                                                                $grade = 81;
                                                                                                                            } elseif ($finalGrade >= 68.00) {
                                                                                                                                $grade = 80;
                                                                                                                            } elseif ($finalGrade >= 66.40) {
                                                                                                                                $grade = 79;
                                                                                                                            } elseif ($finalGrade >= 64.80) {
                                                                                                                                $grade = 78;
                                                                                                                            } elseif ($finalGrade >= 63.20) {
                                                                                                                                $grade = 77;
                                                                                                                            } elseif ($finalGrade >= 61.60) {
                                                                                                                                $grade = 76;
                                                                                                                            } elseif ($finalGrade >= 60.00) {
                                                                                                                                $grade = 75;
                                                                                                                            } elseif ($finalGrade >= 56.00) {
                                                                                                                                $grade = 74;
                                                                                                                            } elseif ($finalGrade >= 52.00) {
                                                                                                                                $grade = 73;
                                                                                                                            } elseif ($finalGrade >= 48.00) {
                                                                                                                                $grade = 72;
                                                                                                                            } elseif ($finalGrade >= 44.00) {
                                                                                                                                $grade = 71;
                                                                                                                            } elseif ($finalGrade >= 40.00) {
                                                                                                                                $grade = 70;
                                                                                                                            } elseif ($finalGrade >= 36.00) {
                                                                                                                                $grade = 69;
                                                                                                                            } elseif ($finalGrade >= 32.00) {
                                                                                                                                $grade = 68;
                                                                                                                            } elseif ($finalGrade >= 28.00) {
                                                                                                                                $grade = 67;
                                                                                                                            } elseif ($finalGrade >= 24.00) {
                                                                                                                                $grade = 66;
                                                                                                                            } elseif ($finalGrade >= 20.00) {
                                                                                                                                $grade = 65;
                                                                                                                            } elseif ($finalGrade >= 16.00) {
                                                                                                                                $grade = 64;
                                                                                                                            } elseif ($finalGrade >= 12.00) {
                                                                                                                                $grade = 63;
                                                                                                                            } elseif ($finalGrade >= 8.00) {
                                                                                                                                $grade = 62;
                                                                                                                            } elseif ($finalGrade >= 4.00) {
                                                                                                                                $grade = 61;
                                                                                                                            } else {
                                                                                                                                $grade = 60;
                                                                                                                            }
                                                                                                                        @endphp

                                                                                                                        {{ $grade }}
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @if (round($grade, 2) < 75)
                                                                                                                            Failed
                                                                                                                        @else
                                                                                                                            Passed
                                                                                                                        @endif

                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tfoot>
                                                                @endif
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="table-container w-full mt-10 pb-10" id="gradeFour"
                                                        style="display: none;">
                                                        <div class="my-10">
                                                            @if (isset($finalGradeFour[0]->grade) && $finalGradeFour[0]->grade == "Grade Four")
                                                                <h2 class="text-lg font-semibold">{{ $finalGradeFour[0]->grade }} ||
                                                                    {{ $finalGradeFour[0]->school_year }} || Section :
                                                                    {{ $finalGradeFour[0]->section }}
                                                                </h2>
                                                            @endif
                                                        </div>
                                                        <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                            <table class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Learning Areas
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" colspan="4">
                                                                            Periodic Rating
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Final Grade
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Remarks
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="border border-gray-600 export">1</th>
                                                                        <th class="border border-gray-600 export">2</th>
                                                                        <th class="border border-gray-600 export">3</th>
                                                                        <th class="border border-gray-600 export">4</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $gradeFourExists = false;
                                                                        $totalFinalGrade = 0;
                                                                        $count = 0;
                                                                        $allGradesAvailable = true; // Variable to check if all grades are available
                                                                    @endphp

                                                                    @foreach ($finalGradeFour as $grade)
                                                                                                                @if (is_object($grade) && $grade->grade == "Grade Four")
                                                                                                                                                            @php
                                                                                                                                                                $gradeFourExists = true;
                                                                                                                                                                $totalFinalGrade += $grade->final_grade;
                                                                                                                                                                $count++;

                                                                                                                                                                // Check if all quarterly grades are available
                                                                                                                                                                if (
                                                                                                                                                                    empty($grade->first_quarter_grade) || empty($grade->second_quarter_grade) ||
                                                                                                                                                                    empty($grade->third_quarter_grade) || empty($grade->fourth_quarter_grade) ||
                                                                                                                                                                    empty($grade->final_grade)
                                                                                                                                                                ) {
                                                                                                                                                                    $allGradesAvailable = false;
                                                                                                                                                                }
                                                                                                                                                            @endphp
                                                                                                                                                            <tr class="subject-row">
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->subject }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->first_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->second_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->third_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->fourth_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->final_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    @if (empty($grade->final_grade))
                                                                                                                                                                        <!-- No final grade available -->
                                                                                                                                                                    @elseif ($grade->final_grade < 75)
                                                                                                                                                                        Failed
                                                                                                                                                                    @else
                                                                                                                                                                        Passed
                                                                                                                                                                    @endif
                                                                                                                                                                </td>
                                                                                                                                                            </tr>
                                                                                                                @endif
                                                                    @endforeach

                                                                    @if (!$gradeFourExists)
                                                                        <tr>
                                                                            <td colspan="7" class="text-center border-2 px-4 py-2">No Grades
                                                                                Available</td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>

                                                                @if ($allGradesAvailable && $count > 0)
                                                                                                            <tfoot>
                                                                                                                <tr>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        General Average</td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @php
                                                                                                                            $finalGrade = round($totalFinalGrade / $count, 2);
                                                                                                                            if ($finalGrade >= 100) {
                                                                                                                                $grade = 100;
                                                                                                                            } elseif ($finalGrade >= 98.40) {
                                                                                                                                $grade = 99;
                                                                                                                            } elseif ($finalGrade >= 96.80) {
                                                                                                                                $grade = 98;
                                                                                                                            } elseif ($finalGrade >= 95.20) {
                                                                                                                                $grade = 97;
                                                                                                                            } elseif ($finalGrade >= 93.60) {
                                                                                                                                $grade = 96;
                                                                                                                            } elseif ($finalGrade >= 92.00) {
                                                                                                                                $grade = 95;
                                                                                                                            } elseif ($finalGrade >= 90.40) {
                                                                                                                                $grade = 94;
                                                                                                                            } elseif ($finalGrade >= 88.80) {
                                                                                                                                $grade = 93;
                                                                                                                            } elseif ($finalGrade >= 87.20) {
                                                                                                                                $grade = 92;
                                                                                                                            } elseif ($finalGrade >= 85.60) {
                                                                                                                                $grade = 91;
                                                                                                                            } elseif ($finalGrade >= 84.00) {
                                                                                                                                $grade = 90;
                                                                                                                            } elseif ($finalGrade >= 82.40) {
                                                                                                                                $grade = 89;
                                                                                                                            } elseif ($finalGrade >= 80.80) {
                                                                                                                                $grade = 88;
                                                                                                                            } elseif ($finalGrade >= 79.20) {
                                                                                                                                $grade = 87;
                                                                                                                            } elseif ($finalGrade >= 77.60) {
                                                                                                                                $grade = 86;
                                                                                                                            } elseif ($finalGrade >= 76.00) {
                                                                                                                                $grade = 85;
                                                                                                                            } elseif ($finalGrade >= 74.40) {
                                                                                                                                $grade = 84;
                                                                                                                            } elseif ($finalGrade >= 72.80) {
                                                                                                                                $grade = 83;
                                                                                                                            } elseif ($finalGrade >= 71.20) {
                                                                                                                                $grade = 82;
                                                                                                                            } elseif ($finalGrade >= 69.60) {
                                                                                                                                $grade = 81;
                                                                                                                            } elseif ($finalGrade >= 68.00) {
                                                                                                                                $grade = 80;
                                                                                                                            } elseif ($finalGrade >= 66.40) {
                                                                                                                                $grade = 79;
                                                                                                                            } elseif ($finalGrade >= 64.80) {
                                                                                                                                $grade = 78;
                                                                                                                            } elseif ($finalGrade >= 63.20) {
                                                                                                                                $grade = 77;
                                                                                                                            } elseif ($finalGrade >= 61.60) {
                                                                                                                                $grade = 76;
                                                                                                                            } elseif ($finalGrade >= 60.00) {
                                                                                                                                $grade = 75;
                                                                                                                            } elseif ($finalGrade >= 56.00) {
                                                                                                                                $grade = 74;
                                                                                                                            } elseif ($finalGrade >= 52.00) {
                                                                                                                                $grade = 73;
                                                                                                                            } elseif ($finalGrade >= 48.00) {
                                                                                                                                $grade = 72;
                                                                                                                            } elseif ($finalGrade >= 44.00) {
                                                                                                                                $grade = 71;
                                                                                                                            } elseif ($finalGrade >= 40.00) {
                                                                                                                                $grade = 70;
                                                                                                                            } elseif ($finalGrade >= 36.00) {
                                                                                                                                $grade = 69;
                                                                                                                            } elseif ($finalGrade >= 32.00) {
                                                                                                                                $grade = 68;
                                                                                                                            } elseif ($finalGrade >= 28.00) {
                                                                                                                                $grade = 67;
                                                                                                                            } elseif ($finalGrade >= 24.00) {
                                                                                                                                $grade = 66;
                                                                                                                            } elseif ($finalGrade >= 20.00) {
                                                                                                                                $grade = 65;
                                                                                                                            } elseif ($finalGrade >= 16.00) {
                                                                                                                                $grade = 64;
                                                                                                                            } elseif ($finalGrade >= 12.00) {
                                                                                                                                $grade = 63;
                                                                                                                            } elseif ($finalGrade >= 8.00) {
                                                                                                                                $grade = 62;
                                                                                                                            } elseif ($finalGrade >= 4.00) {
                                                                                                                                $grade = 61;
                                                                                                                            } else {
                                                                                                                                $grade = 60;
                                                                                                                            }
                                                                                                                        @endphp

                                                                                                                        {{ $grade }}
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @if (round($grade, 2) < 75)
                                                                                                                            Failed
                                                                                                                        @else
                                                                                                                            Passed
                                                                                                                        @endif

                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tfoot>
                                                                @endif
                                                            </table>
                                                        </div>
                                                        <div id="gradesContainerFour" class="my-10 flex justify-end gap-5">
                                                            @if ($allGradesAvailable && $gradeFourExists)
                                                                <button id="downloadHtmlButtonFour"
                                                                    class="bg-teal-700 hover:bg-teal-800 text-lg font-semibold text-white py-2 px-4 rounded mt-4"><i
                                                                        class="fa-solid fa-file-pdf me-2"></i>Download
                                                                    As
                                                                    PDF</button>
                                                                <button id="printHtmlButtonFour"
                                                                    class="bg-sky-700 text-lg font-semibold hover:bg-sky-800 text-white py-2 px-4 rounded mt-4"><i
                                                                        class="fa-solid fa-print me-2"></i>Print Report</button>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="table-container w-full mt-10 pb-10" id="gradeFive"
                                                        style="display: none;">
                                                        <div class="my-10">
                                                            @if (isset($finalGradeFive[0]->grade) && $finalGradeFive[0]->grade == "Grade Five")
                                                                <h2 class="text-lg font-semibold">{{ $finalGradeFive[0]->grade }} ||
                                                                    {{ $finalGradeFive[0]->school_year }} || Section :
                                                                    {{ $finalGradeFive[0]->section }}
                                                                </h2>
                                                            @endif
                                                        </div>
                                                        <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                            <table class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Learning Areas
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" colspan="4">
                                                                            Periodic Rating
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Final Grade
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Remarks
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="border border-gray-600 export">1</th>
                                                                        <th class="border border-gray-600 export">2</th>
                                                                        <th class="border border-gray-600 export">3</th>
                                                                        <th class="border border-gray-600 export">4</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $gradeFiveExists = false;
                                                                        $totalFinalGrade = 0;
                                                                        $count = 0;
                                                                        $allGradesAvailable = true; // Variable to check if all grades are available
                                                                    @endphp

                                                                    @foreach ($finalGradeFive as $grade)
                                                                                                                @if (is_object($grade) && $grade->grade == "Grade Five")
                                                                                                                                                            @php
                                                                                                                                                                $gradeFiveExists = true;
                                                                                                                                                                $totalFinalGrade += $grade->final_grade;
                                                                                                                                                                $count++;

                                                                                                                                                                // Check if all quarterly grades are available
                                                                                                                                                                if (
                                                                                                                                                                    empty($grade->first_quarter_grade) || empty($grade->second_quarter_grade) ||
                                                                                                                                                                    empty($grade->third_quarter_grade) || empty($grade->fourth_quarter_grade) ||
                                                                                                                                                                    empty($grade->final_grade)
                                                                                                                                                                ) {
                                                                                                                                                                    $allGradesAvailable = false;
                                                                                                                                                                }
                                                                                                                                                            @endphp
                                                                                                                                                            <tr class="subject-row">
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->subject }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->first_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->second_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->third_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->fourth_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->final_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    @if (empty($grade->final_grade))
                                                                                                                                                                        <!-- No final grade available -->
                                                                                                                                                                    @elseif ($grade->final_grade < 75)
                                                                                                                                                                        Failed
                                                                                                                                                                    @else
                                                                                                                                                                        Passed
                                                                                                                                                                    @endif
                                                                                                                                                                </td>
                                                                                                                                                            </tr>
                                                                                                                @endif
                                                                    @endforeach

                                                                    @if (!$gradeFiveExists)
                                                                        <tr>
                                                                            <td colspan="7" class="text-center border-2 px-4 py-2">No Grades
                                                                                Available</td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>

                                                                @if ($allGradesAvailable && $count > 0)
                                                                                                            <tfoot>
                                                                                                                <tr>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        General Average</td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @php
                                                                                                                            $finalGrade = round($totalFinalGrade / $count, 2);
                                                                                                                            if ($finalGrade >= 100) {
                                                                                                                                $grade = 100;
                                                                                                                            } elseif ($finalGrade >= 98.40) {
                                                                                                                                $grade = 99;
                                                                                                                            } elseif ($finalGrade >= 96.80) {
                                                                                                                                $grade = 98;
                                                                                                                            } elseif ($finalGrade >= 95.20) {
                                                                                                                                $grade = 97;
                                                                                                                            } elseif ($finalGrade >= 93.60) {
                                                                                                                                $grade = 96;
                                                                                                                            } elseif ($finalGrade >= 92.00) {
                                                                                                                                $grade = 95;
                                                                                                                            } elseif ($finalGrade >= 90.40) {
                                                                                                                                $grade = 94;
                                                                                                                            } elseif ($finalGrade >= 88.80) {
                                                                                                                                $grade = 93;
                                                                                                                            } elseif ($finalGrade >= 87.20) {
                                                                                                                                $grade = 92;
                                                                                                                            } elseif ($finalGrade >= 85.60) {
                                                                                                                                $grade = 91;
                                                                                                                            } elseif ($finalGrade >= 84.00) {
                                                                                                                                $grade = 90;
                                                                                                                            } elseif ($finalGrade >= 82.40) {
                                                                                                                                $grade = 89;
                                                                                                                            } elseif ($finalGrade >= 80.80) {
                                                                                                                                $grade = 88;
                                                                                                                            } elseif ($finalGrade >= 79.20) {
                                                                                                                                $grade = 87;
                                                                                                                            } elseif ($finalGrade >= 77.60) {
                                                                                                                                $grade = 86;
                                                                                                                            } elseif ($finalGrade >= 76.00) {
                                                                                                                                $grade = 85;
                                                                                                                            } elseif ($finalGrade >= 74.40) {
                                                                                                                                $grade = 84;
                                                                                                                            } elseif ($finalGrade >= 72.80) {
                                                                                                                                $grade = 83;
                                                                                                                            } elseif ($finalGrade >= 71.20) {
                                                                                                                                $grade = 82;
                                                                                                                            } elseif ($finalGrade >= 69.60) {
                                                                                                                                $grade = 81;
                                                                                                                            } elseif ($finalGrade >= 68.00) {
                                                                                                                                $grade = 80;
                                                                                                                            } elseif ($finalGrade >= 66.40) {
                                                                                                                                $grade = 79;
                                                                                                                            } elseif ($finalGrade >= 64.80) {
                                                                                                                                $grade = 78;
                                                                                                                            } elseif ($finalGrade >= 63.20) {
                                                                                                                                $grade = 77;
                                                                                                                            } elseif ($finalGrade >= 61.60) {
                                                                                                                                $grade = 76;
                                                                                                                            } elseif ($finalGrade >= 60.00) {
                                                                                                                                $grade = 75;
                                                                                                                            } elseif ($finalGrade >= 56.00) {
                                                                                                                                $grade = 74;
                                                                                                                            } elseif ($finalGrade >= 52.00) {
                                                                                                                                $grade = 73;
                                                                                                                            } elseif ($finalGrade >= 48.00) {
                                                                                                                                $grade = 72;
                                                                                                                            } elseif ($finalGrade >= 44.00) {
                                                                                                                                $grade = 71;
                                                                                                                            } elseif ($finalGrade >= 40.00) {
                                                                                                                                $grade = 70;
                                                                                                                            } elseif ($finalGrade >= 36.00) {
                                                                                                                                $grade = 69;
                                                                                                                            } elseif ($finalGrade >= 32.00) {
                                                                                                                                $grade = 68;
                                                                                                                            } elseif ($finalGrade >= 28.00) {
                                                                                                                                $grade = 67;
                                                                                                                            } elseif ($finalGrade >= 24.00) {
                                                                                                                                $grade = 66;
                                                                                                                            } elseif ($finalGrade >= 20.00) {
                                                                                                                                $grade = 65;
                                                                                                                            } elseif ($finalGrade >= 16.00) {
                                                                                                                                $grade = 64;
                                                                                                                            } elseif ($finalGrade >= 12.00) {
                                                                                                                                $grade = 63;
                                                                                                                            } elseif ($finalGrade >= 8.00) {
                                                                                                                                $grade = 62;
                                                                                                                            } elseif ($finalGrade >= 4.00) {
                                                                                                                                $grade = 61;
                                                                                                                            } else {
                                                                                                                                $grade = 60;
                                                                                                                            }
                                                                                                                        @endphp

                                                                                                                        {{ $grade }}
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @if (round($grade, 2) < 75)
                                                                                                                            Failed
                                                                                                                        @else
                                                                                                                            Passed
                                                                                                                        @endif

                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tfoot>
                                                                @endif
                                                            </table>
                                                        </div>
                                                        <div id="gradesContainerFive" class="my-10 flex justify-end gap-5">
                                                            @if ($allGradesAvailable && $gradeFiveExists)
                                                                <button id="downloadHtmlButtonFive"
                                                                    class="bg-teal-700 hover:bg-teal-800 text-lg font-semibold text-white py-2 px-4 rounded mt-4"><i
                                                                        class="fa-solid fa-file-pdf me-2"></i>Download
                                                                    As
                                                                    PDF</button>
                                                                <button id="printHtmlButtonFive"
                                                                    class="bg-sky-700 text-lg font-semibold hover:bg-sky-800 text-white py-2 px-4 rounded mt-4"><i
                                                                        class="fa-solid fa-print me-2"></i>Print Report</button>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="table-container w-full mt-10 pb-10" id="gradeSix"
                                                        style="display: none;">
                                                        <div class="my-10">
                                                            @if (isset($finalGradeSix[0]->grade) && $finalGradeSix[0]->grade == "Grade Six")
                                                                <h2 class="text-lg font-semibold">{{ $finalGradeSix[0]->grade }} ||
                                                                    {{ $finalGradeSix[0]->school_year }} || Section :
                                                                    {{ $finalGradeSix[0]->section }}
                                                                </h2>
                                                            @endif
                                                        </div>
                                                        <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                            <table class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Learning Areas
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" colspan="4">
                                                                            Periodic Rating
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Final Grade
                                                                        </th>
                                                                        <th class="px-4 py-2 border border-gray-600 export" rowspan="2">
                                                                            Remarks
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="border border-gray-600 export">1</th>
                                                                        <th class="border border-gray-600 export">2</th>
                                                                        <th class="border border-gray-600 export">3</th>
                                                                        <th class="border border-gray-600 export">4</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @php
                                                                        $gradeSixExists = false;
                                                                        $totalFinalGrade = 0;
                                                                        $count = 0;
                                                                        $allGradesAvailable = true; // Variable to check if all grades are available
                                                                    @endphp

                                                                    @foreach ($finalGradeSix as $grade)
                                                                                                                @if (is_object($grade) && $grade->grade == "Grade Six")
                                                                                                                                                            @php
                                                                                                                                                                $gradeSixExists = true;
                                                                                                                                                                $totalFinalGrade += $grade->final_grade;
                                                                                                                                                                $count++;

                                                                                                                                                                // Check if all quarterly grades are available
                                                                                                                                                                if (
                                                                                                                                                                    empty($grade->first_quarter_grade) || empty($grade->second_quarter_grade) ||
                                                                                                                                                                    empty($grade->third_quarter_grade) || empty($grade->fourth_quarter_grade) ||
                                                                                                                                                                    empty($grade->final_grade)
                                                                                                                                                                ) {
                                                                                                                                                                    $allGradesAvailable = false;
                                                                                                                                                                }
                                                                                                                                                            @endphp
                                                                                                                                                            <tr class="subject-row">
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->subject }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->first_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->second_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->third_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->fourth_quarter_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    {{ $grade->final_grade }}
                                                                                                                                                                </td>
                                                                                                                                                                <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                                                                    @if (empty($grade->final_grade))
                                                                                                                                                                        <!-- No final grade available -->
                                                                                                                                                                    @elseif ($grade->final_grade < 75)
                                                                                                                                                                        Failed
                                                                                                                                                                    @else
                                                                                                                                                                        Passed
                                                                                                                                                                    @endif
                                                                                                                                                                </td>
                                                                                                                                                            </tr>
                                                                                                                @endif
                                                                    @endforeach

                                                                    @if (!$gradeSixExists)
                                                                        <tr>
                                                                            <td colspan="7" class="text-center border-2 px-4 py-2">No Grades
                                                                                Available</td>
                                                                        </tr>
                                                                    @endif
                                                                </tbody>

                                                                @if ($allGradesAvailable && $count > 0)
                                                                                                            <tfoot>
                                                                                                                <tr>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        General Average</td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @php
                                                                                                                            $finalGrade = round($totalFinalGrade / $count, 2);
                                                                                                                            if ($finalGrade >= 100) {
                                                                                                                                $grade = 100;
                                                                                                                            } elseif ($finalGrade >= 98.40) {
                                                                                                                                $grade = 99;
                                                                                                                            } elseif ($finalGrade >= 96.80) {
                                                                                                                                $grade = 98;
                                                                                                                            } elseif ($finalGrade >= 95.20) {
                                                                                                                                $grade = 97;
                                                                                                                            } elseif ($finalGrade >= 93.60) {
                                                                                                                                $grade = 96;
                                                                                                                            } elseif ($finalGrade >= 92.00) {
                                                                                                                                $grade = 95;
                                                                                                                            } elseif ($finalGrade >= 90.40) {
                                                                                                                                $grade = 94;
                                                                                                                            } elseif ($finalGrade >= 88.80) {
                                                                                                                                $grade = 93;
                                                                                                                            } elseif ($finalGrade >= 87.20) {
                                                                                                                                $grade = 92;
                                                                                                                            } elseif ($finalGrade >= 85.60) {
                                                                                                                                $grade = 91;
                                                                                                                            } elseif ($finalGrade >= 84.00) {
                                                                                                                                $grade = 90;
                                                                                                                            } elseif ($finalGrade >= 82.40) {
                                                                                                                                $grade = 89;
                                                                                                                            } elseif ($finalGrade >= 80.80) {
                                                                                                                                $grade = 88;
                                                                                                                            } elseif ($finalGrade >= 79.20) {
                                                                                                                                $grade = 87;
                                                                                                                            } elseif ($finalGrade >= 77.60) {
                                                                                                                                $grade = 86;
                                                                                                                            } elseif ($finalGrade >= 76.00) {
                                                                                                                                $grade = 85;
                                                                                                                            } elseif ($finalGrade >= 74.40) {
                                                                                                                                $grade = 84;
                                                                                                                            } elseif ($finalGrade >= 72.80) {
                                                                                                                                $grade = 83;
                                                                                                                            } elseif ($finalGrade >= 71.20) {
                                                                                                                                $grade = 82;
                                                                                                                            } elseif ($finalGrade >= 69.60) {
                                                                                                                                $grade = 81;
                                                                                                                            } elseif ($finalGrade >= 68.00) {
                                                                                                                                $grade = 80;
                                                                                                                            } elseif ($finalGrade >= 66.40) {
                                                                                                                                $grade = 79;
                                                                                                                            } elseif ($finalGrade >= 64.80) {
                                                                                                                                $grade = 78;
                                                                                                                            } elseif ($finalGrade >= 63.20) {
                                                                                                                                $grade = 77;
                                                                                                                            } elseif ($finalGrade >= 61.60) {
                                                                                                                                $grade = 76;
                                                                                                                            } elseif ($finalGrade >= 60.00) {
                                                                                                                                $grade = 75;
                                                                                                                            } elseif ($finalGrade >= 56.00) {
                                                                                                                                $grade = 74;
                                                                                                                            } elseif ($finalGrade >= 52.00) {
                                                                                                                                $grade = 73;
                                                                                                                            } elseif ($finalGrade >= 48.00) {
                                                                                                                                $grade = 72;
                                                                                                                            } elseif ($finalGrade >= 44.00) {
                                                                                                                                $grade = 71;
                                                                                                                            } elseif ($finalGrade >= 40.00) {
                                                                                                                                $grade = 70;
                                                                                                                            } elseif ($finalGrade >= 36.00) {
                                                                                                                                $grade = 69;
                                                                                                                            } elseif ($finalGrade >= 32.00) {
                                                                                                                                $grade = 68;
                                                                                                                            } elseif ($finalGrade >= 28.00) {
                                                                                                                                $grade = 67;
                                                                                                                            } elseif ($finalGrade >= 24.00) {
                                                                                                                                $grade = 66;
                                                                                                                            } elseif ($finalGrade >= 20.00) {
                                                                                                                                $grade = 65;
                                                                                                                            } elseif ($finalGrade >= 16.00) {
                                                                                                                                $grade = 64;
                                                                                                                            } elseif ($finalGrade >= 12.00) {
                                                                                                                                $grade = 63;
                                                                                                                            } elseif ($finalGrade >= 8.00) {
                                                                                                                                $grade = 62;
                                                                                                                            } elseif ($finalGrade >= 4.00) {
                                                                                                                                $grade = 61;
                                                                                                                            } else {
                                                                                                                                $grade = 60;
                                                                                                                            }
                                                                                                                        @endphp

                                                                                                                        {{ $grade }}
                                                                                                                    </td>
                                                                                                                    <td class="border border-gray-600 text-center px-4 py-2">
                                                                                                                        @if (round($totalFinalGrade / $count, 2) < 75)
                                                                                                                            Failed
                                                                                                                        @else
                                                                                                                            Passed
                                                                                                                        @endif

                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tfoot>
                                                                @endif
                                                            </table>
                                                        </div>
                                                        <div id="gradesContainerSix" class="my-10 flex justify-end gap-5">
                                                            @if ($allGradesAvailable && $gradeSixExists)
                                                                <button id="downloadHtmlButtonSix"
                                                                    class="bg-teal-700 hover:bg-teal-800 text-lg font-semibold text-white py-2 px-4 rounded mt-4"><i
                                                                        class="fa-solid fa-file-pdf me-2"></i>Download
                                                                    As
                                                                    PDF</button>
                                                                <button id="printHtmlButtonSix"
                                                                    class="bg-sky-700 text-lg font-semibold hover:bg-sky-800 text-white py-2 px-4 rounded mt-4"><i
                                                                        class="fa-solid fa-print me-2"></i>Print Report</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                @else



                    <p>Student not found.</p>
                @endif




                </div>
        </main>
    </div>

    <script src="{{ asset('../js/admin/admin.js') }}"></script>
    @include('admin.includes.js-link')

</body>

<style>
    option {
        border: none;
    }

    .input-field1,
    .select-field {
        width: 100%;
        border: none;
        border-radius: 0.375rem;
        padding: 0;
    }

    .modal-avatar {
        width: 8rem;
        height: 8rem;
        border-radius: 50%;
        object-fit: cover;
    }

    .active1 {
        background-color: #115e59;
        color: white;
        font-weight: bold;
        transform: scale(1.030);
    }

    /* Ensure the table container takes full width */
    .table-container {
        width: 100%;
    }

    /* Prevent hidden columns from affecting table layout */
    .hidden {
        display: none !important;
    }

    /* Ensure the table stretches across the available space */
    #tableGradeOne {
        width: 100% !important;
    }

    .dataTables_empty {
        font-size: 14px !important;
    }
</style>

</html>