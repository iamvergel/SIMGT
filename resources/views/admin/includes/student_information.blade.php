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
                                                    class="hover:text-teal-700">Student Management / </span>{{ $studentsPrimary->grade }} /
                                                {{ $students->student_last_name }}, {{ $students->student_first_name }}
                                                {{ $students->student_suffix_name }} {{ $students->student_middle_name }} | S.Y. {{ $studentsPrimary->school_year }}
                                            </p>
                                            <div class="flex justify-start  my-8" ><button onclick="window.history.back();"
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

                                                            <div class="text-green-500 font-bold">
                                                                <label for="modalStatus"
                                                                    class="block text-[14px] font-bold text-gray-900">Status :</label>
                                                                {{ $students->status }} | {{ $studentsPrimary->status }}
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
                                                    <div class="col-span-3 my-5 flex justify-start">
                                                        <button id="btnPrint"
                                                            class="text-[12px] text-white shadow-lg bg-sky-700 rounded-lg shadow hover:bg-sky-600 px-3 mt-3"><i
                                                                class="fas fa-file-pdf mr-2"></i>Download Reports
                                                            Grade</button>
                                                    </div>

                                                    <!-- Scheduled Table -->
                                                    <div class="table-container w-full mt-10 pb-10" id="Information">
                                                        <div class="grid grid-cols-4 gap-4">
                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Address</p>
                                                                        <p class="text-sm">{{ $students->house_number }}
                                                                            {{ $students->street }}
                                                                            {{ $students->barangay }}
                                                                            {{ $students->city }}, {{ $students->province }}</p>
                                                                    </div>
                                                                    <div>
                                                                        <i class="fa-solid fa-map-location-dot text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Father's Information</p>
                                                                        <p class="text-sm">Name : {{ $studentsAdditional->father_last_name }},
                                                                            {{ $studentsAdditional->father_first_name }}
                                                                            {{ $studentsAdditional->father_middle_name }}
                                                                            {{ $studentsAdditional->father_suffix }} </p>
                                                                            <p class="text-sm">Occupation : {{ $studentsAdditional->father_occupation }}</p>
                                                                    </div>
                                                                    <div>
                                                                        <i class="fa-solid fa-address-card text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Mother's Information</p>
                                                                        <p class="text-sm">Name : {{ $studentsAdditional->mother_last_name }},
                                                                            {{ $studentsAdditional->mother_first_name }}
                                                                            {{ $studentsAdditional->mother_middle_name }}
                                                                            </p>
                                                                            <p class="text-sm">Occupation : {{ $studentsAdditional->mother_occupation }}</p>
                                                                    </div>
                                                                    <div>
                                                                        <i class="fa-solid fa-address-card text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Guardian's Information</p>
                                                                        <p class="text-sm">Name : {{ $studentsAdditional->guardian_last_name }},
                                                                            {{ $studentsAdditional->guardian_first_name }}
                                                                            {{ $studentsAdditional->guardian_middle_name }}
                                                                            {{ $studentsAdditional->guadian_suffix }} </p>
                                                                            <p class="text-sm">Relationship to Student : {{ $studentsAdditional->guardian_relationship }}</p>
                                                                            <p class="text-sm">guardian Religion : {{ $studentsAdditional->guardian_religion }}</p>
                                                                    </div>
                                                                    <div>
                                                                        <i class="fa-solid fa-address-card text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-span-4 bg-gray-100 shadow rounded-md p-2">
                                                                <div class="bg-white p-5 flex justify-between items-end hover:bg-gray-50">
                                                                    <div>
                                                                        <p class="text-[16px] font-bold mb-5">Contact Information</p>
                                                                        <p class="text-sm">Name : {{ $studentsAdditional->emergency_contact_person }} </p>
                                                                        <p class="text-sm">Contact Number : {{ $studentsAdditional->emergency_contact_number }}</p>
                                                                        <p class="text-sm">Email Address : {{ $studentsAdditional->email_address }}</p>
                                                                        <p class="text-sm">Messenger Account : {{ $studentsAdditional->messenger_account }}</p>
                                                                    </div>
                                                                    <div>
                                                                        <i class="fa-solid fa-address-card text-teal-700/30 text-[3rem] xl:text-[5rem]"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- documents -->
                                                    <div class="table-container" id="documents" style="display:none;">
                                                        <div class="grid grid-cols-4 mt-10 gap-4">
                                                            <div class="col-span-1 my-5 flex justify-start">
                                                                <button onclick="window.open('{{ asset('storage/' . $studentDocuments->birth_certificate) }}')"
                                                                    class="w-full text-[12px] text-white text-start px-5 shadow-lg bg-sky-700 rounded-lg hover:bg-sky-600 px-3 mt-3 group relative">
                                                                    <i class="fa-solid fa-file me-2 text-sm"></i>Birth Certificate
                                                                    <div class="absolute w-full opacity-0 -top-[-2.8rem] rounded-md py-2 px-2 bg-sky-700 bg-opacity-70 left-1/2 -translate-x-1/2 group-hover:opacity-100 transition-opacity shadow-lg">
                                                                        @if (pathinfo($studentDocuments->birth_certificate, PATHINFO_EXTENSION) === 'pdf')
                                                                            <i class="fa-solid fa-file-pdf text-white me-2"></i> PDF
                                                                        @else
                                                                            <img src="{{ asset('storage/' . $studentDocuments->birth_certificate) }}" alt="{{ $students->student_first_name }}" width="500">
                                                                        @endif
                                                                    </div>
                                                                </button>
                                                                    
                                                                </div>
                                                            
                                                            <div class="col-span-1 my-5 flex justify-startt">
                                                                <button onclick="window.open('{{ asset('storage/' . $studentDocuments->proof_of_residency) }}')"
                                                                    class="w-full text-[12px] text-start px-5 text-white shadow-lg bg-sky-700 rounded-lg hover:bg-sky-600 px-3 mt-3 group relative"><i class="fa-solid fa-file me-2 text-sm"></i>Form 137
                                                                    <div class="absolute w-full opacity-0 -top-[-2.8rem] rounded-md py-2 px-2 bg-sky-700 bg-opacity-70 left-1/2 -translate-x-1/2 group-hover:opacity-100 transition-opacity shadow-lg">
                                                                        @if (pathinfo($studentDocuments->proof_of_residency, PATHINFO_EXTENSION) === 'pdf')
                                                                            <i class="fa-solid fa-file-pdf text-white me-2"></i> PDF
                                                                        @else
                                                                            <img src="{{ asset('storage/' . $studentDocuments->proof_of_residency) }}" alt="{{ $students->student_first_name }}" width="500">
                                                                        @endif
                                                                    </div>
                                                                </button>
                                                            </div>
                                                        </div>
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
