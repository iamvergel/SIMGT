@include("includes.header")

@include("main.courses")
<div class="main1 bg-white 2xl:max-w-[1900px] w-full h-full ">
    <canvas id="canvas" class="w-full h-full absolute bg-transparent z-[11] left-0 top-0 "></canvas>
    <!-- @include("main.topbar") -->
    <div class=" w-full h-full relative top-0">
        <div
            class="pl-[1rem] lg:pl-[5rem] text-start z-[10] w-full text-white relative mt-[10rem]">
            <p class="text-sm lg:text-[1.5rem] leading-8">Welcome To Our Website</p>
            <h1 class="text-[3rem] lg:text-[5rem] 2xl:text-[5rem] font-bold uppercase leading-none">Primary
                School
            </h1>
            <h1 class="text-[1.5rem] lg:text-[3rem] 2xl:text-[5rem] font-bold leading-none text-yellow-300">St.
                Emilie Learning
                Center
            </h1>
        </div>

        <div
            class="pl-[1rem] lg:pl-[5rem] text-start z-[12] relative ">
            <a href="#aboutSchool">
                <button
                    class="z-[700] bg-transparent border-4 border-yellow-300 py-4 px-10 text-white rounded-full font-bold text-lg uppercase mt-5 text-center transform duration-500 hover:scale-110 hover:z-[10] hover:bg-yellow-100 hover:border-yellow-700 hover:text-yellow-500 transition-transform">About
                    Our School <i class="fa-solid fa-location-arrow ml-3 text-2xl"></i></button>
            </a>
        </div>

        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2  xl:grid-cols-4 gap-4 px-[0rem] lg:px-[6rem] relative lg:absolute items-center w-full z-[13] mt-[30rem] md:mt-[20rem] lg:mt-[15rem]">
            <!-- Course Card -->
            <div data-modal-target="default-modal" data-modal-toggle="default-modal"
                class="card bg-yellow-400 py-8 rounded-lg mt-10 lg:mt-0 mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform">
                <div class="text-center text-white px-5">
                    <i
                        class="fas fa-book fa-3x mb-4 text-yellow-500 p-4 px-5 bg-white rounded-full border-[5px] border-yellow-400 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                    <h2 class="text-lg font-bold mb-2 mt-10 bg-yellow-600 rounded-full shadow-lg">Courses</h2>
                    <p>Browse our courses</p>
                </div>
            </div>

            <!-- Teachers Card -->
            <div
                class="card bg-green-500 py-8 rounded-lg mt-10 lg:mt-0 mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform">
                <div class="text-center text-white px-5" onclick="window.location.href = '#gallery'">
                    <i
                        class="fas fa-chalkboard-teacher fa-3x mb-4 text-green-500 p-3 py-4 bg-white rounded-full border-[5px] border-green-500 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                    <h2 class="text-lg font-bold mb-2 mt-10 bg-green-700 rounded-full shadow-lg">Gallery</h2>
                    <p>Explore our institute</p>
                </div>
            </div>

            <!-- Gallery Card -->
            <div
                class="card bg-sky-500 py-8 mt-10 lg:mt-0 rounded-lg mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform">
                <div class="text-center text-white px-5">
                    <i
                        class="fas fa-image fa-3x mb-4 text-sky-500 p-4 bg-white rounded-full border-[5px] border-sky-500 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                    <h2 class="text-lg font-bold mb-2 mt-10 bg-sky-700 rounded-full shadow-lg">Admission</h2>
                    <p>Online Application</p>
                </div>
            </div>

            <!-- Portal Card -->
            <div class="card bg-teal-500 py-8 rounded-lg mx-4 mt-10 lg:mt-0 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform"
                id="loginPage" onclick="window.open('/StEmelieLearningCenter.HopeSci66/sign-in', '_blank')">
                <div class="text-center text-white px-5">
                    <i
                        class="fa-solid fa-box fa-3x mb-4 text-teal-400 p-4 bg-white rounded-full border-[5px] border-teal-300 absolute left-[4.3rem] top-[-2rem] shadow-l"></i>
                    <!-- <i
                        class="fas fa-newspaper g"></i> -->
                    <h2 class="text-lg font-bold mb-2 mt-10 bg-teal-700 rounded-full shadow-lg">School Portal</h2>
                    <p>Sign-in to Portal </p>
                </div>
            </div>
        </div>
    </div>

    <div
        class="missionvission w-full px-10 py-10 h-[900px] lg:h-[200px] mt-[30rem] md:mt-[0rem] relative flex justify-center items-center" id="missionvission">

        <a href="#"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology
                acquisitions 2021</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology
                acquisitions of 2021 so far, in reverse chronological order.</p>
        </a>

        <a href="#"
            class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Noteworthy technology
                acquisitions 2021</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">Here are the biggest enterprise technology
                acquisitions of 2021 so far, in reverse chronological order.</p>
        </a>

    </div>

    <div class="w-full px-10 py-10 h-[900px] lg:h-[600px] mt-[50rem] relative flex justify-center items-center"
        id="aboutSchool">
        <div class="container mx-auto lg:px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:p-5 border-lg relative shadow-lg">
                <!-- Video Box -->
                <div class="w-full h-full bg-cover bg-center flex justify-center items-stretch"
                    style="background-image: url({{ asset('../assets/images/SELC.png') }}); min-height: 400px;">
                </div>

                <!-- Icon Boxes -->
                <div class="col-span-2 w-full flex flex-col justify-center  text-center py-5 px-4 lg:px-5">
                    <h3 class="text-teal-900 text-3xl font-bold mb-4">Introduction</h3>
                    <p class="text-teal-900 text-xl">St. Emilie Learning Center is committed to empower the love
                        of God to become a responsible citizen.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="default-carousel" class="relative w-full mt-[10rem]" data-carousel="slide">
        Carousel wrapper
        <div class="relative overflow-hidden rounded-lg md:h-[500px] h-1/2">

            <div class="hidden duration-700 ease-in-out bg-red-500" data-carousel-item>
                <!-- <img src="/docs/images/carousel/carousel-1.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> -->
            </div>

            <div class="hidden duration-700 ease-in-out bg-green-500" data-carousel-item>
                <!-- <img src="/docs/images/carousel/carousel-2.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> -->
            </div>

            <div class="hidden duration-700 ease-in-out bg-blue-500" data-carousel-item>
                <!-- <img src="/docs/images/carousel/carousel-3.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> -->
            </div>

            <div class="hidden duration-700 ease-in-out bg-emerald-500" data-carousel-item>
                <!-- <img src="/docs/images/carousel/carousel-4.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> -->
            </div>

            <div class="hidden duration-700 ease-in-out bg-real-500" data-carousel-item>
                <!-- <img src="/docs/images/carousel/carousel-5.svg"
                        class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="..."> -->
            </div>
        </div>

        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1"
                data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4"
                data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5"
                data-carousel-slide-to="4"></button>
        </div>

        <button type="button"
            class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-prev>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button"
            class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <div class="w-full py-10 mb-5" id="gallery">
        <div class="container mx-auto px-4">
            <!-- Gallery Grid Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-20 p-5"
                id="image-gallery">
                <!-- Images will be dynamically loaded here -->
            </div>

        </div>
    </div>

    @include('includes.jslink')
    @include('includes.footer')

</div>