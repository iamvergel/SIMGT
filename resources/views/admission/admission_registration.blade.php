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
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
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
                                                                                <span class="bg-yellow-300 text-yellow-800 px-2 py-1 font-semibold rounded-full">{{ $student->status }}</span>
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
                                                                                    <span class="text-sm font-semibold">{{ $primaryInfo->student_last_name }}
                                                                                {{ $primaryInfo->student_first_name }}
                                                                                {{ $primaryInfo->student_middle_name }}
                                                                                {{ $primaryInfo->student_suffix_name }}</span>
                                                                                    <br><span
                                                                                        class="text-xs text-gray-500">{{ $primaryInfo->email_address_send }}</span>
                                                                                </div>
                                                                            </td>
                                                                            <td class="px-4 py-3">{{ $student->grade }}</td>
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
</body>

</html>