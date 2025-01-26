<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>St. Emilie Learning Center</title>
    <link rel="shortcut icon" href="{{ asset('../assets/images/SELC.png') }}" type="image/x-icon"
        style="border-radius: 50%;">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/20a0e1e87d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.0/css/buttons.dataTables.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
            scrollbar-width: none;
            transition: all 0.3s ease;
            cursor: default;
        }

        .dataTables_filter input {
            width: 200px;
            font-size: 14px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }

        .dataTables_filter label {
            font-size: 14px;
            margin-right: 10px;
        }
    </style>
</head>

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex p-2 w-full h-screen">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="">
                @include('admin.includes.topnav')
            </header>

            <div class="p-5">
            <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span onclick="window.location.href ='/StEmelieLearningCenter.HopeSci66/admin/Grade-book'"
                            class="hover:text-teal-700">Grade Book</span> / Grade Three
                    </p>
                </div>
                <div class="flex justify-end items-center gap-4 mt-10">
                    <div class="ml-5 flex items-center hidden">
                        <i class="fas fa-search text-xl text-teal-700 px-3"></i>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name..."
                            class="text-sm px-4 py-3 text-teal-900 border border-gray-300 rounded-lg w-96 shadow-lg focus:outline-none" />
                    </div>

                    <div class="mr-10">
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Select Section <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown"
                            class="z-10 fixed hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="p-2 text-md text-gray-700 dark:text-gray-200 shadow-lg"
                                aria-labelledby="dropdownDefaultButton">
                                <!-- Default placeholder value (empty or custom message) -->
                                <li>
                                    <a href="#" class="dropdown-item text-gray-500">Select a Section</a>
                                </li>
                                <!-- Dropdown items will be injected here by AJAX -->
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Main modal -->
                @include('admin.includes.student_input_grade')
                @include('admin.includes.student_edit_grade')

                @if (session('success'))
                    <script>
                        alert("{{ session('success') }}");
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        alert("{{ session('error') }}");
                    </script>
                @endif


                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                    <div class="w-full bg-white mb-8 overflow-hidden rounded-lg shadow-lg text-[12px]">
                        @if ($noGradeThreeMessage)
                            <p class="text-red-600 text-center text-md">{{ $noGradeThreeMessage }}</p>
                        @else
                                            <div class="table-responsive p-5">
                                                <table id="studentTable" class="display w-full p-5">
                                                    <thead class="table-header bg-gray-100">
                                                        <tr class="text-md font-semibold tracking-wide text-left uppercase border">
                                                            <th class="px-4 py-3">Student Number</th>
                                                            <th class="px-4 py-3">Status</th>
                                                            <th class="px-4 py-3">Name</th>
                                                            <th class="px-4 py-3">Grade</th>
                                                            <th class="px-4 py-3">Section</th>
                                                            <th class="px-4 py-3">quarters</th>
                                                            <th class="px-4 py-3">Average</th>
                                                            <th class="px-4 py-3">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white" id="tableBody">
                                                        @foreach ($students as $student)
                                                                                        <tr class="text-gray-700 table-row">
                                                                                            <td class="px-4 py-3 h-40 border flex items-center justify-center">
                                                                                                <div
                                                                                                    class="w-10 h-10 rounded-full bg-gray-500 text-white flex items-center justify-center font-bold">
                                                                                                    {{ strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1)) }}
                                                                                                </div>
                                                                                                <span class="ml-2">{{ $student->student_number }}</span>
                                                                                            </td>
                                                                                            <td class="px-4 py-3 text-xs border">
                                                                                                <span
                                                                                                    class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                                                                    {{ $student->status }}
                                                                                                </span>
                                                                                            </td>
                                                                                            <td class="px-4 py-3 border">
                                                                                                {{ $student->student_last_name . ', ' . $student->student_first_name }}
                                                                                            </td>
                                                                                            <td class="px-4 py-3 border">{{ $student->grade }}</td>
                                                                                            <td class="px-4 py-3 border">{{ $student->section }}</td>
                                                                                            <td class="px-4 py-3 border">
                                                                                                @foreach ($student->gradebookThree as $grade)
                                                                                                    <strong>{{ $grade->quarter }}<br></strong>
                                                                                                @endforeach
                                                                                            </td>
                                                                                            <td class="px-4 py-3 border">
                                                                                                <div>
                                                                                                    <strong>1st Quarter:</strong><br>
                                                                                                    {{ isset($student->quarter_averages['1st Quarter']) ? number_format($student->quarter_averages['1st Quarter'], 2) : 'N/A' }}<br>
                                                                                                    <strong>2nd Quarter:</strong><br>
                                                                                                    {{ isset($student->quarter_averages['2nd Quarter']) ? number_format($student->quarter_averages['2nd Quarter'], 2) : 'N/A' }}<br>
                                                                                                    <strong>3rd Quarter :</strong><br>
                                                                                                    {{ isset($student->quarter_averages['3rd Quarter']) ? number_format($student->quarter_averages['3rd Quarter'], 2) : 'N/A' }}<br>
                                                                                                    <strong>4th Quarter :</strong><br>
                                                                                                    {{ isset($student->quarter_averages['4th Quarter']) ? number_format($student->quarter_averages['4th Quarter'], 2) : 'N/A' }}<br>
                                                                                                    <strong>Final Average:</strong><br>
                                                                                                    {{ $student->final_grade ? number_format($student->final_grade, 2) : 'N/A' }}
                                                                                                </div>
                                                                                            </td>

                                                                                            <td>
                                                                                                <div class="px-4 py-3 border">
                                                                                                    <button data-modal-target="inputstudentgrade"
                                                                                                        data-modal-toggle="inputstudentgrade"
                                                                                                        data-student-number="{{ $student->student_number }}"
                                                                                                        data-student-grade="{{ $student->grade}}"
                                                                                                        class="block w-full text-center text-left px-5 py-2 my-1 text-[12px] text-white bg-teal-700 rounded hover:bg-teal-600"
                                                                                                        type="button" aria-label="Input Student">
                                                                                                        Add Grade
                                                                                                    </button>
                                                                                                    @php
                                                                                                        $firstQuarterGrades = null;
                                                                                                        $secondQuarterGrades = null;
                                                                                                        $thirdQuarterGrades = null;
                                                                                                        $fourthQuarterGrades = null;
                                                                                                        $quarter = null;

                                                                                                        foreach ($student->gradebookThree as $grade) {
                                                                                                            if ($grade->quarter === '1st Quarter') {
                                                                                                                $firstQuarterGrades = $grade;
                                                                                                            }
                                                                                                            if ($grade->quarter === '2nd Quarter') {
                                                                                                                $secondQuarterGrades = $grade;
                                                                                                            }
                                                                                                            if ($grade->quarter === '3rd Quarter') {
                                                                                                                $thirdQuarterGrades = $grade;
                                                                                                            }
                                                                                                            if ($grade->quarter === '4th Quarter') {
                                                                                                                $fourthQuarterGrades = $grade;
                                                                                                            }
                                                                                                        }
                                                                                                    @endphp

                                                                                                    @if ($firstQuarterGrades)
                                                                                                        <button data-modal-toggle="editstudentgrade"
                                                                                                            data-modal-target="editstudentgrade"
                                                                                                            data-student-number="{{ $student->student_number }}"
                                                                                                            data-name="{{ $student->student_last_name . ', ' . $student->student_first_name }}"
                                                                                                            data-grade="{{ $student->grade }}"
                                                                                                            data-section="{{ $student->section }}"
                                                                                                            data-quarter="{{$quarter = '1st Quarter'}}"
                                                                                                            data-subject-one="{{ $firstQuarterGrades->subject_one }}"
                                                                                                            data-subject-two="{{ $firstQuarterGrades->subject_two }}"
                                                                                                            data-subject-three="{{ $firstQuarterGrades->subject_three }}"
                                                                                                            data-subject-four="{{ $firstQuarterGrades->subject_four }}"
                                                                                                            data-subject-five="{{ $firstQuarterGrades->subject_five }}"
                                                                                                            data-subject-six="{{ $firstQuarterGrades->subject_six }}"
                                                                                                            data-subject-seven="{{ $firstQuarterGrades->subject_seven }}"
                                                                                                            data-subject-eight="{{ $firstQuarterGrades->subject_eight }}"
                                                                                                            data-subject-nine="{{ $firstQuarterGrades->subject_nine }}"
                                                                                                            class="block w-full text-center text-left px-5 py-2 my-1 text-[12px] text-white bg-sky-700 rounded hover:bg-sky-600"
                                                                                                            type="button" aria-label="Edit Student">
                                                                                                            Edit 1st Quarter Grades
                                                                                                        </button>
                                                                                                    @endif
                                                                                                    @if ($secondQuarterGrades)
                                                                                                        <button data-modal-toggle="editstudentgrade"
                                                                                                            data-modal-target="editstudentgrade"
                                                                                                            data-student-number="{{ $student->student_number }}"
                                                                                                            data-name="{{ $student->student_last_name . ', ' . $student->student_first_name }}"
                                                                                                            data-grade="{{ $student->grade }}"
                                                                                                            data-section="{{ $student->section }}"
                                                                                                            data-quarter="{{$quarter = '2nd Quarter'}}"
                                                                                                            data-subject-one="{{ $secondQuarterGrades->subject_one }}"
                                                                                                            data-subject-two="{{ $secondQuarterGrades->subject_two }}"
                                                                                                            data-subject-three="{{ $secondQuarterGrades->subject_three }}"
                                                                                                            data-subject-four="{{ $secondQuarterGrades->subject_four }}"
                                                                                                            data-subject-five="{{ $secondQuarterGrades->subject_five }}"
                                                                                                            data-subject-six="{{ $secondQuarterGrades->subject_six }}"
                                                                                                            data-subject-seven="{{ $secondQuarterGrades->subject_seven }}"
                                                                                                            data-subject-eight="{{ $secondQuarterGrades->subject_eight }}"
                                                                                                            data-subject-nine="{{ $secondQuarterGrades->subject_nine }}"
                                                                                                            class="block w-full text-center text-left px-5 py-2 my-1 text-[12px] text-white bg-sky-700 rounded hover:bg-sky-600"
                                                                                                            type="button" aria-label="Edit Student">
                                                                                                            Edit 2nd Quarter Grades
                                                                                                        </button>
                                                                                                    @endif
                                                                                                    @if ($thirdQuarterGrades)
                                                                                                        <button data-modal-toggle="editstudentgrade"
                                                                                                            data-modal-target="editstudentgrade"
                                                                                                            data-student-number="{{ $student->student_number }}"
                                                                                                            data-name="{{ $student->student_last_name . ', ' . $student->student_first_name }}"
                                                                                                            data-grade="{{ $student->grade }}"
                                                                                                            data-section="{{ $student->section }}"
                                                                                                            data-quarter="{{$quarter = '3rd Quarter'}}"
                                                                                                            data-subject-one="{{ $thirdQuarterGrades->subject_one }}"
                                                                                                            data-subject-two="{{ $thirdQuarterGrades->subject_two }}"
                                                                                                            data-subject-three="{{ $thirdQuarterGrades->subject_three }}"
                                                                                                            data-subject-four="{{ $thirdQuarterGrades->subject_four }}"
                                                                                                            data-subject-five="{{ $thirdQuarterGrades->subject_five }}"
                                                                                                            data-subject-six="{{ $thirdQuarterGrades->subject_six }}"
                                                                                                            data-subject-seven="{{ $thirdQuarterGrades->subject_seven }}"
                                                                                                            data-subject-eight="{{ $thirdQuarterGrades->subject_eight }}"
                                                                                                            data-subject-nine="{{ $thirdQuarterGrades->subject_nine }}"
                                                                                                            class="block w-full text-center text-left px-5 py-2 my-1 text-[12px] text-white bg-sky-700 rounded hover:bg-sky-600"
                                                                                                            type="button" aria-label="Edit Student">
                                                                                                            Edit 3rd Quarter Grades
                                                                                                        </button>
                                                                                                    @endif
                                                                                                    @if ($fourthQuarterGrades)
                                                                                                        <button data-modal-toggle="editstudentgrade"
                                                                                                            data-modal-target="editstudentgrade"
                                                                                                            data-student-number="{{ $student->student_number }}"
                                                                                                            data-name="{{ $student->student_last_name . ', ' . $student->student_first_name }}"
                                                                                                            data-grade="{{ $student->grade }}"
                                                                                                            data-section="{{ $student->section }}"
                                                                                                            data-quarter="{{$quarter = '4th Quarter'}}"
                                                                                                            data-subject-one="{{ $fourthQuarterGrades->subject_one }}"
                                                                                                            data-subject-two="{{ $fourthQuarterGrades->subject_two }}"
                                                                                                            data-subject-three="{{ $fourthQuarterGrades->subject_three }}"
                                                                                                            data-subject-four="{{ $fourthQuarterGrades->subject_four }}"
                                                                                                            data-subject-five="{{ $fourthQuarterGrades->subject_five }}"
                                                                                                            data-subject-six="{{ $fourthQuarterGrades->subject_six }}"
                                                                                                            data-subject-seven="{{ $fourthQuarterGrades->subject_seven }}"
                                                                                                            data-subject-eight="{{ $fourthQuarterGrades->subject_eight }}"
                                                                                                            data-subject-nine="{{ $fourthQuarterGrades->subject_nine }}"
                                                                                                            class="block w-full text-center text-left px-5 py-2 my-1 text-[12px] text-white bg-sky-700 rounded hover:bg-sky-600"
                                                                                                            type="button" aria-label="Edit Student">
                                                                                                            Edit 4th Quarter Grades
                                                                                                        </button>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script src="https://cdn.datatables.net/buttons/2.2.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.0/js/buttons.print.min.js"></script>

    <script>
        var table = $('#studentTable').DataTable({
            dom: ` 
            <'flex justify-between items-center mb-4'<'flex space-x-4'l><'flex space-x-4'B><'flex space-x-4'f>>` +
                `<tr>` +
                `<'flex justify-between items-center'<'flex-1'i><'flex-1'p>>`,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            buttons: [
                {
                    extend: 'copyHtml5',
                    className: '!bg-sky-800 !text-[12px] !text-white !border-none !hover:bg-sky-700 !px-4 !py-2 !rounded !flex !items-center !justify-center',
                    text: '<i class="fas fa-clipboard"></i> Copy',
                    titleAttr: 'Click to copy data'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel mr-2"></i> Excel',
                    className: '!bg-teal-700 !text-[12px] !text-white !border-none !hover:bg-green-500 !px-4 !py-2 !rounded !important !flex !items-center !justify-center',
                    titleAttr: 'Export to Excel',
                },
                {
                    extend: 'csvHtml5',
                    text: '<i class="fas fa-file-csv mr-2"></i> CSV',
                    className: '!bg-yellow-500 !text-[12px] !text-white !border-none !hover:bg-yellow-400 !px-4 !py-2 !rounded !flex !items-center !justify-center !important',
                    titleAttr: 'Export to CSV'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    className: '!bg-red-600 !text-[12px] !text-white !border-none !hover:bg-red-500 !px-4 !py-2 !rounded !flex !items-center !justify-center !important',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    titleAttr: 'Export to PDF',
                    customize: function (doc) {
                        doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    className: '!bg-blue-600 !text-[12px] !text-white !border-none !hover:bg-blue-500 !px-4 !py-2 !rounded !flex !items-center !justify-center !important',
                    orientation: 'landscape',
                    autoPrint: true,
                    titleAttr: 'Print Table',
                    customize: function (win) {
                        $(win.document.body).find('table').css('width', '100%');
                        $(win.document.body).find('table').css('font-size', '10px');
                    }
                },
            ],
            initComplete: function () {
                $('.dt-buttons').css({
                    'display': 'flex',
                    'justify-content': 'flex-end',
                    'width': '100%',
                });
            }
        });

        $(document).ready(function () {
            // When the dropdown button is clicked, make an AJAX call
            $('#dropdownDefaultButton').click(function () {
                // Toggle the dropdown visibility
                $('#dropdown').toggleClass('hidden');

                // Make an AJAX request to get the sections
                $.ajax({
                    url: '{{ route('get.threesections') }}', // The route for fetching sections
                    type: 'GET',
                    success: function (data) {
                        // Check if sections are returned
                        if (data.length > 0) {
                            // Empty the dropdown list
                            $('#dropdown ul').empty();

                            // Append the default placeholder as the first item
                            $('#dropdown ul').append('<li class="text-gray-500 hover:text-white hover:bg-teal-600 py-2 rounded-lg"><a href="#" class="dropdown-item"  data-section="">Select a Section</a></li>');

                            // Append each section as a list item in the dropdown
                            data.forEach(function (section) {
                                $('#dropdown ul').append('<li class="text-gray-500 hover:text-white hover:bg-teal-600 py-2 rounded-lg"><a href="#" class="dropdown-item" data-section="' + section + '">' + section + '</a></li>');
                            });
                        } else {
                            // If no sections, show a message
                            $('#dropdown ul').html('<li><a href="#" class="dropdown-item text-gray-500">No Sections Available</a></li>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("Error fetching sections: " + error);
                    }
                });

            });

            // Filter table by section when dropdown item is clicked
            $(document).on('click', '.dropdown-item', function (event) {
                event.preventDefault(); // Prevent default anchor click behavior

                const selectedSection = $(this).data('section');

                // Update the search input with the selected section
                $('#searchInput').val(selectedSection);

                // Trigger the search function and search the table
                table.search(selectedSection).draw();  // Directly apply the search to the DataTable

                // Close the dropdown after selection
                $('#dropdown').addClass('hidden');
            });

            // Close the dropdown if clicked outside
            $(document).click(function (event) {
                const dropdownButton = $('#dropdownDefaultButton');
                const dropdownMenu = $('#dropdown');

                // Close dropdown if clicked outside the dropdown button or menu
                if (!dropdownButton.is(event.target) && !dropdownMenu.is(event.target) && dropdownMenu.has(event.target).length === 0) {
                    dropdownMenu.addClass('hidden');
                }
            });
        });
    </script>
</body>

</html>