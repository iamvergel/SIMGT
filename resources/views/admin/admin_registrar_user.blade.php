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
                            onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/admin/student-management'"
                            class="hover:text-teal-700">Management Account</span> / Registrar
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
                            Add Registrar
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
                <div id="addAdminModal"
                    class="absolute inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
                    <div
                        class="absolute bg-gray-100 rounded-lg shadow-lg px-2 overflow-y-scroll xl:overflow-hidden h-[500px] xl:h-auto">
                        <div
                            class="flex justify-between items-center p-2 px-4  py-5 mt-5 px-4 bg-white shadow-lg  sticky top-0">
                            <p class="font-bold text-teal-900">Add Registrar</p>
                            <span id="closeModalButton"
                                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                                    class="fas fa-times fa-lg"></i></span>
                        </div>
                        <div class="mb-5 mt-5 bg-white p-3">
                            <!-- Add Admin Form -->
                            <form action="{{ route('registrar.create') }}" method="POST">
                                @csrf
                                <div class="mb-4 hidden">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="role">
                                        <span class="text-red-600 mr-1">*</span>Role
                                    </label>
                                    <input type="hidden" name="role" placeholder="Role.." value="Registrar" id="role"
                                        required
                                        class="form-input block text-sm text-normal text-dark tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5">
                                </div>
                                <div class="mb-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="registrar_number">
                                        <span class="text-red-600 mr-1">*</span>Employee ID
                                    </label>
                                    <input type="text" name="registrar_number" placeholder="Input Employee ID.."
                                        id="admin_number" required
                                        class="form-input block text-sm text-normal text-dark tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5">
                                </div>
                                <div class="mb-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="first_name">
                                        <span class="text-red-600 mr-1">*</span>First Name
                                    </label>
                                    <input type="text" name="first_name" placeholder="Input First Name.."
                                        id="first_name" required
                                        class="form-input block text-sm text-normal text-dark tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5">
                                </div>
                                <div class="mb-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="middle_name">
                                        <span class="text-red-600 mr-1">*</span>Middle Name
                                    </label>
                                    <input type="text" name="middle_name" placeholder="Input Middle Name.."
                                        id="middle_name" required
                                        class="form-input block text-sm text-normal text-dark tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5">
                                </div>
                                <div class="mb-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="last_name">
                                        <span class="text-red-600 mr-1">*</span>Last Name
                                    </label>
                                    <input type="text" name="last_name" placeholder="Input Last Name.." id="last_name"
                                        required
                                        class="form-input block text-sm text-normal text-dark tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5">
                                </div>
                                <div class="mb-4 hidden">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="username">
                                        <span class="text-red-600 mr-1">*</span>Username
                                    </label>
                                    <input type="email" name="username" placeholder="Input Username.." id="username"
                                        required
                                        class="form-input block text-sm text-normal text-dark tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5">
                                </div>
                                <div class="mb-4 hidden">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="password">
                                        <span class="text-red-600 mr-1">*</span>Password
                                    </label>
                                    <input type="text" name="password" placeholder="Input Password.." id="password"
                                        required
                                        class="form-input block text-sm text-normal text-dark tracking-wider w-full lg:w-96 pl-5 p-3 border border-gray-400 rounded-md px-5">
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="w-1/4 indent-[-2rem] bg-teal-700 text-white rounded-lg hover:bg-teal-800 transition py-2 text-md font-semibold ">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- component -->
                <section class="mx-auto p-6 mt-5 rounded-lg shadow-lg bg-gray-200 ">
                    <div class="w-full bg-white overflow-hidden rounded-lg shadow-lg text-[12px]">
                        @if ($noRegistrar)
                            <p class="text-red-600 text-center text-md">{{ $noRegistrar }}</p>
                        @else
                            <div class="p-5">
                                <table id="studentTable" class="p-3 display responsive nowrap" width="100%">
                                    <thead class="bg-gray-200">
                                        <tr class="text-[14px] font-normal uppercase text-left text-black">
                                            <th class="export">Employee Number</th>
                                            <th class="export">Admission</th>
                                            <th class="">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="" id="tableBody">
                                        @foreach ($admin as $admins)
                                                <tr class=" hover:bg-gray-100">
                                                    <td>
                                                        <span class="ml-2">{{ $admins->registrar_number }}</span>
                                                    </td>
                                                    <td class="flex justify-start items-center">
                                                        <div
                                                            class="w-12 h-12 rounded-full bg-teal-700 text-white flex items-center justify-center font-bold mx-2">
                                                            @if ($admins->avatar)
                                                                <img src="/storage/{{ $admins->avatar }}" alt="{{$admins->avatar }}"
                                                                    class="w-12 h-12 rounded-full object-cover">
                                                            @else
                                                                {{ strtoupper(substr($admins->first_name, 0, 1) . substr($admins->last_name, 0, 1)) }}
                                                            @endif
                                                        </div>
                                                        <div class="">
                                                            <span class="text-sm font-semibold">{{ $admins->last_name }},
                                                                {{ $admins->first_name }} {{ $admins->middle_name }}</span><br />
                                                            <span class="text-xs text-gray-500">{{ $admins->username }}</span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('registrar.delete', $admins->id) }}" method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="text-white font-medium text-lg p-3 text-center inline-flex items-center me-2 bg-red-700 rounded-full hover:bg-red-600"
                                                                title="Delete Admin">
                                                                <i class="fa-solid fa-user-xmark"></i>
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
                </section>
            </div>
        </main>
    </div>



    @include('admin.includes.js-link')
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
    <script>
        // Get modal and buttons
        const modal = document.getElementById("addAdminModal");
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
                const employeeId = document.getElementById('admin_number').value.trim();

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