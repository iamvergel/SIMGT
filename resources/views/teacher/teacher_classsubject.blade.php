@include('teacher.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('teacher.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('teacher.includes.topnav')
            </header>

            <div class="p-5">
                <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Teacher</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span class="hover:text-teal-700">Class Record</span> / <span id="subjectName"></span>
                    </p>
                </div>

                <div class="flex justify-between items-center gap-4 mt-2W">
                    <!-- <div class="ml-5 flex items-center hidden">
                        <i class="fas fa-search text-xl text-teal-700 px-3"></i>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name..."
                            class="text-sm px-4 py-3 text-teal-900 border border-gray-300 rounded-lg w-96 shadow-lg focus:outline-none" />
                    </div> -->

                    <div class="flex">
                        <!-- <button data-modal-target="addnewstudent" data-modal-toggle="addnewstudent"
                            class="block w-86 right-0 mr-5 text-[12px] text-white shadow-lg px-10 bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded py-2.5 text-center"
                            type="button" aria-label="Add Student">
                            Add Student
                        </button> -->
                        <!-- <button
                            class="block w-86 right-0 mr-10 text-[12px] text-white shadow-lg px-10 bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded py-2.5 text-center"
                            onclick="window.location.href = '/StEmelieLearningCenter.HopeSci66/admin/student-management/AllStudentData'">
                            Show student data
                        </button> -->
                    </div>

                    <div class="">
                        <!-- <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="flex justify-between text-white w-72 bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                            type="button">Select Section <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>


                        <div id="dropdown"
                            class="z-10 fixed hidden bg-white divide-y divide-gray-100 rounded-lg shadow  w-72">
                            <ul class="p-2 text-md text-gray-700 dark:text-gray-200 shadow-lg"
                                aria-labelledby="dropdownDefaultButton">
                                 Default placeholder value (empty or custom message)
                                <li>
                                    <a href="#" class="dropdown-item text-gray-500">Select a Section</a>
                                </li>
                                 Dropdown items will be injected here by AJAX
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>


            @if (session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif

            <div class="mt-0 text-[14px] font-semibold w-full px-5">
                <ul
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-8 gap-0 xl:gap-0 bg-gray-50 p-0 m-0">
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 active1 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#first">First Quarter</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#second">Second Quarter</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#third">Third Quater</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#fourth">Fourth Quarter</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#summary">Grade Summary</li>
                </ul>

                <button
                    class="float-right text-white font-semibold text-md bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 px-10 rounded-lg mr-10"
                    id="save"><i class="fa-solid fa-floppy-disk me-2"></i>Save<button>
            </div>
            <!-- component -->
            <div class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container"
                    id="first">
                    <div class="p-5 overflow-x-scroll">
                        <table id="gradetable" class="bg-white overflow-x-scroll">
                            <thead>
                                <tr class="text-[8px] font-normal uppercase text-left text-black">
                                    <th class="export"></th>
                                    <th class="export" width="10%"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                </tr>

                            </thead>
                            <tbody id="tableBody">
                                @foreach ($TeacherSubject as $index => $teachersubject)
                                                                @php
                                                                    // Extract the subject name from the active link
                                                                    $currentUrl = url()->current();
                                                                    $urlParts = explode('/', $currentUrl);
                                                                    $subjectName = end($urlParts); // Get the last part of the URL as the subject name
                                                                    $subjectName = urldecode(str_replace('%20', ' ', $subjectName)); // Decode the subject name
                                                                @endphp

                                                                @if ($TeacherSubject && $teachersubject->quarter == "1st Quarter" && $teachersubject->subject == $subjectName)
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-2" colspan="2">QUARTER :
                                                                            {{ $teachersubject->quarter }}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="11">GRADE AND SECTION :
                                                                            {{ $teachersubject->grade . '- ' . $teachersubject->section}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">TECHER :
                                                                            {{ session('teacher_fname') . ' ' . session('teacher_mname') . ' ' . session('teacher_lname')}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="8" id="subject">SUBJECT :
                                                                            {{ $teachersubject->subject }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-5" colspan="1"></td>
                                                                        <td class="export border-2 border-gray-900 py-5" colspan="1">Learner's Name</td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">Written Works (30%)</td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">Performance Works (50%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="3">Quarterly Assessment (20%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="1" rowspan="3">Initial Grade
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="1" rowspan="3">Quarterly Grade
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td
                                                                            class="export border-2 text-center border-gray-900 w-[100px] pe-[15rem] text-start">
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                    </tr>

                                                                    <tr class="hover:bg-gray-100">
                                                                        <td class="export border-2 text-center border-gray-900">

                                                                        </td>
                                                                        <td class="export border-2 border-gray-900">
                                                                            Possible Highest Score</td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_two" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_three" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_four" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_five" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_six" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_seven" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_eight" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_nine" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_ten" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ws }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_two" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_three" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_four" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_five" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_six" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_seven" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_eight" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_nine" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_ten" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ws }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_q_assessment_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_q_assessment_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ws }}
                                                                        </td>
                                                                    </tr>


                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start">
                                                                            Male</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Male" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="initial_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="quarterly_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach

                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start">
                                                                            Female</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Female" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="initial_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="quarterly_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container"
                    id="second" style="display:none;">
                    <div class="p-5 overflow-x-scroll">
                        <table id="gradetable" class="bg-white overflow-x-scroll">
                            <thead>
                                <tr class="text-[8px] font-normal uppercase text-left text-black">
                                    <th class="export"></th>
                                    <th class="export" width="10%"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                </tr>

                            </thead>
                            <tbody id="tableBody">
                                @foreach ($TeacherSubject as $index => $teachersubject)
                                                                @php
                                                                    // Extract the subject name from the active link
                                                                    $currentUrl = url()->current();
                                                                    $urlParts = explode('/', $currentUrl);
                                                                    $subjectName = end($urlParts); // Get the last part of the URL as the subject name
                                                                    $subjectName = urldecode(str_replace('%20', ' ', $subjectName)); // Decode the subject name
                                                                @endphp

                                                                @if ($TeacherSubject && $teachersubject->quarter == "2nd Quarter" && $teachersubject->subject == $subjectName)
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-2" colspan="2">QUARTER :
                                                                            {{ $teachersubject->quarter }}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="11">GRADE AND SECTION :
                                                                            {{ $teachersubject->grade . '- ' . $teachersubject->section}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">TECHER :
                                                                            {{ session('teacher_fname') . ' ' . session('teacher_mname') . ' ' . session('teacher_lname')}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="8" id="subject">SUBJECT :
                                                                            {{ $teachersubject->subject }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-5" colspan="1"></td>
                                                                        <td class="export border-2 border-gray-900 py-5" colspan="1">Learner's Name</td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">Written Works (30%)</td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">Performance Works (50%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="3">Quarterly Assessment (20%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="1" rowspan="3">Initial Grade
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="1" rowspan="3">Quarterly Grade
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td
                                                                            class="export border-2 text-center border-gray-900 w-[100px] pe-[15rem] text-start">
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                    </tr>
                                                                    <tr class="hover:bg-gray-100">
                                                                        <td class="export border-2 text-center border-gray-900">

                                                                        </td>
                                                                        <td class="export border-2 border-gray-900">
                                                                            Possible Highest Score</td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_two" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_three" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_four" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_five" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_six" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_seven" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_eight" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_nine" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_ten" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ws }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_two" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_three" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_four" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_five" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_six" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_seven" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_eight" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_nine" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_ten" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ws }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_q_assessment_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_q_assessment_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ws }}
                                                                        </td>
                                                                    </tr>

                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start">
                                                                            Male</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Male" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="initial_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="quarterly_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach

                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start">
                                                                            Female</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Female" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="initial_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="quarterly_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container" id="third"
                    style="display:none;">
                    <div class="p-5 overflow-x-scroll">
                        <table id="gradetable" class="bg-white overflow-x-scroll">
                            <thead>
                                <tr class="text-[8px] font-normal uppercase text-left text-black">
                                    <th class="export"></th>
                                    <th class="export" width="10%"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                </tr>

                            </thead>
                            <tbody id="tableBody">
                                @foreach ($TeacherSubject as $index => $teachersubject)
                                                                @php
                                                                    // Extract the subject name from the active link
                                                                    $currentUrl = url()->current();
                                                                    $urlParts = explode('/', $currentUrl);
                                                                    $subjectName = end($urlParts); // Get the last part of the URL as the subject name
                                                                    $subjectName = urldecode(str_replace('%20', ' ', $subjectName)); // Decode the subject name
                                                                @endphp

                                                                @if ($TeacherSubject && $teachersubject->quarter == "3rd Quarter" && $teachersubject->subject == $subjectName)
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-2" colspan="2">QUARTER :
                                                                            {{ $teachersubject->quarter }}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="11">GRADE AND SECTION :
                                                                            {{ $teachersubject->grade . '- ' . $teachersubject->section}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">TECHER :
                                                                            {{ session('teacher_fname') . ' ' . session('teacher_mname') . ' ' . session('teacher_lname')}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="8" id="subject">SUBJECT :
                                                                            {{ $teachersubject->subject }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-5" colspan="1"></td>
                                                                        <td class="export border-2 border-gray-900 py-5" colspan="1">Learner's Name</td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">Written Works (30%)</td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">Performance Works (50%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="3">Quarterly Assessment (20%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="1" rowspan="3">Initial Grade
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="1" rowspan="3">Quarterly Grade
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td
                                                                            class="export border-2 text-center border-gray-900 w-[100px] pe-[15rem] text-start">
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                    </tr>

                                                                    <tr class="hover:bg-gray-100">
                                                                        <td class="export border-2 text-center border-gray-900">

                                                                        </td>
                                                                        <td class="export border-2 border-gray-900">
                                                                            Possible Highest Score</td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_two" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_three" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_four" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_five" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_six" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_seven" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_eight" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_nine" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_ten" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ws }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_two" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_three" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_four" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_five" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_six" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_seven" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_eight" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_nine" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_ten" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ws }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_q_assessment_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_q_assessment_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ws }}
                                                                        </td>
                                                                    </tr>

                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start">
                                                                            Male</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Male" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="initial_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="quarterly_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach

                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start">
                                                                            Female</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Female" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="initial_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="quarterly_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container"
                    id="fourth" style="display:none;">
                    <div class="p-5 overflow-x-scroll">
                        <table id="gradetable" class="bg-white overflow-x-scroll">
                            <thead>
                                <tr class="text-[8px] font-normal uppercase text-left text-black">
                                    <th class="export"></th>
                                    <th class="export" width="10%"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                    <th class="export"></th>
                                </tr>

                            </thead>
                            <tbody id="tableBody">
                                @foreach ($TeacherSubject as $index => $teachersubject)
                                                                @php
                                                                    // Extract the subject name from the active link
                                                                    $currentUrl = url()->current();
                                                                    $urlParts = explode('/', $currentUrl);
                                                                    $subjectName = end($urlParts); // Get the last part of the URL as the subject name
                                                                    $subjectName = urldecode(str_replace('%20', ' ', $subjectName)); // Decode the subject name
                                                                @endphp

                                                                @if ($TeacherSubject && $teachersubject->quarter == "4th Quarter" && $teachersubject->subject == $subjectName)
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-2" colspan="2">QUARTER :
                                                                            {{ $teachersubject->quarter }}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="11">GRADE AND SECTION :
                                                                            {{ $teachersubject->grade . '- ' . $teachersubject->section}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">TECHER :
                                                                            {{ session('teacher_fname') . ' ' . session('teacher_mname') . ' ' . session('teacher_lname')}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="8" id="subject">SUBJECT :
                                                                            {{ $teachersubject->subject }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900 py-5" colspan="1"></td>
                                                                        <td class="export border-2 border-gray-900 py-5" colspan="1">Learner's Name</td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">Written Works (30%)</td>
                                                                        <td class="export border-2 border-gray-900" colspan="13">Performance Works (50%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="3">Quarterly Assessment (20%)
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="1" rowspan="3">Initial Grade
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="1" rowspan="3">Quarterly Grade
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td
                                                                            class="export border-2 text-center border-gray-900 w-[100px] pe-[15rem] text-start">
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">2</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">3</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">4</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">5</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">6</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">7</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">8</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">9</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">10</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">Total</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                        <td class="export border-2 text-center border-gray-900 px-2">1</td>
                                                                        <td class="export border-2 text-center border-gray-900">PS</td>
                                                                        <td class="export border-2 text-center border-gray-900">WS</td>
                                                                    </tr>

                                                                    <tr class="hover:bg-gray-100">
                                                                        <td class="export border-2 text-center border-gray-900">

                                                                        </td>
                                                                        <td class="export border-2 border-gray-900">
                                                                            Possible Highest Score</td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_two" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_three" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_four" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_five" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_six" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_seven" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_eight" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_nine" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_written_ten" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_written_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_written_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->written_ws }}%
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_two" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_two }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_three" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_three }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_four" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_four }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_five" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_five }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_six" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_six }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_seven" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_seven }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_eight" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_eight }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_nine" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_nine }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_performance_ten" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_performance_ten }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_performance_total }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->performance_ws }}%
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                            data-column="hps_q_assessment_one" data-id="{{ $teachersubject->id }}">
                                                                            {{ $teachersubject->hps_q_assessment_one }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ps }}
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            {{ $teachersubject->hps_q_assessment_ws }}%
                                                                        </td>
                                                                    </tr>

                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start">
                                                                            Male</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Male" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="initial_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="quarterly_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach

                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</td>
                                                                        <td class="export border-2 text-center border-gray-900 w-[100px] text-start">
                                                                            Female</td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    @php $iteration = 1; @endphp
                                                                    @foreach ($students as $student)
                                                                        @if ($student && $student->gender == "Female" && $student->scholl_year == $teachersubject->scholl_year && $student->quarter == $teachersubject->quarter && $student->subject == $teachersubject->subject)
                                                                            <tr class="hover:bg-gray-100">
                                                                                <td class="export border-2 text-center border-gray-900">
                                                                                    {{ $iteration++ }}
                                                                                </td>
                                                                                <td class="export border-2  border-gray-900">
                                                                                    {{ $student->first_name }} {{ $student->middle_name }}
                                                                                    {{ $student->last_name }} {{ $student->suffix }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="written_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->written_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_two_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_two_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_three_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_three_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_four_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_four_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_five_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_five_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_six_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_six_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_seven_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_seven_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_eight_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_eight_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_nine_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_nine_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ten_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ten_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_total_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_total_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="performance_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->performance_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_one_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_one_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ps_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ps_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="q_assessment_ws_score" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->q_assessment_ws_score }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="initial_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->initial_grade }}
                                                                                </td>
                                                                                <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                    data-column="quarterly_grade" data-id="{{ $student->id }}"
                                                                                    data-grade="{{ $student->grade }}">
                                                                                    {{ $student->quarterly_grade }}
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container"
                    id="summary" style="display:none;">
                    <div class="p-5 overflow-x-scroll">
                        <table id="gradetable" class="bg-white overflow-x-scroll w-full">
                            <thead>
                                <tr class="text-[8px] font-normal uppercase text-left text-black">
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                    <th class="export border-2 text-center border-gray-900"></th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ($TeacherSubject as $index => $teachersubject)
                                                                @php
                                                                    // Extract the subject name from the active link
                                                                    $currentUrl = url()->current();
                                                                    $urlParts = explode('/', $currentUrl);
                                                                    $subjectName = end($urlParts); // Get the last part of the URL as the subject name
                                                                    $subjectName = urldecode(str_replace('%20', ' ', $subjectName)); // Decode the subject name
                                                                @endphp
                                                                @if ($TeacherSubject && $teachersubject->quarter == "1st Quarter" && $teachersubject->subject == $subjectName)
                                                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 border-gray-900" colspan="3">GRADE AND SECTION :
                                                                            {{ $teachersubject->grade . '- ' . $teachersubject->section}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="2">TECHER :
                                                                            {{ session('teacher_fname') . ' ' . session('teacher_mname') . ' ' . session('teacher_lname')}}
                                                                        </td>
                                                                        <td class="export border-2 border-gray-900" colspan="2" id="subject">SUBJECT :
                                                                            {{ $teachersubject->subject }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="text-[8px] font-normal uppercase text-left text-black">
                                                                        <td class="export border-2 text-center border-gray-900">#</th>
                                                                        <td class="export border-2 text-center border-gray-900">Name</th>
                                                                        <td class="export border-2 text-center border-gray-900">1st Quarter</td>
                                                                        <td class="export border-2 text-center border-gray-900">2nd Quarter</td>
                                                                        <td class="export border-2 text-center border-gray-900">3rd Quarter</td>
                                                                        <td class="export border-2 text-center border-gray-900">4th Quarter</td>
                                                                        <td class="export border-2 text-center border-gray-900">Final Grade</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            Male
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>
                                                                    <tr class="hover:bg-gray-100">
                                                                        @php $iteration = 1; @endphp
                                                                        @foreach ($StudentFinals as $StudentFinal)
                                                                                @if ($StudentFinal && $StudentFinal->gender == "Male" && $StudentFinal->scholl_year == $teachersubject->scholl_year && $StudentFinal->subject == $teachersubject->subject)
                                                                                    <tr class="hover:bg-gray-100">
                                                                                        <td class="export border-2 text-center border-gray-900">
                                                                                            {{ $iteration++ }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900">
                                                                                            {{ $StudentFinal->first_name }} {{ $StudentFinal->middle_name }}
                                                                                            {{ $StudentFinal->last_name }} {{ $StudentFinal->suffix }}
                                                                                        </td>
                                                                                        <td class="export border-2 text-center border-gray-900" contenteditable="true"
                                                                                            data-column="first_quarter_grade" data-id="{{ $StudentFinal->id }}"
                                                                                            data-subject="{{ $StudentFinal->subject }}">
                                                                                            {{ $StudentFinal->first_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900" contenteditable="true"
                                                                                            data-column="second_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->second_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900" contenteditable="true"
                                                                                            data-column="third_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->third_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900" contenteditable="true"
                                                                                            data-column="fourth_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->fourth_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900">
                                                                                            {{ $StudentFinal->final_grade }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                        @endforeach
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900">
                                                                            Female
                                                                        </td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                        <td class="export border-2 text-center border-gray-900"></td>
                                                                    </tr>

                                                                    <tr class="hover:bg-gray-100">
                                                                        @php $iteration = 1; @endphp
                                                                        @foreach ($StudentFinals as $StudentFinal)
                                                                                @if ($StudentFinal && $StudentFinal->gender == "Female" && $StudentFinal->scholl_year == $teachersubject->scholl_year && $StudentFinal->subject == $teachersubject->subject)
                                                                                    <tr class="hover:bg-gray-100">
                                                                                        <td class="export border-2 text-center border-gray-900">
                                                                                            {{ $iteration++ }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900">
                                                                                            {{ $StudentFinal->first_name }} {{ $StudentFinal->middle_name }}
                                                                                            {{ $StudentFinal->last_name }} {{ $StudentFinal->suffix }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900" contenteditable="true"
                                                                                            data-column="first_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->first_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900" contenteditable="true"
                                                                                            data-column="second_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->second_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900" contenteditable="true"
                                                                                            data-column="third_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->third_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900" contenteditable="true"
                                                                                            data-column="fourth_quarter_grade" data-subject="{{ $StudentFinal->subject }}"
                                                                                            data-id="{{ $StudentFinal->id }}">
                                                                                            {{ $StudentFinal->fourth_quarter_grade }}
                                                                                        </td>
                                                                                        <td class="export border-2  border-gray-900">
                                                                                            {{ $StudentFinal->final_grade }}
                                                                                        </td>
                                                                                    </tr>
                                                                                @endif
                                                                        @endforeach
                                                                    </tr>
                                                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </main>
    </div>


    <script src="{{ asset('../js/admin/admin.js') }}"></script>
    @include('admin.includes.js-link')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function () {
            $('td[contenteditable="true"]').on('blur', function () {
                var updatedValue = $(this).text();
                var column = $(this).data('column');
                var id = $(this).data('id');
                var grade = $(this).data('grade'); // This will be undefined for Teacher
                var subject = $(this).data('subject');

                // Determine which URL and grade to use
                var url = '';
                var data = {
                    id: id,
                    column: column,
                    value: updatedValue,
                    _token: '{{ csrf_token() }}'
                };

                if (grade) {
                    // This is for student
                    url = '/student/update-inline';
                    data.grade = grade; // Only add grade for students
                } else if (subject) {
                    url = '/student/update-inlin/final';
                } else {
                    // This is for teacher
                    url = '/teacher-subject-class/update-inline';
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.success) {

                        } else {
                            alert('Failed to update data!');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error details:', error);

                    }
                });
            });

            $('#save').on('click', function () {
                alert('Data has been saved successfully!');

                window.location.reload();
            });
        });
    </script>

</body>

<style>
    td[contenteditable="true"] {
        background-color: #f1f1f1;
    }

    td[contenteditable="true"] {
        background-color: #e1f7d5;
    }


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
        transform: scale(1.1);
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