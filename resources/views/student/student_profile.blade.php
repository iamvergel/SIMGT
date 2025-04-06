@include('student.includes.header')

<body class="font-poppins bg-gray-200">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('student.includes.sidebar')

        <!-- Main Content -->
        <main
            class="flex-grow rounded-none lg:rounded-r-lg lg:rounded-l-none bg-white shadow-lg overflow-hidden overflow-y-scroll">
            @include('student.includes.topnav')

            <div id="container">
                <div class="p-5 py-3">
                    <p class="text-[15px] font-normal text-teal-900 mt-5">Student</p>
                    <h1 class="text-xl font-bold text-teal-900">SIMGT Profile</h1>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-2">
                    <div class="col-span-1">
                        @include('student.includes.profile_sidebar')
                    </div>
                    <div class="col-span-1 lg:col-span-3">
                        <div id="accountSection" class="content-section">
                            @include('student.includes.student_account')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
    <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
</body>

</html>