@php
    $firstName = session('student_first_name', 'Guest');
    $lastName = session('student_last_name', '');
    $middleName = session('student_middle_name', '');
    $suffixName = session('student_suffix_name', '');
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));

    $user = Auth::guard('student')->user();
    $avatarPath = $user && $user->avatar ? asset('storage/' . $user->avatar) : null;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #sidebar-container {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 1000;
            /* Ensure it's above other content */
        }

        #overlay {
            display: none;
        }

        @media (max-width: 768px) {

            /* Adjust according to your breakpoints */
            #sidebar-container {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            #sidebar-container.show {
                transform: translateX(0);
            }

            #overlay {
                display: block;
                z-index: 999;
                /* Below sidebar but above other content */
            }
        }

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

        #sidebar {
            transition: width 0.3s ease;
        }

        .collapsed {
            width: 5rem;
        }

        .sidebar-text {
            transition: opacity 0.3s ease;
        }

        .sidebar-text {
            transition: all 0.3s;
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
            background-color: #4b8b8a;
            border: solid 1px rgba(255, 255, 255, 0.3);
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
            transform: rotate(360deg);
            transition: transform 0.2s;
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
        class="bg-teal-800 text-teal-50 h-full max-w-80 w-80 transition-all duration-200 ease-in-out overflow-y-auto hidden lg:block">
        <div class="flex justify-start items-center text-center">
            <img class="rounded-full logo border-2 mt-5 ml-5 border-teal-700"
                src="{{ asset('assets/images/SELC.png') }}" alt="logo" width="40" id="logo">
            <p class="mt-5 ml-3 text-[12px] tracking-widest">St. Emilie Learning Center</p>
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
                            <span class="text-white">{{ $initials }}</span> <!-- Display initials if avatar is null -->
                        </div>
                    @endif
                </div>
                <p class="text-[12px] tracking-widest font-semibold text-emerald-50 shadow-text-lg mt-2">
                    {{ $firstName . ' ' . $lastName ?: 'Guest' }}
                </p>
                <p class="text-[10px] tracking-widest font-normal text-emerald-50 shadow-text-lg mt-0">
                    {{ session('student_id') }}
                </p>
                <p></p>
                <p class="text-[10px] text-emerald-50 mt-1">Student</p>
            </div>
        </div>


        <div class="mt-10 mx-1">
            <p class="text-[14px] mt-5 ml-7 text-teal-100 font-semibold">STUDENT DASHBOARD</p>
            <a href="/student/dashboard"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip mt-2"
                id="dashboardLink">
                <i class="fa-solid fa-table-columns"></i>
                <span class="sidebar-text ml-2">Dashboard</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <a href="/student/calendar"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip"
                id="dashboardLink">
                <i class="fas fa-calendar"></i>
                <span class="sidebar-text ml-2">
                    Calendar</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <p class="text-[14px] mt-10 ml-7 text-teal-100 font-semibold">SIMGT PROFILE</p>

            <a href="/student/student-profile/account"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip"
                id="dashboardLink">
                <i class="fas fa-user"></i>
                <span class="sidebar-text ml-2">
                    SIMGT PROFILE</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <p class="text-[14px] mt-10 ml-7 text-teal-100 font-semibold">STUDENT GRADES</p>

            <a href="/student/student-grade"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip mt-2"
                id="dashboardLink">
                <i class="fa-solid fa-file"></i>
                <span class="sidebar-text ml-2">
                    Student Grades</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <a href="/student/grades"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip hidden"
                id="dashboardLink">
                <i class="fa-solid fa-file"></i>
                <span class="sidebar-text ml-2">
                    Student Grades</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <div id="registrationLink" class="block" style="display: none;">
                <p class="text-[14px] mt-10 ml-7 text-teal-100 font-semibold uppercase">Registration</p>
                <a href="/student/registration"
                    class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip MT-2"
                    id="dashboardLink">
                    <i class="fa-solid fa-file"></i>
                    <span class="sidebar-text ml-2">
                        Registration
                    </span>
                    <span
                        class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
                </a>
            </div><br /><br /><br />

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
            <p class="text-[10px] absolute bottom-0 mb-1">@ Copyright &copy; 2024 St Emelie Learning Center
                HopeSci66.
                All Right Reserved</p>
        </footer>
    </nav>

    <nav id="offcanvasSidebar"
        class="bg-teal-800 text-teal-50 h-screen max-w-64 w-64 absolute top-0 left-0 transition-transform duration-300 ease-in-out transform -translate-x-full overflow-y-auto z-[20] block lg:hidden addmobile">
        <div class="flex justify-start items-center text-center">
            <img class="rounded-full logo border-2 mt-5 ml-2 border-teal-700"
                src="{{ asset('assets/images/SELC.png') }}" alt="logo" width="40" id="logo">
            <p class="mt-5 ml-3 text-[12px] tracking-widest">St. Emilie Learning Center</p>
        </div>

        <div class="flex items-center justify-center max-h-1/4 p-4 border-b border-b-teal-600 mt-10">
            <div class="flex flex-col items-center justify-center h-full p-4 bg-teal-700 rounded-xl w-56 shadow-lg"
                id="account">
                <div class="mt-5 w-20 h-20 border-4 border-white bg-teal-600 rounded-full flex items-center justify-center text-white text-4xl font-semibold transition-all duration-300 shadow-lg"
                    id="profile">
                    @if ($avatarPath !== null)
                        <img id="avatar-img3" src="{{ $avatarPath }}" alt="{{ $firstName }}'s Profile Picture"
                            class="rounded-full w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center w-full h-full bg-teal-600 rounded-full">
                            <span class="text-white">{{ $initials }}</span> <!-- Display initials if avatar is null -->
                        </div>
                    @endif
                </div>
                <p class="text-[12px] tracking-widest font-semibold text-emerald-50 shadow-text-lg mt-2">
                    {{ $firstName . ' ' . $lastName ?: 'Guest' }}
                </p>
                <p class="text-[10px] tracking-widest font-normal text-emerald-50 shadow-text-lg mt-0">
                    {{ session('student_id') }}
                </p>
                <p class="text-[10px] text-emerald-50 mt-1">Student</p>
            </div>
        </div>

        <div class="mt-10 mx-1">
            <p class="text-[14px] mt-5 ml-7 text-teal-100 font-semibold">STUDENT DASHBOARD</p>
            <a href="/student/dashboard"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip mt-2"
                id="dashboardLink">
                <i class="fa-solid fa-table-columns"></i>
                <span class="sidebar-text ml-2">Dashboard</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <a href="/student/calendar"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip"
                id="dashboardLink">
                <i class="fas fa-calendar"></i>
                <span class="sidebar-text ml-2">
                    Calendar</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <p class="text-[14px] mt-10 ml-7 text-teal-100 font-semibold">SIMGT PROFILE</p>
            <a href="/student/student-profile/account"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip mt-2"
                id="dashboardLink">
                <i class="fas fa-user"></i>
                <span class="sidebar-text ml-2">
                SIMGT PROFILE</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <p class="text-[14px] mt-10 ml-7 text-teal-100 font-semibold">STUDENT GRADES</p>
            <a href="/student/student-grade"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip mt-2"
                id="dashboardLink">
                <i class="fa-solid fa-file"></i>
                <span class="sidebar-text ml-2">
                    Student Grades</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <a href="/student/grades"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip hidden"
                id="dashboardLink">
                <i class="fa-solid fa-file"></i>
                <span class="sidebar-text ml-2">
                    Student Grades</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <div id="registrationLinkMobile" class="block" style="display: none;">
                <p class="text-[14px] mt-10 ml-7 text-teal-100 font-semibold uppercase">Registration</p>
                <a href="/student/registration"
                    class="flex justify-start w-full items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 tooltip MT-2"
                    id="dashboardLink">
                    <i class="fa-solid fa-file"></i>
                    <span class="sidebar-text ml-2">
                        Registration
                    </span>
                    <span
                        class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
                </a>
            </div><br /><br /><br />

            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline hidden">
                @csrf
                <a href="#"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-700 rounded-md mb-2 ml-0 mt-2 tooltip"
                    id="signoutLink" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
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
    <div class="overlay w-screen h-screen bg-black opacity-50 z-[19] hidden lg:hidden absolute left-0 top-0">
    </div>

    <script>
        // Check if the user is logged in
        const statusAccount = "{{ session('status') }}"; // Get the admin username from the session
        // If the admin username is not set, perform logout
        if (statusAccount === "Dropped" || statusAccount === "Graduated") {
            alert('Account is Unavailable');
            document.getElementById('logoutForm').submit(); // Automatically log out
        }

        const adminUsername = "{{ session('student_first_name') }}"; // Get the admin username from the session

        if (!adminUsername) {
            alert('Too many Session');
            document.getElementById('logoutForm').submit(); // Automatically log out
        }

        // Highlight the current path on load for both sidebars
        const currentPath = window.location.pathname;

        // Function to set active class
        function setActiveClass(sidebarSelector) {
            document.querySelectorAll(sidebarSelector).forEach(item => {
                if (item.getAttribute('href') === currentPath) {
                    item.classList.add('active'); // Add active class to the current path
                }
            });
        }

        // Call the function for both sidebars
        setActiveClass('#sidebar a');
        setActiveClass('#offcanvasSidebar a');

        document.querySelectorAll('#sidebar a').forEach(item => {
            item.addEventListener('click', function () {
                // Remove active class from all items in the main sidebar
                document.querySelectorAll('#sidebar a').forEach(i => i.classList.remove('active'));
                this.classList.add('active'); // Add active class to the clicked item

                // Collapse any opened submenu
                document.querySelectorAll('.collapse-content').forEach(collapse => {
                    collapse.classList.remove('show'); // Hide all submenus
                });
            });
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
                if (sidebar.classList.contains('w-20')) {
                    const tooltip = this.querySelector('.tooltiptext');
                    if (tooltip) {
                        tooltip.style.visibility = 'visible';
                        tooltip.style.opacity = '1';
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

        fetch('/api/registration-button')
            .then(response => response.json())
            .then(data => {
                // Check if the registration status is 'Active'
                if (data[0] && data[0].status === 'Active') {
                    // Display the registration link if Active
                    document.getElementById('registrationLink').style.display = 'block';
                    document.getElementById('registrationLinkMobile').style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching registration status:', error);
            });
    </script>

</html>