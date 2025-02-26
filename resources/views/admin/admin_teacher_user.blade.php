@include('admin.includes.header')



<body class="font-poppins bg-gray-200 overflow-hidden">

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')

        <!-- Main Content -->
        <main class="flex-grow rounded-r-lg bg-white shadow-lg overflow-y-scroll w-full bg-zinc-50" id="content">
            <header>
                @include('admin.includes.topnav')
            </header>

            <div class="p-5">
                <div>
                    <p class="text-[15px] font-normal text-teal-900 mt-5 ml-5">Admin</p>
                    <p class="text-2xl font-bold text-teal-900 ml-5">
                        <span
                            onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
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
                            onclick="window.location.href = '/StEmelieLearningCenter.HopeSci66/admin/student-management/AllStudentData'">
                            Show student data
                        </button> -->
                    </div>
                </div>


                @if (session('success'))
                    <script>
                        alert("{{ session('success') }}");
                    </script>
                @endif

                <!-- Modal for Adding Admin -->
                <div id="addTeacherModal"
                    class="absolute inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
                    <div
                        class="absolute bg-gray-100 rounded-lg shadow-lg px-2 overflow-y-scroll xl:overflow-hidden h-[500px] xl:h-auto">
                        <div
                            class="flex justify-between items-center p-2 px-4  py-5 mt-5 px-4 bg-white shadow-lg  sticky top-0">
                            <p class="font-bold text-teal-900">Add Teacher</p>
                            <span id="closeModalButton"
                                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                                    class="fas fa-times fa-lg"></i></span>
                        </div>
                        <div class="mb-5 mt-5 bg-white p-3">
                            <!-- Add Admin Form -->
                            <form action="{{ route('teacher.create') }}" method="POST" class="grid grid-cols-4 gap-4">
                                @csrf
                                <div class="col-span-1">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="teacher_number">
                                        <span class="text-red-600 mr-1">*</span>Employee Number
                                    </label>
                                    <input type="text" name="teacher_number" placeholder="Input Employee ID.."
                                        id="teacher_number" required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-1 ">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
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
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="first_name">
                                        <span class="text-red-600 mr-1">*</span>First Name
                                    </label>
                                    <input type="text" name="first_name" placeholder="Input First Name.."
                                        id="first_name" required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-1 mt-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="middle_name">
                                        <span class="text-red-600 mr-1">*</span>Middle Name
                                    </label>
                                    <input type="text" name="middle_name" placeholder="Input Middle Name.."
                                        id="middle_name" required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-1 mt-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="last_name">
                                        <span class="text-red-600 mr-1">*</span>Last Name
                                    </label>
                                    <input type="text" name="last_name" placeholder="Lastname.." id="last_name" required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-1 mt-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="suffix">
                                        Suffix
                                    </label>
                                    <input type="text" name="suffix" placeholder="Suffix.." id="suffix"
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-4 mt-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="address">
                                        <span class="text-red-600 mr-1">*</span>Address
                                    </label>
                                    <input type="text" name="address" placeholder="Address.." id="address" required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-2 mt-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="email">
                                        <span class="text-red-600 mr-1">*</span>Email
                                    </label>
                                    <input type="email" name="email" placeholder="Input Email.." id="email" required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md">
                                </div>
                                <div class="col-span-2 mt-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="contact_number">
                                        <span class="text-red-600 mr-1">*</span>Contact Number
                                    </label>
                                    <input type="text" name="contact_number" placeholder="Contact Number.."
                                        id="contact_number" required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-1  hidden">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="department">
                                        <span class="text-red-600 mr-1">*</span>Department
                                    </label>
                                    <input type="text" name="department" value="Department" placeholder="Department.."
                                        id="department"
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-1 hidden">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="status">
                                        <span class="text-red-600 mr-1">*</span>Status
                                    </label>
                                    <input type="text" name="status" value="Active" placeholder="Status.." id="status"
                                        required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-1 mt-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
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
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="birthdate">
                                        <span class="text-red-600 mr-1">*</span>Birthdate
                                    </label>
                                    <input type="date" name="birthdate" id="birthdate" required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-2 mt-5">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="religion">
                                        <span class="text-red-600 mr-1">*</span>Religion
                                    </label>
                                    <input type="text" name="religion" placeholder="Religion.." id="religion" required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md capitalize">
                                </div>
                                <div class="col-span-1  hidden">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="username">
                                        <span class="text-red-600 mr-1">*</span>Username
                                    </label>
                                    <input type="email" name="username" placeholder="Input Username.." id="username"
                                        required
                                        class="form-input block w-full text-sm text-normal text-dark tracking-wider p-3 border border-gray-400 rounded-md">
                                </div>
                                <div class="col-span-1  ">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
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

                @if ($errors->any())
                    <div class="alert alert-danger text-red-800 text-md font-normal p-2 mx-auto shadow-lg bg-red-200 transition duration-300 ease-in-out my-5"
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

                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200 ">
                    <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px]">

                        <div class="p-5">
                            <table id="studentTable" class="p-3">
                                <thead class="bg-gray-200">
                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                        <th class="export">Employee Number</th>
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
                                        <tr class=" hover:bg-gray-100">
                                            <td>
                                                <span class="ml-2">{{ $teachers->teacher_number }}</span>
                                            </td>
                                            <!-- <td>
                                                            <span class="ml-2">{{ $teachers->department }}</span>
                                                        </td> -->
                                            <td>
                                                <span class="ml-2">{{ $teachers->position }}</span>
                                            </td>
                                            <td class="flex justify-start items-center w-70">
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
                                            <td>
                                                <span class="ml-2">{{ $teachers->email }}</span>
                                            </td>
                                            <td>
                                                <span class="ml-2">{{ $teachers->contact_number }}</span>
                                            </td>
                                            <td>
                                                <form action="{{ route('send.email', $teachers->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-white font-medium text-xl p-3 text-center inline-flex items-center me-2 bg-cyan-700 rounded-full hover:bg-cyan-600"
                                                        title="Send Email">
                                                        <i class="fa-solid fa-envelope"></i>
                                                    </button>
                                                </form>
                                                <button
                                                    class="text-white font-medium text-xl p-3 text-center inline-flex items-center me-2 bg-blue-700 rounded-full hover:bg-blue-600"
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
        });
    </script>
</body>

</html>