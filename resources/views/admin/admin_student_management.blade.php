<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>St. Emilie Learning Center</title>
    <link rel="shortcut icon" href="{{ asset('../assets/images/SELC.png') }}" type="image/x-icon"
        style="border-radius: 50%;">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/20a0e1e87d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
            scrollbar-width: none;
            cursor: default;
        }
    </style>
</head>

<body class="font-poppins bg-gray-200">


    <div class="flex p-2 w-full h-screen">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50"
            id="content">
            <header class="">
                @include('admin.includes.topnav')
            </header>

            <div class="p-5">
                <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                <h1 class="text-2xl font-bold text-teal-900 ml-5">Student Management</h1>

                <!-- Search Bar -->
                <div class="mt-10 ml-5 flex justify-end items-center">
                    <button
                        class="block w-86 right-0 mr-10 text-[12px] text-white shadow-lg px-10 bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded py-2.5 text-center"
                        onclick="window.location.href = '/StEmelieLearningCenter.HopeSci66/admin/student-management/AllStudentData'">
                        Show student data
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-4 xl:grid-cols-4 2xl:grid-cols-3 gap-5 mt-0   p-5">
                <!---->
                <div class="col-span-2 xl:col-span-2 2xl:col-span-1 bg-yellow-100 shadow-lg p-10 rounded-lg">
                    <div
                        class="p-6 bg-white rounded-lg shadow-lg border-2 dark:bg-gray-800 dark:border-gray-700 text-teal-900">
                        <div class="flex justify-start items-center p-5">
                            <i class="fa-solid fa-users text-[50px]"></i>
                            <div class="block ml-3 text-teal-900">
                                <a href="#">
                                    <h5 class="text-2xl font-bold tracking-tight">
                                        Grade One
                                    </h5>
                                </a>
                                <p class="mb-3 font-normal">
                                    Number of Students: <span
                                        class="font-bold">{{ $students->where('grade', 'Grade One')->where('status', 'Active')->count() }}</span>
                                    <br />
                                    <span class="text-[12px] text-red-500">
                                        {{ $students->where('grade', 'Grade One')->where('status', 'Active')->isEmpty() ? '(No students found)' : '' }}</span>
                                </p>
                            </div>
                        </div>

                        <a href="/StEmelieLearningCenter.HopeSci66/admin/student-management/GradeOne"
                            class="flex text-white text-[15px] justify-center p-5 w-full bg-teal-700 items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 mt-5"
                            id="studentManagementButton1">
                            <i class="fa-solid fa-users"></i>
                            <span class="sidebar-text ml-2 font-bold sm:text-[10px] lg:text-[15px]">Grade One</span>
                        </a>
                    </div>
                </div>

                <div class="col-span-2 xl:col-span-2 2xl:col-span-1 bg-teal-200 shadow-lg p-10 rounded-lg">
                    <div
                        class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg border-2 dark:bg-gray-800 dark:border-gray-700 text-teal-900">
                        <div class="flex justify-start items-center p-5">
                            <i class="fa-solid fa-users text-[50px]"></i>
                            <div class="block ml-3 text-teal-900">
                                <a href="#">
                                    <h5 class="text-2xl font-bold tracking-tight">
                                        Grade Two</h5>
                                </a>
                                <p class="mb-3 font-normal">
                                    Number of Students: <span
                                        class="font-bold">{{ $students->where('grade', 'Grade Two')->where('status', 'Active')->count() }}</span>
                                    <br />
                                    <span class="text-[12px] text-red-500">
                                        {{ $students->where('grade', 'Grade Two')->where('status', 'Active')->isEmpty() ? '(No students found)' : '' }}</span>
                                </p>
                            </div>
                        </div>

                        <a href="/StEmelieLearningCenter.HopeSci66/admin/student-management/GradeTwo"
                            class="flex text-white text-[15px] justify-center p-5 w-full bg-teal-700 items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 mt-5"
                            id="studentManagementButton1">
                            <i class="fa-solid fa-users"></i>
                            <span class="sidebar-text ml-2 font-bold sm:text-[10px] lg:text-[15px]">Grade two</span>
                        </a>
                    </div>
                </div>

                <div class="col-span-2 xl:col-span-2 2xl:col-span-1 bg-green-200 shadow-lg p-10 rounded-lg">
                    <div
                        class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg border-2 dark:bg-gray-800 dark:border-gray-700 text-teal-900">
                        <div class="flex justify-start items-center p-5">
                            <i class="fa-solid fa-users text-[50px]"></i>
                            <div class="block ml-3 text-teal-900">
                                <a href="#">
                                    <h5 class="text-2xl font-bold tracking-tight">
                                        Grade Three</h5>
                                </a>
                                <p class="mb-3 font-normal">
                                    Number of Students: <span
                                        class="font-bold">{{ $students->where('grade', 'Grade Three')->where('status', 'Active')->count() }}</span>
                                    <br />
                                    <span class="text-[12px] text-red-500">
                                        {{ $students->where('grade', 'Grade Three')->where('status', 'Active')->isEmpty() ? '(No students found)' : '' }}</span>
                                </p>
                            </div>
                        </div>

                        <a href="/StEmelieLearningCenter.HopeSci66/admin/student-management/GradeThree"
                            class="flex text-white text-[15px] justify-center p-5 w-full bg-teal-700 items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 mt-5"
                            id="studentManagementButton1">
                            <i class="fa-solid fa-users"></i>
                            <span class="sidebar-text ml-2 font-bold sm:text-[10px] lg:text-[15px]">Grade Three</span>
                        </a>
                    </div>
                </div>

                <div class="col-span-2 xl:col-span-2 2xl:col-span-1 bg-red-200 shadow-lg p-10 rounded-lg">
                    <div
                        class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg border-2 dark:bg-gray-800 dark:border-gray-700 text-teal-900">
                        <div class="flex justify-start items-center p-5">
                            <i class="fa-solid fa-users text-[50px]"></i>
                            <div class="block ml-3 text-teal-900">
                                <a href="#">
                                    <h5 class="text-2xl font-bold tracking-tight">
                                        Grade Four</h5>
                                </a>
                                <p class="mb-3 font-normal">
                                    Number of Students: <span
                                        class="font-bold">{{ $students->where('grade', 'Grade Four')->where('status', 'Active')->count() }}</span>
                                    <br />
                                    <span class="text-[12px] text-red-500">
                                        {{ $students->where('grade', 'Grade Four')->where('status', 'Active')->isEmpty() ? '(No students found)' : '' }}</span>
                                </p>
                            </div>
                        </div>

                        <a href="/StEmelieLearningCenter.HopeSci66/admin/student-management/GradeFour"
                            class="flex text-white text-[15px] justify-center p-5 w-full bg-teal-700 items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 mt-5"
                            id="studentManagementButton1">
                            <i class="fa-solid fa-users"></i>
                            <span class="sidebar-text ml-2 font-bold sm:text-[10px] lg:text-[15px]">Grade Four</span>
                        </a>
                    </div>
                </div>

                <div class="col-span-2 xl:col-span-2 2xl:col-span-1 bg-cyan-200 shadow-lg p-10 rounded-lg">
                    <div
                        class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg border-2 dark:bg-gray-800 dark:border-gray-700 text-teal-900">
                        <div class="flex justify-start items-center p-5">
                            <i class="fa-solid fa-users text-[50px]"></i>
                            <div class="block ml-3 text-teal-900">
                                <a href="#">
                                    <h5 class="text-2xl font-bold tracking-tight">
                                        Grade Five</h5>
                                </a>
                                <p class="mb-3 font-normal">
                                    Number of Students: <span
                                        class="font-bold">{{ $students->where('grade', 'Grade Five')->where('status', 'Active')->count() }}</span>
                                    <br />
                                    <span class="text-[12px] text-red-500">
                                        {{ $students->where('grade', 'Grade Five')->where('status', 'Active')->isEmpty() ? '(No students found)' : '' }}</span>
                                </p>
                            </div>
                        </div>

                        <a href="/StEmelieLearningCenter.HopeSci66/admin/student-management/GradeFive"
                            class="flex text-white text-[15px] justify-center p-5 w-full bg-teal-700 items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 mt-5"
                            id="studentManagementButton1">
                            <i class="fa-solid fa-users"></i>
                            <span class="sidebar-text ml-2 font-bold sm:text-[10px] lg:text-[15px]">Grade Five</span>
                        </a>
                    </div>
                </div>

                <div class="col-span-2 xl:col-span-2 2xl:col-span-1 bg-blue-200 shadow-lg p-10 rounded-lg">
                    <div
                        class="p-6 bg-white border border-gray-200 rounded-lg shadow-lg border-2 dark:bg-gray-800 dark:border-gray-700 text-teal-900">
                        <div class="flex justify-start items-center p-5">
                            <i class="fa-solid fa-users text-[50px]"></i>
                            <div class="block ml-3 text-teal-900">
                                <a href="#">
                                    <h5 class="text-2xl font-bold tracking-tight">
                                        Grade Six</h5>
                                </a>
                                <p class="mb-3 font-normal">
                                    Number of Students: <span
                                        class="font-bold">{{ $students->where('grade', 'Grade Six')->where('status', 'Active')->count() }}</span>
                                    <br />
                                    <span class="text-[12px] text-red-500">
                                        {{ $students->where('grade', 'Grade Six')->where('status', 'Active')->isEmpty() ? '(No students found)' : '' }}</span>
                                </p>
                            </div>
                        </div>

                        <a href="/StEmelieLearningCenter.HopeSci66/admin/student-management/GradeSix"
                            class="flex text-white text-[15px] justify-center p-5 w-full bg-teal-700 items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 mt-5"
                            id="studentManagementButton1">
                            <i class="fa-solid fa-users"></i>
                            <span class="sidebar-text ml-2 font-bold sm:text-[10px] lg:text-[15px]">Grade Six</span>
                        </a>
                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>