@php
    $firstName = session('registrar_fname', 'Guest');
    $lastName = session('registrar_lname', '');
    $middleName = session('registrar_mname', '');
    $suffixName = session('registrar_suffix_name', '');
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));

    $user = Auth::guard('registrar')->user();
    $avatarPath = $user && $user->avatar ? asset('storage/' . $user->avatar) : null;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #sidebar::-webkit-scrollbar {
            width: 2px;
            transition: width 0.3s;
        }

        #sidebar::-webkit-scrollbar-thumb {
            background-color: #4b8b8a;
            border-radius: 50px;
            transition: background-color 0.2s;
        }

        #sidebar::-webkit-scrollbar-track {
            background: #2d7a7a;
        }

        #sidebar {
            scrollbar-width: thin;
            scrollbar-color: #4b8b8a #2d7a7a;
            overflow-x: hidden;
        }

        #sidebar:hover {
            scrollbar-color: #55a3a2 #2d7a7a;
        }

        .sidebar-text {
            transition: all 0.3s;
            font-weight: 400;
        }

        p,
        img,
        i,
        #collapse1 {
            transition: all 0.3s;
        }

        .collapsed .sidebar-text {
            visibility: hidden;
            font-size: 0px;
        }

        .collapsed p {
            visibility: hidden;
            font-size: 0px;
        }

        .collapsed h1 {
            visibility: hidden;
            font-size: 0;
        }

        .collapsed i {
            text-indent: -0.2rem;
        }

        button {
            padding: 0.8rem 0;
            padding-left: 2rem;
            font-weight: 400;
            letter-spacing: 1px;
            font-size: 12px;
        }

        a {
            padding: 0.8rem 0;
            padding-left: 2rem;
            font-weight: 400;
            letter-spacing: 1px;
            font-size: 12px;
        }

        .active {
            background-color: #0f766e;
            /* border: solid 1px rgba(255, 255, 255, 0.3); */
        }

        .collapse-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .collapse-content.show {
            max-height: 500px;
            transition: max-height 0.3s ease-out;
        }

        .fa-chevron-right {
            transition: transform 0.3s;
        }

        .fa-chevron-down {
            transform: rotate(0deg);
            transition: transform 1s;
        }

        .tooltip {
            position: relative;
        }

        .tooltiptext {
            visibility: hidden;
            text-align: center;
            border-radius: 5px;
            position: absolute;
            z-index: 1;
            bottom: 110%;
            left: 0;
            transition: all 0.3s ease;
        }

        .tooltip:hover .tooltiptext {
            visibility: hidden;
            opacity: 1;
        }
    </style>
</head>

