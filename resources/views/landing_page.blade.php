<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>St.-Emilie-Learning-Center</title>
    <link rel="shortcut icon" href="{{ asset('../assets/images/SELC.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('../css/landing.css') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>

    </style>
</head>

<body class="bg-zinc-50 lg:bg-white">
    @include ('includes.header')

    <main class="w-screen h-screen">
        <div class="w-screen h-screen">
            <div class="main h-[100%] lg:h-[90%] w-full">
            </div>

            <div class="title w-full pl-[2rem] lg:pl-[9rem] text-start">
                <p class="text-sm lg:text-[1.5rem] leading-8">Welcome To Our Website</p>
                <h1 class="text-[3rem] lg:text-[5rem] 2xl:text-[5rem] font-bold uppercase leading-none">Primary School
                </h1>
                <h1 class="text-[1.5rem] lg:text-[3rem] 2xl:text-[5rem] font-bold leading-none text-yellow-300">St.
                    Emilie Learning
                    Center
                </h1>
                <a href="https://www.google.com/maps/place/St.+Emilie+Learning+Center/@14.7187826,121.1332403,15z/data=!4m6!3m5!1s0x3397b0083f1e47fb:0xa41cb7b730554b5!8m2!3d14.7533756!4d121.0806689!16s%2Fg%2F1pzpz4rpw?hl=en&entry=ttu&g_ep=EgoyMDI0MDkxNi4wIKXMDSoASAFQAw%3D%3D"
                    target="_blank" class="leading-10 text-[12px] lg:text-[1.2rem] hover:text-yellow-500"><i
                        class="fas fa-map"></i>
                    Amparo Village, 18 Bangkal, Caloocan, Metro Manila
                </a>
            </div>

            <div
                class="absolute left-[-3rem] top-[30%] lg:left-[65%] lg:top-[0rem] xl:top-[5rem] mt-16 w-96 h-96 rounded-full flex items-center justify-end z-[50]">
                <!-- Small White Circle (Click Trigger) -->
                <img src="{{ asset('../assets/images/SELC.png') }}" alt="logo"
                    class="circle border-2 border-white shadow-xl rounded-full w-10 h-10 lg:w-16 lg:h-16 bg-white z-20 absolute transition-transform transform duration-500 hover:scale-105 left-16 hover:bg-yellow-400 hover:scale-110 transition-colors"
                    id="toggle-button">

                <!-- Outer Circle -->
                <div class="circle border-r-4 border-white rounded-full h-44 w-44 opacity-0" id="circle"></div>

                <!-- List of Icons (Initially hidden, appears on click of the small white circle) -->
                <ul id="icon-list"
                    class="flex flex-col w-56 opacity-0 pointer-events-none transition-opacity duration-500 delay-150">
                    <li
                        class="my-5 p-2 text-sm text-white flex justify-center items-center animation-fade-in animation-delay-1 hover:bg-yellow-400 rounded-full bg-yellow-500 text-center">
                        <i class="fas fa-clock text-sm mr-3"></i> Open 24 Hours
                    </li>
                    <li>
                        <a href="mailto:theemilians@gmail.com" target="_blank"
                            class="ml-10 my-5 p-2 text-sm text-white flex justify-center animation-fade-in animation-delay-2 hover:bg-yellow-400 rounded-full bg-yellow-500 text-center"><i
                                class="fas fa-envelope text-sm mr-3"></i> Email Us</a>
                    </li>
                    <li>
                        <a href="tel:+63279550392"
                            class="ml-16 my-5 p-2 text-[12px] text-white flex justify-center animation-fade-in animation-delay-3 hover:bg-yellow-400 rounded-full bg-yellow-500 text-center"><i
                                class="fas fa-phone-alt text-sm mr-3"></i>Tel. : Contact Us</a>
                    </li>
                    <li>
                        <a href="tel:+639154218235"
                            class="ml-10 my-5 p-2 text-sm text-white flex justify-center animation-fade-in animation-delay-4 hover:bg-yellow-400 rounded-full bg-yellow-500 text-center">
                            <i class="fas fa-mobile-alt text-sm mr-3"></i>Mob. : Contact Us</a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com/StEmilieLC" target="_blank"
                            class="my-5 p-2 text-sm text-white flex justify-center animation-fade-in animation-delay-5 hover:bg-yellow-400 bg-yellow-500 rounded-full"><i
                                class="fab fa-facebook text-sm mr-3"></i>
                            Facebook Page</a>
                    </li>
                </ul>
            </div>

            <div class="grid grid-cols-4 gap-4 px-[0rem] lg:px-[6rem] 2xl:px-[26rem] items-center w-full absolute mt-[3rem] lg:mt-[-8rem]"
                style="z-index: 40  ;">
                <!-- Course Card -->
                <div
                    class="col-span-4 lg:col-span-1 card bg-yellow-300 py-8 rounded-lg mx-4 shadow-lg transform hover:scale-105 transition-transform">
                    <div class="text-center text-white">
                        <i
                            class="fas fa-book fa-3x mb-4 text-yellow-400 p-4 px-5 bg-white rounded-full border-[5px] border-yellow-300 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                        <!-- Courses Icon -->
                        <h2 class="text-lg font-bold mb-2 mt-10 bg-yellow-400 rounded-full shadow-lg">Courses</h2>
                        <p>Browse our courses</p>
                    </div>
                </div>

                <!-- Teachers Card -->
                <div
                    class="col-span-4 lg:col-span-1 card bg-green-300 py-8 rounded-lg mx-4 shadow-lg transform hover:scale-105 transition-transform">
                    <div class="text-center text-white">
                        <i
                            class="fas fa-chalkboard-teacher fa-3x mb-4 text-green-400 p-3 py-4 bg-white rounded-full border-[5px] border-green-300 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                        <!-- Teachers Icon -->
                        <h2 class="text-lg font-bold mb-2 mt-10 bg-green-400 rounded-full shadow-lg">Teachers</h2>
                        <p>Meet our team</p>
                    </div>
                </div>

                <!-- Gallery Card -->
                <div
                    class="col-span-4 lg:col-span-1 card bg-red-300 py-8 rounded-lg mx-4 shadow-lg transform hover:scale-105 transition-transform">
                    <div class="text-center text-white">
                        <i
                            class="fas fa-image fa-3x mb-4 text-red-400 p-4 bg-white rounded-full border-[5px] border-red-300 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                        <!-- Gallery Icon -->
                        <h2 class="text-lg font-bold mb-2 mt-10 bg-red-400 rounded-full shadow-lg">Gallery</h2>
                        <p>View our gallery</p>
                    </div>
                </div>

                <!-- News Card -->
                <div
                    class="col-span-4 lg:col-span-1 card bg-blue-300 py-8 rounded-lg mx-4 shadow-lg transform hover:scale-105 transition-transform">
                    <div class="text-center text-white">
                        <i
                            class="fas fa-newspaper fa-3x mb-4 text-blue-400 p-4 bg-white rounded-full border-[5px] border-blue-300 absolute left-[4.3rem] top-[-2rem] shadow-lg"></i>
                        <!-- News Icon -->
                        <h2 class="text-lg font-bold mb-2 mt-10 bg-blue-400 rounded-full shadow-lg">News</h2>
                        <p>Latest updates</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include ('includes.footer')

    @include ('includes.chatbot')

    <script>
        // Show the icon list on mouse enter and trigger animation
        document.getElementById('toggle-button').addEventListener('mouseenter', function () {
            const iconList = document.getElementById('icon-list');
            const circle = document.getElementById('circle');
            iconList.classList.add('opacity-100');
            circle.classList.add('opacity-100');
            iconList.classList.add('pointer-events-auto');
            iconList.classList.remove('opacity-0');

            // Remove and re-add the animation classes to trigger fade-in
            const listItems = document.querySelectorAll('#icon-list li');
            listItems.forEach((item, index) => {
                item.classList.remove('animation-fade-in');
                void item.offsetWidth; // Trigger reflow (restarts the animation)
                item.classList.add('animation-fade-in', `animation-delay-${index + 1}`);
            });

            setTimeout(() => {
                const iconList = document.getElementById('icon-list');
                iconList.classList.remove('opacity-100');
                iconList.classList.add('opacity-0');
                iconList.classList.remove('pointer-events-auto');
                circle.classList.remove('opacity-100');
            }, 3000);
        });
    </script>
</body>

</html>