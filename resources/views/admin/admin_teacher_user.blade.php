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
                        <span
                            onclick="window.location.href='/admin/student-management'"
                            class="hover:text-teal-700">Management Account</span> / Teacher
                    </p>
                </div>
                <div class="flex justify-end items-center gap-4 mt-10">
                    <div class="ml-5 flex items-center hidden">
                        <i class="fas fa-search text-xl text-teal-700 px-3"></i>
                        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by name..."
                            class="text-sm px-4 py-3 text-teal-900 border border-gray-300 rounded-lg w-96 shadow-lg focus:outline-none" />
                    </div>

                    <div class="flex">
                        <button id="openModalButton"
                            class="block w-86 right-0 mr-5 text-[12px] text-white shadow-lg px-10 bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded py-2.5 text-center"
                            type="button" aria-label="Add Student">
                            Add Teacher
                        </button>
                        <!-- <button
                            class="block w-86 right-0 mr-10 text-[12px] text-white shadow-lg px-10 bg-sky-700 hover:bg-sky-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded py-2.5 text-center"
                            onclick="window.location.href = '/admin/student-management/AllStudentData'">
                            Show student data
                        </button> -->
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

                <!-- Modal for Adding Admin -->
                <div id="addTeacherModal"
                    class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll">
                    <div class="relative px-20 py-10 w-screen h-screen">
                        <div class="w-full h-full bg-white rounded-lg shadow overflow-y-scroll">
                            <div
                                class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg sticky top-0">
                                <h3 class="text-lg font-bold text-teal-800 uppercase"><i
                                        class="fa-solid fa-users mr-2"></i>Add Teacher
                                </h3>
                                <button type="button"
                                    class="text-white bg-teal-700 hover:bg-teal-800 p-3 py-2 rounded-full text-xl font-bold flex items-center justify-center shadow-lg"
                                    aria-label="Close modal" id="closeModalButton">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="mb-5 mt-5 bg-white p-10">
                                <!-- Add Admin Form -->
                                <form action="{{ route('teacher.create') }}" method="POST"
                                    class="grid grid-cols-4 gap-4">
                                    @csrf
                                    <div class="col-span-1">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="teacher_number">
                                            <span class="text-red-600 mr-1">*</span>Employee Number
                                        </label>
                                        <input type="text" name="teacher_number" placeholder="Input Employee ID.."
                                            id="teacher_number" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 ">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="position">
                                            <span class="text-red-600 mr-1">*</span>Position
                                        </label>
                                        <select name="position" id="position" required
                                            class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                            <option value="">Select Position</option>
                                            <option value="Teacher">Teacher</option>
                                            <option value="Head">Head</option>
                                        </select>
                                    </div>
                                    <div></div>
                                    <div></div>
                                    <div class="col-span-1 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="first_name">
                                            <span class="text-red-600 mr-1">*</span>First Name
                                        </label>
                                        <input type="text" name="first_name" placeholder="Input First Name.."
                                            id="first_name" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="middle_name">
                                            <span class="text-red-600 mr-1">*</span>Middle Name
                                        </label>
                                        <input type="text" name="middle_name" placeholder="Input Middle Name.."
                                            id="middle_name" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="last_name">
                                            <span class="text-red-600 mr-1">*</span>Last Name
                                        </label>
                                        <input type="text" name="last_name" placeholder="Lastname.." id="last_name"
                                            required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="suffix">
                                            Suffix
                                        </label>
                                        <input type="text" name="suffix" placeholder="Suffix.." id="suffix"
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-4 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="address">
                                            <span class="text-red-600 mr-1">*</span>Address
                                        </label>
                                        <input type="text" name="address" placeholder="Address.." id="address" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-2 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="email">
                                            <span class="text-red-600 mr-1">*</span>Email
                                        </label>
                                        <input type="email" name="email" placeholder="Input Email.." id="email" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md">
                                    </div>
                                    <div class="col-span-2 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="contact_number">
                                            <span class="text-red-600 mr-1">*</span>Contact Number
                                        </label>
                                        <input type="text" name="contact_number" placeholder="Contact Number.."
                                            id="contact_number" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1  hidden">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="department">
                                            <span class="text-red-600 mr-1">*</span>Department
                                        </label>
                                        <input type="text" name="department" value="Department"
                                            placeholder="Department.." id="department"
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 hidden">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="status">
                                            <span class="text-red-600 mr-1">*</span>Status
                                        </label>
                                        <input type="text" name="status" value="Active" placeholder="Status.."
                                            id="status" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="gender">
                                            <span class="text-red-600 mr-1">*</span>Gender
                                        </label>
                                        <select name="gender" id="gender"
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize"
                                            required>
                                            <option value="" disabled selected>Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-span-1 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="birthdate">
                                            <span class="text-red-600 mr-1">*</span>Birthdate
                                        </label>
                                        <input type="date" name="birthdate" id="birthdate" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-2 mt-5">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="religion">
                                            <span class="text-red-600 mr-1">*</span>Religion
                                        </label>
                                        <input type="text" name="religion" placeholder="Religion.." id="religion"
                                            required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1  hidden">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="username">
                                            <span class="text-red-600 mr-1">*</span>Username
                                        </label>
                                        <input type="email" name="username" placeholder="Input Username.." id="username"
                                            required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md">
                                    </div>
                                    <div class="col-span-1 hidden">
                                        <label
                                            class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="password">
                                            <span class="text-red-600 mr-1">*</span>Password
                                        </label>
                                        <input type="text" name="password" placeholder="Input Password.." id="password"
                                            required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md">
                                    </div>
                                    <div class="col-span-4 flex justify-end mt-5">
                                        <button type="submit"
                                            class="w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200 ">
                    <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px]">
                        <div class="p-5">
                            <table id="studentTable" class="p-3 display responsive nowrap" width="100%">
                                <thead class="bg-gray-200">
                                    <tr class="text-[12px] font-normal uppercase text-left text-black">
                                        <th class="export">Employee No.</th>
                                        <!-- <th class="export">Department</th> -->
                                        <th class="export">Position</th>
                                        <th class="export">Teacher</th>
                                        <th class="export">Email</th>
                                        <th class="export">Contact No.</th>
                                        <th class="">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="" id="tableBody">
                                    @foreach ($teacher as $teachers)
                                        <tr class=" hover:bg-gray-100 ">
                                            <td class="{{ $teachers->status == "Inactive" ? "bg-red-100" : "" }}">
                                                <span class="ml-2">{{ $teachers->teacher_number }}</span>
                                            </td>
                                            <!-- <td>
                                                                                                                <span class="ml-2">{{ $teachers->department }}</span>
                                                                                                            </td> -->
                                            <td class="{{ $teachers->status == "Inactive" ? "bg-red-100" : "" }}">
                                                <span class="ml-2">{{ $teachers->position }}</span>
                                            </td>
                                            <td
                                                class="flex justify-start items-center {{ $teachers->status == "Inactive" ? "bg-red-100" : "" }}">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-teal-700 text-white flex items-center justify-center font-bold mx-2">
                                                    @if ($teachers->avatar)
                                                        <img src="/storage/{{ $teachers->avatar }}" alt="{{$teachers->avatar }}"
                                                            class="w-12 h-12 rounded-full object-cover">
                                                    @else
                                                        {{ strtoupper(substr($teachers->first_name, 0, 1) . substr($teachers->last_name, 0, 1)) }}
                                                    @endif
                                                </div>
                                                <div class="">
                                                    <span class="text-sm font-semibold">{{ $teachers->last_name }},
                                                        {{ $teachers->first_name }}
                                                        {{ $teachers->middle_name }}</span><br />
                                                    <span class="text-xs text-gray-500">{{ $teachers->username }}</span>
                                                </div>
                                            </td>
                                            <td class="{{ $teachers->status == "Inactive" ? "bg-red-100" : "" }}">
                                                <span class="ml-2">{{ $teachers->email }}</span>
                                            </td>
                                            <td class="{{ $teachers->status == "Inactive" ? "bg-red-100" : "" }}">
                                                <span class="ml-2">{{ $teachers->contact_number }}</span>
                                            </td>
                                            <td>

                                             <button {{ $teachers->status == "Inactive" ? "disabled" : "" }}
                                                    id="addAdviser{{ $teachers->id }}"
                                                    class="{{ $teachers->status == "Inactive" ? "bg-gray-400" : "bg-pink-700 hover:bg-pink-600" }} text-white font-medium text-md p-3 text-center inline-flex items-center rounded-full "
                                                    type="button" aria-label="Add Advisory" title="Add Advisory">
                                                    <i class="fa-solid fa-chalkboard-user"></i>
                                                </button>
                                                <button {{ $teachers->status == "Inactive" ? "disabled" : "" }}
                                                    id="adddSubject{{ $teachers->id }}"
                                                    class=" {{ $teachers->status == "Inactive" ? "bg-gray-400" : "bg-yellow-700 hover:bg-yellow-600" }} text-white font-medium text-md p-3 text-center inline-flex items-center rounded-full "
                                                    type="button" aria-label="Add subject" title="Add subject">
                                                    <i class="fa-solid fa-book"></i>
                                                </button>
                                                <button data-modal-toggle="updatetudentinfo{{ $teachers->id }}"
                                                    data-modal-target="updatetudentinfo{{ $teachers->id }}"
                                                    id="openUpdateModal{{ $teachers->id }}"
                                                    class="bg-teal-700 hover:bg-teal-600 text-white font-medium text-md p-3 text-center inline-flex items-center rounded-full "
                                                    type="button" aria-label="Update Student" title="Update teacher Info">
                                                    <i class="fa-solid fa-square-pen"></i>
                                                </button>
                                                <!-- Reset Account Form -->
                                                <form action="{{ route('teacher.reset', $teachers->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button {{ $teachers->status == "Inactive" ? "disabled" : "" }} type="button" onclick="document.getElementById('resetAccountModal{{ $teachers->id }}').classList.remove('hidden');"
                                                        class="{{ $teachers->status == "Inactive" ? "bg-gray-400" : "bg-sky-800 hover:bg-sky-700"}} text-white font-medium text-md p-3 text-center inline-flex items-center me-1 rounded-full "
                                                        title="Reset Teacher Account">
                                                        <i class="fa-solid fa-rotate-right"></i>
                                                    </button>
                                                </form>
                                                <!-- Reset Account Modal -->
                                                <div class="fixed inset-0 z-10 bg-black bg-opacity-50 hidden p-5 flex items-center justify-center"
                                                    id="resetAccountModal{{ $teachers->id }}">
                                                    <div class="bg-white rounded-lg shadow-lg p-5 max-w-lg mx-auto mt-16">
                                                        <div class="flex items-center text-sky-700 text-lg font-semibold font-normal">
                                                            <span>Reset Teacher Account Confirmation</span>
                                                        </div>
                                                        <hr class="border-1 border-sky-600 mt-5">
                                                        <div class="mt-5 text-sm">
                                                            <p class="text-gray-800 text-justify">Are you sure you want to reset this teacher's account?</p>
                                                        </div>
                                                        <div class="flex justify-end mt-10 text-sm">
                                                            <button class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white"
                                                                onclick="document.getElementById('resetAccountModal{{ $teachers->id }}').classList.add('hidden');">
                                                                Cancel
                                                            </button>
                                                            <form action="{{ route('teacher.reset', $teachers->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                <input class="hidden" type="text" name="defaultPassword"
                                                                    value="{{ 'SELC' . $teachers->last_name . substr($teachers->teacher_number, -4) }}"
                                                                    required>
                                                                <button type="submit"
                                                                    class="cursor-pointer bg-sky-700 hover:bg-sky-800 px-5 py-2 rounded-sm text-white ml-3">
                                                                    Yes, I'm sure
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Send Email Modal -->
                                                <div class="fixed inset-0 z-10 bg-black bg-opacity-50 hidden p-5 flex items-center justify-center"
                                                    id="sendEmailModal{{ $teachers->id }}">
                                                    <div class="bg-white rounded-lg shadow-lg p-5 max-w-lg mx-auto mt-16">
                                                        <div class="flex items-center text-sky-700 text-lg font-semibold font-normal">
                                                            <span>Send Email Confirmation</span>
                                                        </div>
                                                        <hr class="border-1 border-sky-600 mt-5">
                                                        <div class="mt-5 text-sm">
                                                            <p class="text-gray-800 text-justify">Are you sure you want to send an email to this teacher?</p>
                                                        </div>
                                                        <div class="flex justify-end mt-10 text-sm">
                                                            <button class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white"
                                                                onclick="document.getElementById('sendEmailModal{{ $teachers->id }}').classList.add('hidden');">
                                                                Cancel
                                                            </button>
                                                            <form action="{{ route('teacher.email', $teachers->id) }}" method="POST" style="display:inline;">
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
                                                <form action="{{ route('teacher.email', $teachers->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="button" onclick="document.getElementById('sendEmailModal{{ $teachers->id }}').classList.remove('hidden');"
                                                        class="text-white font-medium text-md p-3 text-center inline-flex items-center me-1 bg-cyan-700 rounded-full hover:bg-cyan-600"
                                                        title="Send Email">
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </button>
                                                </form>
                                                <button
                                                    class="text-white font-medium text-md p-3 text-center inline-flex items-center bg-blue-700 rounded-full hover:bg-blue-600"
                                                    type="button"
                                                    onclick="window.location.href = '{{ route('teacher.show', ['id' => $teachers->id]) }}'"
                                                    title="Show Teacher Information">
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

                @foreach ($teacher as $teachers)
                    <div id="addAdvisoryModal{{ $teachers->id }}"
                        class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll">
                        <div class="relative px-20 py-10 w-screen h-screen flex justify-center items-center">
                            <div
                                class="w-full lg:w-1/2 xl:w-1/3 h-96 lg:h-auto h-full bg-white rounded-lg shadow overflow-y-scroll">
                                <div
                                    class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg sticky top-0">
                                    <h3 class="text-lg font-bold text-teal-800 uppercase"><i
                                            class="fa-solid fa-users mr-2"></i>Add Advisory {
                                        {{ old('lastName', $teachers->last_name) }},
                                        {{ old('lastName', $teachers->first_name) }}
                                        {{ old('lastName', $teachers->suffix_name) }}
                                        {{ old('lastName', $teachers->middle_name) }}}
                                    </h3>
                                    <button type="button"
                                        class="text-white bg-teal-700 hover:bg-teal-800 p-3 py-2 rounded-full text-xl font-bold flex items-center justify-center shadow-lg"
                                        aria-label="Close modal" id="closeAdvisoryModal{{ $teachers->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="mb-5 mt-5 bg-white p-10">
                                    <!-- Add Admin Form -->
                                    <form action="{{ route('advisory.create') }}" method="POST"
                                        class="grid grid-cols-1 gap-4">
                                        @csrf
                                        <div class="col-span-1 hidden">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                for="teacher_number">
                                                <span class="text-red-600 mr-1">*</span>Employee Number
                                            </label>
                                            <input type="text" value="{{ $teachers->teacher_number }}" name="teacher_number"
                                                placeholder="Input Employee ID.."
                                                id="adviser_teacher_number{{ $teachers->id }}" required
                                                class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                        </div>
                                        <div class="col-span-1 mt-5">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                for="school_year">
                                                <span class="text-red-600 mr-1">*</span>School Year
                                            </label>
                                            <select name="school_year" id="schoolYear" required
                                                class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                                <option value="" disabled selected>Select School Year</option>
                                                <option value="{{ date('Y')}}-{{ date('Y') + 1}}">
                                                    {{ date('Y')}}-{{ date('Y') + 1 }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-span-1 mt-5">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                for="grade">
                                                <span class="text-red-600 mr-1">*</span>Grade
                                            </label>
                                            <select name="grade" id="grade{{ $teachers->id }}" required
                                                class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize"
                                                onchange="getSections(this.value, {{ $teachers->id }})">
                                                <option value="">Select Grade</option>
                                                <option value="Grade One">Grade One</option>
                                                <option value="Grade Two">Grade Two</option>
                                                <option value="Grade Three">Grade Three</option>
                                                <option value="Grade Four">Grade Four</option>
                                                <option value="Grade Five">Grade Five</option>
                                                <option value="Grade Six">Grade Six</option>
                                            </select>
                                        </div>
                                        <div class="col-span-1 mt-5">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                for="section">
                                                <span class="text-red-600 mr-1">*</span>Section
                                            </label>
                                            <select name="section" id="section{{ $teachers->id }}" required
                                                class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                            </select>

                                            <script>
                                                function getSections(grade, id) {
                                                    const sectionSelect = document.getElementById("section" + id);

                                                    fetch(`/api/sections?grade=${grade}`)
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            sectionSelect.innerHTML = '<option value="">Select Section</option>';

                                                            if (data.length) {
                                                                data.forEach(section => {
                                                                    const option = document.createElement("option");
                                                                    option.value = section.section;
                                                                    option.textContent = section.section;
                                                                    sectionSelect.appendChild(option);
                                                                });
                                                            } else {
                                                                const option = document.createElement("option");
                                                                option.value = "";
                                                                option.textContent = "No Sections Available";
                                                                sectionSelect.appendChild(option);
                                                            }
                                                        })
                                                        .catch(error => {
                                                            console.error('Error fetching sections:', error);
                                                            const option = document.createElement("option");
                                                            option.value = "";
                                                            option.textContent = "Error loading sections";
                                                            sectionSelect.appendChild(option);
                                                        });
                                                }
                                            </script>
                                        </div>
                                        <div class="col-span-1 flex justify-end mt-5">
                                            <button type="submit"
                                                class="w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($teacher as $teachers)
                    <div id="addSubjectModal{{ $teachers->id }}"
                        class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll">
                        <div class="relative px-20 py-10 w-screen h-screen flex justify-center items-center">
                            <div
                                class="w-full lg:w-1/2 xl:w-1/3 h-96 xl:h-auto bg-white rounded-lg shadow overflow-y-scroll">
                                <div
                                    class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg sticky top-0">
                                    <h3 class="text-lg font-bold text-teal-800 uppercase"><i
                                            class="fa-solid fa-users mr-2"></i>Add Subject {
                                        {{ old('lastName', $teachers->last_name) }},
                                        {{ old('lastName', $teachers->first_name) }}
                                        {{ old('lastName', $teachers->suffix_name) }}
                                        {{ old('lastName', $teachers->middle_name) }}}
                                    </h3>
                                    <button type="button"
                                        class="text-white bg-teal-700 hover:bg-teal-800 p-3 py-2 rounded-full text-xl font-bold flex items-center justify-center shadow-lg"
                                        aria-label="Close modal" id="closeSubjectModal{{ $teachers->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="mb-5 mt-5 bg-white p-10">
                                    <!-- Add Admin Form -->
                                    <form action="{{ route('teachersubject.create') }}" method="POST"
                                        class="grid grid-cols-1 gap-4">
                                        @csrf
                                        <div class="col-span-1 hidden">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                for="teacher_number">
                                                <span class="text-red-600 mr-1">*</span>Employee Number
                                            </label>
                                            <input type="text" value="{{ $teachers->teacher_number }}" name="teacher_number"
                                                placeholder="Input Employee ID.."
                                                id="subject_teacher_number{{ $teachers->id }}" required readonly
                                                class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                        </div>
                                        <div class="col-span-1 mt-5">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                for="school_year">
                                                <span class="text-red-600 mr-1">*</span>School Year
                                            </label>
                                            <select name="school_year" id="schoolYear" required
                                                class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                                <option value="" disabled selected>Select School Year</option>
                                                <option value="{{ date('Y')}}-{{ date('Y') + 1 }}">
                                                    {{ date('Y')}}-{{ date('Y') + 1 }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-span-1 mt-5">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                for="grade">
                                                <span class="text-red-600 mr-1">*</span>Grade
                                            </label>
                                            <select name="grade" id="subject_grade{{ $teachers->id }}" required
                                                class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize"
                                                onchange="updateOptions(this.value, {{ $teachers->id }})">
                                                <option value="">Select Grade</option>
                                                <option value="Grade One">Grade One</option>
                                                <option value="Grade Two">Grade Two</option>
                                                <option value="Grade Three">Grade Three</option>
                                                <option value="Grade Four">Grade Four</option>
                                                <option value="Grade Five">Grade Five</option>
                                                <option value="Grade Six">Grade Six</option>
                                            </select>
                                        </div>

                                        <div class="col-span-1 mt-5">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                for="section">
                                                <span class="text-red-600 mr-1">*</span>Section
                                            </label>
                                            <select name="section" id="subject_section{{ $teachers->id }}" required
                                                class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                            </select>
                                        </div>

                                        <div class="col-span-1 mt-5">
                                            <label
                                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                                for="subject">
                                                <span class="text-red-600 mr-1">*</span>Subject
                                            </label>
                                            <select name="subject" id="subject{{ $teachers->id }}" required
                                                class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                            </select>
                                        </div>

                                        <script>
                                            // Unified function to handle both section and subject population
                                            function updateOptions(grade, id) {
                                                // Fetch sections and subjects simultaneously based on grade
                                                const sectionSelect = document.getElementById("subject_section" + id);
                                                const subjectSelect = document.getElementById("subject" + id);

                                                // Clear previous options
                                                sectionSelect.innerHTML = '<option value="">Select Section</option>';
                                                subjectSelect.innerHTML = '<option value="">Select Subject</option>';

                                                // Fetch sections
                                                fetch(`/api/allsections?grade=${grade}`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        console.log(data);  // Check the output here
                                                        if (data.length) {
                                                            data.forEach(section => {
                                                                const option = document.createElement("option");
                                                                option.value = section;
                                                                option.textContent = section;
                                                                sectionSelect.appendChild(option);
                                                            });
                                                        } else {
                                                            const option = document.createElement("option");
                                                            option.value = "";
                                                            option.textContent = "No Sections Available";
                                                            sectionSelect.appendChild(option);
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error('Error fetching sections:', error);
                                                        const option = document.createElement("option");
                                                        option.value = "";
                                                        option.textContent = "Error loading sections";
                                                        sectionSelect.appendChild(option);
                                                    });


                                                // Fetch subjects
                                                fetch(`/api/allsubjects?grade=${grade}`)
                                                    .then(response => response.json())
                                                    .then(data => {
                                                        if (data.length) {
                                                            data.forEach(subject => {
                                                                const option = document.createElement("option");
                                                                option.value = subject.subject;
                                                                option.textContent = subject.subject;
                                                                subjectSelect.appendChild(option);
                                                            });
                                                        } else {
                                                            const option = document.createElement("option");
                                                            option.value = "";
                                                            option.textContent = "No Subjects Available";
                                                            subjectSelect.appendChild(option);
                                                        }
                                                    })
                                                    .catch(error => {
                                                        console.error('Error fetching subjects:', error);
                                                        const option = document.createElement("option");
                                                        option.value = "";
                                                        option.textContent = "Error loading subjects";
                                                        subjectSelect.appendChild(option);
                                                    });
                                            }
                                        </script>
                                        <div class="col-span-1 flex justify-end mt-5">
                                            <button type="submit"
                                                class="w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($teacher as $teachers)
                    <div id="updatetudentinfo{{ $teachers->id }}" tabindex="-1" aria-hidden="true"
                        class="hidden fixed top-0 right-0 left-0 z-10 flex justify-center items-center w-screen h-screen bg-black bg-opacity-50 overflow-y-scroll"
                        style="scrollbar-width: none;">
                        <div class="relative px-20 py-10 w-screen h-screen">
                            <div class="w-full h-full bg-white rounded-lg shadow overflow-y-scroll">
                                <div
                                    class="flex items-center justify-between p-5 px-10 shadow-lg border-b bg-gray-200 rounded-lg sticky top-0">
                                    <h3 class="text-lg font-bold text-teal-800 uppercase"><i
                                            class="fa-solid fa-users mr-2"></i>Update
                                        {{ old('lastName', $teachers->last_name) }},
                                        {{ old('lastName', $teachers->first_name) }}
                                        {{ old('lastName', $teachers->suffix_name) }}
                                        {{ old('lastName', $teachers->middle_name) }}
                                        Information
                                    </h3>
                                    <button type="button"
                                        class="text-white bg-teal-700 hover:bg-teal-800 p-3 py-2 rounded-full text-xl font-bold flex items-center justify-center shadow-lg"
                                        aria-label="Close modal" id="updatetudentinfoClose{{ $teachers->id }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger text-red-800 text-md font-normal p-2 mx-auto shadow-lg bg-red-100 transition duration-300 ease-in-out my-5"
                                        role="alert" id="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <script>
                                        setTimeout(function () {
                                            document.getElementById('alert').classList.add('hidden');
                                        }, 3000);
                                    </script>
                                @endif

                                <div class="col-span-2 2xl:col-span-1 p-10 bg-gray-200 flex justify-center items-center">
                                    <div
                                        class="w-48 h-48 text-[50px] rounded-full bg-teal-700 text-white flex items-center justify-center font-bold mx-2 border-4 border-white">
                                        @if ($teachers->avatar)
                                            <img src="{{ asset('storage/' . $teachers->avatar) }}" alt="Student Avatar"
                                                class="w-full h-full rounded-full object-cover">
                                        @else
                                            {{ strtoupper(substr($teachers->last_name, 0, 1) . substr($teachers->first_name, 0, 1)) }}
                                        @endif
                                    </div>
                                </div>

                                <form id="updateStudentForm{{ $teachers->id }}"
                                    action="{{ route('teacher.update', $teachers->id) }}" method="POST"
                                    class="grid grid-cols-4 gap-4 p-10">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-span-1">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="teacher_number">
                                            <span class="text-red-600 mr-1">*</span>Employee Number
                                        </label>
                                        <input type="text" name="teacher_number" placeholder="Input Employee ID.." readonly
                                            id="teacher_number{{ $teachers->id }}" required
                                            value="{{ old('teacher_number', $teachers->teacher_number) }}"
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="position">
                                            <span class="text-red-600 mr-1">*</span>Position
                                        </label>
                                        <select name="position" id="position{{ $teachers->id }}" required
                                            class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                            <option value="">Select Position</option>
                                            @if (old('position', $teachers->position) == "Teacher")
                                                <option value="Teacher" selected>Teacher</option>
                                                <option value="Head">Head</option>
                                            @else
                                                <option value="Teacher">Teacher</option>
                                                <option value="Head" selected>Head</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-span-1 ">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="status">
                                            <span class="text-red-600 mr-1">*</span>Status
                                        </label>
                                        <select name="status" id="status{{ $teachers->id }}" required
                                            class="form-select block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                            <option value="Active" {{ old('status', $teachers->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                            <option value="Inactive" {{ old('status', $teachers->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <div></div>
                                    <div class="col-span-1 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="first_name">
                                            <span class="text-red-600 mr-1">*</span>First Name
                                        </label>
                                        <input type="text" name="first_name"
                                            value="{{ old('first_name', $teachers->first_name) }}"
                                            placeholder="Input First Name.." id="first_name{{ $teachers->id }}" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="middle_name">
                                            <span class="text-red-600 mr-1">*</span>Middle Name
                                        </label>
                                        <input type="text" name="middle_name"
                                            value="{{ old('middle_name', $teachers->middle_name) }}"
                                            placeholder="Input Middle Name.." id="middle_name{{ $teachers->id }}" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="last_name">
                                            <span class="text-red-600 mr-1">*</span>Last Name
                                        </label>
                                        <input type="text" name="last_name"
                                            value="{{ old('last_name', $teachers->last_name) }}" placeholder="Lastname.."
                                            id="last_name{{ $teachers->id }}" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="suffix">
                                            Suffix
                                        </label>
                                        <input type="text" name="suffix" value="{{ old('suffix', $teachers->suffix) }}"
                                            placeholder="Suffix.." id="suffix{{ $teachers->id }}"
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-4 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="address">
                                            <span class="text-red-600 mr-1">*</span>Address
                                        </label>
                                        <input type="text" name="address" value="{{ old('address', $teachers->address) }}"
                                            placeholder="Address.." id="address{{ $teachers->id }}" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-2 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="email">
                                            <span class="text-red-600 mr-1">*</span>Email
                                        </label>
                                        <input type="email" name="email" value="{{ old('email', $teachers->email) }}"
                                            placeholder="Input Email.." id="email{{ $teachers->id }}" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md">
                                    </div>
                                    <div class="col-span-2 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="contact_number">
                                            <span class="text-red-600 mr-1">*</span>Contact Number
                                        </label>
                                        <input type="text" name="contact_number"
                                            value="{{ old('contact_number', $teachers->contact_number) }}"
                                            placeholder="Contact Number.." id="contact_number{{ $teachers->id }}" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1  hidden">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="department">
                                            <span class="text-red-600 mr-1">*</span>Department
                                        </label>
                                        <input type="text" name="department" value="Department" placeholder="Department.."
                                            id="department{{ $teachers->id }}"
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-1 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="gender">
                                            <span class="text-red-600 mr-1">*</span>Gender
                                        </label>
                                        <select name="gender" id="gender{{ $teachers->id }}"
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize"
                                            required>
                                            <option value="" disabled selected>Gender</option>
                                            <option value="Male" {{ old('gender', $teachers->gender) == "Male" ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ old('gender', $teachers->gender) == "Female" ? 'selected' : '' }}>Female</option>
                                        </select>
                                    </div>
                                    <div class="col-span-1 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="birthdate">
                                            <span class="text-red-600 mr-1">*</span>Birthdate
                                        </label>
                                        <input type="date" name="birthdate"
                                            value="{{ old('birthdate', $teachers->birthdate) }}"
                                            id="birthdate{{ $teachers->id }}" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-2 mt-5 {{ $teachers->status == "Inactive" ? "hidden" : "block" }}">
                                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                            for="religion">
                                            <span class="text-red-600 mr-1">*</span>Religion
                                        </label>
                                        <input type="text" name="religion"
                                            value="{{ old('religion', $teachers->religion) }}" placeholder="Religion.."
                                            id="religion{{ $teachers->id }}" required
                                            class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                    </div>
                                    <div class="col-span-4 flex justify-end mt-5">
                                        <button type="submit"
                                            class="w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>



    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
    <script>
        // Get modal and buttons
        const modal = document.getElementById("addTeacherModal");
        const openModalButton = document.getElementById("openModalButton");
        const closeModalButton = document.getElementById("closeModalButton");

        // Open modal
        openModalButton.addEventListener("click", () => {
            modal.classList.remove("hidden");
        });

        // Close modal
        closeModalButton.addEventListener("click", () => {
            modal.classList.add("hidden");
        });

        // Close modal when clicking outside of it
        window.addEventListener("click", (event) => {
            if (event.target === modal) {
                modal.classList.add("hidden");
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const firstNameField = document.getElementById('first_name');
            const lastNameField = document.getElementById('last_name');
            const usernameField = document.getElementById('username');
            const passwordField = document.getElementById('password');

            // Function to generate the username
            function generateUsername() {
                const firstName = firstNameField.value.trim();
                const lastName = lastNameField.value.trim();
                const schoolDomain = '@stemilie.edu.ph';
                if (firstName && lastName) {
                    const username = lastName + firstName + schoolDomain;
                    usernameField.value = username.toLowerCase(); // Ensure the username is in lowercase
                }
            }

            function generatePassword() {
                const firstName = firstNameField.value.trim();
                const lastName = lastNameField.value.trim();
                const employeeId = document.getElementById('teacher_number').value.trim();

                if (firstName && lastName && employeeId.length >= 4) {
                    const last4Digits = employeeId.slice(-4);  // Get the last 4 digits of the employee ID
                    const password = 'SELC' + lastName.charAt(0).toUpperCase() + lastName.slice(1) + last4Digits;
                    passwordField.value = password;
                }
            }

            // Event listeners to update username and password on input change
            firstNameField.addEventListener('input', function () {
                generateUsername();
                generatePassword();
            });

            lastNameField.addEventListener('input', function () {
                generateUsername();
                generatePassword();
            });

            @foreach ($teacher as $teachers)
                const updateModal{{ $teachers->id }} = document.getElementById("updatetudentinfo{{ $teachers->id }}");
                const openUpdateModalButton{{ $teachers->id }} = document.getElementById("openUpdateModal{{ $teachers->id }}");
                const closeUpdateModalButton{{ $teachers->id }} = document.getElementById("updatetudentinfoClose{{ $teachers->id }}");

                // Ensure the elements exist before adding event listeners
                if (openUpdateModalButton{{ $teachers->id }}) {
                    openUpdateModalButton{{ $teachers->id }}.addEventListener("click", () => {
                        if (updateModal{{ $teachers->id }}) {
                            updateModal{{ $teachers->id }}.classList.remove("hidden");
                        }
                    });
                }

                if (closeUpdateModalButton{{ $teachers->id }}) {
                    closeUpdateModalButton{{ $teachers->id }}.addEventListener("click", () => {
                        if (updateModal{{ $teachers->id }}) {
                            updateModal{{ $teachers->id }}.classList.add("hidden");
                        }
                    });
                }

                const addviserModal{{ $teachers->id }} = document.getElementById("addAdviser{{ $teachers->id }}");
                const adviserModal{{ $teachers->id }} = document.getElementById("addAdvisoryModal{{ $teachers->id }}");
                const closeadviserModal{{ $teachers->id }} = document.getElementById("closeAdvisoryModal{{ $teachers->id }}");

                // Open update modal
                if (addviserModal{{ $teachers->id }}) {
                    addviserModal{{ $teachers->id }}.addEventListener("click", () => {
                        if (adviserModal{{ $teachers->id }}) {
                            adviserModal{{ $teachers->id }}.classList.remove("hidden");
                        }
                    });
                }

                if (closeadviserModal{{ $teachers->id }}) {
                    closeadviserModal{{ $teachers->id }}.addEventListener("click", () => {
                        if (adviserModal{{ $teachers->id }}) {
                            adviserModal{{ $teachers->id }}.classList.add("hidden");
                        }
                    });
                }

                const addSubjectModal{{ $teachers->id }} = document.getElementById("adddSubject{{ $teachers->id }}");
                const subjectModal{{ $teachers->id }} = document.getElementById("addSubjectModal{{ $teachers->id }}");
                const closesubjectModal{{ $teachers->id }} = document.getElementById("closeSubjectModal{{ $teachers->id }}");

                // Open update modal
                if (addSubjectModal{{ $teachers->id }}) {
                    addSubjectModal{{ $teachers->id }}.addEventListener("click", () => {
                        if (addSubjectModal{{ $teachers->id }}) {
                            subjectModal{{ $teachers->id }}.classList.remove("hidden");
                        }
                    });
                }

                if (closesubjectModal{{ $teachers->id }}) {
                    closesubjectModal{{ $teachers->id }}.addEventListener("click", () => {
                        if (addSubjectModal{{ $teachers->id }}) {
                            subjectModal{{ $teachers->id }}.classList.add("hidden");
                        }
                    });
                }
            @endforeach
        });
    </script>
</body>

</html>