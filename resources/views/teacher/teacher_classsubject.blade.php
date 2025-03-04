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
                        <span class="hover:text-teal-700">My Advisory</span>
                    </p>
                </div>
                <div class="flex justify-between items-center gap-4 mt-10">
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
                        <h1 class="mx-5 font-semibold text-xl text-teal-800" id="section">Grade :
                            {{session('grade') . ' | Section : ' . session('section') }}
                        </h1>
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
            </div>


            @if (session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
            @endif

            <!-- component -->
            <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px]">

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
                                <tr class="text-[14px] font-normal uppercase text-left text-black">
                                    <td class="export border-2 border-gray-900 py-2" colspan="2">QUARTER</td>
                                    <td class="export border-2 border-gray-900" colspan="11">GRADE AND SECTION :</td>
                                    <td class="export border-2 border-gray-900" colspan="13">TECHER :</td>
                                    <td class="export border-2 border-gray-900" colspan="8">SUBJECT :</td>
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
                                            <td class="export border-2  border-gray-900">
                                                Posible Highest Grade</td>
                                            <td class="export border-2 text-center border-gray-900"></td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                100.00</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                30%</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                100.00</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                50%</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                </td>
                                                <td class="export border-2 text-center border-gray-900">
                                                100.00</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                20%</td>
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
                                @foreach ($students as $student)
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if ($student && $student->gender == "Male")
                                        <tr class="hover:bg-gray-100">
                                            <td class="export border-2 text-center border-gray-900">
                                                {{ $i++ }}
                                            </td>
                                            <td class="export border-2  border-gray-900">
                                                {{ $student->first_name }} {{ $student->middle_name }}
                                                {{ $student->last_name }} {{ $student->suffix }}</td>
                                            <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_one_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_two_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_three_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_four_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_five_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_six_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_seven_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_eight_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_nine_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_ten_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_total_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_ps_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->written_ws_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_one_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_two_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_three_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_four_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_five_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_six_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_seven_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_eight_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_nine_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_ten_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_total_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_ps_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->performance_ws_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->q_assessment_one_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->q_assessment_ps_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->q_assessment_ws_score }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->initial_grade }}</td>
                                                <td class="export border-2 text-center border-gray-900">
                                                {{ $student->quarterly_grade }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </main>
    </div>


    @include('admin.includes.js-link')
    <script type="text/javascript">
        var table = $("#studentTable").DataTable({
            dom:
                ` <'flex justify-center items-center mb-4'<><'block xl:hidden'B><>>` +
                `<tr>` +
                `<'flex justify-center items-center mb-4'<'flex-3'l><'flex-1 xl:block hidden'B><'flex-1'f>>` +
                `<tr>` +
                `<'flex justify-between items-center'<'flex-1'i><'flex-1'p>>`,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            lengthChange: true,
            responsive: true,
            scrollX: true,
            scrollCollapse: true,
            buttons: [
                {
                    extend: "copyHtml5",
                    className:
                        "!bg-sky-800 !text-[12px] !text-white !border-none !hover:bg-sky-700 !px-4 !py-2 !rounded !flex !items-center !justify-center",
                    text: '<i class="fas fa-clipboard"></i> Copy',
                    titleAttr: "Click to copy data",
                    exportOptions: {
                        columns: ".export",
                    },
                },
                {
                    extend: "excelHtml5",
                    text: '<i class="fas fa-file-excel mr-2"></i> Excel',
                    className:
                        "!bg-teal-700 !text-[12px] !text-white !border-none !hover:bg-green-500 !px-4 !py-2 !rounded !important !flex !items-center !justify-center",
                    titleAttr: "Export to Excel",
                    exportOptions: {
                        columns: ".export",
                    },
                },
                {
                    extend: "csvHtml5",
                    text: '<i class="fas fa-file-csv mr-2"></i> CSV',
                    className:
                        "!bg-yellow-500 !text-[12px] !text-white !border-none !hover:bg-yellow-400 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
                    titleAttr: "Export to CSV",
                    exportOptions: {
                        columns: ".export",
                    },
                },
                {
                    extend: "pdfHtml5",
                    text: '<i class="fas fa-file-pdf mr-2"></i> PDF',
                    className:
                        "!bg-green-600 !text-[12px] !text-white !border-none !hover:bg-green-500 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
                    orientation: "landscape",
                    pageSize: "A4",
                    titleAttr: "Export to PDF",
                    exportOptions: {
                        columns: ".export",
                    },
                    customize: function (doc) {
                        doc.content[1].table.widths = Array(
                            doc.content[1].table.body[0].length + 1
                        )
                            .join("*")
                            .split("");
                    },
                },
                {
                    extend: "print",
                    text: '<i class="fas fa-print mr-2"></i> Print',
                    className:
                        "!bg-blue-600 !text-[12px] !text-white !border-none !hover:bg-blue-500 !px-4 !py-2 !rounded !flex !items-center !justify-center !important",
                    orientation: "landscape",
                    autoPrint: true,
                    titleAttr: "Print Table",
                    exportOptions: {
                        columns: ".export",
                    },
                    customize: function (win) {
                        $(win.document.body).find("table").css("width", "100%");
                        $(win.document.body).find("table").css("font-size", "10px");
                    },
                },
            ],
            initComplete: function () {
                $(".dt-buttons").css({
                    display: "flex",
                    "justify-content": "flex-end",
                    width: "100%",
                });
            },
        });

        $(document).ready(function () {
            // When the dropdown button is clicked, make an AJAX call
            $("#dropdownDefaultButton").click(function () {
                // Toggle the dropdown visibility
                $("#dropdown").toggleClass("hidden");

                // Make an AJAX request to get the sections
                $.ajax({
                    url: "/get-classsubject",
                    type: "GET",
                    success: function (data) {
                        console.log(data); // Debug: Check the data received
                        if (data.length > 0) {
                            $("#dropdown ul").empty();
                            $("#dropdown ul").append(
                                '<li class="text-gray-500 hover:text-white hover:bg-teal-600 py-2 rounded-lg"><a href="#" class="dropdown-item" data-section="">Select a Section</a></li>'
                            );
                            data.forEach(function (section) {
                                $("#dropdown ul").append(
                                    '<li class="text-gray-500 hover:text-white hover:bg-teal-600 py-2 rounded-lg"><a href="#" class="dropdown-item" data-section="' +
                                    section +
                                    '">' +
                                    section +
                                    "</a></li>"
                                );
                            });
                        } else {
                            $("#dropdown ul").html(
                                '<li><a href="#" class="dropdown-item text-gray-500">No Sections Available</a></li>'
                            );
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("Error fetching sections: " + error);
                    },
                });
            });

            // Handle section click to filter table
            $(document).on("click", ".dropdown-item", function (event) {
                event.preventDefault();

                const selectedSection = $(this).data("section");
                let section = document.getElementById('section');
                let gradetable = $('#gradetable').DataTable();

                if (selectedSection) {
                    gradetable.column(5).search(selectedSection).draw(); // Filter the table based on the clicked section
                    section.innerHTML = 'Section : ' + selectedSection;
                } else {
                    gradetable.column(5).search("").draw(); // Clear the filter to show all
                    section.innerHTML = 'Section : ';
                }

                $("#dropdown").addClass("hidden"); // Close the dropdown
            });
        });

    </script>
</body>

</html>