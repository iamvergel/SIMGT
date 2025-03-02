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
                            class="hover:text-teal-700">Management System</span> / Subject
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
                            Add Subject
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

                <!-- Delete Subject Modal -->
                <div id="deleteSubjectModal"
                    class="absolute inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
                    <div
                        class="absolute bg-gray-100 rounded-lg shadow-lg px-2 overflow-y-scroll xl:overflow-hidden h-[200px] xl:h-auto">
                        <div
                            class="flex justify-between items-center p-2 px-4 py-5 mt-5 px-4 bg-white shadow-lg sticky top-0">
                            <p class="font-bold text-teal-900">Delete Subject</p>
                            <span id="closeDeleteModalButton"
                                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right">
                                <i class="fas fa-times fa-lg"></i>
                            </span>
                        </div>
                        <div class="mb-5 mt-5 bg-white p-3">
                            <p>Are you sure you want to delete this subject?</p>

                            <p id="deleteGrade" class="text-center text-2xl font-bold"></p>

                            <form id="deleteSubjectForm" action="" method="POST" class="mt-8 flex justify-end gap-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Yes,
                                    Delete</button>
                                <button type="button" id="cancelDeleteBtn"
                                    class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Subject Modal -->
                <div id="editSubjectModal"
                    class="absolute inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
                    <div
                        class="absolute bg-gray-100 rounded-lg shadow-lg px-2 overflow-y-scroll xl:overflow-hidden h-[500px] xl:h-auto">
                        <div
                            class="flex justify-between items-center p-2 px-4 py-5 mt-5 px-4 bg-white shadow-lg sticky top-0">
                            <p class="font-bold text-teal-900">Edit Subject</p>
                            <span id="closeEditModalButton"
                                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right">
                                <i class="fas fa-times fa-lg"></i>
                            </span>
                        </div>
                        <div class="mb-5 mt-5 bg-white p-3">

                            <form action="" id="editSubjectForm" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grade">
                                        <span class="text-red-600 mr-1">*</span>Select Grade
                                    </label>
                                    <select name="grade" id="editGrade"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Select Grade</option>
                                        <option value="Grade One">Grade One</option>
                                        <option value="Grade Two">Grade Two</option>
                                        <option value="Grade Three">Grade Three</option>
                                        <option value="Grade Four">Grade Four</option>
                                        <option value="Grade Five">Grade Five</option>
                                        <option value="Grade Six">Grade Six</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="section">
                                        <span class="text-red-600 mr-1">*</span>Section
                                    </label>
                                    <input type="text" name="subject" placeholder="Input Section Name.."
                                        id="editSubject" required
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

                <!-- Modal for Adding Admin -->
                <div id="addAdminModal"
                    class="absolute inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-[20]">
                    <div
                        class="absolute bg-gray-100 rounded-lg shadow-lg px-2 overflow-y-scroll xl:overflow-hidden h-[500px] xl:h-auto">
                        <div
                            class="flex justify-between items-center p-2 px-4  py-5 mt-5 px-4 bg-white shadow-lg  sticky top-0">
                            <p class="font-bold text-teal-900">Add Subject</p>
                            <span id="closeModalButton"
                                class="py-1 px-2 text-[12px] bg-teal-700 hover:bg-teal-800 font-semibold text-white rounded-full float-right"><i
                                    class="fas fa-times fa-lg"></i></span>
                        </div>
                        <div class="mb-5 mt-5 bg-white p-3">
                            <!-- Add Admin Form -->
                            <form action="{{ route('subject.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="grade">
                                        <span class="text-red-600 mr-1">*</span>Select Grade
                                    </label>
                                    <select id="grade" name="grade"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="">Select Grade</option>
                                        <option value="Grade One">Grade One</option>
                                        <option value="Grade Two">Grade Two</option>
                                        <option value="Grade Three">Grade Three</option>
                                        <option value="Grade Four">Grade Four</option>
                                        <option value="Grade Five">Grade Five</option>
                                        <option value="Grade Six">Grade Six</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                        for="section">
                                        <span class="text-red-600 mr-1">*</span>Section
                                    </label>
                                    <input type="text" name="subject" placeholder="Input Section Name.." id="section"
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
                        <div class="p-5">
                            <table id="studentTable" class="p-3">
                                <thead class="bg-gray-200">
                                    <tr class="text-[14px] font-normal uppercase text-left text-black">
                                        <th class="export">Id</th>
                                        <th class="export">Grade</th>
                                        <th class="export">Subject</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="" id="tableBody">
                                    @foreach ($subjects as $subject)
                                        <!-- Add a condition to highlight the logged-in admin -->
                                        <tr class="hover:bg-gray-100">
                                            <td>
                                                <span class="ml-2">{{ $subject->id }}</span>
                                            </td>
                                            <td>
                                                <span class="ml-2">{{ $subject->grade }}</span>
                                            </td>
                                            <td>
                                                <span class="ml-2">{{ $subject->subject }}</span>
                                            </td>
                                            <td>
                                                <button data-id="{{ $subject->id }}" data-grade="{{ $subject->grade }}"
                                                    data-subject="{{ $subject->subject }}"
                                                    class="edit-btn text-white font-medium text-xl p-3 text-center inline-flex items-center me-2 bg-teal-700 rounded-full hover:bg-teal-600"
                                                    type="button" aria-label="Update Student" title="Update Subject">
                                                    <i class="fa-solid fa-square-pen"></i>
                                                </button>
                                                <button type="button" data-id="{{ $subject->id }}"
                                                    data-subject="{{ $subject->subject }}"
                                                    class="delete-btn text-white font-medium text-lg p-3 text-center inline-flex items-center me-2 bg-red-700 rounded-full hover:bg-red-600"
                                                    title="Delete Subject">
                                                    <i class="fa-solid fa-trash"></i>
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

            // Function to generate the password
            function generatePassword() {
                const firstName = firstNameField.value.trim();
                const lastName = lastNameField.value.trim();
                const currentYear = new Date().getFullYear();
                if (firstName && lastName) {
                    const password = 'SELC' + lastName.charAt(0).toUpperCase() + lastName.slice(1) + currentYear;
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

        // Edit Subject Modal
        const editModal = document.getElementById('editSubjectModal');
        const closeEditModalButton = document.getElementById('closeEditModalButton');
        const editSubjectForm = document.getElementById('editSubjectForm');

        // Delete Subject Modal
        const deleteModal = document.getElementById('deleteSubjectModal');
        const closeDeleteModalButton = document.getElementById('closeDeleteModalButton');
        const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
        const deleteSubjectForm = document.getElementById('deleteSubjectForm');

        // Show Edit Modal and fill the form with subject data
        function showEditModal(subjectId, grade, subject) {
            // Set the form action to the correct route
            editSubjectForm.action = `/admin/subject/${subjectId}`;
            document.getElementById('editGrade').value = grade;
            document.getElementById('editSubject').value = subject;

            // Show the modal
            editModal.classList.remove('hidden');
        }

        // Show Delete Modal and set the form action
        function showDeleteModal(subjectId, subject) {
            deleteSubjectForm.action = `/admin/subject/${subjectId}`;

            document.getElementById('deleteGrade').innerHTML = subject;
            // Show the modal
            deleteModal.classList.remove('hidden');
        }

        // Close Edit Modal
        closeEditModalButton.addEventListener('click', function () {
            editModal.classList.add('hidden');
        });

        // Close Delete Modal
        closeDeleteModalButton.addEventListener('click', function () {
            deleteModal.classList.add('hidden');
        });

        // Cancel Delete Action
        cancelDeleteBtn.addEventListener('click', function () {
            deleteModal.classList.add('hidden');
        });

        // Add Event Listeners to Edit and Delete buttons
        document.querySelectorAll('.edit-btn').forEach((button) => {
            button.addEventListener('click', function () {
                const subjectId = this.dataset.id;
                const grade = this.dataset.grade;
                const subject = this.dataset.subject;
                showEditModal(subjectId, grade, subject);
            });
        });

        document.querySelectorAll('.delete-btn').forEach((button) => {
            button.addEventListener('click', function () {
                const subjectId = this.dataset.id;
                const subject = this.dataset.subject;
                showDeleteModal(subjectId, subject);
            });
        });
    </script>
    <script src="{{ asset('../js/admin/mgtgradeone.js') }}" type="text/javascript"></script>
</body>

</html>