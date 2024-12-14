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
            height: 90%;
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
            opacity: 0.5;
            z-index: 2;
            height: 90%;
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
    <div class="main1 bg-white 2xl:max-w-[1900px] w-full h-screen overflow-y-scroll">
        @include("includes.header")
        <div class=" w-full h-full lg:h-[90%] 2xl:mx-h-[800px] relative top-0">
            <div class="pl-[1rem] lg:pl-[5rem] text-start z-[100] absolute lg:top-[-40rem] w-full bg-transparent text-white h-full">
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

            <div class="w-full py-10  mb-5">
                <div class="container mx-auto px-4">
                    <!-- Grid layout: 3 columns in the first row, 2 columns in the second row -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-20 p-20">

                        <!-- Image 1 -->
                        <div class="relative overflow-hidden group bg-dred-500">
                            <img src="{{ asset('../assets/images/SELC.png') }}" alt="Image 1"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110 group-hover:opacity-80">
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:bg-teal-500 group-hover:opacity-100 transition-opacity duration-500">
                                <p class="text-white text-lg">Image 1</p>
                            </div>
                        </div>

                        <!-- Image 2 -->
                        <div class="relative overflow-hidden group">
                            <img src="{{ asset('../assets/images/SELC.png') }}" alt="Image 2"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110 group-hover:opacity-80">
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:bg-teal-500 group-hover:opacity-100 transition-opacity duration-500">
                                <p class="text-white text-lg">Image 2</p>
                            </div>
                        </div>

                        <!-- Image 3 -->
                        <div class="relative overflow-hidden group">
                            <img src="{{ asset('../assets/images/SELC.png') }}" alt="Image 3"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110 group-hover:opacity-80">
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:bg-teal-500 group-hover:opacity-100 transition-opacity duration-500">
                                <p class="text-white text-lg">Image 3</p>
                            </div>
                        </div>

                        <!-- Image 4 -->
                        <div class="relative overflow-hidden group">
                            <img src="{{ asset('../assets/images/SELC.png') }}" alt="Image 4"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110 group-hover:opacity-80">
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:bg-teal-500 group-hover:opacity-100 transition-opacity duration-500">
                                <p class="text-white text-lg">Image 4</p>
                            </div>
                        </div>

                        <!-- Image 5 -->
                        <div class="relative overflow-hidden group">
                            <img src="{{ asset('../assets/images/SELC.png') }}" alt="Image 5"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110 group-hover:opacity-80">
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:bg-teal-500 group-hover:opacity-100 transition-opacity duration-500">
                                <p class="text-white text-lg">Image 5</p>
                            </div>
                        </div>

                        <!-- Image 6 -->
                        <div class="relative overflow-hidden group">
                            <img src="{{ asset('../assets/images/SELC.png') }}" alt="Image 5"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110 group-hover:opacity-80">
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:bg-teal-500 group-hover:opacity-100 transition-opacity duration-500">
                                <p class="text-white text-lg">Image 6</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include ('includes.footer')
        </div>
    </div>

    <!-- Initialize AOS -->
    <script>
        AOS.init({
            offset: 100, // Start animation when the element is 100px from the viewport
            duration: 500, // Duration of the animation in ms
            once: true, // Whether animation should happen only once
        });
    </script>
</body>

</html>