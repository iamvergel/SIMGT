@include('student.includes.header')

<body class="font-poppins bg-gray-200">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('student.includes.sidebar')

        <!-- Main Content -->
        <main
            class="flex-grow rounded-none lg:rounded-r-lg lg:rounded-l-none bg-white shadow-lg overflow-hidden overflow-y-scroll">
            @include('student.includes.topnav')

            <div class="p-5 py-3">
                <p class="text-[15px] font-normal text-teal-900 mt-5">Student</p>
                <h1 class="text-xl font-bold text-teal-900">Student Grades </h1>
            </div>

            <input type="hidden" id="studentNumber" value="{{ session('student_id') }}">
            <input type="hidden" id="studentName" value="{{ session('student_last_name') . ' ' . session('student_first_name') . ' ' . session('student_middle_name') }}">
            <input type="hidden" id="gender" value="{{ session('sex') }}">
            <input type="hidden" id="grade" value="{{ session('gradea') }}">
            <input type="hidden" id="section" value="{{ session('sectiona') }}">
            <input type="hidden" id="schoolYear" value="{{ session('school_yeara') }}">
            <input type="hidden" id="status" value="{{ session('statusa') }}">
            <input type="hidden" id="lrn" value="{{ session('lrna') }}">


            <div class="grid grid-cols-2">
                <div class="col-span-2 lg:col-span-2">
                    <div class="lg:p-5">
                        <div id="studentModal" class="p-3 lg:p-10 relative w-full min-h-screen bg-gray-100">
                            <div class="relative">
                                <div class="mt-5 text-[14px] font-semibold w-full">
                                    <ul
                                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-8 gap-0 xl:gap-0 bg-gray-50 p-0 m-0">
                                        <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-1 active1"
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
                                <div class=" border-0 border-t-4 border-teal-800 h-full pt-5">
                                    <div class="px-2">
                                        <div>
                                            <div class="table-container w-full" id="gradeOne">
                                                <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                    <table
                                                        class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Learning Areas
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    colspan="4">
                                                                    Periodic Rating
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Final Grade
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
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

                                                            @foreach ($grades as $grade)
                                                                @if ($grade->grade == "Grade One")
                                                                    @php
                                                                        $gradeOneExists = true;
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
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->subject }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->first_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->second_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->third_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->fourth_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->final_grade }}</td>
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

                                                            @if (!$gradeOneExists)
                                                                <tr>
                                                                    <td colspan="7" class="text-center border-2 px-4 py-2">No Data Available</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>

                                                        @if ($allGradesAvailable && $count > 0)
                                                            <tfoot>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        General Average</td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        {{ round($totalFinalGrade / $count, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
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
                                                <div id="gradesContainer" class="my-10 flex justify-end gap-5">
                                                    @if ($allGradesAvailable && $gradeOneExists)
                                                        <button id="downloadHtmlButton"
                                                            class="bg-teal-700 hover:bg-teal-800 text-lg font-semibold text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-file-pdf me-2"></i>Download
                                                            As
                                                            PDF</button>
                                                        <button id="printHtmlButton" class="bg-sky-700 text-lg font-semibold hover:bg-sky-800 text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-print me-2"></i>Print Report</button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="table-container w-full" id="gradeTwo"
                                                style="display: none;">
                                                <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                    <table
                                                        class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Learning Areas
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    colspan="4">
                                                                    Periodic Rating
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Final Grade
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
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

                                                            @foreach ($grades as $grade)
                                                                @if ($grade->grade == "Grade Two")
                                                                    @php
                                                                        $gradeTwoExists = true;
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
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->subject }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->first_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->second_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->third_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->fourth_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->final_grade }}</td>
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

                                                            @if (!$gradeTwoExists)
                                                                <tr>
                                                                    <td colspan="7" class="text-center border-2 px-4 py-2">No Grades Available</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>

                                                        @if ($allGradesAvailable && $count > 0)
                                                            <tfoot>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        General Average</td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        {{ round($totalFinalGrade / $count, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
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
                                                <div id="gradesContainerTwo" class="my-10 flex justify-end gap-5">
                                                    @if ($allGradesAvailable && $gradeTwoExists)
                                                        <button id="downloadHtmlButtonTwo"
                                                            class="bg-teal-700 hover:bg-teal-800 text-lg font-semibold text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-file-pdf me-2"></i>Download
                                                            As
                                                            PDF</button>
                                                        <button id="printHtmlButtonTwo" class="bg-sky-700 text-lg font-semibold hover:bg-sky-800 text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-print me-2"></i>Print Report</button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="table-container w-full mt-10 pb-10" id="gradeThree"
                                                style="display: none;">
                                                <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                    <table
                                                        class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Learning Areas
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    colspan="4">
                                                                    Periodic Rating
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Final Grade
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
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

                                                            @foreach ($grades as $grade)
                                                                @if ($grade->grade == "Grade Three")
                                                                    @php
                                                                        $gradeThreeExists = true;
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
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->subject }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->first_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->second_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->third_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->fourth_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->final_grade }}</td>
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

                                                            @if (!$gradeThreeExists)
                                                                <tr>
                                                                    <td colspan="7" class="text-center border-2 px-4 py-2">No Grades Available</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>

                                                        @if ($allGradesAvailable && $count > 0)
                                                            <tfoot>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        General Average</td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        {{ round($totalFinalGrade / $count, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
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
                                                <div id="gradesContainerThree" class="my-10 flex justify-end gap-5">
                                                    @if ($allGradesAvailable && $gradeThreeExists)
                                                        <button id="downloadHtmlButtonThree"
                                                            class="bg-teal-700 hover:bg-teal-800 text-lg font-semibold text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-file-pdf me-2"></i>Download
                                                            As
                                                            PDF</button>
                                                        <button id="printHtmlButtonThree" class="bg-sky-700 text-lg font-semibold hover:bg-sky-800 text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-print me-2"></i>Print Report</button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="table-container w-full mt-10 pb-10" id="gradeFour"
                                                style="display: none;">
                                                <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                    <table
                                                        class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Learning Areas
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    colspan="4">
                                                                    Periodic Rating
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Final Grade
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
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

                                                            @foreach ($grades as $grade)
                                                                @if ($grade->grade == "Grade Four")
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
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->subject }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->first_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->second_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->third_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->fourth_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->final_grade }}</td>
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
                                                                    <td colspan="7" class="text-center border-2 px-4 py-2">No Grades Available</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>

                                                        @if ($allGradesAvailable && $count > 0)
                                                            <tfoot>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        General Average</td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        {{ round($totalFinalGrade / $count, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
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
                                                <div id="gradesContainerFour" class="my-10 flex justify-end gap-5">
                                                    @if ($allGradesAvailable && $gradeFourExists)
                                                        <button id="downloadHtmlButtonFour"
                                                            class="bg-teal-700 hover:bg-teal-800 text-lg font-semibold text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-file-pdf me-2"></i>Download
                                                            As
                                                            PDF</button>
                                                        <button id="printHtmlButtonFour" class="bg-sky-700 text-lg font-semibold hover:bg-sky-800 text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-print me-2"></i>Print Report</button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="table-container w-full mt-10 pb-10" id="gradeFive"
                                                style="display: none;">
                                                <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                    <table
                                                        class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Learning Areas
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    colspan="4">
                                                                    Periodic Rating
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Final Grade
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
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

                                                            @foreach ($grades as $grade)
                                                                @if ($grade->grade == "Grade Five")
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
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->subject }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->first_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->second_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->third_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->fourth_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->final_grade }}</td>
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
                                                                    <td colspan="7" class="text-center border-2 px-4 py-2">No Grades Available</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>

                                                        @if ($allGradesAvailable && $count > 0)
                                                            <tfoot>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        General Average</td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        {{ round($totalFinalGrade / $count, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
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
                                                <div id="gradesContainerFive" class="my-10 flex justify-end gap-5">
                                                    @if ($allGradesAvailable && $gradeFiveExists)
                                                        <button id="downloadHtmlButtonFive"
                                                            class="bg-teal-700 hover:bg-teal-800 text-lg font-semibold text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-file-pdf me-2"></i>Download
                                                            As
                                                            PDF</button>
                                                        <button id="printHtmlButtonFive" class="bg-sky-700 text-lg font-semibold hover:bg-sky-800 text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-print me-2"></i>Print Report</button>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="table-container w-full mt-10 pb-10" id="gradeSix"
                                                style="display: none;">
                                                <div class="bg-white p-3 lg:p-5 rounded-lg shadow-lg overflow-x-scroll">
                                                    <table
                                                        class="p-3 display border overflow-x-scroll lg:p-5" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Learning Areas
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    colspan="4">
                                                                    Periodic Rating
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
                                                                    Final Grade
                                                                </th>
                                                                <th class="px-4 py-2 border border-gray-600 export"
                                                                    rowspan="2">
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

                                                            @foreach ($grades as $grade)
                                                                @if ($grade->grade == "Grade Six")
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
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->subject }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->first_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->second_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->third_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->fourth_quarter_grade }}</td>
                                                                        <td class="border border-gray-600 text-center px-4 py-2">{{ $grade->final_grade }}</td>
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
                                                                    <td colspan="7" class="text-center border-2 px-4 py-2">No Grades Available</td>
                                                                </tr>
                                                            @endif
                                                        </tbody>

                                                        @if ($allGradesAvailable && $count > 0)
                                                            <tfoot>
                                                                <tr>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        General Average</td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
                                                                        {{ round($totalFinalGrade / $count, 2) }}
                                                                    </td>
                                                                    <td
                                                                        class="border border-gray-600 text-center px-4 py-2">
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
                                                            class="bg-teal-700 hover:bg-teal-800 text-lg font-semibold text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-file-pdf me-2"></i>Download
                                                            As
                                                            PDF</button>
                                                        <button id="printHtmlButtonSix" class="bg-sky-700 text-lg font-semibold hover:bg-sky-800 text-white py-2 px-4 rounded mt-4"><i class="fa-solid fa-print me-2"></i>Print Report</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
    @include('admin.includes.js-link')
    <script src="{{ asset('../js/student/studentgrade.js') }}" type="text/javascript"></script>
</body>

<style>
    .active1 {
        background-color: #115e59;
        color: white;
        font-weight: bold;
        transform: scale(1.030);
    }
</style>

</html>