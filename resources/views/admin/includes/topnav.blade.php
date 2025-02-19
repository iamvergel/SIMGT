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
        <div >
            
        </div>

        <button id="btn-toggle"
        class="text-2xl flex justify-center items-center bg-teal-800 text-white shadow-lg ml-0 py-1 px-1 transition-all duration-300 hover:bg-teal-700 rounded-full"><i class="fas fa-bars text-lg text-normal p-3"></i></button>
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
        <div class="border-2 w-[40px] h-[40px] bg-teal-700 hover:bg-gray-600 rounded-full flex items-center justify-center text-white text-2xl font-semibold transition-all duration-300 shadow-lg cursor-pointer"
            id="profileTop">
            {{ strtoupper(substr(session('admin_username') ?? 'G', 0, 1)) }}
        </div>

        <!-- Dropdown Menu -->
        <div class="absolute right-0 mt-2 w-56 bg-white border-t-2 border-teal-700 rounded-lg shadow-lg hidden mt-4"
            id="dropdownMenu">
            <ul class="text-gray-800">
                <li class="text-start px-3">
                    <p class="text-[14px] tracking-widest font-semibold shadow-text-lg mt-2">
                        {{ session('admin_username') }}
                    </p>
                </li>
                <li class="px-4 py-2 hover:bg-gray-200 cursor-pointer text-[14px] mt-5"
                    onclick="window.location.href='/manage-account'">
                    <i class="fa-solid fa-user mr-3"></i>Manage Account
                </li>

                <hr>

                <form id="logoutForm" action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <li class="px-4 py-2 hover:bg-gray-200 rounded-b-lg cursor-pointer text-[14px] mt-3"
                        onclick="event.preventDefault(); document.getElementById('logoutForm').submit();"> <i
                            class="fa-solid fa-arrow-right-from-bracket mr-3"></i>Logout
                    </li>
                </form>
            </ul>
        </div>
    </div>
</nav>

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
            '/admin/dashboard',
            '/admin/student-management',
            '/admin/student-management/GradeOne',
            '/admin/student-management/GradeTwo',
            '/admin/student-management/GradeThree',
            '/admin/student-management/GradeFour',
            '/admin/student-management/GradeFive',
            '/admin/student-management/GradeSix',
            '/admin/Grade-book',
            '/admin/Grade-book/GradeOne',
            '/admin/Grade-book/GradeTwo',
            '/admin/Grade-book/GradeThree',
            '/admin/Grade-book/GradeFour',
            '/admin/Grade-book/GradeFive',
            '/admin/Grade-book/GradeSix',
            '/admin/Report-Section/Graduate-Student',
            '/admin/Report-Section/Drop-Student',
            '/admin/Report-Section/Archive-Student',
            '/admin/student-management/AllStudentData',
            '/admin/Report-Section/Drop-Student/All-Drop-Data',
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
        const reportSection = document.getElementById('collapse3');
        const dashboard = document.getElementById('dashboard');
        const searchBar = document.getElementById('search-bar');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('w-20');
            profile.classList.toggle('w-16');
            profile.classList.toggle('h-16');
            profileContainer.classList.toggle('bg-teal-700');
            profileContainer.classList.toggle('shadow-none');
            reportSection.classList.toggle('mx-0');
            reportSection.classList.toggle('px-0');
            dashboard.classList.toggle('mx-0');
            dashboard.classList.toggle('px-0');
            sidebar.classList.toggle('w-80');
            sidebar.classList.toggle('collapsed');
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
</script>