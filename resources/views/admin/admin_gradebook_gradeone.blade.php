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

            <div class="flex">
                <div class="relative mt-1">
                    <button id="section-toogle"
                        class="absolute left-5 top-[7rem] text-white flex justify-center items-center bg-teal-700 text-white shadow-lg ml-0 py-0 px-0 transition-all duration-300 hover:bg-teal-800 rounded-full"><i
                            class="fas fa-bars text-xl text-normal font-semibold p-2"></i></button>

                    <div class="bg-teal-700 text-teal-50 h-screen w-[0px] absolute top-0 left-0 transition-all duration-300 ease-in-out overflow-y-auto z-[1]"
                        id="section-sidebar">
                        <div class="p-3">
                            <div id="section">
                                sfsdfsdf
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="p-5">
                        <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                        <p class="text-2xl font-bold text-teal-900 ml-5">
                            <span onclick="window.location.href ='/StEmelieLearningCenter.HopeSci66/admin/Grade-book'"
                                class="hover:text-teal-700">Grade Book</span> / Grade One /
                            {{ $TeacherInfo->first_name }} {{ $TeacherInfo->last_name }} /
                        </p>

                    </div>

                    <div class="bg-teal-800 rounded-lg mx-5 mt-1 px-0" id="classrecord">
                        <!-- The list of subjects will be inserted here dynamically -->
                    </div>

                    <div class="w-full p-5 mt-10">

                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradebook.js') }}" type="text/javascript"></script>

</body>

</html>