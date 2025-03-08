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

    @media (min-width: 1024px) {

        /* Adjust the breakpoint as needed */
        #header {
            position: static;
            /* Remove sticky behavior on large screens */
        }
    }
</style>

<nav class="bg-teal-800 flex items-center justify-between flex-wrap p-3 pb-5 lg:pb-5 shadow-lg z-[2]"
    id="header">
    <div class="flex items-center justify-end w-full">
        <div class="flex text-right mr-2 mb-2 text-white ml-auto text-[12px] font-normal lg:hidden">
            <div id="currentDate" class="dateMobile mr-3"></div>
            <div id="currentTime" class="timeMobile"></div>
        </div>
    </div>

    <div class="flex items-center text-white">
        <div id="btn-toggle"
            class="text-2xl bg-teal-700 text-white shadow-lg ml-0 py-1 px-3 transition-all duration-300 hover:bg-teal-600 rounded-full hidden lg:block">
            <i class="fas fa-bars text-lg text-normal"></i>
        </div>
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
        <div class="ml-7 lg:hidden border-2 border-teal-100 w-[40px] h-[40px] bg-teal-600 rounded-full flex items-center justify-center text-white text-md font-semibold transition-all duration-300 shadow-lg"
            id="profile">
            @if ($avatarPath !== null)
        <img id="avatar-img4" src="{{ $avatarPath }}" alt="{{ $firstName }}'s Profile Picture"
             class="rounded-full w-full h-full object-cover">
    @else
        <div class="flex items-center justify-center w-full h-full bg-teal-600 rounded-full">
            <span class="text-white">{{ $initials }}</span> <!-- Display initials if avatar is null -->
        </div>
    @endif
        </div>
    </div>
    <div class="text-white ml-auto text-[12px] text-right hidden lg:block">
        <div class="time"></div>
        <div class="currentDate"></div>
    </div>
    <div class="hidden lg:block px-0">
        <div class="ml-5 border-2 border-teal-100 w-[50px] h-[50px] bg-teal-600 rounded-full flex items-center justify-center text-white text-2xl font-semibold transition-all duration-300 shadow-lg"
            id="profile">
            @if ($avatarPath !== null)
        <img id="avatar-img5" src="{{ $avatarPath }}" alt="{{ $firstName }}'s Profile Picture"
             class="rounded-full w-full h-full object-cover">
    @else
        <div class="flex items-center justify-center w-full h-full bg-teal-600 rounded-full">
            <span class="text-white">{{ $initials }}</span> <!-- Display initials if avatar is null -->
        </div>
    @endif
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