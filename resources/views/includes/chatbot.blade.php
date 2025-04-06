<style>
    .loader {
        border: 4px solid #f3f3f3;
        /* Light grey */
        border-top: 4px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 30px;
        height: 30px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<button
    class="sticky z-[10] top-[1.5rem] mt-5 left-[1.5rem] lg:hidden block items-center font-semibold justify-center border-2 border-teal-500 w-40 my-1 h-12 shadow-lg bg-teal-600 hover:bg-teal-700 text-white rounded-full shadow-lg transition-all duration-300"
    type="button" onclick="window.open('/', '_blank')">Sign-in
</button>

<div class="course-button-container fixed top-[20rem] right-[1.5rem] z-[13] w-14 bl  ock lg:hidden block">
    <!-- Course Card -->
    <button
        class="items-center justify-center w-14 my-1 h-14 bg-yellow-500 hover:bg-yellow-600 text-white rounded-full shadow-lg transition-all duration-300"
        type="button" onclick="window.location.href = '#courses'"><i class="fas fa-book text-2xl"></i>
    </button>

    <button
        class="items-center justify-center w-14 h-14 my-2 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg transition-all duration-300"
        type="button" onclick="window.location.href = '#gallery'"><i class="fas fa-image text-2xl"></i>
    </button>

    <button
        class="items-center justify-center w-14 h-14 my-1 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-lg transition-all duration-300"
        type="button" onclick="window.location.href = '#missionvission'"><i
            class="fas fa-chalkboard-teacher text-2xl"></i>
    </button>
</div>

<!-- Chat Toggle Button -->
<button
    class="fixed z-[10] bottom-[1.5rem] right-[1.5rem] lg:bottom-[2.5rem] lg:right-[3.5rem] inline-flex items-center justify-center w-14 h-14 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-lg transition-all duration-300"
    type="button" onclick="toggleChat()">
    <span class="hidden text-sm me-2">Open Chat</span><i class="fa-brands fa-facebook-messenger text-2xl"></i>
</button>

<button id="scrollToTop" onclick="window.location.href = '#top'" 
    class="fixed z-[10] bottom-[1.5rem] right-[5.5rem] lg:bottom-[2.5rem] lg:right-[7.5rem] inline-flex items-center justify-center w-14 h-14 bg-sky-500 hover:bg-sky-600 text-white rounded-full shadow-lg transition-all duration-300" 
    style="display: none;">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    const scrollToTopButton = document.getElementById('scrollToTop');
    const mainContent = document.getElementById('mainContent'); // Get the main content div

    // Listen to the scroll event on the mainContent div
    mainContent.addEventListener('scroll', () => {
        if (mainContent.scrollTop > 0) { // 200px is the threshold
            scrollToTopButton.style.display = 'block'; // Show the button
            
        } else {
            scrollToTopButton.style.display = 'none'; // Hide the button
        }
    });
</script>



<!-- onclick="window.open('//www.facebook.com/messages/t/343328209464206')" -->
<!-- Chat Window -->
<div id="chatWindow"
    class="fixed z-[13] bottom-[1rem] right-[1rem] lg:bottom-[2rem] lg:right-[3rem] bg-white w-[300px] h-[300px] lg:w-[350px] lg:h-[300px] rounded-xl shadow-lg border-2 border overflow-hidden hidden flex flex-col">

    <!-- Header Section -->
    <div class="bg-teal-800 p-4 text-white flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-300 to-blue-400 p-[0.1rem]">
                <img src="{{ asset('../assets/images/SELC.png') }}" alt="Support Avatar"
                    class="w-full h-full rounded-full">
            </div>
            <div>
                <h2 class="text-sm font-semibold">St. Emelie Learning Center</h2>
            </div>
        </div>
        <button class="text-white" onclick="toggleChat()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Chat Messages Section -->
    <div id="msgContainer" class="flex-1 p-4 overflow-y-auto bg-yellow-50">
        <div class="flex gap-2 my-2 b">
            <div class="bg-white shadow-lg p-3 rounded-lg text-sm rounded-t-lg rounded-b-none rounded-r-lg">
                Hello!<br />
                How can I help you?
            </div>
        </div>
    </div>

    <!-- Chat Toggle Button -->
    <button
        class="fixed z-[14] bottom-[1.5rem] right-[1.5rem] lg:bottom-[2.5rem] lg:right-[3.5rem] inline-flex items-center justify-center w-14 h-14 bg-blue-500 hover:bg-blue-600 text-white rounded-full shadow-lg transition-all duration-300"
        type="button" onclick="window.open('https://m.me/StEmilieLC', '_blank')" id="chatToggle">
        <span class="hidden text-sm me-2" id="chatToggleText">Open Chat</span><i
            class="fa-brands fa-facebook-messenger text-2xl"></i>
    </button>
</div>

<script>
    function toggleChat() {
        if (document.getElementById('chatWindow').classList.contains('hidden')) {
            document.getElementById('chatWindow').classList.remove('hidden');
            document.getElementById('chatToggle').classList.remove('w-14');
            document.getElementById('chatToggle').classList.add('w-36');
            document.getElementById('chatWindow').classList.add('animate-slideInRight');
            document.getElementById('chatToggleText').classList.remove('hidden');
        } else {
            document.getElementById('chatWindow').classList.add('hidden');
            document.getElementById('chatToggle').classList.remove('w-36');
            document.getElementById('chatToggle').classList.add('w-14');
            document.getElementById('chatToggleText').classList.add('hidden');
        }
    }
</script>