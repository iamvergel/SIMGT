<header class="z-[500] w-full 2xl:w-[1900px] 2xl:max-w-[1900px] p-5 px-3 lg:px-[10rem] 2xl:px-[20rem] relative top-0 "
    data-aos="fade-down" data-aos-duration="600">
    <div class="grid grid-cols-2">
        <div class="col-span-2 flex justify-between">
            <div class="h-full flex items-center hidden lg:block">
                <div class="h-full flex items-center">
                    <img src="{{ asset('../assets/images/SELC.png') }}" alt="logo"
                        class="w-12 rounded-full hidden lg:block">
                    <a href="/"
                        class="text-white font-bold text-md ml-2 tracking-wider hidden lg:block hover:text-yellow-500">St.
                        Emilie Learning Center</a>
                </div>
            </div>

            <div class="flex items-center">
                <div class="hidden lg:block mr-5">
                    <a href="https://www.google.com/maps/place/St.+Emilie+Learning+Center/@14.7187826,121.1332403,15z/data=!4m6!3m5!1s0x3397b0083f1e47fb:0xa41cb7b730554b5!8m2!3d14.7533756!4d121.0806689!16s%2Fg%2F1pzpz4rpw?hl=en&entry=ttu&g_ep=EgoyMDI0MDkxNi4wIKXMDSoASAFQAw%3D%3D"
                        target="_blank" class="text-[12px] text-white lg:text-[12px] hover:text-yellow-500"><i
                            class="fas fa-map"></i>
                        Amparo Village, 18 Bangkal, Caloocan, Metro Manila
                    </a>
                </div>

                <div>
                    <p class="font-light text-white text-[12px]">
                        <i class="fas fa-clock text-[12px] mr-3 "></i><strong></strong> Open 24 Hours
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="hidden lg:flex lg:justify-center lg:items-center text-[15px] col-span-2 mt-5 sticky top-5 z-[500] w-full">
    <div class="bg-white w-1/2 rounded-full flex justify-between p-3">
        <ul class="flex justify-between text-black">
            <li
                class="mx-5 transition-transform transform hover:scale-105 hover:text-yellow-400 flex items-center">
                <i class="fas fa-home text-sm mr-1"></i> Home
            </li>
            <li
                class="mx-5 transition-transform transform hover:scale-105 hover:text-yellow-400 flex items-center">
                <i class="fas fa-info-circle text-sm mr-1"></i> About Us
            </li>
            <li
                class="mx-5 transition-transform transform hover:scale-105 hover:text-yellow-400 flex items-center">
                <i class="fas fa-users text-sm mr-1"></i> Staff
            </li>
            <li
                class="mx-5 transition-transform transform hover:scale-105 hover:text-yellow-400 flex items-center">
                <i class="fas fa-envelope text-sm mr-1"></i> Contact Us
            </li>
        </ul>


        <div class="flex lg:hidden">
            <button id="menu-toggle" class="text-white">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div>
            <button onclick="window.open('/StEmelieLearningCenter.HopeSci66/sign-in', '_blank')"
                class="bg-yellow-400 shadow-lg px-10 py-1 text-teal-700 font-bold rounded-md transition-all duration-300 hover:bg-yellow-200 hover:text-teal-900 flex items-center">
                Sign in
                <i class="fas fa-chevron-right ml-2 text-[10px]"></i>
            </button>
        </div>
    </div>
</div>

<!-- Offcanvas Menu -->
<div id="offcanvas" class="fixed inset-0 bg-black bg-opacity-60 hidden z-[500] transition-opacity duration-300"
    data-aos="fade-down" data-aos-duration="600">
    <div class="absolute top-0 left-0 max-w-96 bg-white p-5 h-full transition-transform duration-300 ease-in-out transform-translate-x-full"
        id="offcanvas-menu">
        <div class="flex items-center py-3">
            <img src="{{ asset('../assets/images/SELC.png') }}" alt="logo" class="w-12 rounded-full">
            <h6 class="font-bold text-md ml-2 tracking-wider text-teal-800">St. Emilie Learning Center</h6>
        </div>
        <div class="text-end my-5">
            <button id="close-menu" class="text-center p-2 py-1 text-[15px]"><i
                    class="fas fa-times text-teal-800"></i></button>
        </div>
        <ul class="mt-5 text-teal-800 text-[15px]">
            <li class="py-3 hover:text-yellow-500 cursor-pointer"><a href="/"><i class="fas fa-home mr-2"></i> Home</a>
            </li>
            <li class="py-3 hover:text-yellow-500 cursor-pointer"><i class="fas fa-info-circle mr-2"></i> About Us</li>
            <li class="py-3 hover:text-yellow-500 cursor-pointer"><i class="fas fa-users mr-2"></i> Staff</li>
            <li class="py-3 hover:text-yellow-500 cursor-pointer"><i class="fas fa-envelope mr-2"></i> Contact Us</li>
        </ul>
        <div class="absolute bottom-0">
            <img src="{{ asset('../assets/images/grouplogo.png') }}" alt="grouplogo" width="200"
                class="opacity-50 mb-[-1rem] ml-[-2rem] grayscale brightness-0">
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