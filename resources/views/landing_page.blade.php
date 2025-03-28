@include("includes.header")
<div class=" 2xl:max-w-[1500px] w-full h-full overflow-hidden overflow-y-scroll" >
    <div class="main1" id="top">
        <canvas id="canvas" class="w-screen h-screen absolute bg-transparent z-[11] left-0 top-0 "></canvas>
        <!-- @include("main.topbar") -->
        <div class=" w-full h-full relative top-0">
            <div class="pl-[1rem] lg:pl-[5rem] text-start z-[10] w-full text-white relative mt-[2rem]">
                <p class="text-sm lg:text-[1.5rem] leading-8">Welcome To Our Website</p>
                <h1 class="text-[3rem] lg:text-[5rem] 2xl:text-[5rem] font-bold uppercase leading-none">Primary
                    School
                </h1>
                <h1 class="text-[1.5rem] lg:text-[3rem] 2xl:text-[5rem] font-bold leading-none text-yellow-300">St.
                    Emilie Learning
                    Center
                </h1>
                <p class="my-5">St. Emilie Learning Center is committed to empower the love of God to become a
                    responsible citizen</p>
            </div>

            <div class="pl-[1rem] lg:pl-[5rem] text-start z-[12] relative ">
                <button onclick="document.getElementById('modalprivacy').classList.remove('hidden')"
                    class="z-[700] bg-transparent border-4 border-yellow-300 py-4 px-10 text-white rounded-full font-bold text-lg uppercase mt-5 text-center transform transition-all duration-300 hover:scale-110 hover:z-[10] hover:bg-yellow-100 hover:border-yellow-700 hover:text-yellow-500 transition-transform">register
                    Now <i class="fa-solid fa-location-arrow ml-3 text-2xl"></i></button>
            </div>
        </div>
    </div>

    <div
        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2  xl:grid-cols-4 gap-4 px-[0rem] lg:px-[6rem] relative items-center w-full z-[13] mt-[15rem] md:mt-[20rem] lg:mt-[6rem] hidden lg:grid">
        <!-- Course Card -->
        <div class="card bg-yellow-400 py-8 rounded-lg mt-10 lg:mt-0 mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform"
            onclick="window.location.href = '#courses'">
            <div class="text-center text-white px-5">
                <i
                    class="fas fa-book fa-3x mb-4 text-yellow-500 p-4 px-5 bg-white rounded-full border-[5px] border-yellow-400 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                <h2 class="text-lg font-bold mb-2 mt-10 bg-yellow-600 rounded-full shadow-lg">Course</h2>
                <p>Browse our course</p>
            </div>
        </div>

        <!-- Teachers Card -->
        <div
            class="card bg-green-500 py-8 rounded-lg mt-10 lg:mt-0 mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform">
            <div class="text-center text-white px-5" onclick="window.location.href = '#gallery'">
                <i
                    class="fas fa-image  fa-3x mb-4 text-green-500 p-3 py-4 bg-white rounded-full border-[5px] border-green-500 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                <h2 class="text-lg font-bold mb-2 mt-10 bg-green-700 rounded-full shadow-lg">Gallery</h2>
                <p>Explore our institute</p>
            </div>
        </div>

        <!-- Gallery Card -->
        <div class="card bg-sky-500 py-8 mt-10 lg:mt-0 rounded-lg mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform"
            onclick="window.location.href = '#missionvission'">
            <div class="text-center text-white px-5">
                <i
                    class="fas fa-chalkboard-teacher fa-3x mb-4 text-sky-500 p-4 bg-white rounded-full border-[5px] border-sky-500 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                <h2 class="text-lg font-bold mb-2 mt-10 bg-sky-700 rounded-full shadow-lg">Our School</h2>
                <p>Browse our School</p>
            </div>
        </div>

        <!-- Portal Card -->
        <div class="card bg-teal-500 py-8 rounded-lg mx-4 mt-10 lg:mt-0 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform"
            id="loginPage" onclick="window.location.href = '/'">
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


    @include("includes.chatbot")


    <div id="modalprivacy"
        class="fixed hidden z-[100] top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 px-2 flex justify-center items-center items-center">
        
        <div class="bg-white rounded-md shadow-lg p-5 max-w-3xl mx-auto z-20">
            <div class="flex justify-center items-center p-5 border-b border-gray-900">
            <p class="text-lg font-bold text-teal-800">Data Privacy Agreement</p>
            </div>
            <div class="overflow-y-scroll h-[20rem] scrollbar-width-thin my-3 p-5">
                <p class="text-[12px] text-justify">
                    We at <strong>St. Emilie Learning Center</strong> are committed to protecting the privacy and
                    security of your
                    personal information. Please carefully read this agreement before proceeding with the
                    registration process. <br /><br />
                    <strong>Collection of Personal Information</strong> <br />
                    By proceeding with the registration, you agree to provide personal information including but not
                    limited to your full name, date of birth, address, contact details, educational background, and
                    any other information required for the admission process.
                    <br /><br />
                    <strong>Use of Personal Information</strong> <br />
                    The personal information you provide will be used exclusively for the purpose of admission at
                    <strong>St. Emilie Learning Center</strong>.
                    <br /><br />
                    The personal information collected will be used solely for the following purposes: <br /><br />
                </p>
                <ul class=" text-[12px] text-justify">
                    <li class="my-2">
                        <p>- Processing and managing student admissions</p>
                    </li>
                    <li class="my-2">
                        <p>- Maintaining accurate student records</p>
                    </li>
                    <li class="my-2">
                        <p>- Communicating with parents and guardians regarding school-related matters</p>
                    </li>
                    <li class="my-2">
                        <p>- Generating reports and statistical data for internal use</p>
                    </li>
                </ul>
                <p class="text-[12px] text-justify">
                    <br />
                    <strong>Disclosure of Personal Information</strong> <br />
                    We will not disclose your personal information to third parties without your consent, except when
                    required by law or when necessary to protect the rights and safety of the school and its
                    students.
                    <br /><br />
                    <strong>Data Security</strong> <br />
                    We have implemented appropriate technical and organizational measures to safeguard your
                    personal data against unauthorized access, loss, or misuse.
                    <br /><br />
                    <strong> Retention of Information</strong> <br />
                    Your personal information will be retained only for as long as necessary to fulfill the purposes
                    outlined in this agreement, unless a longer retention period is required by law.
                    <br /><br />
                    By proceeding with the registration, you confirm that you have read and understood this Data
                    Privacy Agreement and consent to the collection, use, and disclosure of your personal
                    information as described above.
                </p>
            </div>
            <div class="flex justify-start items-center pt-5">
                <input type="checkbox" id="checkprivacy"
                    class="mr-2 appearance-none rounded-sm bg-white checked:bg-teal-600 checked:border-teal-600 focus:outline-none">
                <label for="checkprivacy" class="text-[12px]">I have read and agree to the Data Privacy
                    Agreement.</label>
            </div>
            <div class="flex justify-end items-center mt-5">
                <button onclick="document.getElementById('modalprivacy').classList.add('hidden')"
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-4 rounded-sm transition-all duration-300">Close</button>
                <button onclick="window.location.href = '/Registration'"
                    id="nextbtnprivacy" disabled
                    class="ml-3 bg-gray-500 text-white font-semibold py-1 px-4 rounded-sm transition-all duration-300">Next</button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('checkprivacy').addEventListener('change', function () {
            const nextbtnprivacy = document.getElementById('nextbtnprivacy');
            nextbtnprivacy.disabled = !this.checked;
            nextbtnprivacy.classList.toggle('bg-gray-500', !this.checked);
            nextbtnprivacy.classList.toggle('bg-teal-600', this.checked);
            nextbtnprivacy.classList.toggle('hover:bg-teal-700', this.checked);
        });
    </script>

    <div class="w-full bg-sky-100 px-2 mt-[13rem] lg:mt-[4rem] md:px-[8rem] xl:px-[15rem] 2xl:px-[20rem] py-10 relative grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 lg:gap-24"
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

    <div class="w-full px-2 lg:px-5 py-10 h-[900px] lg:h-[600px] relative flex justify-center items-center mt-[20rem] lg:mt-0 bg-teal-50"
        id="aboutSchool">
        <div class="container mx-auto lg:px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:p-5 border-lg relative">
                <!-- Video Box -->
                <div class="w-full h-full bg-cover bg-center flex justify-center items-stretch rounded-lg" id="imageone"
                    style="background-image: url({{ asset('../assets/images/imageonebg.png') }}); min-height: 400px;">
                </div>

                <!-- Icon Boxes -->
                <div class="col-span-2 w-full flex flex-col justify-center  text-center py-5 px-4 lg:px-5">
                    <h3 class="text-teal-900 text-3xl font-bold mb-4">Welcome to St. Emilie Learning Center!</h3>
                    <p class="text-teal-900 text-md text-justify px-0 lg:px-10">At St. Emilie Learning Center, we are dedicated to
                        providing a nurturing and engaging learning environment where students develop academically,
                        socially, and emotionally. Our school upholds high standards of education, ensuring that each
                        student receives the knowledge and skills necessary for lifelong success. Through a balanced
                        curriculum and values-based learning, we aim to shape individuals who are not only intelligent
                        but also compassionate and responsible members of society. <br /><br />

                        Beyond academics, we emphasize the importance of co-curricular activities and character
                        formation, allowing students to explore their talents, enhance their leadership skills, and
                        build meaningful connections. Our educators are committed to fostering critical thinking,
                        creativity, and resilience, preparing students to thrive in an ever-evolving world. We believe
                        that a well-rounded education equips learners with the confidence and adaptability to face
                        future challenges.<br /><br />

                        This website serves as an informative platform for students, parents, and visitors, providing
                        updates on school policies, activities, and events. We encourage everyone to stay engaged and
                        connected as we work together to create an enriching educational experience. Welcome to St.
                        Emilie Learning Center, where little learners become big achievers!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full px-2 lg:px-10 py-10 h-[900px] lg:h-[600px] relative flex justify-center items-center mt-[18rem] lg:mt-2 bg-sky-100" id="aboutSchool">
        <div class="container mx-auto lg:px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 lg:p-5 border-lg relative ">
                <!-- Video Box -->
                <div class="w-full h-full bg-cover bg-center flex justify-center items-stretch rounded-lg" id="imagetwo"
                    style="background-image: url({{ asset('../assets/images/imagetwobg.png') }}); min-height: 400px;">
                </div>

                <!-- Icon Boxes -->
                <div class="col-span-2 w-full flex flex-col justify-center  text-center py-5 px-4 lg:px-5">
                    <p class="text-teal-900 text-md text-justify mt-5 lg:mt-0 px-0 lg:px-10">"Discover, Learn, and Shine at St. Emelie Learning
                        Center!
                        Where young minds grow, friendships flourish, and dreams take flight. Join us for a journey of
                        curiosity, creativity, and endless possibilities. Enroll now and be part of our vibrant learning
                        community!" <br /><br />
                        Would you like further tweaks or a different tone?</p>

                    <div class="flex justify-center items-center mt-5">
                    <button type="button"  onclick="document.getElementById('modalprivacy').classList.remove('hidden')"
                        class="text-white w-80 text-center bg-teal-800 hover:bg-teal-700 focus:ring-4 focus:outline-none focus:ring-teal-300 font-bold rounded-full text-lg px-20 py-2.5 text-center mt-20"
                        >Register Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full mb-5 mt-20" id="courses">
        <div class="flex justify-start items-center px-5 md:px-10">
            <i class="fa-solid fa-book font-bold lg:text-[150px] text-teal-900 me-5 text-[50px]"></i>
            <h1
                class="font-bold xl:text-[120px] lg:text-[100px] text-teal-900 text-start lg:leading-[5rem] xl:leading-[7rem] text-[50px] leading-[2.5rem]">
                <span class="text-teal-500">S</span>CHOOL <span class="text-teal-500">C</span>OURSE
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