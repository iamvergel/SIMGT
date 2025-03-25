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
                                            <button 
    data-modal-toggle="updatetudentinfo{{ $student->id }}"
    data-modal-target="updatetudentinfo{{ $student->id }}"
    data-fullname="{{ $student->student_last_name }} {{ $student->student_first_name }} {{ $student->student_middle_name }} {{ $student->student_suffix_name }}"
    data-gender="{{ $student->sex }}" 
    data-grade="{{ $student->grade }}"
    data-birthdat="{{ $student->birth_date }}"
    class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-blue-700 rounded-full hover:bg-blue-600"
    type="button" 
    aria-label="Update Student" 
    title="Enrolled Student"
    onclick="checkEnrollmentStatus('{{ $student->lrn }}')">
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
    </div>


    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
    <script>
    function checkEnrollmentStatus(lrn) {
        // Make an AJAX request to check the enrollment status
        fetch(`/check-enrollment-status/${lrn}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    // Show an alert if the student is already enrolled
                    alert(data.message);
                } else {
                    // If the student is not enrolled, proceed to the normal action
                    window.location.href = '{{ route('student.show.enrollees', ['lrn' => $student->lrn]) }}';
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
</body>

</html>