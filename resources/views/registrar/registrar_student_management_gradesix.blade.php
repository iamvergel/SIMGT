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
                            class="hover:text-teal-700">Student Management</span> / Grade Six
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
                        <h1 class="mx-5 font-semibold text-xl text-teal-800" id="section">Section :</h1>
                    </div>

                    <div class="mr-10">
                        <button id="dropdownDefaultButtonSix" data-dropdown-toggle="dropdown"
                            class="text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Select Section <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownSix"
                            class="z-10 fixed hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-56 dark:bg-gray-700">
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



                @if (session('success'))
                    <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-5"
                        role="alert" id="success-alert">
                        <div class="flex">
                            <div class="py-1">{{ session('success') }}<i class="fa-solid fa-check text-green-500"></i></div>
                        </div>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById("success-alert").remove();
                        }, 5000);
                    </script>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-5"
                        role="alert" id="error-alert">
                        <div class="flex">
                            <div class="py-1">{{ session('success') }}<i
                                    class="fa-solid fa-circle-exclamation text-red-500"></i></div>
                            <div>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById("error-alert").remove();
                        }, 1000000);
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
                                            
                                            <th class="export">Status</th>
                                            <th class="export">Profile</th>
                                            <th class="export">Grade</th>
                                            <th class="export">Section</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="" id="tableBody">
                                            @foreach ($students as $student)
                                                @php
                                                    $account = $studentAccount[$student->student_number] ?? null;
                                                    $avatar = $account && $account->avatar ? asset('storage/' . $account->avatar) : null;
                                                    $initials = strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1));
                                                    $primaryInfo = $studentsPrimary[$student->student_number] ?? null;
                                                @endphp
                                                @if ($primaryInfo && $primaryInfo->grade == 'Grade Six' && $primaryInfo->status == 'Enrolled')
                                                    <tr class="hover:bg-gray-100">
                                                        <td>
                                                            <span class="hidden">{{ $student->id }}</span>
                                                            <span class="ml-2">{{ $student->lrn }}</span>
                                                        </td>
                                                        
                                                        <td>
                                                            <span class="px-2 py-1 uppercase font-semibold text-[10px] rounded-lg leading-tight text-green-800 bg-green-200">
                                                                {{ $primaryInfo->status }}
                                                            </span>
                                                        </td>
                                                        <td class="flex justify-start items-center">
                                                            <div class="w-12 h-12 rounded-full bg-teal-700 text-white flex items-center justify-center font-bold mx-2">
                                                                @if ($avatar)
                                                                    <img src="{{ $avatar }}" alt="Student Avatar" class="w-12 h-12 rounded-full object-cover">
                                                                @else
                                                                    {{ $initials }}
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <span class="text-sm font-semibold">{{ $student->student_last_name }}, {{ $student->student_first_name }}  {{ $student->student_suffix_name }} {{ $student->student_middle_name }}</span>
                                                                <br><span class="text-xs text-gray-500">{{ $student->email_address_send }}</span>
                                                            </div>
                                                        </td>
                                                        <td>{{ $primaryInfo->grade }}</td>
                                                        <td>{{ $primaryInfo->section }}</td>
                                                        <td>
                                                             <!-- Reset Account Form -->
                                                             <form action="{{ route('account.reset', $student->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                
                                                                <button type="button" onclick="document.getElementById('resetAccountModal{{ $student->id }}').classList.remove('hidden');"
                                                                    class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-sky-800 rounded-full hover:bg-sky-700"
                                                                    title="Reset Student Account">
                                                                    <i class="fa-solid fa-rotate-right"></i>
                                                                </button>
                                                            </form>
                                                             <!-- Reset Account Modal -->
                                                             <div class="fixed inset-0 z-10 bg-black bg-opacity-50 hidden p-5 flex items-center justify-center" id="resetAccountModal{{ $student->id }}">
                                                                 <div class="bg-white rounded-lg shadow-lg p-5 max-w-lg mx-auto mt-16">
                                                                     <div class="flex items-center text-sky-700 text-lg font-semibold font-normal">
                                                                         <span>Reset Student Account Confirmation</span>
                                                                     </div>
                                                                     <hr class="border-1 border-sky-600 mt-5">
                                                                     <div class="mt-5 text-sm">
                                                                         <p class="text-gray-800 text-justify">Are you sure you want to reset this student's account?</p>
                                                                     </div>
                                                                     <div class="flex justify-end mt-10 text-sm">
                                                                         <button class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white"
                                                                             onclick="document.getElementById('resetAccountModal{{ $student->id }}').classList.add('hidden');">
                                                                             Cancel
                                                                         </button>
                                                                         <form action="{{ route('account.reset', $student->id) }}" method="POST" style="display:inline;">
                                                                             @csrf
                                                                             <input class="hidden" type="text" name="defaultPassword" value="{{ 'SELC' . $student->student_last_name . substr($student->lrn, -4) }}" required>
                                                                             <button type="submit"
                                                                                 class="cursor-pointer bg-sky-700 hover:bg-sky-800 px-5 py-2 rounded-sm text-white ml-3">
                                                                                 Yes, I'm sure
                                                                             </button>
                                                                         </form>
                                                                     </div>
                                                                 </div>
                                                             </div>

                                                            <!-- Update Student Info Button -->
                                                            <button data-modal-toggle="updatetudentinfo{{ $student->id }}" data-modal-target="updatetudentinfo{{ $student->id }}"
                                                                    class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-teal-700 rounded-full hover:bg-teal-600"
                                                                    type="button" aria-label="Update Student" title="Update Student Info" id="openUpdateStudentInfo{{ $student->id }}">
                                                                <i class="fa-solid fa-square-pen"></i>
                                                            </button>

                                                            <!-- Send Email Modal -->
                                                            <div class="fixed inset-0 z-10 bg-black bg-opacity-50 hidden p-5 flex items-center justify-center" id="sendEmailModal{{ $student->id }}">
                                                                <div class="bg-white rounded-lg shadow-lg p-5 max-w-lg mx-auto mt-16">
                                                                    <div class="flex items-center text-sky-700 text-lg font-semibold font-normal">
                                                                        <span>Send Email Confirmation</span>
                                                                    </div>
                                                                    <hr class="border-1 border-sky-600 mt-5">
                                                                    <div class="mt-5 text-sm">
                                                                        <p class="text-gray-800 text-justify">Are you sure you want to send an email to this student?</p>
                                                                    </div>
                                                                    <div class="flex justify-end mt-10 text-sm">
                                                                        <button class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white"
                                                                            onclick="document.getElementById('sendEmailModal{{ $student->id }}').classList.add('hidden');">
                                                                            Cancel
                                                                        </button>
                                                                        <form action="{{ route('send.email', $student->id) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            <button type="submit"
                                                                                class="cursor-pointer bg-sky-700 hover:bg-sky-800 px-5 py-2 rounded-sm text-white ml-3">
                                                                                Yes, I'm sure
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Send Email Form -->
                                                            <form action="{{ route('send.email', $student->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                <button type="button" onclick="document.getElementById('sendEmailModal{{ $student->id }}').classList.remove('hidden');"
                                                                
                                                                    class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-cyan-700 rounded-full hover:bg-cyan-600"
                                                                    title="Send Email">
                                                                    <i class="fa-solid fa-envelope"></i>
                                                                </button>
                                                            </form>
                                                            <!-- Drop Student Button -->
                                                            <button type="button" class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-red-700 rounded-full hover:bg-red-400"
                                                                    onclick="document.getElementById('dropStudentModal{{ $student->id }}').classList.remove('hidden');"
                                                                    title="Drop Student">
                                                                    <i class="fa-solid fa-user-xmark"></i>
                                                            </button>

                                                            <!-- Drop Student Modal -->
                                                            <div class="fixed inset-0 z-10 bg-black bg-opacity-50 hidden p-5 flex items-center justify-center" id="dropStudentModal{{ $student->id }}">
                                                                <div class="bg-white rounded-lg shadow-lg p-5 max-w-lg mx-auto mt-16">
                                                                    <div class="flex items-center text-red-700 text-lg font-semibold font-normal">
                                                                        <span>Drop Student Confirmation</span>
                                                                    </div>
                                                                    <hr class="border-1 border-red-500 mt-5">
                                                                    <div class="mt-5 text-sm">
                                                                        <p class="text-gray-800 text-justify">Are you sure you want to drop this student?</p>
                                                                    </div>
                                                                    <div class="flex justify-end mt-10 text-sm">
                                                                        <button class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white"
                                                                            onclick="document.getElementById('dropStudentModal{{ $student->id }}').classList.add('hidden');">
                                                                            Cancel
                                                                        </button>
                                                                        <form action="{{ route('students.drop', $student->id) }}" method="POST" style="display:inline;">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <button type="submit"
                                                                                class="cursor-pointer bg-teal-700 hover:bg-teal-800 px-5 py-2 rounded-sm text-white ml-3">
                                                                                Yes, I'm sure
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- View Student Information Button -->
                                                            <button class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-blue-700 rounded-full hover:bg-blue-600"
                                                                    type="button" onclick="window.location.href = '{{ route('student.show.registrar', ['id' => $student->id]) }}'" title="Show Student Information">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    @include('registrar.includes.update_student_form') 

    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
         @foreach ($students as $student)
                const updateModal{{ $student->id }} = document.getElementById("updatetudentinfo{{ $student->id }}");
                const openUpdateModalButton{{ $student->id }} = document.getElementById("openUpdateStudentInfo{{ $student->id }}");
                const closeUpdateModalButton{{ $student->id }} = document.getElementById("updatetudentinfoClose{{ $student->id }}");

                // Ensure the elements exist before adding event listeners
                if (openUpdateModalButton{{ $student->id }}) {
                    openUpdateModalButton{{ $student->id }}.addEventListener("click", () => {
                        if (updateModal{{ $student->id }}) {
                            updateModal{{ $student->id }}.classList.remove("hidden");
                        }
                    });
                }

                if (closeUpdateModalButton{{ $student->id }}) {
                    closeUpdateModalButton{{ $student->id }}.addEventListener("click", () => {
                        if (updateModal{{ $student->id }}) {
                            updateModal{{ $student->id }}.classList.add("hidden");
                        }
                    });
                }
            @endforeach
    </script>
</body>

</html>