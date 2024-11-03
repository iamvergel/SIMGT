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
                    <span class="hover:text-teal-700">Report Section</span> / Dropped Students
                </p>

                <!-- Search Bar -->
                <div class="mt-10 ml-5 flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-search text-xl text-teal-700 px-3"></i>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name..."
                            class="text-sm px-4 py-3 text-teal-900 border border-gray-300 rounded-lg w-80 shadow-lg focus:outline-none" />
                    </div>

                    <div class="flex">
                        <button
                            class="block w-86 right-0 mr-10 text-[12px] text-white shadow-lg px-10 bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded py-2.5 text-center"
                            onclick="window.location.href = '/StEmelieLearningCenter.HopeSci66/admin/Report-Section/Drop-Student/All-Drop-Data'">
                            Show student dropped data
                        </button>
                    </div>
                </div>

                <!-- Main modal -->
                @include('admin.includes.add_student_form')

                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                    <div class="w-full bg-white mb-8 rounded-lg shadow-lg text-[12px]">
                        <div class="w-full h-full overflow-x-scroll border-4 border-teal-50 rounded-lg">
                            <!-- Enables horizontal scrolling -->
                            @if ($noDroppedMessage)
                                <p class="text-red-600 text-center text-md">{{ $noDroppedMessage }}</p>
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
                                                <td class="px-4 py-3 border flex items-center justify-center w-40">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-gray-500 text-white flex items-center justify-center font-bold mt-2">
                                                        {{ strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1)) }}
                                                    </div>
                                                    <span class="ml-2 mt-2">{{ $student->student_number }}</span>
                                                </td>
                                                <td class="px-4 py-3 text-xs border">
                                                    <span
                                                        class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm">
                                                        {{ $student->status}}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 border">{{ $student->student_last_name }}
                                                    {{ $student->student_first_name }}
                                                </td>
                                                <td class="px-4 py-3 border">{{ $student->grade }}</td>
                                                <td class="px-4 py-3 border">{{ $student->section }}</td>
                                                <td class="px-4 py-3 border">{{ $student->email_address_send }}</td>
                                                <td class="px-4 py-3 border">
                                                    <form action="{{ route('students.retrieve', $student->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('PUT') <!-- Use PUT for updates -->
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to retrive this student?');"
                                                            class="px-5 l-2 py-2 mb-1 text-[12px] text-white bg-teal-700 shadow rounded hover:bg-teal-600">
                                                            Retrieve Student
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </div>

    <script>
        $(document).ready(function () {
            $('#studentTable').DataTable({
                paging: true,
                searching: false,
                ordering: true,
                info: true,
                language: {
                    search: "<i class='fas fa-search text-xl text-teal-700 px-3'></i>",
                }
            });
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