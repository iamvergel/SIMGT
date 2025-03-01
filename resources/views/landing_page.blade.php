@include("includes.header")
<div class=" 2xl:max-w-[1500px] w-full h-full overflow-hidden overflow-y-scroll">
    <div class="main1">
        <canvas id="canvas" class="w-screen h-screen absolute bg-transparent z-[11] left-0 top-0 "></canvas>
        <!-- @include("main.topbar") -->
        <div class=" w-full h-full relative top-0">
            <div class="pl-[1rem] lg:pl-[5rem] text-start z-[10] w-full text-white relative mt-[10rem]">
                <p class="text-sm lg:text-[1.5rem] leading-8">Welcome To Our Website</p>
                <h1 class="text-[3rem] lg:text-[5rem] 2xl:text-[5rem] font-bold uppercase leading-none">Primary
                    School
                </h1>
                <h1 class="text-[1.5rem] lg:text-[3rem] 2xl:text-[5rem] font-bold leading-none text-yellow-300">St.
                    Emilie Learning
                    Center
                </h1>
            </div>

            <div class="pl-[1rem] lg:pl-[5rem] text-start z-[12] relative ">
                <a href="#missionvission">
                    <button
                        class="z-[700] bg-transparent border-4 border-yellow-300 py-4 px-10 text-white rounded-full font-bold text-lg uppercase mt-5 text-center transform duration-500 hover:scale-110 hover:z-[10] hover:bg-yellow-100 hover:border-yellow-700 hover:text-yellow-500 transition-transform">About
                        Our School <i class="fa-solid fa-location-arrow ml-3 text-2xl"></i></button>
                </a>
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2  xl:grid-cols-4 gap-4 px-[0rem] lg:px-[6rem] relative lg:absolute items-center w-full z-[13] mt-[30rem] md:mt-[20rem] lg:mt-[15rem]">
                <!-- Course Card -->
                <div
                    class="card bg-yellow-400 py-8 rounded-lg mt-10 lg:mt-0 mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform" onclick="window.location.href = '#courses'">
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
                    class="card bg-sky-500 py-8 mt-10 lg:mt-0 rounded-lg mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform" onclick="window.open('/StEmelieLearningCenter.HopeSci66/Registration', '_blank')">
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
    </div>

    <div class="h-[550px] hidden lg:block"></div>
    <div class="w-full px-2 mt-20 md:px-[8rem] xl:px-[15rem] 2xl:px-[20rem] py-10 relative grid grid-cols-1 md  :grid-cols-2 lg:grid-cols-2 gap-8"
        id="missionvission">

        <!-- Mission Card -->
        <div
            class="block p-6 bg-white border border-gray-200 rounded-lg rounded-t-none shadow-lg hover:bg-white bg-gradient-to-tr from-teal-50 via-teal-50 to-white border-0 border-t-4 border-teal-700">
            <h5 class="mb-2 text-[50px] font-bold tracking-tight text-teal-700">Our Mission</h5>
            <p class="font-normal text-teal-900">
                Our mission is to provide quality and innovative solutions to our clients, ensuring sustainability and
                growth while empowering communities.
            </p>
        </div>

        <div
            class="block p-6 bg-white border border-gray-200 rounded-lg rounded-t-none shadow-lg hover:bg-white bg-gradient-to-tr from-teal-50 via-teal-50 to-white border-0 border-t-4 border-teal-700">
            <h5 class="mb-2 text-[50px] font-bold tracking-tight text-teal-700">Our Vision</h5>
            <p class="font-normal text-teal-900">
                Our vision is to be a global leader in innovation, shaping the future of our industry and contributing
                to the betterment of society as a whole.
            </p>
        </div>

    </div>

    <div class="w-full px-10 py-10 h-[900px] lg:h-[600px] relative flex justify-center items-center" id="aboutSchool">
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

    <div class="w-full px-10 py-10 h-[900px] lg:h-[600px] relative flex justify-center items-center" id="aboutSchool">
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

    <div class="w-full mb-5 mt-20" id="courses">
        <div class="flex justify-start items-center px-5 md:px-10">
            <i class="fa-solid fa-book font-bold lg:text-[150px] text-teal-900 me-5 text-[50px]"></i>
            <h1
                class="font-bold xl:text-[120px] lg:text-[100px] text-teal-900 text-start lg:leading-[5rem] xl:leading-[7rem] text-[50px] leading-[2.5rem]">
                <span class="text-teal-500">S</span>CHOOL <span class="text-teal-500">C</span>OURSES
            </h1>
        </div>
        <div class="container mx-auto px-0 mt-10 lg:mt-20">
            <!-- Gallery Grid Layout -->
            <div class="" id="gradeCourses">
                @include("main.courses")
            </div>
        </div>
    </div>

    <div id="events" class="relative w-full mt-[10rem]" data-carousel="slide">
        <div class="flex justify-start items-center px-5 md:px-10">
            <i class="fa-solid fa-calendar-days font-bold lg:text-[150px] text-teal-900 me-5 text-[50px]"></i>
            <h1
                class="font-bold xl:text-[120px] lg:text-[100px] text-teal-900 text-start lg:leading-[5rem] xl:leading-[7rem] text-[50px] leading-[2.5rem]">
                <span class="text-teal-500">S</span>CHOOL <span class="text-teal-500">E</span>VENTS
            </h1>
        </div>
        <div class="eventContainer overflow-x-scroll py-20 flex space-x-4 px-10 mx-2 border-l-2 border-r-2 border-teal-700 mt-10"
            id="eventContainer">
            <!-- Events will be dynamically injected here -->
        </div>
    </div>

    <div id="default-carousel" class="relative w-full mt-[10rem]" data-carousel="slide">
        <div class="flex justify-start items-center px-5 md:px-10">
            <i class="fa-solid fa-bullhorn font-bold lg:text-[150px] text-teal-900 me-5 text-[50px]"></i>
            <h1
                class="font-bold xl:text-[120px] lg:text-[100px] text-teal-900 text-start lg:leading-[5rem] xl:leading-[7rem] text-[30px] md:text-[50px] md:leading-[2.5rem] leading-[2rem]">
                <span class="text-teal-500">S</span>CHOOL <br /> <span class="text-teal-500">A</span>NNOUNCEMENT
            </h1>
        </div>
        <div class="w-full relative">
            <div class="swiper multiple-slide-carousel swiper-container relative">
                <div class="swiper-wrapper py-20 pt-5" id="swiper-wrapper">

                    <!-- Slides will be populated here dynamically -->
                </div>

                <!-- Navigation Buttons -->
                <div class="absolute flex justify-between items-center m-auto left-12 w-fit bottom-12 z-[100]">
                    <button id="slider-button-left"
                        class="w-14 h-14 bg-teal-100 rounded-full border-4 border-teal-600 hover:bg-teal-200 p-5 flex justify-center items-center text-teal-700 font-semibold text-md me-8">
                        <i class="fa-solid fa-chevron-left"></i>
                    </button>
                    <button id="slider-button-right"
                        class="w-14 h-14 bg-teal-100 rounded-full border-4 border-teal-600 hover:bg-teal-200 p-5 flex justify-center items-center text-teal-700 font-semibold text-md">
                        <i class="fa-solid fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full mb-5 mt-20" id="gallery">
        <div class="flex justify-start items-center px-5 md:px-10">
            <i class="fa-solid fa-layer-group font-bold lg:text-[150px] text-teal-900 me-5 text-[50px]"></i>
            <h1
                class="font-bold xl:text-[120px] lg:text-[100px] text-teal-900 text-start lg:leading-[5rem] xl:leading-[7rem] text-[50px] leading-[2.5rem]">
                <span class="text-teal-500">S</span>CHOOL <span class="text-teal-500">G</span>ALLERY
            </h1>
        </div>
        <div class="container mx-auto px-4 overflow-y-scroll h-[1000px]  mt-10 lg:mt-20 border-b-2 border-teal-700"
            style="scrollbar-width: none">
            <!-- Gallery Grid Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2" id="image-gallery">
                <!-- Images will be dynamically loaded here -->
            </div>
        </div>
    </div>

    @include('includes.jslink')
    @include('includes.footer')

</div>