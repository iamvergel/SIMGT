<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>St.-Emilie-Learning-Center</title>
    <link rel="shortcut icon" href="{{ asset('../assets/images/SELC.png') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS CSS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
            scrollbar-width: none;
            cursor: default;
            transition: all 0.3s ease;
        }

        .main1 {
            position: absolute;
            isolation: isolate;
        }

        .main1::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url("https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/12.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 1;
            z-index: -1;
            animation: bgimage 20s infinite alternate;
            height: 850px;
        }

        @keyframes bgimage {
            0% {
                background-image: url(https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/12.jpg);
            }

            30% {
                background-image: url(https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/13.jpg);
            }

            60% {
                background-image: url(https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/12.jpg);
            }

            80% {
                background-image: url(https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/13.jpg);
            }

            100% {
                background-image: url(https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/12.jpg);
            }
        }

        .main1::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #000;
            opacity: 0.6;
            z-index: 2;
            height: 850px;
        }

        .main1::after {
            z-index: 1;
        }

        /* Example for the animation fade-in effect */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="bg-white h-screen w-screen flex items-center justify-center">
    <div class="main1 bg-white 2xl:max-w-[1900px] w-full h-full overflow-y-scroll">
        @include("includes.header")
        <div class=" w-full h-full lg:h-[90%] 2xl:mx-h-[800px] relative top-0">
            <div
                class="pl-[1rem] lg:pl-[5rem] text-start z-[100] absolute lg:top-[-40rem] w-full bg-transparent text-white h-full">
                <p class="text-sm lg:text-[1.5rem] leading-8 mt-[10rem] 2xl:mt-[0rem]">Welcome To Our Website</p>
                <h1 class="text-[3rem] lg:text-[5rem] 2xl:text-[5rem] font-bold uppercase leading-none">Primary
                    School
                </h1>
                <h1 class="text-[1.5rem] lg:text-[3rem] 2xl:text-[5rem] font-bold leading-none text-yellow-300">St.
                    Emilie Learning
                    Center
                </h1>
            </div>

            <div
                class="grid grid-cols-4 gap-4 px-[0rem] lg:px-[6rem] relative lg:absolute items-center w-full z-[60] mt-[3rem] lg:top-[-15rem]">
                <!-- Course Card -->
                <div
                    class="col-span-4 lg:col-span-1 card bg-yellow-300 py-8 rounded-lg mt-10 lg:mt-0 mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform">
                    <div class="text-center text-white">
                        <i
                            class="fas fa-book fa-3x mb-4 text-yellow-400 p-4 px-5 bg-white rounded-full border-[5px] border-yellow-300 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                        <h2 class="text-lg font-bold mb-2 mt-10 bg-yellow-400 rounded-full shadow-lg">Courses</h2>
                        <p>Browse our courses</p>
                    </div>
                </div>

                <!-- Teachers Card -->
                <div
                    class="col-span-4 lg:col-span-1 card bg-green-300 py-8 rounded-lg mt-10 lg:mt-0 mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform">
                    <div class="text-center text-white">
                        <i
                            class="fas fa-chalkboard-teacher fa-3x mb-4 text-green-400 p-3 py-4 bg-white rounded-full border-[5px] border-green-300 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                        <h2 class="text-lg font-bold mb-2 mt-10 bg-green-400 rounded-full shadow-lg">Teachers</h2>
                        <p>Meet our team</p>
                    </div>
                </div>

                <!-- Gallery Card -->
                <div
                    class="col-span-4 lg:col-span-1 card bg-red-300 py-8 mt-10 lg:mt-0 rounded-lg mx-4 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform">
                    <div class="text-center text-white">
                        <i
                            class="fas fa-image fa-3x mb-4 text-red-400 p-4 bg-white rounded-full border-[5px] border-red-300 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                        <h2 class="text-lg font-bold mb-2 mt-10 bg-red-400 rounded-full shadow-lg">Gallery</h2>
                        <p>View our gallery</p>
                    </div>
                </div>

                <!-- News Card -->
                <div
                    class="col-span-4 lg:col-span-1 card bg-blue-300 py-8 rounded-lg mx-4 mt-10 lg:mt-0 shadow-lg transform hover:scale-105 hover:z-[10] transition-transform">
                    <div class="text-center text-white">
                        <i
                            class="fas fa-newspaper fa-3x mb-4 text-blue-400 p-4 bg-white rounded-full border-[5px] border-blue-300 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                        <h2 class="text-lg font-bold mb-2 mt-10 bg-blue-400 rounded-full shadow-lg">News</h2>
                        <p>Latest updates</p>
                    </div>
                </div>
            </div>

            <div class="w-full px-10 py-10 h-[900px] lg:h-[600px] mt-[50rem] relative flex justify-center items-center">
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
                        <img src="/docs/images/carousel/carousel-1.svg"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>

                    <div class="hidden duration-700 ease-in-out bg-green-500" data-carousel-item>
                        <img src="/docs/images/carousel/carousel-2.svg"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>

                    <div class="hidden duration-700 ease-in-out bg-blue-500" data-carousel-item>
                        <img src="/docs/images/carousel/carousel-3.svg"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>

                    <div class="hidden duration-700 ease-in-out bg-emerald-500" data-carousel-item>
                        <img src="/docs/images/carousel/carousel-4.svg"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>

                    <div class="hidden duration-700 ease-in-out bg-real-500" data-carousel-item>
                        <img src="/docs/images/carousel/carousel-5.svg"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
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

            <div class="w-full py-10 mb-5">
                <div class="container mx-auto px-4">
                    <!-- Gallery Grid Layout -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-20 p-5"
                        id="image-gallery">
                        <!-- Images will be dynamically loaded here -->
                    </div>

                </div>
            </div>

            <script src="{{asset('js/admin/landingpage.js')}}"></script>

            @include('includes.footer')

            <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        </div>
    </div>
</body>

</html>