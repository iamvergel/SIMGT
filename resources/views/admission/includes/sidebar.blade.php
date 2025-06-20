@php
    $firstName = session('admission_fname', 'Guest');
    $lastName = session('admission_lname', '');
    $middleName = session('admission_mname', '');
    $suffixName = session('student_suffix_name', '');
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));

    $user = Auth::guard('admission')->user();
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
                    {{ session('admission_username') ?? 'Guest' }}

                </p>
                <p class="text-[10px] tracking-widest font-normal text-teal-100 shadow-text-lg mt-0">
                    {{ session('admission_number') ?? 'Guest' }}
                </p>
                <p class="text-[10px] text-emerald-50 mt-1">{{ session('admission_role') ?? 'Guest' }}</p>
            </div>
        </div>

        <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

        <div class="mt-10 mx-1">
            <p class="text-[14px] mt-10 ml-7 text-white font-normal uppercase tracking-wider">
                {{ session('admission_role') ?? 'Guest' }} DASHBOARD
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
                <a href="/admission/dashboard"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip"
                    title="Dashbaord">
                    <i class="fa-solid fa-table-columns"></i>
                    <span class="sidebar-text ml-2">Dashboard</span>

                </a>
                <a href="/admission/calendar"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip"
                    title="Calendar">
                    <i class="fa-solid fa-calendar"></i>
                    <span class="sidebar-text ml-2">Calendar</span>
                </a>
                <a href="/admission/announcement"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-5 ml-0 tooltip"
                    title="Announcement">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span class="sidebar-text ml-2">Announcement</span>
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
                <a href="/admission/student-management/GradeOne"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2"
                    title="Grade One">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade One</span>
                </a>
                <a href="/admission/student-management/GradeTwo"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                    title="Grade Two">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Two</span>
                </a>
                <a href="/admission/student-management/GradeThree"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-5 ml-0"
                    title="Grade Three">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Three</span>
                </a>
                <a href="/admission/student-management/GradeFour"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-5 ml-0"
                    title="Grade Four">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Four</span>
                </a>
                <a href="/admission/student-management/GradeFive"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-5 ml-0"
                    title="Grade Five">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Five</span>
                </a>
                <a href="/admission/student-management/GradeSix"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-5 ml-0"
                    title="Grade Six">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Grade Six</span>
                </a>
                <!-- <a href="#"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-5 ml-0"
                    title="All New Student">
                    <i class="fa-regular fa-circle"></i>
                    <span class="sidebar-text ml-2">Add New Student</span>
                </a> -->
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
                <a href="/admission/online-application"
                    class="flex justify-start pl-5 items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2"
                    title="Online Application">
                    <i class="fa-solid fa-folder-open"></i>
                    <span class="sidebar-text ml-2">Online Application</span>
                </a>
                <a href="/admission/student-registration"
                    class="flex justify-start pl-5 items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2"
                    title="Student Registration">
                    <i class="fa-solid fa-folder-open"></i>
                    <span class="sidebar-text ml-2">Student Registration</span>
                </a>
            </div>

                <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

                <p class="text-[14px] mt-10 ml-7 text-white font-normal uppercase tracking-wider">MANAGE ADMISSION WEBSITE
                </p>
                <button class="flex justify-between w-full items-center sidebar-link hover:bg-teal-700 rounded-md mt-2"
                    id="studentManagementButton4" aria-expanded="false" aria-controls="managewebsite"
                    title="Manage Website">
                    <i class="fa-solid fa-globe"><span class="sidebar-text ml-2">Manage Website</span></i>
                    <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px] me-5"></i></p>
                </button>
                <div class="collapse-content bg-teal-800 rounded-lg mx-5 mt-1 px-2" id="managewebsite">
                    <!-- <a href="#" class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                        title="Mission Vision">
                        <i class="fa-regular fa-circle"></i>
                        <span class="sidebar-text ml-2">Mission Vision</span>
                    </a>
                    <a href="#" class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                        title="About School">
                        <i class="fa-regular fa-circle"></i>
                        <span class="sidebar-text ml-2">About School</span>
                    </a>
                    <a href="#" class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                        title="School History">
                        <i class="fa-regular fa-circle"></i>
                        <span class="sidebar-text ml-2">School History</span>
                    </a>
                    <a href="#"
                        class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-0"
                        title="School Admission">
                        <i class="fa-regular fa-circle"></i>
                        <span class="sidebar-text ml-2">School Admission</span>
                    </a> -->
                    <a href="/admission/website-gallery"
                        class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                        title="Gallery">
                        <i class="fa-regular fa-circle"></i>
                        <span class="sidebar-text ml-2">Gallery</span>
                    </a>
                    <a href="/admission/manage-registration"
                        class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0"
                        title="Gallery">
                        <i class="fa-regular fa-circle"></i>
                        <span class="sidebar-text ml-2">Manage Registration</span>
                    </a>
                </div>


            <hr class="w-full border-0 h-[1px] bg-teal-700 mt-5">

            <br /><br />


            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline hidden">
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
            <p class="text-[10px] absolute bottom-0 mb-1">@ Copyright &copy; {{ date('Y') }} St Emelie Learning Center HopeSci66.
                All Rights Reserved</p>
        </footer>
    </nav>

    <script>
        // Check if the user is logged in
        const adminUsername = "{{ session('admission_username') }}"; // Get the admin username from the session

        // If the admin username is not set, perform logout
        if (!adminUsername) {
            alert('Too many session');
            document.getElementById('logoutForm').submit(); // Automatically log out
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