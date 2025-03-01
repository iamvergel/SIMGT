@include('admin.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex p-2 w-full h-screen">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header>
                @include('admin.includes.topnav')
            </header>

            <div class="p-5">
                <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span
                            onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
                            class="hover:text-teal-700">Student Management</span> / Grade Two
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
                        <button id="dropdownDefaultButton2" data-dropdown-toggle="dropdown"
                            class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Select Section <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdown2"
                            class="z-10 fixed hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="p-2 text-md text-gray-700 dark:text-gray-200 shadow-lg"
                                aria-labelledby="dropdownDefaultButton2">
                                <!-- Default placeholder value (empty or custom message) -->
                                <li>
                                    <a href="#" class="dropdown-item text-gray-500">Select a Section</a>
                                </li>
                                <!-- Dropdown items will be injected here by AJAX -->
                            </ul>
                        </div>
                    </div>
                </div>
                
                @include('admin.includes.update_student_form') 

                @if (session('success'))
                    <script>
                        alert("{{ session('success') }}");
                    </script>
                @endif
                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                    <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px]">
                        @if ($noGradeTwoMessage)
                            <p class="text-red-600 text-center text-md">{{ $noGradeTwoMessage }}</p>
                        @else
                            <div class="p-5">
                                <table id="studentTable" class="p-3">
                                    <thead class="bg-gray-200">
                                        <tr class="text-[14px] font-normal uppercase text-left text-black">
                                            <th class="export">lrn</th>
                                            <th class="export">Student Number</th>
                                            <th class="export">Status</th>
                                            <th class="export">Profile</th>
                                            <th class="export">Grade</th>
                                            <th class="export">Section</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="" id="tableBody">
                                        @foreach ($students as $student)
                                            <tr class="hover:bg-gray-100">
                                                <td >
                                                    <span class="ml-2">{{ $student->lrn }}</span>
                                                </td>
                                                <td >
                                                    <span class="ml-2">{{ $student->student_number }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="px-2 py-1 uppercase font-semibold text-md leading-tight text-green-800 bg-green-200 rounded-sm">
                                                        {{ $student->status }}
                                                    </span>
                                                </td>
                                                <td class="flex justify-start items-center">
                                                    @php
                                                        $account = $studentAccount[$student->student_number] ?? null;
                                                        $avatar = $account && $account->avatar ? asset('storage/' . $account->avatar) : null;
                                                        $initials = strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1));
                                                    @endphp
                                                    <div class="w-12 h-12 rounded-full bg-teal-700 text-white flex items-center justify-center font-bold mx-2">
                                                        @if ($avatar)
                                                            <img src="{{ $avatar }}" alt="Student Avatar" class="w-12 h-12 rounded-full object-cover">
                                                        @else
                                                            {{ $initials }}
                                                        @endif
                                                    </div>
                                                    <div class="">
                                                        <span class="text-sm font-semibold">{{ $student->student_last_name }}, {{ $student->student_first_name }}  {{ $student->student_suffix_name }} {{ $student->student_middle_name }}</span>
                                                        <span class="text-xs text-gray-500">{{ $student->email_address_send }}</span>
                                                    </div>
                                                </td>
                                                <td class="">{{ $student->grade }}</td>
                                                <td class="">{{ $student->section }}</td>
                                                <td class="">
                                                    <form action="{{ route('account.reset', $student->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <input class="hidden" type="text" name="defaultPassword" value="{{ 'SELC' . $student->student_last_name . substr($student->student_number, -4) }}" required>
                                                        <button type="submit" onclick="return confirm('Are you sure you want to reset this student\'s account?');"
                                                            class="text-white font-medium text-xl p-3 text-center inline-flex items-center me-2 bg-sky-800 rounded-full hover:bg-sky-700"
                                                            title="Reset Student Account">
                                                            <i class="fa-solid fa-rotate-right"></i>
                                                        </button>
                                                    </form>

                                                    <button data-modal-toggle="updatetudentinfo{{ $student->id }}" data-modal-target="updatetudentinfo{{ $student->id }}"
                                                        class="text-white font-medium text-xl p-3 text-center inline-flex items-center me-2 bg-teal-700 rounded-full hover:bg-teal-600"
                                                        type="button" aria-label="Update Student" title="Update Student Info">
                                                        <i class="fa-solid fa-square-pen"></i>
                                                    </button>

                                                    <form action="{{ route('send.email', $student->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit"
                                                            class="text-white font-medium text-xl p-3 text-center inline-flex items-center me-2 bg-cyan-700 rounded-full hover:bg-cyan-600"
                                                            title="Send Email">
                                                            <i class="fa-solid fa-envelope"></i>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('students.drop', $student->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" onclick="return confirm('Are you sure you want to drop this student?');"
                                                            class="text-white font-medium text-lg p-3 text-center inline-flex items-center me-2 bg-red-700 rounded-full hover:bg-red-600"
                                                            title="Drop Student">
                                                            <i class="fa-solid fa-user-xmark"></i>
                                                        </button>
                                                    </form>

                                                    <button class="text-white font-medium text-xl p-3 text-center inline-flex items-center me-2 bg-blue-700 rounded-full hover:bg-blue-600"
                                                            type="button" onclick="window.location.href = '{{ route('student.show', ['id' => $student->id]) }}'">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
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

    
    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
</body>

</html>