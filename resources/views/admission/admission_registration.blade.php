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
                            class="hover:text-teal-700">Report Section</span> / Student Registration
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
                                        <th class="export">lrn</th>
                                        <th class="export">Student Number</th>
                                        <th class="export">School Year</th>
                                        <th class="export">Admission Type</th>
                                        <th class="export">Name</th>
                                        <th class="export">Grade</th>
                                        <th class="export">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="" id="tableBody">
                                    @foreach ($students as $student)
                                                                        @php
                                                                            $account = $studentAccount[$student->studentnumber] ?? null;
                                                                            $avatar = $account && $account->avatar ? asset('storage/' . $account->avatar) : null;
                                                                            $primaryInfo = $studentInfo[$student->lrn] ?? null;
                                                                            $initials = strtoupper(substr($primaryInfo->student_last_name, 0, 1) . substr($primaryInfo->student_first_name, 0, 1));
                                                                        @endphp
                                                                        <tr class="hover:bg-gray-100 h-12">
                                                                            <td class="px-4 py-3">{{ $student->lrn }}</td>
                                                                            <td class="px-4 py-3 ">{{ $student->studentnumber }}</td>
                                                                            <td class="px-4 py-3 text-xs">
                                                                                {{ $student->school_year }}
                                                                            </td>
                                                                            <td class="px-4 py-3 text-xs">
                                                                                <span
                                                                                    class="bg-yellow-300 text-yellow-800 px-2 py-1 font-semibold rounded-full">{{ $student->status }}</span>
                                                                            </td>
                                                                            <td class="flex justify-start items-center">
                                                                                <div
                                                                                    class="w-12 h-12 rounded-full bg-teal-700 text-white flex items-center justify-center font-bold mx-2">
                                                                                    @if ($avatar)
                                                                                        <img src="{{ $avatar }}" alt="Student Avatar"
                                                                                            class="w-12 h-12 rounded-full object-cover">
                                                                                    @else
                                                                                        {{ $initials }}
                                                                                    @endif
                                                                                </div>
                                                                                <div>
                                                                                    <span
                                                                                        class="text-sm font-semibold">{{ $primaryInfo->student_last_name }}
                                                                                        {{ $primaryInfo->student_first_name }}
                                                                                        {{ $primaryInfo->student_middle_name }}
                                                                                        {{ $primaryInfo->student_suffix_name }}</span>
                                                                                    <br><span
                                                                                        class="text-xs text-gray-500">{{ $primaryInfo->email_address_send }}</span>
                                                                                </div>
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
            </div>
        </main>
        @include('admission.includes.register_student_form')
    </div>


    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
    <script>
        @foreach ($students as $student)
        @php
            $account = $studentAccount[$student->studentnumber] ?? null;
            $avatar = $account && $account->avatar ? asset('storage/' . $account->avatar) : null;
            $primaryInfo = $studentInfo[$student->lrn] ?? null;
            $initials = strtoupper(substr($primaryInfo->student_last_name, 0, 1) . substr($primaryInfo->student_first_name, 0, 1));
        @endphp
            const updateModal{{ $student->id }} = document.getElementById("updatetudentinfo{{ $student->id }}");
            const openUpdateModalButton{{ $student->id }} = document.getElementById("openUpdateStudentInfo{{ $student->id }}");
            const closeUpdateModalButton{{ $student->id }} = document.getElementById("updatetudentinfoClose{{ $student->id }}");

            // Ensure the elements exist before adding event listeners
            if (openUpdateModalButton{{ $student->id }}) {
                openUpdateModalButton{{ $student->id }}.addEventListener("click", function() {
                    if (updateModal{{ $student->id }}) {
                        updateModal{{ $student->id }}.classList.remove("hidden");
                    }

                    var fullName = "{{ $primaryInfo->student_last_name }} {{ $primaryInfo->student_first_name }} {{ $primaryInfo->student_middle_name }} {{ $primaryInfo->student_suffix_name }}";
                    var gender = "{{ $primaryInfo->sex }}";
                    var grade = "{{ $student->grade }}";
                    var birthdate = "{{ $primaryInfo->birth_date }}";

                    console.log("FullName: " + fullName);
                    console.log("Gender: " + gender);
                    console.log("Grade: " + grade);
                    console.log("Birthdate: " + birthdate);
                });
            }

            if (closeUpdateModalButton{{ $student->id }}) {
                closeUpdateModalButton{{ $student->id }}.addEventListener("click", function() {
                    if (updateModal{{ $student->id }}) {
                        updateModal{{ $student->id }}.classList.add("hidden");
                    }
                });
            }


            function printRegistrationForm() {
                // Get the selected grade from the input field
                var grade = "{{ $student->grade }}";

                // Open a new window with about:blank (empty content)
                var printWindow = window.open('about:blank', '', 'height=800, width=800');

                // Generate the content for the registration form, passing the grade value
                generateModalContent(grade).then(modalContent => {
                    // Write the content into the new window
                    printWindow.document.write('<html><head><title>Print Registration Form</title>');

                    // Include the TailwindCSS link (use a CDN to ensure it's loaded properly)
                    printWindow.document.write('<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">');

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

            function generateModalContent(grade) {
                return new Promise((resolve, reject) => {
                    // Use absolute URL for images
                    let logoUrlAdmin = "{{ asset('assets/images/SELC.png') }}"; // Absolute URL for the logo image
                    let logoUrlregistrar = "{{ asset('assets/images/SELC.png') }}";
                    let logoUrlstudent = "{{ asset('assets/images/SELC.png') }}";

                    var studentName = "{{ $primaryInfo->student_last_name }} {{ $primaryInfo->student_first_name }} {{ $primaryInfo->student_middle_name }} {{ $primaryInfo->student_suffix_name }}";
                    var gender = "{{ $primaryInfo->sex }}";

                    var dateOfBirth = "{{ $primaryInfo->birth_date }}";

                    // Fetch subjects from the API based on the grade value
                    fetchSubjectsTable(grade).then(subjectsTable => {
                        const content = `
                    <div>
                        <div class="header px-3 my-3">
                            <div class="flex justify-end items-center" style="width: 100%;">
                                <div class="flex items-center mx-5">
                                    <input type="checkbox" class="mr-2 text-white bg-black checked:bg-whitefocus:outline-none" name="new" value="1" >
                                    <label for="new" class="text-[12px] text-start checked:border-black ">New Student</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" class="mr-2" name="old" value="0" checked>
                                    <label for="old" class="text-[12px] text-start">Old Student</label>
                                </div>
                            </div>
                            <img src="${logoUrlAdmin}" alt="Logo" width="80px" class="absolute top-10 left-5" style="display: block;">
                            <div class="flex justify-center items-center" style="width: 100%;">
                                <div class="text-center">
                                    <h1 class="text-[14px] font-bold me-20">St. Emilie Learning Center</h1>
                                    <p class="text-[13px]">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>
                                    <div class="flex justify-between px-8">
                                    <p class="text-[12px]">Tel : 7 955 03 92</p>
                                    <p class="text-[12px]">School Year ${new Date().getFullYear()}-${new Date().getFullYear() + 1}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <h1 class="text-lg font-bold">Registration Form </h1>
                                (<span class="text-[10px]">Registrar Copy</span>)
                            </div>
                        </div>
                        <div class="body px-3 mt-1 text-[12px]">
                            <ul class="grid grid-cols-2 gap-x-10 list-none">
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">LRN:</label>
                                    <div class="flex-1 border-b border-gray-900 py-3"></div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Grade:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${grade}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Student No.:</label>
                                    <div class="flex-1 border-b border-gray-900 py-3"></div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Section:</label>
                                    <div class="flex-1 border-b border-gray-900 py-3"></div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Name:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${studentName}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Date:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">{{ \Carbon\Carbon::now()->format('F j, Y') }}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Gender:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${gender}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Birth Date:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${dateOfBirth}</div>
                                </li>
                            </ul>

                            <!-- Subjects Table -->
                            ${subjectsTable}

                            <ul class="flex justify-between px-1 mt-5 text-[12px]">
                                <li class="text-center">
                                    <div class="w-36 border-b border-gray-900 text-start py-3"></div>
                                    <label class="w-24">Registrar</label>
                                </li>
                                <li class="text-center">
                                    <div class="w-36 border-b border-gray-900 text-start py-3"></div>
                                    <label class="w-24">Cashier</label>
                                </li>
                                <li class="text-center">
                                    <div class="border-b border-gray-900 py-3"></div>
                                    <label class="w-24">Signature Over Printed Name of Parents/guardian</label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr class="border border-gray-900 border-dashed mt-3">

                    <div>
                        <div class="header px-3 my-3">
                            <div class="flex justify-end items-center" style="width: 100%;">
                                <div class="flex items-center mx-5">
                                    <input type="checkbox" class="mr-2 text-white bg-black checked:bg-white checked:border-black focus:outline-none" name="new" value="1">
                                    <label for="new" class="text-[12px] text-start">New Student</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" class="mr-2" name="old" value="0" checked>
                                    <label for="old" class="text-[12px] text-start">Old Student</label>
                                </div>
                            </div>
                            <img src="${logoUrlstudent}" alt="Logo" width="80px" class="absolute top-[5rem] left-5" style="display: block;">
                            <div class="flex justify-center items-center" style="width: 100%;">
                                <div class="text-center">
                                    <h1 class="text-[14px] font-bold me-20">St. Emilie Learning Center</h1>
                                    <p class="text-[13px]">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>
                                    <div class="flex justify-between px-8">
                                    <p class="text-[12px]">Tel : 7 955 03 92</p>
                                    <p class="text-[12px]">School Year ${new Date().getFullYear()}-${new Date().getFullYear() + 1}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <h1 class="text-lg font-bold">Registration Form</h1>
                                (<span class="text-[10px]">Cashier Copy</span>)
                            </div>
                        </div>
                        <div class="body px-3 mt-1 text-[12px]">
                            <ul class="grid grid-cols-2 gap-x-10 list-none">
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">LRN:</label>
                                    <div class="flex-1 border-b border-gray-900 py-3"></div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Grade:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${grade}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Student No.:</label>
                                    <div class="flex-1 border-b border-gray-900 py-3"></div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Section:</label>
                                    <div class="flex-1 border-b border-gray-900 py-3"></div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Name:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${studentName}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Date:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">{{ \Carbon\Carbon::now()->format('F j, Y') }}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Gender:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${gender}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Birth Date:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${dateOfBirth}</div>
                                </li>
                            </ul>

                            <!-- Subjects Table -->
                            ${subjectsTable}

                            <ul class="flex justify-between px-1 mt-5 text-[12px] mb-5">
                                <li class="text-center">
                                    <div class="w-36 border-b border-gray-900 text-start py-3"></div>
                                    <label class="w-24">Registrar</label>
                                </li>
                                <li class="text-center">
                                    <div class="w-36 border-b border-gray-900 text-start py-3"></div>
                                    <label class="w-24">Cashier</label>
                                </li>
                                <li class="text-center">
                                    <div class="border-b border-gray-900 py-3"></div>
                                    <label class="w-24">Signature Over Printed Name of Parents/guardian</label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr class="border border-gray-900 border-dashed mt-10">

                    <div class="">
                        <div class="header px-3 my-3">
                            <div class="flex justify-end items-center" style="width: 100%;">
                                <div class="flex items-center mx-5">
                                    <input type="checkbox" class="mr-2 text-white bg-black checked:bg-white checked:border-black focus:outline-none" name="new" value="1" checked>
                                    <label for="new" class="text-[12px] text-start">New Student</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="checkbox" class="mr-2" name="old" value="0" checked>
                                    <label for="old" class="text-[12px] text-start">Old Student</label>
                                </div>
                            </div>
                            <div class="flex justify-center items-center" style="width: 100%;">
                                <img src="${logoUrlAdmin}" alt="Logo" width="80px" class="absolute top-[95rem] left-5" style="display: block;">
                                <div class="text-center">
                                    <h1 class="text-[14px] font-bold me-20">St. Emilie Learning Center</h1>
                                    <p class="text-[13px]">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>
                                    <div class="flex justify-between px-8">
                                    <p class="text-[12px]">Tel : 7 955 03 92</p>
                                    <p class="text-[12px]">School Year ${new Date().getFullYear()}-${new Date().getFullYear() + 1}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3">
                                <h1 class="text-lg font-bold">Registration Form</h1>
                                (<span class="text-[10px]">Student Copy</span>)
                            </div>
                        </div>
                        <div class="body px-3 mt-1 text-[12px]">
                            <ul class="grid grid-cols-2 gap-x-10 list-none">
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">LRN:</label>
                                    <div class="flex-1 border-b border-gray-900 py-3"></div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Grade:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${grade}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Student No.:</label>
                                    <div class="flex-1 border-b border-gray-900 py-3"></div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Section:</label>
                                    <div class="flex-1 border-b border-gray-900 py-3"></div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Name:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${studentName}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Date:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">{{ \Carbon\Carbon::now()->format('F j, Y') }}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Gender:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${gender}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Birth Date:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${dateOfBirth}</div>
                                </li>
                            </ul>

                            <!-- Subjects Table -->
                            ${subjectsTable}

                            <ul class="flex justify-between px-1 mt-5 text-[12px]">
                                <li class="text-center">
                                    <div class="w-36 border-b border-gray-900 text-start py-3"></div>
                                    <label class="w-24">Registrar</label>
                                </li>
                                <li class="text-center">
                                    <div class="w-36 border-b border-gray-900 text-start py-3"></div>
                                    <label class="w-24">Cashier</label>
                                </li>
                                <li class="text-center">
                                    <div class="border-b border-gray-900 py-3"></div>
                                    <label class="w-24">Signature Over Printed Name of Parents/guardian</label>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr class="border border-gray-900 border-dashed mt-3">
                `;
                        resolve(content);
                    }).catch(reject);
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
                            <tr class="border border-gray-900 text-left">
                                <th class="px-4 py-1 text-left">Subject</th>
                                <th class="px-4 py-1 text-left">Time Schedule</th>
                                <th class="px-4 py-1 text-left">Teacher</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${subjects.map(subject => `
                                <tr class="">
                                    <td class="px-4 py-1">${subject.subject}</td>
                                    <td class="px-4 py-1"></td>
                                    <td class="px-4 py-1"></td>
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
</body>

</html>