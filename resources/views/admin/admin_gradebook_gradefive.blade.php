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
                <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span class="hover:text-teal-700">Grade Book / Class Record / Grade Five / {{ $TeacherInfo->first_name }} {{ $TeacherInfo->last_name }}</span> / <span id="subjectName"></span>
                    </p>
                </div>

                <div class="flex justify-between items-center gap-4 mt-2W">
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
                            onclick="window.location.href = '/admin/student-management/AllStudentData'">
                            Show student data
                        </button> -->
                    </div>

                    <div class="">
                        <!-- <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="flex justify-between text-white w-72 bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
                            type="button">Select Section <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>


                        <div id="dropdown"
                            class="z-10 fixed hidden bg-white divide-y divide-gray-100 rounded-lg shadow  w-72">
                            <ul class="p-2 text-md text-gray-700 dark:text-gray-200 shadow-lg"
                                aria-labelledby="dropdownDefaultButton">
                                 Default placeholder value (empty or custom message)
                                <li>
                                    <a href="#" class="dropdown-item text-gray-500">Select a Section</a>
                                </li>
                                 Dropdown items will be injected here by AJAX
                            </ul>
                        </div> -->
                    </div>
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

            <div class="mt-0 text-[14px] font-semibold w-full px-5">
                <ul
                    class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-8 gap-0 xl:gap-0 bg-gray-50 p-0 m-0">
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 active1 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#first">First Quarter</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#second">Second Quarter</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#third">Third Quater</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#fourth">Fourth Quarter</li>
                    <li class="cursor-pointer text-white bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 rounded-t-lg px-5 rounded-lg m-1 xl:rounded-lg xl:m-2"
                        data-target="#summary">Grade Summary</li>
                </ul>

                <button
                    class="float-right text-white font-semibold text-md bg-teal-600 hover:bg-teal-700 transition-all duration-300 p-2 px-10 rounded-lg mr-10"
                    id="save"><i class="fa-solid fa-floppy-disk me-2"></i>Save<button>
            </div>
            <!-- component -->
            <div class="mx-auto p-2 mt-5 rounded-lg shadow-lg bg-gray-50">
                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container"
                    id="first">
                    @include('admin.includes.first_quarter')
                </div>

                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container"
                    id="second" style="display:none;">
                    @include('admin.includes.second_quarter')
                </div>

                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container" id="third"
                    style="display:none;">
                    @include('admin.includes.third_quarter')
                </div>

                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container"
                    id="fourth" style="display:none;">
                    @include('admin.includes.fourth_quarter')
                </div>

                <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px] table-container"
                    id="summary" style="display:none;">
                    @include('admin.includes.grade_summary')
                </div>

            </div>

        </main>
    </div>


    <script src="{{ asset('../js/admin/admin.js') }}"></script>
    @include('admin.includes.js-link')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>   
    <script>
        $(document).ready(function () {
            $('td[contenteditable="true"]').on('blur', function () {
                var updatedValue = $(this).text();
                var column = $(this).data('column');
                var id = $(this).data('id');
                var grade = $(this).data('grade'); // This will be undefined for Teacher
                var subject = $(this).data('subject');

                // Determine which URL and grade to use
                var url = '';
                var data = {
                    id: id,
                    column: column,
                    value: updatedValue,
                    _token: '{{ csrf_token() }}'
                };

                if (grade) {
                    // This is for student
                    url = '/student/update-inline';
                    data.grade = grade; // Only add grade for students
                } else if (subject) {
                    url = '/student/update-inlin/final';
                } else {
                    // This is for teacher
                    url = '/teacher-subject-class/update-inline';
                }

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: data,
                    success: function (response) {
                        if (response.success) {
                           
                        } else {
                            alert('Failed to update data!');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error details:', error);

                    }
                });
            });

            $('#save').on('click', function () {
                alert('Data has been saved successfully!');

                window.location.reload();
            });
        });
    </script>

</body>

<style>
    td[contenteditable="true"] {
        background-color:rgb(243, 255, 236);
    }

    .active1 {
        background-color: #115e59;
        color: white;
        font-weight: bold;
        transform: scale(1.1);
    }

    .table-container {
        width: 100%;
    }

    .hidden {
        display: none !important;
    }
</style>

</html>