{{-- resources/views/components/profile.blade.php --}}
@php
    $firstName = session('student_first_name', 'Guest');
    $lastName = session('student_last_name', '');
    $middleName = session('student_middle_name', '');
    $suffixName = session('student_suffix_name', '');
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));

    $user = Auth::guard('student')->user();
    $avatarPath = $user && $user->avatar ? asset('storage/' . $user->avatar) : null;
@endphp

<style>
    .suggestion-item {
        cursor: pointer;
    }

    .suggestion-item:hover {
        background-color: #cbd5e1;
    }

    #header {
        position: sticky;
        /* Make the header sticky */
        top: 0;
        /* Stick to the top */
    }
</style>

<nav class="bg-teal-800 flex items-center justify-between flex-wrap p-3 pb-5 lg:pb-5 shadow-lg z-[2]" id="header">
    <div class="flex items-center justify-end w-full">
        <div class="flex text-right mr-2 mb-2 text-white ml-auto text-[12px] font-normal lg:hidden">
            <div id="currentDate" class="dateMobile mr-3"></div>
            <div id="currentTime" class="timeMobile"></div>
        </div>
    </div>

    <div class="flex items-center justify-between w-full lg:w-auto text-white">
        <div id="btn-toggle"
            class="text-2xl bg-teal-700 text-white shadow-lg ml-0 py-1 px-3 transition-all duration-300 hover:bg-teal-600 rounded-full hidden lg:block">
            <i class="fas fa-bars text-lg text-normal"></i>
        </div>
        <div class="flex items-center justify-center">
            <button id="toggleSidebarButton"
                class="text-2xl bg-teal-700 text-white shadow-lg ml-0 py-1 px-3 transition-all duration-300 hover:bg-teal-600 rounded-full lg:hidden mr-2"><i
                    class="fas fa-bars text-lg text-normal"></i></button>
            <div class="ml-0 mr-0 w-auto lg:ml-10 lg:mr-20 lg:w-96 relative">
                <input type="text" id="search-bar" placeholder="Search..."
                    class="w-48 md:w-96 px-0 indent-3 text-sm text-teal-900 py-2 rounded-lg shadow-lg focus:outline-none focus:rounded-b-none" />
                <div id="suggestions"
                    class="absolute text-teal-900 left-0 py-5 text-[12px] right-0 shadow-lg bg-white rounded-lg rounded-t-none z-10 max-h-96 overflow-y-scroll hidden">
                </div>
            </div>
        </div>
        <div class="ml-7 lg:hidden border-2 w-[50px] h-[50px] bg-teal-700 hover:bg-gray-600 rounded-full flex items-center justify-center text-white text-2xl font-semibold transition-all duration-300 shadow-lg cursor-pointer"
            id="profileAvatar">
            @if ($avatarPath !== null)
                <img id="avatar-img4" src="{{ $avatarPath }}" alt="{{ $firstName }}'s Profile Picture"
                    class="rounded-full w-full h-full object-cover">
            @else
                <div class="flex items-center justify-center w-full h-full bg-teal-600 rounded-full">
                    <span class="text-white">{{ $initials }}</span> <!-- Display initials if avatar is null -->
                </div>
            @endif

            <!-- Dropdown Menu -->
            <div class="absolute text-gray-900 right-0 mt-[12rem] w-56 bg-gray-100 border-t-4 border border-teal-700 rounded-lg shadow-lg hidden mt-4 z-[49]"
                id="dropdownMenuMobile">
                <ul class="text-gray-1=800">
                    <li class="px-4 py-2 hover:bg-gray-300 bg-gray-100 cursor-pointer text-[14px] mt-5"
                        onclick="window.location.href='/StEmelieLearningCenter.HopeSci66/student/student-profile/account'">
                        <i class="fa-solid fa-user mr-3"></i>SIMGT Profile
                    </li>

                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <li class="px-4 py-2 hover:bg-gray-300 rounded-b-lg cursor-pointer text-[14px]"
                            onclick="document.getElementById('logoutModal').classList.remove('hidden');">
                            <i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>Logout
                        </li>
                    </form>
                </ul>
            </div>
        </div>
    </div>

    <div class="text-white ml-auto text-[12px] text-right hidden lg:block">
        <div class="time"></div>
        <div class="currentDate"></div>
    </div>

    <div class="hidden lg:block px-0 relative ml-5">
        <div class="border-2 float-right w-[50px] h-[50px] bg-teal-700 hover:bg-gray-600 rounded-full flex items-center justify-center text-white text-2xl font-semibold transition-all duration-300 shadow-lg cursor-pointer"
            id="profileTop">
            @if ($avatarPath !== null)
                <img id="avatar-img5" src="{{ $avatarPath }}" alt="{{ $firstName }}'s Profile Picture"
                    class="rounded-full w-full h-full object-cover">
            @else
                <div
                    class="flex items-center justify-center border-2 border-teal-800 w-full h-full bg-teal-600  rounded-full">
                    <span class="text-white">{{ $initials }}</span>
                </div>
            @endif
        </div>

                  <!-- Dropdown Menu -->
                  <div class="absolute right-0 mt-2 w-56 bg-gray-100 border-t-4 border border-teal-700 rounded-lg shadow-lg hidden mt-4 z-[49]"
            id="dropdownMenu">
            <ul class="text-gray-800">
                <li class="px-4 py-2 hover:bg-gray-300 bg-gray-100 text-[14px] mt-5 flex items-center cursor-pointer"
                    onclick="window.location.href='/registrar/SIMGT-Profile'">
                    <i class="fa-solid fa-user mr-3"></i>
                    <span>SIMGT Profile</span>
                </li>

                <li class="px-4 py-2 hover:bg-gray-300 bg-gray-100 text-[14px]flex items-center cursor-pointer"
                    onclick="document.getElementById('logoutModal').classList.remove('hidden');">
                    <i class="fa-solid fa-arrow-right-from-bracket mr-3"></i>
                    <span>Logout</span>
                </li>


            </ul>
        </div>
    </div>
