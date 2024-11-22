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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.0/css/buttons.dataTables.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scrollbar-width: thin;
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
                @include('admin.includes.header')
            </header>

            <div class="p-5">
                <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                <p class="text-2xl font-bold text-teal-900 ml-5">
                    <span
                        class="hover:text-teal-700">Report Section</span> / Graduate Student
                </p>
                <div class="w-24 mt-5 ml-5 text-[12px] text-white shadow-lg bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full py-2 text-center"
                    onclick="window.history.back();"><i class="fas fa-arrow-left" style="color: white;"></i> Go Back
                </div>

                <!-- Search Bar -->
                <div class="mt-10 ml-5 flex justify-between items-center hidden">
                    <div class="flex items-center">
                        <i class="fas fa-search text-xl text-teal-700 px-3"></i>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name..."
                            class="text-sm px-4 py-3 text-teal-900 border border-gray-300 rounded-lg w-80 shadow-lg focus:outline-none" />
                    </div>
                </div>

                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                    <div class="w-full bg-white mb-8 rounded-lg shadow-lg text-[12px]">
                        <div class="w-full h-full overflow-auto border-4 border-teal-50 rounded-lg p-5">
                            @if ($noGraduatesMessage)
                                <p class="text-red-600 text-center text-md">{{ $noGraduatesMessage }}</p>
                            @else
                                                    <table id="studentTable" class="display w-full h-full p-5" style="width: 200rem;">
                                                        <thead class="table-header bg-gray-100">
                                                            <tr class="text-md font-semibold tracking-wide text-left uppercase border">
                                                                <th class="px-4 py-3">Student Number</th>
                                                                <th class="px-4 py-3">LRN</th>
                                                                <th class="px-4 py-3">School Year</th>
                                                                <th class="px-4 py-3">Section</th>
                                                                <th class="px-4 py-3">Status</th>
                                                                <th class="px-4 py-3">Name</th>
                                                                <th class="px-4 py-3">Grade</th>
                                                                <th class="px-4 py-3">Email</th>
                                                                <th class="px-4 py-3">Place of Birth</th>
                                                                <th class="px-4 py-3">Date of Birth</th>
                                                                <th class="px-4 py-3">Sex</th>
                                                                <th class="px-4 py-3">Age</th>
                                                                <th class="px-4 py-3">Contact Number</th>
                                                                <th class="px-4 py-3">Religion</th>
                                                                <th class="px-4 py-3">Address</th>
                                                                <th class="px-4 py-3">Father's Name</th>
                                                                <th class="px-4 py-3">Mother's Name</th>
                                                                <th class="px-4 py-3">Guardian's Name</th>
                                                                <th class="px-4 py-3">Emergency Contact</th>
                                                                <th class="px-4 py-3">Contact Number</th>
                                                                <th class="px-4 py-3">Messenger Account</th>
                                                                <th class="px-4 py-3">PSA</th>
                                                                <th class="px-4 py-3">Proof of Residency</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white" id="tableBody">
                                                            @foreach ($students as $student)
                                                                                            <tr class="text-gray-700 table-row">
                                                                                                <td class="px-4 py-3 h-28 border flex items-center mt-2 w-40">
                                                                                                    <div
                                                                                                        class="w-10 h-10 rounded-full bg-gray-500 text-white flex items-center justify-center font-bold">
                                                                                                        {{ strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1)) }}
                                                                                                    </div>
                                                                                                    <span class="ml-2">{{ $student->student_number }}</span>
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">{{ $student->lrn }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->school_year }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->section }}</td>
                                                                                                <td class="px-4 py-3 text-xs border">
                                                                                                    <span
                                                                                                        class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm">
                                                                                                        {{ $student->status }}
                                                                                                    </span>
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">{{ $student->student_last_name }}
                                                                                                    {{ $student->student_first_name }} {{ $student->student_middle_name }}
                                                                                                    {{ $student->student_suffix_name }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->grade }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->email_address_send }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->place_of_birth }}</td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ \Carbon\Carbon::parse($student->birth_date)->format('Y-m-d') }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->sex }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->age }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->contact_number }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->religion }}</td>
                                                                                                <td class="px-4 py-3 border">{{ $student->house_number }},
                                                                                                    {{ $student->street }}, {{ $student->barangay }}, {{ $student->city }},
                                                                                                    {{ $student->province }}</td>
                                                                                                @php
                                                                                                    $additionalInfo = $studentsAdditional[$student->student_number] ?? null;
                                                                                                @endphp
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->father_last_name . ', ' . $additionalInfo->father_first_name . $additionalInfo->father_suffix_name : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->mother_last_name . ', ' . $additionalInfo->mother_first_name : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->guardian_last_name . ', ' . $additionalInfo->guardian_first_name . $additionalInfo->guardian_suffix_name : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->emergency_contact_person : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->emergency_contact_number : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ $additionalInfo ? $additionalInfo->messenger_account : 'N/A' }}</td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ isset($studentDocuments[$student->student_number]) ? $studentDocuments[$student->student_number]->birth_certificate : 'N/A' }}
                                                                                                </td>
                                                                                                <td class="px-4 py-3 border">
                                                                                                    {{ isset($studentDocuments[$student->student_number]) ? $studentDocuments[$student->student_number]->proof_of_residency : 'N/A' }}
                                                                                                </td>
                                                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                            @endif
                        </div>
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
            lengthChang: true,
                scrollX: true,
                crollY: 'auto',
                scrollCollapse: true,
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
                        $(win.document.body).find('table').css('width', '70%');
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
            },
            fixedHeader: true,
        });

        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const tableBody = document.getElementById("tableBody");
            const rows = tableBody.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let displayRow = false;

                if (cells.length > 0) {
                    const nameText = cells[5].textContent.toLowerCase(); // Name column
                    const numberText = cells[0].textContent.toLowerCase(); // Student Number column
                    const sectionText = cells[3].textContent.toLowerCase(); // Student Section column
                    const gradeText = cells[6].textContent.toLowerCase(); // Student Grade column

                    // Check if any cell includes the filter text
                    displayRow = nameText.includes(filter) || numberText.includes(filter) ||
                        sectionText.includes(filter) || gradeText.includes(filter);
                }

                rows[i].style.display = displayRow ? "" : "none";
            }
        }
    </script>

</body>

</html>