@include('student.includes.header')

<body class="font-poppins bg-gray-200">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('student.includes.sidebar')

        <!-- Main Content -->
        <main
            class="flex-grow rounded-none lg:rounded-r-lg lg:rounded-l-none bg-white shadow-lg overflow-hidden overflow-y-scroll">
            @include('student.includes.topnav')

            <div class="p-5 py-3">
                <p class="text-[15px] font-normal text-teal-900 mt-5">Student</p>
                <h1 class="text-xl font-bold text-teal-900">Registration</h1>
            </div>
            <div class="p-5 mt-5">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert" id="errorAlert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <script>
                    setTimeout(function() {
                        document.getElementById("errorAlert").style.display = "none";
                    }, 3000);
                </script>
            @endif
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert" id="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                    <script>
                        setTimeout(function() {
                            document.getElementById("alert").style.display = "none";
                        }, 3000);
                    </script>
                @endif

                <form class="p-5" onsubmit="return validateForm()" id="myform"
                    action="{{ route('students.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-4 text-[13px] text-gray-900">
                        <!-- LRN Field -->
                        <div class="mb-5 lg:col-span-2">
                            <label for="lrn" class="block mb-2 text-[12px] font-bold text-gray-900">
                                <span class="text-red-600 mr-1">*</span>LRN :
                            </label>
                            <input type="text" name="lrn" id="lrn"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                placeholder="Enter Learner Reference Number (LRN)" value="{{ session('lrna') }}" readonly required>
                        </div>

                        <!-- Student Number -->
                        <div class="mb-5 lg:col-span-2">
                            <label for="studentNumber" class="block mb-2 text-sm font-bold text-gray-900">
                                <span class="text-red-600 mr-1">*</span>Student No. :
                            </label>
                            <input type="text" name="student_number" id="studentNumber"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                placeholder="0000-0000" value="{{ session('student_id') }}" readonly required>
                        </div>

                        <!-- Hidden Status Field (Enrolled) -->
                        <div class="mb-5 lg:col-span-1 hidden">
                            <label for="status" class="block mb-2 text-sm font-bold text-gray-900">
                                <span class="text-red-600 mr-1">*</span>Status :
                            </label>
                            <input type="text" name="status" id="status" value="Registered"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                required>
                        </div>

                        <!-- School Year Field -->
                        <div class="lg:col-span-2 ">
                            <label for="schoolYear" class="block mb-2 text-sm font-bold text-gray-900">
                                <span class="text-red-600 mr-1">*</span>School Year :
                            </label>
                            <select name="school_year" id="schoolYear" required
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none">
                                <option value="" disabled selected>Select School Year</option>
                                <option value="{{ date('Y') }}-{{ date('Y') + 1 }}">
                                    {{ date('Y') }}-{{ date('Y') + 1 }}
                                </option>
                            </select>
                        </div>

                        <!-- Grade Selection -->
                        <div class="lg:col-span-2">
                            <label for="grade" class="block mb-2 text-sm font-bold text-gray-900">
                                <span class="text-red-600 mr-1">*</span>Select Grade :
                            </label>
                            
                            <select id="grade" name="grade"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                required>
                                <option value="" disabled selected>Select Grade</option>
                                @switch(session('gradea'))
                                    @case('Grade One')
                                        <option value="Grade Two">Grade Two</option>
                                        @break

                                    @case('Grade Two')
                                        <option value="Grade Three">Grade Three</option>
                                        @break

                                    @case('Grade Three')
                                        <option value="Grade Four">Grade Four</option>
                                        @break

                                    @case('Grade Four')
                                        <option value="Grade Five">Grade Five</option>
                                        @break

                                    @case('Grade Five')
                                        <option value="Grade Six">Grade Six</option>
                                        @break

                                    @case('Grade Six')
                                        @break
                                @endswitch
                            </select>
                            <small class="text-gray-500 text-sm">Current Grade : {{ session('gradea') }}</small>
                        </div>

                        <!-- Section Field -->
                        <div class="lg:col-span-2 hidden">
                            <input type="text" name="section" id="section"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                placeholder="Enter Section" >
                        </div>

                        <!-- Adviser Field -->
                        <div class="lg:col-span-2 hidden">
                            <input type="text" name="adviser" id="adviser"
                                class="myInput block w-full p-2.5 bg-gray-50 border border-gray-300 focus:ring-1 focus:shadow-lg focus:ring-gray-200 focus:outline-none"
                                placeholder="Enter Adviser's Name" >
                        </div>

                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end mt-10">
                        <button type="submit"
                            class="px-6 py-3 text-md font-semibold w-80 text-white bg-teal-700 hover:bg-teal-800 rounded-md shadow-md">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>




    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
    <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
</body>

</html>