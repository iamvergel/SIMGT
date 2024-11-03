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
            scrollbar-width: none;
            scrollbar-color: #4b8b8a #2d7a7a;
            overflow-x: hidden;
        }

        #sidebar:hover {
            scrollbar-color: #55a3a2 #2d7a7a;
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
        class="bg-teal-700 text-teal-50 h-full max-w-80 w-80 transition-all duration-300 ease-in-out rounded-l-lg overflow-y-auto">
        <div class="flex justify-start items-center text-center">
            <img class="rounded-full logo border-2 mt-5 ml-5 border-teal-700"
                src="{{ asset('assets/images/SELC.png') }}" alt="logo" width="40" id="logo">
            <p class="mt-5 ml-3 text-[12px] tracking-widest">St. Emilie Learning Center</p>
        </div>

        <div class="flex items-center justify-center max-h-1/4 p-4 border-b border-b-teal-600 mt-10">
            <div class="flex flex-col items-center justify-center h-full p-4 bg-teal-600 rounded-xl w-56 shadow-lg"
                id="account">
                <div class="w-20 h-20 bg-gray-600 rounded-full flex items-center justify-center text-white text-4xl font-semibold transition-all duration-300 shadow-lg"
                    id="profile">
                    {{ strtoupper(substr(session('admin_username') ?? 'G', 0, 1)) }}
                </div>
                <p class="text-[12px] tracking-widest font-semibold text-emerald-50 shadow-text-lg mt-2">
                    {{ session('admin_username') ?? 'Guest' }}
                </p>
                <p class="text-[10px] text-emerald-50 mt-1">Admin</p>
            </div>
        </div>

        <div class="mt-10 mx-1">
            <a href="/StEmelieLearningCenter.HopeSci66/admin/dashboard"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 ml-0 tooltip"
                id="dashboardLink">
                <i class="fa-solid fa-table-columns"></i>
                <span class="sidebar-text ml-2">Dashboard</span>
                <span
                    class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dashboard</span>
            </a>

            <a href="/StEmelieLearningCenter.HopeSci66/admin/student-management"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 ml-0 tooltip"
                id="studentManagementButton1">
                <i class="fa-solid fa-users"></i>
                <span class="sidebar-text ml-2 sm:text-[10px] lg:text-[12px]">Student Management</span>
                <span class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[8px] p-1 font-bold">Student
                    <br /> Management</span>
            </a>

            <a href="/StEmelieLearningCenter.HopeSci66/admin/Grade-book"
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 ml-0 tooltip"
                id="studentManagementButton2">
                <i class="fa-solid fa-book"></i>
                <span class="sidebar-text ml-2 sm:text-[10px] lg:text-[12px]">Gradebook</span>
                <span class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[8px] p-1 font-bold">Grade <br />
                    Book</span>
            </a>

            <button
                class="flex justify-start w-full items-center sidebar-link hover:bg-teal-600 rounded-md mt-4 tooltip"
                id="studentManagementButton3" aria-expanded="false" aria-controls="collapse3">
                <i class="fa-solid fa-user"></i>
                <span class="sidebar-text ml-2">Reports Section</span>
                <p class="ml-10"><i class="fa-solid fa-chevron-right text-[8px]"></i></p>
                <span class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[8px] p-1 font-bold">Reports
                    <br /> Section</span>
            </button>
            <div class="collapse-content bg-teal-800 rounded-lg mx-5 mt-2 px-5" id="collapse3">
                <a href="/StEmelieLearningCenter.HopeSci66/admin/Report-Section/Graduate-Student"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 ml-0 mt-10 tooltip">
                    <i class="fa-solid fa-user-graduate"></i>
                    <span class="sidebar-text ml-2">Graduate Student</span>
                    <span
                        class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Grduate
                        <br /> Student</span>
                </a>
                <a href="/StEmelieLearningCenter.HopeSci66/admin/Report-Section/Drop-Student"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 ml-0 tooltip">
                    <i class="fa-solid fa-user-xmark"></i>
                    <span class="sidebar-text ml-2">Dropped Student</span>
                    <span
                        class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Dropped
                        <br /> Student</span>
                </a>
                <a href="/StEmelieLearningCenter.HopeSci66/admin/Report-Section/Archive-Student"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-600 rounded-md mb-5 ml-0 tooltip">
                    <i class="fa-solid fa-box-archive"></i>
                    <span class="sidebar-text ml-2">Archive Student</span>
                    <span
                        class="tooltiptext text-teal-900 bg-white rounded-lg w-full text-[10px] py-2 font-bold">Archive
                        <br /> Student</span>
                </a>
            </div> <br /><br />

            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <a href="#"
                    class="flex justify-start items-center sidebar-link hover:bg-teal-600 rounded-md mb-2 ml-0 mt-2 tooltip"
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
            <p class="text-[10px] absolute bottom-0 mb-1">@ Copyright &copy; 2024 St Emelie Learning Center HopeSci66.
                All Right Reserved</p>
        </footer>
    </nav>

    <script>
        // Check if the user is logged in
        const adminUsername = "{{ session('admin_username') }}"; // Get the admin username from the session

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
    </script>

</html>