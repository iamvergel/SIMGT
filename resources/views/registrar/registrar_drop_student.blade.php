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
                <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Registrar</p>
                <p class="text-2xl font-bold text-teal-900 ml-5">
                    <span class="hover:text-teal-700">Report Section</span> / Dropped Students
                </p>

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
                        }, 3000);
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
                        }, 3000);
                    </script>
                @endif

                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                    <div class="w-full bg-white mb-8 rounded-lg shadow-lg text-[12px]">
                        <div class="w-full h-full overflow-x-scroll border-4 border-teal-50 rounded-lg">
                                <div class="table-responsive p-5">
                                <table id="studentTable" class="p-3 display responsive nowrap" width="100%">
                                    <thead class="table-header bg-gray-100">
                                        <tr class="text-md font-semibold tracking-wide text-left uppercase border">
                                        <tr class="text-[14px] font-normal uppercase text-left text-black">
                                            <th class="export">lrn</th>
                                            <th class="export">Student Number</th>
                                            <th class="export">Status</th>
                                            <th class="export">Profile</th>
                                            <th class="">Action</th>
                                        </tr>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white" id="tableBody">
                                    @foreach ($students as $student)
                                                @php
                                                    $account = $studentAccount[$student->student_number] ?? null;
                                                    $avatar = $account && $account->avatar ? asset('storage/' . $account->avatar) : null;
                                                    $initials = strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1));
                                                    $primaryInfo = $studentsPrimary[$student->student_number] ?? null;
                                                @endphp

                                                    <tr class="hover:bg-gray-100">
                                                        <td>
                                                            <span class="hidden">{{ $student->id }}</span>
                                                            <span class="ml-2">{{ $student->lrn }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="ml-2">{{ $student->student_number }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="px-2 py-1 uppercase font-semibold text-[10px] rounded-lg leading-tight text-red-800 bg-red-200">
                                                                {{ $student->status }}
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
                                                <td class="px-4 py-3 border">
                                                    <!-- Retrieve Student Button -->
                                                    <button type="button" class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-teal-700 rounded-full hover:bg-teal-600"
                                                        onclick="document.getElementById('retrieveStudentModal{{ $student->id }}').classList.remove('hidden');"
                                                        title="Retrieve Student">
                                                        <i class="fa-solid fa-retweet"></i>
                                                    </button>
                                                    <!-- Retrieve Student Modal -->
                                                    <div class="fixed inset-0 z-10 bg-black bg-opacity-50 hidden p-5 flex items-center justify-center" id="retrieveStudentModal{{ $student->id }}">
                                                        <div class="bg-white rounded-lg shadow-lg p-5 max-w-lg mx-auto mt-16">
                                                            <div class="flex items-center text-teal-700 text-lg font-semibold font-normal">
                                                                <span>Retrieve Student Confirmation</span>
                                                            </div>
                                                            <hr class="border-1 border-teal-500 mt-5">
                                                            <div class="mt-5 text-sm">
                                                                <p class="text-gray-800 text-justify">Are you sure you want to retrieve this student?</p>
                                                            </div>
                                                            <div class="flex justify-end mt-10 text-sm">
                                                                <button class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white"
                                                                    onclick="document.getElementById('retrieveStudentModal{{ $student->id }}').classList.add('hidden');">
                                                                    Cancel
                                                                </button>
                                                                <form action="{{ route('students.retrieve', $student->id) }}" method="POST" style="display:inline;">
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
                                                                    type="button" onclick="window.location.href = '{{ route('student.show.dropped.registrar', ['id' => $student->id]) }}'" title="Show Student Information">
                                                                <i class="fa-solid fa-eye"></i>
                                                            </button>
                                                </td>
                                            </tr>
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            
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