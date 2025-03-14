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
                    <span class="hover:text-teal-700">Report Section</span> / Dropped Students
                </p>

                <!-- Search Bar -->
                <div class="mt-10 ml-5 flex justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-search text-xl text-teal-700 px-3"></i>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name..."
                            class="text-sm px-4 py-3 text-teal-900 border border-gray-300 rounded-lg w-80 shadow-lg focus:outline-none" />
                    </div>

                    <div class="flex">
                        <button
                            class="block w-86 right-0 mr-10 text-[12px] text-white shadow-lg px-10 bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded py-2.5 text-center"
                            onclick="window.location.href = '/StEmelieLearningCenter.HopeSci66/admin/Report-Section/Drop-Student/All-Drop-Data'">
                            Show student dropped data
                        </button>
                    </div>
                </div>

                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200">
                    <div class="w-full bg-white mb-8 rounded-lg shadow-lg text-[12px]">
                        <div class="w-full h-full overflow-x-scroll border-4 border-teal-50 rounded-lg">
                            <!-- Enables horizontal scrolling -->
                            @if ($noDroppedMessage)
                                <p class="text-red-600 text-center text-md">{{ $noDroppedMessage }}</p>
                            @else
                                <div class="table-responsive p-5">
                                <table id="studentTable" class="p-3 display responsive nowrap" width="100%">
                                    <thead class="table-header bg-gray-100">
                                        <tr class="text-md font-semibold tracking-wide text-left uppercase border">
                                            <th class="px-4 py-3">Student Number</th>
                                            <th class="px-4 py-3">Status</th>
                                            <th class="px-4 py-3">Name</th>
                                            <th class="px-4 py-3">Grade</th>
                                            <th class="px-4 py-3">Section</th>
                                            <th class="px-4 py-3">Email</th>
                                            <th class="px-4 py-3">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white" id="tableBody">
                                        @foreach ($students as $student)
                                            <tr class="text-gray-700 table-row">
                                                <td class="px-4 py-3 border flex items-center justify-center w-40">
                                                    <div
                                                        class="w-10 h-10 rounded-full bg-gray-500 text-white flex items-center justify-center font-bold mt-2">
                                                        {{ strtoupper(substr($student->student_last_name, 0, 1) . substr($student->student_first_name, 0, 1)) }}
                                                    </div>
                                                    <span class="ml-2 mt-2">{{ $student->student_number }}</span>
                                                </td>
                                                <td class="px-4 py-3 text-xs border">
                                                    <span
                                                        class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-sm">
                                                        {{ $student->status}}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 border">{{ $student->student_last_name }}
                                                    {{ $student->student_first_name }}
                                                </td>
                                                <td class="px-4 py-3 border">{{ $student->grade }}</td>
                                                <td class="px-4 py-3 border">{{ $student->section }}</td>
                                                <td class="px-4 py-3 border">{{ $student->email_address_send }}</td>
                                                <td class="px-4 py-3 border">
                                                    <form action="{{ route('students.retrieve', $student->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('PUT') <!-- Use PUT for updates -->
                                                        <button type="submit"
                                                            onclick="return confirm('Are you sure you want to retrive this student?');"
                                                            class="px-5 l-2 py-2 mb-1 text-[12px] text-white bg-teal-700 shadow rounded hover:bg-teal-600">
                                                            Retrieve Student
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            @endif
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