@include('admin.includes.header')

<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('admin.includes.topnav')
            </header>

            <div class="p-5">
                <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                <p class="text-2xl font-bold text-teal-900 ml-5">
                    <span
                        class="hover:text-teal-700">Report Section</span> / Graduate Student
                </p>
                <div class="w-24 mt-5 ml-5 text-[12px] text-white shadow-lg bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full py-2 text-center"
                    onclick="window.history.back();"><i class="fas fa-arrow-left" style="color: white;"></i> Go Back
                </div>

                <!-- Search Bar -->
                <div class="mt-10 ml-5 flex justify-between items-center hidden">
                    <div class="flex items-center">
                        <i class="fas fa-search text-xl text-teal-700 px-3"></i>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name..."
                            class="text-sm px-4 py-3 text-teal-900 border border-gray-300 rounded-lg w-80 shadow-lg focus:outline-none" />
                    </div>
                </div>
                @if (session('success'))
                    <div class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 shadow-md my-5"
                        role="alert" id="success-alert">
                        <div class="flex">
                            <div class="py-1"><i class="fa-solid fa-check text-green-500 me-2"></i>{{ session('success') }}</div>
                        </div>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById("success-alert").remove();
                        }, 3000);
                    </script>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-5"
                        role="alert" id="error-alert">
                        <div class="flex">
                            <div class="py-1"><i class="fa-solid fa-circle-exclamation text-red-500 me-2"></i>{{ session('error') }}</i></div>
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
                        <div class="w-full h-full overflow-auto border-4 border-teal-50 rounded-lg p-5">
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
                                                            <span class="px-2 py-1 uppercase font-semibold text-[10px] rounded-lg leading-tight text-blue-800 bg-blue-200">
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
                                                    <!-- View Student Information Button -->
                                                    <button class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-blue-700 rounded-full hover:bg-blue-600"
                                                                    type="button" onclick="window.location.href = '{{ route('student.show.gradute', ['id' => $student->id]) }}'" title="Show Student Information">
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
</body>

</html>