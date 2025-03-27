@include('registrar.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('registrar.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('registrar.includes.topnav')
            </header>

            <div class="p-5">
                <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Registrar</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span
                            onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/registrar/student-management'"
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
                                            <!-- Display the father's last name -->
                                            <td class="px-4 py-3">
                                                {{ $student->school_year }}
                                                <input type="hidden" name="" id="adviserValue"
                                                    value="{{ isset($studentPrimaryInfo[$student->lrn]) && isset($advisers[$studentPrimaryInfo[$student->lrn]->adviser]) ? $advisers[$studentPrimaryInfo[$student->lrn]->adviser]->last_name . ' ' . $advisers[$studentPrimaryInfo[$student->lrn]->adviser]->first_name . ' ' . $advisers[$studentPrimaryInfo[$student->lrn]->adviser]->middle_name . ' ' . $advisers[$studentPrimaryInfo[$student->lrn]->adviser]->suffix : 'N/A' }}">
                                                <input type="hidden" name="" id="sectionValue"
                                                    value="{{ isset($studentPrimaryInfo[$student->lrn]) ? $studentPrimaryInfo[$student->lrn]->section : 'N/A' }}">
                                                <input type="hidden" name="" id="gradeValue"
                                                    value="{{ isset($studentPrimaryInfo[$student->lrn]) ? $studentPrimaryInfo[$student->lrn]->grade : 'N/A' }}">
                                                    <input type="hidden" name="" id="statusValue"
                                                    value=" {{ $student->status }}">
                                            </td>

                                            <td class="px-4 py-3 text-xs">
                                                @if ($student->status == 'Transferee')
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

                                            <td class="px-4 py-3">
                                                {{ $student->student_last_name }} {{ $student->student_first_name }}
                                                {{ $student->student_middle_name }} {{ $student->student_suffix_name }}
                                            </td>

                                            <td class="px-4 py-3">{{ $student->grade }}</td>

                                            <td class="px-4 py-3">
                                                <button data-modal-toggle="updatetudentinfo{{ $student->id }}"
                                                    id="enrollStudent"
                                                    data-modal-target="updatetudentinfo{{ $student->id }}"
                                                    data-fullname="{{ $student->student_last_name }} {{ $student->student_first_name }} {{ $student->student_middle_name }} {{ $student->student_suffix_name }}"
                                                    data-gender="{{ $student->sex }}" data-grade="{{ $student->grade }}"
                                                    data-birthdat="{{ $student->birth_date }}"
                                                    data-lrn="{{ $student->lrn }}"
                                                    class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-blue-700 rounded-full hover:bg-blue-600"
                                                    type="button" aria-label="Update Student" title="Enrolled Student"
                                                    onclick="checkEnrollmentStatus('{{ $student->lrn }}')">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button>
                                                <button
                                                    data-fullname="{{ $student->student_last_name }} {{ $student->student_first_name }} {{ $student->student_middle_name }} {{ $student->student_suffix_name }}"
                                                    data-gender="{{ $student->sex }}"
                                                    data-grade="{{ isset($studentPrimaryInfo[$student->lrn]) ? $studentPrimaryInfo[$student->lrn]->grade : 'N/A' }}"
                                                    data-birthdat="{{ $student->birth_date }}"
                                                    data-studentStatus="{{ $student->status }}"
                                                    data-lrn="{{ isset($studentPrimaryInfo[$student->lrn]) ? $studentPrimaryInfo[$student->lrn]->lrn : 'N/A' }}"
                                                    data-adviser="{{ isset($studentPrimaryInfo[$student->lrn]) && isset($advisers[$studentPrimaryInfo[$student->lrn]->adviser]) ? $advisers[$studentPrimaryInfo[$student->lrn]->adviser]->first_name : 'N/A' }}"
                                                    data-section="{{ isset($studentPrimaryInfo[$student->lrn]) ? $studentPrimaryInfo[$student->lrn]->section : 'N/A' }}"
                                                    id="printForm" onclick="printRegistrationForm()"
                                                    class="hidden text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-green-700 rounded-full hover:bg-green-600">
                                                    <i class="fa fa-print"></i>
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
    </div>


    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const enrollButtons = document.querySelectorAll('#enrollStudent');
            enrollButtons.forEach(button => {
                const lrn = button.getAttribute('data-lrn');
                checkEnrollmentStatusAutomatically(lrn, button);
            });
        });

        function checkEnrollmentStatusAutomatically(lrn, button) {
            fetch(`/check-enrollment-status/${lrn}`)
                .then(response => response.json())
                .then(data => {
                    const printButton = button.closest('tr').querySelector('#printForm');
                    if (data.status === 'error') {
                        button.classList.add('bg-gray-500');
                        button.classList.remove('bg-blue-700', 'hover:bg-blue-600');
                        button.disabled = true;
                        if (printButton) {
                            printButton.classList.remove('hidden');
                            printButton.addEventListener('click', function () {
                                console.log('Student Data:', {
                                    FullName: button.getAttribute('data-fullname'),
                                    Gender: button.getAttribute('data-gender'),
                                    BirthDate: button.getAttribute('data-birthdat'),
                                    LRN: button.getAttribute('data-lrn'),
                                    Status: button.closest('tr').querySelector('#statusValue').value,
                                    Adviser: button.closest('tr').querySelector('#adviserValue').value,
                                    Section: button.closest('tr').querySelector('#sectionValue').value,
                                    Grade: button.closest('tr').querySelector('#gradeValue').value
                                });
                                printRegistrationForm(button);
                            });
                        }
                    } else {
                        button.disabled = false;
                        if (printButton) {
                            printButton.classList.add('hidden');
                        }

                        if (lrn) {
                            button.addEventListener('click', function () {
                                window.location.href = `{{ route('student.show.enrollees', ['lrn' => ':lrn']) }}`.replace(':lrn', lrn);
                            });
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function printRegistrationForm(button) {
            const lrn = button.getAttribute('data-lrn');
            const grade = button.closest('tr').querySelector('#gradeValue').value;
            const studentName = button.getAttribute('data-fullname');
            const section = button.closest('tr').querySelector('#sectionValue').value;
            const adviser = button.closest('tr').querySelector('#adviserValue').value;
            const gender = button.getAttribute('data-gender');
            const birthDay = button.getAttribute('data-birthdat');
            const statusStudent =  button.closest('tr').querySelector('#statusValue').value;

            const printWindow = window.open('about:blank', '', 'height=800, width=800');
            generateModalContent(lrn, grade, studentName, section, adviser, gender, birthDay, statusStudent).then(modalContent => {
                printWindow.document.write('<html><head><title>Print Registration Form</title>');
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
                    </style>
                `);
                printWindow.document.write('</head><body>');
                printWindow.document.write(modalContent);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.onload = function () {
                    printWindow.print();
                };
            }).catch(error => {
                console.error('Error generating content:', error);
                alert('There was an error generating the content.');
            });
        }

        function generateModalContent(lrn, grade, studentName, section, adviser, gender, birthDay, statusStudent) {
            return new Promise((resolve, reject) => {
                let logoUrl = "{{ asset('assets/images/SELC.png') }}";
                fetchSubjectsTable(grade).then(subjectsTable => {
                    const content = `
                        <div class="header px-3 my-3">
                            <img src="${logoUrl}" alt="Logo" width="60px" class="absolute top-15 left-5">
                            <div class="text-center">
                                <h1 class="text-[14px] font-bold">St. Emilie Learning Center</h1>
                                <p class="text-[13px]">Amparo Village, 18 Bangkal, Caloocan, Metro Manila</p>
                                <p class="text-[12px]">Tel : 7 955 03 92</p>
                                <p class="text-[12px]">School Year ${new Date().getFullYear()}-${new Date().getFullYear() + 1}</p>
                                <h1 class="text-lg font-bold my-5">Registration Form</h1>
                            </div>
                            <div class="absolute top-2 right-5 font-semibold">${statusStudent}</div>
                        </div>
                        <div class="body px-3 mt-1 text-[12px]">
                            <ul class="grid grid-cols-2 gap-x-10 list-none">
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">LRN:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${lrn}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Grade:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${grade}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Name:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${studentName}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Section:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${section}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Gender:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${gender}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Adviser:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${adviser}</div>
                                </li>
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Birth Date:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${new Intl.DateTimeFormat('en-US', { month: 'long', day: 'numeric', year: 'numeric' }).format(new Date(birthDay))}</div>
                                </li>
                                
                                <li class="flex items-center mb-0 px-0">
                                    <label class="w-24">Date:</label>
                                    <div class="flex-1 border-b border-gray-900 text-start px-2">${new Date().toLocaleString('default', { month: 'long' })} ${new Date().getDate()}, ${new Date().getFullYear()}</div>
                                </li>
                            </ul>
                            ${subjectsTable}
                            <ul class="flex justify-between px-1 mt-5 text-[12px]">
                                <li class="text-center">
                                    <div class="w-36 border-b border-gray-900 text-start py-3"></div>
                                    <label class="w-24">Registrar</label>
                                </li>
                                <li class="text-center">
                                    <div class="border-b border-gray-900 py-3"></div>
                                    <label class="w-24">Signature Over Printed Name of Parents/guardian</label>
                                </li>
                            </ul>
                        </div>
                        <hr class="border border-gray-900 border-dashed mt-3">
                    `;
                    resolve(content);
                }).catch(reject);
            });
        }

        function fetchSubjectsTable(grade) {
            const apiUrl = `/api/allsubjects?grade=${encodeURIComponent(grade)}`;
            return fetch(apiUrl)
                .then(response => response.json())
                .then(subjects => {
                    const table = `
                        <div class="mt-5">
                            <table class="w-full border border-gray-900">
                                <thead>
                                    <tr class="border border-gray-900 text-left">
                                        <th class="px-4 py-1 text-left">Subject</th>
                                        <th class="px-4 py-1 text-left"></th>
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
                        </div>`;
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