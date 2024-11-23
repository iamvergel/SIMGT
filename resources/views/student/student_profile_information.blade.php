<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>St. Emilie Learning Center</title>
    <link rel="shortcut icon" href="{{ asset('../assets/images/SELC.png') }}" type="image/x-icon"
        style="border-radius: 50%;">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <script src="https://kit.fontawesome.com/20a0e1e87d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="font-poppins bg-gray-200">
    <div class="flex flex-col lg:flex-row lg:p-2 w-full h-screen">
        <!-- Sidebar -->
        @include('student.includes.sidebar')

        <!-- Main Content -->
        <main
            class="flex-grow rounded-none lg:rounded-r-lg lg:rounded-l-none bg-white shadow-lg overflow-hidden overflow-y-scroll">
            @include('student.includes.header')

            <div id="container">
                <div class="p-5 py-3">
                    <p class="text-[15px] font-normal text-teal-900 mt-5">Student</p>
                    <h1 class="text-xl font-bold text-teal-900">Student Profile</h1>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-2">
                    <div class="col-span-1">
                        @include('student.includes.profile_sidebar')
                    </div>
                    <div class="col-span-1 lg:col-span-3">
                        <div id="accountSection" class="content-section">
                            @include('student.includes.student_information')
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('../js/admin/admin.js') }}" type="text/javascript"></script>
</body>

</html>