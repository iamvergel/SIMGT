@include('admission.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('admission.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('admission.includes.topnav')
            </header>

            <div class="p-5">
                <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admission</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span
                            onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
                            class="hover:text-teal-700">Report Section</span> / Online Application
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
                        <!-- <h1 class="mx-5 font-semibold text-xl text-teal-800" id="section">Section :</h1> -->
                    </div>

                    <div class="mr-10">

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

                        <div class="p-5">
                            <table id="studentTable" class="p-3 display responsive nowrap" width="100%">
                                <thead class="bg-gray-200">
                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                        <th class="export">School Year</th>
                                        <th class="export">Admission Type</th>
                                        <th class="export">Name</th>
                                        <th class="export">Grade</th>
                                        <th class="export">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="" id="tableBody">
                                    @foreach ($students as $student)
                                        <tr class="hover:bg-gray-100 h-12">
                                            <td class="px-4 py-3 ">{{ $student->school_year }}</td>
                                            <td class="px-4 py-3 text-xs">
                                                @if ($student->status == 'transferee')
                                                    <span
                                                        class="px-2 py-1 uppercase font-semibold text-[10px] rounded-lg leading-tight text-blue-800 bg-blue-200">
                                                        {{ $student->status }}
                                                    </span>
                                                @else
                                                    <span
                                                        class="px-2 py-1 uppercase font-semibold text-[10px] rounded-lg leading-tight text-teal-800 bg-teal-200">
                                                        {{ $student->status }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">{{ $student->student_last_name }}
                                                {{ $student->student_first_name }} {{ $student->student_middle_name }}
                                                {{ $student->student_suffix_name }}
                                            </td>
                                            <td class="px-4 py-3">{{ $student->grade }}</td>
                                            <td class="px-4 py-3">
                                                <!-- Update Student Info Button -->
                                                <button data-modal-toggle="updatetudentinfo{{ $student->id }}"
                                                    data-modal-target="updatetudentinfo{{ $student->id }}" data-fullname="{{ $student->student_last_name }}
                                                        {{ $student->student_first_name }} {{ $student->student_middle_name }}
                                                        {{ $student->student_suffix_name }}"
                                                    data-gender="{{ $student->sex }}" data-grade="{{ $student->grade }}"
                                                    data-birthdat="{{ $student->birth_date }}"
                                                    class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-blue-700 rounded-full hover:bg-blue-600"
                                                    type="button" aria-label="Update Student" title="Update Student Info"
                                                    id="openUpdateStudentInfo{{ $student->id }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                @include('admission.includes.update_student_form')
            </div>
        </main>
    </div>


    @include('admin.includes.js-link')
    
    <script>
    @foreach ($students as $student)
        const updateModal{{ $student->id }} = document.getElementById("updatetudentinfo{{ $student->id }}");
        const openUpdateModalButton{{ $student->id }} = document.getElementById("openUpdateStudentInfo{{ $student->id }}");
        const closeUpdateModalButton{{ $student->id }} = document.getElementById("updatetudentinfoClose{{ $student->id }}");

        // Ensure the elements exist before adding event listeners
        if (openUpdateModalButton{{ $student->id }}) {
            openUpdateModalButton{{ $student->id }}.addEventListener("click", () => {
                if (updateModal{{ $student->id }}) {
                    updateModal{{ $student->id }}.classList.remove("hidden");

                    var fullName = "{{ $student->student_last_name }} {{ $student->student_first_name }} {{ $student->student_middle_name }} {{ $student->student_suffix_name }}";
                    var gender = "{{ $student->sex }}";
                    var grade = "{{ $student->grade }}";
                    var birthdate = "{{ $student->birth_date }}";
                    var lrn = "{{ $student->lrn }}";

                    console.log(`FullName: ${fullName}`);
                    console.log(`Gender: ${gender}`);
                    console.log(`Grade: ${grade}`);
                    console.log(`LRN: ${lrn}`);
                }
            });

            function printRegistrationForm(fullName, gender, grade, birthdate, lrn) {
                // Open a new window with about:blank (empty content)
                var printWindow = window.open('about:blank', '', 'height=800, width=800');

                // Generate the content for the registration form, passing the grade value
                generateModalContent(grade, fullName, gender, birthdate, lrn).then(modalContent => {
                    // Write the content into the new window
                    printWindow.document.write('<html><head><title>Print Registration Form</title>');

                    // Include the TailwindCSS link (use a CDN to ensure it's loaded properly)
                    printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">');

                    printWindow.document.write(`
                        <style>
                            @page { size: 8.5in 13in; margin: 0.5in; }
                            body { font-size: 14px; }
                            .copy { page-break-after: always; }
                            .header { text-align: center; margin-bottom: 5px; }
                            .body { margin-bottom: 15px; }
                            .footer { text-align: center; margin-top: 0px; font-size: 14px; }
                            .section { margin-bottom: 20px; }
                            @page :first { }
                            @page :right { }
                            @page :left { }
                        </style>
                    `);

                    // Close head tag
                    printWindow.document.write('</head><body>');

                    // Write the generated content into the body
                    printWindow.document.write(modalContent);

                    // Close the body and html tags
                    printWindow.document.write('</body></html>');

                    // Close the document (important to fully render content)
                    printWindow.document.close();

                    // Wait until the content is fully loaded, then trigger the print dialog
                    printWindow.onload = function () {
                        printWindow.print(); // Trigger the print dialog after the window is fully loaded
                    };
                }).catch(error => {
                    console.error('Error generating content:', error);
                    alert('There was an error generating the content.');
                });
            }

            function generateModalContent(grade, fullName, gender, birthdate, lrn) {
                return new Promise((resolve, reject) => {
                    // Use absolute URL for images
                    let logoUrlAdmin = "{{ asset('assets/images/SELC.png') }}"; // Absolute URL for the logo image
                    let logoUrlregistrar = "{{ asset('assets/images/SELC.png') }}";
                    let logoUrlstudent = "{{ asset('assets/images/SELC.png') }}";

                    // Fetch subjects from the API based on the grade value
                    fetchSubjectsTable(grade).then(subjectsTable => {
                        const content = `
                            <div>
                                <div class="header px-3 my-3">
                                    <h1 class="text-center text-[14px] font-bold">St. Emilie Learning Center Online Application Confirmation Slip</h1>
                                    <p class="text-center text-[12px]">This is to confirm that ${fullName} has successfully completed the online application for admission to ${grade} for the academic year ${new Date().getFullYear()}-${new Date().getFullYear() + 1}.</p>
                                </div>
                                <div class="body px-3 mt-1 text-[12px]">
                                    <ul class="grid grid-cols-2 gap-x-10 list-none">
                                        <li class="flex items-center mb-0 px-0">
                                            <label class="w-24">LRN:</label>
                                            <div class="flex-1 border-b border-gray-900 text-start px-2">${lrn}</div>
                                        </li>
                                        <li class="flex items-center mb-0 px-0">
                                            <label class="w-24">Student Name:</label>
                                            <div class="flex-1 border-b border-gray-900 text-start px-2">${fullName}</div>
                                        </li>
                                        <li class="flex items-center mb-0 px-0">
                                            <label class="w-24">Grade Level:</label>
                                            <div class="flex-1 border-b border-gray-900 text-start px-2">${grade}</div>
                                        </li>
                                        <li class="flex items-center mb-0 px-0">
                                            <label class="w-24">Admission Type:</label>
                                            <div class="flex-1 border-b border-gray-900 text-start px-2">New Student</div>
                                        </li>
                                        <li class="flex items-center mb-0 px-0">
                                            <label class="w-24">Date of Application:</label>
                                            <div class="flex-1 border-b border-gray-900 text-start px-2">{{ \Carbon\Carbon::now()->format('F j, Y') }}</div>
                                        </li>
                                    </ul>

                                    <p class="text-center mt-5 text-[12px]">
                                        Please proceed with the next steps: <br>
                                        1. Submit the required documents to the Registrar's Office. <br>
                                        2. Pay the reservation fee to the Cashier. <br>
                                        3. Take the entrance exam on the scheduled date. <br>
                                    </p>

                                    <div class="text-center mt-5">
                                        <p class="text-[12px]">Authorized Signature:</p>
                                        <p class="text-[12px]">(Admission Officer)</p>
                                        <p class="text-[12px]">Date: {{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                    `;
                        resolve(content);
                    }).catch(reject);
                });
            }

        }

        if (closeUpdateModalButton{{ $student->id }}) {
            closeUpdateModalButton{{ $student->id }}.addEventListener("click", () => {
                if (updateModal{{ $student->id }}) {
                    updateModal{{ $student->id }}.classList.add("hidden");
                }
            });
        }
    @endforeach

    function fetchSubjectsTable(grade) {
        // Make an API call to get the subjects based on the selected grade
        const apiUrl = `/api/allsubjects?grade=${encodeURIComponent(grade)}`;

        return fetch(apiUrl)
            .then(response => response.json())
            .then(subjects => {
                // Build the HTML table for the subjects
                const table = `
                    <div class="mt-5">
                        <table class="w-full border border-gray-900">
                            <thead>
                                <tr class="border border-gray-900 text-left" style="font-size: 14px;">
                                    <th class="px-4 py-1 text-left text-[12px]">Subject</th>
                                    <th class="px-4 py-1 text-left text-[12px]">Time Schedule</th>
                                    <th class="px-4 py-1 text-left text-[12px]">Teacher</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${subjects.map(subject => `
                                    <tr style="font-size: 14px;">
                                        <td class="px-4 py-1 text-[12px]">${subject.subject}</td>
                                        <td class="px-4 py-1 text-[12px]"></td>
                                        <td class="px-4 py-1 text-[12px]"></td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    </div>
                `;
                return table;
            })
            .catch(error => {
                console.error('Error fetching subjects:', error);
                return '<p>Unable to fetch subjects.</p>';
            });
    }
</script>
<script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
</body>

</html>