</nav>

<div class="fixed inset-0 z-10 bg-black bg-opacity-50 hidden transition-opacity duration-300 p-5 flex items-center justify-center"
    id="logoutModal">
    <div
        class="relative rounded-md shadow-lg p-5 w-96 mx-auto relative bg-white overflow-hidden">
        <div class="flex items-center text-teal-700 text-lg font-semibold" id="logoutMessage">
            <span>Confirm Logout</span>
        </div>
        <hr class="border-t border-teal-600 mt-5">
        <div class="mt-5 text-sm" id="logoutPrompt">
            <p class="text-gray-800 text-justify">Are you sure you want to logout?</p>
        </div>
        <div class="flex justify-end mt-10 text-sm">
            <button
                class="cursor-pointer bg-gray-500 hover:bg-gray-600 px-5 py-2 rounded-sm text-white transition-colors duration-300"
                onclick="document.getElementById('logoutModal').classList.add('hidden');" id="cancelLogout">
                Cancel
            </button>
            <button id="confirmLogout"
                class="ml-5 cursor-pointer bg-teal-700 hover:bg-teal-800 px-5 py-2 rounded-sm text-white transition-colors duration-300">
                Yes, I'm sure
            </button>
            <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline-block ml-3 hidden">
                @csrf
                <button type="submit"
                    class="cursor-pointer bg-teal-700 hover:bg-teal-800 px-5 py-2 rounded-sm text-white transition-colors duration-300">
                    Yes, I'm sure
                </button>
            </form>
        </div>
    </div>
</div>


