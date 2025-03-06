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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .bg-rhombus {
            width: 100%;
            height: 100%;
            clip-path: polygon(0 0, 100% 0%, 71% 100%, 0% 100%);
            background-image: url('https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/12.jpg');
            background-size: cover;
            background-position: center;
            z-index: -1;
            animation: bgimage 15s infinite alternate;
        }

        @keyframes bgimage {
            0% {
                background-image: url(https://raw.githubusercontent.com/iamvergel/St.-Emilie-Learning-Center/main/public/assets/images/12.jpg
);
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
    </style>
</head>

<body class="bg-zinc-50 lg:bg-white">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        <div class="bg-rhombus hidden lg:block">
            <div class="mask absolute inset-0 bg-teal-800 opacity-50 z-10"></div>
            <div class="z-20 absolute inset-0 flex justify-start items-center w-1/2 h-1/6">
                <img class="rounded-full logo mt-3 z-50 ml-5" src="{{ asset('../assets/images/SELC.png') }}" alt="logo"
                    width="60">
                <h1 class="text-2xl font-semibold text-white ml-3 mt-2 tracking-wider">St. Emilie Learning Center</h1>
            </div>

            <h3
                class="z-30 absolute bottom-20 text-4xl md:text-5xl font-bold text-white ml-5 tracking-wide w-1/2 md:w-1/3 border-l-4 border-yellow-500 pl-5 p-5">
                Student Management System
            </h3>

        </div>

        <div class="bg-transparent w-full h-screen flex items-start justify-center sm:items-center lg:justify-start">
            <div class="bg-zinc-50 sm:bg-white rounded-2xl shadow-none sm:shadow-xl lg:shadow-none p-5">
                <div class="signinForm p-10 w-full">
                    <div
                        class="header text-center block lg:hidden py-10 flex justify-start sm:justify-center items-center ">
                        <div class="flex justify-center items-center ">
                            <img class="rounded-full logo mt-3" src="{{ asset('../assets/images/SELC.png') }}"
                                alt="logo" width="100">
                            <h1 class="text-2xl tracking-wider font-bold text-emerald-700 ml-2 hidden sm:block">St.
                                Emilie Learning Center</h1>
                        </div>
                    </div>

                    <div class="main">
                        <form class="mt-5" action="{{ route('admin.login') }}" method="POST">
                            @csrf
                            <div class="loginForm lg:w-96">
                                <div class="divider text-start text-emerald-900">
                                    <p class="font-bold text-lg text-emerald-900">
                                        Sign in
                                    </p>
                                    <p>
                                        Enter your account details
                                    </p>
                                </div>

                                <!-- USERNAME -->
                                <div class="flex items-center mb-4 mt-4">
                                    <input type="text" name="username" id="username"
                                        class="form-input block text-sm text-normal text-emerald-900 tracking-wider w-full pl-5 p-3 border border-gray-400 rounded-md px-5"
                                        placeholder="Username :" required>
                                </div>

                                <!-- PASSWORD -->
                                <div class="flex items-center mb-4 relative">
                                    <input type="password" name="password" id="password"
                                        class="form-input block text-sm text-normal text-emerald-900 tracking-wider w-full pl-5 p-3 border border-gray-400 rounded-md px-5"
                                        placeholder="Password :" required>
                                    <span class="absolute right-3 top-1/2 transform -translate-y-1/2 text-emerald-900">
                                        <i class="fa-solid fa-eye cursor-pointer password-toggle"></i>
                                    </span>
                                </div>

                                <!-- ALERT -->
                                @if($errors->any())
                                    <p class="alert text-center text-red-500 text-sm">{{ $errors->first() }}</p>
                                @endif

                                <div class="mt-8">
                                    <!-- CHECK BOX -->
                                    <div class="flex items-center">
                                        <input
                                            class="form-checkbox h-4 w-4 text-emeral-600 bg-emerald-900 border-emerald-900 rounded-md accent-emerald-900"
                                            type="checkbox" id="rememberme" name="remember">
                                        <label class="text-sm text-emerald-900 ml-2" for="rememberme">Remember
                                            me</label>
                                    </div>

                                    <!-- LOGIN BUTTON -->
                                    <button type="submit" name="submit"
                                        class="bg-teal-700 text-md text-white font-normal px-4 py-2 rounded-full hover:bg-teal-800 w-full mt-10">
                                        Sign in
                                    </button>
                                    <button type="button"
                                        class="bg-sky-700 text-md text-white font-normal px-4 py-2 rounded-full hover:bg-sky-800 w-full mt-2" onclick="window.open('/StEmelieLearningCenter.HopeSci66/Admission', '_blank')">
                                        Admission
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.password-toggle').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        document.addEventListener('DOMContentLoaded', function () {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const rememberMeCheckbox = document.getElementById('rememberme');

            const savedUsername = localStorage.getItem('username');
            const savedPassword = localStorage.getItem('password');

            if (savedUsername) {
                usernameInput.value = savedUsername;
                rememberMeCheckbox.checked = true;
            }

            if (savedPassword) {
                passwordInput.value = savedPassword;
            }

            rememberMeCheckbox.addEventListener('change', function () {
                if (this.checked) {
                    localStorage.setItem('username', usernameInput.value);
                    localStorage.setItem('password', passwordInput.value); // Fixed here
                } else {
                    localStorage.removeItem('username');
                    localStorage.removeItem('password');
                }
            });
        });
    </script>

</body>

</html>