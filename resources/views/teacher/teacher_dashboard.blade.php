@include('teacher.includes.header')

<body class="font-poppins bg-gray-200">
    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('teacher.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow bg-white shadow-lg overflow-x-hidden overflow-y-scroll w-full bg-zinc-50" id="content">
            <header class="sticky top-0 z-[10]">
                @include('teacher.includes.topnav')
            </header>

            <div class="p-5">
                <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Teacher</p>
                <h1 class="text-2xl font-bold text-teal-900 ml-5">Dashboard</h1>

                <div class="grid grid-cols-4 gap-5 mt-10 border-t-2 border-teal-800">
                    <div id="dashboard"
                        class="col-span-2 bg-gradient-to-tr from-teal-700 to-teal-500 py-0 mt-5 lg:py-0 pl-3 text-white rounded-lg shadow-lg text-start flex items-center justify-between">
                        <div class="flex flex-col py-10">
                            <p id="welcomeText" class="font-bold text-[20px] lg:text-[30px] 2xl:text-[40px]">
                                Welcome, Teacher <br />{{ session('teacher_fname') . ' ' . session('teacher_lname') }}!
                            </p>
                            <p id="descriptionText" class="font-normal text-[12px] lg:text-[15px]">Always stay updated
                                in
                                your
                                student portal</p>
                        </div>
                    </div>

                    <div class="bg-white text-teal-800 rounded-lg shadow-lg text-start mt-5 p-5 flex justify-center items-center">
                        <div class="p-5 bg-gray-100 shadow-lg rounded-lg">
                            <p class="text-sm font-semibold">My Advisory Class<br/>
                                <span class="font-bold text-teal-700 text-xl uppercase">{{session('grade') . ' - ' . session('section') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>