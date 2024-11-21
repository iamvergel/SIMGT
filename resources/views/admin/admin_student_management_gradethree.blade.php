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

        .dropdown {
            display: none;
        }

        .dropdown-active {
            display: block;
        }
    </style>
</head>

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex p-2 w-full h-screen">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header>
                @include('admin.includes.header')
            </header>

            <div class="p-5">
            <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span
                            onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
                            class="hover:text-teal-700">Student Management</span> / Grade Three
                    </p>
                </div>
                <div class="flex justify-end items-center gap-4 mt-10">
                    <div class="ml-5 flex items-center hidden">
                        <i class="fas fa-search text-xl text-teal-700 px-3"></i>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name..."
                            class="text-sm px-4 py-3 text-teal-900 border border-gray-300 rounded-lg w-96 shadow-lg focus:outline-none" />
                    </div>

                    <div class="flex">
                        <button data-modal-target="addnewstudent" data-modal-toggle="addnewstudent"
                            class="block w-86 right-0 mr-5 text-[12px] text-white shadow-lg px-10 bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded py-2.5 text-center"
                            type="button" aria-label="Add Student">
                            Add Student
                        </button>
                        <button
                            class="block w-86 right-0 mr-10 text-[12px] text-white shadow-lg px-10 bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded py-2.5 text-center"
                            onclick="window.location.href = '/StEmelieLearningCenter.HopeSci66/admin/student-management/AllStudentData'">
                            Show student data
                        </button>
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
                @include('admin.includes.add_student_form')
                @include('admin.includes.update_student_form') 

                @if (session('success'))
                    <script>
                        alert("{{ session('success') }}");
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
                                            <th class="px-4 py-3">Email</th>
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
                                                <td class="px-4 py-3 border">{{ $student->student_last_name }}
                                                    {{ $student->student_first_name }}
                                                </td>
                                                <td class="px-4 py-3 border">{{ $student->grade }}</td>
                                                <td class="px-4 py-3 border">{{ $student->section }}</td>
                                                <td class="px-4 py-3 border">{{ $student->email_address_send }}</td>
                                                <td class="px-4 py-3 border">
                                                    <form action="{{ route('account.reset', $student->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        <input class="hidden" type="text" name="defaultPassword"
                                                            value="{{ 'SELC' . $student->student_last_name . substr($student->student_number, -4) }}"
                                                            required>
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to reset this student\'s account?');"
                                                            class="block w-full text-center text-left px-2 py-2 my-1 text-[10px] text-white bg-sky-800 rounded hover:bg-sky-700">
                                                            Reset Account
                                                        </button>
                                                    </form>

                                                    <button data-modal-toggle="updatetudentinfo{{ $student->id }}"
                                                        data-modal-target="updatetudentinfo{{ $student->id }}"
                                                        class="block w-full text-center text-left px-5 py-2 my-1 text-[12px] text-white bg-teal-700 rounded hover:bg-teal-600"
                                                        type="button" aria-label="Update Student">
                                                        Update
                                                    </button>

                                                    <form action="{{ route('send.email', $student->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        <button type="submit"
                                                            class="block w-full text-center text-left px-3 py-2 my-1 text-[12px] text-white bg-cyan-700 rounded hover:bg-cyan-600">Send
                                                            Email</button>
                                                    </form>

                                                    <form action="{{ route('students.drop', $student->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to drop this student?');"
                                                            class="block w-full text-center text-left px-7 py-2 my-1 text-[12px] text-white bg-red-700 rounded hover:bg-red-600">Drop</button>
                                                    </form>
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

        // Improved modal toggle function
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle("hidden");
            modal.classList.toggle("flex");
        }

        // Event listeners for opening modals
        document.querySelector('[data-modal-target="addnewstudent"]').onclick = function () {
            toggleModal('addnewstudent');
        };

        // Event listeners for closing modals
        document.getElementById('addnewstudentClose').onclick = function () {
            toggleModal('addnewstudent');
        };

        // Event listeners for opening modals
        document.querySelectorAll('[data-modal-toggle^="updatetudentinfo"]').forEach(button => {
            button.onclick = function () {
                const modalId = button.getAttribute('data-modal-target');
                toggleModal(modalId);
            };
        });

        // Event listeners for closing modals
        document.querySelectorAll('[id^="updatetudentinfoClose"]').forEach(button => {
            button.onclick = function () {
                const modalId = 'updatetudentinfo' + button.id.replace('updatetudentinfoClose', '');
                toggleModal(modalId);
            };
        });

        // Optional: Close modal when clicking outside of it
        window.onclick = function (event) {
            const modalBackdrop = event.target.classList.contains('fixed');
            const isModal = event.target.closest('.modal'); // Assuming your modals have a class 'modal'

            if (modalBackdrop && !isModal) {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => modal.classList.add('hidden'));
            }
        };
    </script>
</body>

</html>