<script>
    document.getElementById('confirmLogout').addEventListener('click', function () {
        let countdown = 5;
        const logoutMessage = document.getElementById('logoutMessage');
        const logoutPrompt = document.getElementById('logoutPrompt');
        const cancelLogout = document.getElementById('cancelLogout');
        const confirmLogout = document.getElementById('confirmLogout');
        const interval = setInterval(() => {
            logoutMessage.innerHTML = " ";
            logoutPrompt.innerHTML = `<div class="text-teal-700 text-lg font-semibold text-center">Logging out in <br/><div class="text-teal-600 text-2xl font-semibold text-center mt-5">${countdown}</div></div>`;
            cancelLogout.classList.add('hidden');
            confirmLogout.classList.add('hidden');
            countdown--;
            if (countdown < 0) {
                clearInterval(interval);
                document.getElementById('logoutForm').submit();
            }
        }, 800);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const profileContainer = document.getElementById('account');
        const profile = document.getElementById('profile');
        const header = document.getElementById('header');
        const toggleBtn = document.getElementById('btn-toggle');
        const searchBar = document.getElementById('search-bar');
        const suggestionsContainer = document.getElementById('suggestions');

        const basePath = '/StEmelieLearningCenter.HopeSci66'; // Base path
        const links = [
            '/student/dashboard',
            '/student/calendar',
            '/student/student-profile/account',
            '/student/student-profile/security',
            '/student/student-profile/additional-inforamtion',
            '/student/student-profile/grades',
        ];

        searchBar.addEventListener('keyup', (event) => {
            const query = searchBar.value.trim().toLowerCase();
            suggestionsContainer.innerHTML = ''; // Clear previous suggestions
            if (query) {
                const filteredLinks = links.filter(link => link.toLowerCase().includes(query));
                showSuggestions(filteredLinks);
            } else {
                // If no query, show all links when focused
                showSuggestions(links);
            }
        });

        // Show all links when the search bar is clicked or focused
        searchBar.addEventListener('focus', () => {
            showSuggestions(links);
        });

        function showSuggestions(filteredLinks) {
            suggestionsContainer.innerHTML = ''; // Clear previous suggestions
            if (filteredLinks.length) {
                suggestionsContainer.classList.remove('hidden');
                filteredLinks.forEach(link => {
                    const suggestionItem = document.createElement('div');
                    suggestionItem.textContent = link;
                    suggestionItem.className = 'suggestion-item cursor-pointer p-2 hover:bg-teal-100';
                    // Append the base path to the link
                    suggestionItem.onclick = () => {
                        window.location.href = basePath + link;
                    };
                    suggestionsContainer.appendChild(suggestionItem);
                });
            } else {
                suggestionsContainer.classList.add('hidden');
            }
        }

        document.addEventListener('click', (event) => {
            if (!suggestionsContainer.contains(event.target) && event.target !== searchBar) {
                suggestionsContainer.classList.add('hidden');
            }
        });

        function updateDateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const dateString = now.toLocaleDateString([], { year: 'numeric', month: 'long', day: 'numeric' });

            document.querySelector('.time').textContent = timeString;
            document.querySelector('.currentDate').textContent = dateString;
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    });

    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const profileContainer = document.getElementById('account');
        const profile = document.getElementById('profile');
        const toggleBtn = document.getElementById('btn-toggle');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            profileContainer.classList.toggle('bg-teal-700'); // Change background on collapse
            profileContainer.classList.toggle('shadow-none');

            // Adjust profile size based on sidebar state
            if (sidebar.classList.contains('collapsed')) {
                profile.classList.add('w-16', 'h-16'); // Smaller size when collapsed
            } else {
                profile.classList.remove('w-16', 'h-16'); // Reset size
            }

            // Fade out/in sidebar text based on the collapsed state
            const sidebarTexts = sidebar.querySelectorAll('.sidebar-text');
            sidebarTexts.forEach(text => {
                if (sidebar.classList.contains('collapsed')) {
                    text.style.opacity = '0'; // Hide text
                } else {
                    text.style.opacity = '1'; // Show text
                }
            });
        });
    });

    const profileButton = document.getElementById('profileTop');
    const dropdownMenu = document.getElementById('dropdownMenu');

    profileButton.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!profileButton.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });

    const profileButton1 = document.getElementById('profileAvatar');
    const dropdownMenu1 = document.getElementById('dropdownMenuMobile');

    profileButton1.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownMenu1.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!profileButton1.contains(e.target)) {
            dropdownMenu1.classList.add('hidden');
        }
    });

    const sidebar = document.getElementById('offcanvasSidebar');
    const overlay = document.querySelector('.overlay');

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full'); // Show/hide the sidebar
        overlay.classList.toggle('hidden'); // Show/hide the overlay
    }

    // Event listeners for opening/closing sidebar
    document.getElementById('toggleSidebarButton').addEventListener('click', toggleSidebar);
    overlay.addEventListener('click', toggleSidebar);

    function updateDateTime() {
        const now = new Date();
        const optionsDate = { year: 'numeric', month: 'long', day: 'numeric' };
        const optionsTime = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };

        document.getElementById('currentDate').innerText = now.toLocaleDateString(undefined, optionsDate);
        document.getElementById('currentTime').innerText = now.toLocaleTimeString(undefined, optionsTime);
    }

    setInterval(updateDateTime, 1000);
    updateDateTime(); // Initial call to display immediately on load
</script>