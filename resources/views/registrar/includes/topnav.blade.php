@php
    $firstName = session('registrar_fname', 'Guest');
    $lastName = session('registrar_lname', '');
    $middleName = session('registrar_mname', '');
    $suffixName = session('registrar_suffix_name', '');
    $initials = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));

    $user = Auth::guard('registrar')->user();
    $avatarPath = $user && $user->avatar ? asset('storage/' . $user->avatar) : null;
@endphp

<style>
    .suggestion-item {
        cursor: pointer;
    }

    .suggestion-item:hover {
        background-color: #cbd5e1;
    }
</style>

<nav class="bg-white flex items-center justify-between p-3 rounded-tr-lg shadow-lg" id="header">
    <div class="flex items-center text-white">
        <div>

        </div>

        <button id="btn-toggle"
            class="text-2xl flex justify-center items-center bg-teal-800 text-white shadow-lg ml-0 py-1 px-1 transition-all duration-300 hover:bg-teal-700 rounded-full"><i
                class="fas fa-bars text-lg text-normal p-3"></i></button>
    </div>
    <div class="ml-10 mr-20 w-48 lg:w-96 relative">
        <div class="flex justify-center items-center">
            <i class="fa-solid fa-magnifying-glass text-[18px] mr-2 text-teal-900"></i>
            <input type="text" id="search-bar" placeholder="Search..."
                class="w-full px-10 text-sm text-teal-900 py-2 border-2 border-gray-300 rounded-lg shadow-lg focus:outline-none focus:rounded-b-none" />
        </div>
        <div id="suggestions"
            class="absolute text-teal-900 left-0 px-5 py-5 text-[12px] right-0 shadow-lg bg-white rounded-lg rounded-t-none z-10 max-h-96 overflow-y-scroll hidden">
        </div>
    </div>
    <div class="block ml-auto text-[12px] text-right">
        <div class="time"></div>
        <div class="currentDate"></div>
    </div>
    <div class="relative ml-5">
        <div class="border-2 w-[50px] h-[50px] bg-teal-700 hover:bg-gray-600 rounded-full flex items-center justify-center text-white text-2xl font-semibold transition-all duration-300 shadow-lg cursor-pointer"
            id="profileTop">
            @if ($avatarPath !== null)
                <img id="avatar-img1" src="{{ $avatarPath }}" alt="{{ $firstName }}'s Profile Picture"
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
            logoutPrompt.innerHTML = `<div class="text-teal-700 text-lg font-semibold text-center">Logging out in <br/><div class="text-teal-600 text-2xl font-semibold text-center mt-5">${countdown}...</div></div>`;
            cancelLogout.classList.add('hidden');
            confirmLogout.classList.add('hidden');
            countdown--;
            if (countdown < 0) {
                clearInterval(interval);
                document.getElementById('logoutForm').submit();
            }
        }, 1000);
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

        const basePath = ''; // Base path
        const links = [
            '/registrar/dashboard',
            '/registrar/student-management',
            '/registrar/student-management/GradeOne',
            '/registrar/student-management/GradeTwo',
            '/registrar/student-management/GradeThree',
            '/registrar/student-management/GradeFour',
            '/registrar/student-management/GradeFive',
            '/registrar/student-management/GradeSix',
            '/registrar/Grade-book',
            '/registrar/Grade-book/GradeOne',
            '/registrar/Grade-book/GradeTwo',
            '/registrar/Grade-book/GradeThree',
            '/registrar/Grade-book/GradeFour',
            '/registrar/Grade-book/GradeFive',
            '/registrar/Grade-book/GradeSix',
            '/registrar/Report-Section/Graduate-Student',
            '/registrar/Report-Section/Drop-Student',
            '/registrar/Report-Section/Archive-Student',
            '/registrar/student-management/AllStudentData',
            '/registrar/Report-Section/Drop-Student/All-Drop-Data',
        ];

        toggleBtn.addEventListener('click', () => {
            // Your toggle functionality here...
        });

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
        const content = document.getElementById('content');
        const header = document.getElementById('header');
        const toggleBtn = document.getElementById('btn-toggle');
        const reportSections = document.querySelectorAll('.collapse-content');
        const dashboard = document.getElementById('dashboard');
        const searchBar = document.getElementById('search-bar');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('w-24');
            profile.classList.toggle('w-16');
            profile.classList.toggle('h-16');
            profileContainer.classList.toggle('bg-teal-700');
            profileContainer.classList.toggle('shadow-none');
            sidebar.classList.toggle('w-80');
            sidebar.classList.toggle('collapsed');

            reportSections.forEach(reportSection => {
                reportSection.classList.toggle('mx-0');
                reportSection.classList.toggle('px-0');
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

    function confirmLogout(event) {
        event.preventDefault(); // Prevent form submission immediately
        if (confirm('Are you sure you want to log out?')) {
            document.getElementById('logoutForm').submit(); // Submit the form if confirmed
        }
    }
</script>