<body>

    @include('admin.includes.page_loader')
    <!-- Sidebar -->
    <nav id="sidebar"
        class="bg-teal-800 text-teal-50 h-full max-w-80 w-80 transition-all duration-300 ease-in-out overflow-y-auto">
        <div class="flex justify-start items-center text-center">
            <img class="rounded-full logo border-2 mt-5 ml-3 border-teal-700"
                src="{{ asset('assets/images/SELC.png') }}" alt="logo" width="40" id="logo">
            <p class="mt-5 ml-1 font-semibold text-[14px] tracking-wider">St. Emilie Learning Center</p>
        </div>

        <div class="flex items-center justify-center max-h-1/4 p-4 mt-10">
            <div class="flex flex-col items-center justify-center h-full p-4 bg-teal-700 rounded-xl w-56 shadow-lg"
                id="account">
                <div class="mt-5 w-20 h-20 border-4 border-white bg-teal-600 rounded-full flex items-center justify-center text-white text-4xl font-semibold transition-all duration-300 shadow-lg"
                    id="profile">
                    @if ($avatarPath !== null)
                        <img id="avatar-img2" src="{{ $avatarPath }}" alt="{{ $firstName }}'s Profile Picture"
                            class="rounded-full w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center w-full h-full bg-teal-600  rounded-full">
                            <span class="text-white">{{ $initials }}</span>
                        </div>
                    @endif
                </div>
                <p class="text-[12px] tracking-widest font-semibold text-emerald-50 shadow-text-lg mt-2">
                    {{ session('registrar_username') ?? 'Guest' }}

                </p>
                <p class="text-[10px] tracking-widest font-normal text-teal-100 shadow-text-lg mt-0">
                    {{ session('registrar_number') ?? 'Guest' }}
                </p>
                <p class="text-[10px] text-emerald-50 mt-1">{{ session('registrar_role') ?? 'Guest' }}</p>
            </div>
        </div>

        <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

        <div class="mt-10 mx-1">
            <p class="text-[14px] mt-10 ml-7 text-white font-normal uppercase tracking-wider">
                REGISTRAR DASHBOARD
            </p>
            <!-- <a href="/admin/dashboard"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip"
                id="dashboardLink">
                <i class="fa-solid fa-table-columns"></i>
                <span class="sidebar-text ml-2">Dashboard</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a> -->
            <button
                class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip"
                id="studentManagementButton6" aria-expanded="false" aria-controls="dashboard" title="Dashboard">
                <i class="fa-solid fa-table-columns"><span class="sidebar-text ml-2">Dashboard</span></i>
                <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
            </button>
            <div class="collapse-content bg-teal-800 rounded-lg mx-5 mt-1 px-2" id="dashboard">
                <a href="/registrar/dashboard"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip"
                    title="Dashbaord">
                    <i class="fa-solid fa-table-columns"></i>
                    <span class="sidebar-text ml-2">Dashboard</span>

                </a>
            </div>

            <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

            <p class="text-[14px] mt-5 ml-7 text-white font-normal uppercase tracking-wider">
                STUDENT MANAGEMENT
            </p>

            <button class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2"
                id="studentManagementButton7" aria-expanded="false" aria-controls="studentmanagement" title="Students">
                <i class="fa-solid fa-users"><span class="sidebar-text ml-2">Students</span></i>
                <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
            </button>
            <div class="collapse-content bg-teal-800 rounded-lg mx-5 mt-1 px-2" id="studentmanagement">
                <a href="/registrar/student-management/GradeOne"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2"
                    title="Grade One">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade One</span>
                </a>
                <a href="/registrar/student-management/GradeTwo"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                    title="Grade Two">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Two</span>
                </a>
                <a href="/registrar/student-management/GradeThree"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                    title="Grade Three">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Three</span>
                </a>
                <a href="/registrar/student-management/GradeFour"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                    title="Grade Four">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Four</span>
                </a>
                <a href="/registrar/student-management/GradeFive"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                    title="Grade Five">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Five</span>
                </a>
                <a href="/registrar/student-management/GradeSix"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                    title="Grade Six">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Six</span>
                </a>
            </div>

            <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

                <p class="text-[14px] mt-5 ml-7 text-white font-normal uppercase tracking-wider">
                    GRADE BOOK
                </p>

                <button class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2"
                    id="studentManagementButton8" aria-expanded="false" aria-controls="gradebook" title="Grade Book">
                    <i class="fa-solid fa-book"><span class="sidebar-text ml-2">Grade Book</span></i>
                    <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                </button>
                <div class="collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0" id="gradebook">
                    <button
                        class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip"
                        id="studentManagementButton15" aria-expanded="false" aria-controls="teachersList" title="Grade One">
                        <i class="fa-solid fa-book"><span class="sidebar-text ml-2">Grade One</span></i>
                        <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                    </button>

                    <div class="collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0" id="teachersList">
                        <!-- The list of teachers will be inserted here dynamically -->
                    </div>

                    <button
                        class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip"
                        id="studentManagementButton16" aria-expanded="false" aria-controls="teachersListTwo"
                        title="Grade Two">
                        <i class="fa-solid fa-book"><span class="sidebar-text ml-2">Grade Two</span></i>
                        <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                    </button>

                    <div class="collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0" id="teachersListTwo">
                        <!-- The list of teachers will be inserted here dynamically -->
                    </div>

                    <button
                        class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip"
                        id="studentManagementButton17" aria-expanded="false" aria-controls="teachersListThree"
                        title="Grade Three">
                        <i class="fa-solid fa-book"><span class="sidebar-text ml-2">Grade Three</span></i>
                        <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                    </button>

                    <div class="collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0" id="teachersListThree">
                        <!-- The list of teachers will be inserted here dynamically -->
                    </div>

                    <button
                        class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip"
                        id="studentManagementButton18" aria-expanded="false" aria-controls="teachersListFour"
                        title="Grade Four">
                        <i class="fa-solid fa-book"><span class="sidebar-text ml-2">Grade Four</span></i>
                        <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                    </button>

                    <div class="collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0" id="teachersListFour">
                        <!-- The list of teachers will be inserted here dynamically -->
                    </div>

                    <button
                        class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip"
                        id="studentManagementButton19" aria-expanded="false" aria-controls="teachersListFive"
                        title="Grade Five">
                        <i class="fa-solid fa-book"><span class="sidebar-text ml-2">Grade Five</span></i>
                        <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                    </button>

                    <div class="collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0" id="teachersListFive">
                        <!-- The list of teachers will be inserted here dynamically -->
                    </div>

                    <button
                        class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip"
                        id="studentManagementButton20" aria-expanded="false" aria-controls="teachersListSix"
                        title="Grade Six">
                        <i class="fa-solid fa-book"><span class="sidebar-text ml-2">Grade Six</span></i>
                        <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                    </button>

                    <div class="collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0" id="teachersListSix">
                        <!-- The list of teachers will be inserted here dynamically -->
                    </div>
                </div>

            <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

            <p class="text-[14px] mt-10 ml-7 text-white font-normal uppercase tracking-wider">REPORT SECTION</p>
            <button class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2"
                id="studentManagementButton3" aria-expanded="false" aria-controls="reportsection"
                title="Report Section">
                <i class="fa-solid fa-file"><span class="sidebar-text ml-2">Report Section</span></i>
                <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
            </button>
            <div class="collapse-content bg-teal-800 rounded-lg mx-5 mt-1 px-2" id="reportsection">
                <a href="/registrar/online-application"
                    class="flex justify-start pl-5 items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2"
                    title="Online Application">
                    <i class="fa-solid fa-folder-open"></i>
                    <span class="sidebar-text ml-2">Online Application</span>
                </a>
                <a href="/registrar/student-registration"
                    class="flex justify-start pl-5 items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2"
                    title="Student Registration">
                    <i class="fa-solid fa-folder-open"></i>
                    <span class="sidebar-text ml-2">Student Registration</span>
                </a>
                <a href="/registrar/Report-Section/Graduate-Student"
                    class="flex justify-start pl-5 items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                    title="Graduate Student">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span class="sidebar-text ml-2">Graduate Student</span>
                </a>
                <a href="/registrar/Report-Section/Drop-Student"
                    class="flex justify-start pl-5 items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                    title="Drop Student">
                    <i class="fa-solid fa-user-xmark"></i>
                    <span class="sidebar-text ml-2">Drop Student</span>
                </a>
                <a href="/registrar/Report-Section/Transfer-Student"
                    class="flex justify-start pl-5 items-center sidebar-link hover:bg-teal-700 rounded-md mb-5 ml-0"
                    title="Transfer Student">
                    <i class="fa-solid fa-box-archive"></i>
                    <span class="sidebar-text ml-2">Transfer Student</span>
                </a>
            </div>

            <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

                <p class="text-[14px] mt-10 ml-7 text-white font-normal uppercase tracking-wider">MANAGE ACCOUNT</p>
                <button class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2"
                    id="studentManagementButton4" aria-expanded="false" aria-controls="manageaccount"
                    title="Manage Account">
                    <i class="fa-solid fa-users-gear"><span class="sidebar-text ml-2">Manage Account</span></i>
                    <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                </button>
                <div class="collapse-content bg-teal-800 rounded-lg mx-5 mt-1 px-2" id="manageaccount">
                    <a href="/registrar/manage-accounts/teacher-users"
                        class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                        title="Teachers">
                        <i class="fa-solid fa-user"></i>
                        <span class="sidebar-text ml-2">Teachers</span>
                    </a>
                </div>

                <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

                <p class="text-[14px] mt-10 ml-7 text-white font-normal uppercase tracking-wider">MANAGE SYSTEM
                </p>
                <button class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2"
                    id="studentManagementButton4" aria-expanded="false" aria-controls="managesystem" title="Manage System">
                    <i class="fa-solid fa-globe"><span class="sidebar-text ml-2">Manage System</span></i>
                    <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                </button>
                <div class="collapse-content bg-teal-800 rounded-lg mx-5 mt-1 px-2" id="managesystem">
                    <a href="/registrar/manage-system/section"
                        class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                        title="Section">
                        <i class="fa-regular fa-circle"></i>
                        <span class="sidebar-text ml-2">Section</span>
                    </a>
                    <a href="/registrar/manage-system/subject"
                        class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                        title="Subject">
                        <i class="fa-regular fa-circle"></i>
                        <span class="sidebar-text ml-2">Subject</span>
                    </a>
                </div>


            <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

            <br /><br />


            <form id="logoutForm1" action="{{ route('logout') }}" method="POST" class="inline hidden">
                @csrf
                <a href="#"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip"
                    id="dashboardLink"
                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span class="sidebar-text ml-2">Signout</span>
                    <span
                        class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Signout</span>
                </a>
            </form>
        </div>

        <footer class="relative h-28 mt-[8rem] px-5">
            <img src="{{ asset('../assets/images/grouplogo.png') }}" alt="grouplogo" width="200"
                class="opacity-25 absolute bottom-[-2.5rem] left-[-0.1rem]">
            <p class="text-[10px] absolute bottom-0 mb-1">@ Copyright &copy; {{ date('Y') }} St Emelie Learning Center
                HopeSci66.
                All Rights Reserved</p>
        </footer>
    </nav>

    <script>
        // Check if the user is logged in
        const adminUsername = "{{ session('registrar_fname') }}"; // Get the admin username from the session

        // If the admin username is not set, perform logout
        if (!adminUsername) {
            alert('Too many session');
            document.getElementById('logoutForm1').submit(); // Automatically log out
        }

        // Existing code...
        document.querySelectorAll('#sidebar a').forEach(item => {
            item.addEventListener('click', function () {
                // Remove active class from all items
                document.querySelectorAll('#sidebar a').forEach(i => i.classList.remove('active'));
                this.classList.add('active'); // Add active class to the clicked item

                // Collapse any opened submenu
                document.querySelectorAll('.collapse-content').forEach(collapse => {
                    collapse.classList.remove('show'); // Hide all submenus
                });
            });
        });

        // Highlight the current path on load
        const currentPath = window.location.pathname;
        document.querySelectorAll('#sidebar a').forEach(item => {
            if (item.getAttribute('href') === currentPath) {
                item.classList.add('active'); // Add active class to the current path
            }
        });

        // Fetch teachers and their subjects
        function fetchTeachers() {
            const grade = 'Grade One';
            const currentYear = new Date().getFullYear();
            const schoolYear = `${currentYear}-${currentYear + 1}`;  // Construct school year

            $.ajax({
                url: `/api/teachers-and-subjects?grade=${grade}&school_year=${schoolYear}`,
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
                success: function (data) {
                    const teachersDiv = $('#teachersList');
                    teachersDiv.empty();

                    if (data.length > 0) {
                        data.forEach(function (teacher) {
                            const currentUrl = window.location.pathname;

                            // Create the button element with updated structure
                            const teacherButton = $('<button>', {
                                class: `flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip ${currentUrl.includes(teacher.name.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                id: `studentManagementButton${teacher.teacher_number}`,
                                'aria-expanded': 'false',  // Initially collapsed
                                'aria-controls': `teachersList${teacher.teacher_number}`,
                                title: teacher.name,
                            });

                            const icon = $('<i>', { class: 'fa-solid fa-chalkboard-teacher' });
                            const teacherText = $('<span>', { class: 'sidebar-text ml-0' }).html(`${teacher.name}`);
                            const chevronIcon = $('<p>', { html: `<i class="fa-solid fa-chevron-right text-[8px] me-5"></i>` });

                            teacherButton.append(icon, teacherText, chevronIcon);

                            // Create the collapse content (dropdown) div
                            const teacherDropdown = $('<div>', {
                                class: 'collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0 hidden', // hidden by default
                                id: `teachersList${teacher.teacher_number}`,
                                style: 'max-height: 1000px; overflow-y: auto;', // Set a fixed height and add a scrollbar if needed
                            });

                            // Add teacher's subjects to the dropdown as clickable links
                            if (teacher.subjects.length > 0) {
                                teacher.subjects.forEach(function (subject) {
                                    const currentUrl = window.location.pathname;

                                    // Create the subject link with the updated URL
                                    const subjectLink = $('<a>', {
                                        href: `/admin/Grade-book/class-record/GradeOne/${teacher.teacher_number}/${subject.subject}`,  // Updated link format
                                        class: `flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip ${currentUrl.includes(subject.subject.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                        title: `${subject.subject} - ${subject.grade} ${subject.section}`,
                                    });

                                    // Create the subject text inside the link
                                    const subjectText = $('<span>', { class: 'sidebar-text' }).html(`${subject.subject}<br>${subject.grade} | ${subject.section}`);
                                    subjectLink.append(subjectText);

                                    // Append the subject link to the teacher's dropdown
                                    teacherDropdown.append(subjectLink);
                                });
                            } else {
                                teacherDropdown.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No subjects found for this teacher.</p>');
                            }

                            teachersDiv.append(teacherButton);
                            teachersDiv.append(teacherDropdown);

                            // Toggle dropdown visibility on button click
                            teacherButton.on('click', function () {
                                const isVisible = teacherDropdown.hasClass('hidden');
                                teacherDropdown.toggleClass('hidden', !isVisible); // Show/hide dropdown
                                teacherButton.attr('aria-expanded', isVisible);  // Update aria-expanded based on visibility
                            });
                        });
                    } else {
                        teachersDiv.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No teachers found for Grade One.</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching teachers and subjects:', error);
                    $('#teachersList').html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">An error occurred while fetching teachers.</p>');
                }
            });
        }

        function fetchTeachersTwo() {
            const grade = 'Grade Two';
            const currentYear = new Date().getFullYear();
            const schoolYear = `${currentYear}-${currentYear + 1}`;  // Construct school year

            $.ajax({
                url: `/api/teachers-and-subjects?grade=${grade}&school_year=${schoolYear}`,
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
                success: function (data) {
                    const teachersDiv = $('#teachersListTwo');
                    teachersDiv.empty();

                    if (data.length > 0) {
                        data.forEach(function (teacher) {
                            const currentUrl = window.location.pathname;

                            // Create the button element with updated structure
                            const teacherButton = $('<button>', {
                                class: `flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip ${currentUrl.includes(teacher.name.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                id: `studentManagementButton${teacher.teacher_number}`,
                                'aria-expanded': 'false',  // Initially collapsed
                                'aria-controls': `teachersList${teacher.teacher_number}`,
                                title: teacher.name,
                            });

                            const icon = $('<i>', { class: 'fa-solid fa-chalkboard-teacher' });
                            const teacherText = $('<span>', { class: 'sidebar-text ml-0' }).html(`${teacher.name}`);
                            const chevronIcon = $('<p>', { html: `<i class="fa-solid fa-chevron-right text-[8px] me-5"></i>` });

                            teacherButton.append(icon, teacherText, chevronIcon);

                            // Create the collapse content (dropdown) div
                            const teacherDropdown = $('<div>', {
                                class: 'collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0 hidden', // hidden by default
                                id: `teachersList${teacher.teacher_number}`,
                                style: 'max-height: 1000px; overflow-y: auto;', // Set a fixed height and add a scrollbar if needed
                            });

                            // Add teacher's subjects to the dropdown as clickable links
                            if (teacher.subjects.length > 0) {
                                teacher.subjects.forEach(function (subject) {
                                    const currentUrl = window.location.pathname;

                                    // Create the subject link with the updated URL
                                    const subjectLink = $('<a>', {
                                        href: `/admin/Grade-book/class-record/GradeTwo/${teacher.teacher_number}/${subject.subject}`,  // Updated link format
                                        class: `flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip ${currentUrl.includes(subject.subject.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                        title: `${subject.subject} - ${subject.grade} ${subject.section}`,
                                    });

                                    // Create the subject text inside the link
                                    const subjectText = $('<span>', { class: 'sidebar-text' }).html(`${subject.subject}<br>${subject.grade} | ${subject.section}`);
                                    subjectLink.append(subjectText);

                                    // Append the subject link to the teacher's dropdown
                                    teacherDropdown.append(subjectLink);
                                });
                            } else {
                                teacherDropdown.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No subjects found for this teacher.</p>');
                            }

                            teachersDiv.append(teacherButton);
                            teachersDiv.append(teacherDropdown);

                            // Toggle dropdown visibility on button click
                            teacherButton.on('click', function () {
                                const isVisible = teacherDropdown.hasClass('hidden');
                                teacherDropdown.toggleClass('hidden', !isVisible); // Show/hide dropdown
                                teacherButton.attr('aria-expanded', isVisible);  // Update aria-expanded based on visibility
                            });
                        });
                    } else {
                        teachersDiv.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No teachers found for Grade Two.</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching teachers and subjects:', error);
                    $('#teachersList').html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">An error occurred while fetching teachers.</p>');
                }
            });
        }

        function fetchTeachersThree() {
            const grade = 'Grade Three';
            const currentYear = new Date().getFullYear();
            const schoolYear = `${currentYear}-${currentYear + 1}`;  // Construct school year

            $.ajax({
                url: `/api/teachers-and-subjects?grade=${grade}&school_year=${schoolYear}`,
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
                success: function (data) {
                    const teachersDiv = $('#teachersListThree');
                    teachersDiv.empty();

                    if (data.length > 0) {
                        data.forEach(function (teacher) {
                            const currentUrl = window.location.pathname;

                            // Create the button element with updated structure
                            const teacherButton = $('<button>', {
                                class: `flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip ${currentUrl.includes(teacher.name.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                id: `studentManagementButton${teacher.teacher_number}`,
                                'aria-expanded': 'false',  // Initially collapsed
                                'aria-controls': `teachersList${teacher.teacher_number}`,
                                title: teacher.name,
                            });

                            const icon = $('<i>', { class: 'fa-solid fa-chalkboard-teacher' });
                            const teacherText = $('<span>', { class: 'sidebar-text ml-0' }).html(`${teacher.name}`);
                            const chevronIcon = $('<p>', { html: `<i class="fa-solid fa-chevron-right text-[8px] me-5"></i>` });

                            teacherButton.append(icon, teacherText, chevronIcon);

                            // Create the collapse content (dropdown) div
                            const teacherDropdown = $('<div>', {
                                class: 'collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0 hidden', // hidden by default
                                id: `teachersList${teacher.teacher_number}`,
                                style: 'max-height: 1000px; overflow-y: auto;', // Set a fixed height and add a scrollbar if needed
                            });

                            // Add teacher's subjects to the dropdown as clickable links
                            if (teacher.subjects.length > 0) {
                                teacher.subjects.forEach(function (subject) {
                                    const currentUrl = window.location.pathname;

                                    // Create the subject link with the updated URL
                                    const subjectLink = $('<a>', {
                                        href: `/admin/Grade-book/class-record/GradeThree/${teacher.teacher_number}/${subject.subject}`,  // Updated link format
                                        class: `flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip ${currentUrl.includes(subject.subject.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                        title: `${subject.subject} - ${subject.grade} ${subject.section}`,
                                    });

                                    // Create the subject text inside the link
                                    const subjectText = $('<span>', { class: 'sidebar-text' }).html(`${subject.subject}<br>${subject.grade} | ${subject.section}`);
                                    subjectLink.append(subjectText);

                                    // Append the subject link to the teacher's dropdown
                                    teacherDropdown.append(subjectLink);
                                });
                            } else {
                                teacherDropdown.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No subjects found for this teacher.</p>');
                            }

                            teachersDiv.append(teacherButton);
                            teachersDiv.append(teacherDropdown);

                            // Toggle dropdown visibility on button click
                            teacherButton.on('click', function () {
                                const isVisible = teacherDropdown.hasClass('hidden');
                                teacherDropdown.toggleClass('hidden', !isVisible); // Show/hide dropdown
                                teacherButton.attr('aria-expanded', isVisible);  // Update aria-expanded based on visibility
                            });
                        });
                    } else {
                        teachersDiv.html('<p class="text-[11px] mt-2 rounded-lg text-center bg-teal-700 p-2">No teachers found for Grade Three.</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching teachers and subjects:', error);
                    $('#teachersList').html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">An error occurred while fetching teachers.</p>');
                }
            });
        }

        function fetchTeachersFour() {
            const grade = 'Grade Four';
            const currentYear = new Date().getFullYear();
            const schoolYear = `${currentYear}-${currentYear + 1}`;  // Construct school year

            $.ajax({
                url: `/api/teachers-and-subjects?grade=${grade}&school_year=${schoolYear}`,
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
                success: function (data) {
                    const teachersDiv = $('#teachersListFour');
                    teachersDiv.empty();

                    if (data.length > 0) {
                        data.forEach(function (teacher) {
                            const currentUrl = window.location.pathname;

                            // Create the button element with updated structure
                            const teacherButton = $('<button>', {
                                class: `flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip ${currentUrl.includes(teacher.name.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                id: `studentManagementButton${teacher.teacher_number}`,
                                'aria-expanded': 'false',  // Initially collapsed
                                'aria-controls': `teachersList${teacher.teacher_number}`,
                                title: teacher.name,
                            });

                            const icon = $('<i>', { class: 'fa-solid fa-chalkboard-teacher' });
                            const teacherText = $('<span>', { class: 'sidebar-text ml-0' }).html(`${teacher.name}`);
                            const chevronIcon = $('<p>', { html: `<i class="fa-solid fa-chevron-right text-[8px] me-5"></i>` });

                            teacherButton.append(icon, teacherText, chevronIcon);

                            // Create the collapse content (dropdown) div
                            const teacherDropdown = $('<div>', {
                                class: 'collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0 hidden', // hidden by default
                                id: `teachersList${teacher.teacher_number}`,
                                style: 'max-height: 1000px; overflow-y: auto;', // Set a fixed height and add a scrollbar if needed
                            });

                            // Add teacher's subjects to the dropdown as clickable links
                            if (teacher.subjects.length > 0) {
                                teacher.subjects.forEach(function (subject) {
                                    const currentUrl = window.location.pathname;

                                    // Create the subject link with the updated URL
                                    const subjectLink = $('<a>', {
                                        href: `/admin/Grade-book/class-record/GradeFour/${teacher.teacher_number}/${subject.subject}`,  // Updated link format
                                        class: `flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip ${currentUrl.includes(subject.subject.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                        title: `${subject.subject} - ${subject.grade} ${subject.section}`,
                                    });

                                    // Create the subject text inside the link
                                    const subjectText = $('<span>', { class: 'sidebar-text' }).html(`${subject.subject}<br>${subject.grade} | ${subject.section}`);
                                    subjectLink.append(subjectText);

                                    // Append the subject link to the teacher's dropdown
                                    teacherDropdown.append(subjectLink);
                                });
                            } else {
                                teacherDropdown.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No subjects found for this teacher.</p>');
                            }

                            teachersDiv.append(teacherButton);
                            teachersDiv.append(teacherDropdown);

                            // Toggle dropdown visibility on button click
                            teacherButton.on('click', function () {
                                const isVisible = teacherDropdown.hasClass('hidden');
                                teacherDropdown.toggleClass('hidden', !isVisible); // Show/hide dropdown
                                teacherButton.attr('aria-expanded', isVisible);  // Update aria-expanded based on visibility
                            });
                        });
                    } else {
                        teachersDiv.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No teachers found for Grade Four.</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching teachers and subjects:', error);
                    $('#teachersList').html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">An error occurred while fetching teachers.</p>');
                }
            });
        }

        function fetchTeachersFive() {
            const grade = 'Grade Five';
            const currentYear = new Date().getFullYear();
            const schoolYear = `${currentYear}-${currentYear + 1}`;  // Construct school year

            $.ajax({
                url: `/api/teachers-and-subjects?grade=${grade}&school_year=${schoolYear}`,
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
                success: function (data) {
                    const teachersDiv = $('#teachersListFive');
                    teachersDiv.empty();

                    if (data.length > 0) {
                        data.forEach(function (teacher) {
                            const currentUrl = window.location.pathname;

                            // Create the button element with updated structure
                            const teacherButton = $('<button>', {
                                class: `flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip ${currentUrl.includes(teacher.name.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                id: `studentManagementButton${teacher.teacher_number}`,
                                'aria-expanded': 'false',  // Initially collapsed
                                'aria-controls': `teachersList${teacher.teacher_number}`,
                                title: teacher.name,
                            });

                            const icon = $('<i>', { class: 'fa-solid fa-chalkboard-teacher' });
                            const teacherText = $('<span>', { class: 'sidebar-text ml-0' }).html(`${teacher.name}`);
                            const chevronIcon = $('<p>', { html: `<i class="fa-solid fa-chevron-right text-[8px] me-5"></i>` });

                            teacherButton.append(icon, teacherText, chevronIcon);

                            // Create the collapse content (dropdown) div
                            const teacherDropdown = $('<div>', {
                                class: 'collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0 hidden', // hidden by default
                                id: `teachersList${teacher.teacher_number}`,
                                style: 'max-height: 1000px; overflow-y: auto;', // Set a fixed height and add a scrollbar if needed
                            });

                            // Add teacher's subjects to the dropdown as clickable links
                            if (teacher.subjects.length > 0) {
                                teacher.subjects.forEach(function (subject) {
                                    const currentUrl = window.location.pathname;

                                    // Create the subject link with the updated URL
                                    const subjectLink = $('<a>', {
                                        href: `/admin/Grade-book/class-record/GradeFive/${teacher.teacher_number}/${subject.subject}`,  // Updated link format
                                        class: `flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip ${currentUrl.includes(subject.subject.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                        title: `${subject.subject} - ${subject.grade} ${subject.section}`,
                                    });

                                    // Create the subject text inside the link
                                    const subjectText = $('<span>', { class: 'sidebar-text' }).html(`${subject.subject}<br>${subject.grade} | ${subject.section}`);
                                    subjectLink.append(subjectText);

                                    // Append the subject link to the teacher's dropdown
                                    teacherDropdown.append(subjectLink);
                                });
                            } else {
                                teacherDropdown.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No subjects found for this teacher.</p>');
                            }

                            teachersDiv.append(teacherButton);
                            teachersDiv.append(teacherDropdown);

                            // Toggle dropdown visibility on button click
                            teacherButton.on('click', function () {
                                const isVisible = teacherDropdown.hasClass('hidden');
                                teacherDropdown.toggleClass('hidden', !isVisible); // Show/hide dropdown
                                teacherButton.attr('aria-expanded', isVisible);  // Update aria-expanded based on visibility
                            });
                        });
                    } else {
                        teachersDiv.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No teachers found for Grade Five.</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching teachers and subjects:', error);
                    $('#teachersList').html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">An error occurred while fetching teachers.</p>');
                }
            });
        }

        function fetchTeachersSix() {
            const grade = 'Grade Six';
            const currentYear = new Date().getFullYear();
            const schoolYear = `${currentYear}-${currentYear + 1}`;  // Construct school year

            $.ajax({
                url: `/api/teachers-and-subjects?grade=${grade}&school_year=${schoolYear}`,
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
                success: function (data) {
                    const teachersDiv = $('#teachersListSix');
                    teachersDiv.empty();

                    if (data.length > 0) {
                        data.forEach(function (teacher) {
                            const currentUrl = window.location.pathname;

                            // Create the button element with updated structure
                            const teacherButton = $('<button>', {
                                class: `flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2 tooltip ${currentUrl.includes(teacher.name.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                id: `studentManagementButton${teacher.teacher_number}`,
                                'aria-expanded': 'false',  // Initially collapsed
                                'aria-controls': `teachersList${teacher.teacher_number}`,
                                title: teacher.name,
                            });

                            const icon = $('<i>', { class: 'fa-solid fa-chalkboard-teacher' });
                            const teacherText = $('<span>', { class: 'sidebar-text ml-0' }).html(`${teacher.name}`);
                            const chevronIcon = $('<p>', { html: `<i class="fa-solid fa-chevron-right text-[8px] me-5"></i>` });

                            teacherButton.append(icon, teacherText, chevronIcon);

                            // Create the collapse content (dropdown) div
                            const teacherDropdown = $('<div>', {
                                class: 'collapse-content bg-teal-800 rounded-lg mx-2 mt-1 px-0 hidden', // hidden by default
                                id: `teachersList${teacher.teacher_number}`,
                                style: 'max-height: 1000px; overflow-y: auto;', // Set a fixed height and add a scrollbar if needed
                            });

                            // Add teacher's subjects to the dropdown as clickable links
                            if (teacher.subjects.length > 0) {
                                teacher.subjects.forEach(function (subject) {
                                    const currentUrl = window.location.pathname;

                                    // Create the subject link with the updated URL
                                    const subjectLink = $('<a>', {
                                        href: `/admin/Grade-book/class-record/GradeSix/${teacher.teacher_number}/${subject.subject}`,  // Updated link format
                                        class: `flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip ${currentUrl.includes(subject.subject.replace(/\s/g, '%20')) ? 'active2' : ''}`,
                                        title: `${subject.subject} - ${subject.grade} ${subject.section}`,
                                    });

                                    // Create the subject text inside the link
                                    const subjectText = $('<span>', { class: 'sidebar-text' }).html(`${subject.subject}<br>${subject.grade} | ${subject.section}`);
                                    subjectLink.append(subjectText);

                                    // Append the subject link to the teacher's dropdown
                                    teacherDropdown.append(subjectLink);
                                });
                            } else {
                                teacherDropdown.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No subjects found for this teacher.</p>');
                            }

                            teachersDiv.append(teacherButton);
                            teachersDiv.append(teacherDropdown);

                            // Toggle dropdown visibility on button click
                            teacherButton.on('click', function () {
                                const isVisible = teacherDropdown.hasClass('hidden');
                                teacherDropdown.toggleClass('hidden', !isVisible); // Show/hide dropdown
                                teacherButton.attr('aria-expanded', isVisible);  // Update aria-expanded based on visibility
                            });
                        });
                    } else {
                        teachersDiv.html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">No teachers found for Grade Six.</p>');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching teachers and subjects:', error);
                    $('#teachersList').html('<p class="text-[12px] mt-2 rounded-lg text-center bg-teal-700 p-2">An error occurred while fetching teachers.</p>');
                }
            });
        }

        // Function to update the subject header from the URL (when navigating directly to a specific subject page)
        function updateSubjectHeader() {
            const path = window.location.pathname;
            const urlParts = path.split('/');
            const subjectName = urlParts[urlParts.length - 1]; // Get the last part (subject name)
            const formattedSubjectName = decodeURIComponent(subjectName.replace('%20', ' ')); // Decode the subject name and replace '%20' with space

            const subjectText = `${formattedSubjectName}`;
            document.getElementById('subjectName').innerText = formattedSubjectName;
        }

        $(document).ready(function () {
            fetchTeachers(); 
            fetchTeachersTwo();
            fetchTeachersThree();
            fetchTeachersFour();
            fetchTeachersFive();
            fetchTeachersSix();
            updateSubjectHeader();
        });

        // Handle collapse for all student management buttons
        document.querySelectorAll('[id^="studentManagementButton"]').forEach(button => {
            button.addEventListener('click', function () {
                const collapseId = this.getAttribute('aria-controls');
                const collapseElement = document.getElementById(collapseId);
                const arrowIcon = this.querySelector('.fa-chevron-right, .fa-chevron-down');
                const isExpanded = this.getAttribute('aria-expanded') === 'true';

                // Toggle dropdown visibility
                collapseElement.classList.toggle('show', !isExpanded);
                this.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');

                // Rotate arrow icon
                if (isExpanded) {
                    arrowIcon.classList.remove('fa-chevron-down');
                    arrowIcon.classList.add('fa-chevron-right');
                } else {
                    arrowIcon.classList.remove('fa-chevron-right');
                    arrowIcon.classList.add('fa-chevron-down');
                }
            });
        });

        document.querySelectorAll('#sidebar a, #sidebar button').forEach(item => {
            item.addEventListener('mouseenter', function () {
                const sidebar = document.querySelector('#sidebar');
                if (sidebar.classList.contains('w-24')) {
                    const tooltip = this.querySelector('.tooltiptext');
                    if (tooltip) {
                        tooltip.style.visibility = 'visible';
                        tooltip.style.opacity = '1';
                        tooltip.style.transition = 'opacity 0.3s ease-in-out';
                        tooltip.style.zIndex = '100';
                        tooltip.style.position = 'absolute';
                    }
                }
            });

            item.addEventListener('mouseleave', function () {
                const tooltip = this.querySelector('.tooltiptext');
                if (tooltip) {
                    tooltip.style.visibility = 'hidden';
                    tooltip.style.opacity = '0';
                }
            });
        });
    </script>

</html>