<header class="flex justify-between z-[200] items-center bg-[#00000060] w-full p-5 fixed top-0 left-0 px-10">
    <div class="h-full flex items-center hidden lg:block">
        <div class="h-full flex items-center">
            <img src="{{ asset('../assets/images/SELC.png') }}" alt="logo" class="w-12 rounded-full hidden lg:block">
            <h6 class="text-white font-bold text-md ml-2 tracking-wider hidden lg:block">St. Emilie Learning Center</h6>
        </div>
    </div>

    <div class="hidden lg:flex">
        <ul class="flex justify-between">
            <li
                class="mx-5 transition-transform transform hover:scale-105 hover:text-yellow-400 text-white flex items-center">
                <i class="fas fa-home text-sm mr-1"></i> Home
            </li>
            <li
                class="mx-5 transition-transform transform hover:scale-105 hover:text-yellow-400 text-white flex items-center">
                <i class="fas fa-info-circle text-sm mr-1"></i> About Us
            </li>
            <li
                class="mx-5 transition-transform transform hover:scale-105 hover:text-yellow-400 text-white flex items-center">
                <i class="fas fa-users text-sm mr-1"></i> Staff
            </li>
            <li
                class="mx-5 transition-transform transform hover:scale-105 hover:text-yellow-400 text-white flex items-center">
                <i class="fas fa-envelope text-sm mr-1"></i> Contact Us
            </li>
        </ul>
    </div>

    <div class="flex lg:hidden">
        <button id="menu-toggle" class="text-white">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div>
        <button onclick="window.open('/StEmelieLearningCenter.HopeSci66/sign-in', '_blank')"
            class="bg-yellow-400 shadow-lg px-10 py-1 text-teal-700 font-bold rounded-md transition-all duration-300 hover:bg-yellow-200 hover:text-teal-900 flex items-center">
            Go To Portal
            <i class="fas fa-chevron-right ml-2 text-sm"></i>
        </button>
    </div>
</header>

<!-- Offcanvas Menu -->
<div id="offcanvas" class="fixed inset-0 bg-black bg-opacity-60 hidden z-[500] transition-opacity duration-300">
    <div class="absolute top-0 left-0 max-w-96 bg-white p-5 h-full transition-transform duration-300 ease-in-out transform-translate-x-full"
        id="offcanvas-menu">
        <div class="flex items-center border-b border-teal-900 py-3">
            <img src="{{ asset('../assets/images/SELC.png') }}" alt="logo" class="w-12 rounded-full">
            <h6 class="font-bold text-md ml-2 tracking-wider text-teal-800">St. Emilie Learning Center</h6>
        </div>
        <div class="text-end my-5">
            <button id="close-menu" class="text-center p-2 py-1 text-xl"><i
                    class="fas fa-times text-teal-800"></i></button>
        </div>
        <ul class="mt-5 text-teal-800 text-lg">
            <li class="py-3 hover:text-yellow-500 cursor-pointer"><a href="/"><i class="fas fa-home mr-2"></i> Home</a>
            </li>
            <li class="py-3 hover:text-yellow-500 cursor-pointer"><i class="fas fa-info-circle mr-2"></i> About Us</li>
            <li class="py-3 hover:text-yellow-500 cursor-pointer"><i class="fas fa-users mr-2"></i> Staff</li>
            <li class="py-3 hover:text-yellow-500 cursor-pointer"><i class="fas fa-envelope mr-2"></i> Contact Us</li>
        </ul>
        <div class="absolute bottom-0">
            <img src="{{ asset('../assets/images/grouplogo.png') }}" alt="grouplogo" width="200"
                class="opacity-25 filter invert absolute bottom-[-2rem] left-[-2rem]">
            <p class="text-[12px] mb-5 px-5 text-center text-teal-800 font-semibold">@ Copyright &copy; 2024 St Emilie
                Learning Center-HopeSci66.SIMGT66.
                All Right Reserved</p>
        </div>
    </div>
</div>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const offcanvas = document.getElementById('offcanvas');
    const offcanvasMenu = document.getElementById('offcanvas-menu');
    const closeMenu = document.getElementById('close-menu');

    menuToggle.addEventListener('click', () => {
        offcanvas.classList.remove('hidden');
        offcanvas.classList.add('opacity-100');
        offcanvasMenu.style.transform = 'translateX(0)'; // Slide in to 0
    });

    closeMenu.addEventListener('click', () => {
        offcanvasMenu.style.transform = 'translateX(-500px)'; // Slide out to -500px
        setTimeout(() => {
            offcanvas.classList.add('hidden');
            offcanvas.classList.remove('opacity-100');
            offcanvasMenu.style.transform = ''; // Reset transform
        }, 300); // Match duration with CSS transition
    });

    // Optional: Close menu when clicking outside
    offcanvas.addEventListener('click', (e) => {
        if (e.target === offcanvas) {
            offcanvasMenu.style.transform = 'translateX(-500px)'; // Slide out to -500px
            setTimeout(() => {
                offcanvas.classList.add('hidden');
                offcanvas.classList.remove('opacity-100');
                offcanvasMenu.style.transform = ''; // Reset transform
            }, 300); // Match duration with CSS transition
        }
    });
</script>